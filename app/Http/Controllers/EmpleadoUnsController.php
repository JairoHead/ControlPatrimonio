<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use App\Models\MigData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class EmpleadoUnsController extends Controller
{
    /**
     * Muestra una lista de usuarios con búsqueda y paginación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtiene el término de búsqueda del request
        $search = $request->input('search');

        // Construcción de la consulta con búsqueda flexible
        $query = Empleado::when($search, function ($q) use ($search) {
            // Separar el término de búsqueda en palabras (por espacios)
            $words = preg_split('/\s+/', trim($search));
            // Para cada palabra, se añade una condición en la que debe aparecer en al menos uno de los campos
            foreach ($words as $word) {
                $q->where(function ($query) use ($word) {
                    $query->where('CODIGO', 'like', "%$word%")
                        ->orWhere('NOMBRES', 'like', "%$word%")
                        ->orWhere('APELLIDO_PATERNO', 'like', "%$word%")
                        ->orWhere('APELLIDO_MATERNO', 'like', "%$word%")
                        ->orWhere('TIPO_DOC_IDENTIDAD', 'like', "%$word%")
                        ->orWhere('NRO_DOC_IDENT_PERSONAL', 'like', "%$word%");
                });
            }
        });

        // Paginación y mantenimiento de query string
        $empleados = $query->paginate(30)->appends(request()->query());

        // Manejo de AJAX para búsqueda y paginación en tiempo real
        if ($request->ajax()) {
            return response()->json([
                'html'       => view('profile.partials.empleados-table', compact('empleados'))->render(),
                'pagination' => $empleados->appends(request()->query())
                    ->links('vendor.pagination.tailwind')
                    ->render(),
            ]);
        }

        // Retorna la vista con los usuarios paginados
        return view('empleados', compact('empleados'));
    }

    
    public function pdfBienesEmpleado($codigo)
    {
        // Busca el usuario por su código
        $empleado = Empleado::findOrFail($codigo);
        // Obtiene los bienes del usuario
        $bienes = MigData::where('codusuario', $empleado->CODIGO)->get();

        // Preparar datos para el resumen de bienes
        $resumenBienes = DB::table('mig_data')
            ->select('codarea', 'ubicacioncompleta', DB::raw('count(*) as total'))
            ->where('codusuario', $empleado->CODIGO)
            ->groupBy('codarea', 'ubicacioncompleta')
            ->get();

        // Carga la vista para generar el PDF
        $pdf = PDF::loadView('empleados-pdf-bienes', [
            'empleado' => $empleado,
            'bienes' => $bienes,
            'resumenBienes' => $resumenBienes,
        ]);

        // Establece la orientación horizontal del PDF
        $pdf->setPaper('a4', 'landscape');

        // Retorna el PDF como stream para visualizar en el navegador
        return $pdf->stream('bienes-empleado-' . $empleado->CODIGO . '.pdf');
    }
}
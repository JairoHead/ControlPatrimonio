<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use App\Models\MigData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class OficinaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Construcción de la consulta con búsqueda
        $query = Oficina::when($search, function ($q) use ($search) {
            $q->where('cod_ofi_ent', 'like', "%$search%")
              ->orWhere('codigo', 'like', "%$search%")
              ->orWhere('nombre', 'like', "%$search%")
              ->orWhere('cod_are_ent', 'like', "%$search%");
        });

        // Paginación y mantenimiento de query string
        $oficinas = $query->paginate(30)->appends(request()->query());

        // Manejo de AJAX para búsqueda y paginación en tiempo real
        if ($request->ajax()) {
            return response()->json([
                'html' => view('profile.partials.oficinas-table', compact('oficinas'))->render(),
                'pagination' => $oficinas->appends(request()->query())
                                        ->links('vendor.pagination.tailwind')
                                        ->render(),
            ]);
        }
                

        return view('oficinas', compact('oficinas'));
    }

    public function pdfBienesOficina($cod_ofi_ent)
    {
        // Busca la oficina por su código
        $oficina = Oficina::findOrFail($cod_ofi_ent);
        // Obtiene los bienes de la oficina
        $bienes = MigData::where('id_oficina', $oficina->cod_ofi_ent)->get();

        // Preparar datos para el resumen de bienes
        $resumenBienes = DB::table('mig_data')
            ->select('nombrecompleto', DB::raw('count(*) as total'))
            ->where('id_oficina', $oficina->cod_ofi_ent)
            ->groupBy('nombrecompleto')
            ->get();

        // Carga la vista para generar el PDF
        $pdf = PDF::loadView('oficinas-pdf-bienes', [
            'oficina' => $oficina,
            'bienes' => $bienes,
            'resumenBienes' => $resumenBienes,
        ]);

        // Establece la orientación horizontal del PDF
        $pdf->setPaper('a4', 'landscape');

        // Retorna el PDF como stream para visualizar en el navegador
        return $pdf->stream('bienes-oficina-' . $oficina->cod_ofi_ent . '.pdf');
    }
}

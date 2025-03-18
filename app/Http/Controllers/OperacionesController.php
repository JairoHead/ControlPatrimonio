<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacion;
use App\Models\ReportePatrimonio; // <-- IMPORTANTE: Ajusta el namespace si tu modelo está en otro lugar

class OperacionesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Búsqueda flexible (ya existente)
        $query = Operacion::when($search, function ($q) use ($search) {
            $words = preg_split('/\s+/', trim($search));
            foreach ($words as $word) {
                $q->where(function ($subQ) use ($word) {
                    $subQ->where('codbien', 'like', "%$word%")
                         ->orWhere('descripcio', 'like', "%$word%")
                         ->orWhere('color', 'like', "%$word%")
                         ->orWhere('est_bien', 'like', "%$word%")
                         ->orWhere('marca', 'like', "%$word%")
                         ->orWhere('modelo', 'like', "%$word%")
                         ->orWhere('serie', 'like', "%$word%")
                         ->orWhere('doc_alta', 'like', "%$word%")
                         ->orWhere('ubicacioncompleta', 'like', "%$word%")
                         ->orWhere('nombrecompleto', 'like', "%$word%")
                         ->orWhere('codarea', 'like', "%$word%");
                });
            }
        });

        // Paginación
        $operaciones = $query->paginate(30)->appends(request()->query());

        // AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('profile.partials.operaciones-table', compact('operaciones'))->render(),
                'pagination' => $operaciones->links('vendor.pagination.tailwind')->render(),
            ]);
        }

        // Vista principal
        return view('operaciones', compact('operaciones'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'descripcio'        => 'required|string',
            'color'             => 'nullable|string',
            'est_bien'          => 'nullable|string',
            'marca'             => 'nullable|string',
            'modelo'            => 'nullable|string',
            'serie'             => 'nullable|string',
            'doc_alta'          => 'nullable|string',
            'ubicacioncompleta' => 'nullable|string',
            'nombrecompleto'    => 'nullable|string',
            'codarea'           => 'nullable|string',
        ]);

        $operacion = Operacion::findOrFail($id);
        $operacion->update($data);

        return response()->json(['success' => true, 'message' => 'Operación actualizada correctamente']);
    }

    /**
     * Genera o Regenera reporte en la tabla reportes_patrimonio.
     */
    public function generarReporte(Request $request, $id)
    {
        // 1) Buscar la operación (bien) en la tabla 'operacion' (mig_data)
        $operacion = Operacion::findOrFail($id);

        // 2) Ver si hay un reporte existente para este 'codbien'
        $reporteExistente = ReportePatrimonio::where('codigo', $operacion->codbien)->first();

        if ($reporteExistente) {
            // Re-Generar
            $reporteExistente->accion  = 'Re-Generado';
            $reporteExistente->fecha   = now();
            $reporteExistente->detalle = 'Reporte regenerado desde Operaciones';
            // (opcional) $reporteExistente->usuario_id = auth()->id() ?? null;
            $reporteExistente->save();
        } else {
            // Crear uno nuevo
            ReportePatrimonio::create([
                'codigo'     => $operacion->codbien,
                'fecha'      => now(),
                'accion'     => 'Generado',
                'detalle'    => 'Reporte creado desde Operaciones',
                // 'usuario_id' => auth()->id() ?? null,
            ]);
        }

        // 3) Marcar en la tabla 'operacion' que ya tiene reporte
        $operacion->reporte_generado = true;
        $operacion->save();

        // 4) Retornar JSON con el HTML del botón
        $buttonHtml = view('profile.partials.operaciones-reporte-button', compact('operacion'))->render();

        return response()->json(['buttonHtml' => $buttonHtml]);
    }
}

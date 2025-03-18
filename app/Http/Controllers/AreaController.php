<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\MigData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Construcción de la consulta con búsqueda
        $query = Area::when($search, function ($q) use ($search) {
            $q->where('cod_are_ent', 'like', "%$search%")
              ->orWhere('codigo', 'like', "%$search%")
              ->orWhere('nombre', 'like', "%$search%");
        });

        // Paginación y mantenimiento de query string
        $areas = $query->paginate(30)->appends(request()->query());

        // Manejo de AJAX para búsqueda y paginación en tiempo real
        if ($request->ajax()) {
            return response()->json([
                'html' => view('profile.partials.areas-table', compact('areas'))->render(),
                'pagination' => $areas->appends(request()->query())
                                        ->links('vendor.pagination.tailwind')
                                        ->render(),
            ]);
        }
                

        return view('areas', compact('areas'));
    }

    public function pdfBienesArea($codigo)
    {
        // Busca el área por su código
        $area = Area::findOrFail($codigo);
        // Obtiene los bienes del área
        $bienes = MigData::where('codarea', $area->codigo)->get();

        // Preparar datos para el resumen de bienes
        $resumenBienes = DB::table('mig_data')
            ->select('ubicacioncompleta', DB::raw('count(*) as total'))
            ->where('codarea', $area->codigo)
            ->groupBy('ubicacioncompleta')
            ->get();

        // Carga la vista para generar el PDF
        $pdf = PDF::loadView('areas-pdf-bienes', [
            'area' => $area,
            'bienes' => $bienes,
            'resumenBienes' => $resumenBienes,
        ]);

        // Establece la orientación horizontal del PDF
        $pdf->setPaper('a4', 'landscape');

        // Retorna el PDF como stream para visualizar en el navegador
        return $pdf->stream('bienes-area-' . $area->codigo . '.pdf');
    }
}

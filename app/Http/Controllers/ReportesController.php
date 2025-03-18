<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MigData;
use App\Models\ReportePatrimonio;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Cache;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            // Consulta con filtro de búsqueda
            $resumenQuery = $this->applySearchToResumen(MigData::query(), $search);
            $reportesQuery = $this->applySearchToReportes(ReportePatrimonio::with('migData'), $search);
        } else {
            // Consulta sin filtro (todos los registros)
            $resumenQuery = MigData::selectRaw('codarea, ubicacioncompleta, nombrecompleto, count(*) as total')
                ->groupBy('codarea', 'ubicacioncompleta', 'nombrecompleto')
                ->orderBy('codarea');

            $reportesQuery = ReportePatrimonio::with('migData')->orderBy('fecha', 'desc');
        }

        $resumen = $resumenQuery->paginate(15)->appends($request->query());
        $historial = $reportesQuery->paginate(20)->appends($request->query());

        if ($request->ajax()) {
            return response()->json([
                'resumenHtml' => view('profile.partials.resumen-table', compact('resumen'))->render(),
                'historialHtml' => view('profile.partials.historial-reportes', ['reportes' => $historial])->render(),
            ]);
        }

        return view('reportes', [
            'resumen' => $resumen,
            'historial' => $historial,
        ]);
    }

    // PDF SOLO RESUMEN (sin cambios)
    public function pdfSoloResumen(Request $request)
    {
        $search = $request->input('search');

        $resumenQuery = $this->applySearchToResumen(MigData::query(), $search);
        $resumen = $resumenQuery->get();

        $pdf = PDF::loadView('reportes-pdf-resumen', [
            'resumen' => $resumen,
            'search' => $search,
        ]);

        return $pdf->stream('reporte-resumen.pdf');
    }

    // PDF SOLO HISTORIAL (sin cambios)
    public function pdfSoloHistorial(Request $request)
    {
        $search = $request->input('search');

        $reportesQuery = $this->applySearchToReportes(ReportePatrimonio::with('migData'), $search);
        $historial = $reportesQuery->get();

        $pdf = PDF::loadView('reportes-pdf-historial', [
            'historial' => $historial,
            'search' => $search,
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('reporte-historial.pdf');
    }

    // Función para aplicar la búsqueda al resumen (sin cambios)
    private function applySearchToResumen($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $words = preg_split('/\s+/', trim($search), -1, PREG_SPLIT_NO_EMPTY);
            if (!empty($words)) {
                $q->where(function ($subQuery) use ($words) {
                    foreach ($words as $word) {
                        $subQuery->where(function ($subQ2) use ($word) {
                            $subQ2->orWhere('codbien', 'like', "%{$word}%")
                                ->orWhere('codarea', 'like', "%{$word}%")
                                ->orWhere('nombrecompleto', 'like', "%{$word}%");
                        });
                    }
                });
            }
        })
            ->selectRaw('codarea, ubicacioncompleta, nombrecompleto, count(*) as total')
            ->groupBy('codarea', 'ubicacioncompleta', 'nombrecompleto')
            ->orderBy('codarea');
    }

    // Función para aplicar la búsqueda a los reportes (sin cambios)
    private function applySearchToReportes($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $words = preg_split('/\s+/', trim($search), -1, PREG_SPLIT_NO_EMPTY);
            if (!empty($words)) {
                $q->where(function ($subQuery) use ($words) {
                    foreach ($words as $word) {
                        $subQuery->where('codigo', 'like', "%{$word}%")
                            ->orWhereHas('migData', function ($query) use ($word) {
                                $query->where('codbien', 'like', "%{$word}%")
                                    ->orWhere('nombrecompleto', 'like', "%{$word}%");
                            });
                    }
                });
            }
        })
            ->orderBy('fecha', 'desc');
    }
}
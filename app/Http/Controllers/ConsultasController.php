<?php

namespace App\Http\Controllers;

use App\Models\MigData;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Construcción de la consulta con búsqueda flexible
        $query = MigData::when($search, function ($q) use ($search) {
            // Separamos el término de búsqueda en palabras
            $words = preg_split('/\s+/', trim($search));
            foreach ($words as $word) {
                $q->where(function ($query) use ($word) {
                    $query->where('codbien', 'like', "%$word%")
                          ->orWhere('descripcio', 'like', "%$word%")
                          ->orWhere('color', 'like', "%$word%")
                          ->orWhere('estado', 'like', "%$word%")
                          ->orWhere('marca', 'like', "%$word%")
                          ->orWhere('modelo', 'like', "%$word%")
                          ->orWhere('serie', 'like', "%$word%")
                          ->orWhere('doc_alta', 'like', "%$word%")
                          ->orWhere('ubicacioncompleta', 'like', "%$word%")
                          ->orWhere('nombrecompleto', 'like', "%$word%");
                });
            }
        });

        // Paginación y mantenimiento de query string
        $bienes = $query->paginate(30)->appends(request()->query());

        // Manejo de AJAX para búsqueda y paginación en tiempo real
        if ($request->ajax()) {
            return response()->json([
                'html'       => view('profile.partials.consultas-table', compact('bienes'))->render(),
                'pagination' => $bienes->appends(request()->query())
                                       ->links('vendor.pagination.tailwind')
                                       ->render(),
            ]);
        }

        return view('consultas', compact('bienes'));
    }
}

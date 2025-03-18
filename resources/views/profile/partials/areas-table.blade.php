<div>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Código</th>
                <th class="p-2 border">Siglas</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $area->cod_are_ent }}</td>
                    <td class="p-1 border text-center text-sm">{{ $area->codigo }}</td>
                    <td class="p-1 border text-center text-sm">{{ $area->nombre }}</td>
                    <td class="p-1 border text-center text-sm">
                        <a href="{{ route('areas.pdfBienesArea', $area->cod_are_ent) }}" class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 rounded" target="_blank">
                            Ver Bienes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Contenedor de la paginación -->
    <div class="pagination-container flex justify-center mt-4">
        {{ $areas->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>

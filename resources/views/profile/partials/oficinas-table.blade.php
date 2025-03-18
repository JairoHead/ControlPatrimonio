<div>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Código</th>
                <th class="p-2 border">Tipo</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Área</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($oficinas as $oficina)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $oficina->cod_ofi_ent }}</td>
                    <td class="p-1 border text-center text-sm">{{ $oficina->codigo }}</td>
                    <td class="p-1 border text-center text-sm">{{ $oficina->nombre }}</td>
                    <td class="p-1 border text-center text-sm">
                        <a href="{{ route('areas.index', ['search' => $oficina->cod_are_ent]) }}" class="text-blue-600 hover:underline">
                            {{ $oficina->cod_are_ent }}
                        </a>
                    </td>
                    <td class="p-1 border text-center text-sm">
                        <a href="{{ route('oficinas.pdfBienesOficina', $oficina->cod_ofi_ent) }}" class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 rounded" target="_blank">
                            Ver Bienes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Contenedor de la paginación -->
    <div class="pagination-container flex justify-center mt-4">
        {{ $oficinas->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>

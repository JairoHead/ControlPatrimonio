<div>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Código</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Color</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Marca</th>
                <th class="p-2 border">Modelo</th>
                <th class="p-2 border">Serie</th>
                <th class="p-2 border">Fecha Registro</th>
                <th class="p-2 border">Documento</th>
                <th class="p-2 border">Inventariado</th>
                <th class="p-2 border">Ubicación</th>
                <th class="p-2 border">Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bienes as $bien)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $bien->codbien }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->descripcio }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->color ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->estado ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->marca ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->modelo ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->serie ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->fec_reg ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->doc_alta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->inventariado ? 'Sí' : 'No' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $bien->ubicacioncompleta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">
                        <a href="{{ route('empleados.index', ['search' => $bien->nombrecompleto]) }}" class="text-blue-600 hover:underline">
                            {{ $bien->nombrecompleto}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Contenedor de la paginación -->
    <div class="pagination-container flex justify-center mt-4">
        {{ $bienes->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>

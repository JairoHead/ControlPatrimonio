<div>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Código</th>
                <th class="p-2 border">Inventario</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Color</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Marca</th>
                <th class="p-2 border">Modelo</th>
                <th class="p-2 border">Serie</th>
                <th class="p-2 border">Fecha Registro</th>
                <th class="p-2 border">Documento</th>
                <th class="p-2 border">Ubicación</th>
                <th class="p-2 border">Responsable</th>
                <th class="p-2 border">Área</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operaciones as $operacion)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $operacion->codbien }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->sit_binv }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->descripcio }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->color ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->est_bien ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->marca ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->modelo ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->serie ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->fec_reg ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->doc_alta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->ubicacioncompleta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->nombrecompleto ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ $operacion->codarea ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">
                        <!-- Botón para editar (abre modal) -->
                        <button class="editar-btn bg-gray-500 text-white px-2 py-1 rounded hover:bg-red-700 mb-2"
                                data-id="{{ $operacion->codbien }}">
                            Editar
                        </button>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Contenedor de la paginación -->
    <div class="pagination-container flex justify-center mt-4">
        {{ $operaciones->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>

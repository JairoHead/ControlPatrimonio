<div>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Código</th>
                <th class="p-2 border">Nombres</th>
                <th class="p-2 border">Apellido Paterno</th>
                <th class="p-2 border">Apellido Materno</th>
                <th class="p-2 border">Tipo de Documento</th>
                <th class="p-2 border">N° Documento</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $empleado->CODIGO }}</td>
                    <td class="p-1 border text-center text-sm">{{ $empleado->NOMBRES }}</td>
                    <td class="p-1 border text-center text-sm">{{ $empleado->APELLIDO_PATERNO }}</td>
                    <td class="p-1 border text-center text-sm">{{ $empleado->APELLIDO_MATERNO }}</td>
                    <td class="p-1 border text-center text-sm">{{ $empleado->TIPO_DOC_IDENTIDAD }}</td>
                    <td class="p-1 border text-center text-sm">{{ $empleado->NRO_DOC_IDENT_PERSONAL }}</td>
                    <td class="p-1 border text-center text-sm">
                        <a href="{{ route('empleados.pdfBienesEmpleado', $empleado->CODIGO) }}" class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 rounded" target="_blank">
                            Ver Bienes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container flex justify-center mt-4">
        {{ $empleados->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>
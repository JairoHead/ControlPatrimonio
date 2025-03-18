<div class="bg-white p-0 rounded-md">
    <h2 class="text-lg font-bold mb-2">Historial de Reportes Generados</h2>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Código Bien</th>
                <th class="p-2 border">Acción</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Detalle</th>
                <!-- Campos de mig_data -->
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
                <th class="p-2 border">Área</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $reporte)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <!-- Campos de reportes_patrimonio -->
                    <td class="p-1 border text-center text-sm">{{ $reporte->id }}</td>
                    <td class="p-1 border text-center text-sm">{{ $reporte->codigo }}</td>
                    <td class="p-1 border text-center text-sm">{{ $reporte->accion }}</td>
                    <td class="p-1 border text-center text-sm">{{ $reporte->fecha }}</td>
                    <td class="p-1 border text-center text-sm">{{ $reporte->detalle }}</td>
                    <!-- Campos de mig_data vía relación -->
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->descripcio ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->color ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->est_bien ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->marca ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->modelo ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->serie ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->fec_reg ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->doc_alta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ (optional($reporte->migData)->inventariado) ? 'Sí' : 'No' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->ubicacioncompleta ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->nombrecompleto ?? 'N/A' }}</td>
                    <td class="p-1 border text-center text-sm">{{ optional($reporte->migData)->codarea ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container flex justify-center mt-4">
        {{ $reportes->links('vendor.pagination.tailwind') }}
    </div>
</div>

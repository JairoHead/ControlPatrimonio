<div class="bg-white-100 p-0 rounded-md">
    <h2 class="text-lg font-bold mb-2">Resumen de Bienes</h2>
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-red-800 text-white">
                <th class="p-2 border">Área</th>
                <th class="p-2 border">Ubicación</th>
                <th class="p-2 border">Responsable</th>
                <th class="p-2 border">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resumen as $grupo)
                <tr class="border-b hover:bg-gray-100 even:bg-gray-200">
                    <td class="p-1 border text-center text-sm">{{ $grupo->codarea }}</td>
                    <td class="p-1 border text-center text-sm">{{ $grupo->ubicacioncompleta }}</td>
                    <td class="p-1 border text-center text-sm">{{ $grupo->nombrecompleto }}</td>
                    <td class="p-1 border text-center text-sm">{{ $grupo->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container flex justify-center mt-4">
        {{ $resumen->links('vendor.pagination.tailwind') }}
    </div>
</div>

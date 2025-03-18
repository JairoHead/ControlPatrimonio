<button class="generar-reporte-btn px-2 py-1 rounded text-white 
    @if($operacion->reporte_generado)
        bg-green-600 hover:bg-green-700
    @else
        bg-red-600 hover:bg-red-700
    @endif"
    data-id="{{ $operacion->codbien }}">
    @if($operacion->reporte_generado)
        Re-Generar
    @else
        Generar
    @endif
</button>

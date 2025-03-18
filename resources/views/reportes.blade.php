@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-0">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Reportes</h1>

    <!-- Formulario de búsqueda -->	
    <div class="mb-4">
        <form id="reportes-search-form">
            <div class="flex space-x-4">
                <input type="text"
                       id="reportes-search-input"
                       name="search"
                       placeholder="Buscar por código, área, responsable o detalle"
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                <button type="submit"
                        class="bg-red-800 text-white px-4 py-2 rounded-md hover:bg-red-900">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Pestañas -->
    <ul class="flex border-b mb-2">
        <li class="mr-1">
            <a href="#tab-resumen"
               class="tab-link inline-block py-2 px-4 bg-white text-red-800 font-semibold border-l border-t border-r rounded-t">
                Resumen
            </a>
        </li>
        <li class="mr-1">
            <a href="#tab-historial"
               class="tab-link inline-block py-2 px-4 bg-white text-red-800 font-semibold rounded-t">
                Historial de Reportes
            </a>
        </li>
    </ul>

    <!-- Contenido pestaña Resumen -->
    <div id="tab-resumen" class="tab-content">
        <div id="resumen-container">
            @include('profile.partials.resumen-table', ['resumen' => $resumen])
        </div>

        <!-- Botón para exportar SOLO el RESUMEN a PDF -->
        <div class="mt-4">
            <a id="pdf-resumen-link"
               href="{{ route('reportes.pdfSoloResumen', ['search' => request('search')]) }}"
               target="_blank"
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Ver PDF Resumen
            </a>
        </div>
    </div>

    <!-- Contenido pestaña Historial -->
    <div id="tab-historial" class="tab-content hidden">
        <div id="historial-container" class="overflow-x-auto"> @include('profile.partials.historial-reportes', ['reportes' => $historial])
        </div>

        <!-- Botón para exportar SOLO el HISTORIAL a PDF -->
        <div class="mt-4">
            <a id="pdf-historial-link"
               href="{{ route('reportes.pdfSoloHistorial', ['search' => request('search')]) }}"
               target="_blank"
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Ver PDF Historial
            </a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Manejo de pestañas
    $('.tab-link').on('click', function(e){
        e.preventDefault();
        // Ocultar todo el contenido
        $('.tab-content').addClass('hidden');
        // Quitar estilos activos
        $('.tab-link').removeClass('bg-gray-200').addClass('bg-white'); // Campo corregido: Cambiar a bg-red-600

        // Activar la pestaña actual
        let target = $(this).attr('href');
        $(target).removeClass('hidden');
        $(this).removeClass('bg-white').addClass('bg-gray-200'); // Campo corregido: Cambiar a bg-red-800
    });

    // Búsqueda en tiempo real:
    // Podemos usar un "submit" y un "keyup" con debounce
    let typingTimer;
    const doneTypingInterval = 300; // ms

    // on keyup
    $('#reportes-search-input').on('keyup', function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function(){
            doSearch();
        }, doneTypingInterval);
    });

    // on submit
    $('#reportes-search-form').on('submit', function(e){
        e.preventDefault();
        doSearch();
    });

    function doSearch(){
        let valSearch = $('#reportes-search-input').val();

        $.ajax({
            url: "{{ route('reportes.index') }}",
            type: "GET",
            data: { search: valSearch },
            success: function(response){
                // Actualizar Resumen e Historial
                $('#resumen-container').html(response.resumenHtml);
                $('#historial-container').html(response.historialHtml);

                // Lo más importante:
                // Actualizar los links de PDF con el nuevo 'search'
                let resumenURL = "{{ route('reportes.pdfSoloResumen') }}?search=" + encodeURIComponent(valSearch);
                $('#pdf-resumen-link').attr('href', resumenURL);

                let historialURL = "{{ route('reportes.pdfSoloHistorial') }}?search=" + encodeURIComponent(valSearch);
                $('#pdf-historial-link').attr('href', historialURL);
            },
            error: function(){
                alert('Error en la búsqueda');
            }
        });
    }

    // Al iniciar, también debemos sincronizar los enlaces PDF con el valor actual:
    let initialVal = $('#reportes-search-input').val() || '';
    let resumenInitURL = "{{ route('reportes.pdfSoloResumen') }}?search=" + encodeURIComponent(initialVal);
    $('#pdf-resumen-link').attr('href', resumenInitURL);

    let historialInitURL = "{{ route('reportes.pdfSoloHistorial') }}?search=" + encodeURIComponent(initialVal);
    $('#pdf-historial-link').attr('href', historialInitURL);

});
</script>
@endsection
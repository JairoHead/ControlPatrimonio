@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-0">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Consulta de Bienes</h1>

    <!-- Formulario de Búsqueda -->
    <div class="mb-4">
        <form id="search-form">
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <input 
                    type="text" 
                    id="search-input" 
                    name="search" 
                    placeholder="Buscar por código, descripción o responsable"
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
                >
                <button 
                    type="submit" 
                    class="mt-2 sm:mt-0 bg-red-800 text-white px-4 py-2 rounded-md hover:bg-red-900 transition"
                >
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Contenedor de la tabla y paginación (incluidos en el partial) -->
    <div id="bienes-table" class="overflow-x-auto">
        @include('profile.partials.consultas-table')
    </div>
</div>

<!-- Script para búsqueda en tiempo real y paginación AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function fetchData(search = '', page = 1) {
        $.ajax({
            url: "{{ route('consultas.index') }}",
            type: "GET",
            data: { search: search, page: page },
            success: function (response) {
                $("#bienes-table").html(response.html);
                $(".pagination-container").html(response.pagination);
            },
            error: function (xhr) {
                console.log("Error en AJAX:", xhr.responseText);
            }
        });
    }

    // Búsqueda en tiempo real con debounce
    let typingTimer;
    let doneTypingInterval = 300; // Milisegundos

    $('#search-input').on('keyup', function () {
        clearTimeout(typingTimer);
        let search = $(this).val();
        typingTimer = setTimeout(function () {
            fetchData(search);
        }, doneTypingInterval);
    });

    // Paginación AJAX
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let search = $('#search-input').val();
        fetchData(search, page);
    });

    // Evitar recarga al enviar el formulario
    $("#search-form").on("submit", function(event) {
        event.preventDefault();
        fetchData($('#search-input').val());
    });
});
</script>
@endsection

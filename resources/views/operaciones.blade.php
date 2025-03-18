@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-0">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Operaciones</h1>

    <!-- Formulario de Búsqueda -->
    <div class="mb-4">
        <form id="search-form">
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <input type="text" id="search-input" name="search" 
                       placeholder="Buscar por código, descripción, área, ubicación o responsable"
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                <button type="submit" 
                        class="mt-2 sm:mt-0 bg-red-800 text-white px-4 py-2 rounded-md hover:bg-red-900 transition">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Contenedor de la tabla de operaciones (partial) -->
    <div id="operaciones-table" class="overflow-x-auto">
        @include('profile.partials.operaciones-table')
    </div>
</div>

<!-- Modal de Edición -->
<div id="modal-editar" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white p-6 rounded-md w-1/2 max-h-[80vh] overflow-y-auto">
    <h2 class="text-xl font-bold mb-4">Editar Operación</h2>
    <form id="editar-form">
      @csrf  <!-- Incluye el token CSRF -->
      <input type="hidden" name="id" id="editar-id">
      
      <div class="mb-4">
        <label for="editar-descripcio" class="block text-gray-700">Descripción:</label>
        <input type="text" name="descripcio" id="editar-descripcio" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-color" class="block text-gray-700">Color:</label>
        <input type="text" name="color" id="editar-color" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-est_bien" class="block text-gray-700">Estado:</label>
        <input type="text" name="est_bien" id="editar-est_bien" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-marca" class="block text-gray-700">Marca:</label>
        <input type="text" name="marca" id="editar-marca" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-modelo" class="block text-gray-700">Modelo:</label>
        <input type="text" name="modelo" id="editar-modelo" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-doc_alta" class="block text-gray-700">Documento:</label>
        <input type="text" name="doc_alta" id="editar-doc_alta" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-ubicacioncompleta" class="block text-gray-700">Ubicación:</label>
        <input type="text" name="ubicacioncompleta" id="editar-ubicacioncompleta" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-nombrecompleto" class="block text-gray-700">Responsable:</label>
        <input type="text" name="nombrecompleto" id="editar-nombrecompleto" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="editar-codarea" class="block text-gray-700">Área:</label>
        <input type="text" name="codarea" id="editar-codarea" class="w-full border rounded px-3 py-2">
      </div>
      
      <div class="flex justify-end">
        <button type="button" id="cerrar-modal" class="mr-4 px-4 py-2 rounded bg-gray-400 text-white hover:bg-gray-500">Cancelar</button>
        <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Contenedor para los mensajes flotantes (toast) -->
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<!-- Scripts: Búsqueda, Paginación, Edición y Generación de Reporte -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Función para mostrar un mensaje flotante (toast)
function showToast(message) {
    let toastEl = $(`
        <div class="bg-green-600 text-white px-4 py-2 rounded-md shadow mb-2 fade-in">
            ${message}
        </div>
    `);
    // Añadimos el toast al contenedor
    $("#toast-container").append(toastEl);

    // Lo removemos después de 1 segundo
    setTimeout(() => {
        toastEl.remove();
    }, 1000);
}

$(document).ready(function () {
    // Función para refrescar la tabla (buscar/paginar)
    function fetchData(search = '', page = 1) {
        $.ajax({
            url: "{{ route('operaciones.index') }}",
            type: "GET",
            data: { search: search, page: page },
            success: function (response) {
                $("#operaciones-table").html(response.html);
                $(".pagination-container").html(response.pagination);
            },
            error: function (xhr) {
                console.log("Error en AJAX:", xhr.responseText);
            }
        });
    }

    // Búsqueda en tiempo real con debounce
    let typingTimer;
    let doneTypingInterval = 300;

    $('#search-input').on('keyup', function () {
        clearTimeout(typingTimer);
        let search = $(this).val();
        typingTimer = setTimeout(function () {
            fetchData(search);
        }, doneTypingInterval);
    });

    // Manejo de la paginación AJAX
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let search = $('#search-input').val();
        fetchData(search, page);
    });

    // Al enviar el formulario de búsqueda (botón "Buscar")
    $("#search-form").on("submit", function(event) {
        event.preventDefault();
        fetchData($('#search-input').val());
    });

    // ============================
    // Modal: Abrir para Editar
    // ============================
    $(document).on('click', '.editar-btn', function(){
        let row = $(this).closest('tr');
        // Asumiendo que las columnas en la tabla son:
        // 0: Código(ID?), 1: Inventario, 2: Descripción, 3: Color, 4: Estado,
        // 5: Marca, 6: Modelo, 7: Serie, 8: Fecha Registro, 9: Documento,
        // 10: Inventariado, 11: Ubicación, 12: Responsable, 13: Área, ...
        let id = row.find('td').eq(0).text().trim();
        let descripcio = row.find('td').eq(2).text().trim();
        let color = row.find('td').eq(3).text().trim();
        let est_bien = row.find('td').eq(4).text().trim();
        let marca = row.find('td').eq(5).text().trim();
        let modelo = row.find('td').eq(6).text().trim();
        let doc_alta = row.find('td').eq(9).text().trim();
        let ubicacioncompleta = row.find('td').eq(10).text().trim();
        let nombrecompleto = row.find('td').eq(11).text().trim();
        let codarea = row.find('td').eq(12).text().trim();

        $('#editar-id').val(id);
        $('#editar-descripcio').val(descripcio);
        $('#editar-color').val(color);
        $('#editar-est_bien').val(est_bien);
        $('#editar-marca').val(marca);
        $('#editar-modelo').val(modelo);
        $('#editar-doc_alta').val(doc_alta);
        $('#editar-ubicacioncompleta').val(ubicacioncompleta);
        $('#editar-nombrecompleto').val(nombrecompleto);
        $('#editar-codarea').val(codarea);

        // Mostrar el modal
        $('#modal-editar').removeClass('hidden');
    });

    // Cierra el modal
    $('#cerrar-modal').on('click', function(){
        $('#modal-editar').addClass('hidden');
    });

    // ============================
    // Guardar cambios (modal)
    // ============================
    $('#editar-form').on('submit', function(e){
        e.preventDefault();
        let id = $('#editar-id').val();
        let data = $(this).serialize();

        $.ajax({
            url: '{{ route("operaciones.update", ":id") }}'.replace(':id', id),
            type: 'PATCH',
            data: data,
            success: function(response){
                showToast('Operación actualizada correctamente');
                $('#modal-editar').addClass('hidden');
                fetchData($('#search-input').val()); // refrescar tabla
            },
            error: function(){
                showToast('Error al guardar los cambios');
            }
        });
    });

    // ============================
    // Generar/Re-Generar Reporte
    // ============================
    $(document).on('click', '.generar-reporte-btn', function(){
        let btn = $(this);
        let id = btn.data('id'); // data-id = codbien

        $.ajax({
            url: '{{ route("operaciones.generarReporte", ":id") }}'.replace(':id', id),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Reemplazar el botón con el nuevo HTML devuelto
                btn.replaceWith(response.buttonHtml);
                showToast('Reporte generado/actualizado correctamente');
            },
            error: function() {
                showToast('Error al generar el reporte');
            }
        });
    });
});
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="relative w-full overflow-hidden rounded-lg shadow-md">
        <div id="image-carousel" class="relative">
            <div class="absolute inset-0 flex transition-opacity duration-700">
                <img src="/images/user_avatar.png" alt="Imagen 1" class="max-w-full h-80 object-cover">
            </div>
            <div class="absolute inset-0 flex transition-opacity duration-700 opacity-0">
                <img src="/images/user_avatar.png" alt="Imagen 2" class="max-w-full h-80 object-cover">
            </div>
            <div class="absolute inset-0 flex transition-opacity duration-700 opacity-0">
                <img src="/images/user_avatar.png" alt="Imagen 3" class="max-w-full h-80 object-cover">
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <h1 class="text-3xl font-bold">Bienvenido al Sistema de Inventario Patrimonial</h1>
        <p class="text-gray-600 mt-2">
            Gestiona y consulta los bienes, ubicaciones y responsables de la Universidad Nacional del Santa.
        </p>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Área de Control Patrimonial</h2>
            <p class="text-gray-700">
                El Área de Control Patrimonial de la Universidad Nacional del Santa se encarga de la gestión y el registro de todos los bienes de la institución.
                Nuestro objetivo es asegurar el uso eficiente y responsable de los recursos, manteniendo un inventario actualizado y preciso.
            </p>
            <p class="text-gray-700 mt-4">
                Nos esforzamos por brindar un servicio de calidad a toda la comunidad universitaria, facilitando la consulta y la gestión de la información patrimonial.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('image-carousel');
        const images = carousel.querySelectorAll('div');
        let currentImage = 0;

        function showImage(index) {
            images.forEach((image, i) => {
                image.classList.toggle('opacity-0', i !== index);
            });
        }

        function nextImage() {
            currentImage = (currentImage + 1) % images.length;
            showImage(currentImage);
        }

        showImage(currentImage);
        setInterval(nextImage, 3000); // Cambiar cada 3 segundos
    });
</script>
@endsection
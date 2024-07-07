<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenid@ a la DuoDent</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <?php
    require_once 'layout/nav.php';
    ?>
    <!-- Banner y Contenido Principal -->
    <main class="bg-cover bg-center bg-gradient-to-b from-blue-300 to-white bg-opacity-75 py-3 md:py-6">
        <div class="py-30">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-start text-white px-2 md:px-14">
                <div class="md:w-2/4 md:pr-8"> <!-- Columna para el texto y botones -->
                    <h2 class="text-5xl text-black mb-4">¡Bienvenido a la clínica DuoDent!</h2>
                    <div class="flex flex-col">
                        <p class="text-md text-black mb-4">Agenda tu cita de manera fácil y accesible desde cualquier lugar. Por favor, navega a través de nuestro sitio para encontrar la información y los servicios que necesitas.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-blue-600 text-sm text-white px-4 py-2 rounded-lg hover:bg-blue-700">Más información</a>
                        </div>
                    </div>
                </div>

                <div class="md:w-2/4 md:flex md:justify-end"> <!-- Columna para la imagen a la derecha (visible solo en pantallas medianas y grandes) -->
                    <img src="images/imagen.png" alt="Imagen a la derecha" class="md:ml-8">
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white py-12">
        <div class="container mx-auto px-6 md:px-16">
            <h3 class="text-3xl text-gray-800 mb-6">Nuestros Servicios</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Servicios visibles inicialmente -->
                <div class="servicio bg-gray-100 rounded-lg p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Odontología General</h4>
                    <p class="text-gray-700">Servicios de rutina, limpiezas, exámenes dentales, etc.</p>
                </div>

                <div class="servicio bg-gray-100 rounded-lg p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Ortodoncia</h4>
                    <p class="text-gray-700">Tratamientos de alineación dental, brackets, ortodoncia invisible, etc.</p>
                </div>

            </div>
        </div>
    </section>


    <?php
    require_once 'layout/footer.php';
    ?>
</body>

</html>
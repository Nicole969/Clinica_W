<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Tipo de Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Crear Nuevo Tipo de Medicamento</h2>

        <form action="crear_tipo_medicamento.php" method="POST">
            <div class="mb-4">
                <label for="nomTipoMedi" class="block text-gray-700">Nombre del Tipo de Medicamento:</label>
                <input type="text" name="nomTipoMedi" id="nomTipoMedi" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="text-center">
                <input type="submit" value="Crear Tipo de Medicamento" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

</body>
</html>

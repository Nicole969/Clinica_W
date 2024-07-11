<?php
require_once 'controllers/ServicioController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

$servicioController = new ServicioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $servicio = $_POST['servicio'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $resultado = $servicioController->editarServicio($id, $servicio, $descripcion, $costo);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    $id = $_GET['id'];
    $servicio = $servicioController->obtenerServicioPorId($id);
    if (!$servicio) {
        die("Servicio no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Servicio</h2>

        <form action="editar_servicio.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $servicio['ID_Servicio']; ?>">
            
            <div class="mb-4">
                <label for="servicio" class="block text-sm font-medium text-gray-700">Nombre del Servicio</label>
                <input type="text" name="servicio" id="servicio" value="<?php echo $servicio['Servicio']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?php echo $servicio['Descripcion']; ?></textarea>
            </div>
            
            <div class="mb-4">
                <label for="costo" class="block text-sm font-medium text-gray-700">Costo</label>
                <input type="text" name="costo" id="costo" value="<?php echo $servicio['Costo']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<?php
require_once 'controllers/AreaController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

$areaController = new AreaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $resultado = $areaController->editarArea($id, $nombre, $descripcion);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    $id = $_GET['id'];
    $area = $areaController->obtenerAreaPorId($id);
    if (!$area) {
        die("Área no encontrada.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Área</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Área</h2>

        <form action="editar_area.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $area['ID_Area']; ?>">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre del Área:</label>
                <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $area['Nombre']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500"><?php echo $area['Descripcion']; ?></textarea>
            </div>
            <div class="text-center">
                <input type="submit" value="Guardar Cambios" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

</body>
</html>

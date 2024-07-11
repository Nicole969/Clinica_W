<?php
require_once 'controllers/TiposMedicamentosController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

$tipoMedicamentoController = new TipoMedicamentoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nomTipoMedi'];
    $descripcion = $_POST['descripcion'];
    $resultado = $tipoMedicamentoController->editarTipoMedicamento($id, $nombre, $descripcion);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    $id = $_GET['id'];
    $tipoMedicamento = $tipoMedicamentoController->obtenerTipoMedicamentoPorId($id);
    if (!$tipoMedicamento) {
        die("Tipo de medicamento no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Tipo de Medicamento</h2>

        <form action="editar_tipo_medicamento.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $tipoMedicamento['ID_TipoMedi']; ?>">
            
            <div class="mb-4">
                <label for="nomTipoMedi" class="block text-sm font-medium text-gray-700">Nombre del Tipo de Medicamento</label>
                <input type="text" name="nomTipoMedi" id="nomTipoMedi" value="<?php echo $tipoMedicamento['NomTipoMed']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?php echo $tipoMedicamento['Descripcion']; ?></textarea>
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

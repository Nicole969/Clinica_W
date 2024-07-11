<?php
require_once 'controllers/MedicamentosController.php';

require_once "controllers/TiposMedicamentosController.php";

$tipoMedicamentoController = new TipoMedicamentoController();
$tiposMedicamentos = $tipoMedicamentoController->mostrarTiposMedicamentos();
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'admin') {
    die("Acceso denegado.");
}

$medicamentoController = new MedicamentoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_medi = $_POST['id_medi'];
    $nombreMedi = $_POST['nombreMedi'];
    $presentacion = $_POST['presentacion'];
    $fabricacion = $_POST['fabricacion'];
    $preCompra = $_POST['preCompra'];
    $precVenta = $_POST['precVenta'];
    $stock = $_POST['stock'];
    $fechProduccion = $_POST['fechProduccion'];
    $fechVencimiento = $_POST['fechVencimiento'];
    $id_tipoMedi = $_POST['tipoMedicamento'];

    $resultado = $medicamentoController->editarMedicamento($id_medi, $nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
} else {
    // Obtener el ID_Medi desde $_GET
    $id_medi = $_GET['id'];

    // Obtener el medicamento por ID
    $medicamento = $medicamentoController->obtenerMedicamentoPorId($id_medi);
    if (!$medicamento) {
        die("Medicamento no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Medicamento</h2>

        <form action="editar_medicamento.php" method="POST">
            <input type="hidden" name="id_medi" value="<?php echo $medicamento['ID_Medi']; ?>">
            <div class="mb-4">
                <label for="nombreMedi" class="block text-gray-700">Nombre del Medicamento:</label>
                <input type="text" name="nombreMedi" id="nombreMedi" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo htmlspecialchars($medicamento['NombreMedi']); ?>" required>
            </div>
            <div class="mb-4">
                <label for="presentacion" class="block text-gray-700">Presentación:</label>
                <input type="text" name="presentacion" id="presentacion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo htmlspecialchars($medicamento['Presentacion']); ?>" required>
            </div>
            <div class="mb-4">
            <label for="fabricacion" class="block text-gray-700">Fabricante:</label>
            <input type="text" name="fabricacion" id="fabricacion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="preCompra" class="block text-gray-700">Precio de Compra:</label>
                <input type="number" name="preCompra" id="preCompra" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $medicamento['PreCompra']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="precVenta" class="block text-gray-700">Precio de Venta:</label>
                <input type="number" name="precVenta" id="precVenta" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $medicamento['PrecVenta']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $medicamento['Stock']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="fechProduccion" class="block text-gray-700">Fecha de Producción:</label>
                <input type="date" name="fechProduccion" id="fechProduccion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $medicamento['FechProduccion']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="fechVencimiento" class="block text-gray-700">Fecha de Vencimiento:</label>
                <input type="date" name="fechVencimiento" id="fechVencimiento" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" value="<?php echo $medicamento['FechVencimiento']; ?>" required>
            </div>

            <div class="mb-4">
              <label for="tipoMedicamento" class="block text-gray-700">Tipo de Medicamento:</label>
                <select name="tipoMedicamento" id="tipoMedicamento" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
               <?php foreach ($tiposMedicamentos as $tipoMedicamento): ?>
            <option value="<?php echo $tipoMedicamento['ID_TipoMedi']; ?>"><?php echo $tipoMedicamento['NomTipoMed']; ?></option>
            <?php endforeach; ?>
          </select>

            <div class="text-center">
                <input type="submit" value="Guardar Cambios" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

</body>
</html>

<?php

require_once "controllers/TiposMedicamentosController.php";

$tipoMedicamentoController = new TipoMedicamentoController();
$tiposMedicamentos = $tipoMedicamentoController->mostrarTiposMedicamentos();

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
    <title>Nuevo Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Crear Nuevo Medicamento</h2>

        <form action="crear_medicamento.php" method="POST">
            <div class="mb-4">
                <label for="nombreMedi" class="block text-gray-700">Nombre del Medicamento:</label>
                <input type="text" name="nombreMedi" id="nombreMedi" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="presentacion" class="block text-gray-700">Presentación:</label>
                <input type="text" name="presentacion" id="presentacion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
            <label for="fabricacion" class="block text-gray-700">Fabricante:</label>
            <input type="text" name="fabricacion" id="fabricacion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="preCompra" class="block text-gray-700">Precio de Compra:</label>
                <input type="number" name="preCompra" id="preCompra" step="0.01" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="precVenta" class="block text-gray-700">Precio de Venta:</label>
                <input type="number" name="precVenta" id="precVenta" step="0.01" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="fechProduccion" class="block text-gray-700">Fecha de Producción:</label>
                <input type="date" name="fechProduccion" id="fechProduccion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="fechVencimiento" class="block text-gray-700">Fecha de Vencimiento:</label>
                <input type="date" name="fechVencimiento" id="fechVencimiento" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
              <label for="tipoMedicamento" class="block text-gray-700">Tipo de Medicamento:</label>
                <select name="tipoMedicamento" id="tipoMedicamento" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
               <?php foreach ($tiposMedicamentos as $tipoMedicamento): ?>
            <option value="<?php echo $tipoMedicamento['ID_TipoMedi']; ?>"><?php echo $tipoMedicamento['NomTipoMed']; ?></option>
        <?php endforeach; ?>
    </select>
</div>




            <div class="text-center">
                <input type="submit" value="Crear Medicamento" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

</body>
</html>

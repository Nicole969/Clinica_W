<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

require_once 'controllers/AreaController.php';
require_once 'controllers/RoleController.php';

$areaController = new AreaController();
$areas = $areaController->mostrarAreas();

$roleController = new RoleController();
$roles = $roleController->mostrarRoles();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .modal-backdrop {
            opacity: 0.5 !important;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Crear Nuevo Médico</h2>

        <form action="crear_medico.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nombre de Usuario:</label>
                <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="clave" class="block text-gray-700">Clave:</label>
                <input type="password" name="clave" id="clave" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="confirmClave" class="block text-gray-700">Confirmar Clave:</label>
                <input type="password" name="confirmClave" id="confirmClave" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="correo" class="block text-gray-700">Correo:</label>
                <input type="email" name="correo" id="correo" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="apellidos" class="block text-gray-700">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="celular" class="block text-gray-700">Celular:</label>
                <input type="text" name="celular" id="celular" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-gray-700">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="especialidad" class="block text-gray-700">Especialidad:</label>
                <input type="text" name="especialidad" id="especialidad" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="fecha" class="block text-gray-700">Fecha de Nacimiento:</label>
                <input type="date" name="fecha" id="fecha" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="dni" class="block text-gray-700">DNI:</label>
                <input type="text" name="dni" id="dni" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="area" class="block text-gray-700">Área:</label>
                <select name="area" id="area" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?php echo $area['ID_Area']; ?>"><?php echo $area['Nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-gray-700">Rol:</label>
                <select name="rol" id="rol" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['ID_Rol']; ?>"><?php echo $rol['Cargo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="sueldo" class="block text-gray-700">Sueldo Empleado:</label>
                <input type="text" name="sueldo" id="sueldo" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="fecha_contrato" class="block text-gray-700">Fecha de Contrato:</label>
                <input type="date" name="fecha_contrato" id="fecha_contrato" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="text-center">
                <input type="submit" value="Crear Médico" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

</body>
</html>

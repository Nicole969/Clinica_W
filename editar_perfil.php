<?php
require_once 'controllers/PerfilController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

$perfilController = new PerfilController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $especialidad = $_POST['especialidad'];
    $fechaNac = $_POST['fechaNac'];
    $fechaContrato = $_POST['fechaContrato'];
    $sueldoEmpleado = $_POST['sueldoEmpleado'];
    $dni = $_POST['dni'];
    $idReportes = $_POST['idReportes'];
    $idRol = $_POST['idRol'];
    $idArea = $_POST['idArea'];
    
    $resultado = $perfilController->editarPerfil($id, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea);

    echo "<script>
    alert('$resultado');
    window.location.href = 'perfil.php';
    </script>";
} else {
    $id = $_GET['id'];
    $perfil = $perfilController->obtenerPerfilPorId($id);
    if (!$perfil) {
        die("Perfil no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil de Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Perfil de Médico</h2>

        <form action="editar_perfil.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($perfil['ID_Perfil']); ?>">
            
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($perfil['Nombre']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" value="<?php echo htmlspecialchars($perfil['Apellidos']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                <input type="text" name="celular" id="celular" value="<?php echo htmlspecialchars($perfil['Celular']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($perfil['Direccion']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                <input type="text" name="especialidad" id="especialidad" value="<?php echo htmlspecialchars($perfil['Especialidad']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="fechaNac" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fechaNac" id="fechaNac" value="<?php echo htmlspecialchars($perfil['FechaNac']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="fechaContrato" class="block text-sm font-medium text-gray-700">Fecha de Contrato</label>
                <input type="date" name="fechaContrato" id="fechaContrato" value="<?php echo htmlspecialchars($perfil['FechaContrato']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="sueldoEmpleado" class="block text-sm font-medium text-gray-700">Sueldo del Empleado</label>
                <input type="text" name="sueldoEmpleado" id="sueldoEmpleado" value="<?php echo htmlspecialchars($perfil['SueldoEmpleado']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                <input type="text" name="dni" id="dni" value="<?php echo htmlspecialchars($perfil['DNI']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="idReportes" class="block text-sm font-medium text-gray-700">ID de Reportes</label>
                <input type="text" name="idReportes" id="idReportes" value="<?php echo htmlspecialchars($perfil['ID_Reportes']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="idRol" class="block text-sm font-medium text-gray-700">ID de Rol</label>
                <input type="text" name="idRol" id="idRol" value="<?php echo htmlspecialchars($perfil['ID_Rol']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="idArea" class="block text-sm font-medium text-gray-700">ID de Área</label>
                <input type="text" name="idArea" id="idArea" value="<?php echo htmlspecialchars($perfil['ID_Area']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Guardar Cambios</button>
                <a href="listar_perfiles.php" class="ml-4 inline-block py-2 px-4 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

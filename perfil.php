<?php

require_once "controllers/PerfilController.php";
session_start();
$perfilController = new PerfilController();
$perfiles = $perfilController->mostrarPerfiles();


if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    session_start();
    header("location: login.php");
    exit();
}

if ($_SESSION["tipo"] == "paciente") {
    header("location: home.php");
    exit();
}

?>
<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>




<body>


    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Lista de Perfiles Médicos</h2>

            <div class="shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Apellidos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Especialidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Celular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Dirección</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Fecha de Nacimiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Fecha de Contrato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Sueldo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">DNI</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID de Área</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($perfiles as $perfil) : ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['Nombre']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['Apellidos']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['Especialidad']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['Celular']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['Direccion']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['FechaNac']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['FechaContrato']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['SueldoEmpleado']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['DNI']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($perfil['ID_Area']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="editar_perfil.php?id=<?php echo $perfil['ID_Perfil']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600">Editar</a>
                                    <a href="eliminar_perfil.php?id=<?php echo $perfil['ID_Perfil']; ?>" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" onclick="return confirm('¿Estás seguro de eliminar este perfil médico?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>
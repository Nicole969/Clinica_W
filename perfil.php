<?php

require_once "controllers/PerfilController.php";

$perfilController = new PerfilController();
$perfiles = $perfilController->mostrarPerfiles();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Clínica - Lista de Perfiles Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<body class="bg-gray-100">
    <nav class="flex justify-center space-x-4 mb-6">
        <a href="dashboard.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Panel</a>
        <a href="admedicos.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Médicos</a>
        <a href="perfil.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
    </nav>


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
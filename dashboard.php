<?php
session_start();

require_once "controllers/UsuarioController.php";
require_once "controllers/CitaController.php";
require_once "controllers/AreaController.php";
require_once "controllers/ServicioController.php";
require_once "controllers/MedicamentosController.php";
require_once "controllers/TiposMedicamentosController.php";

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->mostrarTodos();
$pacientes = $usuarioController->mostrarPaciente();
$medicos = $usuarioController->mostrarMedicos();
$citaController = new CitasController();
$citas = $citaController->mostrar();
$total_usuarios = $usuarioController->cantidadUser();

session_start();

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<div class="bg-gray-100 h-full">

    <div class="bg-gray-100 py-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Usuarios registrados</dt>

                    
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl"><?php echo $total_usuarios; ?></dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Assets under holding</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">$119 trillion</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">New users annually</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">46,000</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Botón para crear un nuevo médico -->
    <div class="text-center my-4">
        <a href="medicos.php" class="bg-blue-500 text-white py-2 px-4 rounded">Crear Nuevo Médico</a>
    </div>


    <!-- Pacientes y Medicos -->
    <div class="p-6 bg-gray-100">
        <div class="text-center flex gap-x-16 justify-center">
            <!-- Lista de pacientes -->
            <div class="mb-6">
                <h2 class="text-xl mb-4">Lista de Pacientes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Correos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($pacientes as $paciente) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $paciente["Username"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $paciente["Correo"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $paciente["Tipo"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Lista de medicos -->
            <div class="">
                <h2 class="text-xl mb-4">Lista de Médicos</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Correos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($medicos as $medico) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $medico["Username"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $medico["Correo"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $medico["Tipo"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Contenedor principal con borde -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 flex justify-between">
    <!-- Sección de Medicamentos -->
    <div class="border border-gray-300 p-4 rounded-lg shadow-lg max-w-lg w-1/2">
        <!-- Botón para agregar un nuevo medicamento -->
        <div class="text-center my-4">
            <a href="medicamentos.php" class="bg-blue-500 text-white py-2 px-4 rounded">Agregar Nuevo Medicamento</a>
        </div>

        <!-- Lista de Medicamentos -->
        <div class="overflow-x-auto">
            <h2 class="text-xl mb-4 text-center">Lista de Medicamentos</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Presentación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fabricación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Precio Compra</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Precio Venta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo Medicamento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($medicamentos as $medicamento): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["NombreMedi"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["Presentacion"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["Fabricacion"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["PreCompra"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["PrecVenta"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["Stock"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $medicamento["ID_TipoMedi"] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="editar_medicamento.php?id=<?php echo $medicamento['ID_Medi']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Editar</a>
                                <a href="eliminar_medicamento.php?id=<?php echo $medicamento['ID_Medi']; ?>" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de eliminar este medicamento?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección de Tipos de Medicamentos -->
    <div class="border border-gray-300 p-4 rounded-lg shadow-lg max-w-lg w-1/2">
        <!-- Botón para agregar un nuevo tipo de medicamento -->
        <div class="text-center my-4">
            <a href="TipoMedicamento.php" class="bg-blue-500 text-white py-2 px-4 rounded">Agregar Nuevo Tipo de Medicamento</a>
        </div>

        <!-- Lista de Tipos de Medicamentos -->
        <div class="overflow-x-auto">
            <h2 class="text-xl mb-4 text-center">Lista de Tipos de Medicamentos</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($tiposMedicamentos as $tipoMedicamento): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $tipoMedicamento["NomTipoMed"]; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $tipoMedicamento["Descripcion"]; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="editar_tipo_medicamento.php?id=<?php echo $tipoMedicamento['ID_TipoMedi']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Editar</a>
                                <a href="eliminar_tipo_medicamento.php?id=<?php echo $tipoMedicamento['ID_TipoMedi']; ?>" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de eliminar este tipo de medicamento?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Contenedor principal con borde -->
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between">
        <!-- Sección de Áreas -->
        <div class="border border-gray-300 p-4 rounded-lg shadow-lg max-w-lg mx-auto mt-8 w-1/2">
            <!-- Botón para crear una nueva área -->
            <div class="text-center my-4">
                <a href="Area.php" class="bg-blue-500 text-white py-2 px-4 rounded">Crear Nueva Área</a>
            </div>

            <!-- Lista de Áreas -->
            <div class="overflow-x-auto">
                <h2 class="text-xl mb-4 text-center">Lista de Áreas</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($areas as $area): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $area["Nombre"]; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $area["Descripcion"]; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="editar_area.php?id=<?php echo $area['ID_Area']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Editar</a>
                                    <a href="eliminar_area.php?id=<?php echo $area['ID_Area']; ?>" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de eliminar esta área?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección de Servicios -->
        <div class="border border-gray-300 p-4 rounded-lg shadow-lg max-w-md mx-auto mt-8 w-1/2">
            <!-- Botón para crear un nuevo servicio -->
            <div class="text-center my-4">
                <a href="Servicio.php" class="bg-blue-500 text-white py-2 px-4 rounded">Crear Nuevo Servicio</a>
            </div>

            <!-- Lista de Servicios -->
            <div class="overflow-x-auto">
                <h2 class="text-xl mb-4 text-center">Lista de Servicios</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Servicio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Costo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($servicios as $servicio): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $servicio["Servicio"]; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $servicio["Descripcion"]; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $servicio["Costo"]; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="editar_servicio.php?id=<?php echo $servicio['ID_Servicio']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Editar</a>
                                    <a href="eliminar_servicio.php?id=<?php echo $servicio['ID_Servicio']; ?>" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de eliminar este servicio?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


        <div class="p-6 bg-gray-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl">Citas Pendientes</h2>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar..." class="p-2 border rounded">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Asunto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripcion</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            foreach ($citas as $cita) :
                                $estadoClass = '';
                                if ($cita["Estado"] == "Pendiente") {
                                    $estadoClass = 'bg-yellow-300 text-yellow-600';
                                } elseif ($cita["Estado"] == "Confirmada") {
                                    $estadoClass = 'bg-green-300 text-green-600';
                                }
                            ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap<?php echo $estadoClass ?>"><?php echo $cita["Estado"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $cita["Asunto"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $cita["Descripcion"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $cita["Fecha"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $cita["Hora"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                // Add any customization options here
            });
        });
    </script>

</div>

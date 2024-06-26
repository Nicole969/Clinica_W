<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/CitaController.php";

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->mostrarTodos();
$pacientes = $usuarioController->mostrarPaciente();
$medicos = $usuarioController->mostrarMedicos();
$citaController = new CitasController();
$citas = $citaController->mostrar();

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    session_start();
    header("location: login.php");
}

if ($_SESSION["tipo"] == "paciente") {
    header("location: home.php");
}

?>
<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>


<div class="bg-gray-100">

    <div class="bg-gray-100 py-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Transactions every 24 hours</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">44 million</dd>
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 p-4 w-full">
        <div class="p-6 bg-gray-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 ">
                <h2 class="text-2xl font-bold mb-4">Example Datatable</h2>
                <table id="example" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Descripcion</th>
                            <th class="px-4 py-2">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citas as $cita) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo $cita["Asunto"] ?></td>
                                <td class="border px-4 py-2"><?php echo $cita["Descripcion"] ?></td>
                                <td class="border px-4 py-2"><?php echo $cita["Fecha"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-6 bg-gray-100">
            <div class="p-2 bg-gray-100">
                <h2>Lista de pacientes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Correos</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientes as $paciente) : ?>
                            <tr>
                                <td><?php echo $paciente["Username"] ?></td>
                                <td><?php echo $paciente["Correo"] ?></td>
                                <td><?php echo $paciente["tipo"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-2 bg-gray-100">
                <h2>Lista de Medicos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Correos</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicos as $medico) : ?>
                            <tr>
                                <td><?php echo $medico["Username"] ?></td>
                                <td><?php echo $medico["Correo"] ?></td>
                                <td><?php echo $medico["tipo"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
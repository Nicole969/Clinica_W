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
                    <dt class="text-base leading-7 text-gray-600">Usuarios registrados</dt>
                    
                    <?php
                    // Establecer conexión a la base de datos (ejemplo básico)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "bdclinica";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener la cantidad de usuarios registrados
                    $sql = "SELECT COUNT(*) AS total_usuarios FROM user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Obtener el resultado como arreglo asociativo
                        $row = $result->fetch_assoc();
                        $total_usuarios = $row['total_usuarios'];
                    } else {
                        $total_usuarios = 0; // Si no hay resultados, se establece a cero
                    }

                    // Cerrar conexión
                    $conn->close();
                ?>
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
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $paciente["tipo"] ?></td>
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
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $medico["tipo"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
                                <?php foreach ($citas as $cita) : 
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
<?php
// Incluir controladores necesarios
require_once "models/Horarios.php";
require_once "controllers/HorarioController.php";

// Iniciar sesión
session_start();

if (!isset($_SESSION["id"])) {
    header("location: login.php");
    exit;
}

if ($_SESSION["tipo"] == "paciente") {
    // Si el usuario es un paciente, redirigir al home
    header("location: home.php");
    exit;
}

// Asegurarse de que el ID del usuario esté disponible
$id = $_SESSION["id"];
$hora = new HorarioController();
$horarios = $hora->mostrarMisHorarios($id);

// Formulario de horario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diaSemana = $_POST['diaSemana'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $id_user = $_POST['id_user'];

    $horariosModel = new Horarios();
    if ($horariosModel->crearHorario($diaSemana, $horaInicio, $horaFin, $id_user)) {
        // Redirigir para evitar la reenvío del formulario
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error al guardar el horario.";
    }
}
?>

<body class="">
    <?php
    require_once 'layout/header.php';
    require_once 'layout/nav.php';
    ?>

    <main class="bg-cover bg-center bg-gradient-to-b from-blue-300 to-white bg-opacity-75 py-3 md:py-6 h-screen px-4">
        <div class="flex justify-end">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-4">
                <?php if ($_SESSION["tipo"] == "medico"): ?>
                    <!-- Botón del formulario -->
                    <div class="flex justify-end">
                        <div onclick="mostrarFormularioHorario()" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                            Ingresar Horario
                        </div>
                    </div>
                <?php endif; ?>

                <h2 class="text-xl mt-4 mb-4">Mi Horario</h2>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Día</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Horario de Inicio</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Horario Final</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($horarios as $horario) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $horario["diaSemana"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $horario["horaInicio"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $horario["horaFin"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Formulario Modal -->
                <div id="formularioHorarioModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md relative">
                        <button onclick="cerrarFormularioHorario()" class="absolute top-8 right-8 text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <form action="" method="post" class="space-y-4 mt-8">
                            <h2 class="text-2xl text-center text-gray-800 mb-8">Ingresar Horario</h2>

                            <div class="flex flex-col space-y-2 items-center">
                                <label for="diaSemana" class="text-sm font-semibold text-gray-600">Día de la Semana:</label>
                                <select name="diaSemana" id="diaSemana" class="block w-full max-w-xs py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-center">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sábado">Sábado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>
                            </div>

                            <div class="flex flex-col space-y-2 items-center">
                                <label for="horaInicio" class="text-sm font-semibold text-gray-600">Hora de Inicio:</label>
                                <input type="time" name="horaInicio" id="horaInicio" required class="block w-full max-w-xs py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-center">
                            </div>

                            <div class="flex flex-col space-y-2 items-center">
                                <label for="horaFin" class="text-sm font-semibold text-gray-600">Hora de Fin:</label>
                                <input type="time" name="horaFin" id="horaFin" required class="block w-full max-w-xs py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-center">
                            </div>

                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                            
                            <div class="flex justify-center mt-8">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                                    Guardar Horario
                                </button>
                            </div>

                        </form>

                    </div>
                </div>



            </div>
        </div>
    </main>

    <script>
        function mostrarFormularioHorario() {
            var modal = document.getElementById('formularioHorarioModal');
            modal.style.display = 'flex'; // Mostrar el modal
        }

        function cerrarFormularioHorario() {
            var modal = document.getElementById('formularioHorarioModal');
            modal.style.display = 'none'; // Ocultar el modal
        }
    </script>
</body>



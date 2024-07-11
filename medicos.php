<?php
// Incluir controladores necesarios
require_once "models/Horarios.php";
require_once "controllers/HorarioController.php";
require_once "controllers/CitaController.php";


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

// Instanciar el controlador de Citas y obtener los datos
$citasController = new CitasController();
$citasMedico = $citasController->mostrarCitasMedico($id);


// Formulario de horario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diaSemana = $_POST['diaSemana'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $Id_User = $_POST['id_user'];

    $horariosModel = new Horarios();
    if ($horariosModel->crearHorario($diaSemana, $horaInicio, $horaFin, $Id_User)) {
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

    <main class="bg-cover bg-center bg-gradient-to-b from-blue-300 to-white bg-opacity-75 py-3 md:py-6 h-screen px-8">
        <div class="flex flex-col justify-between space-y-4">
            <!-- Div de Horarios -->
            <div class="p-6 max-w-full mx-4 mb-4">
                <?php if ($_SESSION["tipo"] == "medico"): ?>
                    <div class="flex items-center mb-4">
                        <h2 class="text-xl mr-4 text-black">Mis Horarios</h2>
                        <!-- Botón del formulario -->
                        <div onclick="mostrarFormularioHorario()" class="bg-black hover:bg-black text-white text-sm py-2 px-3 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                            Ingresar Horario
                        </div>
                    </div>
                <?php else: ?>
                    <h2 class="text-xl mb-4">Mis Horarios</h2>
                <?php endif; ?>

                <!-- Horarios -->
                <div class="flex flex-wrap overflow-x-auto">
                    <?php foreach ($horarios as $index => $horario) : ?>
                        <!-- Modal para cada horario -->
                        <div class="bg-white rounded-lg p-8 w-full sm:w-auto sm:mr-4 mb-4 relative border-blue-500 cursor-pointer transition transform hover:-translate-y-1">
                            <div class="flex flex-col items-start">
                                <p class="text-md"><strong>Día:</strong> <?php echo $horario["diaSemana"]; ?></p>
                                <p class="text-md"><?php echo $horario["horaInicio"] . ' - ' . $horario["horaFin"]; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
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

            <!-- Div de Citas -->
            <div class="bg-white shadow-md rounded-lg p-6 mx-4 max-w-full relative">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl mt-4 mb-4">Citas Programadas</h2>

                    <!-- Filtro de Estado -->
                    <div class="relative">
                        <button id="filtroEstadoBtn" class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h14a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4 4 4-4m0 6H4"></path>
                            </svg>
                            Filtro
                        </button>

                        <!-- Menú desplegable del filtro -->
                        <div id="filtroEstadoMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                            <div class="py-1">
                                <button onclick="filtrarCitas('Pendiente')" class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white focus:outline-none">Pendiente</button>
                                <button onclick="filtrarCitas('Confirmado')" class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white focus:outline-none">Confirmado</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <?php foreach ($citasMedico as $cita) : ?>
                        <div class="bg-white p-4 w-full relative border-t-2 border-1 border-black mb-4 cita-item flex justify-center">
                            <!-- Estado de la cita -->
                            <div class="flex flex-row items-center mb-4 space-x-20 justify-center">
                                <div class="text-white p-2 rounded-md <?php echo ($cita['Estado'] == 'Pendiente') ? 'bg-gray-400' : 'bg-green-400'; ?>">
                                    <p class="text-xs"><?php echo $cita['Estado']; ?></p>
                                </div>

                                <div class="ml-4 flex flex-row justify-center items-center space-x-20">
                                    <div class="flex flex-col space-y-4">
                                        <p class="text-sm"><strong>Paciente: </strong><?php echo $cita['NombrePaciente']; ?></p>
                                        <p class="text-sm"><strong>Correo: </strong><?php echo $cita['CorreoPaciente']; ?></p>
                                    </div>

                                    <div class="space-y-4">
                                        <p class="text-sm"><strong>Fecha:</strong> <?php echo $cita['Start']; ?></p>
                                        <p class="text-sm"><strong>Hora:</strong> <?php echo $cita["Hora_Inicial"] . ' - ' . $cita["Hora_Final"]; ?></p>
                                    </div>

                                    <div class="space-y-4">
                                        <p class="text-sm"><strong>Información:</strong> <?php echo $cita['Title']; ?> </p>
                                        <p class="text-sm"><strong>Descripción:</strong> <?php echo $cita['Descripcion']; ?> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
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

        // Función para filtrar citas por estado
        function filtrarCitas(estado) {
            const citas = document.querySelectorAll('.cita-item');
            
            citas.forEach(cita => {
                const estadoCita = cita.querySelector('.rounded-md').textContent.trim();
                
                if ((estado === 'Pendiente' && estadoCita !== 'Pendiente') || (estado === 'Confirmado' && estadoCita !== 'Confirmado')) {
                    cita.style.display = 'none';
                } else {
                    cita.style.display = 'block';
                }
            });
        }

        // Mostrar y ocultar menú desplegable de filtro
        const filtroEstadoBtn = document.getElementById('filtroEstadoBtn');
        const filtroEstadoMenu = document.getElementById('filtroEstadoMenu');

        filtroEstadoBtn.addEventListener('click', () => {
            filtroEstadoMenu.classList.toggle('hidden');
        });

        // Cerrar menú desplegable cuando se hace clic fuera de él
        document.addEventListener('click', (event) => {
            if (!filtroEstadoBtn.contains(event.target) && !filtroEstadoMenu.contains(event.target)) {
                filtroEstadoMenu.classList.add('hidden');
            }
        });
        
    </script>

</body>



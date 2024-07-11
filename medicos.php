<?php
// Incluir controladores necesarios
require_once "models/Horarios.php";
require_once "controllers/HorarioController.php";
require_once "controllers/CitaController.php";
require_once "controllers/TratamientoController.php";
require_once "controllers/RecetaController.php";
require_once "controllers/HistorialClinicoController.php";

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Diferenciar formularios
    $formulario = $_POST['formulario'];

    if ($formulario == "horario") {
        // Formulario de horario
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
    } elseif ($formulario == "tratamiento") {
        // Formulario de tratamiento
        $cantidad = $_POST['cantidad'];
        $dosis = $_POST['dosis'];
        $duracion = $_POST['duracion'];
        $id_medico = $_POST['id_medico'];
        $id_cita = $_POST['id_cita'];

        $tratamientoModel = new TratamientoController();
        if ($tratamientoModel->agregar($cantidad, $dosis, $duracion, $id_medico, $id_cita)) {
            // Redirigir para evitar la reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo ".";
        }
    } elseif ($formulario == "recetas") {
        // Formulario de recetas
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $id_user = $_POST['id_user'];
        $id_cita = $_POST['id_cita'];

        $recetaModel = new RecetaController();
        if ($recetaModel->agregar($fecha, $descripcion, $id_user, $id_cita)) {
            // Redirigir para evitar la reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo ".";
        }
    } elseif ($formulario == 'historialc') {
        // Formulario de recetas
        // COMPLETAR FORMULARIOS
        $fecha = $_POST['fecha'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $alergias = $_POST['alergias'];
        $enfermedadesp = $_POST['enfermedadesp'];
        $observaciones = $_POST['observaciones'];
        $descripcion = $_POST['descripcion'];
        $id_user = $_POST['id_user'];
        $id_cita = $_POST['id_cita'];

        $historialModel = new HistorialClinicoController();
        if ($historialModel->agregar($fecha, $altura, $peso, $alergias, $enfermedadesp, $observaciones, $descripcion, $id_user, $id_cita)) {
            // Redirigir para evitar la reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "E.";
        }
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
                <?php if ($_SESSION["tipo"] == "medico") : ?>
                    <div class="flex items-center mb-4">
                        <h2 class="text-xl mr-4 text-black">Mis Horarios</h2>
                        <!-- Botón del formulario -->
                        <div onclick="mostrarFormularioHorario()" class="bg-black hover:bg-black text-white text-sm py-2 px-3 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                            Ingresar Horario
                        </div>
                    </div>
                <?php else : ?>
                    <h2 class="text-xl mb-4">Mis Horarios</h2>
                <?php endif; ?>

                <!-- Horarios -->
                <div class="flex flex-wrap overflow-x-auto">
                    <?php foreach ($horarios as $index => $horario) : ?>
                        <!-- Modal para cada horario -->
                        <div class="bg-white rounded-lg p-8 w-full sm:w-auto sm:mr-4 mb-4 relative border-blue-500 cursor-pointer transition transform hover:-translate-y-1">
                            <div class="flex flex-col items-start">
                                <p class="text-md"><strong>Día:</strong> <?php echo $horario["DiaSemana"]; ?></p>
                                <p class="text-md"><?php echo $horario["HoraInicio"] . ' - ' . $horario["HoraFin"]; ?></p>
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

                            <!-- Campo oculto para identificar el formulario -->
                            <input type="hidden" name="formulario" value="horario">
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

                                    <div>
                                        <!-- Botones para abrir modales -->
                                        <button class="modal-button bg-blue-500 text-white py-2 px-4 rounded-lg" onclick="openModal('modal1<?php echo $cita['ID_Cita']; ?>')">Tratamiento</button>
                                        <button class="modal-button bg-green-500 text-white py-2 px-4 rounded-lg" onclick="openModal('modal2<?php echo $cita['ID_Cita']; ?>')">Recetas</button>
                                        <button class="modal-button bg-yellow-500 text-white py-2 px-4 rounded-lg" onclick="openModal('modal3<?php echo $cita['ID_Cita']; ?>')">Historial Clinico</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal 1 -->
                        <div id="modal1<?php echo $cita['ID_Cita']; ?>" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md relative">
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" onclick="closeModal('modal1<?php echo $cita['ID_Cita']; ?>')">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <form action="" method="POST" class="space-y-4 mt-8">

                                    <!-- Campo oculto para identificar el formulario -->
                                    <input type="hidden" name="formulario" value="tratamiento">

                                    <label for="cantidad" class="text-sm font-semibold text-gray-600">Cantidad:</label>
                                    <input type="number" id="cantidad" name="cantidad" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="dosis" class="text-sm font-semibold text-gray-600">Dosis:</label>
                                    <input type="text" id="dosis" name="dosis" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="duracion" class="text-sm font-semibold text-gray-600">Duracion:</label>
                                    <input type="text" id="duracion" name="duracion" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <input type="hidden" id="id_medico" name="id_medico" value="<?php echo $_SESSION["id"]; ?>">

                                    <input type="hidden" id="id_cita" name="id_cita" value="<?php echo $cita['ID_Cita']; ?>">

                                    <div class="flex justify-center mt-8">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                                            Guardar
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <!-- Modal 2 -->
                        <div id="modal2<?php echo $cita['ID_Cita']; ?>" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md relative">
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" onclick="closeModal('modal2<?php echo $cita['ID_Cita']; ?>')">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <form action="" method="POST" class="space-y-4 mt-8">

                                    <!-- Campo oculto para identificar el formulario -->
                                    <input type="hidden" name="formulario" value="recetas">

                                    <label for="fecha" class="text-sm font-semibold text-gray-600">Fecha:</label>
                                    <input type="date" id="fecha" name="fecha" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="descripcion" class="text-sm font-semibold text-gray-600">Descripcion:</label>
                                    <input type="text" id="descripcion" name="descripcion" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <input type="hidden" id="id_user" name="id_user" value="<?php echo $_SESSION["id"]; ?>">

                                    <input type="hidden" id="id_cita" name="id_cita" value="<?php echo $cita['ID_Cita']; ?>">

                                    <div class="flex justify-center mt-8">
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal 3 -->
                        <div id="modal3<?php echo $cita['ID_Cita']; ?>" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md relative">
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" onclick="closeModal('modal3<?php echo $cita['ID_Cita']; ?>')">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <form action="" method="POST" class="space-y-4 mt-8">

                                    <!-- Campo oculto para identificar el formulario -->
                                    <input type="hidden" name="formulario" value="historialc">

                                    <label for="fecha" class="text-sm font-semibold text-gray-600">Fecha:</label>
                                    <input type="date" id="fecha" name="fecha" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="altura" class="text-sm font-semibold text-gray-600">Altura:</label>
                                    <input type="text" id="altura" name="altura" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="peso" class="text-sm font-semibold text-gray-600">Peso:</label>
                                    <input type="text" id="peso" name="peso" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="alergias" class="text-sm font-semibold text-gray-600">Alergias:</label>
                                    <input type="text" id="alergias" name="alergias" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="enfermedadesp" class="text-sm font-semibold text-gray-600">Enfermedades P:</label>
                                    <input type="text" id="enfermedadesp" name="enfermedadesp" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="observaciones" class="text-sm font-semibold text-gray-600">Observaciones:</label>
                                    <input type="text" id="observaciones" name="observaciones" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <label for="descripcion" class="text-sm font-semibold text-gray-600">Descripcion:</label>
                                    <input type="text" id="descripcion" name="descripcion" class="block w-full max-w-xs py-2 px-3 border
                                        border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                    <input type="hidden" id="id_user" name="id_user" value="<?php echo $_SESSION["id"]; ?>">

                                    <input type="hidden" id="id_cita" name="id_cita" value="<?php echo $cita['ID_Cita']; ?>">

                                    <div class="flex justify-center mt-8">
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-md cursor-pointer transition transform hover:-translate-y-1">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Función para abrir modal
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
        }

        // Función para cerrar modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }


        function mostrarFormularioHorario() {
            var modal = document.getElementById('formularioHorarioModal');
            modal.style.display = 'flex'; // Mostrar el modal de horarios
        }

        function cerrarFormularioHorario() {
            var modal = document.getElementById('formularioHorarioModal');
            modal.style.display = 'none'; // Ocultar el modal de horarios
        }

        // Función filtrar citas por estado
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
                        <?php foreach ($areas as $area) : ?>
                            <option value="<?php echo $area['ID_Area']; ?>"><?php echo $area['Nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="rol" class="block text-gray-700">Rol:</label>
                    <select name="rol" id="rol" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                        <?php foreach ($roles as $rol) : ?>
                            <option value="<?php echo $rol['ID_Rol']; ?>"><?php echo $rol['Cargo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="text-center">
                    <input type="submit" value="Crear Médico" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                </div>
            </form>
        </div>
    </div>

</body>

</html>
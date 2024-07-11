<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/CitaController.php";

session_start();

if (!isset($_SESSION["id"])) {
    header("location: login.php");
}

if ($_SESSION["tipo"] == "admin") {
    header("location: dashboard.php");
}

$id = $_SESSION["id"];
$citasController = new CitasController();
$vercita = $citasController->mostrarMisCitas($id);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["asunto"])) {
    $title = $_POST["asunto"];
    $start = $_POST["fecha"];
    $end = $_POST["hora"];
    $color = $_POST["color"];
    $hora_inicial = $_POST["hora_inicial"];
    $hora_final = $_POST["hora_final"];
    $fecha_cr = $_POST["fecha_cr"];
    $fecha_up = $_POST["fecha_up"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];
    $id_paciente = $_POST["id_paciente"];
    $id_medico = $_POST["id_medico"];
    $id_servicio = $_POST["id_servicio"];

    $resultado = $citasController->agregar($title, $start, $end, $color, $hora_inicial, $hora_final, $fecha_cr, $fecha_up, $descripcion, $estado, $id_paciente, $id_medico, $id_servicio);
    header('Location: home.php');
    exit;
}
?>

<?php

require_once 'layout/header.php';
require_once 'layout/nav.php';
?>
<div class="bg-gray-100 h-full">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <section class="our-services">
            <div class="container">
                <div class="row">
                    <br><br>
                    <h1 style="text-align:center">Reserva una<b style="color:#0a58ca"> cita</b></h1>
                    <br><br>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main modal -->

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <div id="IngresarCita" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">Reserva tu cita el <spana id="diaSemana"></spana>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" id="fechaSeleccionada" name="fechaSeleccionada">
                            <div>
                                <label for="asunto">Asunto</label>
                                <input class="w-full border-2 rounded-md" type="text" id="title" name="asunto" required>
                            </div>
                            <div>
                                <label for="descripcion">Descripción:</label>
                                <textarea class="w-full border-2 rounded-md" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div style="display:none">
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="start" name="fecha" required>
                            </div>
                            <div style="display:none">
                                <label for="hora">Fecha2</label>
                                <input type="date" id="end" name="hora" required>
                            </div>
                            <div>
                                <label for="hora_inicial">Hora:</label>
                                <select id="hora_inicial" name="hora_inicial" required>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                </select>
                            </div>
                            <div style="display:none">
                                <label for="hora_final">Hora Final:</label>
                                <select id="hora_final" name="hora_final" required>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                </select>
                            </div>
                            <div>
                                <label for="urgencia">Urgencia:</label>
                                <select id="urgencia" name="urgencia" required>
                                    <option value="#00ff00">Baja</option>
                                    <option value="#0000FF">Media</option>
                                    <option value="#ff0000">Alta</option>
                                </select>
                            </div>
                            <div style="display:none;">
                                <label for="color">Color:</label>
                                <input type="color" id="color" name="color" value="#ff0000" required>
                            </div>
                            <div style="display:none;">
                                <label for="fecha_cr">Fecha Creación:</label>
                                <input type="date" id="fecha_cr" name="fecha_cr" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div style="display:none;">
                                <label for="fecha_up">Fecha Actualización:</label>
                                <input type="date" id="fecha_up" name="fecha_up" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div style="display:none;">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                </select>
                            </div>
                            <div style="display:none;">
                                <label for="id_paciente">ID Paciente:</label>
                                <input type="text" id="id_paciente" name="id_paciente" value="<?php echo $_SESSION["id"]; ?>" required>
                            </div>
                            <div>
                                <label for="id">Medico:</label>
                                <select id="id_medico" name="id_medico" required>
                                    <option value="3">Dr. Pedro</option>
                                    <option value="6">Dra. Nicole</option>
                                </select>
                            </div>
                            <div>
                                <label for="id_servicio">Servicios:</label>
                                <select id="id_servicio" name="id_servicio" required>
                                    <option value="1" selected>Consulta General</option>
                                    <option value="2">Consulta Especialista</option>
                                    <option value="3">Examen de sangre</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Incluir jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!--SCRIPTS-->
<script>
    function mostrarFormulario() {
        document.getElementById('formularioCita').showModal();
    }

    function cerrarFormulario() {
        document.getElementById("formularioCita").close();
    }
    document.getElementById("formularioCita").close();
    }
</script>
<script>
    document.getElementById('urgencia').addEventListener('change', function() {
        var urgenciaColor = this.value;
        document.getElementById('color').value = urgenciaColor;
    });
    document.getElementById('start').addEventListener('change', function() {
        var selectedDate = this.value;
        document.getElementById('end').value = selectedDate;
    });
    document.getElementById('hora_inicial').addEventListener('change', function() {
        var horaInicial = this.value;
        var horaInicialInt = parseInt(horaInicial.split(':')[0]);
        var horaFinalInt = horaInicialInt + 1;

        if (horaFinalInt > 18) {
            horaFinalInt = 18; // Limitar la hora final a las 6 PM
        }

        var horaFinalStr = horaFinalInt < 10 ? '0' + horaFinalInt + ':00' : horaFinalInt + ':00';
        document.getElementById('hora_final').value = horaFinalStr;
    });
</script>

<!--SCRIPT DE CALENDAR-->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'es',
                        editable: true,
                        selectable: true,
                        allDaySlot: false,
                        //llamar al archivo que contiene los Json
                        events: 'controllers/CargarCitasJson.php',

                        dateClick: function(info) {
                            var a = info.dateStr;
                            const fechaComoCadena = a;
                            var numeroDia = new Date(fechaComoCadena).getDay();
                            var dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO']
                            if ((numeroDia == "6")) {
                                alert("No se puede agendar citas los domingos");
                            } else {
                                $('#IngresarCita').modal("show");
                                $('#diaSemana').html(dias[numeroDia] + " " + a);
                                document.getElementById('fechaSeleccionada').value = a;
                                document.getElementById('start').value = a;
                                document.getElementById('end').value = a;
                            }
                        },

                    });
                    calendar.render();
                });
</script>
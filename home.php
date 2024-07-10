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
        <button onclick="mostrarFormulario()">Agendar Nueva Cita</button>
        <dialog id="formularioCita" class="rounded-3xl border-2">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <button onclick="cerrarFormulario()" style="float: right; font-size: 20px; line-height: 20px; cursor: pointer;">✕</button>
                <form action="" method="post">
                    <div>
                        <label for="asunto">Asunto</label>
                        <input type="text" id="title" name="asunto" required>
                    </div>
                    <div>
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div>
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="start" name="fecha" required>
                    </div>
                    <div>
                        <label for="hora">Fecha2</label>
                        <input type="date" id="end" name="hora" required>
                    </div>
                    <div>
                        <label for="hora_inicial">Hora Inicial:</label>
                        <input type="time" id="hora_inicial" name="hora_inicial" required>
                    </div>
                    <div>
                        <label for="hora_final">Hora Final:</label>
                        <input type="time" id="hora_final" name="hora_final" required>
                    </div>
                    <div>
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
                        <label for="id_medico">ID Medico:</label>
                        <select id="id_medico" name="id_medico" required>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div>
                        <label for="id_servicio">ID Servicio:</label>
                        <select id="id_servicio" name="id_servicio" required>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit">Agregar Cita</button>
                    </div>
                </form>
            </div>
        </dialog>
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
            
                    <?php
                    
                    $eventos = [];

                    foreach ($vercita as $cita) {
                        $eventos[] = [
                            'Start'=>$cita['Start'], // Año-Mes-Día
                            'Hora_Inicial' => $cita['Hora_Inicial'], // Hora:Minuto
                            'Descripcion' => $cita['Descripcion']
                        ];
                        
                    }
                    var_dump($eventos);
                    
                    ?>
            </section>
    </div>
</div>


<script>
    function mostrarFormulario() {
        document.getElementById('formularioCita').showModal();
    }
    function cerrarFormulario() {
    document.getElementById("formularioCita").close();
}
</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es',
          events:[
            {
                Asunto: 'aaa',
                start: '2024-07-07',
                end: '2024-07-09',
                Descripcion: 'aadzc',
                Estado: 'aaas'

            }
          ]
        });
        calendar.render();
      });

</script>

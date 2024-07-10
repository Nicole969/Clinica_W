<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/CitaController.php";

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    header("location: login.php");
}

if ($_SESSION["tipo"] == "admin") {
    header("location: dashboard.php");
}
$id = $_SESSION["id"];
$citasController = new CitasController();
$vercita = $citasController->mostrarMisCitas($id);

#home agregar cita,ver citas de esta semana, 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["asunto"])) {
    $asunto = $_POST["asunto"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $tiempo = $_POST["tiempo"];
    $estado = $_POST["estado"];
    $id_user = $_SESSION["id"]; // Asume que el ID del usuario está almacenado en la sesión

    // Crea una instancia del controlador y llama al método agregar
    $citasController = new CitasController();
    $resultado = $citasController->agregar($title,$start,$end,$color,$hora_inicial,$hora_final,$fecha_cr,$fecha_up,$descripcion,$estado,$id_user);
    header('Location: home.php');
    exit;
}
?>

<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>
<div class="bg-gray-100 h-full">
    <div class ="mx-auto max-w-7xl px-6 lg:px-8">
        <!--AGREGAR CITA
        <button onclick="mostrarFormulario()">Agendar Nueva Cita</button>
            <dialog id = "formularioCita" class = "rounded-3xl border-2 " >
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                         Botón de cierre 
                        <button onclick="cerrarFormulario()" style="float: right; font-size: 20px; line-height: 20px; cursor: pointer;">✕</button>
                        <form action="" method="post">
                            <div>
                                <label for="asunto">Asunto:</label>
                                <input type="text" id="asunto" name="asunto" required>
                            </div>
                            <div>
                                <label for="descripcion">Descripción:</label>
                                <textarea id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div>
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" required>
                            </div>
                            <div>
                                <label for="hora">Hora:</label>
                                <input type="time" id="hora" name="hora" required>
                            </div>
                            <div>
                                <label for="tiempo">Duración (en horas):</label>
                                <input type="number" id="tiempo" name="tiempo" required min="1">
                            </div>
                            <div style = "display:none;">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                    
                                </select>
                            </div>
                            <div>
                                <button type="submit">Agregar Cita</button>
                            </div>
                        </form>
                    </div>
            </dialog>-->
            
    <?php
        if (isset($_SESSION["tipo"])) { ?>
            <?php
            switch ($_SESSION["tipo"]) {
                case 'Paciente': ?>
                    <a href="home.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Home</a>
                    <a href="miscitas.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Mi citas</a>
                    <a href="perfil.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                    <div>
                        <a href="logout.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                            hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                    </div>
                    <?php break; ?>
                <?php
                case 'admin': ?>
                <?php break; 
                }
                } else {} ?>
            
    
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

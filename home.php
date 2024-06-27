<?php

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    header("location: login.php");
}

if ($_SESSION["tipo"] == "admin") {
    header("location: dashboard.php");
}

?>

<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>

<div class="bg-gray-200 p-8">
    <!-- component -->
    <div class="max-w-2xl mx-auto bg-white p-8 ">
        <div>Agregando cita</div>
        <form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
            <div class="grid gap-6 mb-6 lg:grid-cols-1">

                <div>
                    <label for="asunto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asunto</label>
                    <input name="asunto" type="text" id="asunto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 
                            dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                            dark:focus:border-blue-500" placeholder="ASUNTO" required>
                </div>

                <div>
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descripcion</label>
                    <textarea name="descripcion" class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 
                        border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" id="message" type="text" placeholder="Message..."></textarea>
                    <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Message...
                    </label>
                </div>

            </div>
            <div class="grid gap-6 mb-6 lg:grid-cols-2">
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fecha</label>
                    <input name="fecha" type="date" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hora</label>
                    <input name="hora" type="time" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite" required>
                </div>
            </div>

            <input type="submit" name="submit" class="w-full py-2.5 px-4 text-sm rounded text-black bg-sky-600 hover:bg-sky-700 focus:outline-none" value="Solicitar">
        </form>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    $asunto = $_POST["asunto"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $tiempo = "21:20:00";
    $estado = "pendiente";
    $id_user = $_SESSION["id"];

    require_once "controllers/CitaController.php";
    $cita = new CitasController();
    $cita->agregar($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user);
}
?>
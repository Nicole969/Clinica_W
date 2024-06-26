<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>

<div class="bg-gray-50 font-[sans-serif] text-[#333]">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full border py-8 px-6 rounded border-gray-300 bg-white">
            <h4 class="flex flex-col items-center font-bold">REGISTRO</h4>
            <form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?> class="mt-6 space-y-4">

                <input type="text" name="username" class="w-full text-sm px-4 py-3 rounded outline-none 
                border-2 focus:border-sky-500" placeholder="Ingrese usuario"><br>
                <input type="text" name="correo" class="w-full text-sm px-4 py-3 rounded outline-none 
                border-2 focus:border-sky-500" placeholder="Correo"><br>
                <input type="password" name="password" class="w-full text-sm px-4 py-3 rounded outline-none 
                border-2 focus:border-sky-500" placeholder="Ingrese contraseña"><br>
                <input type="text" name="password" class="w-full text-sm px-4 py-3 rounded outline-none 
                border-2 focus:border-sky-500" placeholder="Confirmar Clave"><br>
                <input type="hidden" name="tipo" placeholder="paciente"><br>

                <input type="submit" name="submit" class="w-full py-2.5 px-4 text-sm rounded text-black bg-sky-600 hover:bg-sky-700 focus:outline-none" value="Crear cuenta">
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmarClave = $_POST["confirmclave"];
    $correo = $_POST["correo"];
    $type = $_POST["tipo"];

    require_once "controllers/AuthController.php";
    $uc = new AuthController();
    $uc->register($username, $password, $confirmarClave, $correo, $type);
}
?>
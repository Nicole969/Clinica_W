<form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
    <input type="text" name="username" placeholder="Ingrese usuario"><br>
    <input type="text" name="correo" placeholder="Correo"><br>
    <input type="password" name="password" placeholder="Ingrese contraseña"><br>
    <input type="text" name="confirmclave" placeholder="Confirmar Clave"><br>
    <input type="hidden" name="tipo" placeholder="paciente"><br>

    <input type="submit" name="submit" value="Crear cuenta">
</form>

<div> <a href="login.php">Loguearse</a></div>

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
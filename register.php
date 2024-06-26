<form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
    <input type="text" name="username" placeholder="Ingrese usuario"><br>
    <input type="password" name="password" placeholder="Ingrese contraseña"><br>
    <input type="text" name="nombres" placeholder="Nombres"><br>
    <input type="text" name="apellidos" placeholder="Apellidos"><br>
    <select name="tipo">
        <option value="estudiante">Estudiante</option>
        <option value="profesor">Profesor</option>
    </select>

    <input type="submit" name="submit" value="Crear cuenta">
</form>

<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $names = $_POST["nombres"];
    $lastNames = $_POST["apellidos"];
    $type = $_POST["tipo"];

    require_once "controllers/AuthController.php";
    $uc = new UsuarioController();
    $uc->register($username, $password, $names, $lastNames, $type);
}
?>
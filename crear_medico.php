<?php
require_once 'controllers/MedicoController.php';

// Obtener datos del formulario
$username = $_POST['username'];
$clave = $_POST['clave'];
$confirmClave = $_POST['confirmClave'];
$correo = $_POST['correo'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$celular = $_POST['celular'];
$direccion = $_POST['direccion'];
$especialidad = $_POST['especialidad'];
$fecha = $_POST['fecha'];
$dni = $_POST['dni'];
$id_area = $_POST['area'];
$id_rol = $_POST['rol'] ;

$medicoController = new MedicoController();
$resultado = $medicoController->crearMedico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fecha, $dni, $id_area, $id_rol);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
 

?>

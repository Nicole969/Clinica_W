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
$fechaNac = $_POST['fecha'];
$fechaContrato = $_POST['fecha_contrato'];
$sueldoEmpleado = $_POST['sueldo'];
$dni = $_POST['dni'];
$idReportes = 2;
$idRol = $_POST['rol'];
$idArea = $_POST['area'];

$medicoController = new MedicoController();
$resultado = $medicoController->crearMedico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
?>

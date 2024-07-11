<?php
    require_once 'controllers/TiposMedicamentosController.php';
    session_start();

    // Verificar si el usuario es administrador
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
        die("Acceso denegado.");
    }

    $id = $_GET['id'];
    $tipoMedicamentoController = new TipoMedicamentoController();
    $resultado = $tipoMedicamentoController->eliminarTipoMedicamento($id);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
    ?>


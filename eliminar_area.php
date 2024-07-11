    <?php
    require_once 'controllers/AreaController.php';
    session_start();

    // Verificar si el usuario es administrador
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
        die("Acceso denegado.");
    }

    $id = $_GET['id'];
    $areaController = new AreaController();
    $resultado = $areaController->eliminarArea($id);

    echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
    ?>

<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Role
{
    private $id_rol;
    private $cargo;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Roles";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
?>

<?php

require_once "config/Conn.php";

class Usuario
{
    private $username;
    private $clave;
    private $tipo;
    private $confirmclave;
    private $id_rol;
    private $email;

    public function __construct()
    {
        /*    $this->username = $username;
        $this->clave = $clave;
        $this->apellidos = $apellidos;
        $this->nombres = $nombres;
        $this->tipo = $tipo;
        $this->id_escuela = $id_escuela;
        $this->email = $email; */
    }

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM user";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function login($username)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM user WHERE username = '$username' ";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear($username, $password, $confirmarclave, $correo, $id_rol)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO user(Username, Clave, ConfirmClave, Correo, id_rol) 
            VALUES ('$username', '$password', '$confirmarclave', '$correo', $id_rol)";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            $uc = new AuthController();
            $uc->login($username, $password);
            header("Location: home.php"); // que tan necesario es esto?
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}

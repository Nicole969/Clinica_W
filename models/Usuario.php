<?php

require_once "config/Conn.php";

class Usuario
{
    private $username;
    private $clave;
    private $tipo;
    private $confirmclave;
    private $id_rol;
    private $correo;

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

    public function cantidadUser()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT COUNT(*) as total FROM user";
        $stmt = $conexion->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $resultado['total'];
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

    public function mostrarPorTipo($tipo)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $resultados = [];
        $sql = "SELECT * FROM user WHERE tipo = ?";
        $stmt = $conexion->prepare($sql);

        // Vincular el parámetro 'tipo'
        if ($stmt->execute([$tipo])) {
            // Obtener los resultados
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultados[] = $fila; // Añadir cada usuario a la lista
            }
        } else {
            error_log('Error al ejecutar la consulta: ' . $stmt->errorInfo()[2]);
        }

        return $resultados;
    }

    public function login($correo)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM user WHERE correo = '$correo' ";
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

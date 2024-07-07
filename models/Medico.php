<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Medico
{
    private $username;
    private $clave;
    private $confirmClave;
    private $correo;
    private $nombre;
    private $apellidos;
    private $celular;
    private $direccion;
    private $especialidad;
    private $fecha;
    private $dni;
    private $id_area;
    private $id_rol;

    public function __construct($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fecha, $dni, $id_area, $id_rol)
    {
        $this->username = $username;
        $this->clave = $clave;
        $this->confirmClave = $confirmClave;
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->especialidad = $especialidad;
        $this->fecha = $fecha;
        $this->dni = $dni;
        $this->id_area = $id_area;
        $this->id_rol = $id_rol;
    }

    public function crear()
    {
        if ($this->clave !== $this->confirmClave) {
            return "Las claves no coinciden.";
        }

        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            // Insertar en la tabla User
            $sql_user = "INSERT INTO User (Username, Clave, ConfirmClave, Correo, Id_rol) 
                         VALUES ('$this->username', '$this->clave', '$this->confirmClave', '$this->correo', $this->id_rol)";
            $result_user = $conexion->exec($sql_user);

            // Insertar en la tabla Perfil
            $sql_perfil = "INSERT INTO Perfil (Nombre, Apellidos, Celular, Direccion, Especialidad, Fecha, DNI, Id_Rol, Id_Area) 
                           VALUES ('$this->nombre', '$this->apellidos', '$this->celular', '$this->direccion', '$this->especialidad', '$this->fecha', '$this->dni', $this->id_rol, $this->id_area)";
            $result_perfil = $conexion->exec($sql_perfil);

            $conn->cerrar();

            if ($result_user && $result_perfil) {
                return "Nuevo médico creado exitosamente.";
            } else {
                return "Error al crear el médico.";
            }
        } catch (Exception $e) {
            return "Error al crear el médico: " . $e->getMessage();
        }
    }
}
?>
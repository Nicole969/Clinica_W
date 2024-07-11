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
    private $fechaNac;
    private $fechaContrato;
    private $sueldoEmpleado;
    private $dni;
    private $idReportes;
    private $idRol;
    private $idArea;

    public function __construct($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea)
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
        $this->fechaNac = $fechaNac;
        $this->fechaContrato = $fechaContrato;
        $this->sueldoEmpleado = $sueldoEmpleado;
        $this->dni = $dni;
        $this->idReportes = $idReportes;
        $this->idRol = $idRol;
        $this->idArea = $idArea;
    }

    public function crear()
    {
        if ($this->clave !== $this->confirmClave) {
            return "Las claves no coinciden.";
        }

        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            // Insertar en la tabla User (sin cambios)
            $sql_user = "INSERT INTO Users (Username, Clave, ConfirmClave, Correo, Id_rol) 
                         VALUES ('$this->username', '$this->clave', '$this->confirmClave', '$this->correo', $this->idRol)";
            $result_user = $conexion->exec($sql_user);

            // Insertar en la tabla Perfil (con campos nuevos añadidos)
            $sql_perfil = "INSERT INTO Perfiles  (Nombre, Apellidos, Celular, Direccion, Especialidad, FechaNac, FechaContrato, SueldoEmpleado, DNI, ID_Reportes, ID_Rol, ID_Area) 
                           VALUES ('$this->nombre', '$this->apellidos', '$this->celular', '$this->direccion', '$this->especialidad', '$this->fechaNac', '$this->fechaContrato', $this->sueldoEmpleado, '$this->dni', $this->idReportes, $this->idRol, $this->idArea)";
            $result_perfil = $conexion->exec($sql_perfil);

            $conn->cerrar();

            if ($result_user && $result_perfil) {
                return "Nuevo médico creado exitosamente.";
            } else {
                return "Error al crear el médico.";
            }
        } catch (PDOException $e) {
            return "Error al crear el médico: " . $e->getMessage();
        }
    }
}
?>

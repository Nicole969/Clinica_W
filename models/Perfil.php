<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Perfil
{
    private $id_perfil;
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

    public function __construct($nombre = null, $apellidos = null, $celular = null, $direccion = null, $especialidad = null, $fechaNac = null, $fechaContrato = null, $sueldoEmpleado = null, $dni = null, $idReportes = null, $idRol = null, $idArea = null)
    {
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

    public function mostrarTodos(): PDOStatement|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Perfiles";
        $stmt = $conexion->query($sql);
        $conn->cerrar();
        return $stmt;
    }

    public function crear(): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "INSERT INTO Perfiles (Nombre, Apellidos, Celular, Direccion, Especialidad, FechaNac, FechaContrato, SueldoEmpleado, DNI, ID_Reportes, ID_Rol, ID_Area) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$this->nombre, $this->apellidos, $this->celular, $this->direccion, $this->especialidad, $this->fechaNac, $this->fechaContrato, $this->sueldoEmpleado, $this->dni, $this->idReportes, $this->idRol, $this->idArea]);
            $conn->cerrar();

            if ($result) {
                return "Nuevo perfil creado exitosamente.";
            } else {
                return "Error al crear el perfil.";
            }
        } catch (PDOException $e) {
            return "Error al crear el perfil: " . $e->getMessage();
        }
    }

    public function obtenerPorId($id_perfil): array|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Perfiles WHERE ID_Perfil = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_perfil]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $perfil;
    }

    public function editar($id_perfil, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "UPDATE Perfiles SET Nombre = ?, Apellidos = ?, Celular = ?, Direccion = ?, Especialidad = ?, FechaNac = ?, FechaContrato = ?, SueldoEmpleado = ?, DNI = ?, ID_Reportes = ?, ID_Rol = ?, ID_Area = ? 
                    WHERE ID_Perfil = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea, $id_perfil]);
            $conn->cerrar();

            if ($result) {
                return "Perfil actualizado exitosamente.";
            } else {
                return "Error al actualizar el perfil.";
            }
        } catch (PDOException $e) {
            return "Error al actualizar el perfil: " . $e->getMessage();
        }
    }

    public function eliminar($id_perfil): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "DELETE FROM Perfiles WHERE ID_Perfil = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$id_perfil]);
            $conn->cerrar();

            if ($result) {
                return "Perfil eliminado exitosamente.";
            } else {
                return "Error al eliminar el perfil.";
            }
        } catch (PDOException $e) {
            return "Error al eliminar el perfil: " . $e->getMessage();
        }
    }
}
?>

<?php
require_once dirname(__DIR__) . "/config/Conn.php";

class Servicio
{
    private $id_servicio;
    private $servicio;
    private $descripcion;
    private $costo;

    public function __construct($servicio = null, $descripcion = null, $costo = null)
    {
        $this->servicio = $servicio;
        $this->descripcion = $descripcion;
        $this->costo = $costo;
    }

    public function mostrar(): PDOStatement|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Servicios";
        $stmt = $conexion->query($sql);
        $conn->cerrar();
        return $stmt;
    }

    public function crear(): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "INSERT INTO Servicios (Servicio, Descripcion, Costo) VALUES ('$this->servicio', '$this->descripcion', $this->costo)";
            $result = $conexion->exec($sql);
            $conn->cerrar();

            if ($result) {
                return "Nuevo servicio creado exitosamente.";
            } else {
                return "Error al crear el servicio.";
            }
        } catch (PDOException $e) {
            return "Error al crear el servicio: " . $e->getMessage();
        }
    }

    public function obtenerPorId($id_servicio): array|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Servicios WHERE id_servicio = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_servicio]);
        $servicio = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $servicio;
    }

    public function editar($id_servicio, $servicio, $descripcion, $costo): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "UPDATE Servicios SET Servicio = ?, Descripcion = ?, Costo = ? WHERE id_servicio = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$servicio, $descripcion, $costo, $id_servicio]);
            $conn->cerrar();

            if ($result) {
                return "Servicio actualizado exitosamente.";
            } else {
                return "Error al actualizar el servicio.";
            }
        } catch (PDOException $e) {
            return "Error al actualizar el servicio: " . $e->getMessage();
        }
    }

    public function eliminar($id_servicio): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "DELETE FROM Servicios WHERE id_servicio = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$id_servicio]);
            $conn->cerrar();

            if ($result) {
                return "Servicio eliminado exitosamente.";
            } else {
                return "Error al eliminar el servicio.";
            }
        } catch (PDOException $e) {
            return "Error al eliminar el servicio: " . $e->getMessage();
        }
    }
}
?>


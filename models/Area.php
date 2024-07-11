<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Area
{
    private $id_area;
    private $nombre;
    private $descripcion;

    public function __construct($nombre = null, $descripcion = null)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function mostrar(): PDOStatement|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM areas";
        $stmt = $conexion->query($sql);
        $conn->cerrar();
        return $stmt;
    }

    public function crear(): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "INSERT INTO Areas (Nombre, Descripcion) VALUES ('$this->nombre', '$this->descripcion')";
            $result = $conexion->exec($sql);
            $conn->cerrar();

            if ($result) {
                return "Nueva área creada exitosamente.";
            } else {
                return "Error al crear el área.";
            }
        } catch (PDOException $e) {
            return "Error al crear el área: " . $e->getMessage();
        }
    }

    public function obtenerPorId($id_area): array|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM areas WHERE id_area = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_area]);
        $area = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $area;
    }

    public function editar($id_area, $nombre, $descripcion): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "UPDATE areas SET Nombre = ?, Descripcion = ? WHERE id_area = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$nombre, $descripcion, $id_area]);
            $conn->cerrar();

            if ($result) {
                return "Área actualizada exitosamente.";
            } else {
                return "Error al actualizar el área.";
            }
        } catch (PDOException $e) {
            return "Error al actualizar el área: " . $e->getMessage();
        }
    }

    public function eliminar($id_area): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "DELETE FROM areas WHERE id_area = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$id_area]);
            $conn->cerrar();

            if ($result) {
                return "Área eliminada exitosamente.";
            } else {
                return "Error al eliminar el área.";
            }
        } catch (PDOException $e) {
            return "Error al eliminar el área: " . $e->getMessage();
        }
    }
}
?>
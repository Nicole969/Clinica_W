<?php
require_once dirname(__DIR__) . "/config/Conn.php";

class TipoMedicamento
{
    private $id_tipoMedi;
    private $nomTipoMed;
    private $descripcion;

    public function __construct($nomTipoMed = null, $descripcion = null)
    {
        $this->nomTipoMed = $nomTipoMed;
        $this->descripcion = $descripcion;
    }

    public function mostrar(): PDOStatement|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Tipos_Medicamentos";
        $stmt = $conexion->query($sql);
        $conn->cerrar();
        return $stmt;
    }

    public function crear(): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "INSERT INTO Tipos_Medicamentos (NomTipoMed, Descripcion) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$this->nomTipoMed, $this->descripcion]);
            $conn->cerrar();

            if ($result) {
                return "Nuevo tipo de medicamento creado exitosamente.";
            } else {
                return "Error al crear el tipo de medicamento.";
            }
        } catch (PDOException $e) {
            return "Error al crear el tipo de medicamento: " . $e->getMessage();
        }
    }

    public function obtenerPorId($id_tipoMedi): array|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Tipos_Medicamentos WHERE ID_TipoMedi = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_tipoMedi]);
        $tipoMedi = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $tipoMedi;
    }

    public function editar($id_tipoMedi, $nomTipoMed, $descripcion): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "UPDATE Tipos_Medicamentos SET NomTipoMed = ?, Descripcion = ? WHERE ID_TipoMedi = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$nomTipoMed, $descripcion, $id_tipoMedi]);
            $conn->cerrar();

            if ($result) {
                return "Tipo de medicamento actualizado exitosamente.";
            } else {
                return "Error al actualizar el tipo de medicamento.";
            }
        } catch (PDOException $e) {
            return "Error al actualizar el tipo de medicamento: " . $e->getMessage();
        }
    }

    public function eliminar($id_tipoMedi): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "DELETE FROM Tipos_Medicamentos WHERE ID_TipoMedi = ?";
            $stmt = $conexion->prepare($sql);
            $result = $stmt->execute([$id_tipoMedi]);
            $conn->cerrar();

            if ($result) {
                return "Tipo de medicamento eliminado exitosamente.";
            } else {
                return "Error al eliminar el tipo de medicamento.";
            }
        } catch (PDOException $e) {
            return "Error al eliminar el tipo de medicamento: " . $e->getMessage();
        }
    }
}
?>

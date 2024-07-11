<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Medicamento
{
    private $id_medi;
    private $nombreMedi;
    private $presentacion;
    private $fabricacion;
    private $preCompra;
    private $precVenta;
    private $stock;
    private $fechProduccion;
    private $fechVencimiento;
    private $id_tipoMedi;

    public function __construct($nombreMedi = null, $presentacion = null, $fabricacion = null, $preCompra = null, $precVenta = null, $stock = null, $fechProduccion = null, $fechVencimiento = null, $id_tipoMedi = null)
    {
        $this->nombreMedi = $nombreMedi;
        $this->presentacion = $presentacion;
        $this->fabricacion = $fabricacion;
        $this->preCompra = $preCompra;
        $this->precVenta = $precVenta;
        $this->stock = $stock;
        $this->fechProduccion = $fechProduccion;
        $this->fechVencimiento = $fechVencimiento;
        $this->id_tipoMedi = $id_tipoMedi;
    }

    public function mostrar(): PDOStatement|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Medicamentos";
        $stmt = $conexion->query($sql);
        $conn->cerrar();
        return $stmt;
    }

    public function crear(): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "INSERT INTO Medicamentos (NombreMedi, Presentacion, Fabricacion, PreCompra, PrecVenta, Stock, FechProduccion, FechVencimiento, ID_TipoMedi) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$this->nombreMedi, $this->presentacion, $this->fabricacion, $this->preCompra, $this->precVenta, $this->stock, $this->fechProduccion, $this->fechVencimiento, $this->id_tipoMedi]);
            $conn->cerrar();

            return "Nuevo medicamento creado exitosamente.";
        } catch (PDOException $e) {
            return "Error al crear el medicamento: " . $e->getMessage();
        }
    }

    public function obtenerPorId($id_medi): array|false
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Medicamentos WHERE ID_Medi = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_medi]);
        $medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $medicamento;
    }

    public function editar($id_medi, $nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "UPDATE Medicamentos SET NombreMedi = ?, Presentacion = ?, Fabricacion = ?, PreCompra = ?, PrecVenta = ?, Stock = ?, FechProduccion = ?, FechVencimiento = ?, ID_TipoMedi = ? 
                    WHERE ID_Medi = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi, $id_medi]);
            $conn->cerrar();

            return "Medicamento actualizado exitosamente.";
        } catch (PDOException $e) {
            return "Error al actualizar el medicamento: " . $e->getMessage();
        }
    }

    public function eliminar($id_medi): string
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        try {
            $sql = "DELETE FROM Medicamentos WHERE ID_Medi = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id_medi]);
            $conn->cerrar();

            return "Medicamento eliminado exitosamente.";
        } catch (PDOException $e) {
            return "Error al eliminar el medicamento: " . $e->getMessage();
        }
    }
}
?>

<?php
require_once 'Database.php';

class Citas {
    public function mostrar() {
        
    }

    public function mostrarMisCitas($id) {
        
    }

    public function crear($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user) {
        $db = Database::getConnection();
        $query = "INSERT INTO citas (asunto, descripcion, fecha, hora, tiempo, estado, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssisi", $asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user);

        return $stmt->execute();
    }
}
?>
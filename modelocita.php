<?php
require_once 'Database.php';

class Citas {
    public function mostrar() {
        //  para mostrar todas las citas
    }

    public function mostrarMisCitas($id) {
        //  para mostrar citas de un usuario específico
    }

    public function crear($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user) {
        $db = Database::getConnection();
        $query = "INSERT INTO citas (asunto, descripcion, fecha, hora, tiempo, estado, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssisi", $asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user);

        return $stmt->execute();
    }
}s
?>
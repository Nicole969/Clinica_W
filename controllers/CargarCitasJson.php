<?php
session_start();
require_once __DIR__ . "/../config/Conn.php";

// Asegurarse de que la conexión esté establecida
$conn = new Conn();
$pdo = $conn->conectar();

// Verificar si el ID del usuario está presente en la sesión
if (isset($_SESSION["id"])) {
    $id_usuario = $_SESSION["id"];

    // Modificar la consulta SQL para filtrar por el ID del usuario
    $sql = "SELECT title, start, end, color, hora_inicial, hora_final, descripcion, estado, id_medico, id_servicio 
            FROM Citas 
            WHERE id_paciente = :id_usuario";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados en formato JSON
    echo json_encode($results);
} else {
    // Si no hay ID de usuario en la sesión, devolver un error
    echo json_encode(["error" => "Usuario no autenticado"]);
}
?>
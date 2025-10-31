<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
$especialidad_id = $_GET['especialidad_id']; // Esto lo recibes desde el formulario
$fecha = $_GET['fecha'];

$query = "SELECT c.id, c.nombre FROM consultorios c 
          WHERE c.especialidad_id = ? 
          AND NOT EXISTS (
              SELECT 1 FROM asignaciones a 
              WHERE a.consultorio_id = c.id AND a.fecha = ?
          )";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("is", $especialidad_id, $fecha);
$stmt->execute();
$result = $stmt->get_result();

$consultorios_disponibles = [];
while ($row = $result->fetch_assoc()) {
    $consultorios_disponibles[] = $row;
}
?>

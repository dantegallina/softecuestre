<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/function/fechas.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');



function asignarArbitro($conexion, $arbitro_id, $Id_evento, $categoria_id) {
    // Obtener la fecha del evento
    $sql = "SELECT fecha FROM evento WHERE Id_evento = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        return "Error en la preparación de la consulta fecha: " . $conexion->error;
    }
    $stmt->bind_param("i", $Id_evento);
    $stmt->execute();
    $result = $stmt->get_result();
    $evento = $result->fetch_assoc();
    if (!$evento) {
        return "Evento no encontrado.";
    }
    $fecha_evento = $evento['fecha'];
    $stmt->close();

    // Verificar si el árbitro ya está asignado a otro evento el mismo día
    $sql = "SELECT * FROM arbitros_eventos ae
            JOIN evento e ON ae.id = e.Id_evento
            WHERE ae.arbitro_id = ? AND e.fecha = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }
    $stmt->bind_param("is", $arbitro_id, $fecha_evento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        return "El árbitro ya está asignado a otro evento el mismo día.";
    }
    $stmt->close();

    // Insertar la asignación
    $sql = "INSERT INTO arbitros_eventos (arbitro_id, evento_id, categoria_id) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }
    $stmt->bind_param("iii", $arbitro_id, $Id_evento, $categoria_id);

    if ($stmt->execute()) {
        $stmt->close();
        return "Árbitro asignado correctamente.";
    } else {
        $stmt->close();
        return "Error al asignar el árbitro: " . $stmt->error;
    }
}

// Datos de ejemplo
$arbitro_id = 1;
$Id_evento = 1;
$categoria_id = 1;

$resultado = asignarArbitro($conexion, $arbitro_id, $Id_evento, $categoria_id);
echo $resultado;

$conexion->close();

?>

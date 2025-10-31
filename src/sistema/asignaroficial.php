<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
$medico_id = $_POST['medico_id'];
$consultorio_id = $_POST['consultorio_id'];
$fecha = $_POST['fecha'];


// Verificar si el médico ya tiene una asignación en ese día
$query = "SELECT COUNT(*) AS asignaciones FROM asignaciones WHERE medico_id = ? AND fecha = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("is", $medico_id, $fecha);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['asignaciones'] > 0) {
    echo "Este médico ya tiene una asignación para el día seleccionado.";
} else {
// Insertar la asignación pero sin confirmar
$query = "INSERT INTO asignaciones (medico_id, consultorio_id, fecha) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("iis", $medico_id, $consultorio_id, $fecha);

if ($stmt->execute()) {
    $asignacion_id = $mysqli->insert_id; // Obtener el ID de la asignación recién creada

    // Obtener el email del médico
    $query = "SELECT email FROM medicos WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $medico_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medico = $result->fetch_assoc();

    // Enviar el correo de confirmación
    $to = $medico['email'];
    $subject = "Confirmación de Asignación de Consultorio";
    $confirmation_link = "https://softecuestre.com.ar.com/confirmar_asignacion.php?id=$asignacion_id";
    $message = "Hola, se te ha asignado un consultorio para el día $fecha. 
                Por favor, confirma tu asistencia haciendo clic en el siguiente enlace:
                <a href='$confirmation_link'>Aceptar Asignación</a>";
    $headers = "Content-type: text/html; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Correo enviado para confirmación.";
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Error al crear la asignación: " . $stmt->error;
}
}
?>
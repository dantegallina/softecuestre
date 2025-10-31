<form method="GET" action="consultaroficial.php">
    <label for="especialidad_id">Especialidad:</label>
    <select name="especialidad_id" id="especialidad_id">
        <!-- Opciones de especialidades desde la base de datos -->
    </select>
    
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha">
    
    <button type="submit">Consultar Consultorios</button>
</form>

<form method="POST" action="asignaroficial.php">
    <input type="hidden" name="medico_id" value="<!-- ID del médico -->">
    <input type="hidden" name="consultorio_id" value="<!-- ID del consultorio seleccionado -->">
    <input type="hidden" name="fecha" value="<!-- Fecha de la asignación -->">
    
    <button type="submit">Asignar Médico</button>
</form>

<?php

if (isset($_GET['id'])) {
    $asignacion_id = $_GET['id'];

    // Actualizar la asignación a confirmado
    $query = "UPDATE asignaciones SET confirmado = 1 WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $asignacion_id);

    if ($stmt->execute()) {
        echo "Asignación confirmada con éxito.";
    } else {
        echo "Error al confirmar la asignación: " . $stmt->error;
    }
} else {
    echo "Solicitud inválida.";
}
?>
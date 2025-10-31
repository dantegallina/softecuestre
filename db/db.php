<?php


// Conectar con el servidor de base de datos
$conexion = mysqli_connect ($host, $usuario, $password) or die ("No se puede conectar con el servidor");

// Seleccionar base de datos
mysqli_select_db($conexion, $db) or die ("No se puede seleccionar la base de datos");
?>

<?php 

$host = "localhost"; 
$usuario = "softecue_soft"; 
$password = "proyectoecuestre00"; 
$db = "softecue_softecuestre";


$mimail = "info@softecuestre.com.ar";
$micontacto = "info@softecuestre.com.ar";
$urlppal="http://www.softecuestre.com"; 


// Create connection
$conexion = mysqli_connect($host, $usuario, $password, $db);
// Check connection
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$mysqli = new mysqli($host,$usuario,$password, $db);
$mysqli->set_charset("utf8mb4");


?>
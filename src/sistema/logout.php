<?php
session_start(); // Inicia la sesión

// Destruye todas las variables de sesión
$_SESSION['user_id'] = ""; 
$_SESSION['eventos_id'] = "";
$_SESSION['usuario'] = "";

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
//session_regenerate_id(true);



// Redirige al usuario a la página de login
header("Location: loging.php");
exit();
?>

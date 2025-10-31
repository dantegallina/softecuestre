<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesión

// Verifica si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/dashboard.php"); // Redirige al panel de control o a la página principal
    exit();
}

// Verifica si se ha enviado el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí debes realizar la lógica de autenticación
    // Por ejemplo, verificar las credenciales en una base de datos

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Construye la consulta SQL
    $sql_usuario = "SELECT `users`.`id`, `users`.`username`, `users`.`password`, `users`.`first_name`, `users`.`last_name`, `saas`.`id_usr`, `saas`.`id_evento`  
            FROM `users`, `saas` 
            WHERE `users`.`username` = '$username' 
            AND `saas`.`id_usr` = `users`.`id`";

    // Ejecuta la consulta
    $usuario = mysqli_query($conexion, $sql_usuario) or die("Sin conexión con la base de datos");

    // Verifica si se encontró un usuario con las credenciales proporcionadas
    if(mysqli_num_rows($usuario) >= 1) {
        $eventos_id = array(); // Inicializa un array para almacenar los id_evento

        // Recorre todas las filas encontradas
        while($resultado_usuario = mysqli_fetch_array($usuario)) {
            $pass_hashed = $resultado_usuario['password']; // Obtén la contraseña hasheada desde la base de datos
            $id = $resultado_usuario['id'];
            $usuario_log = trim($resultado_usuario['first_name']) . " " . trim($resultado_usuario['last_name']);

            // Hashea la contraseña proporcionada con SHA-1
            $password_hashed = sha1($password);
       
        
            // Verifica si el hash de la contraseña proporcionada coincide con el hash almacenado
            if($password_hashed === $pass_hashed) {
                // Las credenciales son válidas, agrega el id_evento al array
                $eventos_id[] = $resultado_usuario['id_evento'];
            }
        }

        // Verifica si se encontró al menos un usuario con las credenciales proporcionadas
        if(!empty($eventos_id)) {
            // Establece la sesión del usuario y guarda todos los eventos
        
            $_SESSION['user_id'] = $id; 
            $_SESSION['eventos_id'] = $eventos_id;
            $_SESSION['usuario'] = $usuario_log;

            header("Location: https://softecuestre.com.ar/src/sistema/dashboard.php");
            exit();
    
        } else {
            // Usuario no encontrado
            $error = "Credenciales inválidas";
        }

    }

// Cerrar conexion
mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Gestión</title>
    <link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
    <link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://softecuestre.com.ar/js/jquery.js"></script>
    <script type="text/javascript" src="https://softecuestre.com.ar/js/interface.js"></script>
    
<!--[if lt IE 7]>
     <style type="text/css">
         div, img { behavior: url(iepngfix.htc) }
     </style>
<![endif]-->
<style>
    body {
        background-color: #FFFFFF;
        color: #1C293A;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #FFFFFF;
        color: #1C293A;
        padding: 20px;
        text-align: center;
    }
    form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
</style>        


</head>
<body>
<div>
        <?PHP 
           
             include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
     ?>    
</div>
<header>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
    <h1>Gestión</h1>
</header>
<main>
    <?php
    // Muestra el mensaje de error, si existe
    if (isset($error)) {
        echo "<center>";
        echo "<p style='color: red;'>$error</p>";
        echo "</center>";
    }
    ?>
    
    <form method="POST" action="">
        <fieldset>
            <legend>Login</legend>
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <center><input type="submit" value="Iniciar sesión"></center>
        </fieldset>
    </form>
</main>
<fieldset>
        <div>
        <?PHP 
             
             include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
       ?> 
        </div>
</fieldset>
</body>
</html>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesi¨®n

// Verifica si la sesi¨®n est¨¢ abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/loging.php"); // Redirige a la p¨¢gina de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Computos</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://softecuestre.com.ar/js/jquery.js"></script>
	<script type="text/javascript" src="https://softecuestre.com.ar/js/interface.js"></script>
    <link rel="stylesheet" href="https://softecuestre.com.ar/css/estilo.css" type="text/css" media="all">
    <script type="text/javascript" src="https://softecuestre.com.ar/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="https://softecuestre.com.ar/js/main.js"></script>
	
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
<script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"Chat","width=550,height=480,scrollbars=NO,resizable=NO,top=500,left=850") 
} 
</script>
</head>

<body>
<div>
    	<?PHP 
    	   
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
 	?>    
</div>
<header>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
<a title="Chat" href="javascript:ventanaSecundaria('https://softecuestre.com.ar/src/chat/index.php')">
    <img src="https://softecuestre.com.ar/images/chat_tiflux.png" height="50">
</a>
    <h1>Computos</h1>
</header>
<main>
    

    <?php include('header.php');?>
<div id="div_pheader"></div>
<div id="div_form"></div>
<?php //include('pheader.php');?>
<?php //include('form.php');?>

<!--
<iframe title="" src="header.php" width="950" height="300" frameborder="0" scrolling="no"></iframe>
<iframe title="" src="pheader.php" width="950" height="300" frameborder="0"></iframe>
<iframe title="" src="form.php" width="950" height="800" frameborder="0"></iframe>
-->


<?php
// Cerrar conexiÃ³n
mysqli_close ($conexion);
?>
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
    
<?php
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesión

// Verifica si la sesión está abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/loging.php"); // Redirige a la página de login
    exit();
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
    <h1>Dashboard</h1>
</header>
<main>
    <!-- Aquí puedes mostrar la información personalizada del usuario o cualquier otra funcionalidad -->
<form>    
    <fieldset>
        <legend>Anteprogramas</legend>
            <div>
                 <img src='https://softecuestre.com.ar/images/anteprograma concurso.png' alt='Anteprograma concurso' height='100' style='opacity: 0.5; pointer-events: none;' />
            </div>
    </fieldset>

    <fieldset>
        <legend>Computos y listas</legend>    
            <div>
                <a title='Computos' href='https://softecuestre.com.ar/src/sistema/monitor.php'> 
                    <img src='https://softecuestre.com.ar/images/computos.png' alt='Computos' height='100' />
                </a>
                <img src='https://softecuestre.com.ar/images/sorteo.png' alt='Sorteo' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <img src='https://softecuestre.com.ar/images/clasificacion.png' alt='Clasificacion forzada' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <br>
                <img src='https://softecuestre.com.ar/images/alta baja.png' alt='Alta y Baja de listas' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <img src='https://softecuestre.com.ar/images/planillas oficiales.png' alt='Planillas Oficiales' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <img src='https://softecuestre.com.ar/images/modificacion de listas.png' alt='modificacion de listas' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <br>
                <img src='https://softecuestre.com.ar/images/campeonatos.png' alt='Generación de Campeonatos' height='100' style='opacity: 0.5; pointer-events: none;'/>
                <a title='Listas' href='https://softecuestre.com.ar/src/inscripciones/listas.php'>
                    <img src='https://softecuestre.com.ar/images/lista.png' alt='Listas completas' height='100' />
                </a>
            </div>
    </fieldset>
    
    <fieldset>
        <legend>Padock</legend>
            <div>
                <a title='Padock' href='https://softecuestre.com.ar/src/inscripciones/padock.php'>                
                    <img src='https://softecuestre.com.ar/images/padock.png' alt='Padock' height='100' />
                </a>
            </div>
    </fieldset>    
        
    <fieldset>
        <legend>Diseñador</legend>
            <div>
                 <img src='https://softecuestre.com.ar/images/diseñador.png' alt='Diseñador' height='100' style='opacity: 0.5; pointer-events: none;'/>
            </div>
    </fieldset>

    <fieldset>
        <legend>Secretaría</legend>
            <div>
                 <img src='https://softecuestre.com.ar/images/secretaria.png' alt='Secretaria' height='100' style='opacity: 0.5; pointer-events: none;' />
                 <a title='Listas' href='https://softecuestre.com.ar/src/inscripciones/listasadmin.php'>
                    <img src='https://softecuestre.com.ar/images/lista administrativa.png' alt='Listas administracion' height='100' />
                 </a>
                <img src='https://softecuestre.com.ar/images/pagos.png' alt='Tesorería' height='100' style='opacity: 0.5; pointer-events: none;' />
            </div>
    </fieldset>    

    <fieldset>
        <legend>Gestión</legend>
            <div>
                    <img src='https://softecuestre.com.ar/images/gestion.png' alt='Gestion' height='100' style='opacity: 0.5; pointer-events: none;' />
                    <img src='https://softecuestre.com.ar/images/reserva boxes.png' alt='Boxes' height='100' style='opacity: 0.5; pointer-events: none;' />
            </div>
    </fieldset>


    <fieldset>
        <legend>Steward</legend>
            <div>
                 <img src='https://softecuestre.com.ar/images/steward.png' alt='Steward' height='100' style='opacity: 0.5; pointer-events: none;' />
            </div>
    </fieldset>        

    <fieldset>
        <legend>Veterinarios</legend>
            <div>
                 <img src='https://softecuestre.com.ar/images/veterinario.png' alt='Veterinario' height='100' style='opacity: 0.5; pointer-events: none;' />
            </div>
    </fieldset>
    
    <fieldset>
        <legend>Pantallas</legend>
                <a title='Jurado' href='https://softecuestre.com.ar/src/sistema/jurado.php'> 
                    <img src='https://softecuestre.com.ar/images/jurado.png' alt='Jurado' height='100' style='opacity: 0.5; pointer-events: none;'/> 
                </a>
                <a title='Locutor' href='https://softecuestre.com.ar/src/sistema/locutor.php'> 
                    <img src='https://softecuestre.com.ar/images/locutor.png' alt='Locutor' height='100' style='opacity: 0.5; pointer-events: none;'/>
                </a>
                <a title='Vivo' href='https://softecuestre.com.ar/src/sistema/vivo.php'> 
                    <img src='https://softecuestre.com.ar/images/vivo.png' alt='Vivo' height='100' style='opacity: 0.5; pointer-events: none;'/> 
                </a>                
                <a title='Info Antepista' href='https://softecuestre.com.ar/src/sistema/antepista.php'> 
                    <img src='https://softecuestre.com.ar/images/info antepista.png' alt='Info Antepista' height='100'/>
                </a>
    </fieldset>    
    
    
    
    
</form>

    <center><p><a href="logout.php"><img src='https://softecuestre.com.ar/images/log out.png' alt='Cerrar sesion' height='100' /></a></p></center> 
   
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

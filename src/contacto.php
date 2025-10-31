<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Contacto</title>
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
 	<h1>Contacto y Sugerencias</h1>
</header>
<main>
    		

  <form action="../mail/correo.php" method="post">
<fieldset><div>Nombre: <input name="nombredeusuario" /></div>
<div>Apellido: <input name="apellidopaterno" /></div>
<div>Club: <input name="institucion" /></div>
<div>Dirección: <input name="direccion" /></div>
<div>Telefono: <input name="telefono" /></div>
<div>Ciudad: <input name="ciudad" /></div>
<div>Provincia: <input name="estado" /></div>
<div>Correo Electronico: <input name="correoelectronico" /></div>
    <div>Comentarios/Sugerencias/Solicitud de Informacion/Presupuestos <br/>
        <textarea name="comentarios" cols="35" rows="8" wrap="soft" ></textarea>  
    </div>
 <div><input type="submit" value="Enviar" /></div>
 </fieldset>  
</form>

</main>
<div>
    	<?PHP 
        	 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
	?>    
</div>
</body>
</html>
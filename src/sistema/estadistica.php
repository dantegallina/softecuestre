<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Estadística</title>
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
    <?php
        $trabajando="si"; // si

        if($trabajando=="si"){
            echo "<center><img src='http://softecuestre.com.ar/images/logo_3.jpg' width='150' height='100' /></br>";
            echo "<img src='http://softecuestre.com.ar/images/loading-100.gif' width='150' height='100' /></center>";
        }else{
            echo "<img src='https://softecuestre.com.ar/images/logo_3.jpg' width='200' height='150' />";
            echo "<h1>Estadística</h1>";
        }
?>
    
</header>
<main>
    

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

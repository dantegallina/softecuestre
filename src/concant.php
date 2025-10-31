<?php
	header("Access-Control-Allow-Origin: *");
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Concursos Anteriores</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
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
			color: #FFFFFF;
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
		

.contenedor-eventos {
        background-color: #FFFFFF;
		color: #FFFFFF;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .contenedor-eventos form {
        background-color: #FFFFFF;
		color: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: center;
    }

    .contenedor-eventos label {
        color:#1C293A;
        font-family: Arial, sans-serif;
        font-size: 16px;
        margin-top: 10px;
    }

    .contenedor-eventos button {
        color:#FFFFFF;
        background-color: #FFFFFF;
        background: none;
        border: none;
        cursor: pointer;
    }
    
     <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 80%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 0px;
    }

    .slick-slide img {
      width: 50%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>

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
 	<h1>Concursos Anteriores</h1>
</header>
<main>
   <section class="regular slider" data-sizes="50vw">
       
            <?php   
            $fecha = date('Y-m-d');
            $query = $mysqli->query("SELECT * FROM evento order by fecha");
            while ($valores = mysqli_fetch_assoc($query)) {
                if ($valores['fecha']<$fecha) {
                    echo "<form action='./sistema/concursos_ant.php' method='post'>";
                    echo " <div class='contenedor-eventos'>";
                    echo "<input type='hidden' name='Id_evento' value='" . $valores['Id_evento'] . "'>";
                    echo "<button type='submit'>";
                    setlocale(LC_ALL, 'es_ES');
                    $desde = new DateTime($valores['fecha']);
                    if($valores['fecha_fin']=="0000-00-00"){
                        $hasta = "";
                        echo "<label> Fecha ". mb_convert_encoding(strftime('%a %e %b %Y', $desde->getTimestamp()), 'UTF-8', 'ISO-8859-1')."</label></br>";
                    }else{
                        $hasta = new DateTime($valores['fecha_fin']);
                        echo "<label> Desde ". mb_convert_encoding(strftime('%a %e %b %Y', $desde->getTimestamp()), 'UTF-8', 'ISO-8859-1'). " Hasta ". mb_convert_encoding(strftime('%a %e %b %Y', $hasta->getTimestamp()), 'UTF-8', 'ISO-8859-1'). "</label></br>";
                    }
                    
                    echo "<center><img src='https://softecuestre.com.ar/imagenes/clubes/" . $valores['logo_club'] . "' alt='" . $valores['Nombre'] . "' ></br></center>";
                    echo "<label>".$valores['Nombre']."</label>";
                    echo "</button>";
                    echo "</div>";
                    echo "</form>";
                }    
            }
            ?>

 
  </section>
</main>
<div>
    	<?PHP 
        	 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
	?>    
</div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".vertical-center-4").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 4,
        slidesToScroll: 2
      });
      $(".vertical-center-3").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".vertical-center-2").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });
      $(".vertical-center").slick({
        dots: true,
        vertical: true,
        centerMode: true,
      });
      $(".vertical").slick({
        dots: true,
        vertical: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
</script>



</body>
</html>
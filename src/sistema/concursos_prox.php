<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
	//$evento = $_POST['Id_evento'];
	//$lugar_evento= "City%20Bell";
	//$lugar_evento= "olavarria";
	//$lugar_evento= "Mar%20del%20Plata";
	$lugar_evento= "Tandil";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Concursos</title>
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
			background-color: #1C293A;
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
		

    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .fila:nth-child(odd) {
        background-color: #f2f2f2; /* color para filas impares */
    }

    .fila:nth-child(even) {
        background-color: #ffffff; /* color para filas pares */
    }
    
    .frmingreso {
	padding-right: 80px;
    border: 2px solid;
    display: inline-block;
    }

</style>		
</head>
<body>
<script type="text/javascript" language="javascript-2.1.1">
<!--
function printPage()
{
    document.getElementById('print').style.visibility = 'hidden';
    // Do print the page
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
    document.getElementById('print').style.visibility = '';
}
//-->
</script>    
<div>
    	<?PHP 
            include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
            $ap = "";
            if ($evento = $_POST['Id_evento']) {
                $query1 = $mysqli->query("SELECT * FROM prueba WHERE Id_evento = '" . $evento . "' ORDER BY dia ASC, CAST(Nro_prueba AS UNSIGNED) ASC");

                // consulta para obtener el valor de `ap` del evento correspondiente
                $query_evento = $mysqli->query("SELECT ap, cierre_insc, fecha FROM evento WHERE Id_evento = '" . $evento . "'");
                $evento_data = mysqli_fetch_assoc($query_evento);
                $ap = $evento_data['ap'];
                $cierre = $evento_data['cierre_insc'];
                $dia_conc = new DateTime($evento_data['fecha']);
                $dia_conc1 = $dia_conc->format('Y-m-d');
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $hoy = date('Y-m-d H:i:s');
                $hoy1 = date_create(); // Crear un objeto DateTime para la fecha actual
 	?>    
</div>
<header>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
 	<h1>Pruebas y Campeonatos</h1>
</header>
<main>
    <fieldset>
        <div>
            <center>
            <?php
                if ($ap<>""){
                    echo "<center>";
                    echo "<a title='Bases' href='https://softecuestre.com.ar/imagenes/ap/".$ap."'>
                    <img src='https://softecuestre.com.ar/images/anteprograma concurso.png' alt='Anteprograma' height='50' />
                    </a>";
                    echo "</center>";
                }else{
                    echo "<center>";
                    echo "<img src='https://softecuestre.com.ar/images/anteprograma concurso.png' alt='Anteprograma' height='50' />";
                    echo "</center>";
                }    
            ?>
            <img src='https://softecuestre.com.ar/images/reserva boxes.png' alt='Reserva de Boxes' height='50' />
            
                <?php 
                    if($cierre>$hoy){
                        echo "<a title='Inscripciones' href='https://softecuestre.com.ar/src/inscripciones/inscripciones.php?valor=".$evento."'>
                        <img src='https://softecuestre.com.ar/images/inscripciones.png' alt='Inscripciones' height='50' />
                        </a>";
                    }
            $diferencia = $hoy1->diff($dia_conc);
            $dias = $diferencia->days;
            if($dias<=4){  // como tengo pronóstico solo a 5 días hago el control
                //codigo para api de pronostico
                // URL de la API
                $url = 'https://api.openweathermap.org/data/2.5/forecast?q='.$lugar_evento.',AR&units=metric&lang=sp&mode=xml&appid=e0dec802a7c9ccb63fab0d39053aa723';

                // Realizar la solicitud a la API y obtener la respuesta XML    
                $response = file_get_contents($url);

                // Procesar la respuesta XML
                $xml = new SimpleXMLElement($response);

                // Obtener los datos que necesitas del XML
                $location = $xml->location;
                $forecastTimes = $xml->forecast->time;
                
                
                 // Variables para almacenar el pronóstico del tiempo
                    $temperatura = '';
                    $min = '';
                    $max = '';
                    $viento = '';
                    $precipitacion = '';
                    $nube = '';
                    $ST = '';
                
                
                // Recorrer los datos y hacer algo con ellos
                foreach ($forecastTimes as $time) {
                    $from = (string)$time['from'];
                    $to = (string)$time['to'];
                    if (substr($dia_conc1, 0, 10) === substr($from, 0, 10) ) {
                        if(substr($from, 10, 9)==="T15:00:00"){
                            $temperatura = (string)$time->temperature['value'];
                            $min = (string)$time->temperature['min'];
                            $max = (string)$time->temperature['max'];    
                            $viento = (string)$time->windSpeed['mps'];
                            $viento = $viento." m/s ".(string)$time->windSpeed['name'];
                            $precipitacion = (string)$time->precipitation['probability'];
                            $nube = (string)$time->clouds['value'];
                            $ST = (string)$time->feels_like['value'];
                        }        
                    }
                }

    ?>
                <br>
                <fieldset class="frmingreso">
                    <legend>Pronóstico del tiempo para 15:00 hs del dia del concurso en: <?php echo $lugar_evento?></legend>
                            <?php echo "<b>"; ?>
                            <?php echo "Temperatura: ".$temperatura."° Min ".$min."° Max ".$max."° ST ".$ST."°" ?><br>
                            <?php echo "Viento: ".$viento ?><br>
                            <?php echo "Lluvia: ".$precipitacion." %" ?><br>
                            <?php echo "Nubosidad: ".$nube;  ?><br>
                            <?php echo "</b>"; ?>
                </fieldset>
<?php  } ?>
            </center>
        </div>
    </fieldset>
        <?php
                while ($valores1 = mysqli_fetch_array($query1)) {
                    $consulta = "SELECT * FROM categoria WHERE Id_categoria = " . $valores1['Id_categoria'] ;
                    if ($resultado = $mysqli->query($consulta)) {
                        while ($fila = $resultado->fetch_row()) {
                            $cat = $fila[1];
                        }
                        $resultado->close();
                    }

                    $consulta1 = "SELECT * FROM Art_Def WHERE Id_Art_Def = " . $valores1['Id_Art_Def'] ;
                    if ($resultado1 = $mysqli->query($consulta1)) {
                        while ($fila1 = $resultado1->fetch_row()) {
                            $def = $fila1[1];
                            $art = $fila1[2];
                        }
                        $resultado1->close();
                    }
                    
                    $consulta2 = "SELECT * FROM pista WHERE id_pista = " . $valores1['pista'] ;
                    if ($resultado2 = $mysqli->query($consulta2)) {
                        while ($fila2 = $resultado2->fetch_row()) {
                            $pista = $fila2[1];
                        }
                        $resultado2->close();
                    }
                    $consulta3 = "SELECT * FROM piso WHERE id_piso = " . $valores1['piso'] ;
                    if ($resultado3 = $mysqli->query($consulta3)) {
                        while ($fila3 = $resultado3->fetch_row()) {
                            $piso = $fila3[1];
                        }
                        $resultado3->close();
                    }
                    
                    setlocale(LC_TIME, 'es_ES.UTF-8');
                    $nombre_dia = strftime('%A %e', strtotime($valores1["dia"]));
                  ?>
    <fieldset>
        <div>
            <b>    
            <label for="<?php $valores1['Nro_prueba']; ?>"><?php echo $nombre_dia; ?> </br>
            Prueba <?php echo $valores1['Nro_prueba']; ?></br> 
            Categ. <?php echo $cat; ?> </b>
            Def. <?php echo $def; ?> 
            Art. <?php echo $art; ?> 
            <b>Pista </b><?php echo $pista; ?> -
            <b>Piso </b><?php echo $piso; ?>
            </label>
            
            <input type="hidden" name="prueba_id[]" value="<?php echo $valores1['Id_prueba']; ?>" >
        </div>
        <div>
            
                <?php
                    if($valores1['iniciada']==3){
                        echo "<a href='https://softecuestre.com.ar/src/sistema/resultados.php?prueba=".$valores1['Id_prueba']."'>";
                        echo "<img src='https://softecuestre.com.ar/images/clasificacion.png' height='50'  alt='Resultados'>";
                        echo "</a>";
                    }elseif($valores1['iniciada']==0){
                        echo "<img src='https://softecuestre.com.ar/images/prueba sin iniciar.png' height='50'  alt='Sin Iniciar'>";
                    }elseif($valores1['iniciada']==1){
                        echo "<a href='https://softecuestre.com.ar/src/sistema/resultado.php?prueba=".$valores1['Id_prueba']."'>";
                        echo "<img src='https://softecuestre.com.ar/images/prueba iniciada.png' height='50'  alt='Prueba Iniciada'>";
                        echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=50x50&margin=0&color=000000&bgcolor=FFFFFF&data=https://softecuestre.com.ar/src/sistema/resultados.php?prueba=".$valores1['Id_prueba']."' alt='Resultados en vivo'>";
                        echo "</a>";
                    }elseif($valores1['iniciada']==4){
                        echo "<a>";
                        echo "<img src='https://softecuestre.com.ar/images/prueba iniciada.png' height='50'  alt='Prueba de Tiempo Optimo'>";
                        echo "</a>";    
                    }else{    
                        echo "<a href='https://softecuestre.com.ar/src/sistema/resultado.php?prueba=".$valores1['Id_prueba']."'>";
                        echo "<img src='https://softecuestre.com.ar/images/prueba iniciada.png' height='50'  alt='Segundo Recorrido'>";
                        echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=50x50&margin=0&color=000000&bgcolor=FFFFFF&data=https://softecuestre.com.ar/src/sistema/resultados.php?prueba=".$valores1['Id_prueba']."' alt='Resultados en vivo'>";
                        echo "</a>";
                    }
                ?>
                <a href="https://softecuestre.com.ar/src/inscripciones/lista.php?prueba=<?php echo $valores1['Id_prueba']; ?>">
                      <img src='https://softecuestre.com.ar/images/lista.png' height='50'  alt='Lista'>
                </a>
                  <img src='https://softecuestre.com.ar/images/plano.png' alt='Plano Recorrido' height='50' />
        </div>
    </fieldset>	
                  <?php
                   
                 }
            }
 
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
    
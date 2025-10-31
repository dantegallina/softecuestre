<?php
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesión

// Verifica si la sesión está abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/loging.php"); // Redirige a la página de login
    exit();
}
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Padock</title>
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
    form {
			background-color: #FFFFFF;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			margin: 20px auto;
			max-width: 800px;
			padding: 20px;
			text-align: left;
		}
		input[type="text"],
		select {
			border-radius: 5px;
			border: 1px solid #CCCCCC;
			box-sizing: border-box;
			font-family: Arial, sans-serif;
			font-size: 16px;
			margin-bottom: 10px;
			padding: 10px;
			width: 100%;
		}
		input[type="checkbox"] + label {
			margin-left: 10px;
		}
		input[type="submit"] {
			background-color: #1C293A;
			border: none;
			border-radius: 5px;
			color: #FFFFFF;
			cursor: pointer;
			font-family: Arial, sans-serif;
			font-size: 16px;
			margin-top: 10px;
			padding: 10px 20px;
		}
		span {  
            cursor:pointer  
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
 	<h1>Padock</h1>
</header>
<main>
<form name="f1" action="inscribep.php" method="post">
    <fieldset>
   
        <legend>Seleccione el concurso de su interés</legend>
        <select  name="concurso" id="concurso" onchange="enviar_valores(this.value);" required >
            <option value="">Seleccionar opción</option>
         
            <?php
           $fecha = date('Y-m-d');
    if(isset($_SESSION['eventos_id'])) {
        // Accede al valor de la variable de sesión eventos_id
        $eventos_id = $_SESSION['eventos_id'];
    
        // Convierte el array de eventos_id en una cadena separada por comas para usar en la cláusula IN de la consulta SQL
        $eventos_id_str = implode(',', $eventos_id);

        if(trim($eventos_id_str) == "0"){
            $query = $mysqli -> query ("SELECT * FROM evento order by fecha");
        }else{
            $query = $mysqli -> query ("SELECT * FROM evento WHERE Id_evento IN ($eventos_id_str) order by fecha");
        }


           
    
 	while ($valores = mysqli_fetch_array($query)) {
	 if ($valores['fecha_fin']>=$fecha){
	    	if (isset($_GET['valor'])) {
      			$valor=$_GET['valor'];
      			if ($valor==$valores['Id_evento']) {
        			echo '<option value="'.$valores['Id_evento'].'" selected>'.$valores['Nombre'].'</option>';
      			}else{
        			echo '<option value="'.$valores['Id_evento'].'">'.$valores['Nombre'].'</option>';
      			}
    		}else{
      			echo '<option value="'.$valores['Id_evento'].'">'.$valores['Nombre'].'</option>';   
    		}
  	}else{
    		echo '<option value="'.$valores['Id_evento'].'" disabled>'.$valores['Nombre'].'</option>';
  	}
	}
}else{
    echo "No hay eventos para seleccionar";
}
         ?>
        </select>
     </fieldset>
     

 <fieldset>
        <legend>JINETE</legend>

           <div id="dos" name="dos"  >
 				<input type="text" placeholder="Ingrese el nombre y apellido del jinete" name="jinete_no_federado" id='jinete_no_federado' required>
				Categoría :
				<select name="categoria_jinete_no_federado" id="categoria_jinete_no_federado" required>
				    <option value="SD">Sin Definición</option>
				    <option value="LIBRE">LIBRE</option>
				    <option value="UNICA">UNICA</option>
				    <option value="CN">CN</option>
				    <option value="Pony">Pony</option>				    
				    <option value="Iniciados Menor">Iniciados Menor</option>
				    <option value="Iniciados Mayor">Iniciados Mayor</option>
				    <option value="Escuela Menor">Escuela Menor</option>
				    <option value="Escuela Mayor">Escuela Mayor</option>
				    <option value="Children">Children</option>
				    <option value="Amateur">Amateur</option>
				    <option value="Tercera">Tercera</option>
				    <option value="Segunda">Segunda</option>
				    <option value="Primera">Primera</option>
				    <option value="Pre Junior">Pre Junior</option>				    
				    <option value="Junior">Junior</option>
				    <option value="Young Rider">Young Rider</option>
				    <option value="U25">U25</option>				    
				</select>
				
                Club :<input type="text" placeholder="Ingrese el club al cual pertenece" name="club_jinete_no_federado" id='club_jinete_no_federado' required>
          </div>
</fieldset>	

<fieldset>
        <legend>CABALLO</legend>
            <div id="cuatro" name="cuatro" >
				    <input type="text" placeholder="Ingrese el nombre del caballo" name="caballo_no_federado" id='caballo_no_federado' required>
            </div>	 

</fieldset>	
				
<fieldset>
        <legend>PRUEBAS Y CAMPEONATOS</legend>
        <div id="opcion-seleccionada">
        <?php
        if (isset($valor)){

                $query1 = $mysqli->query("SELECT * FROM prueba WHERE Id_evento = '" . $mysqli->real_escape_string($valor) . "' ORDER BY dia ASC, CAST(Nro_prueba AS UNSIGNED) ASC");
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
                    setlocale(LC_TIME, 'es_ES.UTF-8');
                    $dia = strftime('%A %e', strtotime($valores1["dia"]));                    
                  ?>
                  <label for="<?php $valores1['Nro_prueba']; ?>"><b><?php echo $dia; ?></b> Prueba <?php echo $valores1['Nro_prueba']; ?> Categ. <?php echo $cat; ?></label><input type="checkbox" name="prueba_id[]" value="<?php echo $valores1['Id_prueba']; ?>"></br>
                  <?php
                   
                 }
            }
 
        ?>
      </div>

</fieldset>	



<fieldset>
  <input type="submit" name="enviarCorreo" value="REGISTRAR INSCRIPCION" />
</fieldset>
</form>
</main>



<div>
    	<?PHP 
        	 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
	?>    
</div>
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
  function enviar_valores(valor){
      //Pasa los parámetros a la pagina buscar
      location.href='https://softecuestre.com.ar/src/inscripciones/padock.php?valor=' + valor;
     }
     
      $( "#selec" ).click( function() {
            $.ajax(
                {
                    url: 'https://softecuestre.com.ar/src/inscripciones/archivo.php?term=' + $( "#search_jinete").val(),
                    success: function( data ) {
                        if ( data.length == 1 ) {
 
                        } else {
                            $('#categoria_jinete_federado').val(data[3] );
                            $('#hidden_categoria_jinete_federado').val(data[3]);
                                                       
                            $('#f_nac_federado').val(data[5] );
                            $('#hidden_f_nac_federado').val(data[5]);

                            $('#club_jinete_federado').val(data[4] );
                            $('#hidden_club_jinete_federado').val(data[4]);
                            
                            $('#licencia_jinete_federado').val(data[2] );
                            $('#hidden_licencia_jinete_federado').val(data[2]);
                        } 
                    },
                    dataType: 'json',
                }
            );
        }
    );

  </script>

</html>
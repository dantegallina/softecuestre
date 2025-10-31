<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Inscripciones</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="https://softecuestre.com.ar/js/jquery.js"></script>
	<script type="text/javascript" src="https://softecuestre.com.ar/js/interface.js"></script>
	
<!--[if lt IE 7]>
 	<style type="text/css">
 		div, img { behavior: url(iepngfix.htc) }
 	</style>
<![endif]-->

<link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
<style>
/* Media queries para tabletas */

@media (max-width: 768px) {
  body {
    font-size: 14px;
  }

  header {
    padding: 5px;
  }

  form {
    padding: 5px;
  }
}

/* Media queries para teléfonos móviles */

@media (max-width: 480px) {
  body {
    font-size: 12px;
  }

  header {
    padding: 2px;
  }

  form {
    padding: 2px;
  }
}


/* Estilos generales */

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

</head>
<body>
<div>
    	<?PHP 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
        	 $valor=$_GET['valor'];
 	?>    
</div>
<header>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
 	<h1>Inscripciones</h1>
</header>
<main>
<form name="f1" action="inscribe.php" method="post" onsubmit="return validarDatos();">
    <input type="hidden" name="evento" id="evento" value="<?php echo $valor; ?>">
     <fieldset>
        <legend>Información de contacto</legend>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
    </fieldset>
    <fieldset>
        <legend>INFORMACIÓN</legend>
            <p>Busque su nombre en la lista y presione el botón Seleccionar, el sistema le traerá automáticamente sus datos.</p>
            <!-- <p>Si no se encuentra, por favor, ingrese a este <strong><a href="https://docs.google.com/forms/d/e/1FAIpQLSeND2sFWcGuXGagLtOtBdE8OLsrYDBC-6s_p_i9XAIHPjY78g/viewform">FORMULARIO DE GOOGLE</a></strong></p>-->
            <p>Si no se encuentra, por favor envíe un correo electrónico a <strong><a href="mailto:inscripciones@softecuestre.com.ar">inscripciones@softecuestre.com.ar</a></strong> con la siguiente información:</p>    
            <ul>
                <li>Nombre y Apellido</li>
                <li>DNI</li>
                <li>Fecha de Nacimiento</li>
                <li>Categoría</li>
                <li>Club al que pertenece</li>
                <li>Caballo con el que participa</li>
                <li>Teléfono de contacto</li>
            </ul>
            
    </fieldset>
 <fieldset>
       <legend>JINETE</legend>
            <div id="uno" name="uno" >
                <p>
					<input type="text" list="multiple" placeholder="Ingrese el nombre o apellido del jinete" name="search_jinete" id='search_jinete' value="" required>
					<input type="button" name="selec" id="selec" value="Seleccionar">
					<p><datalist id="multiple" style="display: none;" size="10"></datalist></p>
					<!-- <p><select id="multiple" style="display: none;" size="10"></select></p> -->
					
					F. Nacimiento :<input type="text" placeholder="Fecha de Nacimiento" name="f_nac_federado" id='f_nac_federado' value="" disabled="disabled" required>
                    <input type="hidden" name="hidden_f_nac_federado" id="hidden_f_nac_federado" value="" >
					
					Categoría :<input type="text" placeholder="Categoría del jinete" name="categoria_jinete_federado" id='categoria_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_categoria_jinete_federado" id="hidden_categoria_jinete_federado" value="">

					Club :<input type="text" placeholder="Club al cual pertenece" name="club_jinete_federado" id='club_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_club_jinete_federado" id="hidden_club_jinete_federado" value="">
                    
                    Licencia :<input type="text" placeholder="Licencia FEA" name="licencia_jinete_federado" id='licencia_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_licencia_jinete_federado" id="hidden_licencia_jinete_federado" value="">
                    
					Teléfono :<input type="text" placeholder="Ingrese un Teléfono con WhatsApp" name="tel_jinete_federado" id='tel_jinete_federado' >
	            </p>
            </div>
   
</fieldset>	

<fieldset>
    <legend>CABALLO</legend>
        <div id="tres" name="tres" >
                <p>
                    <input type="text" list="multiple1" placeholder="Ingrese el nombre o pasaporte" name="search_caballo" id='search_caballo' value="" required>
                    <input type="button" name="selec_cab" id="selec_cab" value="Seleccionar">
                    <p><datalist id="multiple1" style="display: none;" size="10"></datalist></p>
                    <!-- <p><select id="multiple1" style="display: none;" size="10"></select></p> -->
                    
                    Pasaporte :<input type="text" placeholder="pasaporte" name="pasaporte" id='pasaporte' value="" disabled="disabled" required>
                    <input type="hidden" name="hidden_pasaporte" id="hidden_pasaporte" value="" >
                </p>
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
                    $dia = strftime('%A', strtotime($valores1["dia"]));                    
                  ?>
                  <label for="<?php $valores1['Nro_prueba']; ?>"><b><?php echo $dia; ?></b> P. <?php echo $valores1['Nro_prueba']; ?> Cat. <?php echo $cat; ?> Pista <?php echo $piso; ?></label><input type="checkbox" name="prueba_id[]" value="<?php echo $valores1['Id_prueba']; ?>" ></br>
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


<div style="color:#FFFFFF">
<fieldset>
Con el fin de validar su información le enviaremos a su dirección de correo un mensaje que le agradeceremos tramitar para completar su inscripción .
Para el proceso de inscripción su dirección de correo electrónico es indispensable, esto nos permitirá informarle sobre cualquier cambio o novedad. 
Si usted no tiene una, por favor creela utilizando los servicios de gmail.com, hotmail.com o cualquier otro servicio similar. Estos servicios son gratuitos y el proceso le tomará solamente unos pocos minutos.
</fieldset>
</div>

<div>
    	<?PHP 
        	 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
	?>    
</div>
</body>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $("#search_jinete").on('input', function() {
    $('#multiple').hide();
    $.ajax({
        url: 'https://softecuestre.com.ar/src/inscripciones/get_matches.php?term=' + encodeURIComponent($(this).val()),
        success: function(data) {
            if (data.length == 1) {
                $('#search_jinete').val(data[0]);
            } else {
                if (data.length > 1) {
                    $("#multiple").find('option').remove();
                    data.forEach(function(e) {
                        $("#multiple").append("<option>" + e + "</option>");
                    });
                    $("#multiple").prop('size', data.length);
                    $("#multiple").show();
                }
            }
        },
        dataType: 'json'
    });
});

$("#multiple").click(function() {
    $('#search_jinete').val($(this).val());
    $('#multiple').hide();
});


 
    $( "#search_caballo" ).on( 'input', function() {
            $('#multiple1').hide();
            $.ajax(
                {
                    url: 'https://softecuestre.com.ar/src/inscripciones/get_matches_caballos.php?term=' + encodeURIComponent($(this).val()),
                    success: function( data ) {
                        if ( data.length == 1 ) {
                            $('#search_caballo').val( data[0], data[1] );
                        } else {
                            if ( data.length > 1 ) {
                                $("#multiple1").find('option').remove();
                                data.forEach( function(e) {
                                    $("#multiple1").append("<option>" + e + "</option>");
                                });
                                $("#multiple1").prop( 'size', data.length );
                                $("#multiple1").show();
                            }
                        } 
                    },
                    dataType: 'json',
                }
            );
        }
    );
    
    $( "#multiple1" ).click( function() {
        $('#search_caballo').val( $(this).val() );
        $('#multiple1').hide();
    }
    );
    
 
    function enviar_valores(valor){
      //Pasa los parámetros a la pagina buscar
      location.href='https://softecuestre.com.ar/src/inscripciones/inscripciones.php?valor=' + valor;
     }
     
      $( "#selec" ).click( function() {
            $.ajax(
                {
                    url: 'https://softecuestre.com.ar/src/inscripciones/archivo.php?term=' + $("#search_jinete").val(),
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


      $( "#selec_cab" ).click( function() {
            $.ajax(
                {
                    url: 'https://softecuestre.com.ar/src/inscripciones/archivo_cab.php?term=' + $("#search_caballo").val(),
                    success: function( data ) {
                        if ( data.length == 1 ) {
 
                        } else {
                            $('#pasaporte').val(data[2] );
                            $('#hidden_pasaporte').val(data[2]);
                        } 
                    },
                    dataType: 'json',
                }
            );
        }
    );


 function validarDatos() {
     
   // Verificar campos requeridos
  if (!document.getElementById('f_nac_federado').value) {
    alert('Debes seleccionar el jinete de la lista y luego presionar el botón para que el sistema cargue los datos automáticamente');
    return false; // Detiene el envío del formulario
  }

  // Verificar casillas seleccionadas
  if (!validarCasillas()) {
    return false; // Detiene el envío del formulario
  }

  
  
   // Si todas las validaciones pasan, se puede enviar el formulario
    return true;
  
}

function validarCasillas() {
  var checkboxes = document.getElementsByName('prueba_id[]');
  var checked = false;
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checked = true;
      break;
    }
  }
  if (!checked) {
    alert('Debes seleccionar al menos una opción de prueba');
    return false;
  }
  return true;
}



</script>


</html>
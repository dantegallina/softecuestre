<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Padock</title>
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


//Mostrar u ocultar según checkbox

function toggleCheckbox(clickedCheckboxId) {
  const checkbox1 = document.getElementById("checkbox1");
  const checkbox2 = document.getElementById("checkbox2");
  const checkbox3 = document.getElementById("checkbox3");
  const checkbox4 = document.getElementById("checkbox4");
 
  
  sj = document.getElementById('search_jinete');
  jinetenofed = document.getElementById('jinete_no_federado');
  catjinetenofed = document.getElementById('categoria_jinete_no_federado');
  clubjinetenofed = document.getElementById('club_jinete_no_federado');
  teljinetenofed = document.getElementById('tel_jinete_no_federado');
  teljinetefed = document.getElementById('tel_jinete_federado');

  sc = document.getElementById('search_caballo');
  caballonofed = document.getElementById('caballo_no_federado');
  div1=document.getElementById('uno');
  div2=document.getElementById('dos')
  
  div3=document.getElementById('tres');
  div4=document.getElementById('cuatro')
  
  
  if (clickedCheckboxId === "checkbox1" && checkbox1.checked) {
    checkbox2.checked = false;
	sj.disabled = false;
	teljinetefed.disabled = false;
	
	jinetenofed.disabled = true;
  catjinetenofed.disabled = true;
  clubjinetenofed.disabled = true;
  teljinetenofed.disabled = true;
  div1.style.display='block';
  div2.style.display='none';

  } else if (clickedCheckboxId === "checkbox2" && checkbox2.checked) {
    checkbox1.checked = false;
	sj.disabled = true;
	teljinetefed.disabled = true;
	
	jinetenofed.disabled = false;
  catjinetenofed.disabled = true;
  clubjinetenofed.disabled = false;
  teljinetenofed.disabled = false;
  div1.style.display='none';
  div2.style.display='block';

  }
  
  

   if (clickedCheckboxId === "checkbox3" && checkbox3.checked) {
    checkbox4.checked = false;
	sc.disabled = false;
	caballonofed.disabled = true;
    div3.style.display='block';
    div4.style.display='none';

  } else if (clickedCheckboxId === "checkbox4" && checkbox4.checked) {
    checkbox3.checked = false;
	sc.disabled = true;
	caballonofed.disabled = false;
    div3.style.display='none';
	div4.style.display='block';
	
  }
}


</script>	
</head>
<body>

<header>
<img src="http://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
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
           $query = $mysqli -> query ("SELECT * FROM evento order by fecha");
    
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

         ?>
        </select>
     </fieldset>
     

 <fieldset>
        <legend>JINETE</legend>
						<input type="checkbox" id="checkbox1" onclick="toggleCheckbox(this.id)"><label for="checkbox1">FEDERADO</label>
						<input type="checkbox" id="checkbox2" onclick="toggleCheckbox(this.id)"><label for="checkbox2">NO FEDERADO</label>
						
            <div id="uno" name="uno" style="display:none" >
                <p>
					<input type="text" placeholder="Ingrese el nombre o apellido del jinete" name="search_jinete" id='search_jinete' value="" disabled="disabled">
					<p><select id="multiple" style="display: none;" size="10"></select></p>
					Categoría :<input type="text" placeholder="Categoría del jinete" name="categoria_jinete_federado" id='categoria_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_categoria_jinete_federado" id="hidden_categoria_jinete_federado" value="">

					Club :<input type="text" placeholder="Club al cual pertenece" name="club_jinete_federado" id='club_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_club_jinete_federado" id="hidden_club_jinete_federado" value="">
                    
                    Licencia :<input type="text" placeholder="Licencia FEA" name="licencia_jinete_federado" id='licencia_jinete_federado' value="" disabled="disabled">
                    <input type="hidden" name="hidden_licencia_jinete_federado" id="hidden_licencia_jinete_federado" value="">
                    
					Teléfono :<input type="text" placeholder="Ingrese un Teléfono con WhatsApp" name="tel_jinete_federado" id='tel_jinete_federado' disabled="disabled">
	            </p>
            </div>
            
           <div id="dos" name="dos" style="display:none" >
            <p>
				<input type="text" placeholder="Ingrese el nombre y apellido del jinete" name="jinete_no_federado" id='jinete_no_federado' disabled="disabled">
				Categoría :<input type="text" placeholder="Categoría del jinete" name="categoria_jinete_no_federado" id='categoria_jinete_no_federado' value="LIBRE" disabled="disabled">
                Club :<input type="text" placeholder="Ingrese el club al cual pertenece" name="club_jinete_no_federado" id='club_jinete_no_federado' disabled="disabled">
                Teléfono :<input type="text" placeholder="Ingrese un Teléfono con WhatsApp" name="tel_jinete_no_federado" id='tel_jinete_no_federado' disabled="disabled">
            </p>
        </div>
</fieldset>	

<fieldset>
        <legend>CABALLO</legend>
						<input type="checkbox" id="checkbox3" onclick="toggleCheckbox(this.id)"><label for="checkbox3">FEDERADO</label>
						<input type="checkbox" id="checkbox4" onclick="toggleCheckbox(this.id)"><label for="checkbox4">NO FEDERADO</label>
						
            <div id="tres" name="tres" style="display:none" >
                <p>
                    <input type="text" placeholder="Ingrese el nombre o pasaporte" name="search_caballo" id='search_caballo' value="" disabled="disabled">
                    <p><select id="multiple1" style="display: none;" size="10"></select></p>
                    
                    Pasaporte :<input type="text" placeholder="pasaporte" name="pasaporte" id='pasaporte' value="" disabled="disabled">
                    <input type="hidden" name="hidden_pasaporte" id="hidden_pasaporte" value="">
                </p>
            </div>
            <div id="cuatro" name="cuatro" style="display:none" >
				    <input type="text" placeholder="Ingrese el nombre del caballo" name="caballo_no_federado" id='caballo_no_federado' disabled="disabled">
            </div>	 

</fieldset>	
				
<fieldset>
        <legend>PRUEBAS Y CAMPEONATOS</legend>
        <div id="opcion-seleccionada">
        <?php
        if (isset($valor)){

                $query1 = $mysqli->query("SELECT * FROM prueba WHERE Id_evento = '" . $mysqli->real_escape_string($valor) . "' ORDER BY `Nro_prueba` ASC");
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
                  ?>
                  <label for="<?php $valores1['Nro_prueba']; ?>">Prueba <?php echo $valores1['Nro_prueba']; ?> Categ. <?php echo $cat; ?> Def. <?php echo $def; ?> Art. <?php echo $art; ?> Pista <?php echo $valores1['pista']; ?></label><input type="checkbox" name="prueba_id[]" value="<?php echo $valores1['Id_prueba']; ?>" ></br>
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
    $( "#search_jinete" ).on( 'input', function() {
            $('#multiple').hide();
            $.ajax(
                {
                    url: 'http://softecuestre.com.ar/src/inscripciones/get_matches.php?term=' + $(this).val(),
                    success: function( data ) {
                        if ( data.length == 1 ) {
                            $('#search_jinete').val( data[0] );
                        } else {
                            if ( data.length > 1 ) {
                                $("#multiple").find('option').remove();
                                data.forEach( function(e) {
                                    $("#multiple").append("<option>" + e + "</option>");
                                });
                                $("#multiple").prop( 'size', data.length );
                                $("#multiple").show();
                            }
                        } 
                    },
                    dataType: 'json',
                }
            );
        }
    );
    
    $( "#multiple" ).click( function() {
        $('#search_jinete').val( $(this).val() );
        $('#multiple').hide();
    }
    );
 
    $( "#search_caballo" ).on( 'input', function() {
            $('#multiple1').hide();
            $.ajax(
                {
                    url: 'http://softecuestre.com.ar/src/inscripciones/get_matches_caballos.php?term=' + $(this).val(),
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
      location.href='http://softecuestre.com.ar/src/inscripciones/padock.php?valor=' + valor;
     }
     
      $( "#search_jinete" ).click( function() {
            $.ajax(
                {
                    url: 'http://softecuestre.com.ar/src/inscripciones/archivo.php?term=' + $(this).val(),
                    success: function( data ) {
                        if ( data.length == 1 ) {
 
                        } else {
                            $('#categoria_jinete_federado').val(data[3] );
                            $('#hidden_categoria_jinete_federado').val(data[3]);

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
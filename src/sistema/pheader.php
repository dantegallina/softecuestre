<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');

$evento = $_POST['id_evento'];

//Id_prueba
//activa
//iniciada
//Nro_prueba
//Id_evento
//Id_categoria
//Id_Art_Def
//Tiempo_Acordado
//Tiempo_Limite
//Tiempo_Optimo
//Porc_premio
//Porc_2R
//Obs


   // Enviar consulta
      $instruccion = "select * from prueba WHERE Id_evento=".$evento." ORDER BY dia ASC, CAST(Nro_prueba AS UNSIGNED) ASC";
      $consulta = mysqli_query ($conexion, $instruccion)
         or die ("Fallo en la consulta 1");

   // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);
 
?>


    



<div class="ctabla" id="header-prueba">
    <h2>Prueba</h2>
    <div class="cfila">
        <div class="ccol"><label>Activo</label></div>
        <div class="ccol"><label>Iniciada</label></div>
        <div class="ccol"><label>Nro Prueba</label></div>
	    <div class="ccol"><label>Categoria</label></div>
        <div class="ccol"><label>Definici&oacute;n</label></div>
        <div class="ccol"><label>Velocidad TA</label></div>
        <div class="ccol"><label>Longitud</label></div>
        <div class="ccol"><label>Tabla</label></div>
        <div class="ccol"><label>TA</label></div>
        <div class="ccol"><label>Velocidad TO</label></div>
        <div class="ccol"><label>TO</label></div>
        <div class="ccol"><label>TL</label></div>
		<div class="ccol"><label>% Premio</label></div>
	<div class="ccol"><label>Observaciones</label></div>        
	<div class="ccol"><label>Mensaje</label></div> 
    </div>

<?php

 for ($i=0; $i<$nfilas; $i++) {
    $resultado = mysqli_fetch_array ($consulta);
     //var_dump($resultado);

    $sql_cat = "SELECT * FROM categoria WHERE Id_categoria=".$resultado['Id_categoria'];
    $mando_cat = mysqli_query($conexion, $sql_cat) or die ("No Hay categorias para mostrar");
    $comando_cat = mysqli_fetch_array ($mando_cat);
    $categoria = $comando_cat['nom_categ'];

    $sql_def = "SELECT * FROM Art_Def WHERE Id_Art_Def=".$resultado['Id_Art_Def'];
    $mando_def = mysqli_query($conexion, $sql_def) or die ("No Hay definicion para mostrar");
    $comando_def = mysqli_fetch_array ($mando_def);
    $definicion = $comando_def['Definicion']." ".$comando_def['Articulo'];
?>
    <div class="cfila" data-id="<?php echo $resultado['Id_prueba']?>">
        <?php if($resultado['activa']==1){?>
            <div class="ccol">
                <input type="checkbox" id="activa" name="activa" class="activa" value="<?php echo $resultado['activa']?>" checked='checked' />
            </div>
        <?php } else{ ?>
            <div class="ccol">
                <input type="checkbox" id="activa" name="activa" class="activa" value="<?php echo $resultado['activa']?>" />
            </div>
        <?php } ?>
    
    <div class="ccol prueba-int">
        <select id="iniciada<?php echo $resultado['Id_prueba']?>" name="iniciada<?php echo $resultado['Id_prueba']?>" >
            <option value="0" <?php if($resultado['iniciada'] == 0) echo "selected"; ?>>Sin Iniciar</option>
            <option value="1" <?php if($resultado['iniciada'] == 1) echo "selected"; ?>>Iniciada</option>
            <option value="2" <?php if($resultado['iniciada'] == 2) echo "selected"; ?>>Fin 1 round</option>
            <option value="3" <?php if($resultado['iniciada'] == 3) echo "selected"; ?>>Finalizada</option>
            <option value="4" <?php if($resultado['iniciada'] == 4) echo "selected"; ?>>TOD-NO MOSTRAR</option>
        </select>
    </div>


        
        <div class="ccol"><?php echo $resultado['Nro_prueba'] ?></div>
        <div class="ccol"><?php echo $categoria ?></div>
        <div class="ccol"><?php echo $definicion ?></div>
        <div class="ccol prueba-int">
            <input class="input velo-ta" type="text" name="velo_ta" value="<?php echo $resultado['velo_ta']?>" />    
        </div>
        

        <div class="ccol prueba-int">
            <input class="input long-RI" type="text" id="long_RI" name="long_RI" value="<?php echo $resultado['long_RI']?>" data-original="<?php echo $resultado['long_RI']?>" />
        </div>
        <div class="ccol"><?php echo $resultado['tabla'] ?></div>
        <div class="ccol prueba-int">
            <input class="input Tiempo-Acordado" type="text" id="Tiempo_Acordado" name="Tiempo_Acordado" value="<?php echo $resultado['Tiempo_Acordado']?>" />
        </div>
        <div class="ccol prueba-int">
            <input class="input velo-to" type="text" name="velo_to" value="<?php echo $resultado['velo_to']?>" />
        </div>
        
        <div class="ccol prueba-int">
            <input class="input Tiempo-Optimo" type="text" id="Tiempo_Optimo" name="Tiempo_Optimo" value="<?php echo $resultado['Tiempo_Optimo']?>" />
        </div>        
        
        <div class="ccol prueba-int"><input class="input Tiempo-Limite" type="text" id="Tiempo_Limite" name="Tiempo_Limite" value="<?php echo $resultado['Tiempo_Limite']?>" /></div>
		<div class="ccol prueba-int"><input class="input" type="text" id="Porc_premio" name="Porc_premio" value="<?php echo $resultado['Porc_premio']?>" /></div>
	<div class="ccol"><input class="input" type="text" id="Obs" name="Obs" value="<?php echo $resultado['Obs']?>" /></div>        

	<div class="ccol"><input class="input" type="text" id="mensaje" name="mensaje" value="<?php echo $resultado['mensaje']?>" /></div>        
    </div>
 
<?php } ?>
</div>
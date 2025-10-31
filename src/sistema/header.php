<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/function/fechas.php');

// Id_evento
// Activa
// fecha
// Nombre
// club
// tipo_concurso
//logo_club


if(isset($_SESSION['eventos_id'])) {
    // Accede al valor de la variable de sesión eventos_id
    $eventos_id = $_SESSION['eventos_id'];
    
    // Convierte el array de eventos_id en una cadena separada por comas para usar en la cláusula IN de la consulta SQL
    $eventos_id_str = implode(',', $eventos_id);
 

// Enviar consulta
$hoy = 	date('Y-m-d');

if(trim($eventos_id_str) == "0"){
    $instruccion = "select * from evento order by fecha ASC";
}else{
    $instruccion = "select * from evento  WHERE Id_evento IN ($eventos_id_str) order by fecha ASC";
}


//$instruccion = "select * from evento WHERE fecha>='".$hoy."' OR fecha_fin>='".$hoy."'order by fecha ASC";
$consulta = mysqli_query ($conexion, $instruccion) or die ("Fallo en la consulta");

// Mostrar resultados de la consulta
$nfilas = mysqli_num_rows ($consulta);
}else{
    echo "No hay eventos para seleccionar";
}

?>
	<div class="ctabla" id="header-evento">
		<h2>Evento</h2>
        <div class="cfila">
            <div class="ccol"><label>Activo</label></div>
            <div class="ccol"><label>Fecha</label></div>
            <div class="ccol"><label>Nombre</label></div>
            <div class="ccol"><label>Club</label></div>
            <div class="ccol"><label></label></div>
            <div class="ccol"><label>Tipo</label></div>
        </div>


<?php
     for ($i=0; $i<$nfilas; $i++) {
         $resultado = mysqli_fetch_array ($consulta);
         ?>

    <div class="cfila">
        <div class='ccol'>
			<input type='checkbox' name='Activa' class='activa_level1' mm='<?php echo $resultado['Id_evento']?>' 
				<?php if($resultado['activa']==1){?>  checked='checked' <?php } ?> />
		</div>
        
		
		<div class="ccol"><?php echo fsalida($resultado['fecha'])?></div>
		<div class="ccol"><?php echo mb_convert_encoding($resultado['Nombre'], 'UTF-8', 'ISO-8859-1');?></div>
        <div class="ccol"><?php echo mb_convert_encoding($resultado['club'], 'UTF-8', 'ISO-8859-1');?></div>
        <div class="ccol"><img src="https://softecuestre.com.ar/imagenes/clubes/<?php echo $resultado['logo_club']?>" width="40" height="40"/></div>
        <div class="ccol"><?php echo mb_convert_encoding($resultado['tipo_concurso'], 'UTF-8', 'ISO-8859-1');?></div>
    </div>
<?php } ?>
</div>
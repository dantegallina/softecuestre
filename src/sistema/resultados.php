<?php
//set_time_limit(150); 	
include_once($_SERVER['DOCUMENT_ROOT'].'/function/fechas.php'); 
require_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
 $prueba=$_GET['prueba'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" LANG="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title>Clasificación</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
<style type="text/css">
#contenedor
{
	color:#DC7633;
	height:20px;
	overflow:hidden;
	background-color:#900;
	
}
#contenido
{
	color:#ffffff;
	-webkit-animation-name:cintaInformativa;
	-webkit-animation-duration:35s;
	-webkit-animation-iteration-count:infinite;
	-moz-animation-name:cintaInformativa;
	-moz-animation-duration:35s;
	-moz-animation-iteration-count:infinite;
}
@-webkit-keyframes cintaInformativa
{
	from {
		margin-left:100%;
	}
	to {
		margin-left:-150%;
	}
}
@-moz-keyframes cintaInformativa
{
	from {
		margin-left:100%;
	}
	to {
		margin-left:-150%;
	}
}
</style>
</head>
<BODY>
<?PHP

$sql_1 = "SELECT 
    p.`Id_prueba`,
    p.`Id_categoria`,
    p.`pista`,
    p.`long_RI`,
    p.`Id_Art_Def`,
    p.`Nro_prueba`,
    p.`dia`,
    p.`velo_to`,
    p.`velo_ta`,
    p.`tabla`,
    p.`Tiempo_Acordado`,
    p.`Tiempo_Limite`,
    p.`Tiempo_Optimo`,
    p.`Porc_premio`,
    p.`Porc_2R`,
    p.`Obs`,
    p.`mensaje`,
    x.`nom_categ`,
    x.`Id_categoria`,
    e.`Id_Art_Def`,
    e.`Definicion`,
    e.`Articulo`,
    t.`Id_evento`,
    t.`Nombre`,
    t.`club`,
    t.`tipo_concurso`,
    t.`logo_club`
FROM `prueba` p
INNER JOIN `categoria` x ON p.`Id_categoria` = x.`Id_categoria`
INNER JOIN `Art_Def` e ON p.`Id_Art_Def` = e.`Id_Art_Def`
INNER JOIN `evento` t ON p.`Id_evento` = t.`Id_evento`
WHERE p.Id_prueba=$prueba;
";

$encabezado = mysqli_query ($conexion, $sql_1) or die ("NO HAY CONCURSOS EN ESTE MOMENTO");
$qfilas_encabezado = mysqli_num_rows ($encabezado);

if($qfilas_encabezado=1){
	if($resultado_encabezado = mysqli_fetch_array ($encabezado)){
		$evento= $resultado_encabezado['Nombre'];
		$evento_club= $resultado_encabezado['club'];
		$tipo_concurso= $resultado_encabezado['tipo_concurso'];
		$logo_club= $resultado_encabezado['logo_club'];
	    $Nro_prueba = $resultado_encabezado['Nro_prueba'];
    	$categoria = $resultado_encabezado['nom_categ'];
    	$def = $resultado_encabezado['Definicion'];
    	$art = $resultado_encabezado['Articulo'];
    	$definicion = $def." ".$art;
	   	$velo_to = $resultado_encabezado['velo_to'];
	    $velo_ta = $resultado_encabezado['velo_ta'];
	    $tabla = $resultado_encabezado['tabla'];
	    $longitud_RI = $resultado_encabezado['long_RI'];
	    $Tiempo_Acordado = $resultado_encabezado['Tiempo_Acordado'];
	    $Tiempo_Limite = $resultado_encabezado['Tiempo_Limite']; 
	    $Tiempo_Optimo = $resultado_encabezado['Tiempo_Optimo'];
	    $Porc_premio = $resultado_encabezado['Porc_premio'];
	    $Porc_2R = $resultado_encabezado['Porc_2R'];
	    $Obs = $resultado_encabezado['Obs'];
	    $mensaje = $resultado_encabezado['mensaje'];

    }
}	



$SQL="SELECT
    c.`Id_concurso`,
    c.`Id_prueba`, 
    c.`orden_ingreso`, 
    c.`Jinete`,
    c.`licencia_jin`,
    c.`Caballo`,
    c.`licencia_cab`,
    c.`categoria`, 
    c.`Club`,
    c.faltas_RI,
    c.faltas_x_time_RI,
    c.tiempo_RI,
    c.faltas_2R,
    c.faltas_x_time_2R,
    c.tiempo_2R,
    c.faltas_DES,
    c.faltas_x_time_DES,
    c.tiempo_DES,
    c.faltas_TOTAL,
    c.tiempo_tablac,
    c.clasificacion,
    c.`Inicia`,
    c.`finaliza`,
    p.`Id_prueba`
FROM `concurso` c
INNER JOIN `prueba` p ON c.`Id_prueba` = p.`Id_prueba`
WHERE c.Id_prueba = $prueba AND c.finaliza = 1
";
 // ORDER BY p.`Nro_prueba` ASC, CONVERT(c.`orden_ingreso`,SIGNED) ASC;
 //ORDER BY CAST(orden_ingreso AS unsigned) ASC";
 
// ordenar array seg��n...
// ORDER BY categoria ASC, faltas_RI ASC, tiempo_RI ASC
//echo "def test ".$def;

switch ($def) {
    case "TOD": //Tiempo Optimo
        $SQL = $SQL." ORDER BY c.categoria ASC, c.faltas_TOTAL ASC, ROUND(ABS(c.tiempo_RI - $Tiempo_Optimo),2) ASC";
        break;
    case "TD": //Tiempo Directo
        $SQL = $SQL." ORDER BY c.categoria, c.faltas_TOTAL ASC, c.tiempo_RI ASC";
        break;
    case "1D": // 1 Desempate
        $SQL = $SQL." ORDER BY c.categoria, c.faltas_2R IS NULL,c.faltas_2R ASC, c.tiempo_2R ASC, c.faltas_RI ASC, c.tiempo_RI ASC"; //ver si las faltas son las de total o cuales
        break;
    case "2R": // Doble Recorrido
        $SQL = $SQL." ORDER BY c.categoria, c.faltas_TOTAL ASC, c.tiempo_2R ASC"; 
        break;
    case "2F": // 2 Fases
        $SQL = $SQL." ORDER BY c.categoria, c.faltas_2R ASC, c.tiempo_2R ASC, c.faltas_RI ASC, c.tiempo_RI ASC"; //ver si las faltas son las de total o cuales
        break;
    case "2FE": // 2 Fases Especiales
        $SQL = $SQL." ORDER BY c.categoria, c.faltas_TOTAL ASC, c.tiempo_2R ASC";
        break;
    case "Tabla C": //tabla C
        $SQL = $SQL." ORDER BY c.categoria, c.tiempo_tablac ASC";
        break;        
    case "S/D":
        echo "Sin Definicion";
        break;
    
}
    
 ?>



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




</br>
<H1 align="center"><?php print(mb_convert_encoding($evento, 'UTF-8', 'ISO-8859-1')); ?></H1>
<H2 align="center"><?php print($tipo_concurso); ?> </H2>
<H2 align="center">Organiza: <?php print(mb_convert_encoding($evento_club, 'UTF-8', 'ISO-8859-1')); ?>  <img src="https://softecuestre.com.ar/imagenes/clubes/<?php print($logo_club); ?>" width="50" height="50" alt="<?php print($evento_club); ?>" /> Fiscaliza <img src="https://softecuestre.com.ar/images/fei.jpg" width="50" height="50" alt="FEI"/> y <img src="https://softecuestre.com.ar/images/fea.jpg" width="50" height="50" alt="FEA"/></H2>
</br>


<center>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" alt="publi" />

</center>



<H3 align="left">


Prueba N: <?php print($Nro_prueba); ?> </br>
Categoria: <?php print($categoria); ?> - Definicion/Art.: <?php print($definicion); ?> Tabla: <?php print($tabla); ?></br>
Longitud: <?php print($longitud_RI); ?> mts Tiempo Acordado: <?php print($Tiempo_Acordado); ?> seg Velocidad TA: <?php print($velo_ta); ?> m/m Tiempo Limite: <?php print($Tiempo_Limite); ?> seg</br>
<?php 
    if($def=="TOD"){
        echo "Tiempo Optimo: ".$Tiempo_Optimo." seg. Velocidad TO: ".$velo_to." m/m</br>";
    }
?>
Observaciones: <?php print($Obs); ?></br>
</H3>


	<div id="contenedor">
		<div id="contenido">
			<?php //print($mensaje); ?>
		</div>
	</div>
 
<?PHP

$colorfila=0;

//manejo de las categorias y premios
$categoria_anterior = ""; // Variable para almacenar la categoria anterior
$cat_array = array(); // Array para almacenar las categorías
$res_cat = mysqli_query ($conexion, $SQL) or die ("NO HAY RESULTADOS EN ESTE MOMENTO");
while ($cat_fila = mysqli_fetch_assoc($res_cat)) {
    $cat_var = $cat_fila['categoria'];
    $cat_array[] = $cat_var; // Agregar la categoría al array
}
$cuenta_cat = array_count_values($cat_array);
//print_r($cuenta_cat);




$resultados = mysqli_query ($conexion, $SQL) or die ("NO HAY RESULTADOS EN ESTE MOMENTO");
$filas_resultado = mysqli_num_rows ($resultados);

    if ($filas_resultado > 0){
        print ("<TABLE border='1' cellpadding='4' cellspacing='0'>\n");
        print ("<TR>\n");
        if($def=="TOD"){
            print ("<TD colspan='11'><b><center>Clasificacion</center></b></TD>\n");          
        }elseif($def=="1D"){
            print ("<TD colspan='12'><b><center>Clasificacion</center></b></TD>\n");        
        }else{
            print ("<TD colspan='9'><b><center>Clasificacion</center></b></TD>\n");
        }
        print ("</TR>\n");         
        print ("<TR>\n");
        print ("<TD width='10'><b>Clasificacion</b></TD>\n");         
        //print ("<TD width='10'><b>Orden ing</b></TD>\n"); 
        print ("<TD width='150'><b>Jinete/Caballo</b></TD>\n");
        //print ("<TD width='150'><b>Caballo</b></TD>\n");
        print ("<TD width='50'><b>Club</b></TD>\n");
        if($def=="1D"){
            print ("<TD width='10'><b>Faltas RI</b></TD>\n");
            print ("<TD width='30'><b>Tiempo RI</b></TD>\n");
            print ("<TD width='10'><b>Desempate</b></TD>\n");
            print ("<TD width='30'><b>Tiempo Des</b></TD>\n");
        }else{
            print ("<TD width='12'><b>Total Faltas</b></TD>\n");
            print ("<TD width='30'><b>Tiempo</b></TD>\n");
        }
        if($def=="TOD"){
                 print ("<TD width='10'><b>Diferencia</b></TD>\n");
        }
        print ("<TD width='30'><b>Categoria</b></TD>\n");
        print ("<TD width='10'><b>Premio</b></TD>\n");
        print ("</TR>\n");
        
        for ($i=0; $i<$filas_resultado; $i++){
            if($resultado_prueba = mysqli_fetch_array ($resultados)){
                if ($colorfila==0){ 
       		        $color= "#A7D5F4"; 
       		        $colorfila=1; 
    	        }elseif($colorfila==1){ 
       		        $color="#D8EBF8"; 
       		        $colorfila=0; 
    	        }
    	        // Verificar si la categor��a cambia
                if (trim($resultado_prueba['categoria']) != trim($categoria_anterior) AND $i<>0) {
                    // Cambiar el color de la fila
                    if($def=="TOD"){
                        print ("<TR><TD colspan='11'></TD></TR>\n");
                        $i=0;
                    }else{
                        print ("<TR><TD colspan='10'></TD></TR>\n");
                        $i=0;
                    }
                }
                $categoria_anterior = $resultado_prueba['categoria']; // Actualizar la categor��a anterior
                $orden = $i+1;
                $dif= ABS($resultado_prueba ['tiempo_RI']-$Tiempo_Optimo);
                if($resultado_prueba ['categoria']!="SD"){
                    print ("<TR>\n");
                    print ("<TD width='10'  bgcolor='".$color."'  >" . $orden . "</TD>\n");            
                    //print ("<TD width='10'  bgcolor='".$color."'  >" . $resultado_prueba ['orden_ingreso'] . "</TD>\n");
                    print ("<TD width='150' bgcolor='".$color."'  >" . mb_convert_encoding($resultado_prueba ['Jinete'], 'UTF-8', 'ISO-8859-1') ."<br><font size=1.5>".mb_convert_encoding($resultado_prueba ['Caballo'], 'UTF-8', 'ISO-8859-1') ."</font></TD>\n");
                    //print ("<TD width='150' bgcolor='".$color."'  >" . mb_convert_encoding($resultado_prueba ['Caballo'], 'UTF-8', 'ISO-8859-1') . "</TD>\n");
                    print ("<TD width='50'  bgcolor='".$color."'  >" . mb_convert_encoding($resultado_prueba ['Club'], 'UTF-8', 'ISO-8859-1') . "</TD>\n");
                    if($def=="TOD"){
                        if($resultado_prueba ['faltas_RI']==88){
                            print ("<TD colspan='3' bgcolor='".$color."'  >Retirado</TD>\n");
                        }else if($resultado_prueba ['faltas_RI']==99){
                            print ("<TD colspan='3' bgcolor='".$color."'  >Eliminado</TD>\n");            
                        }else{
                            print ("<TD width='12'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['faltas_RI'] . "</center></TD>\n");
                            print ("<TD width='30'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['tiempo_RI'] . "</center></TD>\n");
                            print ("<TD width='10'  bgcolor='".$color."'  ><center>" .round($dif,2). "</center></TD>\n");
                        }                    
                    }elseif($def=="1D"){
                        if($resultado_prueba ['faltas_RI']==88){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Retirado</TD>\n");
                        }else if($resultado_prueba ['faltas_RI']==99){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Eliminado</TD>\n");            
                        }else{
                            print ("<TD width='12'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['faltas_RI'] . "</center></TD>\n");
                            print ("<TD width='30'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['tiempo_RI'] . "</center></TD>\n");
                        }
                    
                        if($resultado_prueba ['faltas_2R']==88){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Retirado</TD>\n");
                        }else if($resultado_prueba ['faltas_2R']==99){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Eliminado</TD>\n");
                        }else{
                            print ("<TD width='10'  bgcolor='".$color."'  >" . $resultado_prueba ['faltas_2R'] . "</TD>\n");
                            print ("<TD width='30'  bgcolor='".$color."'  >" . $resultado_prueba ['tiempo_2R'] . "</TD>\n");
                        }
                    }else{
                        if($resultado_prueba ['faltas_RI']==88){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Retirado</TD>\n");
                        }else if($resultado_prueba ['faltas_RI']==99){
                            print ("<TD colspan='2' bgcolor='".$color."'  >Eliminado</TD>\n");            
                        }else{
                            print ("<TD width='12'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['faltas_RI'] . "</center></TD>\n");
                            print ("<TD width='30'  bgcolor='".$color."'  ><center>" . $resultado_prueba ['tiempo_RI'] . "</center></TD>\n");
                        }
                    }
                
                    print ("<TD width='50'  bgcolor='".$color."'  >" . mb_convert_encoding($resultado_prueba ['categoria'], 'UTF-8', 'ISO-8859-1') . "</TD>\n");                
                
                
                    //Porcentaje de premiacion
                    if (array_key_exists($resultado_prueba['categoria'], $cuenta_cat)) {
                        $valor = $cuenta_cat[$resultado_prueba['categoria']];
                        $clasif = floor(($Porc_premio * $valor)/100); // Cálculo del porcentaje de premios para la categoría actual
                        if ($i <= $clasif) {
                            // La cantidad de participantes es menor al porcentaje de premios, mostrar la imagen de premio
                            echo "<td width='10' bgcolor='$color'><center><img src='https://softecuestre.com.ar/images/cucarda.jpg' width='20' height='20' align='center' alt='' /></center></td>\n";
                        } else {
                            // La cantidad de participantes es igual o mayor al porcentaje de premios, no mostrar la imagen de premio
                            echo "<td width='10' bgcolor='$color'></td>\n";
                        }
                    } else {
                        echo "La clave no existe en el array";
                    }
                print ("</TR>\n");
                }
            }
        }
         print ("</TABLE>\n");
         print ("</BR></BR>\n");
    }

// Cerrar conexion
   mysqli_close ($conexion);
?>

</br>
<button type="button" name="print" id="print" onclick="printPage()">
	<img src="https://softecuestre.com.ar/images/iconoimpresora.jpg" width="25" height="25" alt="Imprimir" />
</button>

<!--
<button type="button" name="exportar" id="exportar" onclick="location.href ='exportar.php'">
	<img src="img/iconoexcel.gif" width="25" height="25" alt="Exportar" />
</button>
&nbsp;

<button type="button" name="mail" id="mail" onclick="location.href ='mail.php'">
	<img src="img/iconomail.gif" width="25" height="25" alt="Enviar por Mail" />
</button>
&nbsp; 
//-->
</BODY>
</HTML>
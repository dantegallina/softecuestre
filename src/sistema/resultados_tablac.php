<?php
set_time_limit(150); 	
include_once("config/fechas.php"); 
require('config/configuracion.inc.php'); 
?>
<html xmlns="http://www.w3.org/1999/xhtml" LANG="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<META HTTP-EQUIV="REFRESH" CONTENT="15;URL=resultados_tablac.php"> 
<title></title>

</head>
<BODY>
<?PHP

   // Conectar con el servidor de base de datos
      $conexion = mysqli_connect ($host, $usuario, $password)
	or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
	mysqli_select_db($conexion, $db) 
		or die ("No se puede seleccionar la base de datos");


   // Evento
      $sql_evento = "select * from evento WHERE Activa=1 ";
      $evento = mysqli_query ($conexion, $sql_evento)
         or die ("NO HAY CONCURSOS EN ESTE MOMENTO");
      $qfilas_evento = mysqli_num_rows ($evento);

      if($qfilas_evento=1){

	if($resultado_evento = mysqli_fetch_array ($evento)){
		$Id_evento = $resultado_evento['Id_evento'];
		$evento_fecha = fsalida($resultado_evento['fecha']);
		$evento= $resultado_evento['Nombre'];
		$evento_club= $resultado_evento['club'];
		$tipo_concurso= $resultado_evento['tipo_concurso'];
		$logo_club= $resultado_evento['logo_club'];
        }
      
      }	


   // Prueba
      $sql_prueba = "select * from prueba WHERE Id_evento=".$Id_evento." AND activa=1";
      $prueba = mysqli_query ($conexion, $sql_prueba)
         or die ("NO HAY PRUEBAS EN ESTE MOMENTO PARA MOSTRAR");
      $qfilas_prueba = mysqli_num_rows ($prueba);

      if($qfilas_prueba=1){

	if($resultado_prueba = mysqli_fetch_array ($prueba)){
		$Id_prueba = $resultado_prueba['Id_prueba'];
		$Nro_prueba = $resultado_prueba['Nro_prueba'];

		$sql_cat = "SELECT * FROM categoria WHERE Id_categoria=".$resultado_prueba['Id_categoria'];
		$mando_cat = mysqli_query($conexion, $sql_cat) or die ("No Hay categorias para mostrar");
		$comando_cat = mysqli_fetch_array ($mando_cat);
		$categoria = $comando_cat['nom_categ'];


		$sql_def = "SELECT * FROM Art_Def WHERE Id_Art_Def=".$resultado_prueba['Id_Art_Def'];
		$mando_def = mysqli_query($conexion, $sql_def) or die ("No Hay definición para mostrar");
		$comando_def = mysqli_fetch_array ($mando_def);
		$definicion = $comando_def['Definicion']." ".$comando_def['Articulo'];

		$velo_to = $resultado_prueba['velo_to'];
		$velo_ta = $resultado_prueba['velo_ta'];
		$tabla = $resultado_prueba['tabla'];
		$Tiempo_Acordado = $resultado_prueba['Tiempo_Acordado'];
		$Tiempo_Limite = $resultado_prueba['Tiempo_Limite']; 
		$Tiempo_Optimo = $resultado_prueba['Tiempo_Optimo'];
		$Porc_premio = $resultado_prueba['Porc_premio'];
		$Porc_2R = $resultado_prueba['Porc_2R'];
		$Obs = $resultado_prueba['Obs'];


        }
      
      }else{
	echo "se mostraran varias pruebas";
	while($resultado_prueba = mysqli_fetch_array($prueba)) { 

	}
      }	



// listado



 $sql_resultado = "select * from concurso WHERE Id_prueba=".$Id_prueba." AND finaliza=1 ORDER BY tiempo_tablac ASC";
 $sql_record = "SELECT MIN(tiempo_RI) as minimo FROM concurso WHERE Id_prueba=".$Id_prueba." AND tiempo_tablac <> 0";
  
 $mando_resultado = mysqli_query($conexion, $sql_resultado) or die ("No se inicio la prueba");
 $mando_record = mysqli_query($conexion, $sql_record) or die ("Sin Registro de tiempo");
 $filas_resultado = mysqli_num_rows ($mando_resultado);
 
 while($row = mysqli_fetch_array($mando_record)){
	$record = $row['minimo'];
}
 
 
 

      $sql_listado = "select * from concurso WHERE Id_prueba=".$Id_prueba." AND finaliza=0 ORDER BY CAST(orden_ingreso AS unsigned) ASC";
      $listado = mysqli_query ($conexion, $sql_listado) or die ("NO HAY INSCRIPTOS EN ESTE MOMENTO");
      $qfilas_listado = mysqli_num_rows ($listado);






     
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
<H1 align="center"><?php print($evento); ?></H1>
<H2 align="center"><?php print($tipo_concurso); ?> - <?php print($evento_fecha); ?></H2>
<H2 align="center">Organiza: <?php print($evento_club); ?> <img src="clubes/<?php print($logo_club); ?>" width="50" height="50" alt="<?php print($evento_club); ?>" /> Fiscaliza <img src="img/fei.jpg" width="50" height="50" alt="FEI"/> y <img src="img/fea.jpg" width="50" height="50" alt="FEA"/></H2>
</br>



<center>
<img  width="328" height="103" src="img/longines.jpg" alt="publi" />
</center>
<H3 align="left">


Prueba N: <?php print($Nro_prueba); ?> </br>
Categoria: <?php print($categoria); ?> - Definicion/Art.: <?php print($definicion); ?> Tabla: <?php print($tabla); ?></br>
Tiempo Limite: <?php print($Tiempo_Limite); ?> seg</br>
<!-- Tiempo Optimo: <?php print($Tiempo_Optimo); ?> seg Velocidad TO: <?php print($velo_to); ?> m/m</br> //-->
Observaciones: <?php print($Obs); ?></br>
Jinetes restantes: <?php print($qfilas_listado); ?> - <b> Tiempo a Batir: <?php print ($record); ?>  </b></br>
<?php $campeonato = $record * 0.50;?>
</H3>

<table>
	<tr>
		<td> 
			<?PHP
 				include_once("next.php");		
			?>
		</td>
		<td>
			<?PHP
 				include_once("champion.php");		
			?>
		</td>
	</tr>
</table>

<?PHP

if ($filas_resultado==$qfilas_listado){    //Si total de iniciados=total de participantes, clasificar
	$sql_clasificar = "select * from concurso WHERE Id_prueba=".$Id_prueba." AND finaliza=1 ORDER BY faltas_RI ASC, tiempo_RI ASC";
 	$mando_clasificar = mysqli_query($conexion, $sql_clasificar) or die ("No se inicio la prueba");
 	// clasificar y colocar la clasificacion en  campo corresponidente
}

if ($filas_resultado > 0)
      {
         print ("<TABLE border='1' cellpadding='4' cellspacing='0'>\n");
         print ("<TR>\n");
         print ("<TD colspan='7'><b><center>Clasificacion</center></b></TD>\n");          
         print ("</TR>\n");         
         print ("<TR>\n");
         print ("<TD width='10'><b>Clasificacion</b></TD>\n");         
         print ("<TD width='10'><b>Orden ing</b></TD>\n"); 
         print ("<TD width='150'><b>Jinete</b></TD>\n");
         print ("<TD width='150'><b>Caballo</b></TD>\n");
 	 print ("<TD width='50'><b>Club</b></TD>\n");         
         print ("<TD width='10'><b>Tiempo</b></TD>\n");
        

         print ("</TR>\n");
      


 for ($i=0; $i<$filas_resultado; $i++)
         {
             $comando_resultado = mysqli_fetch_array ($mando_resultado);

	if ($colorfila==0){ 
       		//$color= "#DEDEBE";
		$color= "#A9E2F3";
       		$colorfila=1; 
    	}else{ 
       		$color="#F0F0F0";
       		$colorfila=0; 
    	}
 $resultado_anterior=0;
 $orden1 =0;
 if($resultado_anterior==$comando_resultado ['tiempo_tablac']){
	$orden1 = $orden1; 
 }else{   	
	$orden1 = $i+1;
 }
 
            print ("<TR>\n");
            print ("<TD width='10'  bgcolor='".$color."'  >" . $orden1 . "</TD>\n");            
            print ("<TD width='10'  bgcolor='".$color."'  >" . $comando_resultado ['orden_ingreso'] . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $comando_resultado ['Jinete'] . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $comando_resultado ['Caballo'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $comando_resultado ['Club'] . "</TD>\n");
            if($comando_resultado ['faltas_RI']==88){
               print ("<TD colspan='2' bgcolor='".$color."'  >Retirado</TD>\n");
            }else if($comando_resultado ['faltas_RI']==99){
               print ("<TD colspan='2' bgcolor='".$color."'  >Eliminado</TD>\n");            
            }else{
            $sanciones=0;
            $sanciones=$sanciones;
               print ("<TD width='10'  bgcolor='".$color."'  >" . $comando_resultado ['tiempo_tablac'] . "</TD>\n");
               
            }
            $resultado_anterior =  $comando_resultado ['tiempo_tablac'];
            print ("</TR>\n");

		 }
         print ("</TABLE>\n");
         print ("</BR></BR>\n");
         $orden = $i+1;

      }






      if ($qfilas_listado > 0)
      {

         print ("<TABLE border='1' cellpadding='4' cellspacing='0'>\n");
         print ("<TR>\n");
         print ("<TD colspan='4'><b><center>Lista de Ingreso</center></b></TD>\n");          
         print ("</TR>\n");    
         print ("<TR>\n");
         print ("<TD width='10'><b>Orden</b></TD>\n"); 
         print ("<TD width='150'><b>Jinete</b></TD>\n");
         print ("<TD width='150'><b>Caballo</b></TD>\n");
 	 print ("<TD width='50'><b>Club</b></TD>\n");         
         print ("</TR>\n");

         for ($i=0; $i<$qfilas_listado; $i++)
         {
            $resultado_listado = mysqli_fetch_array ($listado);

	if ($colorfila==0){ 
       		$color= "#DEDEBE"; 
       		$colorfila=1; 
    	}else{ 
       		$color="#F0F0F0"; 
       		$colorfila=0; 
    	}

            print ("<TR>\n");
            print ("<TD width='10'  bgcolor='".$color."'  >" . $resultado_listado['orden_ingreso'] . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $resultado_listado['Jinete'] . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $resultado_listado['Caballo'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado['Club'] . "</TD>\n");
             print ("</TR>\n");

		 }

         print ("</TABLE>\n");

      }
      else
         print ("No hay Inscripciones");

// Cerrar conexión
   mysqli_close ($conexion);
?>

&nbsp;
</br>
<button type="button" name="print" id="print" onclick="printPage()">
	<img src="img/iconoimpresora.jpg" width="25" height="25" alt="Imprimir" />
</button>
&nbsp;

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
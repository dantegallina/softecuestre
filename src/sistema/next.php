<?php
   // Prueba
 //     $sql = "select * from prueba WHERE activa=1";
 //     $prueba1 = mysqli_query ($conexion, $sql) or die ("NO HAY PRUEBAS EN ESTE MOMENTO PARA MOSTRAR");
 //     $qfilas_prueba1 = mysqli_num_rows ($prueba1);

 //     if($qfilas_prueba1==1){

//	if($resultado_prueba1 = mysqli_fetch_array ($prueba1)){
//		$Id_prueba1 = $resultado_prueba['Id_prueba'];
//        }
//      }	



// listado

//$Id_prueba1

      $sql_listado1 = "select * from concurso WHERE Id_prueba=".$prueba." AND Inicia=1 order by cast(orden_ingreso as unsigned) ASC";
      $listado1 = mysqli_query ($conexion, $sql_listado1) or die ("NO HAY INSCRIPTOS EN ESTE MOMENTO");
      $qfilas_listado1 = mysqli_num_rows ($listado1);
      $resultado_listado1 = mysqli_fetch_array ($listado1);
      


      if ($qfilas_listado1 == 1)
      {

         print ("<TABLE  border='0' bgcolor='#A9E2F3' cellpadding='3' cellspacing='0'>\n");
         print ("<tr><TD colspan='2' align='center'><b>En Pista</b></TD></tr>\n");
         print ("<tr><TD  >Nro. " . $resultado_listado1['orden_ingreso'] . "</TD><td><b>". $resultado_listado1['Jinete'] ."</b></td></tr>\n"); 
	
	
	// si no esta la imagen pero el campo está completo o no cohinciden, colocar imagen de desconocido
	
	if($resultado_listado1['foto']<>''){
	         print ("<tr><td colspan='2' align='center'><img src='http://softecuestre.com.ar/imagenes/jinetes/".$resultado_listado1['foto']."' width='100' height='100' alt='".$resultado_listado1['Jinete']."'/><img src='http://softecuestre.com.ar/images/fgfg.gif' width='100' height='100' HSPACE='5'  border='1' alt='Saltando en Pista' /></td></tr>\n");
	}else{
         print ("<tr><td colspan='2' align='center'><img src='http://softecuestre.com.ar/imagenes/jinetes/desconocido.jpg' width='100' height='100' alt='".$resultado_listado1['Jinete']."'/><img src='http://softecuestre.com.ar/images/fgfg.gif' width='100' height='100' HSPACE='5'  border='1' alt='Saltando en Pista' /></td></tr>\n");

	}
	print ("<tr><TD  >Club : </TD> <td><b>".$resultado_listado1['Club'] ."</b></td></tr>\n");
         print ("<tr><TD  >Caballo : </TD> <td><b>".$resultado_listado1['Caballo'] ."</b></td></tr>\n");
  
          print ("</TABLE>\n");
      }
      else print ("No hay jinete en pista");

?>
</br>
</BODY>
</HTML>
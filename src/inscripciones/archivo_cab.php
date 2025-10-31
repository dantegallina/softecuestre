<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 



if ( $term = $_GET['term'] ?? '' ) {
   $sql="SELECT * FROM `feacaballos` WHERE `nombre` LIKE '".$term."'";

   $evento1 = mysqli_query ($conexion, $sql)
      or die ("NO HAY Nombres a elegir");
   $row = mysqli_num_rows ($evento1);
  $matches = array();
  
    
   while($row = mysqli_fetch_array($evento1)){
    $date = date_create($row['nacimiento']);
      array_push($matches, $row['id'], $row['nombre'], $row['licencia'], $row['sexo'], $row['pelo'], date_format($date,"d/m/Y") );
}


        header( 'Content-Type: text/javascript' );
        echo json_encode( array_values($matches) );
}







?>

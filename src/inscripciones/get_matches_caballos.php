<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 


$sql="SELECT nombre,licencia FROM feacaballos";
      $evento3 = mysqli_query ($conexion, $sql)
         or die ("NO HAY Nombres a elegir");
      $row = mysqli_num_rows ($evento3);
	  $options = array();
		while($row = mysqli_fetch_array($evento3)){
			array_push($options, $row['nombre'], $row['licencia']);
}


if ( $term = $_GET['term'] ?? '' ) {
        $matches = array_filter( $options, function( $option ) use ( $term ) {
                //return strpos( strtolower($option), $term ) !== false;
                return stripos($option, $term) !== false;
        } );
        header( 'Content-Type: text/javascript' );
        echo json_encode( array_values($matches) );
}


?>


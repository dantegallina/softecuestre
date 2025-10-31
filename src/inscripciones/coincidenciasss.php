<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 





$sql="SELECT nombre FROM feajinetes";
      $evento1 = mysqli_query ($conexion, $sql)
         or die ("NO HAY Nombres a elegir");
      $row = mysqli_num_rows ($evento1);
	  $options = array();
		while($row = mysqli_fetch_array($evento1)){
			array_push($options, $row['nombre']);
}


if ( $term = $_GET['term'] ?? '' ) {
        $matches = array_filter( $options, function( $option ) use ( $term ) {
                return strpos( strtolower($option), $term ) !== false;
        } );
        header( 'Content-Type: text/javascript' );
        echo json_encode( array_values($matches) );
}


?>


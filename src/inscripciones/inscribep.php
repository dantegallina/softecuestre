<?php
session_start(); // Inicia la sesión

// Verifica si la sesión está abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: loging.php"); // Redirige a la página de login
    exit();
}
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 



    //Ip cliente: 


$jinete_no_federado="";
$caballo_no_federado="";
$categoria_jinete_no_federado="";
$club_jinete_no_federado="";
$lic_caballo="";
$lic_jinete="";

foreach ($_POST as $nombre_campo => $valor) {
	$valor_limpio = filter_input(INPUT_POST, $nombre_campo, FILTER_SANITIZE_STRING);
	$asignacion = "\$" . $nombre_campo . "='" . $valor_limpio . "';";
	eval($asignacion);
	//echo $asignacion;
}
$urlppal = "http://softecuestre.com.ar/src/inscripciones/padock.php?valor=".$concurso;


	$jinete=$jinete_no_federado;
	$categoria=$categoria_jinete_no_federado;
	$club=$club_jinete_no_federado;
	$caballo=$caballo_no_federado;
    $dni = 0;


$pruebas_seleccionadas = $_POST['prueba_id'];
foreach ($pruebas_seleccionadas as $prueba_id) {
   
    

				//Insertamos la nueva inscripcion
				
				
				$query = $mysqli -> query("INSERT INTO concurso (`Id_concurso`, `Id_prueba`, `orden_ingreso`, `Club`, `Id_jinete`, `dni`, `Jinete`, `licencia_jin`, `categoria`, `foto`, `Id_caballo`, `Caballo`, `licencia_cab`,`faltas_RI`, `faltas_x_time_RI`, `tiempo_RI`, `faltas_2R`, `faltas_x_time_2R`, `tiempo_2R`, `faltas_DES`, `faltas_x_time_DES`, `tiempo_DES`, `faltas_TOTAL`, `Inicia`, `finaliza`, `clasificacion`, `Id_campeonato`, `tiempo_tablac`, `video`) VALUES (NULL, '$prueba_id', NULL, '$club', NULL, '$dni', '$jinete', '$lic_jinete','$categoria', '', NULL, '$caballo', '$lic_caballo',NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '0', '0', '')");

                if (!$query) {
                    printf("Error en la consulta: %s\n", mysqli_error($mysqli));
                    exit();
                }else{

                    echo "jinete Inscripto con éxito, pregunte en el jurado que letra o número tiene</br>";
				
               
                 }
}
?>
<html>
<body>
<?php echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=".$urlppal."\">"; ?>
</body>
</html>
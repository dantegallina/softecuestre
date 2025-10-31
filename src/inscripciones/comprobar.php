<?php
$caballo = $_POST['caballo'];
$jinete = $_POST['jinete'];
$pruebas = $_POST['pruebas'];

include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 

// Iterar sobre las pruebas seleccionadas
foreach ($pruebas as $prueba) {
  // Verificar la existencia de la combinaci¨®n de caballo y jinete en cada prueba
  $query = "SELECT * FROM concurso WHERE `Caballo` = '$caballo' AND `Jinete` = '$jinete' AND `Id_prueba` = '$prueba'";
  $result = mysqli_query($conexion, $query);

  if (mysqli_num_rows($result) > 0) {
    // El caballo y jinete ya existen en esta prueba
    echo 'existe';
    // Puedes hacer m¨¢s acciones aqu¨ª si lo necesitas
  } else {
    // El caballo y jinete no existen en esta prueba
    echo 'noexiste';
    // Puedes hacer m¨¢s acciones aqu¨ª si lo necesitas
  }
}

// Cerrar la conexiÃ³n a la base de datos
mysqli_close($conexion);
?>



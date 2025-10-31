<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');

//sleep(1);
$data = $_POST['value'];
$field = $_POST['field'];
$id_eve = $_POST['id_eve'];

if($data='on'){
    $data=1;
}else{
    $data=0;
}
$status_msg = '';
$status = true;
$error_sql = false;

$update = "UPDATE `evento` SET `".$field."`=0";
$update1 = "UPDATE `evento` SET `".$field."`='".$data."' WHERE Id_evento=".$id_eve;
$resultado = mysqli_query($conexion, $update);
$resultado1 = mysqli_query($conexion, $update1);

if(!$resultado){
    $status_msg = 'Error de BD, no se pudo deseleccionar el evento';
    $status = false;
    $error_sql =  mysqli_error();
}
if (!$resultado1) {
    $status_msg = 'Error de BD, no se pudo seleccionar el evento';
    $error_sql =  mysqli_error();
    $status = false;
}


echo json_encode(array('status' => $status, 'data' => array('id' => $id_eve, 'msg' => $status_msg,'error_sql' => $error_sql,'query' => $update) ));
?>

    
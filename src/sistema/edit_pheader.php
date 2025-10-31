<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');

//sleep(1);
$data = $_POST['value'];
$field = $_POST['field'];
$id_prueba = $_POST['id'];




$status_msg = 'ok';
$status = true;
$error_sql = false;

$resultado = true;
if($field == 'activa'){
    if($data='true'){
        $data=1;
    }else{
        $data=0;
    }
    $update = "UPDATE `prueba` SET `".$field."`=0";
    $update1 = "UPDATE `prueba` SET `".$field."`= ".$data." WHERE Id_prueba=".$id_prueba;
    $resultado = mysqli_query($conexion, $update);
    $resultado1 = mysqli_query($conexion, $update1);
    if(!$resultado){
        $resultado1 = mysqli_query($conexion, $update1);
        $status_msg = 'Error de BD, no se pudo deseleccionar el evento';
        $error_sql =  mysqli_error();
        $status = false;
    }
}else{
    $update1 = "UPDATE prueba SET ".$field."='".$data."' WHERE Id_prueba=".$id_prueba;
   // var_dump($update1);
    $resultado1 = mysqli_query($conexion, $update1);
    if(!$resultado1){
        $status_msg = 'Error de BD';
        $error_sql =  mysqli_error();
        $status = false;
    }
}

echo json_encode(array('status' => $status, 'data' => array('id' => $id_prueba, 'msg' => $status_msg,'error_sql' => $error_sql,'query' => $update1) ));

?>

    
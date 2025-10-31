<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');

$data = $_POST['value'];

$field = $_POST['field'];
$id_concurso = $_POST['id_concurso'];
$Id_campeonato = $_POST['id_campeonato'];




if($field == 'Inicia' || $field == 'finaliza'){
    $update = "UPDATE concurso SET ".$field."=".$data." WHERE Id_concurso = ".$id_concurso;
}
else{
    $update = "UPDATE concurso SET ".$field."='".$data."' WHERE Id_concurso = ".$id_concurso;
}


$status = true;
$status_msg = '';
$error_sql = false;

var_dump($update);
$resultado = mysqli_query($conexion, $update);

if(!$resultado){
    $status_msg = 'Error de BD, no se pudo deseleccionar el evento';
    $status = false;
    $error_sql =  mysqli_error();
}

if($field == 'tiempo_RI' || $field == 'faltas_RI'){

    $instruccion = "select * from concurso WHERE Id_concurso = ".$id_concurso;
    $consulta = mysqli_query ($conexion, $instruccion);
    $resultado = mysqli_fetch_array($consulta);
    var_dump($resultado);
    $tiempo_tablac = $resultado['tiempo_RI'] + $resultado['faltas_RI'] ;
    $update = "UPDATE concurso SET tiempo_tablac =".$tiempo_tablac." WHERE Id_concurso = ".$id_concurso;
    $resultado = mysqli_query($conexion, $update);
   
}


if($field == 'faltas_RI' || $field == 'faltas_2R'){

    $instruccion = "select * from concurso WHERE Id_concurso = ".$id_concurso;
    $consulta = mysqli_query ($conexion, $instruccion);
    $resultado = mysqli_fetch_array($consulta);
    var_dump($resultado);
    $faltas_TOTAL = $resultado['faltas_RI'] + $resultado['faltas_2R'] ;
    $update = "UPDATE concurso SET faltas_TOTAL =".$faltas_TOTAL." WHERE Id_concurso = ".$id_concurso;
    $resultado = mysqli_query($conexion, $update);
    
    //actualizo campeonatos

    $update1 = "UPDATE campeonato SET dia3 =".$faltas_TOTAL." WHERE Id_campeonato = ".$Id_campeonato;
    $resultado1 = mysqli_query($conexion, $update1);

    $instruccion1 = "select * from campeonato WHERE Id_campeonato = ".$Id_campeonato;
    $consulta1 = mysqli_query ($conexion, $instruccion1);
    $resultado1 = mysqli_fetch_array($consulta1);
    //var_dump($resultado1);
    
    $puntaje_acum = $resultado1['dia1'] + $resultado1['dia2'] + $resultado1['dia3'] + $resultado1['dia4'] + $resultado1['dia5'] ;
    $update2 = "UPDATE campeonato SET puntaje_acum =".$puntaje_acum." WHERE Id_campeonato = ".$Id_campeonato;
    $resultado2 = mysqli_query($conexion, $update);    
    
    
}

echo json_encode(array('status' => $status, 'data' => array('id' => $id_concurso, 'msg' => $status_msg,'error_sql' => $error_sql,'query' => $update) ));
?>

    
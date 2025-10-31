<?
// está funcion toma un fecha con formato 01/12/2002 
// y lo transforma a 2002/12/01 antes de guardarlo en 
// una base de datos mysql
function fentrada($cad){
$uno=substr($cad, 0, 2);
$dos=substr($cad, 3, 2);
$tres=substr($cad, 6, 4);
$cad2 = ($tres."/".$dos."/".$uno);
return $cad2;
}
// Está funcion hace lo contrario toma una fecha con 
// formato 2002/12/01 y lo transforma a 01/12/2002
// antes de mostrarlo en una página, despues de leerlo 
// desde una base de datos mysql
function fsalida($cad2){
$tres=substr($cad2, 0, 4);
$dos=substr($cad2, 5, 2);
$uno=substr($cad2, 8, 2);
//$Hora=substr($cad2, 11, 2);
//$Min=substr($cad2, 14, 2);
//$Seg=substr($cad2, 17, 2);

//$cad = ($uno."/".$dos."/".$tres." ".$Hora.":".$Min.":".$Seg);
$cad = ($uno."/".$dos."/".$tres);

return $cad;
}
?>
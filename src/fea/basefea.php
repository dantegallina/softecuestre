<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
//JInetes

$sql = "TRUNCATE feajinetes"; 
$sql = mysqli_query($conexion ,$sql); 


$url = 'http://federados.federacionecuestre.com.ar/index.php';
$i = 1; 
$D = 1; 
$clave = "<b>Club</b>";
$clave1 = "<td";
$clave2 = "</td";
$nombre = "";
$pagina="";
$hoy = date("Y-m-d H:i:s");
   while ($pagina != "false") { 
	 $vars = array('nombre' => '', 'busqueda' => 1, 'tipo' => 'j', 'disciplina' => 0, 'porclub' => 'Todos', 'pagina' => $i);
	 $p = 0;
	 $qs = http_build_query($vars);
	 $url = 'http://federados.federacionecuestre.com.ar/index.php';
	 $url = $url.'?'. $qs;
	 $pagina = file_get_contents($url);
  	 $p = strpos($pagina, $clave);
		for ($x=0;$x<20;$x++){
			for ($z=0;$z<6;$z++){
				$p1 = strpos($pagina, $clave1, $p);
				$extracto = substr($pagina,$p1,10);
				if (preg_match("/align/i", $extracto)){
					$p1 = $p1 + 19;
				}else{ 
					$p1 = $p1 + 4;
				}
				$p2 = strpos($pagina, $clave2, $p1);
				$p3 = $p2-$p1;
				$variable [$z] = trim(substr($pagina, $p1, $p3));
				$p = $p2+5;
			}
			
			
			//$nombre = iconv('ISO-8859-1', 'UTF-8//IGNORE', $variable[0]);
			$nombre = mb_convert_encoding($variable[0], 'UTF-8', 'ISO-8859-1');
            $club = iconv('ISO-8859-1', 'UTF-8//IGNORE', $variable[5]);

			$query = $mysqli->query("INSERT INTO feajinetes (`id`, `nombre`, `apellido`, `licencia`, `FEI-ID`, `nacimiento`, `disciplina`, `categoria`, `club`, `estadofea`, `foto`, `pais`, `sexo`, `comentarios`, `direccion`, `email`, `telefono`, `factualizacion`) VALUES (NULL, '$nombre', '$nombre', '$variable[1]', '', '$variable[2]', '$variable[3]', '$variable[4]', '$club', '1', '', '', '', '', '', '', '', '$hoy')");
            
            
            
            if (!$query) {
                echo "error en 1";
                printf("Error en la consulta: %s\n", mysqli_error($mysqli));
                exit();
            }else{
			    echo "Registro nro ".$D." perteneciente a ".$nombre. "<br>"; 
			    $D++;
			    if(substr($variable[0],0,5)=="width"){
				    break 2;
			    }
            }
			unset($variable);	
		}   
		unset($qs);
   }
echo "proceso Realizado con éxito!, se han escrito ".$D." Registros";
echo "Se han procesado ".$i." páginas";



// Caballos

$sql = "TRUNCATE feacaballos"; 
$sql = mysqli_query($conexion ,$sql); 

$url = 'http://federados.federacionecuestre.com.ar/index.php';
$i = 1; 
$D = 1; 
$clave = "<b>Club</b>";
$clave1 = "<td";
$clave2 = "</td";
$nombre = "";
$pagina="";
   while ($pagina != "false") { 
	 $vars = array('nombre' => '', 'busqueda' => 1, 'tipo' => 'c', 'disciplina' => 0, 'porclub' => 'Todos', 'pagina' => $i);
	 $p = 0;
	 $qs = http_build_query($vars);
	 $url = 'http://federados.federacionecuestre.com.ar/index.php';
	 $url = $url.'?'. $qs;
	 $pagina = file_get_contents($url);
  	 $p = strpos($pagina, $clave);
		for ($x=0;$x<20;$x++){
			for ($z=0;$z<8;$z++){
				$p1 = strpos($pagina, $clave1, $p);
				$extracto = substr($pagina,$p1,10);
				if (preg_match("/align/i", $extracto)){
					$p1 = $p1 + 19;
				}else{ 
					$p1 = $p1 + 4;
				}
				$p2 = strpos($pagina, $clave2, $p1);
				$p3 = $p2-$p1;
				$variable [$z] = trim(substr($pagina,$p1,$p3));
				$p = $p2+5;
			}
			
            $nombre = iconv('ISO-8859-1', 'UTF-8//IGNORE', $variable[0]);
            $club = iconv('ISO-8859-1', 'UTF-8//IGNORE', $variable[6]);			

			$query = $mysqli->query("INSERT INTO feacaballos (nombre, licencia, sexo, pelo, nacimiento, disciplina, categoria, club) Values ('$nombre', '$variable[1]', '$variable[2]', '$variable[3]', '$variable[4]', '$variable[5]', '$club', '$variable[7]')");
			
            if (!$query) {
                echo "error en 2";
                printf("Error en la consulta: %s\n", mysqli_error($mysqli));
                exit();
            }else{
			    echo "Registro nro ".$D." perteneciente a ".$nombre. "<br>"; 
			    $D++;
			    if(substr($variable[0],0,5)=="width"){
				    break 2;
			    }
            }    
			unset($variable);	
		}   
		unset($qs);
		$i++;
   }
echo "proceso Realizado con éxito!, se han escrito ".$D." Registros";
echo "Se han procesado ".$i." páginas";



mysqli_close($conexion); 
?>
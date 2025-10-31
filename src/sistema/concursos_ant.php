<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
	//$evento = $_POST['Id_evento'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Concursos</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />


	<link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="https://softecuestre.com.ar/js/jquery.js"></script>
	<script type="text/javascript" src="https://softecuestre.com.ar/js/interface.js"></script>
	
<!--[if lt IE 7]>
 	<style type="text/css">
 		div, img { behavior: url(iepngfix.htc) }
 	</style>
<![endif]-->
<style>
		body {
			background-color: #1C293A;
			color: #1C293A;
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
		}
		header {
			background-color: #FFFFFF;
			color: #1C293A;
			padding: 20px;
			text-align: center;
		}
		

    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .fila:nth-child(odd) {
        background-color: #f2f2f2; /* color para filas impares */
    }

    .fila:nth-child(even) {
        background-color: #ffffff; /* color para filas pares */
    }

</style>		
</head>
<body>
<script type="text/javascript" language="javascript-2.1.1">
<!--
function printPage()
{
    document.getElementById('print').style.visibility = 'hidden';
    // Do print the page
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
    document.getElementById('print').style.visibility = '';
}
//-->
</script>    
<div>
    	<?PHP 
            include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
            $ap = "";
            if ($evento = $_POST['Id_evento']) {
                $query1 = $mysqli->query("SELECT * FROM prueba WHERE Id_evento = '" . $evento . "' ORDER BY dia ASC, CAST(Nro_prueba AS UNSIGNED) ASC");

                // consulta para obtener el valor de `ap` del evento correspondiente
                $query_evento = $mysqli->query("SELECT ap FROM evento WHERE Id_evento = '" . $evento . "'");
                $evento_data = mysqli_fetch_assoc($query_evento);
                $ap = $evento_data['ap'];
 	?>    
</div>
<header>
<img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
 	<h1>Pruebas y Campeonatos</h1>
</header>
<main>

    <fieldset>
        <div>
            <?php
                if ($ap<>""){
                    echo "<center>";
                    echo "<a title='Bases' href='https://softecuestre.com.ar/imagenes/ap/".$ap."'>
                    <img src='https://softecuestre.com.ar/images/anteprograma concurso.png' alt='Anteprograma' height='50' />
                    </a>";
                    echo "</center>";
                }else{
                    echo "<center>";
                    echo "<img src='https://softecuestre.com.ar/images/anteprograma concurso.png' alt='Anteprograma' height='50' />";
                    echo "</center>";
                }    
            ?>
        </div>
    </fieldset>
<?php
// Opcional (recomendado): que mysqli lance excepciones bien legibles
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset('utf8mb4');

// Helpers simples
function getOneCol(mysqli $db, string $sql, string $types, array $params) {
    $stmt = $db->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_row();
    $stmt->close();
    return $row ? $row[0] : '';
}

function getTwoCols(mysqli $db, string $sql, string $types, array $params) {
    $stmt = $db->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_row();
    $stmt->close();
    return $row ? [$row[0], $row[1]] : ['', ''];
}

$piso = "";

while ($valores1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

    // Normalizo/valido IDs (casteo a entero y trato null/"" como 0)
    $idCategoria = isset($valores1['Id_categoria']) ? (int)$valores1['Id_categoria'] : 0;
    $idArtDef    = isset($valores1['Id_Art_Def'])   ? (int)$valores1['Id_Art_Def']   : 0;
    $idPista     = isset($valores1['pista'])        ? (int)$valores1['pista']        : 0;
    $idPiso      = isset($valores1['piso'])         ? (int)$valores1['piso']         : 0;

    // categoria
    $cat = '';
    if ($idCategoria > 0) {
        $cat = getOneCol($mysqli, "SELECT nom_categ FROM categoria WHERE Id_categoria = ?", "i", [$idCategoria]);
    }

    // Art_Def (def y art)
    $def = ''; $art = '';
    if ($idArtDef > 0) {
        // Ajustá los nombres de columnas si difieren
        [$def, $art] = getTwoCols($mysqli, "SELECT Definicion, Articulo FROM Art_Def WHERE Id_Art_Def = ?", "i", [$idArtDef]);
    }

    // pista
    $pista = '';
    if ($idPista > 0) {
        $pista = getOneCol($mysqli, "SELECT nombre FROM pista WHERE id_pista = ?", "i", [$idPista]);
        // Cambiá "nombre" por la columna correcta (usabas $fila2[1])
    }

    // piso
    $piso = '';
    if ($idPiso > 0) {
        $piso = getOneCol($mysqli, "SELECT nombre FROM piso WHERE id_piso = ?", "i", [$idPiso]);
        // Cambiá "nombre" por la columna correcta (usabas $fila3[1])
    }

$fecha = new DateTime($valores1["dia"]);

$formatter = new IntlDateFormatter(
    'es_AR',                       // Idioma y región
    IntlDateFormatter::FULL,       // Formato de fecha
    IntlDateFormatter::NONE        // No necesitamos hora
);

// Queremos algo tipo: lunes 23
$formatter->setPattern('EEEE d');  // Día de la semana + día del mes

$nombre_dia = $formatter->format($fecha);


    // ... tu HTML / echo acá ...
}
?>

    <fieldset>
        <div>
            <b>    
            <label for="<?php $valores1['Nro_prueba']; ?>"><?php echo $nombre_dia; ?> </br>
            Prueba <?php echo $valores1['Nro_prueba']; ?></br> 
            Categ. <?php echo $cat; ?> </b>
            Def. <?php echo $def; ?> 
            Art. <?php echo $art; ?> -
            <b>Pista </b><?php echo $pista; ?> -
            <b>Piso </b><?php echo $piso; ?>
            </label>
            
            <input type="hidden" name="prueba_id[]" value="<?php echo $valores1['Id_prueba']; ?>" >
        </div>
        <div>
                 <img src='https://softecuestre.com.ar/images/campeonatos.png' alt='Campeonato' height='50' />
                 <img src='https://softecuestre.com.ar/images/estadisticas.png' alt='Estadísticas' height='50' />
                  

                <?php
                    if($valores1['iniciada']==3){
                        echo "<a href='https://softecuestre.com.ar/src/sistema/resultados.php?prueba=".$valores1['Id_prueba']."'>";
                        echo "<img src='https://softecuestre.com.ar/images/clasificacion.png' height='50'  alt='Resultados'>";
                        echo "</a>";
                    }
                ?>
                  <img src='https://softecuestre.com.ar/images/plano.png' alt='Plano Recorrido' height='50' />
        </div>
    </fieldset>	
                  <?php
                   
                 }
            
 
        ?>

</main>
<fieldset>
        <div>
    	<?PHP 
        	 
        	 include_once($_SERVER['DOCUMENT_ROOT'].'/menu/pie.htm');
	   ?> 
        </div>
</fieldset>        
</body>
</html>    
    
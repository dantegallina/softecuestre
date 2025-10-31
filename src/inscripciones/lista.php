<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Listas On Line</title>
	<link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />

        <style>
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
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
$prueba=$_GET['prueba'];

// Consulta para obtener los datos
$SQL="SELECT
    c.`Id_concurso`,
    c.`Id_prueba`, 
    c.`orden_ingreso`, 
    c.`Jinete`,
    c.`licencia_jin`,
    c.`Caballo`,
    c.`licencia_cab`,
    c.`categoria`, 
    c.`Club`,
    p.`Id_prueba`,
    p.`Id_categoria`,
    p.`pista`,
    p.`Id_Art_Def`,
    p.`Nro_prueba`,
    p.`dia`,
    x.`nom_categ`,
    x.`Id_categoria`,
    e.`Id_Art_Def`,
    e.`Definicion`,
    e.`Articulo`,
    t.`Id_evento`,
    t.`Nombre`,
    t.`club`,
    t.`tipo_concurso`,
    t.`logo_club`,
    i.`id_pista`,
    i.`Nombre` AS nom_pista
FROM `concurso` c
INNER JOIN `prueba` p ON c.`Id_prueba` = p.`Id_prueba`
INNER JOIN `categoria` x ON p.`Id_categoria` = x.`Id_categoria`
INNER JOIN `Art_Def` e ON p.`Id_Art_Def` = e.`Id_Art_Def`
INNER JOIN `evento` t ON p.`Id_evento` = t.`Id_evento`
INNER JOIN `pista` i ON p.`pista` = i.`id_pista`
WHERE c.`Id_prueba` = $prueba 
GROUP BY c.`Id_concurso`, c.`Id_prueba`, c.`orden_ingreso`, c.`Jinete`, c.`licencia_jin`, c.`Caballo`, c.`licencia_cab`, c.`categoria`, c.`Club`, p.`Id_prueba`, p.`Id_categoria`, p.`pista`, p.`Id_Art_Def`, p.`Nro_prueba`, p.`dia`, x.`nom_categ`, x.`Id_categoria`, e.`Id_Art_Def`, e.`Definicion`, e.`Articulo`, t.`Id_evento`, t.`Nombre`, t.`club`, t.`tipo_concurso`, t.`logo_club`
ORDER BY p.`Nro_prueba` ASC, CONVERT(c.`orden_ingreso`,SIGNED) ASC
";

$resultado = mysqli_query ($conexion, $SQL) or die ("NO HAY Nombres a elegir");


$trabajando=""; // si

if($trabajando=="si"){
    echo "<center><img src='http://softecuestre.com.ar/images/logo_3.jpg' width='150' height='100' /></br>";
    echo "<img src='http://softecuestre.com.ar/images/loading-100.gif' width='150' height='100' /></center>";
}else{
    if (mysqli_num_rows($resultado)>0){

        // Crear una tabla HTML para mostrar los resultados
        echo "<table>";
        $prev_id = null; // variable para almacenar el valor anterior de Id_prueba
        $hora = strtotime('07:38:00');
        echo "<tr>";
        echo "<td><td></td></td><td></td><td>Imprimir Planillas</td><td><button type='button' name='print' id='print' onclick='printPage()'><img src='https://softecuestre.com.ar/images/iconoimpresora.jpg' width='25' height='25' alt='Imprimir' /></button></td><td></td><td></td><td></td><td></td>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            $id = $row["Id_prueba"];
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $nombre_dia = strftime('%A %e', strtotime($row["dia"]));
            if ($id != $prev_id) { // si el valor de Id_prueba cambió
                echo "<tr>";
                echo "<td></td>";
                echo "<td><img src='http://softecuestre.com.ar/images/logo_3.jpg' width='150' height='100' /></td>";
                echo "<td><b> Día: ".$nombre_dia."</b> </br>Prueba Número:".$row["Nro_prueba"]."</br> Categoría: ". $row["nom_categ"]." </td>"; 
                //echo "<td></td>";
                echo "<td colspan='2'><center><b>".mb_convert_encoding($row["Nombre"], 'UTF-8', 'ISO-8859-1')."</br>".$row["tipo_concurso"]."</br>". mb_convert_encoding($row["club"], 'UTF-8', 'ISO-8859-1')."</b></center></td>";
                echo "<td>Definición: ".$row["Definicion"]."</br> Artículo: ".$row["Articulo"]."</br> Pista: ".mb_convert_encoding($row["nom_pista"], 'UTF-8', 'ISO-8859-1')." </td>";
                echo "<td></td>";
                echo "<td><img src='http://softecuestre.com.ar/imagenes/clubes/".$row["logo_club"]."' width='150' height='100' /></td>";
                echo "<td></td>";
                echo "</tr>";
                //echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                echo "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
                //echo "<tr><th>Id</th><th>Orden Ingreso</th><th>Jinete</th><th>Licencia</th><th>Caballo</th><th>Pasaporte</th><th>Categoría</th><th>Club</th><th>Hora</th></tr>";
                echo "<tr><th>Orden Ingreso</th><th>Jinete/Caballo</th><th>Categoría</th><th>Club</th><th>Hora</th></tr>";
            }
            $hora = $hora + 120; // sumar 2 minutos (120 segundos)
            $jinete = mb_convert_encoding($row["Jinete"], 'UTF-8', 'ISO-8859-1');
            $caballo = mb_convert_encoding($row["Caballo"], 'UTF-8', 'ISO-8859-1');
            $club = mb_convert_encoding($row["Club"], 'UTF-8', 'ISO-8859-1');
            echo "<tr class='fila''>";
            //echo "<td>" . $row["Id_concurso"] . "</td>";
            echo "<td><center>" . $row["orden_ingreso"] . "</center></td>";
            echo "<td>" . $jinete . "<br><font size=1.5>".$caballo."</font></td>";
            //echo "<td>" . $row["licencia_jin"] . "</td>";    
            //echo "<td>" . $caballo . "</td>";
            //echo "<td>" . $row["licencia_cab"] . "</td>";    
            echo "<td>" . $row["categoria"] . "</td>";
            echo "<td>" . $club . "</td>";
            //echo "<td>". date('H:i:s', $hora) . " hs</td>";
            echo "<td></td>";
            echo "</tr>";
            $prev_id = $id; // guardar el valor actual de Id_prueba para la próxima iteración
        }
    }else{
        echo "No hay Inscriptos al momento";
    }        
}
echo "</table>";
?>
 </body>
</html>

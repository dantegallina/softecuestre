<?php
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesión

// Verifica si la sesión está abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/loging.php"); // Redirige a la página de login
    exit();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Master List</title>
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
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            /*padding: 8px; */
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

        body {
            background-color: #1C293A;
            color: #1C293A;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #FFFFFF;
            color: #1C293A;
            padding: 20px;
            text-align: center;
        }

        form {
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            padding: 20px;
            text-align: left;
        }

        span {
            cursor:pointer
        }
        .page-break-before {
            page-break-before: always;
        }

        .page-break-after {
            page-break-after: always;
        }
    </style>

    <style media="print">
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        header {
            display: none;
        }

        form {
            box-shadow: none;
            margin: 0;
        }
        
        .imprimir {
            display: none;
        }

        #print {
            display: none;
        }
    </style>
</head>
<body>
<div>
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'].'/menu/menu.php');
    ?>
</div>
<header>
    <img src="https://softecuestre.com.ar/images/logo_3.jpg" width="200" height="150" />
    <h1>Master List</h1>
</header>
<main>
    <form name="f1" action="listas.php" method="post">
        <fieldset class='imprimir'>
            <legend>Seleccione el concurso de su interés</legend>
            <select  name="concurso" id="concurso" onchange="enviar_valores(this.value);" required >
                <option value="">Seleccionar opción</option>

                <?php
                if(isset($_SESSION['eventos_id'])) {
                    // Accede al valor de la variable de sesión eventos_id
                    $eventos_id = $_SESSION['eventos_id'];
    
                    // Convierte el array de eventos_id en una cadena separada por comas para usar en la cláusula IN de la consulta SQL
                    $eventos_id_str = implode(',', $eventos_id);
                    if(trim($eventos_id_str) == "0"){
                        $query = $mysqli -> query ("SELECT * FROM evento order by fecha");
                    }else{
                        $query = $mysqli -> query ("SELECT * FROM evento WHERE Id_evento IN ($eventos_id_str) order by fecha");
                    }
                
                
                $fecha = date('Y-m-d');
         

                while ($valores = mysqli_fetch_array($query)) {
                    if ($valores['fecha_fin']>=$fecha){
                        if (isset($_GET['valor'])) {
                            $valor=$_GET['valor'];
                            if ($valor==$valores['Id_evento']) {
                                echo '<option value="'.$valores['Id_evento'].'" selected>'.$valores['Nombre'].'</option>';
                            }else{
                                echo '<option value="'.$valores['Id_evento'].'">'.$valores['Nombre'].'</option>';
                            }
                        }else{
                            echo '<option value="'.$valores['Id_evento'].'">'.$valores['Nombre'].'</option>';
                        }
                    }else{
                        echo '<option value="'.$valores['Id_evento'].'" disabled>'.$valores['Nombre'].'</option>';
                    }
                }
}else{
     echo "No hay eventos para seleccionar";
}
                ?>
            </select>
        </fieldset>

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
        if (isset($_GET['valor'])) {
            $valor=$_GET['valor'];
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
            WHERE p.`Id_evento` = $valor 
            GROUP BY c.`Id_concurso`, c.`Id_prueba`, c.`orden_ingreso`, c.`Jinete`, c.`licencia_jin`, c.`Caballo`, c.`licencia_cab`, c.`categoria`, c.`Club`, p.`Id_prueba`, p.`Id_categoria`, p.`pista`, p.`Id_Art_Def`, p.`Nro_prueba`, p.`dia`, x.`nom_categ`, x.`Id_categoria`, e.`Id_Art_Def`, e.`Definicion`, e.`Articulo`, t.`Id_evento`, t.`Nombre`, t.`club`, t.`tipo_concurso`, t.`logo_club`
            ORDER BY  p.`dia` ASC, CAST(p.`Nro_prueba` AS UNSIGNED) ASC, CONVERT(c.`orden_ingreso`,SIGNED) ASC
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
                    echo "<tr class='imprimir'>";
                    echo "<td><td></td></td><td></td><td>Imprimir Planillas</td><td><button type='button' name='print' id='print' onclick='printPage()'><img src='https://softecuestre.com.ar/images/iconoimpresora.jpg' width='25' height='25' alt='Imprimir' /></button></td><td></td><td></td><td></td><td></td>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $id = $row["Id_prueba"];
                        setlocale(LC_TIME, 'es_ES.UTF-8');
                        $nombre_dia = strftime('%A %e', strtotime($row["dia"]));
                        if ($id != $prev_id) { // si el valor de Id_prueba cambió
                            echo "<tr class='fila page-break-before'>";
                            echo "<td></td>";
                            echo "<td colspan='1.5'><div><img src='http://softecuestre.com.ar/images/logo_3.jpg' width='100' height='50' /></br>softecuestre.com.ar</div></td>";
                            echo "<td><b> Día: ".$nombre_dia."</b> </br>Prueba:".$row["Nro_prueba"]."</br> Cat.: ". $row["nom_categ"]." </td>"; 
                            //echo "<td></td>";
                            echo "<td colspan='2'><center><b>".mb_convert_encoding($row["Nombre"], 'UTF-8', 'ISO-8859-1')."</br>".$row["tipo_concurso"]."</br>". mb_convert_encoding($row["club"], 'UTF-8', 'ISO-8859-1')."</b></center></td>";
                            echo "<td><div>Def.: ".$row["Definicion"]."</br> Art.:".$row["Articulo"]."</br> Pista: ".mb_convert_encoding($row["nom_pista"], 'UTF-8', 'ISO-8859-1')." </div></td>";
                            echo "<td></td>";
                            echo "<td colspan='1'><img src='http://softecuestre.com.ar/imagenes/clubes/".$row["logo_club"]."' width='100' height='50' /></td>";
                            echo "<td></td>";
                            echo "</tr>";
                            echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                            echo "<tr><th>Id</th><th>Orden Ingreso</th><th>Jinete</th><th>Licencia</th><th>Caballo</th><th>Pasaporte</th><th>Categoría"."  "."</th><th>Club</th><th>Hora"."  "."</th><th>Pago</th></tr>";
                        }
                        $hora = $hora + 120; // sumar 2 minutos (120 segundos)
                        $jinete = mb_convert_encoding($row["Jinete"], 'UTF-8', 'ISO-8859-1');
                        $caballo = mb_convert_encoding($row["Caballo"], 'UTF-8', 'ISO-8859-1');
                        $club = mb_convert_encoding($row["Club"], 'UTF-8', 'ISO-8859-1');
                        echo "<tr class='fila''>";
                        echo "<td>" . $row["Id_concurso"] . "</td>";
                        echo "<td><center>" . $row["orden_ingreso"] . "</center></td>";
                        echo "<td>" . $jinete . "</td>";
                        echo "<td>" . $row["licencia_jin"] . "</td>";    
                        echo "<td>" . $caballo . "</td>";
                        echo "<td>" . $row["licencia_cab"] . "</td>";    
                        echo "<td>" . $row["categoria"] . "</td>";
                        echo "<td>" . $club . "</td>";
                        //echo "<td>". date('H:i:s', $hora) . " hs</td>";
                        echo "<td></td>";
                        echo "<td><input type='checkbox'></input></td>";
                        echo "</tr>";
                        $prev_id = $id; // guardar el valor actual de Id_prueba para la próxima iteración
                    }
                }else{
                    echo "No hay Inscriptos al momento";
                }
            }
            echo "</table>";
        }
        ?>
    </form>
</main>

</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    function enviar_valores(valor){
        //Pasa los parámetros a la pagina buscar
        location.href='https://softecuestre.com.ar/src/inscripciones/listasadmin.php?valor=' + valor;
    }
</script>

</html>

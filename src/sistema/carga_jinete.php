<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
$id_jinete = $_GET['id_jinete'];
$id_prueba = $_GET['id_prueba'];
session_save_path(__DIR__ . '/tmp_sessions');

session_start(); // Inicia la sesión

// Verifica si la sesión está abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: https://softecuestre.com.ar/src/sistema/loging.php"); // Redirige a la página de login
    exit();
}

$nfilas = 0;
if ($id_jinete != null) {
    // Enviar consulta
    $instruccion = "select * from concurso WHERE Id_concurso=" . $id_jinete;
    $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta");

    // Mostrar resultados de la consulta
    $nfilas = mysqli_num_rows($consulta);
}
//echo $id_prueba;
 
    $consulta1 = "select * from prueba  WHERE Id_prueba=".$id_prueba;
      $consulta2 = mysqli_query ($conexion, $consulta1 )
         or die ("Fallo en la consulta");


    $nfilas2 = mysqli_num_rows ($consulta2);

    //$prueba = null;
    if ($nfilas2=1){
        $resultado1 = mysqli_fetch_array ($consulta2);
        //$prueba = $resultado1['Id_prueba'];
        $TA = $resultado1['Tiempo_Acordado'];
        $TO =$resultado1['Tiempo_Optimo'];
        $TA2R = $resultado1['Tiempo_Acordado_2R'];
    } 
 
 
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Computos</title>
    <link rel="shortcut icon" href="https://softecuestre.com.ar/favicon.ico" type="image/x-icon" />
    <link href="https://softecuestre.com.ar/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://softecuestre.com.ar/js/jquery.js"></script>
    <script type="text/javascript" src="https://softecuestre.com.ar/js/interface.js"></script>
    <link rel="stylesheet" href="https://softecuestre.com.ar/css/estilo.css" type="text/css" media="all">
    <script type="text/javascript" src="https://softecuestre.com.ar/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="https://softecuestre.com.ar/js/main.js"></script>
    <script type="text/javascript">
        var contador1 = 1;
        var contador2 = 1;
        var total1 = 0;
        var total2 = 0;        

        function cargarValor(selectId, inputId, contadorId) {
            var select = document.getElementById(selectId);
            var input = document.getElementById(inputId);
            var contador = document.getElementById(contadorId);
            var faltasRI = document.getElementById("faltas_RI");
            var faltas2R = document.getElementById("faltas_2R");

            
            
            if (contadorId === "contador1") {
                input.value = input.value + contador.value + " (" + select.value + ") - ";
                contador.value = parseInt(contador.value) + 1;
                if (select.value == 99 || select.value == 88) {
                    total1 = parseInt(select.value);
                    faltasRI.value = total1;
                }else{    
                    total1 = parseInt(total1) + parseInt(select.value);
                    faltasRI.value = total1;
                }
            } else if (contadorId === "contador2") {
                input.value = input.value + contador.value + " (" + select.value + ") - ";
                contador.value = parseInt(contador.value) + 1;
                if (select.value == 99 || select.value == 88) {                
                    total2 = parseInt(select.value);
                    faltas2R.value = total2;
               }else{ 
                    total2 = parseInt(total2) + parseInt(select.value);
                    faltas2R.value = total2;
               }
            }
        }
    </script>
</head>
<body>
<FORM>
<h2> DATOS</h2>

<?php
if ($nfilas == 0) {
    echo 'No hay resultados';
}

for ($i = 0; $i < $nfilas; $i++) {
    $resultado = mysqli_fetch_array($consulta);
?>
    <th> Orden </th><input type="text" id="orden_ingreso" name="orden_ingreso" value="<?php echo $resultado['orden_ingreso'] ?>" /></br>
    <th> Jinete </th><input type="text" id="Jinete" name="Jinete" value="<?php echo mb_convert_encoding($resultado['Jinete'], 'UTF-8', 'ISO-8859-1'); ?>" /></br>
    <th> Caballo </th><input type="text" id="Caballo" name="Caballo" value="<?php echo mb_convert_encoding($resultado['Caballo'], 'UTF-8', 'ISO-8859-1'); ?>" /></br>
    <th> Categoría </th><input type="text" id="Categoria" name="Categoria" value="<?php echo mb_convert_encoding($resultado['categoria'], 'UTF-8', 'ISO-8859-1'); ?>" /></br>
    <th> Club </th><input type="text" id="Club" name="Club" value="<?php echo mb_convert_encoding($resultado['Club'], 'UTF-8', 'ISO-8859-1'); ?>" /></br>
    </br>
    <th> TO: <?php echo $TO ?></th><th> TA: <?php echo $TA ?></th></br>
------------------------------------------------------------</br>
</br>
    <th> Recorrido Inicial</th></br>
    <select name="faltas1" id="faltas1">
        <option value="0" selected>Sin Falta</option>
        <option value="4">Derribo</option>
        <option value="4">Negada</option>
        <option value="88">Retirado</option>
        <option value="99">Eliminado</option>
    </select>
    <button type="button" onclick="cargarValor('faltas1', 'input1', 'contador1')">Siguiente Obstáculo</button>
    <input type="text" id="input1" value="" /></br>
    <input type="hidden" id="contador1" value="1" />
    
    <th> Faltas RI </th><input type="text" id="faltas_RI" name="faltas_RI"  /> </br>
    <th> Tiempo RI </th><input type="text" id="tiempo_RI" name="tiempo_RI" value="<?php echo $resultado['tiempo_RI'] ?>" /></br>
    <th> Faltas por tiempo RI </th><input type="text" id="faltas_x_t_RI" name="faltas_x_t_RI"  /> </br>
    <th> Dif tiempo optimo </th><input type="text" id="dif_to" name="dif_to"  /> </br>
    <th> Total Faltas RI </th><input type="text" id="total_faltas_RI" name="total_faltas_RI"  /> </br>

------------------------------------------------------------</br>
</br>

    <th> 2 Recorrido </th></br>
    <select name="faltas2" id="faltas2">
        <option value="0" selected>Sin Falta</option>
        <option value="4">Derribo</option>
        <option value="4">Negada</option>
        <option value="88">Retirado</option>
        <option value="99">Eliminado</option>
    </select>
    <button type="button" onclick="cargarValor('faltas2', 'input2', 'contador2')">Siguiente Obstáculo</button>
    <input type="text" id="input2" value="" /></br>
    <input type="hidden" id="contador2" value="1" />
    
    <th> Faltas 2R </th><input type="text" id="faltas_2R" name="faltas_2R"  /> </br>
    <th> Tiempo 2R </th><input type="text" id="tiempo_2R" name="tiempo_2R" value="<?php echo $resultado['tiempo_2R'] ?>" /></br>
    <th> Faltas por tiempo 2R </th><input type="text" id="faltas_x_t_2R" name="faltas_x_t_2R"  /> </br>
    <th> Total Faltas 2R </th><input type="text" id="total_faltas_2R" name="total_faltas_2R"  /> </br>
    
<?php
}
?>
</br>
<button type="button" > ACEPTAR </button>
</FORM>
</body>
</html>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php');
$prueba = $_POST['id_prueba'];

// orden_ingreso
// Club
// Jinete
// Caballo
// faltas_RI
// faltas_x_time_RI
// tiempo_RI
// faltas_2R
// faltas_x_time_2R
// tiempo_2R
// faltas_DES
// faltas_x_time_DES
// tiempo_DES
// faltas_TOTAL
// Inicia
// finaliza
// clasificacion


/*
      $consulta1 = "select * from prueba  WHERE activa=1";
      $consulta2 = mysqli_query ($conexion, $consulta1 )
         or die ("Fallo en la consulta");


    $nfilas1 = mysqli_num_rows ($consulta2);

    //$prueba = null;
    if ($nfilas1=1){
        $resultado1 = mysqli_fetch_array ($consulta2);
        //$prueba = $resultado1['Id_prueba'];
        $TA = $resultado1['Tiempo_Acordado'];
        $TA2R = $resultado1['Tiempo_Acordado_2R'];
    }
*/

    $nfilas = 0;
    if($prueba != null){
       // Enviar consulta
          $instruccion = "select * from concurso WHERE Id_prueba=".$prueba." order by Cast(orden_ingreso as unsigned) ASC";
          $consulta = mysqli_query ($conexion, $instruccion)
             or die ("Fallo en la consulta");

    // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);

    }



?>
<body>

<div id="content">
    <h2>Listado</h2>
    <table width='100%' id="content_name_form">
        <th>Estado</th>
        <th>Orden</th>
        <th>Ver</th>
        <th>Jinete</th>
        <th>Caballo</th>
        <th>Categoría</th>
        <th>Club</th>
        <th>Faltas RI</th>
        <th>Tiempo RI</th>
        <th>Faltas 2R</th>
        <th>Tiempo 2R</th>
        <th>Clasificacion</th>

    <?php
    if($nfilas == 0){echo 'No hay resultados';}

    $colorfila = 0;

     for ($i=0; $i<$nfilas; $i++) {
         $resultado = mysqli_fetch_array($consulta);
        // var_dump($resultado);

        if ($colorfila==0){
            $color= "#DEDEBE";
            $colorfila=1;
        }else{
            $color="#F0F0F0";
            $colorfila=0;
        }

         $style = 'neutro-cell';
         if($resultado['Inicia'] == 1) $style = 'green-cell';
         if($resultado['finaliza'] == 1) $style = 'red-cell';


        ?>
            <tr data-id="<?php echo $resultado['Id_concurso']?>" data-id-campeonato="<?php echo $resultado['Id_campeonato']?>" >
               <!--activo pone en 1 iniciado y desactivo pone en 1 a finalizado, podria ser un tercer estadío de reset-->

               <td class="estado <?php echo $style?>" ></td>
               <!--
               <td style="background-color: <?php echo $color_botton?>"><input type="text" id="Inicia" name="Inicia"  /></td>
               <td style="background-color: <?php echo $color_botton_end?>"><input type="text" id="finaliza" name="finaliza"  /></td>-->
                           
               <td class="form-int" bgcolor="<?php echo $color?>"><input type="text" id="orden_ingreso" name="orden_ingreso" value="<?php echo $resultado['orden_ingreso']?>"/></td>

                <td class="form-int" bgcolor="<?php echo $color?>"><a title="Ver" href="#" onclick="window.open('carga_jinete.php?id_jinete=<?php echo $resultado['Id_concurso']?>&id_prueba=<?php echo $prueba?>', 'popup', 'width=700,height=600'); return false;"><img src="https://softecuestre.com.ar/images/lupa.jpg" width="50" height="50"/></a></td>


               <td class="form-int" bgcolor="<?php echo $color?> width='30'"><input type="text" id="Jinete" name="Jinete" value="<?php echo mb_convert_encoding($resultado['Jinete'], 'UTF-8', 'ISO-8859-1');?>"/></td>
               <td class="form-int" bgcolor="<?php echo $color?> width='30'"><input type="text" id="Caballo" name="Caballo" value="<?php echo mb_convert_encoding($resultado['Caballo'], 'UTF-8', 'ISO-8859-1');?>"/></td>
               <td class="form-int" bgcolor="<?php echo $color?> width='30'"><input type="text" id="Categoria" name="Categoria" value="<?php echo mb_convert_encoding($resultado['categoria'], 'UTF-8', 'ISO-8859-1');?>"/></td>               
               <td class="form-int" bgcolor="<?php echo $color?> width='30'"><input type="text" id="Club" name="Club" value="<?php echo mb_convert_encoding($resultado['Club'], 'UTF-8', 'ISO-8859-1');?>"/></td>
               <td class="form-int"><input type="text" id="faltas_RI" name="faltas_RI" value="<?php echo $resultado['faltas_RI']?>" /><font size="-5">88 Ret/99 Eli</font></td>
               <td class="form-int"><input type="text" id="tiempo_RI" name="tiempo_RI" value="<?php echo $resultado['tiempo_RI']?>" /></td>
               <td class="form-int"><input type="text" id="faltas_2R" name="faltas_2R" value="<?php echo $resultado['faltas_2R']?>" /><font size="-5">88 Ret/99 Eli</font></td>
               <td class="form-int"><input type="text" id="tiempo_2R" name="tiempo_2R" value="<?php echo $resultado['tiempo_2R']?>" /></td>               
               <td class="form-int"><input type="text" id="clasificacion" name="clasificacion" value="<?php echo $resultado['clasificacion']?>"/>
               
               </td>
            </tr>
    <?php  } ?>

    </table>


</body>
</html>
    
    
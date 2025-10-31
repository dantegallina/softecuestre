<?php  
include_once($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_sistema.inc.php'); 
$mimail = "inscripciones@softecuestre.com.ar";
$urlppal = "http://softecuestre.com.ar/src/inscripciones/inscripciones.php";

    //Ip cliente: 
@$pfw_ip= $_SERVER['REMOTE_ADDR'];

$search_jinete="";
$jinete_no_federado="";
$search_caballo="";
$caballo_no_federado="";
$categoria_jinete_no_federado="";
$categoria_jinete_federado="";
$hidden_categoria_jinete_federado="";
$club_jinete_federado="";
$hidden_club_jinete_federado="";
$club_jinete_no_federado="";
$tel_jinete_federado="";
$tel_jinete_no_federado="";
$lic_jinete="";
$lic_caballo="";
$hidden_pasaporte="";
$dni=0;
$fnac="";

foreach ($_POST as $nombre_campo => $valor) {
	$valor_limpio = filter_input(INPUT_POST, $nombre_campo, FILTER_SANITIZE_STRING);
	$asignacion = "\$" . $nombre_campo . "='" . $valor_limpio . "';";
	eval($asignacion);
	//echo $asignacion;
}
$fecha_actual = date_create_from_format('d/m/Y', date('d/m/Y'));

if ($search_jinete<>""){
    $jinete=$search_jinete;
    
    $fnac = $hidden_f_nac_federado;

    
    if (!empty($fnac)) {
        $fnac = date_create_from_format('d/m/Y', $hidden_f_nac_federado);
        $diff = date_diff($fnac, $fecha_actual);

        if ($hidden_categoria_jinete_federado == "Escuela") {
            if ($diff->y < 14 || ($diff->y == 14 && $diff->m <= 0 && $diff->d <= 0)) {
                $categoria = "Escuela Menor";
            } else {
                $categoria = "Escuela Mayor";
            }
        } elseif ($hidden_categoria_jinete_federado == "Iniciados") {
            if ($diff->y < 14 || ($diff->y == 14 && $diff->m <= 0 && $diff->d <= 0)) {
                $categoria = "Iniciados Menor";
            } else {
                $categoria = "Iniciados Mayor";
            }
            
        } elseif ($hidden_categoria_jinete_federado == "Tercera") {
            if ($diff->y < 14 || ($diff->y == 14 && $diff->m <= 0 && $diff->d <= 0)) {
                $categoria = "Tercera Menor";
            } else {
                $categoria = "Tercera Mayor";
            }

            
            
        }else{
            $categoria = $hidden_categoria_jinete_federado;
        }
    }else{
        $categoria = $hidden_categoria_jinete_federado;
    }
	$club=$hidden_club_jinete_federado;
	$lic_jinete=$hidden_licencia_jinete_federado;
	if($tel_jinete_federado<>""){
	    $tel=$tel_jinete_federado;
	}else{
	    $tel="";
	}
}elseif ($jinete_no_federado<>""){
	$jinete=$jinete_no_federado;
	$categoria="LIBRE";
	$club=$club_jinete_no_federado;
	$dni=$dni;
	if($tel_jinete_no_federado<>""){
    	$tel=$tel_jinete_no_federado;
	}else{
	    $tel="";
	}
}else{
    
    echo "Faltan Datos de jinete";
}



if ($search_caballo<>""){
	$caballo=$search_caballo;
	$lic_caballo=$hidden_pasaporte;
}elseif($caballo_no_federado<>""){
	$caballo=$caballo_no_federado;
}else{
    $caballo="";
    echo "falta nombre caballo";
}


$pruebas_seleccionadas = $_POST['prueba_id'];
foreach ($pruebas_seleccionadas as $prueba_id) {
        $cons_prueba = "SELECT * FROM prueba WHERE Id_prueba = " . $prueba_id ;
        if ($res_prueba = $mysqli->query($cons_prueba)) {
            while ($fila_prueba = $res_prueba->fetch_row()) {
                $pruebas = $fila_prueba[3]; // Almacenar el nombre de la prueba en el arreglo
            }
            $res_prueba->close();
        }
  
				//Insertamos la nueva inscripcion
				$query = $mysqli -> query("INSERT INTO concurso (`Id_concurso`, `Id_prueba`, `orden_ingreso`, `Club`, `Id_jinete`, `Jinete`, `dni`, `licencia_jin`, `categoria`, `foto`, `Id_caballo`, `Caballo`, `licencia_cab`,`faltas_RI`, `faltas_x_time_RI`, `tiempo_RI`, `faltas_2R`, `faltas_x_time_2R`, `tiempo_2R`, `faltas_DES`, `faltas_x_time_DES`, `tiempo_DES`, `faltas_TOTAL`, `Inicia`, `finaliza`, `clasificacion`, `Id_campeonato`, `tiempo_tablac`, `video`) VALUES (NULL, '$prueba_id', NULL, '$club', NULL, '$jinete', '$dni', '$lic_jinete','$categoria', '', NULL, '$caballo', '$lic_caballo',NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '0', '0', '' )");
                if (!$query) {
                    printf("Error en la consulta: %s\n", mysqli_error($mysqli));
                    exit();
                }else{


				//SI NO HAY ERRORES Y SE HA PULSADO EN ENVIAR, SE ENVIA EL MENSAJE
				//transformar $prueba_id en el numero real de prueba
				
				$to= $mimail;
				$mensaje='Jinete: '.$jinete."\n".'Caballo: '.$caballo."\n".'Categoria: '.$categoria."\n".'Club: '.$club."\n".'Prueba: '.$pruebas."\n".'Tel de Contacto: '.$tel."\n"; 
				$subject = 'Inscripcion: '.$jinete;
				$message = 'Datos de Inscripcion: '."\n".$mensaje."\n".'IP del visitante: '.$pfw_ip."\n";
				$headers = "From: $email\r\n" .
				'Reply-To:'.$email."\r\n" .
				'X-Mailer: PHP/' . phpversion();
				$resultado=mail($to, $subject, $message, $headers);
				
				
				//Enviando auto respuesta.
				
				$pfw_header = "From: $jinete<$mimail>" . "\r\n"
				. "Reply-To: ".$mimail."\n";
                $pfw_header .= "MIME-Version: 1.0" . "\r\n";
                $pfw_header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				$pfw_subject = "Inscripción recibida";
				
				$pfw_email_to = "$email";
				
				$pfw_message = '<html><body>';
                $pfw_message .= "Muchas Gracias $jinete, por tu Inscripcion:<br>";
                $pfw_message .= "Jinete: $jinete<br>";
                $pfw_message .= "Categoria: $categoria<br>";
                $pfw_message .= "Caballo: $caballo<br>";
                $pfw_message .= "Club: $club<br>";
                $pfw_message .= "Prueba: $pruebas<br>";
                $pfw_message .= "Tel de contacto: $tel<br>";
                $pfw_message .= "<br>";
                $pfw_message .= "Tu inscripción ha sido recibida satisfactoriamente.<br>";
                $pfw_message .= "De ser necesario, nos pondremos en contacto en tu e-mail: $email<br><br>";
                $pfw_message .= "<hr>";
                $pfw_message .= "<p>Favor de NO responder este E-mail ya que es generado automáticamente.</p>";
                $pfw_message .= "<p>Configura tu lista de correo spam para que acepte nuestros mensajes.</p>";
                $pfw_message .= "</br>";
                $pfw_message .= "<p>Saludos.</p>";
                $pfw_message .= "<img src='https://softecuestre.com.ar/images/logo_3.jpg' height='150' />";
                $pfw_message .= "<p><a href='https://softecuestre.com.ar'>Softecuestre.com.ar</a></p>";
                $pfw_message .= '</body></html>';
				
				mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;
				
				
				//whats app
				//token permanente
				//$token ="https://developers.facebook.com/tools/debug/accesstoken/?access_token=EAAJdZAjC5OIoBAHEwTxZCMJaHhf9rEAz08paMXOZCfg534ZCJK9GEdtQGKOjnHdbTCjAn04hl0cBGyCPJ7IrAtBxiVujkZCoaRZCXtCqBY00hoFWMc5k7p3KgE9u1UiDI0Jm81SPXXmycmFLcXnvQV7arkM5U1tv2geEStpV9b6b7rYYQmqiEzX3jPBedZAAXI45E4FhsYukQZDZD";
				//$URLTel='https://graph.facebook.com/v17.0//messages';
				//$mensajetel=''
				//.'{'
				//.'"messaging_product":"whatsapp",'
				//.'"to":"'.$tel.'",'
				//.'"type":"template",'
				//.'"template":'
				//.'{'
				//.'          "name":"inscripciones",'
				//.'          "lenguage":{"code":"sp_AR"}'
				//.'}'
				//.'}';
               //$headertel = array("Authorization: Bearer ".$token, "Content-Type: application/json",);
               //$curl = curl_init();
               //curl_setopt($curl, CURLOPT_URL, $URLTel);
               //curl_setopt($curl, CURLOPT_POSTFIELDS, $mensajetel);
               //curl_setopt($curl, CURLOPT_HTTPHEADER, $headertel);
               //curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               //$response = json_decode(curl_exec($curl),true);
               //$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
               //curl_close($curl);
                }
                 //imprimo respuesta
               //  print_r($response);
                 
				//echo "El resultado es ".$resultado;
				if($resultado){ 
					echo "<br /><b><span class='blanco'>Correo enviado correctamente</span><br/> Verifique el correo Spam </b>";
                    echo "Jinete:".$jinete."</br>";
                    echo "Categoria:".$categoria."</br>";
					echo "Caballo:".$caballo."</br>";
					echo "Club:".$club."</br>";
					echo "Prueba:".$pruebas."</br>";
					echo "Tel de Contacto:".$tel."</br>";
				}else{ 
					echo "<br /><b><span class='blanco'>El correo no ha podido enviarse. Contacta a trav&eacute;s del nuestro e-mail:".$mimail."</span></b>";
				}

    
    
    
}
?>
<html>
<body>
<?php echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"10;URL=" . $urlppal . "?valor=" . urlencode($evento) . "\">"; ?>

</body>
</html>
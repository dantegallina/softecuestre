<?  
require('admin/configuracion.inc.php'); 



    //Ip cliente: 
@$pfw_ip= $_SERVER['REMOTE_ADDR'];
$ciudad= $_REQUEST['ciudad'];
$nombrepastor= $_REQUEST['nombrepastor'];
$cargo= $_REQUEST['cargo'];
$pais= $_REQUEST['pais'];
if($pais=='AR'){
	$provincia= $_REQUEST['provincia'];
}
else {
	$provincia='';
}
$direccion= $_REQUEST['direccion'];
$telefono= $_REQUEST['telefono'];
$celular= $_REQUEST['celular'];
$sexo= $_REQUEST['sexo'];
//$idusr= $_REQUEST['idusr'];
$idusr= '0';
$fecha1= time()-3600;
$fecha= date("Y-m-d");

//date($fecha1);
//"Y-m-d H:i:s"

		$nombre=filter_input(INPUT_POST,"nombre",FILTER_SANITIZE_STRING);
		if($nombre=="")
			$errores[]="El campo nombre no puede estar vacio";

		if(!$email=filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL))
			$errores[]="El correo introducido no es v&aacute;lido.";

		$apellido=filter_input(INPUT_POST,"apellido",FILTER_SANITIZE_STRING);
		if($apellido=="")
			$errores[]="El campo apellido no puede estar vacio";
		if(isset($errores)){
			?>
			<br /><b><span class='rojo'>El regsitro no puede ser cargado debido a los siguientes errores:  </span></b>
			<?php	
			echo "<ul class='errores'>";
			foreach($errores as $error)
				echo '<li>'.$error.'</li>';
			echo '</ul>';
			?>

			<script type="text/javascript">alert('Debe completar los datos requeridos en el formulario');</script>
<?		}

		else{

//Conectamos con la base de datos 
$enlace = mysql_connect($host, $usuario, $password); 
mysql_select_db($db,$enlace); 

//Insertamos la nueva encuesta 
$sql = "INSERT INTO congreso (fecha, ciudad, nombrepastor, cargo, pais, estado, telefono, celular, direccion, nombre, email, sexo, apellido) Values ('$fecha', '$ciudad', '$nombrepastor', '$cargo', '$pais', '$provincia', '$telefono', '$celular', '$direccion', '$nombre', '$email', '$sexo', '$apellido')"; 
$sql = mysql_query($sql); 


mysql_close($enlace); // cierra la conexion con la base de datos



		//SI NO HAY ERRORES Y SE HA PULSADO EN ENVIAR, SE ENVIA EL MENSAJE

		
			$to= $mimail;
			$mensaje='Nombre: '.$nombre."\n".'Apellido: '.$apellido."\n".'Cargo: '.$cargo."\n".'País: '.$pais."\n".'Provincia: '.$provincia."\n".'Ciudad: '.$ciudad."\n".'Teléfono: '.$telefono."\n".'Celular: '.$celular."\n".'Direccion: '.$direccion."\n".'Sexo: '.$sexo."\n"; 
			
			$subject = 'Inscripcion: '.$_POST['nombre'];
			$message = 'Datos de Inscripción: '."\n".$mensaje."\n".'IP del visitante: '.$pfw_ip."\n";
			$headers = "From: $email\r\n" .
				'Reply-To:'.$email."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			$resultado=mail($to, $subject, $message, $headers);
			//
				echo "El resultado es ".$resultado;
			if($resultado)
				echo "<br /><b><span class='blanco'>Correo enviado correctamente</span></b>";
				// echo "<br /><b><span class='blanco'>Chequee en su lista de correo Spam, puede ser que el mensaje esté bloqueado</span></b>";
			else 
				echo "<br /><b><span class='blanco'>El correo no ha podido enviarse. Contacta a trav&eacute;s del nuestro e-mail:".$mimail."</span></b>";
				
			//Enviando auto respuesta.
$pfw_header = "From: ".$mimail."\n"
. "Reply-To: ".$mimail."\n";
$pfw_subject = "Mensaje recibido";
$pfw_email_to = "$email";
$pfw_message = "Muchas Gracias $nombre, por su Inscripcion:\n $mensaje\n"
. "Su mensaje ha sido recibido satisfactoriamente. \n"
. "Nos pondremos en contanto contigo lo antes posible en su e-mail: $email \n"
. " \n"
. " \n"
. "--------------------------------------------------------------------------\n"
. "Favor de NO responder este E-mail ya que es generado Automaticamente.\n"
. "Configure su lista de correo spam para que acepte nuestros mensajes"
. "Atte. Avivamiento Olavarría.\n"
. $urlppal;
@mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;


				
		}
?>
<html>
<body>
<? echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$urlppal."\">"; ?>
</body>
</html>
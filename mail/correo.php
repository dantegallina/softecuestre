<?php 

require($_SERVER['DOCUMENT_ROOT'].'/config/configuracion_basica.inc.php');

@$REMOTE_ADDR= $_SERVER['REMOTE_ADDR'];
@$HTTP_USER_AGENT= $_SERVER['HTTP_USER_AGENT'];

$nombresitio = $urlppal;
$contacto = $micontacto;
$gracias = "Gracias por enviar sus comentarios. En breve nos pondremos en contacto con usted";

$nombredeusuario= $_REQUEST['nombredeusuario'];
$apellidopaterno= $_REQUEST['apellidopaterno'];
$direccion= $_REQUEST['direccion'];
$telefono= $_REQUEST['telefono'];
$institucion= $_REQUEST['institucion'];
$ciudad= $_REQUEST['ciudad'];
$estado= $_REQUEST['estado'];
$correoelectronico= $_REQUEST['correoelectronico'];
$comentarios= $_REQUEST['comentarios'];
$parausuario = "";
$administrador ="";
?>

<HTML>
<HEAD>
<TITLE> 
    <?php echo $nombresitio?> - Formulario de Contacto 
</TITLE>
<META NAME="Description" CONTENT="Comentarios y sugerencias">


</HEAD>
 
<BODY BGCOLOR="#FFFFFF" text="#000000">
<center>
<table width="100%" bgcolor="black" cellspacing=0 cellpadding=0 valign=center border=0>
<tr>
  <td bgcolor="#EBD5DF">
    <center>
        <b>
        <font face="Verdana" size="2">CORREO ELECTR�NICO ENVIADO EXITOSAMENTE</font>
        </b>
  </td>
</tr>
</table>
</center> 

<CENTER>
<BR>
<font face="Arial,verdana,helvica,san serif" size="2">Gracias por enviarme sus comentarios y/o sugerencias.<BR>
Sus comentarios fueron enviados a la direcci�n de correo electr�nico: <?php echo $contacto?> en unos momentos m�s 
recibira un mensaje de confirmaci�n en su correo electr�nico.
</font>
</CENTER>
 
<?
$parausuario = "$nombredeusuario $apellidopaterno, gracias por enviar sus comentarios y/o sugerencias \n";
$parausuario .= "En un lapso de 24 horas responderemos a su correo electr�nico.\n";
$parausuario .= "Su mensaje fue enviado a la siguiente direcci�n de correo electr�nico:  $contacto\n\n";
$parausuario .= "$contacto\n";
$administrador .= "------Formulario de Comentarios y Sugerencias------\n";
$administrador .= "Nombre completo: $nombredeusuario $apellidopaterno \n";
$administrador .= "Direcci�n: $direccion\n";
$administrador .= "Instituci�n: $institucion\n";
$administrador .= "Tel�fono: $telefono\n";
$administrador .= "Ciudad: $ciudad\n";
$administrador .= "Estado: $estado\n";
$administrador .= "Correo Electr�nico: $correoelectronico\n";
$administrador .= "Comentarios:\n";
$administrador .= "$comentarios\n";
$administrador .= "----------Informaci�n de quien me visita----------\n";
$administrador .= "$HTTP_USER_AGENT\n";
$administrador .= "$REMOTE_ADDR\n";
mail("$correoelectronico", "$gracias", $parausuario, "From: $contacto");
mail("$contacto", "$nombresitio", $administrador, "From: $correoelectronico");

for ($i=0;$i<500000;$i++) { 

} 

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$urlppal."\">";
?>


<p><br>
</center>
</BODY>
</HTML>
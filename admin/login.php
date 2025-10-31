<?php

require('admin/configuracion.inc.php');

session_start();

// Conectar a la base de datos
mysql_connect ($host, $usuario, $password);
mysql_select_db($db) or die('Cannot select database');

if ($_POST['username']) {
//Comprobacion del envio del nombre de usuario y password
$username=$_POST['username'];
$password=$_POST['password'];
$sistema=$_POST['sistema'];

if ($password==NULL) {
echo "<center>La password no fue enviada<center>";
}else{
$query = mysql_query("SELECT username,password FROM users WHERE username = '$username'") or die(mysql_error());
$data = mysql_fetch_array($query);
if($data['password'] != $password) {
echo "<center>Login incorrecto<center>";
}else{
$query = mysql_query("SELECT id,username,password FROM users WHERE username = '$username'") or die(mysql_error());
$row = mysql_fetch_array($query);
$_SESSION["s_username"] = $row['username'];
$_SESSION["idusr"] = $row['id'];


header("Location: nominales.php");



}
}
}
?>
<html>
<link href="images/estilo.css" rel="stylesheet" type="text/css">
<body background="images/Fondo.png">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<center>
<h1>Login Usuario</h1>
	<center>
		<form action='login.php' method='POST'>
<table style='border:1px solid #000000;'>
<tr>
<td align='right'>
Nombre de usuario: <input type='text' size='15' maxlength='25' name='username'>
</td>
</tr>
<tr>
<td align='right'>
Password: <input type='password' size='15' maxlength='25' name='password'>
</td>
</tr>

               <tr>
                    <td align='center'>
                        <select id="sistema" name="sistema">
                            <option value="">Selecciones el Sistema</option>
                            <option value="0">Inscripciones Nominales</option>
                            <option value="1">CC Salto</option>
                            <option value="2">CC Endurance</option>
                            <option value="3">Telecuestre</option>
                            <option value="4">EquGest</option>                
                        </select>
                    </td>
                </tr>

<tr>
<td align='center'>
<input type="submit" value="Login">
</td>
</tr>
<tr>
<td align='center'>
<center><font class=\"content\"><a href="registro.php"></a></font></center>
</td>
</tr>
</table>
</form>
<?php
require_once("piecito.htm");
?>
</html>
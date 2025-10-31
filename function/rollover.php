<html>
<head>
<meta charset="utf-8">
<title></title>
<style type="text/css">
#contenedor
{
	height:20px;
	overflow:hidden;
	background-color:#900;
}
#contenido
{
	color:#ffffff;
	-webkit-animation-name:cintaInformativa;
	-webkit-animation-duration:25s;
	-webkit-animation-iteration-count:infinite;
	-moz-animation-name:cintaInformativa;
	-moz-animation-duration:25s;
	-moz-animation-iteration-count:infinite;
}
@-webkit-keyframes cintaInformativa
{
	from {
		margin-left:100%;
	}
	to {
		margin-left:-150%;
	}
}
@-moz-keyframes cintaInformativa
{
	from {
		margin-left:100%;
	}
	to {
		margin-left:-150%;
	}
}
</style>
</head>

<body>
	<div id="contenedor">
		<div id="contenido">
			En estos momentos hay una demostracion de un gaucho ranquel. El horario de inicio del Derby esta previsto para las 15:30 hs. 
		</div>
	</div>
</body>
</html>
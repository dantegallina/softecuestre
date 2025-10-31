<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    

    <link rel="stylesheet" href="https://softecuestre.com.ar/css/icon.css">
<style>
{
	margin:0;
	padding:0;
}

body {
	background:#FFFFFA;
}

header {
	width:100%;
}

header nav {
	width:90%;
	max-width:1000px;
	margin:20px auto;
	background:#024959;
}

.menu_bar {
	display:none;
}

header nav ul {
	overflow:hidden;
	list-style:none;
}

header nav ul li {
	float:left;
}

header nav ul li a {
	color:#fff;
	padding:20px;
	display:block;
	text-decoration:none;
}

header nav ul li span {
	margin-right:10px;
}

header nav ul li a:hover {
	background:#037E8C;
}

section {
	padding:20px;
}

@media screen and (max-width:800px ) {
	header nav {
		width:80%;
		height:100%;
		left:-100%;
		margin:0;
		position: fixed;
	}

	header nav ul li {
		display:block;
		float:none;
		border-bottom:1px solid rgba(255,255,255, .3);
	}

	.menu_bar {
		display:block;
		width:100%;
		background:#ccc;
	}

	.menu_bar .bt-menu {
		display:block;
		padding:20px;
		background:#024959;
		color:#fff;
		text-decoration:none;
		font-weight: bold;
		font-size:25px;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
	}

	.menu_bar span {
		float:right;
		font-size:40px;
	}
}
</style>
<script>
    $(document).ready(main);

var contador = 1;

function main(){
	$('.menu_bar').click(function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
		}

	});

};
</script>
</head>
<body>
<header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list2"></span>Menu</a>
		</div>

		<nav>
			<ul>
				<li><a href="https://www.softecuestre.com.ar/"><span class="icon-home"></span>Inicio</a></li>
				<li><a href="https://www.softecuestre.com.ar/src/concant.php"><span class="icon-calendar"></span>Concursos Anteriores</a></li>
				<li><a href="https://www.softecuestre.com.ar/src/sistema/loging.php"><span class="icon-rocket"></span>Gestión</a></li>
				<li><a href="https://www.softecuestre.com.ar/src/sistema/estadistica.php"><span class="icon-earth"></span>Estadísticas</a></li>
				<li><a href="https://www.softecuestre.com.ar/src/contacto.php"><span class="icon-mail"></span>Contacto</a></li>
				<?php
				if (!isset($_SESSION['user_id'])) { 
			        echo "<li><a href='https://www.softecuestre.com.ar/src/sistema/loging.php'><span class='icon-user'></span>LogIn</a></li>";				    
			     }else{
			        echo "<li><a href='https://www.softecuestre.com.ar/src/sistema/logout.php'><span class='icon-lock'></span>LogOut "." - " .$_SESSION['usuario']."</a></li>";
			    }
			    ?>
			</ul>
		</nav>
	</header>
	 <script src="https://softecuestre.com.ar/js/jquery-latest.js"></script>
</body>
</html>
	
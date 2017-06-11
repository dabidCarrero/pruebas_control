<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es-ES">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<title >Asterisk</title>
		<link href="inicio3.css" rel="stylesheet" type="text/css" media="all">
		<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
	</head>
	<body class="cuerpo">
		<dir class="header">
			<div align="right">
				<a href="asterisk.php"><img src="close.png" title="Cerrar sessión"></a>
			</div>
			<h1 align="center">ACCESO DE ADMINISTRADORES</h1>
		</dir>
		<div class="contenedor">
			<div class="centro">
				<form  action="validar.php" method="POST">
					<br>
					<br>
					<br>
					<div>
						<input class="campos" type="test"  name="nombre" placeholder="Nombre" >
					</div>
					<div>
						<input class="campos" type="email"  name="email" placeholder="Email" >
					</div>
					<div>				 
						<input class="campos" type="password"  name="password" placeholder="Contraseña" >
					</div>
					<br>
					<button class="botones" type="submit"  name="enviar">ENVIAR </button>
					<button class="botones" type="reset"  name="limpiar">LIMPIAR</button>
					<br>
					<div>
						<button type="button" class="botones" name="reset-passw" onclick="location.href='reset.php';">RECUPERAR CONTRASEÑA </button>
						<button type="button" class="botones" name="crear-cuenta" onclick="location.href='registro.php';">CREAR CUENTA DE ADMINISTRADOR</button>
					</div>
					<div>
						
					</div>
				</form>
				
			</div>
		</div>
	</body>
</html>
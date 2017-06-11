<?php
	include("funciones.php");
	
	session_start();

	if(!isset($_SESSION['idUsuario'])){
		echo '<script type="text/javascript">
				alert("Debes iniciar sesión o ser administrador para acceder");
				window.location="login.php"; 
			</script>';
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=yes">
		<title>Asterisk</title>
		<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
		<link href="inicio3.css" rel="stylesheet"  type="text/css" media="all">
	</head>
	<body class="cuerpo">
		<div class="header">
			<div align="right">
				<a href="logout.php"><img src="close.png" title="Logout" onclick="return confirm('Cerrar la sesión?')"></a>		
			</div>
			<h1 align="center">PANEL DE ADMINISTRADOR</h1>
		</div>

		<div class="contenedor">
			<div class="imagen" align="right">
				<a href="#"><img src="home.png" title="Inicio"></a>
			</div>
			<div class="centro">
				<table >
					<tr>
						<td>
							<a href="add_connection.php"><img src="imagenes/add_connection.png" title="Añadir ubicación" width="125" height="125"></a>
						</td>
						<td>
							<a href="conexiones.php"><img src="imagenes/connect.png" title="Ver conexiones" width="150" height="150"></a>
						</td>
						<td>
							<a href="estadisticas.php"><img src="imagenes/stats.png" title="Ver estadisticas" width="125" height="125"></a>
						</td>
					</tr>
					<tr>
						<td>
							
						</td>
						<td>
							
						</td>
						<td>
							
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
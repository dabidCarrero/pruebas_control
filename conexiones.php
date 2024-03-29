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
<?php

    header('Content-Type: text/html; charset=ISO-8859-1');

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<title >Asterisk</title>
		<link href="inicio3.css" rel="stylesheet" type="text/css" media="all">
		<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
	</head>
	<body class="cuerpo">
		<div class="header">
			<div align="right">
				<a href="logout.php"><img src="close.png" title="Logout" onclick="return confirm('Cerrar la sesión?')"></a>		
			</div>
			<h1 align="center">DISPOSITIVOS CONECTADOS</h1>
		</div>

		<div class="contenedor">
			<div class="imagen" align="right">
				<a href="backend.php"><img src="home.png" title="Inicio"></a>
			</div>
			<div>
				<br/>
				<br/>
			</div>
			<div class="centro">
				<table border="2">
					<thead>
						<tr>
							<th>ID_cliente</th>
							<th>Nombre cliente</th>
							<th>Ciudad cliente</th>
							<th>IP privada</th>
							<th>IP remota</th>
							<th>PING</th>
							<th>Editar</th>
							<th>Borrar</th>
							<th>Estado</th>
						</tr>
					</thead>
				<?php
					
					$conexion = conectar();
					$sql = "SELECT id_ubicacion, nombre_ubicacion, ciudad_ubicacion, ip_ubicacion, din_ip_ubicacion, registrada FROM ubicaciones;";
					$resultado = mysqli_query($conexion, $sql) or die("Error_consulta: " . mysqli_error($conexion));
					while ($row = mysqli_fetch_array($resultado)) {
					echo "
					<tr >
						<td align=\"center\">" . $row['id_ubicacion'] . "</td>
						<td align=\"center\">" . $row['nombre_ubicacion'] . "</td>
						<td align=\"center\">" . $row['ciudad_ubicacion'] . "</td>
						<td align=\"center\">" . $row['ip_ubicacion'] . "</td>
						<td align=\"center\">" . $row['din_ip_ubicacion'] . "</td>
						<td><a href=\"ping.php?id=" . $row['id_ubicacion'] . "\"> <img src=\"imagenes/ping_logo3.png\" width=\"75\" height=\"75\"></td></a>
						<td><a href=\"editar.php?id=" . $row['id_ubicacion'] . "\"> <img src=\"imagenes/edit.png\" width=\"75\" height=\"75\"></td></a>
						<td><a href=\"borrar.php?id=" . $row['id_ubicacion'] . "\" onclick=\"return confirm('¿Eliminar dispositivo?');\"> <img src=\"imagenes/delete.png\" width=\"75\" height=\"75\"></td></a>
						<td >"; if($row['registrada'] == 1 ){ 
							echo "
							<a href=\"add_connection.php\"><img src=\"imagenes/conectada.png\" width=\"75\" height=\"75\"></a>
							";
							} else{
								echo "
							
							<a href=\"add_connection.php\"><img src=\"imagenes/desconectada.png\" width=\"75\" height=\"75\"></a>
							";
							}"
						</td>
						
						
					</tr>";
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>
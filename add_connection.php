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
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
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
			<h1 align="center">AGREGAR EQUIPO</h1>
		</dir>
		<div class="contenedor">
			<div class="centro">
				<form  action="validar_ubicacion.php" method="POST">
					<br>
					<br>
					<br>
					<div>
						<input class="campos" type="text"  name="ubicacion" placeholder="Cliente" >
					</div>
					<div>
						<select name="ciudad" class="campos" required>
							<option value="0">Selecciona ciudad</option>
					 
					 			<?php
									$conexion = conectar();
									$sql = "SELECT * FROM asterisk.ciudades ORDER BY nombre";
									$resultado = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));  
									if(mysqli_num_rows($resultado) > 0){
										while($lista = mysqli_fetch_array($resultado)){
 										echo "<option value =\"" . $lista['idCiudad'] . "\">" . $lista['nombre'] . "</option>";
	    									}
									}else {
											echo "no hay resultados";
									}
                   				?>
                   			</select>
						</div>
					<div>
						<input class="campos" type="text"  name="direccion_ip" placeholder="IP address" >
					</div>
					<div>				 
						<input class="campos" type="text"  name="ip_dinamica" placeholder="Dynamic ip address " >
					</div>
					<br>
					<button class="botones" type="submit"  name="enviar">ENVIAR </button>
					<button class="botones" type="reset"  name="limpiar">LIMPIAR</button>
					<br>
					
				</form>
				
			</div>
		</div>
	</body>
</html>
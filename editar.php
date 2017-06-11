<?php
	include("funciones.php");
	
	session_start();

	if(!isset($_SESSION['idUsuario'])){
		echo '<script type="text/javascript">
				alert("Debes iniciar sesión o ser administrador para acceder");
				window.location="/asir/login.php"; 
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
		<title>Asterisk</title>
		<link href="inicio3.css" rel="stylesheet" type="text/css" media="all">
	</head>
	<body class="cuerpo">

			<div class="header">
				<div align="right">
					<a href="login.php"><img src="close.png" title="Logout"></a>	
				</div>
				<h1 align="center">EDITAR CONFIGURACION</h1>
			</div>

			<div class="contenedor">
				<div class="imagen" align="right">
					<a href="backend.php"><img src="home.png" title="Inicio"></a>
				</div>
				<div class="centro">

					<?php

						$conexion = conectar();
						
						$sql = "SELECT * FROM asterisk.ubicaciones WHERE id_ubicacion = " . $_GET['id'];
						$result = mysqli_query($conexion, $sql) or die("ERROR_select: " . mysqli_error($conexion));
						$fila = mysqli_fetch_array($result);
						
						//echo $fila['pais'];
						/*
						$pais = "SELECT codigo FROM paises WHERE idPais = " . $fila['pais'];
						$country = mysqli_query($conexion, $pais) or die("error_pais_usuario: " . mysqli_error($conexion));
						$pais_usuario = mysqli_fetch_assoc($country);
						
						// echo $pais_usuario['nombre']; onsubmit="return confirm('¿Guardar los cambios?');"
						*/
					?>

					<form action="editar_configuracion.php" method="POST" >
						
						<input type="hidden" name="id_ubicacion" value="<?php echo $fila['id_ubicacion'];?>">
						
						<div>
							<input type="text" class="campos" name="nombre" value="<?php echo $fila['nombre_ubicacion'];?>" readonly="readonly">
							<input type="text" class="campos" name="nombre1" placeholder="Nuevo Nombre" >
						</div>
						
						<div>
							<input type="text" class="campos" name="ciudad" value='<?php echo $fila['ciudad_ubicacion'] ?>' readonly="readonly" >

							<select name="ciudad1" class="campos" required>
								<option value="0">Selecciona ciudad</option>
					 
					 				<?php  
					 		 
								
										$conexion = conectar();
										$sql = "SELECT * FROM asterisk.ciudades ORDER BY nombre";
										$resultado = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));  
										if(mysqli_num_rows($resultado) > 0){
											while($lista = mysqli_fetch_array($resultado)){
 											echo "<option value =\"" . $lista['idCiudad'] . "\">" . $lista['nombre'] . "</option>";
	    									}
										}  else {
											echo "no hay resultados";
										}             
                        		
                   					?>
                   			</select>					
						</div>
						<div>
							<input type="text" class="campos" name="ip" value="<?php echo $fila['ip_ubicacion'];?>" readonly="readonly">
							<input type="text" class="campos" name="ip1" placeholder="Nueva IP" >
						</div>
						<div>
							<input type="text" class="campos" name="ip_dinamica" value="<?php echo $fila['din_ip_ubicacion'];?>" readonly="readonly">
							<input type="text" class="campos" name="ip_dinamica1" placeholder="Nueva IP remota" >
						</div>
						<br>
						<div>
							<button type="submit" class="botones" name="enviar" >Actualizar datos </button>
							<button type="reset" class="botones" name="cancelar" onclick="location.href='conexiones.php';" >Volver a la lista</button>
						</div>

					</form>
				</div>
			</div>
		
	</body>
</html>
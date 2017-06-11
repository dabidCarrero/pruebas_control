<?php
	include("funciones.php");
	
?>


<?php

    header('Content-Type: text/html; charset=ISO-8859-1');

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head>
		
		
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<title >ASTERISK</title>
		<link href="inicio3.css" rel="stylesheet" type="text/css" media="all">
		<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
	</head>
	<body class="cuerpo">
		<div class="header">
			<div align="right">
				<a href="logout.php"><img src="close.png" title="Logout" onclick="return confirm('Cerrar la sesión?')"></a>		
			</div>
			<h1 align="center">REGISTRO DE ADMINISTRADORES</h1>
		</div>

			<div class="contenedor">
				<div class="imagen" align="right">
					<a href="login.php"><img src="home.png" title="Inicio"></a>
				</div>
				<div class="centro">
					<form  action="registro1.php" method="POST">
						<div>
							<input type="text" class="campos" name="nombre" placeholder="Nombre" required>
							<input type="text" class="campos" name="apellido" placeholder="Apellido" class="form-input">
						</div>
						
						<div>
							<input type="email" class="campos" name="email" placeholder="Email" class="form-input" required>
							
					
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
										}  else {
											echo "no hay resultados";
										}             
                        		
                   					?>
                   			</select>
						</div>
						<div>
							<input type="password" class="campos" name="password" placeholder="Password"  maxlength="10" minlength="5" required>
							<input type="password" class="campos" name="password2" placeholder="Repetir password" required>
						</div>
						<br>
						<button type="submit" class="botones" name="enviar" >ENVIAR</button>
						<button type="reset" class="botones" name="limpiar" >LIMPIAR</buton>
					</form>
				</div>
			</div>
		
	</body>
</html>
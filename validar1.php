<?php
	include("funciones.php");
	session_start();
?>

<?php
	$conexion = conectar();

	if((isset($_POST['nombre']) and !empty($_POST['nombre'])) and (isset($_POST['email']) and !empty($_POST['email']))
		and (isset($_POST['password']) and !empty($_POST['password']))){

		$nombre = addslashes($_POST['nombre']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);

		$sql = "SELECT * FROM servicio_incidencias.usuarios WHERE email = '". $email . "'";
		$resultado = mysqli_query($conexion, $sql);

		if(mysqli_num_rows($resultado) != 1){

			echo "<script type=\"text/javascript\">
				alert('No existe el usuario');
				window.location='login.php'; </script>";
		} else {
			$row = mysqli_fetch_array($resultado);
		}

		## variables de sesion

		if(password_verify($password, $row['clave'])){

			$_SESSION['idUsuario'] = $row['idUsuario'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['numeroEntradas'] = $row['numeroEntradas'];
			$_SESSION['tipoUsuario'] = $row['tipoUsuario'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['pais'] = $row['pais'];
			$_SESSION['numeroErrores'] = $row['numeroErrores'];
			$_SESSION['bloqueado'] = $row['bloqueado'];
			$usuario = $_SESSION['nombre'];

			switch ($_SESSION['tipoUsuario']) {
				case 'Administrador':
					# code...
					$_SESSION['numeroEntradas']++;
					$contador = $_SESSION['numeroEntradas'];
					# echo "<br> numero de veces que se te has conectado: " . $contador . "<br>";
					
				
					$hoy = date("U");
					
					# echo $hoy ."<br>";
					
					$hoy = date('Y-m-d H:i:s', $hoy);
					# echo $hoy . "<br>";
					# echo $email . "<br>";
					# echo "<br>";
					$sql = "UPDATE  servicio_incidencias.usuarios SET numeroEntradas = '" .$contador. "' where email = '" .$email. "'";
					# echo $sql;
					# echo "<br>";
					mysqli_query($conexion, $sql) or die("error_actualizar1: " . mysqli_error($conexion));
					
					# echo "<br>";
					$sql = "UPDATE  servicio_incidencias.usuarios SET  ultimaVisita = '" . $hoy . "' where email = '" .$email. "'";
					# echo $sql;
					# echo "<br>";
					mysqli_query($conexion, $sql) or die("error_actualizar: " . mysqli_error($conexion));
					
					echo "<script type=\"text/javascript\">
								alert('Bienvenido');
								window.location='backend.php'; 
							</script>";

					break;
				
				case 'normal':

				$_SESSION['numeroEntradas']++;
					$contador = $_SESSION['numeroEntradas'];
					# echo "<br> numero de veces que se te has conectado: " . $contador . "<br>";
					
				
					$hoy = date("U");
					
					# echo $hoy ."<br>";
					
					$hoy = date('Y-m-d H:i:s', $hoy);
					# echo $hoy . "<br>";
					# echo $email . "<br>";
					# echo "<br>";
					$sql = "UPDATE  servicio_incidencias.usuarios SET numeroEntradas = '" .$contador. "' where email = '" .$email. "'";
					# echo $sql;
					# echo "<br>";
					mysqli_query($conexion, $sql) or die("error_actualizar1: " . mysqli_error($conexion));
					
					# echo "<br>";
					$sql = "UPDATE  servicio_incidencias.usuarios SET  ultimaVisita = '" . $hoy . "' where email = '" .$email. "'";
					# echo $sql;
					# echo "<br>";
					mysqli_query($conexion, $sql) or die("error_actualizar: " . mysqli_error($conexion));
					
					echo "<script type=\"text/javascript\">
								alert('Bienvenido');
								window.location='principal.php'; 
							</script>";

				default:
					# code...
					break;
			}

		} else {

			$_SESSION['numeroErrores']++;
			$contador = $_SESSION['numeroErrores'];
			# echo "<br> numero de veces que se te has conectado: " . $contador . "<br>";
					
				
			$sql = "UPDATE  servicio_incidencias.usuarios SET numeroErrores = '" .$contador. "' where email = '" .$email. "'";
			# echo $sql;
			# echo "<br>";
			mysqli_query($conexion, $sql) or die("error_actualizar1: " . mysqli_error($conexion));

			echo "<script type=\"text/javascript\">
				alert('Contraseña incorrecta');
				window.location='login.php'; </script>";
		}


		
		if ($_SESSION['numeroErrores'] == 3) {
			# code...
			$errores = "SELECT bloqueado FROM servicio_incidencias.usuarios WHERE email = '" .$email. "'";
			$qresultado = mysqli_query($conexion, $errores) or die("error_bloqueo: " . mysqli_error($conexion));
			$resultado = mysqli_fetch_array($qresultado);
			$usuario_bloqueado = (bool)$resultado;

			$bloqueo = "UPDATE servicio_incidencias.usuarios SET bloqueado = True where email = '" . $email . "'";
						
			mysqli_query($conexion, $bloqueo) or die("error_borrado: " . mysqli_error($conexion));
			echo "<script type=\"text/javascript\">
					alert('Usuario bloqueado, contacte con el Administrador');
					window.location='solicitud-desbloqueo.php'; </script>";
			die();
		}
	} else {
		echo "<script type=\"text/javascript\">
				alert('Rellene todos los campos');
				window.location='login.php'; </script>";
	}
	mysqli_close($conexion);
?>
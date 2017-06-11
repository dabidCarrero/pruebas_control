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

		$sql = "SELECT * FROM asterisk.usuarios WHERE email = '". $email . "'";
		$resultado = mysqli_query($conexion, $sql);
		
		// comprobación de usuario
		if(mysqli_num_rows($resultado) != 1){

			echo "<script type=\"text/javascript\">
				alert('No existe el usuario');
				window.location='login.php'; </script>";
		} else {
			$row = mysqli_fetch_array($resultado);
		}

		// fin comprobación de usuario

		// crear variables de sesion

		if(password_verify($password, $row['clave'])){

			$_SESSION['idUsuario'] = $row['idUsuario'];
			$_SESSION['nombre'] = $row['nombre_administrador'];
			
			$_SESSION['email'] = $row['email'];
			
			
			$usuario = $_SESSION['nombre'];

			echo "<script type=\"text/javascript\">
					alert('Bienvenido');
					window.location='backend.php'; 
					</script>";

		} else {

			echo "<script type=\"text/javascript\">
				alert('Contraseña incorrecta');
				window.location='login.php'; </script>";
		}

	} else {
		echo "<script type=\"text/javascript\">
				alert('Rellene todos los campos');
				window.location='login.php'; </script>";
	}
	mysqli_close($conexion);
?>
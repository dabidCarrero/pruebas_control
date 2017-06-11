<?php
	include("funciones.php");
?>

<?php

	$conexion = conectar();

	// crear tablas

	// crear ciudades

	$sql = "CREATE TABLE IF NOT EXISTS ciudades(
		idCiudad int(4)  AUTO_INCREMENT,
		codigo char(3) not null unique,
		nombre char(60) not null unique,
		codigo_pais char(4),
		primary key (idCiudad)) ENGINE=InnoDB;";

	mysqli_query($conexion, $sql) or die("Error_ciudades: " . mysqli_error($conexion));	
	//tabla ubicaciones

	$sql = "CREATE TABLE IF NOT EXISTS ubicaciones(
		id_ubicacion int(3) not null AUTO_INCREMENT,
		nombre_ubicacion varchar(80) not null,
		ciudad_ubicacion varchar(60) not null,
		ip_ubicacion varchar(16) not null,
		din_ip_ubicacion varchar(16),
		registrada boolean default 0 not null,
		PRIMARY KEY(id_ubicacion)) ENGINE=InnoDB;";

	mysqli_query($conexion, $sql) or die("Error_ubicaciones: " . mysqli_error($conexion));
	
	// tabla administradores

	$sql = "CREATE TABLE IF NOT EXISTS usuarios( 
		idUsuario int(3) not null AUTO_INCREMENT, 
		nombre_administrador varchar(80) not null,
		
		email varchar(80) not null,
			
		clave varchar(100) not null,
		ciudad_usuario varchar(60),
		primary key(idUsuario)) ENGINE=InnoDB;";

	mysqli_query($conexion, $sql) or die("Error_usuarios: " . mysqli_error($conexion));

	// tabla conexiones

	$sql = "CREATE TABLE IF NOT EXISTS conexiones(
		id_usuario int(3) not null,
		fecha_conexion datetime not null,
		PRIMARY KEY(id_usuario, fecha_conexion)) ENGINE=InnoDB;";

	mysqli_query($conexion, $sql) or die("Error_fechas_conexiones: " . mysqli_error($conexion));
	
	
	
	// insertar paises
	$sql = "INSERT INTO ciudades(codigo, nombre, codigo_pais) SELECT ID, Name, CountryCode FROM world_x.city where CountryCode = 'ESP';";	
	mysqli_query($conexion, $sql);
	
	// usuario administrador predeterminado
	$clave = "1234";
	$pass_admin = password_hash($clave, PASSWORD_DEFAULT);
	$sql_admin = "SELECT * FROM usuarios WHERE nombre_administrador = 'admin'";
	$resultado = mysqli_query($conexion, $sql_admin) or die ("error_admin: " . mysqli_error($conexion));
	// echo mysql_num_rows($resultado) . "hola";
	if(!mysqli_num_rows($resultado)){
		// echo "no hay usuarios admin";
		$usuario_administrador = "INSERT INTO usuarios(nombre_administrador, email, clave, ciudad_usuario) VALUES('admin', 'admin@localhost.com',
		'$pass_admin', 'errenteria');";
		mysqli_query($conexion, $usuario_administrador) or die("ErroR_admin: " . mysqli_error($conexion));
	} 
	


	// insertar datos
	if(isset($_POST['nombre']) and isset($_POST['email']) and isset($_POST['ciudad']) and isset($_POST['password'])){
		$nombre = $_POST['nombre'];
		$apellido = "";
		
		
		$email = $_POST['email'];
		$ciudad = $_POST['ciudad'];
		
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		
		// encriptar contraseña
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		//$password2_hash = password_hash($password2, PASSWORD_DEFAULT);

		
		
		// nombre de ciudades
		
		$ciudad_nombre = "SELECT * FROM ciudades WHERE idCiudad = '" . $ciudad . "'";
		$fila = mysqli_query($conexion, $ciudad_nombre) or die("error_nombre_ciudad: " . mysqli_error($conexion));
		$nombre_ciudad = mysqli_fetch_array($fila);
		$codigo = $nombre_ciudad['nombre'];


		// $insertar_pais = "UPDATE table usuarios SET nombre_pais = '$nombre_pais' WHERE email = '$email';";
		// $pais_usuarios = mysqli_query($conexion, $insertar_pais) or die("error_codigo_pais: " . mysql_error($conexion));
		
		
		if(($password == $password2)){
			$sql = "SELECT email FROM usuarios WHERE email = '" . $email . "'";
			$resultado = mysqli_query($conexion, $sql) or die("error: " . mysqli_error($conexion));

			// preguntar sintaxis IF
			if($fila = mysqli_fetch_array($resultado)){
				echo "<script type=\"text/javascript\">alert('El usuario ya existe en la base de datos'); window.location='login.php'; </script>";
				// echo "el email: " . $email . " ya existe en la base de datos. <br>";
				// echo "pulsar <a href=\"registro.php\">aqui</a>para volver al formulario";
			} else {
				$sql = "INSERT INTO usuarios (nombre_administrador, email, ciudad_usuario, clave) VALUES('$nombre', '$email', '$codigo', '$password_hash');";
				mysqli_query($conexion, $sql) or die("ErroR_usuarios_insercion: " . mysqli_error($conexion));
				
				// echo "usuario agregado correctamente";
				
				

				// $insertar = insertar();
				echo "<script type=\"text/javascript\">alert('Usuario creado correctamente'); window.location='login.php'; </script>";
				// echo "pulsar <a href=\"registro.php\"> aqui </a> para volver al formulario";
			}
		} else {
			// echo "las contraseñas no coinciden";
			echo "<script type=\"text/javascript\">alert('Las contraseñas no coinciden, vuelve a intentarlo'); window.location='login.php'; </script>";
		}
	} else {
		echo "<script type=\"text/javascript\">alert('Debe rellenar todos los campos'); window.location='login.php'; </script>";
		// echo "debe rellenar todos los campos";
	}

	
	mysqli_close($conexion);
?>
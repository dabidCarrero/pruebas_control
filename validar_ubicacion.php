<?php
	include("funciones.php");
	session_start();
?>


<?php
	$conexion = conectar();	

	if((isset($_POST['ubicacion']) and !empty($_POST['ubicacion'])) and (isset($_POST['ciudad']) and !empty($_POST['ciudad'])) 
		and (isset($_POST['direccion_ip']) and !empty($_POST['direccion_ip']))){

		$ubicacion = addslashes($_POST['ubicacion']);
		$direccion_ip = addslashes($_POST['direccion_ip']);
		$ciudad = addslashes($_POST['ciudad']);
		$ip_dinamica = "";

		if(isset($_POST['ip_dinamica']) and !empty($_POST['ip_dinamica']))
			$ip_dinamica = addslashes($_POST['ip_dinamica']);

		$sql = "SELECT * FROM asterisk.ubicaciones WHERE din_ip_direccion = '". $ip_dinamica . "'";
		$resultado = mysqli_query($conexion, $sql);
		
		// comprobación de usuario
		//if(mysqli_num_rows($resultado) == 1){

		//	echo "<script type=\"text/javascript\">
		//		alert('Ya existe esa ubicación');
		//		window.location='backend.php'; </script>";
		//} else {
		//	$row = mysqli_fetch_array($resultado);
		//}

		// fin comprobación de usuario
		// nombre de ciudades
		$ciudad_nombre = "SELECT * FROM asterisk.ciudades WHERE ciudades.idCiudad = '" . $ciudad . "'";
		$fila = mysqli_query($conexion, $ciudad_nombre) or die("error_nombre_ciudad: " . mysqli_error($conexion));
		$nombre_ciudad = mysqli_fetch_array($fila);
		$ciudad_cliente = $nombre_ciudad['nombre'];

		// echo $ciudad_cliente;

		// insertar datos

		if(filter_var($direccion_ip, FILTER_VALIDATE_IP)){

			$sql = "INSERT INTO asterisk.ubicaciones(nombre_ubicacion, ciudad_ubicacion, ip_ubicacion, registrada) 
					VALUES('$ubicacion', '$ciudad_cliente', '$direccion_ip', 0)";
			mysqli_query($conexion, $sql) or die("error_añadir_ubicación: " . mysqli_error($conexion));

			echo "<script type=\"text/javascript\">
					alert('Ubicacción agregada correctamente');
					window.location='backend.php'; 
					</script>";

		} else {

			echo "<script type=\"text/javascript\">
				alert('Dirección IP incorrecta');
				window.location='backend.php'; </script>";
		}

	} else {
		echo "<script type=\"text/javascript\">
				alert('Rellene todos los campos');
				window.location='backend.php'; </script>";
	}
	mysqli_close($conexion);
?>

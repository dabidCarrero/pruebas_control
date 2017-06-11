<?php
	include("funciones.php");
?>

<?php
	
	$conexion = conectar();

	

	if(isset($_POST['id_ubicacion'])){
		$id_ubicacion = $_POST['id_ubicacion'];
	}

	if(isset($_POST['nombre1']))
		$nombre1 = $_POST['nombre1'];

	
	if(isset($_POST['ciudad1']))
		$ciudad1 = $_POST['ciudad1'];

	if(isset($_POST['ip1']))
		$ip1 = $_POST['ip1'];

	if(isset($_POST['ip_dinamica1']))
		$ip_dinamica1 = $_POST['ip_dinamica1'];



	
	$sql = "SELECT id_ubicacion, nombre_ubicacion, ciudad_ubicacion, ip_ubicacion, din_ip_ubicacion, registrada FROM asterisk.ubicaciones 
			WHERE id_ubicacion = '" . $id_ubicacion . "'";
	$resultado = mysqli_query($conexion, $sql) or die("error_datos_usuarios: " . mysql_error($conexion));
	$datos = mysqli_fetch_array($resultado);


	$ciudad_nombre = "SELECT * FROM ciudades WHERE idCiudad = '" . $ciudad1 . "'";
	$fila = mysqli_query($conexion, $ciudad_nombre) or die("error_nombre_ciudad: " . mysqli_error($conexion));
	$nombre_ciudad = mysqli_fetch_array($fila);
	$codigo = $nombre_ciudad['nombre'];

	if(($datos['nombre_ubicacion'] != $nombre1) and (trim($nombre1) != "")){

			$update1 = "UPDATE asterisk.ubicaciones SET nombre_ubicacion = '" . $nombre1 . "' WHERE id_ubicacion = '" . $id_ubicacion . "'";
			mysqli_query($conexion, $update1) or die("error_actualizar_nombre: " . mysql_error($conexion));

	} 


	if(($datos['ciudad_ubicacion'] != $ciudad1) and (trim($ciudad1) != "") and (trim($codigo) !="")){

		$update1 = "UPDATE asterisk.ubicaciones SET ciudad_ubicacion = '" . $codigo . "' WHERE id_ubicacion = '" . $id_ubicacion . "'";
		mysqli_query($conexion, $update1) or die("error_actualizar_ciudad: " . mysql_error($conexion));

	}

	if(($datos['ip_ubicacion'] != $ip1) and (trim($ip1) != "")){

			$update1 = "UPDATE asterisk.ubicaciones SET ip_ubicacion = '" . $ip1 . "' WHERE id_ubicacion = '" . $id_ubicacion . "'";
			mysqli_query($conexion, $update1) or die("error_actualizar_ip: " . mysql_error($conexion));

	} 

	if(($datos['din_ip_ubicacion'] != $ip_dinamica1) and (trim($ip_dinamica1) != "")){

			$update1 = "UPDATE asterisk.ubicaciones SET din_ip_ubicacion = '" . $ip_dinamica1 . "' WHERE id_ubicacion = '" . $id_ubicacion . "'";
			mysqli_query($conexion, $update1) or die("error_actualizar_nombre: " . mysql_error($conexion));

	} 


	echo "<script type=\"text/javascript\">
					alert('Datos actualizados correctamente'); 
					window.location='backend.php'; 
				</script>";
?>
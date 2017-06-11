<?php
	function conectar(){
		//Parámetros de conexión a la BD
			$dbhost = "localhost"; //Los nombres de las variables son case-sensitive, no así las palabras reservadas
			$dbusuario = "root";
			$dbpassword = "1234";
			$port = "3306";
			// $db = "world";  //Nombre de la BD
			
			//crear la conexion al servidor
			$conexion = mysqli_connect($dbhost, $dbusuario, $dbpassword);
			if(!$conexion) die ('Error al conectar a MySQL: ' . mysqli_error($conexion));
			
			//crear la base de datos
			$sql = "CREATE DATABASE IF NOT EXISTS asterisk 
					DEFAULT CHARACTER SET utf8
  					DEFAULT COLLATE utf8_general_ci;";
			
			//crear la conexion a la base de datos
			mysqli_query($conexion, $sql) or die("error: " . mysqli_error($conexion));
			
			//ejecutar la base de datos
			$sql = "USE asterisk;";
			mysqli_query($conexion, $sql) or die("error: " . mysqli_error($conexion));
			return $conexion;
	}

	//function nombreAleatorio($length = 10) { 
    //	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	//} 
	function ping(){
		$conexion = conectar();
		$sql = "SELECT * FROM asterisk.ubicaciones";
	    $result = mysqli_query($conexion, $sql) or die("error_ip_ubicacion" . mysqli_error($conexion));
	    $informacion = mysqli_fetch_array($result);

	    $ip = $informacion['ip_ubicacion'];
	    $output = shell_exec("ping -c2 $ip");
	     
	    if (strpos($output, "2 received")) {
	        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 1 where ip_ubicacion = '" .$ip . "'";
			mysqli_query($conexion, $actualizar) or die ("error_cambiar_clave: " . mysqli_error($conexion));
			$resultado = 1;
	    } else {
	        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 0 where ip_ubicacion = '" .$ip . "'";
			mysqli_query($conexion, $actualizar) or die ("error_cambiar_clave: " . mysqli_error($conexion));
			$resultado = 0;
	    }
	    return $resultado;
	}
?>

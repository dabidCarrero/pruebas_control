<?php
    include("funciones.php");
	$conexion1 = conectar();
	// obtener ip de cada equipo registrado

    $sql = "SELECT * FROM asterisk.ubicaciones";
    $result = mysqli_query($conexion1, $sql) or die("error_ip_ubicacion" . mysqli_error($conexion1));
    $informacion = mysqli_fetch_array($result);

    $ip = $informacion['ip_ubicacion'];
    $output = shell_exec("ping -c4 $ip");
     
    if (strpos($output, "recibidos = 0")) {
        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 1 where ip_ubicacion = '" .$ip . "'";
		mysqli_query($conexion1, $sql) or die ("error_cambiar_clave: " . mysqli_error($conexion1));
    } else {
        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 0 where ip_ubicacion = '" .$ip . "'";
		mysqli_query($conexion1, $sql) or die ("error_cambiar_clave: " . mysqli_error($conexion1));
    }
?>
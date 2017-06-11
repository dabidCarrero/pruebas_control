<?php
    include("funciones.php");
	$conexion = conectar();
	// obtener ip de cada equipo registrado

    $sql = "SELECT * FROM asterisk.ubicaciones WHERE id_ubicacion = " . $_GET['id'];
    $result = mysqli_query($conexion, $sql) or die("error_ip_ubicacion" . mysqli_error($conexion));
    $informacion = mysqli_fetch_array($result);

    $ipv4 = $informacion['ip_ubicacion'];
    $ipv4_d = $informacion['din_ip_ubicacion'];

    $output_v4 = shell_exec("ping -c2 $ipv4");
    $output_d = shell_exec("ping -c2 $ipv4_d");

     
    if (strpos($output_v4, "2 received") || strpos($output_d, "2 received")) {
        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 1 where id_ubicacion = '" . $_GET['id'] . "'";
		mysqli_query($conexion, $actualizar) or die ("error_cambiar_clave: " . mysqli_error($conexion));

        echo "<script type=\"text/javascript\">
                alert('Dispositivo en línea');
                window.location='conexiones.php'; </script>"; 

    } else {
        $actualizar =  "UPDATE  asterisk.ubicaciones SET registrada = 0 where id_ubicacion = '" . $_GET['id'] . "'";
		mysqli_query($conexion, $actualizar) or die ("error_cambiar_clave: " . mysqli_error($conexion));

        echo "<script type=\"text/javascript\">
                alert('Dispositivo fuera de línea');
                window.location='conexiones.php'; </script>"; 
    }
?>
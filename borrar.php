<?php
	include("funciones.php");
	
?>



<?php
	$conexion = conectar();

	
	$sql = "SELECT * FROM asterisk.ubicaciones WHERE id_ubicacion = " . $_GET['id'];

	$consulta = mysqli_query($conexion, $sql) or die ("error_conexiones" . mysqli_error($conexion));
	$fila = mysqli_fetch_array($consulta);

	
	$borrar = "DELETE FROM asterisk.ubicaciones WHERE id_ubicacion = " . $_GET['id']; 
	mysqli_query($conexion, $borrar) or die ("error_borrado: " . mysqli_error($conexion));
	echo "<script type=\"text/javascript\">
			alert('Dispositivo borrado correctamente');
			window.location='conexiones.php'; </script>"; 
		
	mysqli_close($conexion);
	
?>
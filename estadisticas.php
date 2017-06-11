
<?php
	include("funciones.php");
	
	session_start();

	if(!isset($_SESSION['idUsuario'])){
		echo '<script type="text/javascript">
				alert("Debes iniciar sesión o ser administrador para acceder");
				window.location="login.php"; 
			</script>';
	}
?>

<?php

    header('Content-Type: text/html; charset=ISO-8859-1');

?>

<!DOCTYPE html>
<html lang="es-es">
	<head>

		
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<title>Asterisk</title>
		<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
		<link href="inicio3.css" rel="stylesheet" type="text/css" media="all">
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1CioxqqpG5wiNoHgvPuhUxbQ-nSWD_90&callback=initMap" 
			type="text/javascript">
		</script>
		<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
   		<script type='text/javascript'>
     		google.charts.load('current', {'packages': ['geochart']});
     		google.charts.setOnLoadCallback(drawMarkersMap);

      		
			function drawMarkersMap() {

		        var data = google.visualization.arrayToDataTable([
		          ['City', 'Total'],
		          	<?php
						$conexion = conectar();

						$sql = "SELECT COUNT(*) AS total, ciudades.nombre AS nombre
								FROM asterisk.ubicaciones, asterisk.ciudades 
								WHERE ubicaciones.ciudad_ubicacion = ciudades.nombre
								GROUP BY nombre;";
						$result = mysqli_query($conexion, $sql) or die("error_incidencias_software : " . mysqli_error($conexion));
								

						while($ciudades = mysqli_fetch_array($result)){

						 	echo "['".$ciudades['nombre']."',".$ciudades['total']."],\n";
						  //echo "['".  $paises['nombre']."',".  $paises['total']."],";
						 }
					?>
		        ]);

	        	var options = {
        			region: 'ES',
        			displayMode: 'markers',
        			colorAxis: {colors: ['green', 'blue']}
      			};

      			var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      			chart.draw(data, options);
    		};
    	</script>

	</head>
	
	<body class="cuerpo">
		<div class="header">
			<div align="right">
				<a href="logout.php"><img src="close.png" title="Logout" onclick="return confirm('Cerrar la sesión?')"></a>		
			</div>
			<h1 align="center">ESTADISTICAS</h1>
		</div>
		
		<div class="contenedor">
			<div class="imagen" align="right">
				<a href="backend.php"><img src="home.png" title="Inicio"></a>
			</div>
			<div class="centro">

			
				<table >			
					<tr>
						<td colspan="2" align="center">
							<div id="chart_div" style="width: 900px; height: 500px;"></div>
						</td>
					</tr>
					
				</table>
			</div>

		</div>
	</body>
</html>
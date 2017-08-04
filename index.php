<?php
	include("conf.php");

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($link));
	$query = "SELECT * FROM geolocalizacion ORDER BY id DESC " or die("Error in the consult.." . mysqli_error($link));
	if($execute = mysqli_query($link, $query)){
	    $rows= mysqli_num_rows($execute);
	    if ($rows > 0){
	    	$row = mysqli_fetch_assoc($execute);
	        $ultima_latitud = $row["latitud"];
	        $ultima_longitud = $row["longitud"];
	        $ultima_fecha = $row["fecha"];
	    }else{
	        $arr = array('status' => '0', 'desc' => "No hay registros" );
	        $json = json_encode($arr);
	        echo "[".$json."]";
	    }
	}else{
	    $arr = array('status' => '0', 'desc' => "Error: " . mysqli_error($link));
	    $json = json_encode($arr);
	    echo "[".$json."]";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<?php
	echo "<script>
		var latitud = parseFloat('".$ultima_latitud."');
		var longitud = parseFloat('".$ultima_longitud."');
		var fecha = '".$ultima_fecha."';
		</script>";
?>




 <style>

    /*AIzaSyA6inrJ3SvwZjiortWCtQlkc6ViVuwcyyQ*/
      #map {
        height: 400px;
        width: 700px;
       }
    </style>


</head>
<body>
<h1>Lecturas</h1>
<?php
//Este es un comentario en php
/*
Otro comentario
*/
$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($link));
$query = "SELECT * FROM geolocalizacion " or die("Error in the consult.." . mysqli_error($link));
if($execute = mysqli_query($link, $query)){
    $rows= mysqli_num_rows($execute);
    //if ($rows > 0){
    //	$lecturas = $rows;
    //	echo "<table>
	//		<tr>
	//			<th>ID</th>
	//			<th>LATITUD</th>
	//			<th>LONGITUD</th>
	//			<th>FECHA</th>
	//		</tr>";
    //    while($row = mysqli_fetch_assoc($execute)) {
    //        echo "<tr>
    //        	<td>".$row["id"]."</td>
    //        	<td>".$row["latitud"]."</td>
    //        	<td>".$row["longitud"]."</td>
    //        	<td>".$row["fecha"]."</td>
    //        	</tr>";
    //    }
    //    echo "</table>";
    //}else{
    //    $arr = array('status' => '0', 'desc' => "No hay registros");
    //    $json = json_encode($arr);
    //    echo "[".$json."]";
    //}
}else{
    $arr = array('status' => '0', 'desc' => "Error: " . mysqli_error($link));
        $json = json_encode($arr);
        echo "[".$json."]";
}
mysqli_close($link);
?>
Hay <?php echo $lecturas; ?> lecturas<br>
Última Latitud: <?php echo $ultima_latitud; ?><br>
Última Longitud: <?php echo $ultima_longitud; ?><br>
<!--Esto es un comentario en html
<table>
	<tr>
		<th>ID</th>
		<th>LATITUD</th>
		<th>LONGITUD</th>
		<th>FECHA</th>
	</tr>
	<tr>
		<td>ID</td>
		<td>LATITUD</td>
		<td>LONGITUD</td>
		<td>FECHA</td>
	</tr>
</table>
-->
<!--
<script>
	
	alert("la latitud es: " + latitud + " la longitud es " + longitud + " Fecha de lectura " + fecha);
	
</script>-->




<h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: latitud, lng: longitud};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6inrJ3SvwZjiortWCtQlkc6ViVuwcyyQ&callback=initMap">
    </script>







</body>
</html>
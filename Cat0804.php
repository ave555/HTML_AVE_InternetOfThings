<?php

include("conf.php");//llamamos el archivo conf.php, donde tenemos guardados las configuraciones

if(isset($_GET["latitud"])){
 	$latitud = $_GET["latitud"];
}else{
	$latitud = "0";
}

if(isset($_GET["longitud"])){
 	$longitud = $_GET["longitud"];
}else{
	$longitud = "0";
}
//////////////////////INSERT/////////////////////nos conectamos a la base de datos, si hay un error nos manda un error 
$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($link));
$query = "INSERT INTO CAT0815FVBKL00404 (latitud, longitud, fecha) VALUES ('$latitud', '$longitud', '$fecha') ";
if($execute = mysqli_query($link, $query)){
    $last_inserted = mysqli_insert_id($link);//Get last id inserted
    $arr = array('status' => '1', 'desc' => 'Agregado');
    $json = json_encode($arr);
    echo "[".$json."]";
}else{
    $arr = array('status' => '0', 'desc' => "Error: " . mysqli_error($link));
    $json = json_encode($arr);
    echo "[".$json."]";
}
mysqli_close($link);
exit();

?>
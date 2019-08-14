<?php
session_start();

$rb = array('re1' => $_POST['qu1'] , 're2' => $_POST['qu2'], 're3' => $_POST['qu3'], 're4' => $_POST['qu4']);
$cb1 = $_POST['qu1'];
$cb2 = $_POST['qu2'];
$cb3 = $_POST['qu3'];
$cb4 = $_POST['qu4'];

$puntaje = 0;
if ($cb1 == "Alan Turing") {$puntaje += 1;}
if ($cb2 == "365 días y 6 horas") {$puntaje += 1;}
if ($cb3 == "Red, Green and Blue") {$puntaje += 1;}
if ($cb4 == "Geoide") {	$puntaje += 1;}


$per = array( 'nom' => $_POST['nombre'], 'ape' => $_POST['apellidos']);

if ($per['nom'] != "" AND $per['ape'] != "") {

	try {
		$con = mysqli_connect("localhost","root","","appmov");
	} catch (Exception $e) {
		printf("ERROR %s", $e);
	}

	
	//Comprobar que la conexion fue exitosa
	if (mysqli_connect_error()) {
		printf("Error en la conexion %s <br>", mysqli_connect_error() );
		exit(); 
	}

	if ($query = mysqli_query($con," INSERT INTO `usua` (`nombre`, `apellidos`, `aciertos`) 
		VALUES ('".$per['nom']."', '".$per['ape']."', '".$puntaje."'); " )) {
		//header("location: ".$_SERVER['HTTP_HOST']."/resultado.php");
		//die;
	}else{
		printf("Ha ocurrido un error inesperado %s" , mysqli_error());
	}
/*
	if ($consu = mysqli_query($con, "SELECT `nombre`,`apellidos`, `aciertos` FROM `usua` ORDER BY apellidos")) {
		$_SESSION['query'] = $consu;
		var_dump($consu);
		header("location: resultado.html");
	}*/

	mysqli_close($con); //Se cierra la conexion
	
}else{
	header("location: /");
	return false;
}
?>
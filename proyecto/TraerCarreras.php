<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
include("./connectionBd.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

$sql = "select * from carrera";

$resultado = $mysqli->query($sql);

$carreras = [];
while($fila=$resultado->fetch_assoc()) {
    $objCarrera = new stdClass();
    $objCarrera->carrera = $fila['NombreCarrera'];
    array_push($carreras, $objCarrera);
}

$objCarreras = new stdClass();
$objCarreras->carreras = $carreras;

$outJson = json_encode($objCarreras);

$mysqli->close();
echo $outJson;
?>
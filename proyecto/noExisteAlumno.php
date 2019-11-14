<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
$dniAlta = $_GET["dniAlta"];
include("./connectionBd.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

$sql = "select DniAlumno from alumnos where DniAlumno= " . $dniAlta;

$resultado = $mysqli->query($sql);

$users = [];
while($fila=$resultado->fetch_assoc()) {
    $objUser = new stdClass();
    $objUser->dniAlumno = $fila['DniAlumno'];
    array_push($users, $objUser);
}

$objUsers = new stdClass();
$objUsers->users = $users;

$outJson = json_encode($objUsers);

$mysqli->close();
echo $outJson;
?>
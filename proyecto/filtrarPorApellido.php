<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
$apellido = $_GET["apellido"];
sleep(2);
include("./connectionBd.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

$sql = "select * from alumnos where Apellido like '%" . $apellido . "%'";

$resultado = $mysqli->query($sql);

$users = [];
while($fila=$resultado->fetch_assoc()) {
    $objUser = new stdClass();
    $objUser->idAlumno = $fila['idAlumno'];
    $objUser->nombre = $fila['Nombre'];
    $objUser->apellido = $fila['Apellido'];
    $objUser->carrera = $fila['Carrera'];
    $objUser->dniAlumno = $fila['DniAlumno'];
    array_push($users, $objUser);
}

$objUsers = new stdClass();
$objUsers->users = $users;

$outJson = json_encode($objUsers);

$mysqli->close();
echo $outJson;
?>
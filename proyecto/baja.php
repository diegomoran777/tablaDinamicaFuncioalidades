<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
$idAlumno = $_POST["idAlumno"];
include("./connectionBd.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

$sql = "DELETE FROM alumnos WHERE idAlumno= " . $idAlumno;

$resultado = $mysqli->query($sql);
if($resultado == 1){
    $resultado = "El usuario " . $idAlumno . " ha sido dado de baja";
}else{
    $resultado = "Ha ocurrido un error, vualva a intentarlo";
}

$mysqli->close();
echo $resultado;
?>
<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
$idAlumno = $_POST["idAlumno"];
include("./connectionBd.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

$sql = "select PdfAlumno from alumnos where idAlumno= " .$idAlumno;

$resultado = $mysqli->query($sql);
$objUser = new stdClass();
    while($fila=$resultado->fetch_assoc()){
        $objUser->pdf = base64_encode($fila["PdfAlumno"]);
    }

$outJson = json_encode($objUser);
$mysqli->close();
echo $outJson;
?>
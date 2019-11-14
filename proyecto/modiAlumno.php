<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$carrera = $_POST["carrera"];
$dni = $_POST["dniAlta"];
$idAlumno = $_POST["idOculto"];

include("./connectionBd.inc");

$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if(isset($_FILES["pdf"]["tmp_name"])){
    $pdf= file_get_contents($_FILES["pdf"]["tmp_name"]);
    $respuesta = "El alumno con dni " . $dni . " se ha actualizado con exito!"; 
    if (!($sentencia = $mysqli->prepare("UPDATE alumnos SET PdfAlumno=? where idAlumno=?"))) {
        $respuesta = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }else{
        if (!$sentencia->bind_param("si", $pdf, $idAlumno)) {
            $respuesta = "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }else{
            if (!$sentencia->execute()) {
                $respuesta = "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        }
    }
}

$respuesta = "El alumno con dni " . $dni . " se ha actualizado con exito!"; 
if (!($sentencia = $mysqli->prepare("UPDATE alumnos SET DniAlumno=? , Nombre=? , Apellido=? , Carrera=? where idAlumno=?"))) {
    $respuesta = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
}else{
    if (!$sentencia->bind_param("ssssi", $dni, $nombre, $apellido, $carrera, $idAlumno)) {
        $respuesta = "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }else{
        if (!$sentencia->execute()) {
            $respuesta = "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }
    }
}  

echo $respuesta;
$mysqli->close();
?>
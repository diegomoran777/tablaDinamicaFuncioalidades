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

include("./connectionBd.inc");

$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);


if(isset($_FILES["pdf"]["tmp_name"])){
    $pdf= file_get_contents($_FILES["pdf"]["tmp_name"]);
    $respuesta = "El alumno con dni " . $dni . " se ha dado de alta con exito! "; 
    if (!($sentencia = $mysqli->prepare("INSERT INTO alumnos(DniAlumno,Nombre,Apellido,Carrera,PdfAlumno) VALUES (?,?,?,?,?)"))) {
        $respuesta = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }else{
        if (!$sentencia->bind_param("sssss", $dni, $nombre, $apellido, $carrera, $pdf)) {
            $respuesta = "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }else{
            if (!$sentencia->execute()) {
                $respuesta = "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        }
    }
}else{
    $respuesta = "El alumno con dni " . $dni . " se ha dado de alta con exito! "; 
    if (!($sentencia = $mysqli->prepare("INSERT INTO alumnos(DniAlumno,Nombre,Apellido,Carrera) VALUES (?,?,?,?)"))) {
        $respuesta = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }else{
        if (!$sentencia->bind_param("ssss", $dni, $nombre, $apellido, $carrera)) {
            $respuesta = "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }else{
            if (!$sentencia->execute()) {
                $respuesta = "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        }
    }
}

echo $respuesta;
$mysqli->close();
?>
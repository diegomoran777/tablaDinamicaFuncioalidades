<?php
session_start();
if(!isset($_SESSION['proyectoSesion'])){
    header('Location:../login.html');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="content-type content= text/html charset=utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Agregando etiquetas</title>
</head>

<body id="body">
    <header id="header"><h1 class="tituloPrincipal">Proyecto final</h1></header>
    <div id="divPanel">
        <button id="buttonAbrirAlta" class="buttonAbrirAlta" onclick="abrirFormAlta('1')">Alta</button>
        <button id="buttonBorrarRegistros" class="buttonBorrarRegistros" onclick="borrarRegistros()">Borrar registros</button>
        <button id="buttonCerrarSesion" class="buttonCerrarSesion" onclick="cerrarSesion()">Salir</button>
        <label class="labelPanel" for="inputCampo">Campo</label>
        <input id="inputCampo" class="inp" name="inputCampo" type="text" value="idAlumno">
        <label class="labelPanel" for="inputCantCampos">Cantidad</label>
        <input id="inputCantCampos" class="inp" name="inputCantCampos" type="text" value="">
        <button id="button">enviar</button>
    </div>
    <div id="divHead">
        <ul class="ulHead">
            <li onclick="cambiarCampo('idAlumno')"><a>ID_Alumno</a></li>
            <li onclick="cambiarCampo('Nombre')"><a>Nombre</a></li>
            <li onclick="cambiarCampo('Apellido')"><a>Apellido</a></li>
            <li onclick="cambiarCampo('Carrera')"><a>Carrera</a></li>
            <select id="selectCarrera" class="selectCarrera"></select>
            <input id="inputNombre" class="inputNombre" type="text" value="">
            <input id="inputApellido" class="inputApellido" type="text" value="">
            <li onclick="cambiarCampo('DniAlumno')"><a>DniAlumno</a></li>
            <li><a>Pdf</a></li>
            <li><a>Modi</a></li>
            <li><a>Baja</a></li>
        </ul>
    </div>
    <div id="divPrincipal"></div>
    <div id="contenedorFormAlta" class="fadeIn">
        <p id="respuesta"></p>
        <button id="cerrar" class="buttonCerrar">x</button>    
        <form id="formAlta" class="formAlta" enctype="multipart/form-data" method="post">
            <input id="idOculto" class="idOculto" type="text" name="idOculto" value="">
            <label  for="dni">DNI</label><br>
            <input id="dniAlta" type="text" name="dniAlta" placeholder="DNI" autofocus=""><br>
            <label  for="nombre">Nombre</label><br>
            <input id="nombreAlta" type="text" name="nombre" placeholder="Nombre" autofocus=""><br>
            <label for="apellido">apellido</label><br>
            <input id="apellidoAlta" type="text" name="apellido" placeholder="Apellido"><br>
            <label for="check">Subir CV</label>
            <input id="checkCV" type="checkbox" name="check"><br>
            <label for="pdf">PDF</label><br>
            <input id="pdfAlta" type="file" name="pdf" placeholder="pdf cv" disabled><br>
            <label for="carrera">Carrera</label><br>
            <select id="selectCarreraAlta" name="carrera" value=""></select><br>
            <input id="ocultoValue" class="oculto" type="text" name="oculto" value="">
        </form>
        <button id="BtnEnviar" class="BtnEnviar" type="" name="" onclick="activarAltaModi()">Enviar</button>
    </div>
    <div id="mostrarPdf"></div>
    <footer id="footer"></footer>
<script type="text/javascript" src="index.js"></script>
</body>
</html>
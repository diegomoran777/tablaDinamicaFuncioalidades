<?php
$usuariohtml = $_POST["Id"];
$passhtml = $_POST["Pass"];

function validar($usuario, $pass){
    include("./connectionBd.inc");
    $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);
    $sql = "select * from usuarios where Login= " ."'$usuario'";
    
        $resultado = $mysqli->query($sql);
         while($fila=$resultado->fetch_assoc()){
            $password = $fila["Password"];
        }

    if($password == sha1($pass)){
        return true;
    }
    return false;
    $mysqli->close();
}

if(!validar($usuariohtml, $passhtml)){
    header('Location:./login.html');
    exit();
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
    <h1>Acceso permitido</h1>
    <?php
    session_start();
    $_SESSION['proyectoSesion'] = session_id();
    $contador = fopen("./contador.txt", "r");
    $contador2 = fgets($contador);
    $contador3 = $contador2 + 1;
    fclose($contador);
    echo "<h2>Inicios de sesion ".$contador3. "</h2><br>";
    $contadorWrite = fopen("./contador.txt", "w");
    fputs($contadorWrite, $contador3);
    fclose($contadorWrite);
    $_SESSION['contador'] = $contador3;
    echo "<h1>Parametros de sesion:</h1><br>";
    echo "<strong>Id: ".$_SESSION['proyectoSesion']." </strong><br>";
    echo "<strong>Pass: ".$passhtml." </strong><br>";
    echo "<strong>Contador: " .$_SESSION['contador']." </strong><br>";
    echo "<button onclick=\"location.href='./proyecto'\">Ingresar</button><br>";
    echo "<button onclick=\"location.href='./destruirSesion.php'\">Cerrar sesion</button><br>";   
    ?>
<footer id="footer"></footer>
<script type="text/javascript" src="index.js"></script>
</body>
</html>

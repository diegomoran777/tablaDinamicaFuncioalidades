<?php
include("./verificaSsesion.inc");
session_unset();
session_destroy();
header('Location:./login.html');
?>
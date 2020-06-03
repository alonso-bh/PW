<?php

session_start();

setcookie('seccion_actual', $_GET['seccion_seleccionada']);


header("Location: recursosseccion1.php"); 

?>
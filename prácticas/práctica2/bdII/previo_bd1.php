<?php

include 'funcionalidades.inc'; 

session_start();

setcookie('bd_actual', $_GET['bd']);

// extraer imagen de la base de datos
$result = conexionBD("select imagen from bd where nombre='" . $_GET['bd'] . "'"); 
$imagen="";
foreach($result as $item){ $imagen = $item['imagen'];  }

setcookie('imagen_bd', $imagen);    // añadir cookie 

header("Location: bd1.php"); 

?>
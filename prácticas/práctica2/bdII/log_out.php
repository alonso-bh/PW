<?php

session_start();

echo $_SESSION['tu_nick']; 

session_unset();

session_destroy(); 


header("Location: index.php"); 
?>
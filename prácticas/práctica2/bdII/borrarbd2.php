<?php
    include 'funcionalidades.inc'; 
    
    // extraer la base de datos a borrar 
    $esta_bd = $_GET['aux'];

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "delete from bd where nombre='" . $esta_bd .  "'" ;
    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        header("Location: gestorbd.php"); 
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    

    
?>
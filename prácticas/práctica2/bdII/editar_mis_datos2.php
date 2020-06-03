<?php
    session_start();
    
    // añadir el resto de campos nuevos
    $nombre = $_POST['tu_nombre'];
    $email = $_POST['tu_correo'];
    $nick_nuevo = $_POST['tu_nick_'];
    $clave = $_POST['clave_nueva'];
    $pais = $_POST['pais_nuevo']; 
    echo $nick_nuevo; 

    // comprobaciones sobre la clave

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    $conexion = new PDO ($mbd, $usuario, $contraseña);
    $sentencia = "update usuario set nombre='" . $nombre . "' ,  email='" . 
        $email . "', contrasena='" . $clave . "',  pais='" . $pais . "', nick='" . $nick_nuevo   .  "' where nick='" . 
        $_SESSION['tu_nick'] . "'" ;

    try { 
        $conexion->query( $sentencia ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $_SESSION['tu_nick'] = $nick_nuevo; 
        header ("Location: gestorbd.php");
    }
    catch ( PDOException $e ) { 
        echo "Consulta fallida: " . $e->getMessage(); 
    }
    
?>
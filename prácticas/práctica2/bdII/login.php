
<?php
    

    /** conectarse a la bd para comprobar que el nombre y la clave son correctos */
    /** 1) configurar una conexión simple a la BD  */
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";

    /** 2) mandar la consulta  */
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "select * from usuario where nick='" . $_POST["nombre_"] . "' "  ; 

    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    
    $user_ok ="" ; 
    $clave_ok = ""; 

    /* mostrar resultados de la consulta */
    foreach ( $resultado as $fila ) {
        $user_ok = $fila["nick"]; 
        $clave_ok = $fila["contrasena"]; 
        
    }

    if ($user_ok == $_POST["nombre_"] && $clave_ok == $_POST["clave_"] ){
        session_start();
        $_SESSION['tu_nick'] = $user_ok;        // INICIAR LA SESIÓN 
        header("Location: gestorbd.php");  
    }
    else{
        header("Location: index.php"); 
    }

?>


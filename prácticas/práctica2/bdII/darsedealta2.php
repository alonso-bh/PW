<?php
session_start();

include 'funcionalidades.inc'; 

    // SACAR CAMPOS DEL FORMULARIO 

    $nombre = $_POST['tu_nombre'];
    $email = $_POST['tu_correo'];
    $nick_nuevo = $_POST['tu_nick_'];
    $clave = $_POST['clave_nueva'];
    $contrasena = $_POST['clave_nueva'];
    $pais = $_POST['pais_nuevo']; 

    
    // comprobar si el nick (nombre de usuario) nuevo ya existía, 
    //  si ya existía, se redirige al usuario a darsedealta.php de nuevo
    $nicks = conexionBD("select nick from usuario");

    $repetido = false;
    foreach($nicks as $item){
        if ($item['nick'] == $nick_nuevo)
        {
            $repetido = true; 
        }
    }

    if(!$repetido)  // nombre de user NO repetido: puede insertarse este nuevo usuario
    {
        /** conexión simple a la BD  */
        $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
        $usuario = "pw76067525";
        $contraseña = "76067525";
        $conexion = new PDO ($mbd, $usuario, $contraseña);
        $sentencia = "insert into usuario ( nombre,email,nick,contrasena,pais,imagen) values ('" . 
            $nombre   . "', '"  . $email . "', '" . $nick_nuevo . "', '" . $contrasena . "', '" . $pais 
            . "', '" . "imagenes/img_avatar.png" . "') " ; 
        
        try { 
            $conexion->query( $sentencia ); 
            $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            // INICIAR SESIÓN Y DARLE "NOMBRE" 
            session_start(); 
            $_SESSION['tu_nick'] = $nick_nuevo; 

            header ("Location: gestorbd.php");  // tras iniciar sesión ...
        }
        catch ( PDOException $e ) { 
            //echo "Consulta fallida: " . $e->getMessage();
            header("Location: index.php"); 
        }
            
    }

    else{      // el usuario existía: error 
        $a_imprimir = '<script type="text/javascript">alert("Este nombre de usuario (nick) ya existe en el gestor. Usa otro.")</script>'; 
        header("Location: darsedealta.php?a_imprimir=" . $a_imprimir  );
    }

    
    


?>
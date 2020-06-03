

<?php
    
    include 'funcionalidades.inc'; 
    session_start();


    $titulo_actual = $_GET['seccion'];
    echo $titulo_actual; 
    $esta_bd = $_COOKIE['bd_actual']; 
    $titulo = $_POST["titulo"];
    $autor = $_POST['autor'];

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    
    $conexion = new PDO ($mbd, $usuario, $contraseña); 


    $consulta = "update seccion set titulo='" . $titulo . "', autor='" . 
        $autor . "', bd='" . $esta_bd . "' where titulo='" . $titulo_actual . "' " ; 
    // NOTA sobre la consulta: no se modifica la pagina asociada a la seccion
    // porque solo tenemos una para todas las secciones: recursosseccion1.php 

    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Location: bd1.php"); 
        
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    


?>
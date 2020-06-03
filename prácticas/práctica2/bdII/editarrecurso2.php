<?php  

    include 'funcionalidades.inc'; 
    
    // campos nuevos 
    $titulo = $_POST["titulo"];
    $autor = $_POST['autor'];
    $tipo= $_POST['tipo'];
    $descripcion = $_POST['areatexto'] ; 

    $antiguo = $_GET['antiguo'];
    echo $antiguo; 

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "update recurso set nombre='" . $titulo . "', autor='" . 
        $autor . "', tipo='" . $tipo . "', descripcion='" .   $descripcion  . "'  where nombre='" . $antiguo . "' " ; 
    

    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Location: bd1.php"); 
        
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    



?>
<?php  


include 'funcionalidades.inc';

$recurso = $_POST['recurso']; 


// conexión a la base de datos
$mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
$usuario = "pw76067525";
$contraseña = "76067525";

$conexion = new PDO ($mbd, $usuario, $contraseña); 

$consulta = "delete from recurso where nombre='" . $recurso . "' " ; 
try { 
    $resultado = $conexion->query( $consulta ); 
    $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    header("Location: bd1.php"); 
    
}
catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }



?>
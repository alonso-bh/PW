

<?php
    
include 'funcionalidades.inc'; 

// nombre de la bd 
$esta_bd = $_GET['bd']; 
$titulo = $_POST["titulo"];
$autor = $_POST['autor'];

    
// comprobar si el recurso ya existía, 
$recs = conexionBD("select titulo from seccion");
$repetido = false;
foreach($recs as $item){
    if ($item['titulo'] == $titulo)
    {
        $repetido = true; 
    }
}

if(!$repetido)  // nombre  NO repetido: 
{

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "insert into seccion (titulo, autor,pagina,bd) values ('" .  
        $titulo  . "','" . $autor  . "','" . 
        "recursosseccion1.php" . "','" . $esta_bd . "') " ;
    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Location: bd1.php"); 
        
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
}
else{
    $a_imprimir = '<script type="text/javascript">alert("Esta sección ya existe en el gestor. Usa otro nombre e inténtalo de nuevo.")</script>'; 
    header("Location: altaseccion.php?a_imprimir=" . $a_imprimir  );
}

?>
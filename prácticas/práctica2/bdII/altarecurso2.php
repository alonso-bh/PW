<?php 


include 'funcionalidades.inc'; 

$titulo = $_POST['titulo'];
$autor = $_POST['autor']; 
$seccion = $_POST['secciones']; 
$tipo = $_POST['tipo']; 
$descripcion = $_POST['areatexto']; 

echo $autor; 
echo $tipo;



// subida del archivo ... 
//$ruta_archivo ="./imagenes/" ;
//$fichero_final = $ruta_archivo . basename($_FILES['foto']['name']);
//    $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
/*if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_final)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}
*/

$fichero_final = "imagenes/recurso.jpg"; 

// comprobar si el recurso ya existía, 
$recs = conexionBD("select nombre from recurso");

$repetido = false;
foreach($recs as $item){
    if ($item['nombre'] == $titulo)
    {
        echo $item['nombre'] . " =? " . $titulo . "\n"; 
        $repetido = true; 
    }
}

if(!$repetido)  // nombre de recurso NO repetido
{

    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";

    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "insert into recurso (nombre, autor, tipo, imagen, seccion, descripcion) values ('" .  
        $titulo  . "','" . $autor . "','" . $tipo .  "','" .  $fichero_final . "','" .  
        $seccion .  "','" . $descripcion .   "' ) " ;
    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Location: bd1.php"); 
        //echo "no repe"; 
        
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }


}
else{      // el recurso  existía
    $a_imprimir = '<script type="text/javascript">alert("Este recurso ya existe en el gestor. Usa otro nombre e inténtalo de nuevo.")</script>'; 
    header("Location: altarecurso.php?a_imprimir=" . $a_imprimir  );
}


?>
<?php

    include 'funcionalidades.inc'; 


    // extraer campos del formulario
    $nombre_bd = $_POST['titulo'];
    $autor = $_POST['tu_nombre'];
    $campo_cono = $_POST['campo_cono'];
    $descripcion = $_POST['areatexto'] ; 

    // extraer nombre antiguo de la BD
    $titulo_actual = $_GET['titulo_actual']; 


    /******************************* */
    // ***   subida del archivo ...    ***   
    //$ruta_archivo ="./imagenes/" ;
    //$fichero_final = $ruta_archivo . basename($_FILES['foto']['name']);
    //    $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
    /*if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }*/
    //echo $fichero_final;       

    // --------------- lo siguiente es provisional hasta que no se arregle la subida de archivos
    $res2=conexionBD("select imagen from bd where nombre ='" . $nombre_bd . "'"); 
    $imagen_provisional ="";
    foreach($res2 as $item ){  $imagen_provisional= $item['imagen'];  } 
    $fichero_final=$imagen_provisional ; 
    $fichero_final = "imagenes/bib2.jpg";    /** esta linea sobraria  */
    // --------------  fin del trozo provisional

    /******************************* */




    // conexión a la base de datos
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = "update bd set nombre='" . $nombre_bd . "', autor='" . $autor . "', campo_conocimiento='" . 
        $campo_cono . "', imagen='" .  $fichero_final  .  "' , descripcion='" . $descripcion  . "'  where nombre='" . $titulo_actual . "' "  ;
    
    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Location: gestorbd.php"); 
    }
    catch ( PDOException $e ) { 
        echo "Consulta fallida: " . $e->getMessage(); 
    }
    
    
?>
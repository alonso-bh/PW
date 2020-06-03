<?php

    include 'funcionalidades.inc'; 

    // extraer resto de campos del formulario
    $nombre_bd = $_POST['titulo'];
    $autor = $_POST['tu_nombre'];
    $campo_cono = $_POST['campo_cono'];
    $descripcion = $_POST['areatexto']; 


    // comprobar si la bd ya existía, 
    $bds = conexionBD("select nombre from bd");

    $repetido = false;
    foreach($bds as $item){
        if ($item['nombre'] == $nombre_bd)
        {
            $repetido = true; 
        }
    }

    if(!$repetido)  // nombre de user NO repetido: puede insertarse este nuevo usuario
    {

        /******************************* */
        // subida del archivo ... 
        //$ruta_archivo ="./imagenes/" ;
        //$fichero_final = $ruta_archivo . basename($_FILES['foto']['name']);
        //    $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
        
        $fichero_final = "imagenes/bib1.jpg";    /** esta linea sobraria  */
        /******************************* */


        // conexión a la base de datos
        $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
        $usuario = "pw76067525";
        $contraseña = "76067525";
        $conexion = new PDO ($mbd, $usuario, $contraseña); 
        $consulta = "insert into bd (nombre, autor, imagen, campo_conocimiento, descripcion) values ('" . 
            $nombre_bd . "', '" . $autor . "', '" . $fichero_final . "' , '" . $campo_cono  .  "','" . $descripcion  . "' ) ";
        
        try { 
            $resultado = $conexion->query( $consulta ); 
            $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            header("Location: gestorbd.php"); 
            //echo "no estaba repe"; 
        }
        catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    }
    else{      // la bd existía
        $a_imprimir = '<script type="text/javascript">alert("Esta biblioteca ya existe en el gestor. Usa otro nombre e inténtalo de nuevo.")</script>'; 
        header("Location: crearbd.php?a_imprimir=" . $a_imprimir  );
        //echo "ya existe: " . $nombre_bd ; 
    }
    


?>
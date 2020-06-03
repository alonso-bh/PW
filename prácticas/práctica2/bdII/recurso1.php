<!DOCTYPE html>
<head>
    <title>
        Página de un recurso 
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>

<?php
    include 'funcionalidades.inc'; 

    session_start();
    
    $este_recurso = $_GET['este_recurso']; 
    $esta_bd = $_COOKIE['bd_actual']; 
    

    // sacar info de este recurso de la base de datos
    $res_ = conexionBD("select * from recurso where nombre='" . $este_recurso . "'");

    foreach($res_ as $item)
    {
        $titulo = $item['nombre'];
        $autor = $item['autor'];
        $seccion = $item['seccion'];
        $tipo = $item['tipo'];
        $descripcion = $item['descripcion']; 
        $imagen = $item['imagen']; 
    }


?>

<body>

    <!-- CABECERA ************************************* -->
    <header>

        <section class="index_head1">
            <!--imagen logo pequeño-->
            <a href="bd1.php">
                <figure>
                    <img src="<?php echo $_COOKIE['imagen_bd'];  ?>" id="header_image" alt="logo.png" />        
                </figure>
            </a>
        </section>


        <section id="index_head2">
            <h1><?php  echo $_COOKIE['bd_actual']; ?></h1>
        </section>
        

        <section class="index_head1" id="head3">
            <br>
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
            <?php  
                if (isset($_SESSION['tu_nick']))  echo $_SESSION['tu_nick'];  
                else echo "No has iniciado sesión";
            ?>
            <br><br>
        </section>
        
    </header>

    <!-- cuerpo principal   -->

    <main>
         <!-- BARRA DE SECCIONES-->
        
         <nav id="menu">
            <ul>
                <?php  
                
                $res1 = conexionBD("select * from seccion where bd='" . $esta_bd  . "' " );

                foreach($res1 as $f)
                {
                    $nombre_seccion = $f['titulo']; 
                    echo '<li><a href="previo_seccion.php?seccion_seleccionada=' . $nombre_seccion . '">' . $nombre_seccion  . '</a></li>' ;
                }

                ?>
            </ul>
        </nav>

        <!-- CUADRO DE INFORMACION DEL RECURSO -->

        <section id="cuadro_info">
            <section id="izda">
                <img src="<?php echo $imagen;  ?>" id="img_descripcion">
            </section>

            <section id="dcha">

                <table style="text-align: left; width: 100%;">
                    <tr>
                        <th>Título: </th>
                        <th class="columna_izda">
                            <?php  echo $titulo ;  ?>
                        </th>
                        
                    </tr>
                    <tr>
                        <th>Autor:</th>
                        <th class="columna_izda">
                            <?php  echo $autor;  ?>
                        </th>
                    </tr>
                    <tr>
                        <th>Sección del recurso: </th>
                        <th class="columna_izda">
                            <?php  echo $seccion;  ?>
                        </th>

                    </tr>

                    <tr>
                        <th>Tipo de recurso: </th>
                        <th class="columna_izda">
                            <?php   echo $tipo;   ?>
                        </th>
                    </tr>

                </table>
              
                
            </section>

            <section id="descripcion">
                <p>Descripción: </p>
                
                <p id="cuadro_descripcion"><?php  echo $descripcion; ?> </p>
                
            </section>



            

        </section>

        <section>
            <table id="navegacion_recurso">
                <tr>
                <th class="accesos"> <?php funcion_anterior ($seccion, $este_recurso); ?> </th>
                <th id="centro">  </th>
                <th class="accesos"> <?php funcion_siguiente($seccion, $este_recurso); ?> </th>
                </tr>
            </table>
        </section>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
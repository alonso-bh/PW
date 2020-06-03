<!DOCTYPE html>
<head>
    <title>
        Página principal de una biblioteca digital
    </title>
    
    <link rel = "stylesheet" type = "text/css" href = "estilos.css" />

</head>

<?php
    // continuar sesión ... 
    session_start(); 

    include 'funcionalidades.inc'; 

    // sacar campos dinámicos para construir la página
    $esta_bd = $_COOKIE['bd_actual']; 
    $res = conexionBD ("select * from bd where nombre='" . $esta_bd  .  "' ");
    foreach($res as $fila)
    {
        $autor = $fila['autor']; 
        $imagen = $fila['imagen'];
        $campo_cono = $fila['campo_conocimiento']; 
        $descripcion = $fila['descripcion'];
    }

    // ... sacar el número de recursos de esta biblioteca: 
    $num_recursos=-1; 
    $res1 = conexionBD ("select count(1) from seccion where bd='" . $esta_bd . "'" ); 
    foreach($res1 as $f)
    {
        $num_recursos = $f['count(1)']; 
    }
?>


<body>
    
    <!-- CABECERA ************************************* -->
    <header>

        <section class="index_head1">
            <!--imagen logo pequeño-->
            <figure>
                <img src="<?php echo $_COOKIE['imagen_bd'];  ?>" id="header_image" alt="logo.png" />        
            </figure>
        </section>


        <section id="index_head2">
            <h1> <?php  echo $esta_bd;  ?>  </h1>
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

    <!--  PRINCIPAL -->
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

        <!-- lateral izdo-->
        <section id="lateral_izdo">
            
            <?php  echo '<p> Descripción: ' . $descripcion  . '</p>' ;  ?>

            <h2 class="titulo_secciones">Recursos destacados</h2>

            <section id="cuadro_destacados">
                
                <?php  

                $recursos = conexionBD("select * from recurso,seccion where recurso.seccion=seccion.titulo and seccion.bd='" .  $esta_bd . "'"  ); 

                $i = 0; 
                foreach ($recursos as $fila) 
                {
                    if ($i < 5){
                        echo '
                        <article id="destacado">
                    
                            <img src="'   . $fila['imagen']  .  '" alt="destacado" id="imagen_recurso" />
                            <p class="tit_recurso">' .  $fila['nombre']  . '</p>
                            <p class="descripcion_recurso">' .  $fila['descripcion'] . '</p>
                        </article>
                        ' ; 

                        $i = $i+1;  // incrementar el número de recursos imprimidos 
                    }
                    else{ 
                        break; 
                    }
                }
                ?>
            </section>       

        </section>

        <!-- lateral dcho-->
        <section id="lateral_dcho">
            <article> <!-- info diversa sobre la BD -->
                <h2 class="titulo_secciones">Información general sobre la colección</h2>
                <p>
                    Número de recursos totales: 
                    <?php 
                        // echo $num_recursos; 
                        $res3 = conexionBD("select count(1) from recurso, seccion where recurso.seccion=seccion.titulo and  bd='" .  $esta_bd  . "' "  );
                        foreach($res3 as $f){
                            echo $f['count(1)']; 
                        }
                    ?>
                </p>
                <p>
                    Autores: <?php echo $autor;  ?>
                </p>
                <p>
                    Campo de conocimiento: <?php  echo $campo_cono;   ?>
                </p>

                <br><br>
                <p id="volver" >
                    <?php  
                    
                    if (isset($_SESSION['tu_nick'])){   // sesión iniciada ...
                        echo '<a href="gestorbd.php"> << Volver al gestor de bibliotecas</a>';
                    }
                    else{
                        echo '<a href="index.php"> << Volver a la página de inicio</a> (porque no has iniciado sesión)'; 
                    }
                    ?>
                </p>
            </article>

            <br><br>

            <article style="text-align: center;">
                <p class="tit_manip">Gestión de recursos: </p>

                <a href="editarrecurso.php" ><img src="imagenes/edit.JPG" class="iconos_manejo" title="Editar recurso"  ></a>
                <a href="altarecurso.php"   ><img src="imagenes/add.JPG"  class="iconos_manejo" title="Dar de alta un nuevo recurso"  ></a>
                <a href="borrarrecurso.php" ><img src="imagenes/delete.JPG" class="iconos_manejo" title="Borrar recurso"  ></a>


                <br> <br>

                <p class="tit_manip">Gestión de secciones</p>
                <a href="editarseccion.php?bd=<?php echo $esta_bd; ?>" ><img src="imagenes/edit.JPG" class="iconos_manejo" title="Editar sección"  ></a>
                <a href="altaseccion.php?bd=<?php echo $esta_bd; ?>"   ><img src="imagenes/add.JPG"  class="iconos_manejo" title="Dar de alta una sección "   ></a>
                <a href="borrarseccion.php" ><img src="imagenes/delete.JPG" class="iconos_manejo" title="Borrar sección  "  ></a>

            </article>
            
        </section>
       
    </main>

    <!-- PIE   ************************************* -->
    <footer>
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>

</body>
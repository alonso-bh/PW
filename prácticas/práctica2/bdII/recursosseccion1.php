<!DOCTYPE html>
<head>
    <title>
        Sección 1: Literatura española 
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />
</head>
<?php
    include 'funcionalidades.inc'; 
    session_start();
    $esta_bd= $_COOKIE['bd_actual'];
    $esta_seccion = $_COOKIE['seccion_actual']; 
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
            <h1> <?php  echo $_COOKIE['bd_actual'];   ?> </h1>
        </section>
     
        <section class="index_head1" id="head3">
            <br>
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
            <?php    
            
            if(isset($_SESSION['tu_nick'])){
                echo $_SESSION['tu_nick'];
            }
            else{ 
                echo "No has iniciado sesión"; 
            }
            
            ?>
            <br><br>
        </section>
        
    </header>

    <!-- ******************** PRINCIPAL ******************* -->
    <main style="width: 100%">
        
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

        <p id="titulo_seccion">Sección: <?php echo $esta_seccion ; ?></p>
        <br><br><br>

        <section style="float: none; width=100%">
        <?php  
            $res2 = conexionBD("select * from recurso where seccion='" . $esta_seccion . "'");
            foreach($res2 as $fila)
            {
                echo ' 
                    <article class="recurso">
                    <p class="tit_recurso"><a href="recurso1.php?este_recurso=' .  $fila['nombre']  .'" >' .  $fila['nombre']  .  '</a></p>
                    <p class="texto_recurso">'  . $fila['descripcion']  .  '</p>
                    </article>
                '; 
            }
        
        ?>
        </section>      
        <br><br><br>

        <!-- PUNTEROS PARA NAVEGAR POR LAS PÁGINAS DE ESTA BIBLIOTECA (1 2 3 ... ) -->
        <table id="paginas" style="text-align:center;">
            <tr>
                <th class="num_pagina"><a href="recursosseccion1.php">1</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">2</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">3</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">4</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">5</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">6</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">7</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">8</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">9</a></th>
                <th class="num_pagina"><a href="recursosseccion1.php">10</a></th>
            </tr>
        </table>

    </main>

    <!-- PIE   ************************************* -->

    <footer>
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>

</body>



<!DOCTYPE html>
<head>
    <title>Página del gestor de las bibliotecas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>

<?php
    // conexión a la base de datos
    include 'funcionalidades.inc'; 

    // INICIAR SESIÓN 
    session_start();
    
    
?>

<body>
    <!-- CABECERA ************************************* -->
    <header>

        <section class="index_head1">
            <!--imagen logo pequeño-->
            <figure>
                <img src="imagenes/logo.jpg" id="header_image" alt="logo.png" />        
            </figure>
        </section>


        <section id="index_head2">
            <h1>Gestor de bibliotecas digitales</h1>
        </section>
        

        <section class="index_head1" id="head3">
            <br>       
            <p id="user"> <?php echo $_SESSION['tu_nick'] ?> </p> 

            <!-- <a class="sobre_user" href="altagestor.html" >Alta usuario</a> 
            <a class="sobre_user" href="borrargestor.html" >Baja usuario</a>
            <a class="sobre_user" href="editargestor.html"> Edición usuario</a>
            -->  
            
            <a href="log_out.php" class="sobre_user" >Cerrar sesión</a>      <a href="editar_mis_datos.php"  class="sobre_user" >Modificar mis datos </a>
            <br/><br/>
        </section>
        
    </header>
    
    <!-- CUERPO ************************************* -->
    <main>
        <br>

        <!-- LATERAL IZDO (IMAGEN) ******************-->
        <section class="mitad" id="mitad_izda">
            <p id="_info_crear_biblio">Pulse en la imagen para crear una nueva biblioteca digital. </p>

            <a href="crearbd.php"  >
                <img src="imagenes/agua.jpg" class="imagen_lateral" />
            </a>
        </section>

        <!-- LATERAL DCHO (BIBLIOTECAS) **************  -->
        <section class="mitad" id="mitad_dcha_gestor">
            Bibliotecas dadas de alta en el gestor 
            <br><br>

            <!--BIBLIOTECAS DIGITALES (representacion) -->
            <?php

                $resultado = conexionBD('select * from bd') ; 

                foreach ( $resultado as $fila ) {
                    
                    $nombre_bd = $fila['nombre']; 
                    $recursos = imprimir_recursos($nombre_bd);
                    echo ' <article class="unabiblio">
                        <a href="previo_bd1.php?bd=' . $nombre_bd  . '" title="'   .  $recursos  .  '"     > <img class="im_biblio" src=" '.  $fila["imagen"]  . '  "  /> </a>
                        <p class="tit_biblio"> <a href="previo_bd1.php?bd=' . $nombre_bd  . '" > ' .   $nombre_bd  . ' </a>  </p>        
                    ';
                    echo "<a class='opciones_bd' href='editarbd.php?esta_bd=" . $nombre_bd .  "'> <img src='imagenes/edit.JPG' class='iconos_manejo' title='Editar biblioteca digital'  > </a>   
                        <a class='opciones_bd' href='borrarbd.php?esta_bd=" . $nombre_bd . "'> <img src='imagenes/delete.JPG' class='iconos_manejo' title='Borrar biblioteca digital'  > </a>     
                    
                    </article>
                    <br> ";                     
                }

            ?>


        </section>

    </main>


    <!-- PIE   ************************************* -->
    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>
</body>
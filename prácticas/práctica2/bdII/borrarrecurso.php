<!DOCTYPE html>
<head>
    <title>
        Eliminar un recurso de la biblioteca digital
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>

<?php  

session_start();

$esta_bd = $_COOKIE['bd_actual']; 

include 'funcionalidades.inc'; 

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
            <h1> <?php  echo $esta_bd; ?>  </h1>
        </section>
        

        <section class="index_head1" id="head3">
            <br>
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
            <?php     
                if( isset($_SESSION['tu_nick']) ){
                    echo $_SESSION['tu_nick'];
                }
                else echo "No has iniciado sesión"; 
            ?>
            <br><br> 
        </section>
        
    </header>


    <main>
         <!-- BARRA DE SECCIONES-->
        
         <nav id="menu">
            <ul>
                <?php  
                
                $res1 = conexionBD("select * from seccion where bd='" . $esta_bd  . "' " );

                foreach($res1 as $f)
                {
                    $nombre_seccion = $f['titulo']; 
                    echo '<li><a href="recursosseccion1.php">' . $nombre_seccion  . '</a></li>' ;
                }

                ?>
            </ul>
        </nav>

        <!-- CUADRO DEL FORMULARIO COMPLETO -->

        <form id="formulario_alta"  method="POST" action="borrarrecurso2.php"  >
            <p>Este formulario le ayudará a borrar un recurso de la biblioteca. Seleccione el recurso a borrar y pulse "Borrar recurso". </p>
        

            <div >

                <table style="text-align: left; width: 100%;">
                   
                    <th>Seleccione un recurso de los existentes:</th>
                        <th>
                            <select id="recurso"  name="recurso"  >
                                <?php
                                
                                $res2 = conexionBD("select nombre from recurso ");
                                
                                foreach($res2 as $item){
                                    echo "<option>" . $item['nombre'] . "</option>";
                                }

                                ?>
                            </select>
                        </th>

                </table>
                
            </div>

            <div style="text-align: right;">
                <input type="submit" value="Borrar recurso"/>
            </div>         

        
        </form>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
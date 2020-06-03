<!DOCTYPE html>
<head>
    <title>
        Editar una sección 
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>


<?php 


    session_start(); 

    include 'funcionalidades.inc'; 

    $esta_bd = $_GET['bd']; 
    
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
            <h1>  <?php  echo $esta_bd;  ?> </h1>
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
                    echo "Sesión no iniciada"; 
                }
            
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

        <section id="formulario_alta">
            <p>Este formulario le ayudará a editar una sección. Rellene los campos indicados y pulse en "Siguiente paso". </p>
                     
            <form enctype="multipart/form-data" method="POST" action="editarseccion_paso2.php" name="formu" >

                <table style="text-align: left; width: 100%;">
                    <tr>
                        <th> <label for="titulo" >Seleccione la sección a editar:</label> </th>
                        <th>
                            <select id="la_seccion" name="la_seccion" >
                            <?php

                                $resultado = conexionBD("select * from seccion where bd='" . $esta_bd . "'"  ) ; 

                                foreach($resultado as $fila )
                                {
                                    echo '<option>' . $fila['titulo'] . '</option>' ; 
                                }

                            ?>
                            </select>
                        </th>  
                    </tr>
                 

                </table>
              

                <div style="text-align: right;">
                <input type="submit" value="Siguiente paso"/>
                </div>
                
            </form>


           



            

        </section>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
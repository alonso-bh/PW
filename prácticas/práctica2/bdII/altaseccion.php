<!DOCTYPE html>
<head>
    <title>
        Dar de alta una sección 
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>


<script type='text/javascript'>

function validar()
{
    var ok=true; 
    var cad = "Has cometido algunos errores en el formulario: \n"; 

    if (document.getElementById("titulo").value.length == 0)
    {
        cad += "- Debes indicar el título de la sección\n";
        ok = false;
    }
    if (document.getElementById("autor").value.length == 0)
    {
        cad += "- Debes indicar un autor.\n" ;
        ok = false;
    }

    if (ok == false){
        alert(cad);
    }

    // devolver resultado (bien/mal) de la validación
    return ok; 
}

</script>

<?php 
        
    if( isset($_GET['a_imprimir']) ){
        echo $_GET['a_imprimir']; 
    }
    session_start(); 

    include 'funcionalidades.inc'; 

    $esta_bd = $_COOKIE['bd_actual']; 
    
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
            <h1> <?php  echo $_COOKIE['bd_actual'];  ?>  </h1>
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
                <!-- <li><a href="recursosseccion1.php">Literatura Española</a></li>
                <li><a href="recursosseccion1.php">Literatura Iberoamericana</a></li>
                <li><a href="recursosseccion1.php">Literatura europea</a></li>
                <li><a href="recursosseccion1.php">Literatura estadounidense</a></li>
                --> 
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
            <p>Este formulario le ayudará a dar de alta una nueva sección. 
               Rellene los campos indicados. Preste atención a los campos 
               obligatorios.</p>
         
            <form enctype="multipart/form-data" method="POST" action="altaseccion2.php?bd=<?php echo $esta_bd; ?>" name="formu" onsubmit="return validar()" >

                <table style="text-align: left; width: 100%;">
                    <tr>
                        <th> <label for="titulo" >Título de la sección:</label> </th>
                        <th>
                            <input type="text"   id="titulo"  name="titulo"  />
                        </th>
                        
                    </tr>
                    <tr>
                        <th><label for="autor">Autor de la sección :</label></th>
                        <th>
                            <input type="text"  id="autor" name="autor"  />
                        </th>
                    </tr>
                    
                    <tr>
                        <th>(Comprobación) Esta sección pertenece a la biblioteca: </th>
                        <th><?php echo $esta_bd; ?>   </th>

                    </tr>
                    
                    

                </table>
              

                <div style="text-align: right;">
                <input type="submit" value="Enviar datos"/>
                </div>
                
            </form>


           



            

        </section>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
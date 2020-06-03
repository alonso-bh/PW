<!DOCTYPE html>
<head>
    <title>
        Editar una sección (paso final) 
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

    session_start(); 

    include 'funcionalidades.inc'; 

    $esta_bd = $_COOKIE['bd_actual']; 

    // guardar la seccion seleccionada en la fase del formulario anterior 
    $seccion_escogida = $_POST['la_seccion']; 
    

    // sacar el autor asociado a esta seccion para mostrarlo en el value del form
    $res = conexionBD("select autor from seccion where titulo='" . $seccion_escogida . "' " ); 

    foreach($res as $f){  
        $autor = $f['autor']; 
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
            <p>Acabe de completar este formulario para editar la sección "<?php echo $seccion_escogida;  ?>" y después pulse "Editar sección" para procesar los cambios. </p>
                     
            <form onsubmit="return validar()"  enctype="multipart/form-data" method="POST" action="editarseccion2.php?seccion=<?php echo $seccion_escogida; ?>" name="formu" >

                <table style="text-align: left; width: 100%;">
                    

                    <tr>
                        <th> <label for="titulo" >Título de la sección:</label> </th>
                        <th>
                            <input type="text"   id="titulo"  value="<?php echo $seccion_escogida; ?>"  name="titulo"  />
                        </th>
                        
                    </tr>
                    <tr>
                        <th><label for="autor">Autor de la sección :</label></th>
                        <th>
                            <input type="text"  id="autor" value="<?php echo $autor;  ?>" name="autor"  />
                        </th>
                    </tr>
                    
                    <tr>
                        <th>(Comprobación) Esta sección sigue perteneciendo a la biblioteca: </th>
                        <th><?php echo $esta_bd; ?>   </th>

                    </tr>
                    
                    

                </table>
              

                <div style="text-align: right;">
                <input type="submit" value="Modificar sección"/>
                </div>
                
            </form>


           



            

        </section>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
<!DOCTYPE html>
<head>
    <title>Gestor de bibliotecas digitales</title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>

<?php

    include 'funcionalidades.inc';

?>


<script type='text/javascript'>

function validar()
{
    var ok=true; 
    var cad = "Has cometido algunos errores en el formulario: \n"; 

    if (document.getElementById("nombre_").value.length == 0)
    {
        cad += "- Debes indicar tu nombre usuario. \n";
        ok = false;
    }
    if (document.getElementById("tu_contrasenia").value.length == 0)
    {
        cad += "- Debes indicar indicar la contraseña de acceso.\n" ;
        ok = false;
    }
    

    if (ok == false){
        alert(cad);
    }
    // AÑADIR A EDITAR_MIS_DATOS.PHP   --------------------¿¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡
    // devolver resultado (bien/mal) de la validación
    return ok; 
}

</script>



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
            <form id="sesion" action="login.php" method="POST" onsubmit="return validar()" action="login.php">
                <label for="nombre_" >Usuario:</label> <br>
                <input type="text" name="nombre_" id="nombre_" />
                <br> 
                <label for="tu_contrasenia" >Contraseña:</label> <br>
                <input type="password"  id="tu_contrasenia" name="clave_" />
                <br>
                <br>
                <input type="submit"  value="Iniciar sesión" id="boton_enviar" />                
            </form>
            <form action="darsedealta.php"> 
            <br>
                <input type="submit" value="Darse de alta"  >
            </form>
            <br>
        </section>
        
    </header>
    
    <!-- CUERPO ************************************* -->
    <main>
        <br>

        <!-- LATERAL IZDO (IMAGEN) ******************-->

        <section class="mitad" id="mitad_izda">
            <figure>
                <img src="imagenes/agua.jpg" class="imagen_lateral" />
            </figure>
        </section>

        <!-- LATERAL DCHO (BIBLIOTECAS) **************  -->

        <section class="mitad" id="mitad_dcha">
            Bibliotecas dadas de alta en el gestor 
            <br><br>

            <!--BIBLIOTECAS DIGITALES (representacion) -->

            <?php

                $resultado = conexionBD('select * from bd') ; 
                
                foreach ( $resultado as $fila ) {
                    $nombre_bd = $fila['nombre'];
                    $recursos = imprimir_recursos($nombre_bd); 
                    echo '   
                    
                    <article class="unabiblio">
                    <a href="previo_bd1.php?bd=' . $nombre_bd  . '" title="'   .  $recursos  .  '"     > <img class="im_biblio" src=" '.  $fila["imagen"]  . '  "  /> </a>
                        <p class="tit_biblio"> <a href="previo_bd1.php?bd=' . $nombre_bd  . '" > ' .   $nombre_bd  . ' </a>  </p>        
                    </article>
                    <br> '; 
                    
                }

            ?>
            
            


        </section>

    </main>


    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>
</body>
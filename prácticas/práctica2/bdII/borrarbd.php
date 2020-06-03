<!DOCTYPE html>
<head>
    <title>
        Borrar una biblioteca digital 
    </title>
    <link rel="stylesheet" type="text/css" href="estilos.css" />

</head>

<?php
    
    session_start(); 

    $esta_bd = $_GET['esta_bd'];
    //echo $esta_bd;  

?>


<body>

    <!-- CABECERA ************************************* -->
    <header>
     
        <section class="index_head1">
            <!--imagen logo pequeño-->
            <figure>
                <img src="imagenes/bib2.jpg" id="header_image" alt="logo.png" />        
            </figure>
        </section>


        <section id="index_head2">
            <h1>Gestor de bibliotecas digitales</h1>
        </section>
        

        <section class="index_head1" id="head3">
            <br>
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
                <?php   
                    if(isset($_SESSION['tu_nick'])) { 
                        echo $_SESSION['tu_nick']; 
                    }  
                    else {
                        echo "Usuario genérico"; 
                    }
                ?>
            <br>
        </section>
        
    </header>

    <!-- PRINCIPAL ------------------ -->

    <main style="clear: both;">
        <!-- CUADRO DEL FORMULARIO COMPLETO -->
        <section id="formulario_alta" style="text-align: center;">

            <p id="intro">Este formulario le ayudará a eliminar la biblioteca digital seleccionada. </p>
            
            <p> ¿Realmente quiere eliminar la biblioteca digital "<?php echo $esta_bd;  ?>"? </p>

            <form method="POST"  action="borrarbd2.php?aux=<?php echo $esta_bd; ?>"  enctype="multipart/form-data" >
                <input type="submit" value="Sí, eliminar biblioteca"/> 
            </form>

        </section>



    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
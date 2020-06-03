<!DOCTYPE html>
<head>
    <title>
        Cambia la información de tu cuenta 
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
        cad += "- Debes indicar el título del usuario. \n";
        ok = false;
    }
    if (document.getElementById("nick").value.length == 0)
    {
        cad += "- Debes indicar un identificativo (nick) para tu cuenta.\n" ;
        ok = false;
    }
    if (document.getElementById("pais").value.length == 0)
    {
        cad += "- Debes indicar tu país.\n" ;
        ok = false;
    }
    
    if ( document.getElementById("pass").value != document.getElementById("pass2").value  )
    {
        cad += "- Debes introducir la misma contraseña en ambos campos.\n";
        ok = false; 
    }
    if ( document.getElementById("pass").value.length < 5 )
    {
        cad += "- La contraseña debe tener como mínimo 5 caracteres.\n";
        ok = false; 
    }

    // comprobar email
    var expresion = /\w+@\w+\.+[a-z]/;
    var email = document.getElementById("correo").value;
    if (!expresion.test(email)){
        ok = false;
        cad += "- Tienes que introducir tu correo correctamente: user@dominio";
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

include './funcionalidades.inc' ; 

// obtener datos previos necesarios sobre el user a modificar (actual)

$res = conexionBD ("select * from usuario where nick='" . $_SESSION['tu_nick'] . "' " ) ;

foreach ($res as $item)
{
    $nombre = $item['nombre'] ;
    $email = $item['email'];
    $nick = $_SESSION['tu_nick'];
    $contrasena = $item['contrasena'];
    $pais = $item['pais']; 
}

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
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
            <?php  echo $_SESSION['tu_nick'];   ?>
            <br>
        </section>
        
    </header>


    <main style="clear: both;">
        <!-- CUADRO DEL FORMULARIO COMPLETO -->
        <section id="formulario_alta">

            <p id="intro">Este formulario le ayudará a modificar la información sobre su usuario. Modifique los campos deseados y después pulse "Enviar datos"</p>
        
            <form  onsubmit="return validar()" method="POST" action="editar_mis_datos2.php"   enctype="multipart/form-data" >
                
                <div id="subir"> 
                    <img src="imagenes/img_avatar.png" style="width: 80%;" > 
                </div>  
            
                <div id="resto">

                    <table style="text-align: left; width: 100%;">
                
                        <tr>
                            <th> <label for="titulo" >Nombre y apellidos:</label> </th>
                            <th>
                                <input type="text"  name="tu_nombre"  value='<?php echo $nombre ?>'    id="titulo" />
                            </th>
                            
                        </tr>
                       
                        <tr>
                            <th><label for="correo">Correo electrónico:</label></th>
                            <th>
                                <input type="text" name="tu_correo"  value="<?php  echo $email ?>"  id="correo"/>
                            </th>
                        </tr>

                        <tr>
                            <th><label for="nick" >Modifique su nombre de usuario en el gestor ("nick"):</label></th>
                            <th>
                                <input type="text" name="tu_nick_"  value="<?php  echo $nick ?>"  id="nick"/>
                            </th>
                        </tr>
                        <tr>
                            <th><label for="pass" >Modifique su contraseña:</label></th>
                            <th>
                                <input type="password" value="<?php echo $contrasena  ?>"   name="clave_nueva" id="pass"/>
                            </th>
                        </tr>
                        <tr>
                            <th><label for="pass2" >Repita la nueva contraseña:</label></th>
                            <th>
                                <input type="password" name="clave_nueva2"  id="pass2"/>
                            </th>
                        </tr>
                        
                        
                        <tr>
                            <th><label for="pais">País:</label></th>
                            <th>
                                <input type="text" name="pais_nuevo"  value="<?php  echo $pais ?>"  id="pais"/>
                            </th>
                        </tr>


                        
                    </table>
                
                    
                </div> 

                <div style="text-align: right;"    >
                    <input type="submit"  value="Enviar datos"/>
                </div>    

            </form>  

        </section>



    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
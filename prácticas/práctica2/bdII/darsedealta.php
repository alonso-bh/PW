<!DOCTYPE html>
<head>
    <title>
        Formulario para darse de alta 
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

if( isset($_GET['a_imprimir']) ){
    echo $_GET['a_imprimir']; 
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
            No se ha iniciado sesión 
            <br><br/>
        </section>
        
    </header>

    <!--  principal    -->

    <main style="clear: both;">
        <!-- CUADRO DEL FORMULARIO COMPLETO -->
        <form  onsubmit="return validar()" name="formulario_alta" id="formulario_alta" method="POST" action="darsedealta2.php" enctype="multipart/form-data" >

            <p id="intro">Este formulario le ayudará a darse de alta como usuario.</p>
        
            <div id="subir"> 
                <img src="imagenes/img_avatar.png" style="width: 80%;" > 
            </div>  
        
            <div id="resto">

                <table style="text-align: left; width: 100%;">
            
                    <tr>
                        <th> <label for="titulo" >Nombre y apellidos:</label> </th>
                        <th>
                            <input type="text"  name="tu_nombre"      id="titulo" />
                        </th>
                        
                    </tr>

                    <tr>
                        <th><label for="correo">Correo electrónico:</label></th>
                        <th>
                            <input type="text" name="tu_correo"   id="correo"/>
                        </th>
                    </tr>

                    <tr>
                        <th><label for="nick" >Introduzca un nombre de usuario en el gestor ("nick"):</label></th>
                        <th>
                            <input type="text" name="tu_nick_"   id="nick"/>
                        </th>
                    </tr>
                    <tr>
                        <th><label for="pass" >Introduzca su contraseña:</label></th>
                        <th>
                            <input type="password"   name="clave_nueva" id="pass"/>
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
                            <input type="text" name="pais_nuevo"  name="pais"  id="pais"/>
                        </th>
                    </tr>


                    
                </table>
            
                
            </div> 

            <div style="text-align: right;"    >
                <input type="submit"  value="Enviar datos"/>
            </div>    
        </form>



    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
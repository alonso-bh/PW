<!DOCTYPE html>
<head>
    <title>
        Modificar metadatos de una biblioteca digital 
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
        cad += "- Debes indicar el título de la biblioteca\n";
        ok = false;
    }
    if (document.getElementById("tu_nombre").value.length == 0)
    {
        cad += "- Debes indicar un autor.\n" ;
        ok = false;
    }
    if (document.getElementById("areatexto").value.length > 300)
    {
        cad += "- La longitud de la descripción ha de ser de 300 caracteres (espacios incluidos) como MÁXIMO.\n" ;
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

    include 'funcionalidades.inc' ;    

    
    // importante: extraer el nombre de la biblioteca actual para poder editar esa. 
    $esta_bd = $_GET["esta_bd"] ; 

    $res = conexionBD("select * from bd where nombre='" . $esta_bd . "' ") ;
    foreach($res as $fila)
    {         
        $titulo_actual     = $fila['nombre'];
        $autor             = $fila['autor'];
        $imagen            = $fila['imagen'] ; 
        $campo_cono        = $fila['campo_conocimiento'] ; 
        $descripcion_      = $fila['descripcion']; 
    }


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
            <h1>Gestor de bibliotecas digitales </h1>
        </section>
        

        <section class="index_head1" id="head3">
            <br>
            <img src="imagenes/img_avatar.png" alt="mi avatar"  id="icono_user"/>
            <br>
            <?php   echo $_SESSION['tu_nick'];   ?>
            <br>
        </section>
        
    </header>


    <main style="clear: left;">
         
        <!-- CUADRO DEL FORMULARIO COMPLETO -->

        <section id="formulario_alta"  >
             <p> Este formulario le ayudará a editar una biblioteca digital. Rellene los campos indicados. </p>
        
            <form  onsubmit="return validar()"  method="POST"  action="editarbd2.php?titulo_actual=<?php  echo $titulo_actual;  ?>"  enctype="multipart/form-data">
                <div id="subir">
                    <label for="#subirF" >Subir icono nuevo de la biblioteca</label> <br>
                    <input type="file" name="foto"   id="subirF"/>
                </div>

                <div id="resto" > 

                    <table style="text-align: left; width: 100%;">
                        <tr>
                            <th> <label for="titulo" >Título:</label> </th>
                            <th>
                                <input type="text"  value="<?php   echo $titulo_actual;   ?>"    name="titulo" id="titulo" />
                            </th>
                            
                        </tr>
                        <tr>
                            <th> <label for="tu_nombre" >Nombre y apellidos del autor:</label> </th>
                            <th>
                                <input type="text" name="tu_nombre"  value="<?php   echo $autor;   ?>"  id="tu_nombre" />
                            </th>                        
                        </tr>
                        <tr>
                            <th> <label for="campo_conoc" >Selecciona el campo de conocimiento del contenido de la biblioteca: </label> </th>
                            <th>
                                <select id="campo_conoc" value="<?php   echo $campo_cono;   ?>"  name="campo_cono" >
                                    <?php

                                        $resultado = conexionBD('select * from campos_conocimiento') ; 

                                        foreach($resultado as $fila )
                                        {
                                            echo '<option>' . $fila['nombre'] . '</option>' ; 
                                        }

                                    ?>


                                </select>
                            </th>                       
                        </tr>
                        

                    </table>
                
                    
                </div>

                <div id="descripcion">
                    <label for="areatexto" >Descripción (máximo: 300 caracteres): </label>
                    <br>
                    <textarea id="areatexto" name="areatexto" rows="8" cols="30" ><?php  echo $descripcion_ ; ?> </textarea>
                </div>


                <div  style="text-align: right;"  >
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
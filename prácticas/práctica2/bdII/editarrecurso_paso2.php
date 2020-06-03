<!DOCTYPE html>
<head>
    <title>
        Editar un recurso (paso segundo y último)
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
        cad += "- Debes indicar un titulo.\n" ;
        ok = false;
    }
    if (document.getElementById("autor").value.length == 0)
    {
        cad += "- Debes indicar un autor.\n" ;
        ok = false;
    }
    if (document.getElementById("areatexto").value.length > 300)
    {
        cad += "- La longitud de la descripción ha de ser de 300 caracteres (espacios incluidos) como MÁXIMO.\n" ;
        ok = false;
    }
    if (document.getElementById("tipo").value.length == 0)
    {
        cad += "- Selecciona un tipo de recurso. \n" ;
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

    include 'funcionalidades.inc'; 
    session_start();

    $esta_bd = $_COOKIE['bd_actual']; 

    $recurso = $_POST['titulo']; 


    // sacar campos actuales para mostrarlos en las cajas de texto:
    $autor_ = "-1"; $descripcion_ = "-1"; 
    $res_ = conexionBD("select * from recurso where nombre='" . $recurso . "'" ); 
    foreach($res_ as $fila )
    {
        $autor_ = $fila['autor'];
        $descripcion_ = $fila['descripcion']; 
        $seccion_ = $fila['seccion'];
        $tipo_ = $fila['tipo']; 
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
            <h1>  <?php echo  $esta_bd;  ?>  </h1>
        </section>
        
        <section class="index_head1" id="head3">
            <br>
            <img src="<?php echo $_COOKIE['imagen_bd'];  ?>" alt="mi avatar"  id="icono_user"/>
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

        <form id="formulario_alta"  onsubmit="return validar()" action="editarrecurso2.php?antiguo=<?php echo  $recurso ; ?>"  method="POST" name="formulario_alta" enctype="multipart/form-data" >
            <p>Acabe de completar el formulario para editar el recurso y después pulse "Enviar datos". </p>
        
            <div id="subir">
                <label for="#subirF" >Imagen</label> <br>
                <input type="file" name="foto"   id="subirF"/>
            </div>

            <div id="resto">

                <table  style="text-align: left; width: 100%;">
                    <tr>
                        <th> <label for="titulo" >Título: </label>  </th>
                        <th>
                            <input type="text" value="<?php  echo $recurso;  ?>" name="titulo" id="titulo"  />
                        </th>
                    </tr>
                    <tr>
                        <th><label for="autor">Autor:</label></th>
                        <th>
                            <input type="text"  value="<?php echo $autor_; ?>"  name="autor" id="autor"/>
                        </th>
                    </tr>
                    

                    <tr>
                        <th> <label for="tipo">Tipo de recurso: </label> </th>
                        <th>
                            <select id="tipo" name="tipo">
                                <?php

                                $resultado = conexionBD("select * from tipos_recursos"  ) ; 

                                foreach($resultado as $fila )
                                {
                                    if($tipo_ == $fila['nombre']){
                                        echo '<option selected>' . $fila['nombre'] . '</option>' ;
                                    }
                                    else{
                                        echo '<option>' . $fila['nombre'] . '</option>' ; 
                                    }
                                    
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
                <textarea id="areatexto"  name="areatexto" rows="8" cols="30"><?php  echo $descripcion_ ; ?> </textarea>
            </div>

            <div style="text-align: right;">
                <input type="submit" value="Enviar datos"/>
            </div>



            

        </form>

        


    </main>

    <!-- PIE   ************************************* -->

    <footer>
        
        <a href="contacto.html"  >Contacto</a> - <a href="como_se_hizo.pdf" >Cómo se hizo</a>
    </footer>


</body>
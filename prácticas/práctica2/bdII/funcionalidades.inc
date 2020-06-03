<?php 





/* CONEXIÓN A LA BASE DE DATOS PARA EJECUTAR OPERACIONES QUE  DEVUELVEN DATOS (select) */
function conexionBD ($sentencia)
{
    // conexión a la base de datos
    /** 1) configurar una conexión simple a la BD  */
    $mbd = "mysql:host=localhost;dbname=db76067525_pw1920"; 
    $usuario = "pw76067525";
    $contraseña = "76067525";

    /** 2) mandar la consulta  */
    $conexion = new PDO ($mbd, $usuario, $contraseña); 
    $consulta = $sentencia  ; 

    try { 
        $resultado = $conexion->query( $consulta ); 
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        return ($resultado);
    }
    catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); }
    
    
}


function imprimir_recursos($bd)
{
    $cad = ""; 
    $res3 = conexionBD("select recurso.nombre from recurso, seccion where recurso.seccion=seccion.titulo and  bd='" .  $bd  . "' "  );
    $cad = $cad. "RECURSOS CREADOS: "; 
    foreach($res3 as $f){
        $cad = $cad . $f['nombre'] . ". "; 
    }

    return $cad; 
}




// función para calcular el recurso siguiente (botón SIGUIENTE)
function funcion_siguiente($seccion_, $este_recurso_)
{
    // <a href="recurso1.html" > << Anterior </a>

    $siguiente = "";

    $res1 = conexionBD("select * from recurso where seccion='" .  $seccion_  . "'");
    $ok = 0; 
    $continuar = 1; 

    foreach($res1 as $fila){
        if($continuar == 1){ 
            if ($fila['nombre'] == $este_recurso_){  // no hay dos recursos de igual nombre en la misma seccion
                $ok = 1;
            }
            else if ($ok == 1){
                $siguiente = $fila['nombre'];
                $ok = 0;
                $continuar = 0; 
            }
        }
    }

    if ( strlen($siguiente) == 0)  {      // estamos en el ÚLTIMO recurso, no puede ir al Siguiente
        echo "";
    }
    else{
        echo '<a href="recurso1.php?este_recurso=' .  $siguiente . '">  Siguiente >> </a>' ; 
    }
}


function funcion_anterior ($seccion_, $este_recurso_){
    $res1 = conexionBD("select nombre from recurso where seccion='" .  $seccion_ . "'");
    $ok = 0;     

    $anterior = ""; 
    $continuar= 1;

    $i = 0; 
    foreach($res1 as $item)
    {
        
        if ($continuar == 1)
        {
            if ($i== 0){    // no se puede ir al recurso anterior (no existe) 
                $i++;
                $anterior = $item['nombre'];
            }
            else{  
                if ($item['nombre'] == $este_recurso_){   // recurso hallado
                    echo '<a href="recurso1.php?este_recurso=' .  $anterior . '"> << Anterior </a>' ; 
                    $continuar = 0; 
                }
                else{       // aun no he encontrado el recurso actual 
                    $anterior = $item['nombre'];  
                    $i++; 
                }
            }
        }
    }

    

    $anterior = ""; 
}




?> 
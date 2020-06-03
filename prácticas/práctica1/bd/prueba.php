<!DOCTYPE html>
<head>
    <title>
        titulo
    </title>
</head>

<body>
    Hola a todos!
    <?php
        echo "<p> Esto es una línea php </p>"; 
        $tiempo = 45;
        $cad = "    hola a todos ";
        echo "antes de borrar: >" . $cad . '\n' ; 
        $var = trim($cad);
        echo "sin espacios: ->" . $var . "<- ";

    ?>

    El tiempo se mide en <?php echo $tiempo ; ?> segundos. 


    Ejemplos con arrays :

    <?php

        $vector[] = "Granada"; 
        $vector[] = "Jaén";

        echo "array 1: "; 
        print_r($vector); 
        echo '</br>';

        $array2 = array(1,2,3,4,5);

        print_r($array2);
    ?>

    

</body>
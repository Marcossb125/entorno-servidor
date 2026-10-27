<?php
//Aplicacion nivel de dificultad: Se elige el numero de circulos entre 4 y 8 y el numero de colores entre 4 y 8
// colores: azul, rojo, verde, amarillo, naranja, rosa, morado, gris

$configuracion = sacarConfig();

$ncirculos = $configuracion['ncirculos'];

$ncolores = $configuracion['ncolores'];


    $colores = array("#0000FF", "#FF0000", "#00FF00", "#FFFF00", "#FFA500", "#FF69B4", "#800080", "#808080");

    function pintar_circulos(int $circulos, int $ncolores) {

        global $colores;

        global $ncirculos;

        global $ncolores;
        
        $presiDice = array();

        for ($k = 0; $k < $circulos; $k++) {
            $color = rand(0, ($ncolores - 1));
            array_push($presiDice, $colores[$color]);
        }

        print("<br> </br>");

        $_SESSION['ncolores'] = $ncolores;

        $_SESSION['ncirculos'] = $ncirculos;

        $_SESSION['combinacion'] = $presiDice;

        $_SESSION['colores'] = $colores;

        
    }
?>
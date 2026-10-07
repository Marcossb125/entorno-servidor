<?php
//Aplicacion nivel de dificultad: Se elige el numero de circulos entre 4 y 8 y el numero de colores entre 4 y 8
// colores: azul, rojo, verde, amarillo, naranja, rosa, morado, gris
    

    

    function pintar_circulo(int $circulos, array $colores) {
        global $colores;
        $presiDice = array();

        for ($k = 0; $k < $circulos; $k++) {
            $color = rand(0, (count($colores) -1));
            array_push($presiDice, $colores[$color]);
        }

        return $presiDice;
    }
?>
<?php
//Aplicacion nivel de dificultad: Se elige el numero de circulos entre 4 y 8 y el numero de colores entre 4 y 8
// colores: azul, rojo, verde, amarillo, naranja, rosa, morado, gris


    

    function pintar_circulo(int $circulos, array $colores, int $ncolores): array {
        
        $presiDice = array();

        for ($k = 0; $k < $circulos; $k++) {
            $color = rand(0, ($ncolores - 1));
            array_push($presiDice, $colores[$color]);
        }

        print("<br> </br>");

        $_SESSION['combinacion'] = $presiDice;

        $_SESSION['colores'] = $ncolores;

        $_SESSION['turno'] = 0;

        $_SESSION['combinacionUsuario'] = array();

        for ($k = 0; $k < $circulos; $k++) {
            array_push($_SESSION['combinacionUsuario'], "black");
        }

         $_SESSION['estado'] = true;

        var_dump($_SESSION['combinacion']);
        return $presiDice;

        
    }
?>
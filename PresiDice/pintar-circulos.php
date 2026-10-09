<?php
//Aplicacion nivel de dificultad: Se elige el numero de circulos entre 4 y 8 y el numero de colores entre 4 y 8
// colores: azul, rojo, verde, amarillo, naranja, rosa, morado, gris
session_start();

    

    function pintar_circulo(int $circulos, array $colores, int $ncolores): array {
        global $colores;
        $presiDice = array();

        for ($k = 0; $k < $circulos; $k++) {
            $color = rand(0, ($ncolores - 1));
            array_push($presiDice, $colores[$color]);
        }

        $_SESSION['combinacion'] = $presiDice;

        

        foreach ($colores as $circulo):

        
        print('<svg width="120" height="120">      
        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>"/></circle>
        </svg>');

        endforeach;


        return $presiDice;
    }
?>
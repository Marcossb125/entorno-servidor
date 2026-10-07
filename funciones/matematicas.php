<?php
$error = "";



function resolverEcuacion (int $a, int $b, int $c): array|bool|null {

    if ($a === 0) {
        $error = "La ecuación no es de segundo grado";
        return null;
    } else {
    $primeraParte = $b*$b - 4 * $a * $c;

        if ($primeraParte > 0) {
            $xa = (-$b + sqrt($primeraParte))/(2*$a);
                $xb = (-$b - sqrt($primeraParte))/(2*$a);

                $soluciones = array(
                    $xa,
                    $xb
                );
                return $soluciones;
            
        }
         
        return false;
     }
}

function resolverPalindromo (string $palabra): bool {
    $vuelta = strrev($palabra);

    if ($vuelta === $palabra) {
        return true;
    } else {
        return false;
    }
}

function resolverArrayNumeros (array|string $array, int|string $limite): array {

    $numeros = is_array($array) ? $array : [$array];
    $limite = (int) $limite;
    $reducido = array();

    foreach ($numeros as $numero) {
        $numero = (int) $numero;

        if ($numero <= $limite) {
            $reducido[] = $numero;
        }
    }

    return $reducido;

}
?>



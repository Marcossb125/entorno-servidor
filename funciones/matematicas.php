<?php
$a = null;
$b = null;
$c = null;

$xa = "";
$xb = "";

$peticion = "";

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $peticion = $_POST["peticion"];

    if ($peticion = "ecuacion") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        resolverEcuacion($a, $b, $c);
    }
}

function resolverEcuacion (string $a, string $b, string $c) {
    global $xa;
    global $xb;
    $xa = (-$b + sqrt($b*$b - 4 * $a * $c)/(2*$a));
    $xb = (-$b - sqrt($b*$b - 4 * $a * $c)/(2*$a));
}
?>



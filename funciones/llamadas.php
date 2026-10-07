<?php 


include __DIR__ . "/matematicas.php";

$resultado_ecuacion = null;
$resultado_palindromo = null;
$resultado_arrayNumeros = array();

$a = null;
$b = null;
$c = null;

$palabra = "";

session_start();
$arrayNumeros = $_SESSION["arrayNumeros"] ?? [];
$reducido = array();

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $peticion = $_POST["peticion"];
   

    if ($peticion === "ecuacion") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        $resultado_ecuacion = resolverEcuacion($a, $b, $c);
    } 
    if ($peticion === "palindromo") {
        $palabra = $_POST['palabra'];
        $resultado_palindromo = resolverPalindromo($palabra);
    }
    if ($peticion === "arrayNumeros") {
        $n = $_POST["añadir"];
        $limite = $_POST["limite"];
        array_push($arrayNumeros, $n);
        $_SESSION["arrayNumeros"] = $arrayNumeros;

        if ($_POST["limite"]) {
            $resultado_arrayNumeros = resolverArrayNumeros($arrayNumeros, $limite);
            $reducido = $resultado_arrayNumeros;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="matematicas.css">
</head>
<body>
    <div class="contenedor-principal">
        <div class="centro">
            <h1>Ecuacion segundo grado</h1>

            <span class="error"><?php echo "$error" ?> </span>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input id = "a", name="a", value="<?php if ($a != null) {echo $a;}?>"></input>
                <label>x²</label>

                <input id = "b", name="b", value="<?php if ($b != null) {echo $b;}?>"></input>
                <label>x</label>

                <input id = "a", name="c", value="<?php if ($c != null) {echo $c;}?>"></input>

                <input type="hidden" id="peticion" name="peticion" value="ecuacion"></input>

                <button type="submit">Calcular</button>

            </form>

            <h2>Resultado</h2>

            <?php

        

            if (is_array($resultado_ecuacion)) {
                for ($k = 0; $k < 2; $k++) {
                print($resultado_ecuacion[$k]);
                }
            } else if (!$resultado_ecuacion) {
                print("FALSE");
            }
            ?>
        </div>
        <div class="centro">
            <h1>Detector de palindromos</h1>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                <input id = "palabra" name="palabra" value="<?php echo $palabra;?>"> </input>

                <input type="hidden" id="peticion" name="peticion" value="palindromo"></input>

                <button type="submit">Comprobar</button>
            </form>

            <?php
            if ($resultado_palindromo !== null) {
                if ($resultado_palindromo) {
                    print("La palabra es un palindromo");
                } else {
                    print("La palabra no es un palindromo");
                }
            }
            ?>
        </div>

        <div class="centro">
            <h1>Numeros limite</h1>

            <h3 class="error">Ve añadiendo los numeros uno a uno en la casilla de arrays, pulsando el botón de añadir para que se vayan sumando al array y cuando ya esten todos añade el limite en la casilla de limite y pulsa otra vez el boton</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <label>Numero</label>
                <input id="añadir" name="añadir" type="number"></input>
                <br></br>
                <label>Limite</label>
                <input id="limite" name="limite" type="number"></input>

                <br></br>

                <label><?php foreach ($arrayNumeros as $numero) { print("$numero, "); } ?></label>

                <br></br>

                <input type="hidden" name="peticion" id="peticion" value="arrayNumeros"></input>

                <button type="submit">Meter numero/Terminar</button>
            </form>

            <h1>Array reducido:</h1>

            <p><?php if (count($reducido) > 0) { foreach ($reducido as $numero) { print("$numero, "); } } ?></p>
        </div>
    </div>
</body>
</html>
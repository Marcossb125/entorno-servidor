<?php include "pintar-circulos.php"; include "mostrarCombinacion.php"; include "comprobacion.php"; include "bd.php"; include "cookies.php" ?>

<?php

if (isset($_COOKIE['nºcirculos'])) {
    $circulos=$_COOKIE['nºcirculos'];
} else {
    crearCookie("nºcirculos", 7);
    $circulos=$_COOKIE['nºcirculos'];
}

if (isset($_COOKIE['color'])) {
    $color=$_COOKIE['color'];
}

session_start();


$nColores=4;



?>

<!DOCTYPE html>
<html lang="en" style="background-color:<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="estilos.css">
</head>
<body>
    
    
    <div class="centrar" >
    <h1>Bienvenido a simon dice, *-*</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Numero de circulos</label>
        <input type="number" name="circulos" id="circulos" min="4" max="8" value ="<?php echo $circulos ?>"></input>

        <br></br>

        <label>Numero de colores</label>
        <input type="number" name="colores" id="colores" min="4" max="8" value ="<?php echo $nColores ?>"></input>
        

        <button type="submit">Enviar</button>
    </form>

     <br></br>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Cookie color:</label>
        <input name="colorFondo" value=<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>></input>
        <button type="submit">Cambiar</button>
    </form>

    <?php 
    $colores = array("#0000FF", "#FF0000", "#00FF00", "#FFFF00", "#FFA500", "#FF69B4", "#800080", "#808080");
    $colores2 = array("azul", "rojo", "verde", "amarillo", "naranja", "rosa", "púrpura", "gris");
    
    $colorCirculos = array(); 

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

        if (isset($_POST['color'])) {
            $_SESSION['combinacionUsuario'][$_SESSION['turno']] = $_POST['color'];
            print("<br> </br>");
            $_SESSION['turno']++;

            if ($_SESSION['turno'] === count($_SESSION['combinacion'])) {
                if (comprobar()) {
                    print("FELICIDADES, HAS GANADO");
                    $_SESSION['estado'] = false;

                } else {
                    print("HAS PERDIDO");
                    $_SESSION['estado'] = false;
                }
            }
        } else if (isset($_POST['usuario'])) {
           // guardarUsuario($_POST['usuario'], $_POST['password']);
        } else if (isset($_POST['colorFondo'])) {

            crearCookie("color", $_POST['colorFondo']);

        } else {
            
        $circulos = $_POST['circulos'];
        $nColores = $_POST['colores'];

        $colorCirculos = pintar_circulo($circulos, $colores, $nColores);
        

        
        }
    }

    ?>

    <?php if (isset($_SESSION['estado']) && $_SESSION['estado'] === true): ?>
    

    <br></br>

        <div class="circulos">
    <?php foreach ($_SESSION['combinacionUsuario'] as $circulo): ?>

        
        <svg width="120" height="120">      
        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
        </svg>
    <?php endforeach; ?>

    </div>

    <br></br>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <?php for ($k = 0; $k < $_SESSION['colores']; $k++): ?>

    <button name="color" style="background-color:<?php  echo $colores[$k]; ?>" name="<?php echo $colores2[$k] ?>" value="<?php echo $colores[$k] ?>"> <?php echo $colores2[$k] ?></button>

    <?php endfor; ?>

    </form>

    <?php endif; ?>

    <br></br>

    <a href="login.php">volver a login</a>
    
    </div>
    
    
    
    
</body>
</html>
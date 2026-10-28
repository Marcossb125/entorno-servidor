<?php
session_start();
    if (!isset($_SESSION['estado'])) {
        header("Location: presiDice1.php");
    }

    if ($_SESSION['estado'] === false) {
        header("Location: resultado.php");

    }
    var_dump($_SESSION);

    $colores2 = array("azul", "rojo", "verde", "amarillo", "naranja", "rosa", "púrpura", "gris");

    if (isset($_POST['color'])) {
        $_SESSION['combinacionUsuario'] [$_SESSION['turno']] = $_POST['color'];
        $_SESSION['turno']++;

        if ($_SESSION['turno'] === $_SESSION['ncirculos']) {
            $_SESSION['estado'] = false;
            header("Location: resultado.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../estilos.css">
</head>
<body>

    <div class="centrar">
        <div class="circulos">
            <?php foreach ($_SESSION['combinacionUsuario'] as $circulo): ?>

        
                <svg width="120" height="120">      
                <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
                </svg>
            <?php endforeach; ?>

        </div>

        <br></br>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <?php for ($k = 0; $k < $_SESSION['ncolores']; $k++):?>

    <button name="color" style="background-color:<?php  echo $_SESSION['colores'][$k]; ?>" value="<?php echo $_SESSION['colores'][$k]; ?>"> <?php echo $colores2[$k] ?></button>

    <?php endfor; ?>

    </form>
    </div>
    
</body>
</html>
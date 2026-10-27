<?php include "logica/comprobacion.php"; include "logica/inicializador.php";
    session_start();

    if (isset($_POST['resetear'])) {
        resetear();
        header("Location: presiDice1.php");
    } else if ($_POST['cerrar']) {
        session_destroy();
        header("Location: login.php");
    } else {

        if (!isset($_SESSION['estado'])) {
            header("Location: presiDice1.php");
        } else if ($_SESSION['estado'] === true) {
            header("Location: presiDiceJugar.php");
        } else {
            $victoria = comprobar();
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
        <?php if ($victoria): ?>
            <h1>Has ganao chaval, toma una piruleta</h1>

            <br></br>

            <h2>Combinacion:</h2>
            <div class="circulos">
                <?php foreach ($_SESSION['combinacion'] as $circulo): ?>

        
                    <svg width="120" height="120">      
                        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
                    </svg>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <h1>Has perdio chaval</h1>

            <br></br>

            <h2>Combinacion</h2>
            <div class="circulos">
                <?php foreach ($_SESSION['combinacion'] as $circulo): ?>

        
                    <svg width="120" height="120">      
                        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
                    </svg>
                <?php endforeach; ?>

            </div>

            <br></br>

            <h2>Tu combinacion</h2>
            <div class="circulos">
                <?php foreach ($_SESSION['combinacionUsuario'] as $circulo): ?>

        
                    <svg width="120" height="120">      
                        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
                    </svg>
                <?php endforeach; ?>

            </div>

            <?php endIf;?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button name="resetear">Volver a jugar</button>
            </form>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button name="cerrarr">Cerrar sesión</button>
            </form>
    </div>
</body>
</html>
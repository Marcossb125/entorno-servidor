<?php include "../privao/configuracion.php"; include "logica/pintar-circulos.php"; include "logica/inicializador.php"; include "../privao/seguridad.php";

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../auth/login.php");
        exit;
    }
    filtro();

    var_dump($_SESSION);

    if (isset($_SESSION['estado'])) {
        header("Location: presiDiceJugar.php");
    }

    
    if (!isset($_SESSION['combinacion'])) {
        pintar_circulos($ncirculos, $ncolores);
    }

    if (isset($_POST['comenzar'])) {
        inicio();
        header("Location: presiDiceJugar.php");
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muestra</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../estilos.css">
</head>
<body>

    <div class="centrar">
        <h1>WELCOME TO THE PRESIDENT MARK YISUS SAYS</h1>

        <p1>Memoriza la combinacion antes de continuar</p1>
    

    <br></br>
        <?php if (isset($_SESSION['combinacion'])): ?>

    <div class="circulos">
    <?php foreach ($_SESSION['combinacion'] as $circulo): ?>

        
        <svg width="120" height="120">      
        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>" stroke="black" stroke-width="4"/>
        </svg>
    <?php endforeach; ?>

    </div>

    <br></br>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button name="comenzar">Comenzar</button>
    </form>
    <?php endif; ?>
    </div>
    
</body>
</html>
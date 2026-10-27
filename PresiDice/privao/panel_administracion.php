<?php include "configuracion.php"; include "seguridad.php";
    session_start();
    if (isset($_SESSION['usuario'])) {
        header("Location: ../juego/presiDice1.php");
    }
    filtro(true);

    $config = sacarConfig();

    $circulos = $config['ncirculos'];

    $ncolores = $config['ncolores'];

    if (isset($_POST['ncirculos'])) {
        guardarConfig($_POST['ncirculos'], $_POST['ncolores']);

        $circulos = $_POST['ncirculos'];
        $ncolores = $_POST['ncolores'];
    }

?>


<!DOCTYPE html>
<html lang="en" style="background-color:<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../estilos.css">
</head>
<body>
    
    
    <div class="centrar">
    <h1>Bienvenido a simon dice, administrador *-*</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Numero de circulos</label>
        <input type="number" name="ncirculos" id="circulos" min="4" max="8" value ="<?php echo $circulos ?>"></input>

        <br></br>

        <label>Numero de colores</label>
        <input type="number" name="ncolores" id="colores" min="4" max="8" value ="<?php echo $ncolores ?>"></input>
        

        <button type="submit">Enviar</button>
    </form>

     <br></br>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Cookie color:</label>
        <input name="colorFondo" value=<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>></input>
        <button type="submit">Cambiar</button>
    </form>

    </div>
</body>
</html>
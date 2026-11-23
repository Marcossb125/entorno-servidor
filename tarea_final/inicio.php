<?php require_once "seguridad.php"; require_once "funciones.php"; require_once "configuracion.php";



filtro();

$config = sacarConfig();

if (!isset($_SESSION['emojis'])) {
$SESSION['emojisDispo'] = emojisDisponibles($config['max_emojis']);
}


if (isset($_POST['cambio_cantidad'])) {
    $_SESSION['emojis'] = emojisDisponibles(count($_SESSION['emojis'])+1);
}

if (isset($_POST['grabar'])) {
    print("funciona");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Agenda de contactos</h1>
    
    <br></br>

    <p> Usuario: <?php echo $_SESSION['usuario']['nombre']?></p>

    <p> Emojis disponibles: <?php echo count($_SESSION['emojis'])?></p>

    <br></br>
    <?php foreach ($_SESSION['emojis'] as $emoji):?>
        <span> <?php echo $emoji ?> </span>
    <?php endForeach;?>
    <br></br>
    <form action="inicio.php" method="post">
        <button name="cambio_cantidad" value=1>Incrementar</button>
        <button name="grabar">Grabar</button>
    </form>
    <br></br>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
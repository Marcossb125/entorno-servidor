<?php declare(strict_types=1); require_once "seguridad.php"; require_once "funciones.php"; require_once "configuracion.php"; require_once "usuarios.php";

filtro();

$config = sacarConfig();

if (!isset($_SESSION['contactos_restantes'])) {
    $_SESSION['contactos_restantes'] = $config['max_contactos'] - sacarContactos($_SESSION['usuario']['id']);
}

if (!isset($_SESSION['emojisDispo'])) {
    $_SESSION['emojisDispo'] = emojisDisponibles((int)$config['max_emojis']);
}

if (!isset($_SESSION['emojis']) || $_SESSION['emojis'] === []) {
    $_SESSION['emojis'] = array();
    array_push($_SESSION['emojis'], emojiAleatorio($_SESSION['emojisDispo']));
    $_SESSION['contactos_restantes']--;
}


if (isset($_POST['cambio_cantidad'])) {
    array_push($_SESSION['emojis'], emojiAleatorio($_SESSION['emojisDispo']));
    $_SESSION['contactos_restantes']--;
    
}

if (count($_SESSION['emojis']) >= $config['max_lote'] || $_SESSION['contactos_restantes'] <= 0) {
        header('Location: agenda.php');
        exit;
    }

if (isset($_POST['grabar'])) {
    header('Location: agenda.php');
    exit;
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
    <a href="salir.php">Cerrar sesión</a>
</body>
</html>
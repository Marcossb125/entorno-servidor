<?php declare(strict_types=1); require_once 'seguridad.php'; require_once 'conexion.php'; require_once 'cierre.php';

    filtro();

    $codigousu = (int) $_SESSION['usuario']['id'];
    $error = "";

    if (isset($_SESSION['contactos_guardar'])) {
        $contactos = $_SESSION['contactos_guardar'];

        $contactosGrabados = count($contactos);

        $conexion = conectarBD();

        $conexion ->beginTransaction();

    try {

        $sql = "INSERT INTO contactos (codigousu, nombre, apellidos, telefono, email, emoji, fecha) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conexion->prepare($sql);

    foreach ($contactos as $contacto) {
        $stmt->execute([
            $codigousu,
            $contacto['nombre'],
            $contacto['apellidos'],
            $contacto['telefono'],
            $contacto['email'],
            $contacto['emoji']
        ]);
    }

    $conexion->commit();

    $stmtContactos = $conexion->prepare("SELECT COUNT(*) FROM contactos WHERE codigousu = ?");
    $stmtContactos->execute([$codigousu]);
    $contactosUsuario = (int) $stmtContactos->fetchColumn();
    
    unset($_SESSION['emojis'], $_SESSION['contactos_guardar'], $_SESSION['emojisDispo'], $_SESSION['contactos_restantes']);
} catch (PDOException $e) {
        $conexion->rollBack();
        $error = "No se pudieron guardar los contactos en la base de datos.";
} finally {
        cerrar($conexion);

}

} else {
        header('Location: inicio.php');
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
    <h1>AGENDA DE CONTACTOS</h1>
    <p>Usuario: <?php echo $_SESSION['usuario']['nombre']?></p>

    <?php if ($error !== ""):?>
        <p><?php echo $error?></p>

    <?php else:?>
        <p>Se han grabado <?php echo $contactosGrabados ?> contactos en tu agenda</p>
        <p>Tu agenda tiene ahora <?php echo $contactosUsuario; ?> contactos</p>

    <?php endif;?>

    <a href="inicio.php">Grabar más contactos</a>
    <a href="totales.php">Ver totales</a>
    <a href="salir.php">Cerrar sesión</a>
</body>
</html>



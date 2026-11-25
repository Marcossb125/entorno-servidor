<?php declare(strict_types=1); require_once "usuarios.php";
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php"); 
    exit;
}

$mensaje = "";

if (isset($_POST['nombreR'], $_POST['password'])) {
    try {
        $nombre = trim($_POST['nombreR']);
        $password = trim($_POST['password']);

    if ($nombre === "" || $password === "") {
        $mensaje = "Los campos no pueden estar vacíos.";
    } else {
        if (guardarUsuario($nombre, password_hash($password, PASSWORD_ARGON2ID))) {
            header("Location: inicio.php");
            exit;
        }
    }
    } catch (Exception $e) {
        $mensaje = "No se pudo guardar el usuario";
    }
}
    
?>

<form action="registro.php" method="post">
    <label>Nombre</label>
    <input name="nombreR" required>

    <br></br>

    <label>Contraseña</label>
    <input type="password" name="password" required>

    <br></br>

    <button type="submit">Registrarse</button>
</form>
<?php if ($mensaje !== ""): ?>
    <p style="color: red;"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
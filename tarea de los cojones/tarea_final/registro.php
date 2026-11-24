<?php include "usuarios.php";

//if (isset($_SESSION['usuario'])) {}

$mensaje = "";

if (isset($_POST['nombreR'], $_POST['password'])) {
    try {
        if (guardarUsuario($_POST['nombreR'], password_hash($_POST['password'], PASSWORD_BCRYPT))) {
            header("Location: inicio.php");
            exit;
        }
    } catch (Exception $e) {
        $mensaje = "No se pudo guardar el usuario";
    }
}
    
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
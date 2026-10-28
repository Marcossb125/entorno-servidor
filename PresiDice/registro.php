<?php include "usuarios.php";

$mensaje = "";

if (isset($_POST['nombreR'], $_POST['password'])) {
    try {
        if (guardarUsuario($_POST['nombreR'], password_hash($_POST['password'], PASSWORD_BCRYPT))) {
            header("Location: login.php");
        }
    } catch (PDOException $e) {

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
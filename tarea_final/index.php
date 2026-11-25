<?php declare(strict_types=1);
    session_start();
    require_once "usuarios.php";
    if (isset($_SESSION['usuario'])) {
        header("Location: inicio.php");
        exit;
    }
        $err = "";

        if (isset($_POST['usuario'], $_POST['password'])) {
            if (revisarUsuario($_POST['usuario'], $_POST['password'])) {
                if ((int) $_SESSION['usuario']['rol'] === 1) {
                    header('Location: admin.php');
                    exit;
                } else {
                    header('Location: inicio.php');
                    exit;
                }
            } else {
                $err = "Nombre de usuario o contraseña incorrectos.";
            }
        } else if (isset($_POST['register'])) {
            header("Location: registro.php");
            exit;
        }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="centrar"> 
        <h1>Agenda de contactos</h1>

        <div>

            <form action="index.php" method="post">

                <label>Nombre de usuario</label>
                <input id = "usuario" name="usuario"></input>

                <br></br>

                <label>Contraseña</label>
                <input type="password" id="password" name="password"></input>

                <br></br>

                <button type="submit">Entrar</button>
            </form>
            <?php if ($err != ""): ?>
                <p style="color: red;"><?php echo $err; ?></p>
            <?php endif; ?>

            <form action="index.php" method="post">
                <button name="register">Registrarse</button>
            </form>

        </div>
    </div>

    
</body>
</html>
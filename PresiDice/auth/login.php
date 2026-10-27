<?php include "usuarios.php";
    if (isset($_SESSION['usuario'])) {
        header("Location: ../juego/presiDice1.php");
    }
        $err = "";

        if (isset($_POST['usuario'])) {
            if (revisarUsuario($_POST['usuario'], $_POST['password'])) {
                header("Location: ../juego/presiDice1.php");
                exit;
            } else {
                $err = "Nombre de usuario o contraseña incorrectos.";
            }
        } else if (isset($_POST['register'])) {
            header("Location: registro.php");
            exit;
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


        <div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label>Nombre de usuario</label>
                <input id = "usuario" name="usuario"></input>

                <br></br>

                <label>Contraseña</label>
                <input type="password" id="password" name="password"></input>

                <br></br>

                <input type="hidden" id = "origen" name="origen" value="erPresi"></input>

                <button type="submit">Login</button>
            </form>
            <?php if ($err != ""): ?>
                <p style="color: red;"><?php echo $err; ?></p>
            <?php endif; ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button name="register">Registrarse</button>
            </form>

        </div>
    </div>

    
</body>
</html>
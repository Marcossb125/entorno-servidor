<?php 
        $usuario = "pepe";

        $password = password_hash("1234", PASSWORD_BCRYPT);

        $err = "";

        if (isset($_POST['usuario'])) {
            if ($usuario === $_POST['usuario'] && password_verify($_POST['password'], $password)) {
                header("Location: presiDice.php");
            } else {
                $err = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }
        } else if (isset($_POST['register'])) {
            header("Location: registro.php");
        }
    ?>
<!DOCTYPE html>
<html lang="en" style="background-color:<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="estilos.css">
</head>
<body>
    <div class="centrar"> 


        <div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label>Nombre de usuario</label>
                <input id = "usuario" name="usuario"></input>

                <label>Contraseña</label>
                <input type="password" id="password" name="password"></input>

                <input type="hidden" id = "origen" name="origen" value="erPresi"></input>

                <button type="submit">Login/Register</button>
            </form>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button name="register">Registrarse</button>
            </form>

        </div>
    </div>

    
</body>
</html>
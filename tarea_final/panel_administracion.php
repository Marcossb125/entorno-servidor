<?php require_once "configuracion.php"; require_once "seguridad.php"; require_once "usuarios.php";
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit;
    }

    filtro(true);
    //filtro(true);

    

    $config = sacarConfig();

    $max_lote = $config['max_lote'];

    $max_emojis = $config['max_emojis'];

    $max_contactos = $config['max_contactos'];

    $err="";

    if (isset($_POST['max_lote'])) {
       $err = guardarConfig($_POST['max_lote'], $_POST['max_emojis'], $_POST['max_contactos']);

       if ($err === "") {

        $max_lote = $_POST['max_lote'];

        $max_emojis = $_POST['max_emojis'];

        $max_contactos = $_POST['max_contactos'];

       }
    }

    $usuarios = sacarDatosUsuarios();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="estilos.css">
</head>
<body>
    
    
    <div class="centrar">
    <h1>Bienvenido a la agenda de contactos, administrador *-*</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Contactos por lote (3,8)</label>
        <input type="number" name="max_lote" id="max_lote" min="3" value ="<?php echo $max_lote ?>" required></input>

        <br></br>

        <label>Emojis disponibles (4, 10)</label>
        <input type="number" name="max_emojis" id="max_emojis" min="4" value ="<?php echo $max_emojis ?>" required></input>

        <label>Máximo de contactos por usuario (10, 100)</label>
        <input type="number" name="max_contactos" id="max_emojis" min="10" value ="<?php echo $max_contactos ?>" required></input>

        <br></br>
        
        <button type="submit">Enviar</button>
    </form>

     <br></br>

    
    <a href="cerrar_sesion.php">Cerrar sesion</a>
    <p class="error"><?php echo $err?></p>
        <div class="centrar">
        <table class="tabla">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Contactos</th>
            </tr>
            <?php foreach($usuarios as $usuario):?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['rol']; ?></td>
                    <td><?php echo $usuario['contactos']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
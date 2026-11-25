<?php declare(strict_types=1); require_once "funciones.php"; require_once "seguridad.php";
filtro();

    if (!isset($_SESSION['emojis'])) {
        header ('Location: inicio.php');
        exit;
    };

    $erroresContactos = [];
    $hayErrores = false;

    if (isset($_POST['grabar'])) {
        $nEmojis = count($_SESSION['emojis']);
        $contactos_a_pasar = array();

        for ($i = 0; $i < $nEmojis; $i++) {
            $contacto = $_POST['contactos'][$i];
            $errores = validarContacto($contacto);
            array_push($erroresContactos, $errores);
            if ($errores !== []) {
                $hayErrores = true;
            } else {
                array_push($contactos_a_pasar,[
                    'nombre' => trim($_POST['contactos'][$i]['nombre']),
                    'apellidos' => trim($_POST['contactos'][$i]['apellidos']),
                    'email' => trim($_POST['contactos'][$i]['email']),
                    'telefono' => trim($_POST['contactos'][$i]['telefono']),
                    'emoji' => $_SESSION['emojis'][$i]
                ]);
            }
        }

        if (!$hayErrores) {
            $_SESSION['contactos_guardar'] = $contactos_a_pasar;
            header('Location: grabado.php');
            exit;
        }
    }
?>


<p> Usuario: <?php echo $_SESSION['usuario']['nombre']?></p>

<br></br>

<?php
if (!isset($_POST['grabar']) || $hayErrores) {
$html = '<form action="agenda.php" method="post">';

for ($i = 0; $i <= count($_SESSION["emojis"])-1; $i++) {
    $valores = isset($_POST['contactos'][$i]) ? $_POST['contactos'][$i] : [];
    $errores = $erroresContactos[$i] ?? [];
    $html = $html . pintarFormularioContacto($i, $_SESSION["emojis"][$i], $valores, $errores);
}
$html = $html . "<button name='grabar'>Grabar contactos</button></form>";

print($html);
}
?>

<br></br>

<a href="salir.php">Cerrar sesión</a>
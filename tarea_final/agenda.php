<?php require_once "funciones.php";
    session_start();

     if (isset($_POST['grabar'])) {
    print("hola");
    foreach ($_POST['contactos'] as $contacto) {
        var_dump($contacto);
    }
 }
?>


<p> Usuario: <?php echo $_SESSION['usuario']['nombre']?></p>

<br></br>

<?php 
$html = '<form action="agenda.php" method="post">';

for ($i = 0; $i <= count($_SESSION["emojis"])-1; $i++) {
    $html = $html . (pintarFormularioContacto($i, $_SESSION["emojis"][$i], [], [])); 
}
$html = $html . "<button name='grabar'>Grabar contactos</button></form>";

print($html);



?>

<br></br>

<a href="cerrar_sesion.php">Cerrar sesión</a>
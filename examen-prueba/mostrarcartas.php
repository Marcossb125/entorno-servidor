<?php
    session_start();
    $_SESSION['cartaslev'] = 0;
    $_SESSION['cartalev'] = 0;

    

    if (!isset($_SESSION['combinacion']) || $_SESSION['combinacion'] === null) {
    
    
    $cartas = array(2, 2, 3, 3, 5, 5);

    shuffle($cartas);

    $_SESSION['combinacion'] = $cartas;

    }

    if (isset($_POST['levantar'])) {
        $_SESSION['cartalev'] = (int) $_POST['levantar'];
    }

?>



<h1>Bienevnid@, <?php echo $_SESSION['login']?></h1>

<br></br>

<h2>Cartas levantadas: </h2>
<input type="text" value="<?php echo $_SESSION['cartaslev']?>" disabled>

<form action = "mostrarcartas.php" method="post">

<button name="levantar" value="1">Levantar carta 1</button>
<button name="levantar" value="2">Levantar carta 2</button>
<button name="levantar" value="3">Levantar carta 3</button>
<button name="levantar" value="4">Levantar carta 4</button>
<button name="levantar" value="5">Levantar carta 5</button>
<button name="levantar" value="6">Levantar carta 6</button>

</form>

<form action="mostrarcartas.php" method="post">
    <label> Cartas levantadas: </label>
    <input name="carta1"></input>
    <input name="carta2"></input>

    <button type="submit">Comprobar</button>

</form>

<?php for($k = 0; $k < 6; $k++):?>
    <img width="100" height="150" src="materiales/<?php if ($_SESSION['cartalev'] !== $k+1) { echo "bocaabajo.jpg"; } else { echo "copas0" . $_SESSION['combinacion'][$k] . ".jpg"; } ?>"/>
<?php endfor;?>


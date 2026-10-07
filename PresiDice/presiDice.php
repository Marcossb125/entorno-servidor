<?php include "pintar-circulos.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Presi dice:</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Numero de circulos</label>
        <input type="number" name="circulos" id="circulos" placeholder="4" min="4" max="8"></input>

        <br></br>

        <label>Numero de colores</label>
        <input type="number" name="colores" id="colores" placeholder="4" min="4" max="8"></input>

        <button type="submit">Enviar</button>
    </form>

    <?php 
    $colores = array("#0000FF", "#FF0000", "#00FF00", "#FFFF00", "#FFA500", "#FF69B4", "#800080", "#808080");
    
    $colorCirculos = array(); 

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $circulos = $_POST['circulos'];
        $colorCirculos = pintar_circulo($circulos, $colores);

        print_r($colorCirculos);
    }

    ?>

    <?php foreach ($colorCirculos as $circulo): ?>

        <circle cx="60" cy="60" r="50" fill="red"/></circle>

    <?php endforeach; ?>

    
    
</body>
</html>
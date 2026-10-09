<?php include "pintar-circulos.php"; include "mostrarCombinacion.php" ?>

<?php 
session_start();


$circulos=4;
$nColores=4;
$usuario = $usuario = $_GET['nombre'];;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienevnido al presi manda, <?php echo $usuario ?> *-*</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Numero de circulos</label>
        <input type="number" name="circulos" id="circulos" min="4" max="8" value ="<?php echo $circulos ?>"></input>

        <br></br>

        <label>Numero de colores</label>
        <input type="number" name="colores" id="colores" min="4" max="8" value ="<?php echo $nColores ?>"></input>

        <button type="submit">Enviar</button>
    </form>

    <?php 
    $colores = array("#0000FF", "#FF0000", "#00FF00", "#FFFF00", "#FFA500", "#FF69B4", "#800080", "#808080");
    
    $colorCirculos = array(); 
    $negro = array();

    


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
        $circulos = $_POST['circulos'];
        $nColores = $_POST['colores'];

        $colorCirculos = pintar_circulo($circulos, $colores, $nColores);

        

        $_SESSION['combinacionUsuario'] = array();
        

        for ($k = 0; $k < $circulos; $k++) {
            array_push($negro, "black");
        }
    }

    ?>

    <?php 
            mostrarCombinacion();
    ?>

    <br></br>

    <?php foreach ($negro as $circulo): ?>

        
        <svg width="120" height="120">      
        <circle cx="60" cy="60" r="50" fill="<?php echo $circulo; ?>"/></circle>
        </svg>
            
    <?php endforeach; ?>

    

    
    
</body>
</html>
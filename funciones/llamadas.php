<?php 

include __DIR__ . "/matematicas.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link <link rel="stylesheet" type="text/css" media="screen" href="matematicas.css">
</head>
<body>
    <div class="center">
        <h1>Ecuacion segundo grado</h1>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <input id = "a", name="a", value="<?php if ($a != null) {echo $a;}?>"></input>
            <label>x²</label>

            <input id = "b", name="b", value="<?php if ($b != null) {echo $b;}?>"></input>
            <label>x</label>

            <input id = "a", name="c", value="<?php if ($c != null) {echo $c;}?>"></input>

            <input type="hidden" id="peticion" name="peticion" value="ecuacion"></input>

            <button type="submit">Calcular</button>

        </form>

        <h2>Resultado</h2>

        <?php
        if (!empty($xa) && empty($xb)) {
        print("sumando el resultado es $xa");
        print("restando el resultado es $xb");
        } else {
            print("holi");
            print($xa);
        }
        ?>
    </div>

</body>
</html>
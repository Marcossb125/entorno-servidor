<?php include "../privao/jugadas.php";
    $jugadores = sacarDatosJugadores();
    $totalAciertos = 0;
    foreach ($jugadores as $jugador) {
        $totalAciertos += (int) $jugador['aciertos'];
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../estilos.css">
</head>
<body>
    <div class="centrar">
        <table class="tabla">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Aciertos</th>
                <th>Gráfico</th>
            </tr>
            <?php foreach($jugadores as $jugador):?>
                <?php $anchoBarra = $totalAciertos > 0 ? ((int) $jugador['aciertos'] / $totalAciertos) * 100 : 0; ?>
                <tr>
                    <td><?php echo $jugador['id']; ?></td>
                    <td><?php echo $jugador['nombre']; ?></td>
                    <td><?php echo $jugador['aciertos']; ?></td>
                    <td>
                        <div class="barra-aciertos-fondo">
                            <div class="barra-aciertos" style="width: <?php echo number_format($anchoBarra, 2, '.', ''); ?>%"></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
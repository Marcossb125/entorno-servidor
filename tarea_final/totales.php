<?php declare(strict_types=1); require_once 'seguridad.php'; require_once 'conexion.php';

filtro(false, true);


    $conexion = conectarBD();

    $usuarios = array();

    $sql = "SELECT users.codigo, users.nombre, COUNT(contactos.id) as numContactos, MAX(contactos.fecha) AS fecha_ultimoC from usuarios users LEFT JOIN contactos ON users.codigo = contactos.codigousu GROUP BY users.codigo, users.nombre ORDER BY numContactos DESC";
    $stmt = $conexion->query($sql);
    $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalContactos = 0;
    foreach ($filas as $fila) {
        $totalContactos = $totalContactos + (int) $fila['numContactos'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>AGENDA---Totales</h1>
    <p><?php echo $_SESSION['usuario']['nombre']?>, estos son los contactos guardados:</p>

    <table>
        <thead>
            <tr>
                <th>Cód.</th>
                <th>Nombre</th>
                <th>Cont.</th>
                <th>%</th>
                <th>Último alta</th>
                <th>Gráfica</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filas as $usuario): ?>
                <?php
                    $cod = (int) $usuario['codigo'];
                    $nombre = (string) $usuario['nombre'];
                    $cont = (int) $usuario['numContactos'];
                    $porcentaje = ($totalContactos > 0) ? ($cont / $totalContactos) * 100 : 0.0;
                    $fecha = ($usuario['fecha_ultimoC'] !== null) ? date('d/m/Y', strtotime((string) $usuario['fecha_ultimoC'])) : '';
                    $esElUsuario = ($cod === (int) $_SESSION['usuario']['id']);
                ?>
                <tr class="<?= $esElUsuario ? 'resaltado' : '' ?>">
                    <td><?= $cod ?></td>
                    <td><?= $nombre ?></td>
                    <td><?= $cont ?></td>
                    <td><?= number_format($porcentaje, 1, ',', '.') ?></td>
                    <td><?= $fecha ?></td>
                    <td>
                        <div class="barra-fondo">
                                <div class="barra-relleno" style="width: <?= number_format($porcentaje, 1, '.', '') ?>%;"></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <a href="inicio.php">Grabar más contactos</a> |
    <a href="salir.php">Cerrar sesión</a>
            
</body>
</html>

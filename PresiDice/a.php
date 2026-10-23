<?php session_start(); include "bd.php"; include "cierre.php" ?>



<?php 
    $conexion = conectarBD();

    $sql = "INSERT INTO usuarios (Nombre, Clave, Rol) VALUES (:nom, :clave, :rol)";

    $stmt = $conexion->prepare($sql);
    $stmt -> execute([
        ':nom' => "Presi",
        ':clave' => "Presi",
        ':rol' => 0
    ]);

    $conexion = cerrar($conexion);

    /*
    $sql = "SELECT Codigo, Nombre, Clave, Rol FROM usuarios";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    while ($fila = $stmt->fetch()) {
 
 $codigo = htmlspecialchars($fila['Codigo']);
 $nombre = htmlspecialchars((string)$fila['Nombre']);
 $clave = htmlspecialchars((string)$fila['Clave']);
 $rol = htmlspecialchars($fila['Rol']);

 echo "ID: {$fila['Codigo']} | Nombre: $nombre | Clave: $clave | Rol: $rol <br>";

    }

    $conexion = cerrar($conexion);



    */
?>

<img src="SI.jpg"></img>


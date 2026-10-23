<?php include "bd.php"; include "cierre.php";
    function registrar ($nombre, $password) {
        $conexion = conectarBD();

        $sql = "";

        $sql = "INSERT INTO usuarios (Nombre, Clave, Rol) VALUES (:nom, :clave, :rol)";

        $stmt = $conexion->prepare($sql);
        $stmt -> execute([
        ':nom' => $nombre,
        ':clave' => $password,
        ':rol' => 0
        ]);

    $conexion = cerrar($conexion);
    }
?>
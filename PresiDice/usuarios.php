<?php include "bd.php"; include "cierre.php";
    
function guardarUsuario($nombre, $password) {
        $conexion = conectarBD();
        $sql = "SELECT COUNT(Codigo) FROM usuarios WHERE Nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        if ($stmt->fetchColumn() > 0) {
            throw new Exception("El nombre de usuario ya existe.");
        }

        $sql2 = "INSERT INTO usuarios (Nombre, Clave, Rol) VALUES (:nom, :clave, :rol)";

        $stmt = $conexion->prepare($sql2);
        return $stmt->execute([
            ':nom' => $nombre,
            ':clave' => $password,
            ':rol' => 0
        ]);
    }

    function revisarUsuario($nombre, $password) {
        $conexion = conectarBD();
        $sql = "SELECT Clave FROM usuarios WHERE Nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) {
            return false;
        }

        $claveGuardada = $fila['Clave'];
        if (password_verify($password, $claveGuardada)) {
            return true;
        }

        if (hash_equals($claveGuardada, $password)) {
            $stmt = $conexion->prepare(
                "UPDATE usuarios SET Clave = :clave WHERE Nombre = :nom"
            );
            $stmt->execute([
                ':clave' => password_hash($password, PASSWORD_BCRYPT),
                ':nom' => $nombre
            ]);
            return true;
        }

        return false;
    }

    function buscarSiHayUsuario($nombre) {
        $conexion = conectarBD();
        $sql = "SELECT COUNT(*) FROM usuarios WHERE Nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        return $stmt->fetchColumn() > 0;
    }

?>
<?php include "../privao/bd.php"; include "../privao/cierre.php";

session_start();
    
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

        $hash = $fila['Clave'];
        if (password_verify($password, $hash)) {
            $_SESSION['usuario'] = array(
                "nombre" => $fila['Nombre'],
                "rol" => $fila['rol']
            );
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
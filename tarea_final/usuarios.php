<?php declare(strict_types=1); require_once "conexion.php"; require_once "cierre.php";
    
function guardarUsuario($nombre, $password) {
        $conexion = conectarBD();
        
        $sql = "SELECT COUNT(codigo) FROM usuarios WHERE nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        if ($stmt->fetchColumn() > 0) {
            throw new Exception("El nombre de usuario ya existe.");
        }

        $sql2 = "INSERT INTO usuarios (nombre, pwd, rol) VALUES (:nom, :pwd, :rol)";

        $stmt = $conexion->prepare($sql2);
        
        
        $correcto = $stmt->execute([
            ':nom' => $nombre,
            ':pwd' => $password,
            ':rol' => 0
        ]);

        
        session_regenerate_id(true);
        $_SESSION['usuario'] = array(
                "id" => $conexion->lastInsertId(),
                "nombre" => $nombre,
                "rol" => 0
            );

            cerrar($conexion);
            return $correcto;
    }

    function revisarUsuario($nombre, $password) {
        $conexion = conectarBD();
        $sql = "SELECT codigo, pwd, nombre, rol FROM usuarios WHERE nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) {
            return false;
        }

        $hash = $fila['pwd'];
        if (password_verify($password, $hash)) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = array(
                "id" => $fila['codigo'],
                "nombre" => $fila['nombre'],
                "rol" => $fila['rol']
            );
            return true;
        }
        cerrar($conexion);
        return false;
    }

    function buscarSiHayUsuario($nombre) {
        $conexion = conectarBD();
        $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);
        cerrar($conexion);
        return $stmt->fetchColumn() > 0;
    }

    function sacarDatosUsuarios () {
        $conexion = conectarBD();

        $usuarios = array();

        $sql = "SELECT users.codigo, users.nombre, users.rol, COUNT(contactos.id) as numContactos from usuarios users LEFT JOIN contactos ON users.Codigo = contactos.codigousu GROUP BY users.codigo, users.nombre, users.rol ORDER BY users.codigo";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        while ($fila = $stmt->fetch()) {

        array_push($usuarios, array(
        "id" => (int) $fila['codigo'],
        "nombre" => htmlspecialchars((string)$fila['nombre']),
        "rol" => (int) $fila['rol'],
        "contactos" => (int) $fila['numContactos']));

        }

        cerrar($conexion);
        return $usuarios;
    }

    function sacarContactos ($codigo) {
        $conexion = conectarBD();

        $usuarios = array();

        $contactos = 0;

        $sql = "SELECT COUNT(id) as numContactos FROM contactos WHERE codigousu = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$codigo]);
        
        while ($fila = $stmt->fetch()) {

        $contactos = (int) $fila['numContactos'];

        }

        cerrar($conexion);
        return $contactos;

    }

?>
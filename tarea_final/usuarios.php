<?php require_once "bd.php"; require_once "cierre.php";
    
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

        $sql2 = "INSERT INTO usuarios (nombre, passwrd, rol) VALUES (:nom, :pwd, :rol)";

        $stmt = $conexion->prepare($sql2);
        cerrar($conexion);

        revisarUsuario($nombre, $password);
        
        return $stmt->execute([
            ':nom' => $nombre,
            ':pwd' => $password,
            ':rol' => 1
        ]);
    }

    function revisarUsuario($nombre, $password) {
        $conexion = conectarBD();
        $sql = "SELECT codigo, passwrd, nombre, rol FROM usuarios WHERE nombre = :nom";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nom' => $nombre
        ]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) {
            return false;
        }

        $hash = $fila['passwrd'];
        if (password_verify($password, $hash)) {
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

        $sql = "SELECT users.codigo, users.nombre, users.rol, COUNT(contactos.id) as numContactos from usuarios users LEFT JOIN contactos ON users.Codigo = contactos.codigousu GROUP BY users.codigo, users.nombre ORDER BY users.codigo";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        while ($fila = $stmt->fetch()) {

        array_push($usuarios, array(
        "id" => htmlspecialchars($fila['codigo']),
        "nombre" => htmlspecialchars((string)$fila['nombre']),
        "rol" => htmlspecialchars((string)$fila['rol']),
        "contactos" => htmlspecialchars((string)$fila['numContactos'])
        ));

        }

        cerrar($conexion);
        return $usuarios;
    }

?>
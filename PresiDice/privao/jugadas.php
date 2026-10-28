<?php include "bd.php"; include "cierre.php";
    function guardarJugada ($uId, $acierto) {
        $conexion = conectarBD();

        $sql = "INSERT INTO jugadas (codigousu, acierto) VALUES (:id, :acierto)";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ":id" => $uId,
            ":acierto" => $acierto
        ]);

        cerrar($conexion);
    }

    function sacarDatosJugadores () {
        $conexion = conectarBD();

        $usuarios = array();

        $sql = "SELECT users.Codigo, users.Nombre, SUM(juego.acierto) as aciertos from usuarios users JOIN jugadas AS juego ON users.Codigo = juego.codigousu GROUP BY users.Codigo, users.Nombre ORDER BY users.Codigo";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        while ($fila = $stmt->fetch()) {

        array_push($usuarios, array(
        "id" => htmlspecialchars($fila['Codigo']),
        "nombre" => htmlspecialchars((string)$fila['Nombre']),
        "aciertos" => htmlspecialchars((string)$fila['aciertos'])
        ));
        }
        return $usuarios;
    }
?>
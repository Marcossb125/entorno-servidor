<?php require_once "bd.php"; require_once "cierre.php";

    function guardarConfig ($max_lote, $num_emojis, $max_contactos) {

        if ($max_lote < 3 || $max_lote > 8) {
            return "Los contactos por lote solo pueden ser entre 3 y 8";
        }
        if ($num_emojis < 4 || $max_lote > 10) {
            return "Los emojis disponibles solo pueden ser entre 4 y 10";
        }
        if ($max_contactos < 10 || $max_lote > 100) {
            return "Los contactos por usuario solo pueden ser entre 10 y 100";
        }
        $conexion = conectarBD();

        $sql = "UPDATE configuracion SET max_lote= :maxLote, num_emojis = :maxEmojis, max_contactos = :maxContactos WHERE id=1";

        
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':maxLote' => $max_lote,
            ':maxEmojis' => $num_emojis,
            ':maxContactos' => $max_contactos
        ]);

        

       $conexion = cerrar($conexion);
       return "";
    }
    
    function sacarConfig () {
        $conexion = conectarBD();
        $sql = "SELECT max_lote, num_emojis, max_contactos FROM configuracion";

        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        $configuracion = array("max_lote" => $fila['max_lote'], "max_emojis" => $fila['num_emojis'], "max_contactos" => $fila['max_contactos']);

        
        cerrar($conexion);
        return $configuracion;
    }

?>
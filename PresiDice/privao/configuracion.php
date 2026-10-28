<?php include "bd.php"; include "cierre.php";

    function guardarConfig ($ncirculos, $ncolores) {
        $conexion = conectarBD();

        $sql = "UPDATE config SET nCirculos = :ncirculos, nColores = :ncolores WHERE id=0";

        
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([
            ':ncirculos' => $ncirculos,
            ':ncolores' => $ncolores
        ]);

        

       $conexion = cerrar($conexion);
    }
    
    function sacarConfig () {
        $conexion = conectarBD();
        $sql = "SELECT ncirculos, ncolores FROM config";

        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        $configuracion = array("ncirculos" => $fila['ncirculos'], "ncolores" => $fila['ncolores']);

        

        return $configuracion;
    }

?>
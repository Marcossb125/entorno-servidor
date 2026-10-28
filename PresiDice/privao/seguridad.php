<?php 

    function filtro ($admin_requerido = false) {
        $rol = (int) $_SESSION['usuario']["rol"];

        if ($admin_requerido && $rol !== 1) {
            header("Location: ../juego/presiDice1.php");
            exit;
        }

        if (!$admin_requerido && $rol === 1) {
            header("Location: ../privao/panel_administracion.php");
            exit;
        }
    }
?>
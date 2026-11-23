<?php 

session_start();

    function filtro ($admin_requerido = false) {
        $rol = (int) $_SESSION['usuario']["rol"];

        if ($admin_requerido && $rol !== 1) {
            header("Location: inicio.php");
            exit;
        }

        if (!$admin_requerido && $rol === 1) {
            header("Location: panel_administracion.php");
            exit;
        }
    }
?>
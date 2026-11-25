<?php declare(strict_types=1);

session_start();

    function filtro ($admin_requerido = false, $esTotales = false) {

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit;
    }
     if (!$esTotales) {
        $rol = (int) $_SESSION['usuario']["rol"];

        if ($admin_requerido && $rol !== 1) {
            header("Location: inicio.php");
            exit;
        }

        if (!$admin_requerido && $rol === 1) {
            header("Location: admin.php");
            exit;
        }
    }
    }
?>
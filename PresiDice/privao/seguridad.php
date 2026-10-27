<?php 

    function filtro ($admin_requerido = false) {
        $rol = $_SESSION['usuario']['rol'];

        if ($rol === 1 && $admin_requerido) {
            header("Location: panel_administracion.php");
        }

        if ($rol !== 1 && !$admin_requerido) {
            header("Location: presiDice1.php");
        }

    }
?>
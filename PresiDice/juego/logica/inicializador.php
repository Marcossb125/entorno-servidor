<?php
    function inicio () {

        $_SESSION['turno'] = 0;

        $_SESSION['combinacionUsuario'] = array();

        for ($k = 0; $k < count($_SESSION['combinacion']); $k++) {
            array_push($_SESSION['combinacionUsuario'], "black");
        }

         $_SESSION['estado'] = true;
    }
    
    function resetear () {
        unset($_SESSION['turno']);

        unset($_SESSION['combinacionUsuario']);

        unset($_SESSION['estado']);

        unset($_SESSION['combinacion']);

        unset($_SESSION['colores']);
    }
?>
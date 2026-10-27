<?php 
    function comprobar (): bool {
       $jugada = $_SESSION['combinacionUsuario'];

       $combinacion = $_SESSION['combinacion'];

       $_SESSION['estado'] = false;

       if ($combinacion === $jugada) {
            return true;
       }

       return false;
       }
    
?>
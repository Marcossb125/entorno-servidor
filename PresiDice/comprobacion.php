<?php 
    function comprobar (): bool {
       $jugada = $_SESSION['combinacionUsuario'];

       $combinacion = $_SESSION['combinacion'];

       if ($combinacion === $jugada) {
            return true;
       }

       return false;
       }
    
?>
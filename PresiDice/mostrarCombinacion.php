<?php 
session_start();

$combinacion = $_SESSION['combinacion'];

function mostrarColores () {
    global $combinacion;
    var_dump($combinacion);

}
?>
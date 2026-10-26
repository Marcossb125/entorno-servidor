<?php
    function conectarBD() {
        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $bd = "bdsimon";
        $puerto = "3306";

        $dsn = "mysql:host=$host;port=$puerto;dbname=$bd;charset=utf8mb4";

        try {

        $conexion = new PDO($dsn, $usuario, $contrasena);

        return $conexion;

        } catch (PDOException $e) {
            throw $e;
        }

        
    }

    

    
?>
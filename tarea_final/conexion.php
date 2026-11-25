<?php declare(strict_types=1);
    function conectarBD() {
        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $bd = "AGENDA";
        $puerto = "3306";

        $dsn = "mysql:host=$host;port=$puerto;dbname=$bd;charset=utf8mb4";
        $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

        try {

        $conexion = new PDO($dsn, $usuario, $contrasena, $opciones);

        return $conexion;

        } catch (PDOException $e) {
            die("Error de conexión");
        }

        
    }

    

    
?>
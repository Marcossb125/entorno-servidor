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

        /* if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        } */

        return $conexion;

        } catch (PDOException $e) {
            throw $e;
        }

        
    }

    

    function guardarUsuario($nombre, $password) {
        $conexion = conectarBD();
        $sql = "INSERT INTO usuario (nombre, password) VALUES ($nombre, $password)";
        $stmt = $conexion->query($sql);
        $stmt->bind_param("ss", $nombre, $password);
        $stmt->execute();
        $stmt->close();
        $conexion->close();
    }
?>
<?php 
    function crearCookie (string $nombreCookie, $value) {
        setcookie($nombreCookie, $value, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'domain' => 'localhost',
        'secure' => false, // Poner true en producción con HTTPS
        'httponly' => true, // Inaccesible desde JavaScript (Protección Anti-XSS)
        'samesite' => 'Lax' // Protección Anti-CSRF
        ]);
    }
?>
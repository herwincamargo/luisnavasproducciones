<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'usuario');
define('DB_PASS', 'contraseña');
define('DB_NAME', 'luisnavas_producciones');

try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

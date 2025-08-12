<?php
// --- CONFIGURACIÓN PARA SERVIDOR COMPARTIDO ---

// 1. Datos de la Base de Datos
define('DB_HOST', 'sdb-87.hosting.stackcp.net');
define('DB_USER', 'lnavasusr');
define('DB_PASS', 'npmyg0jkth');
define('DB_NAME', 'lnavas-353131330d34');

// 2. Conexión a la Base de Datos
try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // No mostrar errores detallados en producción por seguridad
    die("Error: No se pudo conectar a la base de datos.");
}

// 3. Funciones (si las hubiera)
include_once 'functions.php';

?>

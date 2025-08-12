<?php
define('DB_HOST', 'sdb-87.hosting.stackcp.net');
define('DB_USER', 'lnavasusr');
define('DB_PASS', 'npmyg0jkth');
define('DB_NAME', 'lnavas-353131330d34');

try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

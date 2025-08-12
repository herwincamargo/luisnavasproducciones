<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');

if (file_exists($path)) {
    return false; // serve the requested resource as-is.
}

// If the file does not exist, include the main index file.
// This allows for clean URLs and a single entry point.
require_once 'index.php';
?>

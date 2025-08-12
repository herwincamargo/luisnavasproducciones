<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: eventos.php');
exit;
?>

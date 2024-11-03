<?php
session_start();
require '../config.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
header('Location: dashboard.php');
?>

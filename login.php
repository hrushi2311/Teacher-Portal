<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare('SELECT * FROM teachers WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && $password == $user['password']) {
    $_SESSION['teacher_id'] = $user['id'];
    header('Location: home.php');
} else {
    echo 'Invalid credentials';
}
?>

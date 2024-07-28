<?php
session_start();
require 'db.php';
require 'helpers.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (login($pdo, $username, $password)) {
    redirect('home.php');
} else {
    echo 'Invalid credentials';
}
?>

<?php
function redirect($url) {
    header("Location: $url");
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['teacher_id']);
}

function login($pdo, $username, $password) {
    $stmt = $pdo->prepare('SELECT * FROM teachers WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        $_SESSION['teacher_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout() {
    session_start();
    session_unset();
    session_destroy();
    redirect('index.php');
}
?>

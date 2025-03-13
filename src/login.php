<?php

require_once 'config.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['lemail']; 
    $password = $_POST['lpassword'];

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (!$password === $user['password']) {
            $_SESSION['log-error'] = 'Error: Incorrect password!';
        } else {
            setcookie("id", $email, time() + (86400 * 30), "/");
            setcookie("role", $user['role'], time() + (86400 * 30), "/");
        }
    } else {
        $_SESSION['log-error'] = 'Error: Email does not exist!';
    }

    $stmt->close();
    header("Location: access.php");
    exit();
}
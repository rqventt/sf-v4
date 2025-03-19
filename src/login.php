<?php

require_once 'config.php';
session_start();

// ================================================================================================================================ LOGIN FORM
if (isset($_POST['login'])) {
    $email = trim($_POST['lemail']);
    $password = trim($_POST['lpassword']);

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (
            ($user['role'] === 'regular' && ($user['password'] !== decrypt($password) ||
            (($user['role'] === 'admin' || $user['role'] === 'superadmin') && $password !== $user['password'])))
        ) {
            $_SESSION['log-error'] = 'Error: Incorrect password!';
        } else {
            setcookie("id", $email, time() + (86400 * 30), "/");
            setcookie("role", $user['role'], time() + (86400 * 30), "/");
        }
        
    } else {
        $_SESSION['log-error'] = 'Error: Email does not exist!';
    }

    $stmt->close();
    $_SESSION['activeForm'] = 'loginform';
    header("Location: access.php");
    exit();
}

// ================================================================================================================================ REGISTER FORM
if (isset($_POST['register'])) {
    $username = trim($_POST['rusername']);
    $name = trim($_POST['rname']);
    $email = trim($_POST['remail']);
    $password = encrypt(trim($_POST['rpassword']));

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. "6LdIQ_UqAAAAAPeuiqN1wgrqQQHvRkU_9Uh9s00p" .'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        if($responseData->success) {
            $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['reg-error'] = 'Error: Email already exists!';
            } else if (!str_ends_with($email, '@umak.edu.ph')) {
                $_SESSION['reg-error'] = 'Error: Email must be a UMak email!';
            } else {
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO accounts (username, name, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $username, $name, $email, $password);
                $stmt->execute();
                $stmt->close();
                
                setcookie("id", $email, time() + (86400 * 30), "/");
                setcookie("role", "regular", time() + (86400 * 30), "/");
            }
        } else {
            $_SESSION['reg-error'] = 'Error! Robot verification failed, please try again.';
        }
    } else {
       $_SESSION['reg-error'] = 'Error! Please check the reCAPTCHA checkbox.'; 
    }

    $_SESSION['activeForm'] = 'regisform';
    header("Location: access.php");
    exit();
}

// ================================================================================================================================ FORGET PASSWORD FORM
if (isset($_POST['fpw'])) {
    $email = trim($_POST['femail']); 
    $stmt = $conn->prepare('SELECT * FROM accounts WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if(!isset($_POST['g-recaptcha-response']) && empty($_POST['g-recaptcha-response'])) {
        $_SESSION['fpw-error'] = 'Error! Please check the reCAPTCHA checkbox.'; 
    } else {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. "6LfGZvUqAAAAALrlsjkqmD6h6af0PzZVIe33yB7M" .'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        if(!$responseData->success) {
            $_SESSION['fpw-error'] = 'Error! Robot verification failed, please try again.';
        } else {
            if (!$result->num_rows > 0) {
                $_SESSION['fpw-error'] = 'Error! Email does not exist.';     
            } else {
                $otp = rand(100000, 999999);
                setCookie('otp', $otp, time() + 300, '/');

                $headers = [
                    'MIME-Version' => '1.0',
                    'Content-Type' => 'text/html; charset=UTF-8',
                    'From' => 'Scholar Finds <no-reply@scholarfinds.com>',
                    'Reply-To' => 'no-reply@scholarfinds.com',
                ];

                $message = file_get_contents('fpw-email.php');
                $message = str_replace('not generated', $otp, $message);
                $message = str_replace('no-time', '5 MINUTES', $message);

                mail(
                    $email,
                    'Scholar Finds OTP',
                    $message,
                    $headers
                );
            }
        }
    }

    header("Location: fpw.php");
    exit();
}

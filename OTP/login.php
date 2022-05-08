<?php
require('./config.php');
 
use RobThreeAuthTwoFactorAuth;
 
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    var_dump($_POST);
 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tfaCode = $_POST['tfa_code'];
 
    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue('email', $email);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);
    
    var_dump($user);
    
    if ($user) {
        $passwordHash = $user['password'];
        if (password_verify($password, $passwordHash)) {
            $tfa = new TwoFactorAuth();
            if (!$user['secret'] || $tfa->verifyCode($user['secret'], $tfaCode)) {
                $_SESSION['user_id'] = $user['id'];
                header('location:/profile.php');
                exit();
            } else {
                echo "Code 2FA invalide";
            }
        } else {
            echo "Identifiants invalides";
        }
    } else {
        echo "Identifiants invalides";
    }
}
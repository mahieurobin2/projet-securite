<?php
require('./config.php');
 
use RobThreeAuthTwoFactorAuth;
$tfa = new TwoFactorAuth();
 
if (empty($_SESSION['tfa_secret'])) {
    $_SESSION['tfa_secret'] = $tfa->createSecret();
}
$secret = $_SESSION['tfa_secret'];
 
if (empty($_SESSION['user_id'])) {
    header('location:/');
    exit();
}
 
if (!empty($_POST['tfa_code'])) {
    if ($tfa->verifyCode($secret, $_POST['tfa_code'])) {
        $q = $db->prepare('UPDATE users SET secret = :secret WHERE id = :id');
        $q->bindValue('secret', $secret);
        $q->bindValue('id', $_SESSION['user_id']);
        $q->execute();
    } else {
        echo "Code invalide";
    }
}
 
$userReq = $db->prepare('SELECT * FROM users WHERE id = :id');
$userReq->bindValue('id', $_SESSION['user_id']);
$userReq->execute();
$user = $userReq->fetch(PDO::FETCH_ASSOC);
 
?>
<h1>Votre profil</h1>
 
<a href="/logout.php">Déconnexion</a>
<?php var_dump($user) ?>
 
<h2>Activation Double Authentification</h2>
 
<?php if (!$user['secret']): ?>
    <p>Code secret : <?= $secret ?></p>
    <p>QR Code :</p>
    <img src="<?= $tfa->getQRCodeImageAsDataUri('Tuto', $secret) ?>">
    <form method="POST">
        <input type="text" placeholder="Vérification Code" name="tfa_code">
        <button type="submit">Valider</button>
    </form>
<?php else: ?>
    <p>2FA activée</p>
<?php endif ?>
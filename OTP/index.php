<form action="register.php" method="POST">
    <input name="email" type="email" placeholder="Email" /><br />
    <input name="password" type="password" placeholder="Mot de passe" /><br />
    <button type="submit">Inscription</button>
</form>
<?php
public function encodePassword( $raw, $salt ) {
    return hash('sha256', $salt.$raw);
}
?>
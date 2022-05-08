<?php
$host = "localhost:8888";
$user_mysql = "root"; 
$password_mysql = ""; 
$database = "injection";
$db = mysqli_connect($host, $user_mysql, $password_mysql,
$database);
if(!$db)
{
echo "Echec de la connexion\n";
exit();
}
mysqli_set_charset($db, "utf8");
?>
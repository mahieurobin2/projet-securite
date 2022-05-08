<?php
require('./config.php');
 
$_SESSION = [];
session_destroy();
header('location:/');
exit();
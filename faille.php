<?php
     foreach($_POST as $cle=>$val){
         $_POST[$cle]=stripslashes($val);
    }
    print_r($_POST);
?>

<!DOCTYPE html>
<html>
<head>
<meta hhtp-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Faille</title>
</head>
<body>
<form action="faille.php" method="post">
<textarea  name="com"></textarea>
<input type="submit" value="envoyer" />
</form>
</body>
</html>
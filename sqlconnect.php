<!DOCTYPE >
<html>
    <head>
        <title></title>
        <style>
            input 
            {
                display: block;
            }
        </style>
    </head>
    <body>
        <h1> Connexion </h1>

        <?php
        if (!empty($_GET['username'] && ! empty($_GET['password'])))
        {
            $username = $_GET['username'];
            $password = $_GET['password'];

            $query = "SELECT id, username FROM users WHERE username = '".$username."'";
            $rs = mysqli_query($db, $query);

            if(mysqli_num_rows($rs) == 1)
            {
                $user = mysqli_fetch_assoc($rs);
                echo "Bienvenue ".htmlspecialchars($user['username']);
            }
            else
            {
                echo "Mauvais nom d'utilisateur et/ou mot de passe !";
            }

            mysqli_free_result($rs);
            mysqli_close($db);
        }
        ?>

<form action="connection.php" method="GET">
<b>Nom d'utilisateur :</b> <input type="text"
name="username"/>
<b>Mot de passe :</b> <input type="text"
name="password" />
<input type="submit" value="Connexion" />
</form>
</body>
</html>
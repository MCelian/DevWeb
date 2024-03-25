<?php
    session_start();

    
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/login.js"></script>
    <title>Connexion</title>
</head>

<body>
<link rel="stylesheet" href="../css/style.css">
<?php include('../html/header.html'); ?>
<?php include('../html/nav.html'); ?>
    <main>
        <form action="login.php" method="post">
            <h1>Bienvenue</h1>
            <div id="formulaire">
                <label><b>Identifiant : </b></label>
                <input type="text" placeholder="Entrez votre identifiant" name="username" required>
                <br>
                <label><b>Mot de passe : </b></label>
                <input type="password" placeholder="Entrez votre mot de passe" name="password" required>
                <br>
                <button type="submit">Se connecter</button>
            </div>
            <div>
                <a href="../html/Inscription.html">Pour vous inscrire cliquez ici</a>
            </div>
        </form>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>
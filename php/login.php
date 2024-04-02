<?php
    session_start();
    if(! isset($_SESSION['categorie'])) require('../php/varSession.inc.php');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/form.js"></script>
    <title>Lafleur : Connexion</title>
</head>

<body>
<?php include('../php/header.php'); ?>
<?php include('../php/nav.php'); ?>
    <main>
        <h1>Bienvenue</h1>
        <form action="form.php" method="post" id="loginForm">
            <table id="loginTable">
                <tr>
                    <td><label for="username">Identifiant : </label></td>
                    <td><input type="email" name="username" placeholder="monmail@monsite.org"></td>
                </tr>
                <tr>
                    <td><label for="password">Mot de passe : </label></td>
                    <td><input type="password" name="password" placeholder="Entrez votre mot de passe"></td>
                </tr>
                <tr>
                    <input type="hidden" name="action" value="login">
                    <td colspan="2"><input type="submit" value="Connexion" onclick="return checkConnexion()"></td>
                </tr>
            </table>
            <div>
                <a href="../php/inscription.php">Pour vous inscrire cliquez ici</a>
            </div>
        </form>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>
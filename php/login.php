<?php
    session_start();
    if(!isset($_SESSION['categorie'])) require('../php/varSession.inc.php');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/form.js"></script>
    <title>Néomania : Connexion</title>
</head>

<body>
<?php include('../php/header.php'); ?>
<?php include('../php/nav.php'); ?>
    <main>
        <h1>Bienvenue</h1>
        <form action="form.php" method="POST" id="loginForm">
            <table id="loginTable">
                <tr>
                    <td><label for="email">Identifiant : </label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurConnexion']['email'])){
                            echo "<input type='email' name='email' placeholder='monmail@monsite.org'>";
                        }
                        else{
                            echo "<input type='email' name='email' placeholder='monmail@monsite.org' class='erreurCase'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurConnexion']['email']."</span>";
                            unset($_SESSION['erreurConnexion']['email']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Mot de passe : </label></td>
                    <td>
                    <?php
                        if(empty($_SESSION['erreurConnexion']['password'])){
                            echo "<input type='password' name='password' placeholder='Entrez votre mot de passe'>";
                        }
                        else{
                            echo "<input class='erreurCase' type='password' name='password' placeholder='Entrez votre mot de passe'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurConnexion']['password']."</span>";
                            unset($_SESSION['erreurConnexion']['password']);
                        }
                        ?>
                    </td>
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
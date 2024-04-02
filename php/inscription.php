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
    <title>Lafleur : Inscription</title>
</head>

<body>
    <?php include('../php/header.php'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>Inscription</h1>
        <form action="" method="post" id="inscriptionForm">
            <table id="inscriptionTable">
                <tr>
                    <td><label for="genre">Sexe :</label></td>
                    <td>
                        <input type="radio" name="genre" value="Homme" />Homme
                        <input type="radio" name="genre" value="Femme" />Femme
                        <input type="radio" name="genre" value="Autre">Autre
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom : </label></td>
                    <td><input type="text" name="nom" placeholder="Entrez votre nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom : </label></td>
                    <td><input type="text" name="prenom" placeholder="Entrez votre prénom"></td>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance</label></td>
                    <td><input type="date" name="naissance" max="<?php echo date('Y-m-d');?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td><input type="email" name="email" placeholder="monmail@monsite.org"></td>
                </tr>
                <tr>
                    <td><label for="pwd">Mot de passe : </label></td>
                    <td><input type="password" name="pwd" placeholder="Entrez un mot de passe"></td>
                </tr>
                <tr>
                    <td><label for="confirmpwd">Confirmation du mot de passe : </label></td>
                    <td><input type="password" name="confirmpwd" placeholder="Confirmez votre mot de passe"></td>
                </tr>
                <tr>
                    <input type="hidden" name="action" value="inscription">
                    <td colspan="2"><input type="submit" value="Création du compte" onclick="return checkInscription()"></td>
                </tr>
            </table>
        </form>
        <div>
            <a href="../php/login.php">Si vous avez déjà un compte, cliquez ici</a>
        </div>
    </main>
    <?php include('../html/footer.html'); ?>

</body>

</html>
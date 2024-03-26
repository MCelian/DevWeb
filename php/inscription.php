<?php
    session_start();

    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Lafleur : Inscription</title>
</head>
<body>
    <link rel="stylesheet" href="../css/style.css">
    <?php include('../html/header.html'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
    <form action="Inscription.php" method="post">
        <h1>Inscription</h1>  
        <div id="formulaire">
            <label><b>Sexe: </b></label>
            <input type="radio" name="S" value="male"/>Homme</input>
            <input type="radio" name="S" value="female"/>Femme
            <br>

            <label><b>Nom : </b></label>
            <input type="text" placeholder="Entrez votre nom" name="firstname" required>
            <br>

            <label><b>Prénom: </b></label>
            <input type="text" placeholder="Entrez votre prénom" name="surname" required>
            <br>
                <td><b><label for="naissance">Date de naissance :</label></b></td>
                <td><input type="date" name="naissance" ></td>
            <br>
            <label><b>Adresse : </b></label>
            <input type="text" placeholder="Entrez adresse" name="adresse" required>
            <br>

            <label><b>Mail : </b></label>
            <input type="text" placeholder="Entrez votre mail" name="mail" required>
            <br>

            <label><b>Nouveau mot de passe : </b></label>
            <input type="password" placeholder="Entrez un mot de passe" name="newpassword" required>
            <br>

            <label><b>Confirmation de mot de passe : </b></label>
            <input type="password" placeholder="Entrez à nouveau votre mot de passe" name="confirmpassword" required>
            <br>

            <button type="submit">Créer son compte</button>
        </div>
    </form>
    <div>
            <a href="../php/login.php">Si vous avez déjà un compte, cliquez ici</a>
    </div>
</main>
    <?php include('../html/footer.html'); ?>

</body>

</html>
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
        <h1>Inscription</h1>
        <form action="client.php" method="post" id="inscription">
            <label for="sexe"><b>Sexe : </b></label>
            <input type="radio" name="sexe" value="Homme" required/>Homme
            <input type="radio" name="sexe" value="Femme" />Femme
            <input type="radio" name="sexe" value="Autre">Autre
            <br>

            <label for="nom"><b>Nom : </b></label>
            <input type="text" placeholder="Entrez votre nom" name="nom" required>
            <br>

            <label for="prenom"><b>Prénom : </b></label>
            <input type="text" placeholder="Entrez votre prénom" name="prenom" required>
            <br>

            <label for="naissance"><b>Date de naissance : </b></label>
            <input type="date" name="naissance">
            <br>

            <!-- A voir si on garde -->
            <label><b>Adresse : </b></label>
            <input type="" placeholder="Entrez adresse" name="adresse" required>
            <br>

            <label for="mail"><b>Mail : </b></label>
            <input type="text" placeholder="Entrez votre mail" name="mail" required>
            <br>

            <label><b>Nouveau mot de passe : </b></label>
            <input type="password" placeholder="Entrez un mot de passe" name="newpwd" required>
            <br>

            <label><b>Confirmation de mot de passe : </b></label>
            <input type="password" placeholder="Entrez à nouveau votre mot de passe" name="confirmpwd" required>
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
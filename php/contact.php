<?php
    session_start();
    if(! isset($_SESSION['categorie'])) include('../php/varSession.inc.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/contact.js"></script>
    <title>Lafleur : Contact</title>
</head>

<body>
    <?php include('../html/header.html'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>Demande de contact</h1>
        <form action="" method="post">
            <table id="contact">
                <tr>
                    <td><label for="date">Date du contact :</label></td>
                    <td><input type="date" name="date"></td>
                </tr>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td><input type="text" name="nom" placeholder="Entrez votre nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td><input type="text" name="prenom" placeholder="Entrez votre prénom"></td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td><input type="email" name="email" placeholder="monmail@monsite.org"></td>
                </tr>
                <tr>
                    <td><label for="genre">Genre :</label></td>
                    <td>
                        <input type="radio" name="genre" value="Homme">Homme <br>
                        <input type="radio" name="genre" value="Homme">Femme <br>
                        <input type="radio" name="genre" value="Autre">Autre <br>
                    </td>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance :</label></td>
                    <td><input type="date" name="naissance"></td>
                </tr>
                <tr>
                    <td><label for="fonction">Fonction :</label></td>
                    <td>
                        <input type="text" name="fonction" list="fonction">
                        <datalist type="text" id="fonction">
                            <option value="enseignant">Enseignant</option>
                            <option value="chomeur">Chômeur</option>
                            <option value="fonctionnaire">Fonctionnaire</option>
                            <option value="etudiant">Étudiant</option>
                            <option value="cadre">Cadre</option>
                            <option value="employe">Employé</option>
                            <option value="autre">Autre</option>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td><label for="sujet">Sujet :</label></td>
                    <td><input type="text" name="sujet" placeholder="Entrez le sujet de votre mail"></td>
                </tr>
                <tr>
                    <td><label for="contenu">Contenu :</label></td>
                    <td><textarea name="contenu" placeholder="Tapez ici votre mail"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Envoyer" onclick="checkContact()"></td>
                </tr>
            </table>
        </form>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>
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
    <title>Lafleur : Contact</title>
</head>

<body>
    <?php include('../php/header.php'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>Demande de contact</h1>
        <form action="" method="post" id="contactForm" >
            <table id="contactTable">
                <tr>
                    <td><label for="date">Date du contact :</label></td>
                    <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly></td>
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
                        <input type="radio" name="genre" value="Homme">Homme
                        <input type="radio" name="genre" value="Homme">Femme
                        <input type="radio" name="genre" value="Autre">Autre 
                    </td>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance :</label></td>
                    <td><input type="date" name="naissance" max="<?php echo date('Y-m-d'); ?>"></td>
                </tr>
                <tr>
                    <td><label for="fonction">Fonction :</label></td>
                    <td>
                        <select name="fonction">
                            <option value="default">-- Veuillez choisir une fonction --</option>
                            <option value="Enseignant">Enseignant</option>
                            <option value="Chomeur">Chômeur</option>
                            <option value="Fonctionnaire">Fonctionnaire</option>
                            <option value="Etudiant">Étudiant</option>
                            <option value="Cadre">Cadre</option>
                            <option value="Employe">Employé</option>
                            <option value="Autre">Autre</option>
                        </select>
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
                    <input type="hidden" name="action" value="contact">   
                    <td colspan="2"><input type="submit" value="Envoyer" onclick="return checkContact()"></td>
                </tr>
            </table>
        </form>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>
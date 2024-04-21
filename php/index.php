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
    <title>Néomania : Accueil</title>
</head>

<body>
    <?php include('../php/header.php'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>L'équipe de Néo-mania vous souhaite la bienvenue</h1>
        <img src="../img/logo.jpg" alt="logo du site" id="mainLogo">
        <br>
        <p>
            Nous vous proposons à la vente une sélection de consoles que nous avons choisis avec soins.
        </p>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>

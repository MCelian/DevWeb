<?php
    session_start();

    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <title>Lafleur : Accueil</title>
</head>

<body>
    <?php include('../html/header.html'); ?>
    <?php include('../html/nav.html'); ?>
    <main>
        <h1>"Dites-le avec Lafleur"</h1>
        <img src="../img/logo.jpg" alt="logo du site" id="mainLogo">
        <br>
        Appeler notre service commercial au 03.22.84.65.74 pour un bon de commande
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>

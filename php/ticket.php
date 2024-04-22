<?php
    session_start();
    if(!isset($_SESSION['categorie'])) require('../php/varSession.inc.php');
    include_once('../php/data.php');
?>

<!DOCTYPE html>
<html lang="fr" id='html_ticket'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.webp">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/stock.js"></script>
    <title>Néomania : Ticket</title>
</head>

<body class='body_ticket'>
    <form action='form.php' method='post'>
        <input type='hidden' name='action' value='pagePrincipale'>
        <input type='submit' class='bouton_ticket' value='Retour à la page principale'>
    </form>
        <img src="../img/logo.webp" id="logo_ticket" alt="logo du site">
        <h1> Néo-Mania </h1>
        <p> <i> Avenue du Parc, 95011 Cergy-Pontoise, France <br> Téléphone: +33 1 34 25 10 10 </i> </p>
    <?php
        if(isset($_SESSION['user'])){
            echo "<span>".$_SESSION['user']['nom']."    ".$_SESSION['user']['prenom']."</span>";
        }
    ?>
        <h2>Liste des produits achetés :</h2>
    <?php
        afficherTicket();
    ?>
    <i>Merci pour votre commande !</i>
</body>
</html>
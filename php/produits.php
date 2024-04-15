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
    <script src="../js/stock.js"></script>
    <script src="../js/form.js"></script>
    <title>Néomania : <?php echo $_GET["cat"]; ?> </title>
</head>

<body>
    <?php include("../php/header.php"); ?>
    <?php include('../php/nav.php'); ?>
    
    
    <main>
        <!--Confirmation d'ajout au panier -->
        <div id="overlay_confirmation">
            <span id="fermer_confirmation" onclick="fermerConfirmation()">&times;</span>
            <div id="confirmation_popup">
                <h2>Merci pour votre confiance</h2>
                <p>
                    Vous venez d'ajouter <span id="reference_confirmation"></span> en <span id="quantite_confirmation"></span> exemplaire(s) à votre panier.
                </p>
            </div>
        </div>
        <!--Accueillir l'image dans un Popup -->
        <div id="popup-overlay">
        <span id="fermer-popup" onclick="fermerImage()">&times;</span>
            <div id="popup">
                <img src="" alt="" id="image-popup">
            </div>
        </div>
        <?php afficherProduits($_GET["cat"]); ?>
    </main>
    <?php include("../html/footer.html"); ?>
</body>

</html>
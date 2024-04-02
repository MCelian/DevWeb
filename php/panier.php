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
    <title>Lafleur : Panier </title>
</head>

<body>
    <?php include("../php/header.php"); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <!--Accueillir l'image dans un Popup -->
        <div id="popup-overlay">
            <div id="popup">
                <span id="fermer-popup" onclick="fermerImage()">&times;</span>
                <img src="" alt="" id="image-popup">
            </div>
        </div>

        <h1>Panier</h1>
        <?php   
        afficherPanier();
        if(!empty($_SESSION["user"])){
            echo "<form action='' method='post'>
                    <input  type='submit' value='Valider le Panier'>
                    <input type='hidden' name='action' value='validerPanier'>
                    </form>";  
        }  
        else{
            echo "Merci de vous connecter pour valider le panier";
        }
        ?>
    </main>
    <?php include("../html/footer.html"); ?>
</body>

</html>
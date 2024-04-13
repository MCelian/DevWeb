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
        <!--Accueillir l'image dans un Popup -->
        <div id="popup-overlay">
            <div id="popup">
                <span id="fermer-popup" onclick="fermerImage()">&times;</span>
                <img src="" alt="" id="image-popup">
            </div>
        </div>
        <?php afficherProduits($_GET["cat"]); ?>
    </main>
    <?php include("../html/footer.html"); ?>
</body>

</html>
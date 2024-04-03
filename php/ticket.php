<?php
    session_start();
    if(!isset($_SESSION['categorie'])) require('../php/varSession.inc.php');

    include_once('../php/data.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/stock.js"></script>
    <title>Lafleur : Ticket </title>
</head>

<body>
    <form action='form.php' method='post'>
        <input type='hidden' name='action' value='pagePrincipale'>
        <input type='submit' class='button' value='Retour à la page principale'>
    </form>
    <main>
        <?php
            afficherTicket();
        ?>
    </main>
</body>

</html>
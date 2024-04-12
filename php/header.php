<?php
include_once('../php/data.php');
?>
<header>
    <a href="../php/index.php">
        <img src="../img/logo.jpg" alt="Logo du site" id="logo">
    </a>
    <div id="banderole">
        <h1 id="titre">Société Néomania</h1>
        <ul>
            <li><a href="../php/index.php">Accueil</a></li>
            <?php afficherMenu(); ?>
            <li><a href="../php/contact.php">Contact</a></li>
        </ul>
    </div>
    <div id="espaceClient">
        <?php if(!empty($_SESSION["user"])){
            echo $_SESSION['user']['nom']." ".$_SESSION['user']['prenom'];
            echo "<form action='form.php' method='post'>
                    <input  type='submit' value='Se Déconnecter'>
                    <input type='hidden' name='action' value='deconnexion'>
                    </form>";  
        }  
        else{
            echo "<form action='login.php' method='post'>
                    <input  type='submit' value='Se Connecter'>
                    </form>";
        }
        ?>
        <br>
        <a href="../php/panier.php">Panier</a>
    </div>
</header>
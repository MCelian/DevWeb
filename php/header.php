<?php
include_once('../php/data.php');
?>

<header>
    <div class="logo_titre_connexion">
        <a href="../php/index.php" id="logo_header"> <img src="../img/logo.webp" alt="Logo du site" id="logo"></a>
        <h1 id="titre_header">Néo-Mania</h1>
        <div id="panier_connexion">
            <?php if(!empty($_SESSION["user"])){
                echo "<span id='nom_user'>".$_SESSION['user']['nom']." ".$_SESSION['user']['prenom']."</span>";
                echo "<form action='form.php' method='post'>
                        <input   type='submit' value='Se Déconnecter' class='bouton_client'>
                        <input type='hidden' name='action' value='deconnexion'>
                        </form>";
            }  
            else{
                echo "<form action='login.php' method='post'>
                    <input  type='submit' value='Se Connecter' class='bouton_client'>
                    </form>";
            }
        ?>
            <a href="../php/panier.php"><button type="button" class="bouton_client"> Panier</button></a>
        </div>
    </div>
    <div class="categories">
        <ul>
            <li><a href="../php/index.php">Accueil</a></li>
            <?php afficherMenu(); ?>
            <li><a href="../php/contact.php">Contact</a></li>
        </ul>
    </div>
</header>
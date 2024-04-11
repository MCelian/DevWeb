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
    <title>Lafleur : Inscription</title>
</head>

<body>
    <?php include('../php/header.php'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>Inscription</h1>
        <form action="form.php" method="post" id="inscriptionForm">
            <table id="inscriptionTable">
                <tr>
                    <td><label for="genre">Sexe :</label></td>
                    <td>
                    <?php
                        if(empty($_SESSION['erreurInscription']['genre'])){
                        echo "<input type='radio' name='genre' value='Homme' />Homme";
                        echo "<input type='radio' name='genre' value='Femme' />Femme";
                        echo "<input type='radio' name='genre' value='Autre'>Autre";
                        }
                        else{
                            echo "<input type='radio' name='genre' value='Homme' />Homme";
                            echo "<input type='radio' name='genre' value='Femme' />Femme";
                            echo "<input type='radio' name='genre' value='Autre'>Autre";
                            echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['genre']."</span>";
                            unset($_SESSION['erreurInscription']['genre']);
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom : </label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurInscription']['nom'])){
                        echo "<input type='text' name='nom' placeholder='Entrez votre nom'>";
                        }
                        else{
                            echo "<input type='text' name='nom' placeholder='Entrez votre nom' class = 'erreurCase'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['nom']."</span>";
                            unset($_SESSION['erreurInscription']['nom']);
                        }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom : </label></td>
                    <td>
                    <?php
                        if(empty($_SESSION['erreurInscription']['prenom'])){
                        echo "<input type='text' name='prenom' placeholder='Entrez votre prénom'>";
                        }
                        else{
                            echo "<input type='text' name='prenom' placeholder='Entrez votre prénom' class = 'erreurCase'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['prenom']."</span>";
                            unset($_SESSION['erreurInscription']['prenom']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance</label></td>
                    <td>
                    <?php
                        if(empty($_SESSION['erreurInscription']['naissance'])){
                            echo "<input type='date' name='naissance' max='<?php echo date('Y-m-d'); ?>'>";
                        }
                        else{
                            echo "<input type='date' name='naissance' class='erreurCase' max='<?php echo date('Y-m-d'); ?>'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['naissance']."</span>";
                            unset($_SESSION['erreurInscription']['naissance']);
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                    <?php
                    if(empty($_SESSION['erreurInscription']['email'])){
                        echo "<input type='email' name='email' placeholder='monmail@monsite.org'>";
                    }
                    else{
                        echo "<input type='email' name='email' placeholder='monmail@monsite.org' class='erreurCase'>";
                        echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['email']."</span>";
                        unset($_SESSION['erreurInscription']['email']);
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Mot de passe : </label></td>
                    <td>
                    <?php
                    if(empty($_SESSION['erreurInscription']['password'])){
                        echo "<input type='password' name='password' placeholder='Entrez un mot de passe'>";
                    }
                    else{
                        echo "<input type='password' name='password' placeholder='Entrez un mot de passe' class='erreurCase'>";
                        echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['password']."</span>";
                        unset($_SESSION['erreurInscription']['password']);
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirmpwd">Confirmation du mot de passe : </label></td>
                    <td>
                    <?php
                    if(empty($_SESSION['erreurInscription']['confirmpwd'])){
                        echo "<input type='password' name='confirmpwd' placeholder='Confirmez votre mot de passe'>";
                    }
                    else{
                        echo "<input type='password' name='confirmpwd' placeholder='Confirmez votre mot de passe' class='erreurCase'>";
                        echo "<span class='messageErreur'>". $_SESSION['erreurInscription']['confirmpwd']."</span>";
                        unset($_SESSION['erreurInscription']['confirmpwd']);
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="action" value="inscription">
                    <td colspan="2"><input type="submit" value="Création du compte" onclick="return checkInscription()">
                    <?php
                            if(!empty($_SESSION['etatInscription'])){
                                echo "<span>". $_SESSION['etatInscription']."</span>";
                                unset($_SESSION['etatInscription']);
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <div>
            <a href="../php/login.php">Si vous avez déjà un compte, cliquez ici</a>
        </div>
    </main>
    <?php include('../html/footer.html'); ?>

</body>

</html>
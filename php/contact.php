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
    <title>Néomania : Contact</title>
</head>

<body>
    <?php include('../php/header.php'); ?>
    <?php include('../php/nav.php'); ?>
    <main>
        <h1>Demande de contact</h1>
        <form action="form.php" method="post" id="contactForm" >
            <table id="contactTable">
                <tr>
                    <td><label for="date">Date du contact :</label></td>
                    <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly></td>
                </tr>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['nom'])){
                            echo "<input type='text' name='nom' placeholder='Entrez votre nom'>";
                        }
                        else{
                            echo "<input type='text' name='nom' placeholder='Entrez votre nom' class='erreurCase'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['nom']."</span>";
                            unset($_SESSION['erreurContact']['nom']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td>
                    <?php
                    if(empty($_SESSION['erreurContact']['prenom'])){
                        echo "<input type='text' name='prenom' placeholder='Entrez votre prénom'>";
                    }
                    else{
                        echo "<input type='text' name='prenom' placeholder='Entrez votre prénom' class='erreurCase'>";
                        echo "<span class='messageErreur'>". $_SESSION['erreurContact']['prenom']."</span>";
                        unset($_SESSION['erreurContact']['prenom']);
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                    <?php
                    if(empty($_SESSION['erreurContact']['email'])){
                        echo "<input type='email' name='email' placeholder='monmail@monsite.org'>";
                    }
                    else{
                        echo "<input type='email' name='email' placeholder='monmail@monsite.org' class='erreurCase'>";
                        echo "<span class='messageErreur'>". $_SESSION['erreurContact']['email']."</span>";
                        unset($_SESSION['erreurContact']['email']);
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="genre">Genre :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['genre'])){
                            echo "<input type='radio' name='genre' value='Homme'>Homme";
                            echo "<input type='radio' name='genre' value='Homme'>Femme";
                            echo "<input type='radio' name='genre' value='Autre'>Autre";
                        }
                        else{
                            echo "<input type='radio' name='genre' value='Homme'>Homme";
                            echo "<input type='radio' name='genre' value='Homme'>Femme";
                            echo "<input type='radio' name='genre' value='Autre'>Autre";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['genre']."</span>";
                            unset($_SESSION['erreurContact']['genre']);
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['naissance'])){
                            echo "<input type='date' name='naissance' max='". date('Y-m-d')."'";
                        }
                        else{
                            echo "<input type='date' name='naissance' class='erreurCase' max='". date('Y-m-d')."'";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['naissance']."</span>";
                            unset($_SESSION['erreurContact']['naissance']);
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="fonction">Fonction :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['fonction'])){
                            echo "<select name='fonction'>
                                <option value='default'>-- Veuillez choisir une fonction --</option>
                                <option value='Enseignant'>Enseignant</option>
                                <option value='Chomeur'>Chômeur</option>
                                <option value='Fonctionnaire'>Fonctionnaire</option>
                                <option value='Etudiant'>Étudiant</option>
                                <option value='Cadre'>Cadre</option>
                                <option value='Employe'>Employé</option>
                                <option value='Autre'>Autre</option>
                            </select>";
                        }
                        else{
                            echo "<select name='fonction' class='erreurCase'>
                                <option value='default'>-- Veuillez choisir une fonction --</option>
                                <option value='Enseignant'>Enseignant</option>
                                <option value='Chomeur'>Chômeur</option>
                                <option value='Fonctionnaire'>Fonctionnaire</option>
                                <option value='Etudiant'>Étudiant</option>
                                <option value='Cadre'>Cadre</option>
                                <option value='Employe'>Employé</option>
                                <option value='Autre'>Autre</option>
                            </select>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['fonction']."</span>";
                            unset($_SESSION['erreurContact']['fonction']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="sujet">Sujet :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['sujet'])){
                            echo "<input type='text' name='sujet' placeholder='Entrez le sujet de votre mail'>";
                        }
                        else{
                            echo "<input type='text' name='sujet' placeholder='Entrez le sujet de votre mail' class = 'erreurCase'>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['sujet']."</span>";
                            unset($_SESSION['erreurContact']['sujet']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="contenu">Contenu :</label></td>
                    <td>
                        <?php
                        if(empty($_SESSION['erreurContact']['contenu'])){
                        echo "<textarea name='contenu' placeholder='Tapez ici votre mail'></textarea>";
                        }
                        else{
                            echo "<textarea name='contenu' placeholder='Tapez ici votre mail' class = 'erreurCase' ></textarea>";
                            echo "<span class='messageErreur'>". $_SESSION['erreurContact']['contenu']."</span>";
                            unset($_SESSION['erreurContact']['contenu']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="action" value="contact">   
                    <td colspan="2">
                        <input type="submit" value="Envoyer" onclick="return checkContact()">
                        <?php
                            if(!empty($_SESSION['etatMail'])){
                                echo "<span>". $_SESSION['etatMail']."</span>";
                                unset($_SESSION['etatMail']);
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </main>
    <?php include('../html/footer.html'); ?>
</body>

</html>
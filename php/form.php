<?php
//Fichier réservé pour la vérification des formulaires et à l'envoi des formulaires

session_start();

include_once('../php/data.php');

checkFormulaire();

//Envoi de tous les formulaires à cette fonction
function checkFormulaire(){
    //Vérification de la récupartion du type de formulaire
    if(isset($_POST['action'])){
        $choix = $_POST['action'];

        //Redirection vers le test de champ
        switch($choix){
            case 'login':
                if(checkConnexion()){
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }else{
                    ConnexionClient();
                }
                break;
            case 'inscription':
                if(checkInscription()){
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                else{

                }
                echo "inscription";
                break;
            case 'contact':
                if(checkContact()){
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                else{
                    envoyerMail();
                }
                echo "contact";
                break;
            case 'deconnexion':
                DeconnexionClient();
                break;
            case 'panier':
                ajouterProduitPanier();
                break;
            case 'viderPanier':
                viderPanier();
                echo "Panier vider";
                break;
            case 'validerPanier':
                header('Location: ../php/ticket.php');
                exit();
                break;
            case 'pagePrincipale':
                echo "Retour à la page index";
                header('Location: ../php/index.php');
                exit();
                break;
            default :
                echo "default";
                break;
        }
    }
}


/*********
 * Formulaire de Connexion *
 *********/

 function checkConnexion(){
    $erreur = false;
    
    // Informations à vérifier
    $informations = ['username', 'password'];

    // Tableau d'informations des erreurs
    $retour = array();
    
    foreach($informations as $data){
        if(empty($_POST[$data])){
            $erreur = true;
            $retour[$data] = "Champ vide";
        } elseif($data == 'username'){
            if(!filter_var($_POST[$data], FILTER_VALIDATE_EMAIL)){
                $erreur = true;
                $retour[$data] = "Email invalide";
            }
        }
    }

    if(!empty($retour)){
        $_SESSION['erreurConnexion'] = $retour;
    }
    
    return $erreur;
}

/*********
 * Formulaire d'inscription *
 *********/

 function checkInscription(){
    $erreur = false;

    $informations = ['genre', 'nom', 'prenom', 'naissance', 'email', 'pwd', 'confirmpwd'];
    // Tableau d'informations des erreurs
    $retour = array();

    foreach($informations as $data){
        if(empty($_POST[$data])){
            $erreur = true;
            $retour[$data] = " Champ vide";
        } elseif($data == 'email'){ //penser à remplir les différents types d'erreurs (si il y en a d'autres)
            if(!filter_var($_POST[$data], FILTER_VALIDATE_EMAIL)){
                $erreur = true;
                $retour[$data] = " Email invalide";
            }
        }
        elseif($data == 'confirmpwd'){
            if($_POST['pwd'] != $_POST['confirmpwd']){
                $retour[$data] = " Le mot de passe doit être le même que celui renseigné!";
            }
        }
    }

    if(!empty($retour)){
        $_SESSION['erreurInscription'] = $retour;
    }

    return $erreur;
 }

 /*********
 * Formulaire de contact *
 *********/

 function checkContact(){
    $erreur = false;

    // Informations à vérifier
    $informations = ['nom', 'prenom', 'email', 'genre', 'naissance', 'fonction', 'sujet', 'contenu'];

    // Tableau d'informations des erreurs
    $retour = array();

    foreach($informations as $data){
        if(empty($_POST[$data])){
            $erreur = true;
            $retour[$data] = " Champ vide";
        } elseif($data == 'email'){ //penser à remplir les différents types d'erreurs (si il y en a d'autres)
            if(!filter_var($_POST[$data], FILTER_VALIDATE_EMAIL)){
                $erreur = true;
                $retour[$data] = " Email invalide";
            }
        }
        elseif($data == 'fonction' && $_POST['fonction'] == 'default'){
            $erreur = true;
            $retour[$data] = " Champ vide";
        }
    }

    if(!empty($retour)){
        $_SESSION['erreurContact'] = $retour;
    }

    return $erreur;
 }

/*********
 * Envoi de mail *
 *********/

function envoyerMail(){
    $date = date('Y-m-d');
    $prenom = $_POST['prenom'];
    $nom =$_POST['nom'];
    $mail = $_POST['mail'];
    $genre = $_POST['genre'];
    $naissance = $_POST['naissance'];
    $fonction = $_POST['fonction'];
    $sujet = $_POST['sujet'];
    $contenu = $_POST['contenu'];
    //mail destinataire
    $to = 'mignotceli@cy-tech.fr';
    //entête du mail
    $headers = array(
        'Date' => $date,
        'From' => trim($mail), 
        'Reply-To' => $to,
        'X-Mailer' => 'PHP/' . phpversion()
    );
    //Formate le message
    $message="Prénom Nom :$prenom $nom\nGenre : $genre\nDate de naissance : $naissance\nFonction : $fonction\n$contenu";
    

    //Envoie le message
    if(mail($to, $sujet,$message,$headers)){
        $_SESSION['etatMail']="Message envoyé";
    }else{ //Echec de l'envoie
        $_SESSION['etatMail']="Echec de l'envoi, veuillez rééessayer ultérieurement (Nous avons pas de serveur mail)";
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

}

/*******************
 * Compte *
 *******************/

function ConnexionClient(){
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    $chemin = '../data/user.xml';

    echo "$username et $pwd\n";
    //Ouverture du fichier
    $fichier = simplexml_load_file($chemin);

    foreach($fichier->client as $client){
        if($username == trim($client->mail) && $pwd == trim($client->pwd)){
            $_SESSION['user'] = array(
                "sexe" => trim($client->sexe),
                "nom" => trim($client->nom),
                "prenom" => trim($client->prenom),
                "naissance" => trim($client->naissance),
                "mail" => trim($client->mail),
                "password" => trim($client->pwd),
                "admin" => trim($client->admin));
            header('Location: ../php/index.php');
            exit();
        }
    }

    //Aucun client n'a été identifié
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

function DeconnexionClient(){
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}


?>
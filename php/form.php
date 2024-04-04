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
                checkConnexion();
                ConnexionClient();
                break;
            case 'inscription':
                echo "inscription";
                break;
            case 'contact':
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

 //Fonction en cours de réalisation
 //Ragerder comment faire apparaitre les erreurs dans la page contact
function checkConnexion(){
    $erreur = false;
    

    //Informations à vérifier
    $informations = ['username', 'password'];

    //Tableau d'informations des erreurs
    $retour = ['',''];
    

    foreach($informations as $data){
        if($data == 'username'){
            if(!filter_var($_POST[$data], FILTER_VALIDATE_EMAIL)){
                $erreur = true;
                $retour[$data] = 'Email Invalide';
            }
        }
        if(empty($_POST[$data])){
            $erreur = true;
            $retour[$data] = 'Champ Requis';
        }
        else{
            $retour['password'] = '';
        }
    }
    if(!empty($retour)){
         $_SESSION['erreurConnexion'] = $retour;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    return $retour;
}


/*********
 * Envoi de mail *
 *********/

function envoyerMail($date, $prenom, $nom,$mail, $genre, $naissance, $fonction , $sujet, $contenu){
    
    //mail destinataire
    $to = 'mignotceli@cy-tech.fr';
    //entête du mail
    $headers = array(
        'Date' => $date,
        'From' => $mail,
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

    echo "$username et $pwd";
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
}

function DeconnexionClient(){
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


?>
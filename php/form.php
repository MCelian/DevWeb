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
                //checkConnexion();
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
    

    //Informations à vérifier
    $informations = ['username', 'password'];

    foreach($informations as $data){
        if(empty($_POST[$data])){
            $erreur = true;
        }
        if($data == 'username'){
            if(!filter_var($_POST[$data], FILTER_VALIDATE_EMAIL)){
                $erreur = true;
            }
        }
    }

    return $erreur;
}


/*********
 * Formulaire de Connexion *
 *********/

/*function envoyerMail($date, $prenom, $nom,$mail, $genre, $naissance, $fonction , $sujet, $contenu){
    $to = 'mignotceli@cy-tech.fr';

    $headers = array(


    );


    mail($to, $sujet, )

}*/

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
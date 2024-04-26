<?php
include_once('../bdd/bddData.php');

//Connexion à la base de données
function connexionBDD() {

    try {
        $dbh = new PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_DBNAME, MYSQL_PORT),
            MYSQL_USER,
            MYSQL_PASSWORD
        );
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (Exception $exception) {
        die('Erreur : '.$exception->getMessage());
        return false;
    }
}

//Déconnexion de la base de données
function deconnexionBDD() {
    return null;
}

function ajoutUtilisateurToSQL(){
    $email = $_POST['email'];

    $dbh = connexionBDD();

    if($dbh){
        $reponse = $dbh->prepare('SELECT email FROM Users WHERE email = ?');
        $reponse->execute([$email]);
        if($reponse->rowCount() > 0){
            $_SESSION['etatInscription'] = "Il y a déjà un compte avec cette adresse mail";
            
            //Un utilisateur utilise déjà cette adresse mail
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else{
            $reponse = $dbh->prepare('INSERT INTO Users VALUES(?,?,?,?,?,?,?)');
            $reponse->execute([$_POST['genre'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $email, $_POST['password'], 0]);
            
            // Écriture dans le fichier d'initialisation 
            requeteUtilisateurToSQL([$_POST['genre'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $email, $_POST['password'], 0]);          
        }

        $dbh = deconnexionBDD();
    }   
}
//Ecrit une requête SQL qui crée un nouveau Utilisateur dans le fichier néomaniadata.sql
function requeteUtilisateurToSQL($utilisateur){
    $fichier = "../sql/néomaniadata.sql";

    $open = fopen($fichier, "a");
    if ($open != NULL) {
        // Préparation des données pour l'insertion dans la requête SQL
        $donnee = "'".$utilisateur[0].
        "','".$utilisateur[1].
        "','".$utilisateur[2].
        "','".$utilisateur[3].
        "','".$utilisateur[4].
        "','".$utilisateur[5].
        "',".$utilisateur[6];

        $requete = "INSERT INTO Users VALUES(".$donnee.");\n";
        fwrite($open, $requete);

        // Fermeture du fichier
        fclose($open);
    }
}

//Ecrire une requete SQL dans le fichier néomaniadata.sql
function requeteProduitToSQL($produit) {
    $fichier = "../sql/néomaniadata.sql";

    $open = fopen($fichier, "a");
    if ($open != NULL) {
        $donnee = "'".$produit['categorie'].
        "','".$produit['photo'].
        "','".$produit['reference'].
        "','".$produit['description'].
        "',".$produit['prix'].
        ",".$produit['stock'];
        $requete = "INSERT INTO Produits VALUES(".$donnee.");\n";
        fwrite($open, $requete);
        fclose($open);
    }
}


//Ecrire toutes les requetes
function requeteAllProduitToSQL() {
    foreach($_SESSION['categorie'] as $cat => $produits) {
        foreach($produits as $produit) {
            //Ecriture dans le fichier de chaque produit
            requeteProduitToSQL($produit);
        }
    }
}


//Récupère tous les produits dans la BDD
function importerProduitsBDD() {


    //Accès à la base de données
    $dbh = connexionBDD();

    if ($dbh) {
        //Initialisation d'un tableau vide qui va accueillir les produits
        $cat = array();

        $reponse = $dbh->prepare('SELECT * FROM `Produits`');
        $reponse->execute();
        if ($reponse->rowCount() > 0) {
            $all = $reponse->fetchAll();
            foreach($all as $ligne) {
                $categorie = $ligne[0];
                $cat[$categorie][] = array(
                    'categorie' => $categorie,
                    'photo' => trim($ligne[1]),
                    'reference' => trim($ligne[2]),
                    'description' => trim($ligne[3]),
                    'prix' => floatval(trim($ligne[4])),
                    'stock' => intval(trim($ligne[5]))
                );
            }
        }
        //Fermeture de la base de données
        $dbh = deconnexionBDD();

        return $cat;
    }




}

function miseAJourStockBDD($reference, $quantite) {
    //Accès à la base de données
    $dbh = connexionBDD();

    $reponse = $dbh->query("UPDATE Produits SET stock = stock -'$quantite' WHERE reference LIKE '$reference'");

    //Fermeture de la base de données
    $dbh = deconnexionBDD();
}
//vérification du stock
function checkStockBDD($reference, $quantite){
    $dbh = connexionBDD();

    if($dbh){
        $reponse = $dbh->prepare('SELECT stock FROM Produits WHERE reference = ?');
        $reponse->execute(array($reference));
        $dbh = deconnexionBDD();

        if($reponse->rowCount() > 0){
            $all = $reponse->fetchAll();
            foreach($all as $ligne){
                if($ligne['stock'] > 0 && $quantite <= $ligne['stock']){
                    return true;
                }
            }
        } 
    }
    return false;
}
?>

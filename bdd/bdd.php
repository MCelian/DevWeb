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

//Ecrire une requete SQL dans le fichier lafleurdata.sql
function requeteProduitToSQL($produit) {
    $fichier = "../sql/lafleurdata.sql";

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

    $reponse = $dbh->query("UPDATE Produits SET stock ='$quantite' WHERE reference LIKE '$reference'");

    //Fermeture de la base de données
    $dbh = deconnexionBDD();
}

?>
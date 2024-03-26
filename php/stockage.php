<?php

session_start();
if(! isset($_SESSION['categorie'])) include('../php/varSession.inc.php');

function exporterProduitsFichier(){
    $fichier = "../data/stock.txt";
    $open = fopen($fichier, "w+");

    //Vérification de l'ouverture du fichier
    if($open != NULL){
        foreach($_SESSION['categorie'] as $cat => $produits){
            foreach($produits as $produit){
             //Ecriture dans le fichier de chaque produit
             fwrite($open,$cat.";".$produit['photo'].";".$produit['reference'].";".$produit['description'].";".$produit['prix'].";".$produit['stock']."\n");
            }
        }
        fclose();
    } 
}
exporterProduitsFichier();


function importerProduitsFichier(){
    $fichier = "../data/stock.txt";
    $open = fopen($fichier, "r");
    $ligne = fgets($open);

    //Vérification de l'ouverture du fichier
    if ($open != NULL){
        //Lecture de chaque ligne du fichier
        while($ligne != NULL){
            //Séparation des données de la ligne
            $donnee = explode(';', $ligne);


            //A voir
            foreach($mot as $elm){
                
            }
        }
    

    }
}
?>
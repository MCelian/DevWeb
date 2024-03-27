<?php

session_start();
if(! isset($_SESSION['categorie'])) include('../php/varSession.inc.php');

function exporterProduitsFichier(){
    $fichier = "../data/stock.txt";
    //Ouverture du fichier en mode écriture (pointeur en début de fichier)
    $open = fopen($fichier, "w+");

    //Vérification de l'ouverture du fichier
    if($open != NULL){
        foreach($_SESSION['categorie'] as $cat => $produits){
            foreach($produits as $produit){
             //Ecriture dans le fichier de chaque produit
             fwrite($open,$cat.";".$produit['photo'].";".$produit['reference'].";".$produit['description'].";".$produit['prix'].";".$produit['stock']."\n");
            }
        }
        //Fermeture du fichier
        fclose($open);
    } 
}

?>
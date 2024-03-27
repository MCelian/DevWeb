<?php
//A Terminer idée mettre une virgule après bulbes,
function importerProduitsFichier(){
    $fichier = "../data/stock.txt";
    //Ouverture du fichier le lecture seule
    $open = fopen($fichier, "r");
    $ligne = fgets($open);

    //Initialisation d'un tableau vide qui va accueillir les produits
    $cat = array();

    //Vérification de l'ouverture du fichier
    if ($open != NULL){
        //Lecture de chaque ligne du fichier
        while($ligne != NULL){
            //Séparation des données de la ligne
            $donnee = explode(';', $ligne);
            $categorie = $donnee[0];
            $cat[$categorie][]= array(
                'photo' => trim($donnee[1]),
                'reference' => trim($donnee[2]),
                'description' => trim($donnee[3]),
                'prix' => floatval(trim($donnee[4])),
                'stock' => intval(trim($donnee[5]))  
            );
            $ligne = fgets($open);
        }
        fclose($open);
    }
    return $cat;
}

?>
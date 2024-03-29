<?php

/***********
* Menu *
************/

function afficherMenu(){
    foreach($_SESSION['categorie'] as $key => $elm){
        echo "<li><a href='../php/produits.php?cat=$key'>$key</a></li>\n";
    }
}

/***********
* Produits *
************/

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


function afficherProduits($cat){
    // Récupération des produits de la catégorie voulue
    $donnees = $_SESSION['categorie'][$cat];
    echo "<h1>". $cat."</h1>";
    echo "<table>";
    echo "<tr>
        <th>Photo</th>
        <th>Référence</th>
        <th>Description</th>
        <th>Prix</th>
        <th class='stock'>Stock</th>
        <th>Commande</th>
        </tr>";

    foreach($donnees as $produit){
        echo "<tr>";
        echo "<td><img src='".$produit['photo']."' class='photo-article' onclick='afficherImage(this)'></td>";
        echo "<td>".$produit['reference']."</td>";
        echo "<td>".$produit['description']."</td>";
        echo "<td>".$produit['prix']." €</td>";
        echo "<td class='stock'>".$produit['stock']."</td>";
        echo "<td>
                <form action='' method='post'>
                    <input type='button' value='-' disabled onclick='retirerDuPanier(this)'>
                    <input type='text' value='0' readonly class='quantite-voulue'>
                    <input type='button' value='+' onclick='ajouterAuPanier(this)'> <br>
                    <input type='submit' value='Ajouter au panier' disabled>
                </form>
                </td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<button onclick='afficherStock()' id='bouton-Stock'>Afficher/Masquer Stock</button>";
}


/************
* Clients *
**************/

function ajouterClientFichier($sexe,$nom,$prenom,$naissance,$mail,$pwd){
    $chemin = "../data/user.xml";

    $fichier = new SimpleXMLElement('<clients></clients>');
    //on descend d'un niveau dans l'indentation
    $client = $fichier->addChild('client');

    //Ajout des caractéristiques du client
    $client->addChild('sexe', $sexe);
    $client->addChild('nom', $nom);
    $client->addChild('prenom', $prenom);
    $client->addChild('naissance', $naissance);
    $client->addChild('mail', $mail);
    $client->addChild('pwd', $pwd);

    //Ecriture dans le fichier
    echo $fichier->asXML($chemin);
}



?>
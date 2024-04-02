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

        //Si il n'y a plus de stock, on informe le client
        if($produit['stock'] == 0){
            echo "<td>Produit en rupture de stock </td>";
        }
        else{ //Sinon le client peut choisir le produit
            echo "<td>
                <form action='form.php' method='post'>
                    <input type='button' value='-' disabled onclick='retirerDuPanier(this)'>
                    <input type='text' value='0' readonly class='quantite-voulue' name='quantite'>
                    <input type='button' value='+' onclick='ajouterAuPanier(this)'> <br>
                    <input type='hidden' name='action' value='panier'>
                    <input type='hidden' name='reference' value=".$produit['reference'].">
                    <input type='submit' value='Ajouter au panier' disabled>
                </form>
                </td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<button onclick='afficherStock()' id='bouton-Stock'>Afficher/Masquer Stock</button>";
}

//Mise à jour du stock dans la variable de session
function miseAJourStock($cat, $reference, $quantite){
    // Parcours de chaque categorie
    foreach($_SESSION['categorie'] as &$produits){
        // Parcours de chaque produit dans la categorie
        foreach($produits as &$produit){
            if($produit['reference'] === $reference){
                $produit['stock'] -= $quantite;
            }
        }
    }
}

/************
* Clients *
**************/

function exporterClientFichier($sexe,$nom,$prenom,$naissance,$mail,$pwd){
    $chemin = "../data/user.xml";

    //On vérifie si le fichier existe
    if(file_exists($chemin)){
        $fichier = simplexml_load_file($chemin);
    }
    else{ //Sinon on le créer
        $fichier = new SimpleXMLElement('<clients></clients>');
    }

    //on descend d'un niveau dans l'indentation
    $client = $fichier->addChild('client');

    //Ajout des caractéristiques du client
    $client->addChild('sexe', $sexe);
    $client->addChild('nom', $nom);
    $client->addChild('prenom', $prenom);
    $client->addChild('naissance', $naissance);
    $client->addChild('mail', $mail);
    $client->addChild('pwd', $pwd);
    $client->addChild('admin', "false");


    //Ecriture dans le fichier
    $fichier->asXML($chemin);
}


/*********
 * A voir si la fonction est utile
 * Potentiel : si on créer un compte Admin
 * probleme : sécurité
 */
function importerClientsFichier(){
    $chemin = "../data/user.xml";

    //Ouverture du fichier
    $fichier = simplexml_load_file($chemin);

    //Initialisation d'un tableau vide qui va accueillir les client
    $clients = array();

    foreach($fichier->client as $client){
        $clients[] = array(
            "sexe" => trim($client->sexe),
            "nom" => trim($client->nom),
            "prenom" => trim($client->prenom),
            "naissance" => trim($client->naissance),
            "mail" => trim($client->mail),
            "password" => trim($client->pwd),
            "admin" => trim($client->admin));
    }
    return $clients;
}

/*******************
 * Panier *
 *******************/

 function ajouterProduitPanier(){
    //Récupération de la quantité voulue
    $reference = $_POST['reference'];
    $quantite = $_POST['quantite'];

    //Si le panier n'existe pas
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
    }

    //Si le panier n'est pas déja dans le panier
    if(empty($_SESSION['panier'][$reference])){
        $_SESSION['panier'][$reference] = $quantite;
    }
    else{ //Sinon on ajoute à la quantité du panier
        $_SESSION['panier'][$reference] += $quantite;
    }

    miseAJourStock($categorie, $reference, $quantite);
    
    //On renvoie vers la page d'origine
    header('Location: ' . $_SERVER['HTTP_REFERER']);
 }
?>
<?php

include_once('../bdd/bdd.php');

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
    

    //Initialisation d'un tableau vide qui va accueillir les produits
    $cat = array();

    //Vérification de l'ouverture du fichier
    if ($open != NULL){
        $ligne = fgets($open);
        //Lecture de chaque ligne du fichier
        while($ligne != NULL){
            //Séparation des données de la ligne
            $donnee = explode(';', $ligne);
            $categorie = $donnee[0];
            $cat[$categorie][]= array(
                'categorie' => $categorie,
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




//Fonction pour exporter tout les produits vers un fichier
//Option pour l'admin 
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
    if(estAdmin()){
        echo "<button onclick='afficherStock()' id='bouton-Stock'>Afficher/Masquer Stock</button>";
    }
}

//Mise à jour du stock dans la variable de session
function miseAJourStock($reference, $quantite){
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

function trouverProduit($reference){
    // Parcours de chaque categorie
    foreach($_SESSION['categorie'] as &$produits){
        // Parcours de chaque produit dans la categorie
        foreach($produits as &$produit){
            if($produit['reference'] ===  $reference){
                return $produit;
            }
        }
    }
    return null;
}

function miseAJourStockFichier($reference, $quantite){
    $fichier = "../data/stock.txt";

    //Ouverture du fichier
    $open = fopen($fichier, "r+");
    
    if($open != NULL){
        $ligne = fgets($open);
        while($ligne != NULL){
            //Décomposition de la ligne
            $donnee = explode(';', $ligne);
            if(trim($donnee[2]) == $reference){
                $donnee[5] = intval(trim($quantite));

                //Reconstruction de la ligne
                $ligneMaJ = implode(';', $donnee);
                
                //On replace le curseur en début de ligne
                fseek($open, ftell($open) - strlen($ligne));

                fwrite($open, $ligneMaJ);
                
            }
            $ligne = fgets($open);
        }
        fclose($open);
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

//Retourne si un client est un admin ou pas
function estAdmin(){
    if(!isset($_SESSION['user'])){
        return false;
    }
    else{
        if(boolval($_SESSION['user']['admin'])){
            return true;
        }
        return false;
    }
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

    //Ajoute au panier si l'article n'y est pas
    if(empty($_SESSION['panier'][$reference])){
        $_SESSION['panier'][$reference] = $quantite;
    }
    else{ //Sinon on ajoute à la quantité déjà présente dans le panier
        $_SESSION['panier'][$reference] += $quantite;
    }

    miseAJourStock( $reference, $quantite);
    
    //On renvoie vers la page d'origine
    header('Location: ' . $_SERVER['HTTP_REFERER']);
 }


 function afficherPanier(){
    if(!empty($_SESSION['panier'])){
         //Le panier n'est pas vide
        $sommePanier= 0;
        echo "<table>";
        echo "<tr>
            <th>Photo</th>
            <th>Référence</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Prix total</th>
            </tr>";

            
        foreach($_SESSION['panier'] as $reference => $quantite){
            $produit = trouverProduit($reference);

            if($produit != null){
                echo "<tr>";
                echo "<td><img src='".$produit['photo']."' class='photo-article' onclick='afficherImage(this)'></td>";
                echo "<td>".$produit['reference']."</td>";
                echo "<td>".$quantite."</td>";
                echo "<td>".$produit['prix']." €</td>";
                echo "<td>".$produit['prix']*$quantite." €</td>";
                echo "</tr>";
                $sommePanier += $produit['prix']*$quantite;
            }
            
        }
        echo "<tr>
            <td colspan='3'></td>
            <td colspan='2'>Prix Total : $sommePanier €</td>
        </tr>";
        echo "</table>";

        echo "<form action='form.php' method='post'>
        <input  type='submit' value='Vider le Panier'>
        <input type='hidden' name='action' value='viderPanier'>
        </form>";
    }
 }
 //echo("<input type='button' value='Vider le panier'>")
 function viderPanier(){

    //Ajoute au panier si l'article n'y est pas
    foreach($_SESSION['panier'] as $reference => $quantite){

    // le moins est pour remettre le stock au catalogue
    miseAJourStock($reference, -$quantite);
      
    }
    unset($_SESSION['panier']);

    //On renvoie vers la page d'origine
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function afficherTicket(){
    if(!empty($_SESSION['panier'])){
        $sommePanier= 0;
        echo "<table>";
        echo "<tr>
            <th>Référence</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Prix total</th>
            </tr>";
        
            foreach($_SESSION['panier'] as $reference => $quantite){
                $produit = trouverProduit($reference);

                if($produit != null){
                    echo "<tr>";
                    echo "<td>".$produit['reference']."</td>";
                    echo "<td>".$quantite."</td>";
                    echo "<td>".$produit['prix']." €</td>";
                    echo "<td>".$produit['prix']*$quantite." €</td>";
                    echo "</tr>";
                    $sommePanier += $produit['prix']*$quantite;
                    miseAJourStockBDD($produit['reference'],$produit['stock']);
                }
            }

            echo "<tr>
            <td colspan='2'></td>
            <td colspan='2'>Prix Total : $sommePanier €</td>
            </tr>";
        echo "</table>";
        
        //On vide la panier
        unset($_SESSION['panier']);
    }
}
?>


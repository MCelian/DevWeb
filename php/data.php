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

//Permet d'afficher les produits de la catégorie passé en paramètre
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
        if($produit['stock'] <= 0){
            echo "<td>Produit en rupture de stock </td>";
        }
        else{ //Sinon le client peut choisir le produit
            echo "<td>
                <form>
                    <input type='button' value='-' disabled onclick='retirerDuPanier(this)'>
                    <input type='text' value='0' readonly class='quantite-voulue' name='quantite'>
                    <input type='button' value='+' onclick='ajouterAuPanier(this)'> <br>
                    <input type='hidden' name='action' value='panier'>
                    <input type='hidden' name='reference' value='".$produit['reference']."'>
                    <input type='button' name='submit' value='Ajouter au panier' onclick='AjouterProduitPanierAjax(this)' disabled>
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

//Permet de recupérer les caractéristiques d'un produit
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

/************
* Clients *
**************/



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

//Ajoute un produit au panier
function ajouterProduitPanier(){
    //Récupération de la quantité voulue
    $reference = $_POST['reference'];
    $quantite = $_POST['quantite'];

    //Vérification de la disponibilité du produit
    if(checkStockBDD($reference, $quantite)){
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
        miseAJourStockBDD($reference, $quantite);
    }
    else{
        echo "le produit n'est plus disponible, nous nous excusons pour la gène occationnée";
    }
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

        echo "<tr>
            <td colspan='1'>
            <form action='form.php' method='post'>
            <input  type='submit' value='Vider le Panier'>
            <input type='hidden' name='action' value='viderPanier'>
            </form>
            </td>
        ";

        if(empty($_SESSION['user'])){
            echo "<td colspan='4'>
                Merci de vous connecter pour valider le panier
            </td>";
        }
        else{
            echo "<td colspan='4'>
            <form action='form.php' method='post'>
            <input  type='submit' value='Valider le Panier'>
            <input type='hidden' name='action' value='validerPanier'>
            </form>
            </td>";
        }
        echo "</tr></table>";

    }
    elseif(empty($_SESSION['panier'])){
        echo "Le panier est vide";
    }
    else{

    }
 }

 //Vide le panier
 function viderPanier(){

    //Ajoute au panier si l'article n'y est pas
    foreach($_SESSION['panier'] as $reference => $quantite){

    // le moins est pour remettre le stock au catalogue
    miseAJourStock($reference, -$quantite);
    miseAJourStockBDD($reference, -$quantite);
      
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
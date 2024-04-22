<?php

include_once('../bdd/bdd.php');

/***********
* Menu *
************/
//Permet l'affichage automatique des menus
function afficherMenu(){
    foreach($_SESSION['categorie'] as $key => $elm){
        echo "<li><a href='../php/produits.php?cat=$key'>$key</a></li>\n";
    }
}

/***********
* Produits *
************/

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
                    <input class='bouton_stock' type='button' value='-' disabled onclick='retirerDuPanier(this)'>
                    <input type='text' value='0' readonly class='quantite-voulue' name='quantite'>
                    <input class='bouton_stock' type='button' value='+' onclick='ajouterAuPanier(this)'> <br>
                    <input type='hidden' name='action' value='panier'>
                    <input type='hidden' name='reference' value='".$produit['reference']."'>
                    <input class='bouton_stock' type='button' name='submit' value='Ajouter au panier' onclick='AjouterProduitPanierAjax(this)' disabled>
                </form>
            </td>";

        }
        echo "</tr>";
    }
    
    echo "</table>";
    if(estAdmin()){
        echo "<button class='bouton_stock' onclick='afficherStock()' id='bouton-Stock'>Afficher/Masquer Stock</button>";
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
        echo "le produit n'est plus disponible, nous nous excusons pour la gène occasionnée.";
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
            <input class='bouton_stock' type='submit' value='Vider le Panier'>
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
            <input class='bouton_stock' type='submit' value='Valider le Panier'>
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
        echo "<table id='table_ticket'>";
        echo "<tr>
            <th class='th_ticket'>Référence</th>
            <th class='th_ticket'>Quantité</th>
            <th class='th_ticket'>Prix unitaire</th>
            <th class='th_ticket'>Prix total</th>
            </tr>";
        
            foreach($_SESSION['panier'] as $reference => $quantite){
                $produit = trouverProduit($reference);

                if($produit != null){
                    echo "<tr>";
                    echo "<td class='td_ticket'>".$produit['reference']."</td>";
                    echo "<td class='td_ticket'>".$quantite."</td>";
                    echo "<td class='td_ticket'>".$produit['prix']." €</td>";
                    echo "<td class='td_ticket'>".$produit['prix']*$quantite." €</td>";
                    echo "</tr>";
                    $sommePanier += $produit['prix']*$quantite;
                }
            }

            echo "<tr>
            <td colspan='2' class='td_ticket'></td>
            <td colspan='2' class='td_ticket'><b>Prix Total : $sommePanier €</b></td>
            </tr>";
        echo "</table>";
        
        //On vide le panier
        unset($_SESSION['panier']);
    }
}
?>
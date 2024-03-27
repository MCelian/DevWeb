<?php

session_start();
if(! isset($_SESSION['categorie'])) require('../php/varSession.inc.php');

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

?>
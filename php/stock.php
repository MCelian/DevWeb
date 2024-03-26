<?php

session_start();
if(! isset($_SESSION['categorie'])) include('../php/varSession.inc.php');

function afficherProduits($categorie){
    //récuperation des produits de la categorie voulue
    $donnees =  $_SESSION['categorie'][$categorie];
    echo "<h1>". $categorie."</h1>";
    echo "<table>";
    echo "<tr>\n
        <th>Photo</th>\n
        <th>Référence</th>\n
        <th>Description</th>\n
        <th>Prix</th>\n
        <th class='stock'>Stock</th>\n
        <th>Commande</th>\n
        </tr>\n <br>";

    foreach($donnees as $produit){
        echo "<tr>";
        echo "<td><img src=".$produit['photo']." class='photo-article' onclick='afficherImage(this)'></td>";
        echo "<td>".$produit['reference']."</td>";
        echo "<td>".$produit['description']."</td>";
        echo "<td>".$produit['prix']." €</td>";
        echo "<td class='stock'>".$produit['stock']."</td>";
        echo "<td>\n
                <form action='' method='post'>\n
                    <input type='button' value='-' disabled onclick='retirerDuPanier(this)'>\n
                    <input type='text' value='0' readonly class='quantite-voulue'>\n
                    <input type='button' value='+' onclick='ajouterAuPanier(this)'> <br>\n
                    <input type='submit' value='Ajouter au panier' disabled>\n
                </form>\n
                </td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<button onclick='afficherStock()' id='bouton-Stock'>Afficher/Masquer Stock</button>";
}

?>
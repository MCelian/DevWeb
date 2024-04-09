<?php 

session_start();

include('../bdd/bdd.php');

/******************
* Tableau des produits *
*******************/
$_SESSION['categorie'] = importerProduitsBDD();
?>
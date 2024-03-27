<?php 

session_start();

include('../php/importer.php');

/******************
* Tableau des produits *
*******************/
$_SESSION['categorie'] = importerProduitsFichier();
?>
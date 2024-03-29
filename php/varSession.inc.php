<?php 

session_start();

include('../php/data.php');

/******************
* Tableau des produits *
*******************/
$_SESSION['categorie'] = importerProduitsFichier();

?>
<?php
    session_start();

    if(! isset($_SESSION['categorie'])) include('../php/varSession.inc.php');


    function afficherMenu(){
        foreach($_SESSION['categorie'] as $key => $elm){
            echo "<li><a href='../php/produits.php?cat=$key'>$key</a></li>\n";
        }
    }
?>
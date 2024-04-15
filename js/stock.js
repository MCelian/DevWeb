/***********
* Afficher / Masquer les stocks des produits *  
************/

function afficherStock() {
    //récuperation de toutes les cases du tableau contenant un stock
    var stocks = document.querySelectorAll(".stock");
    for(let i = 0; i < stocks.length; i++)
        //toggle : fonctionne de manière binaire ajouter ou supprimer la classe
        stocks[i].classList.toggle("afficherStock"); 
}


/*************
* Gestion des produits pour la commande *
**************/

function ajouterAuPanier(bouton){
    var quantite = bouton.previousElementSibling;
    var stock = bouton.closest('tr').querySelector('.stock');
    
    //Conversion en entier
    var Intquantite = parseInt(quantite.value);
    var Intstock = parseInt(stock.innerHTML);
    
    if (Intquantite < Intstock){
        Intquantite++;
        quantite.value = Intquantite;
        miseAJourBouton(bouton.parentNode, Intquantite, Intstock);
    }
}

function retirerDuPanier(bouton){
    var quantite = bouton.nextElementSibling;

    //conversion en entier
    var Intquantite = parseInt(quantite.value);
    
    if(Intquantite > 0){
        Intquantite--;
        quantite.value = Intquantite;
        miseAJourBouton(bouton.parentNode, Intquantite);
    }
}

//Active/Déactive les boutons pour la commande
function miseAJourBouton(parent,quantite,stock){
    var boutonPlus = parent.querySelector('[value="+"]');
    var boutonMoins = parent.querySelector('[value="-"]');
    var boutonEnvoi = parent.querySelector('[name="submit"]');

    boutonPlus.disabled = (quantite >= stock) ? true : false ;

    if ( quantite <= 0){
        boutonMoins.disabled = true;
        boutonEnvoi.disabled = true;
    }
    else{
        boutonMoins.disabled = false;
        boutonEnvoi.disabled = false;
    }
}
//Vérifie si le message de rupture de stock doit être afficher
function messageRuptureStock(parent, stock){
    if(stock <= 0){
        var message = document.createElement('span');
        message.textContent = "Produit en rupture de stock";
        //On remplace le formulaire par le message
        parent.parentNode.replaceChild(message, parent);
    }
}

/**********
* Fonctions pour le zoom des image * 
***********/

function afficherImage(image){
    var overlay = document.getElementById('popup-overlay');
    var popup = document.getElementById('popup');
    var imageZoome = document.getElementById('image-popup');
    imageZoome.src = image.src;
    imageZoome.alt = image.alt;
    popup.style.display = 'block';
    overlay.style.display = 'block';
}

function fermerImage(){
    var overlay = document.getElementById('popup-overlay');
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
    overlay.style.display = 'none';
}

/**********
* Fonctions pour le popup de confirmation ajout au panier* 
***********/

function afficherConfirmation(reference, quantite){
    var overlay = document.getElementById('overlay_confirmation');
    var popup = document.getElementById('confirmation_popup');
    var popupReference = document.getElementById('reference_confirmation');
    var popupquantite = document.getElementById('quantite_confirmation');


    popupReference.textContent = reference;
    popupquantite.textContent = quantite;
    popup.style.display = 'block';
    overlay.style.display = 'block';
}

function fermerConfirmation(){
    var overlay = document.getElementById('overlay_confirmation');
    var popup = document.getElementById('confirmation_popup');
    popup.style.display = 'none';
    overlay.style.display = 'none';
}
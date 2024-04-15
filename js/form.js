//Fichier réservé pour la vérification des formulaires


/*********
 * Formulaire de Contact *
 *********/

function checkContact() {
    // Récupération des éléments du formulaire
    var contact = document.getElementById('contactForm');
    var erreur = false;
    //informations à vérifier
    var informations = ['date','nom', 'prenom', 'email', 'naissance', 'fonction', 'sujet', 'contenu'];
    var genre = document.getElementsByName('genre');

    for (var i = 0; i < informations.length; i++) {
        var data = document.getElementsByName(informations[i]);
        //Vérification d'aucune case soit vide
        if(!checkChampVide(data[0])){
            erreur = true;
        }
        //Vérication de la date de naissance
        if(informations[i] == 'naissance'){
            if(!checkNaissance(data[0])){
                erreur = true;
            }
        }
        //Vérification du format de l'adresse mail
        if(informations[i] == 'email'){
            if(!checkFormatEmail(data[0])){
                erreur = true;
            }
        }
        //Vérification qu'une fonction à été choisi
        if(informations[i] == 'fonction'){
            if(!checkFonctionVide(data[0])){
                erreur = true;
            }
        }
    }
    //Vérification qu'un sexe à été choisi
    if(!checkGenreVide(genre)){
        erreur = true;
    }
    
    //Return si le formulaire doit être envoyer ou pas
    return erreur ?  false : true;

}

/*********
 * Formulaire de Connexion *
 *********/

function checkConnexion(){
    // Récupération des éléments du formulaire
    var login = document.getElementById('loginForm');
    var erreur = false;

    var informations = ['email', 'password'];
    for(var i = 0; i < informations.length; i++){
        var data = document.getElementsByName(informations[i]);

        //Vérification d'aucune case soit vide
        if(!checkChampVide(data[0])){
            erreur = true;
        }

        if(informations[i] == 'email'){
            if(!checkFormatEmail(data[0])){
                erreur = true;
            }
        }
    }


    //Return si le formulaire doit être envoyer ou pas
    return erreur ?  false : true;
}


/*********
 * Formulaire d'Inscription *
 *********/

function checkInscription(){
    // Récupération des éléments du formulaire
    var inscription = document.getElementById('inscriptionForm');
    var erreur = false;

    //informations à vérifier
    var informations = ['nom', 'prenom', 'naissance', 'email', 'password', 'confirmpwd'];
    var genre = document.getElementsByName('genre');

    for(var i = 0; i < informations.length ; i++){
        var data = document.getElementsByName(informations[i]);

        //Vérification d'aucune case soit vide
        if(!checkChampVide(data[0])){
            erreur = true;
        }
        if(informations[i] == 'naissance'){
            if(!checkNaissance(data[0])){
                erreur = true;
            }
        }
        //Vérification du format de l'adresse mail
        if(informations[i] == 'email'){
            if(!checkFormatEmail(data[0])){
                erreur = true;
            }
        }

        //Vérifier la force du mot de passe
        if(informations[i] == 'password'){
            if(!checkForcePwd(data[0])){
                erreur = true;
            }
        }
    }
    //Vérification qu'un sexe à été choisi
    if(!checkGenreVide(genre)){
        erreur = true;
    }

    //Vérification de la confirmation du Mot de passe
   if(!checkConfirmPwd()){
        erreur = true;
    }
    
    //Return si le formulaire doit être envoyer ou pas
    return erreur ?  false : true;
}

/*********
 * Fonctions communes aux formulaires *
 *********/

// Vérifier si un champ est vide
function checkChampVide(champ) {
    if (champ.value.trim() == '') {
        champ.classList.add('erreurCase');
        var message = champ.parentNode.querySelector('.messageErreur');
        if(!message){
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Champ Requis";
            
            champ.parentNode.appendChild(message);  
        }
        return false;
    } else {
        champ.classList.remove('erreurCase');
        var message = champ.parentNode.querySelector('.messageErreur');
        if(message){
            champ.parentNode.removeChild(message);
        }
        return true;
    }
}

//Vérifier si un genre a bien été choisi
function checkGenreVide(genre){
    if(!genre[0].checked && !genre[1].checked && !genre[2].checked){
        var message = genre[0].parentNode.querySelector('.messageErreur');
        if(!message){
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Champ Requis";
            
            genre[0].parentNode.appendChild(message);
        }
        return false;
    }
    else{
        var message = genre[0].parentNode.querySelector('.messageErreur');
        if(message != null){
            genre[0].parentNode.removeChild(message);
        }
        return true;
    }
}

//Vérifier si le format de l'adresse mail est valide
function checkFormatEmail(email){
    //Format d'un adresse mail valide
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexEmail.test(email.value)) {
        email.classList.add('erreurCase');
        var message = email.parentNode.querySelector('.messageErreur');
        if (!message) {
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Format d'email invalide";
            
            email.parentNode.appendChild(message);
        }
        return false;
    } else {
        email.classList.remove('erreurCase');
        var message = email.parentNode.querySelector('.messageErreur');
        if (message != null) {
            email.parentNode.removeChild(message);
        }
        return true;
    }
}


//Vérifier si la case fonction a bien été choisi
function checkFonctionVide(fonction){
    if(fonction.value == 'default'){
        fonction.classList.add('erreurCase');
        var message = fonction.parentNode.querySelector('.messageErreur');
        if(!message){
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Champ Requis";
            
            fonction.parentNode.appendChild(message);  
        }
        return false;
    } else {
        fonction.classList.remove('erreurCase');
        var message = fonction.parentNode.querySelector('.messageErreur');
        if(message){
            fonction.parentNode.removeChild(message);
        }
        return true;
        }
}


//Vérifier si le mot de passe est fort
function checkForcePwd(pwd){

    //Le mot de passe doit avoir au moins une majuscule, une minuscule, un chiffre et un caractère spécial et de taille minimum 8
    var regexPwd = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{":;''?/>.<,])(?=.{8,})/;

    if (!regexPwd.test(pwd.value)) {
        pwd.classList.add('erreurCase');
        var message = pwd.parentNode.querySelector('.messageErreur');
        if (!message) {
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Le mot de passe doit contenir au moins 8 caractères avec une majuscule, une minuscule, un chiffre et un caractère spécial ";        
            pwd.parentNode.appendChild(message);
        }
        return false;
    } else {
        pwd.classList.remove('erreurCase');
        var message = pwd.parentNode.querySelector('.messageErreur');
        if (message != null) {
            pwd.parentNode.removeChild(message);
        }
        return true;
    }
}

//Vérifier si la case pwd et confirmpwd sont égales
function checkConfirmPwd(){
    var pwd = document.getElementsByName('password');
    var confirmpwd = document.getElementsByName('confirmpwd');
    if(pwd[0].value.trim() != confirmpwd[0].value.trim()){
        confirmpwd[0].classList.add('erreurCase');
        var message = confirmpwd[0].parentNode.querySelector('.messageErreur');
        if(!message){
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Mot de passe différent";
            confirmpwd[0].parentNode.appendChild(message);
        }
        return false;
    }
    else{
        confirmpwd[0].classList.remove('erreurCase');
        var message = confirmpwd[0].parentNode.querySelector('.messageErreur');
        if(message){
            confirmpwd[0].parentNode.removeChild(message);
        }
        return true;
    }
}

//Vérifier si la date de naissance n'est pas dans le futur
function checkNaissance(naissance) {
    if(naissance.value !=''){
        var date = new Date().toISOString().slice(0,10);
        //Convertion de la date au format Y-m-d
        var dateNaissance = new Date(naissance.value).toISOString().slice(0,10);
    if(dateNaissance > date ){
        naissance.classList.add('erreurCase');
        var message = naissance.parentNode.querySelector('.messageErreur');
        if (!message) {
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Date invalide";
            
            naissance.parentNode.appendChild(message);
        }
        return false;
    }
    else{
        naissance.classList.remove('erreurCase');
        var message = naissance.parentNode.querySelector('.messageErreur');
        if (message != null) {
            naissance.parentNode.removeChild(message);
        }
        return true;
    } 
    }
    else{
        return false;
    }
    
}


//Ajouter un produits au panier AJAX
function AjouterProduitPanierAjax(bouton) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //Récupération du stock
            var stock = bouton.closest('tr').querySelector('.stock');
            //Convertion en entier
            var Intstock = parseInt(stock.innerHTML);
            //Conversion en entier
            var Intquantite = parseInt(quantite.value);
            //Déduction de la quantité voulue
            Intstock -= Intquantite;
            //Changement du stock affiché
            stock.textContent = Intstock;
            
            //Active/Déactive les boutons pour la commande
            miseAJourBouton(bouton.parentNode, quantite.value, Intstock);
            
            messageRuptureStock(bouton.parentNode, Intstock);
            //Affiche un message de confirmation
            afficherConfirmation(reference, quantite.value);

            //Remise à zéro de la quantité voulue
            quantite.value = 0;
        }
    };
    
    var quantite = bouton.parentNode.querySelector('[name="quantite"]');
    var reference = bouton.parentNode.querySelector('[name="reference"]').value;
    var params = "action=panier&reference=" + reference + "&quantite=" + quantite.value;
    xhttp.open("POST", "form.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}

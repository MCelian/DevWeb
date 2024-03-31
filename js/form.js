//Fichier réservé pour la vérification des formulaire



// Formulaire de Contact
function checkContact() {
    // Récupération des éléments du formulaire
    var contact = document.getElementById('contactForm');
    var erreur = false;
    //informations à vérifier
    var informations = ['date','nom', 'prenom', 'email', 'naissance', 'fonction', 'sujet', 'contenu'];
    var genre = document.getElementsByName('genre');

    for (var i = 0; i < informations.length; i++) {
        var data = document.getElementsByName(informations[i]);
        if(!checkChampVide(data[0])){
            erreur = true;
        }
        if(informations[i] == 'email'){
            if(checkFormatEmail(data[0])){
                erreur = true;
            }
        }
    }
    if(!checkGenreVide(genre)){
        erreur = true;
    }
    
    //Return si le formulaire doit être envoyer ou pas
    return erreur ?  false : true;

}

// Vérifier si un champ est vide
function checkChampVide(champ) {
    if (champ.value.trim() == '') {
        champ.classList.add('champVide');
        var message = champ.parentNode.querySelector('.messageErreur');
        if(!message){
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Champ Requis";
            message.style.color = 'red';
            champ.parentNode.appendChild(message);  
        }
        return false;
    } else {
        champ.classList.remove('champVide');
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
            message.style.color = 'red';
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
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
8
    if (!regexEmail.test(email.value)) {
        email.classList.add('champVide');
        var message = email.parentNode.querySelector('.messageErreur');
        if (!message) {
            message = document.createElement('span');
            message.classList.add('messageErreur');
            message.textContent = "Format d'email invalide";
            message.style.color = 'red';
            email.parentNode.appendChild(message);
        }
        return false;
    } else {
        email.classList.remove('champVide');
        var message = email.parentNode.querySelector('.messageErreur');
        if (message != null) {
            email.parentNode.removeChild(message);
        }
        return true;
    }
}

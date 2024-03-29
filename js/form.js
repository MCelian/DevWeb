//Fichier réservé pour la vérification des formulaire



// Formulaire de Contact
function checkContact() {
    // Récupération des éléments du formulaire
    var contact = document.getElementById('contactForm');
    
    var informations = ['date', 'nom', 'prenom', 'email', 'naissance', 'fonction', 'sujet', 'contenu'];
    var genre = document.getElementById('genre');
    for (var i = 0; i < informations.length; i++) {
        var data = document.getElementsByName(informations[i]);
        checkChampVide(data[0]);
        console.log(data);
    }
}

// Vérifier si un champ est vide
function checkChampVide(champ) {
    if (champ.value.trim() === '') {
        champ.classList.add('champVide');
        var message = document.createElement('span');
        message.classList.add('messageErreur');
        message.textContent = "Champ Vide";
        champ.parentNode.append(message);
    } else {
        champ.classList.remove('champVide');
        champ.parentNode.removeChild('.messageErreur');
    }
}

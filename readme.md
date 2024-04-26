Bonjour,

Utilisation :

Vous devez démarrer un serveur php, pour cela:

-Dans un terminal, placez vous dans le répertoire où se trouve ce projet
    cd path
    exemple : cd ~/Desktop/DevWeb

-Vous pouvez démarrer un serveur php avec la commande :
    php -S localhost:8080

Maintenant vous pouvez accéder au site internet en entrant dans la barre de recherche de votre navigateur préféré :
    localhost:8080/php/index.php

Première utilisation :

Avant d'utiliser le site pour la première fois, vous devez importer la base de données et ce qu'elle contient manuellement.

-Pour lancer un terminal MySql, entrer dans votre console : mysql -u root -p
-Une fois dans votre terminal MySql, vous allez insérer les fichiers suivant :
    source path/néomania.sql;
    source path/néomaniadata.sql;
    exemple : source  ~/Desktop/DevWeb/sql/néomania.sql

-Quittez votre terminal mysql en entrant : exit;

Pour terminer, changer le mot de passe du fichier bddData.php du répertoire bdd :
    const MYSQL_PASSWORD='Votre mot de passe';
    exemple: MYSQL_PASSWORD='ABCD963';


Compte Administrateur :

Si vous souhaitez vous connecter en tant qu'adminstrateur, vous pouvez utiliser le compte :
    identifiant : mignotceli@cy-tech.fr
    mot de passe : Cytech0001!

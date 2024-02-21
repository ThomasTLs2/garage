# Garage V.Parrot

Une application site web qui permet de 

## Fonctionnalités

Liste des fonctionnalités principales de votre projet.
- Ajout Vehicule
- Filtre Vehicule
- Creation compte, pour le personnels 
- Fonction Ouverture et Fermeture du Garage
- Gestion/ moderation commentaire
- modification Commentaire 


## Technologies Utilisées

- HTML
- CSS
- JavaScript
- PHP
- MariaDB

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les logiciels suivants :
- Un serveur web comme Apache ou Nginx
- PHP 
- MariaDB
- Un navigateur web moderne



## Installation
Assurez-vous qu'Apache est installé et en cours d'exécution :

Installez Apache s'il n'est pas déjà installé : sudo apt-get install apache2. ou 
                                                sudo dnf install 
Démarrez le service Apache : sudo service apache2 start.
Placez vos fichiers dans le répertoire /var/www/html :

Copiez tous les fichiers de votre site dans le répertoire /var/www/html.
Accédez à votre site via le navigateur :

Ouvrez votre navigateur web et accédez à l'URL suivante : http://localhost.
Assurez-vous que vous pouvez voir votre site correctement.
Vérifiez les permissions des fichiers :

suivante pour définir les permissions correctes :
bash
"sudo chown -R www-data:www-data /var/www/html""
Configuration du site :

 http://localhost/garage/html/index.php

### Cloner le projet

Commencez par cloner le projet sur votre machine locale :

```bash
git clone https://github.com/ThomasTLs2/garage.git
cd garage

php creation_databases.php
php creation_tables.php 



#Admin

Pour accéder au service la creation ce fait du compte dans la bases de donnée ce fait automatiquement 

email : admin@admin.com

mot-de-passe : admin

nom : admin

prenom : admin 

Role : Administrateur


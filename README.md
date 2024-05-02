![Logo](img/logo.png)
# Recette Cosmétique

Ce projet est un exemple de site web de recettes de cosmétiques permettant de trouver des recettes mais aussi de proposer les siennes. Il est développé en utilisant PHP et repose sur un système de fichiers CSV pour stocker les données des utilisateurs, des recettes et des commentaires.
## Fonctionnalités
### Côté utilisateur
   - Inscription et connexion.
   - Affichage du profil de l'utilisateur, y compris les informations personnelles et ses commentaires.
   - Modification du mot de passe.
   - Modification de la photo de profil.
   - Suppression du compte.
   - Tri des commentaires par date et par note.
   - Recherche de recettes via barre de recherche dynamique.
   - Ajouter un commentaire à une recette.
   - Supprimer ses commentaires.
   - Ajouter une note à une recette.
   - Pouvoir proposer votre prore recette.

### Côté administrateur
   - Valider ou refuser les recettes proposées par des utilisateurs.
   - Supprimer une recette déjà validée directement depuis la recette.

## Configuration
   - Téléchargez ce dépôt dans votre répertoire de projet.
   - Assurez-vous d'être dans le dossier du site sur votre terminal.
   - Configurez votre serveur avec la commande: `php -S localhost:8000`
   - Puis accédez à ce lien http://localhost:8080/index.php dans votre navigateur.

## Structure du Projet

   - **index.php**: Page d'accueil de l'application avec les fonctionnalités d'inscription et de connexion.
   - **csv/**: Répertoire contenant les fichiers CSV pour stocker les données.
       - **utilisateurs.csv**: Fichier CSV contenant les informations des utilisateurs (nom d'utilisateur, mot de passe, etc.).
       - **commentaire.csv**: Fichier CSV contenant les commentaires des utilisateurs (commentaire, note, etc.).
       - **etapes.csv**: Fichier CSV contenant les étapes des recettes (id_recette, étapes, etc.).
       - **recettes.csv**: Fichier CSV contenant les infomations des recettes (id, nom, image, ingrédients, ect.).

   - **img/**: Répertoire pour stocker les images utilisées sur nos pages.
   - **Connexion.php**: Connexion pour accéder à la page avec un compte crée au préalable
   - **Inscription.php**: Inscription avec refus si le nom  d'utilisateur est déjà utilisé
   - **form_accueil.php**: Page de présentation des recettes avec la barre de recherche.
   - **faq.html**: Page FAQ, pour donner quelques informations générales.
   - **tri.css**: Fichier css lié aux pages contenant un tri de commentaires (*form_recette.php*, *form_profil.php*).
   - **form_ajoutCommentaire.php**: Page d'ajout de commentaire sur une recette donnée.
   - **form_ajoutNote.php**: Page d'ajout de note sur une recette donnée.
   - **form_recette.php**: Page de présentation d'une recette (préparation, commentaires), qui change selon la validité de la recette. 
   - **form_recetteAValider.php**: Comme la page *form_accueil.php*, mais pour les recettes pas encore validées et sans barre de recherche.
   - **form_profil.php**: Page du profil de l'utilisateur, affichant les informations personnelles et les commentaires triés.


Les fichiers sous forme **php_#####.php** sont tous liés à son fichier correspondant et ne contiennent que du php.



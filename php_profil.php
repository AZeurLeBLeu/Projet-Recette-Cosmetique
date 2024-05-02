<?php
// Démarrer la session
session_start();



// Récupérer les informations de l'utilisateur à partir de la session
$username = $_SESSION['username'];
$password = $_SESSION['password'];



function supprimerCommentaire($commentId) {
  // Lire le fichier CSV
  $lignes = file('csv/commentaire.csv');

  // Parcourir les lignes et supprimer le commentaire correspondant
  foreach ($lignes as $index => $ligne) {
      $commentaire = str_getcsv($ligne);
      if ($commentaire[0] === $commentId) {
          unset($lignes[$index]);
          break;
      }
  }

  // Réécrire le fichier CSV sans le commentaire supprimé
  file_put_contents('csv/commentaire.csv', implode('', $lignes));
}


$fichier = fopen('csv/utilisateurs.csv', 'r');
if ($fichier !== false) {
    while (($ligne = fgetcsv($fichier)) !== false) {
        if ($username == $ligne[0]) {  
            $image = $ligne[3];
        }
    }
    fclose($fichier);
}

// Afficher les informations de l'utilisateur et les commentaires tri

echo '<head>  <style>.profil{border:solid black; width:350px; height:160px; border-radius:30px;background-color:lightgrey;}</style>
<center><div class="profil">
<h1>Mon profil</h1>
<p><strong>Nom d\'utilisateur :</strong> ' . $username . '</p>
<p><strong>Mot de passe :</strong> ' . $password. '</p></div></center>';


echo '
    <form method="POST" action="">
        <input class="" type="hidden" name="sup_compte" required>
        <button class="" type="submit" name="sup_compte">Supprimer votre compte</button>
    </form>';


// afficher un bouton pour modifier son mot de passe
echo '<style>.mdp{border:solid grey;
     margin-left:400px; 
     border-radius:20px;
     padding:10px; 
     width:1000px;
    }
.password{width: 100%;
    padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;

}
.submitpassword{width: 100%;
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
border-radius: 4px;
cursor: pointer;}
.pdp{border-radius:100px;}
</style>
<div class="mdp">
    <form method="POST" action="">
        <input class="password" type="text" name="new_password" placeholder="Nouveau mot de passe" required>
        <button class="submitpassword" type="submit" name="submit_password">Modifier votre mot de passe</button>
    </form><p><strong>Photo de profil: </strong></p>
        <center><img class="pdp" src="'. $image .'" style="width: 200px;"></center>
    <form method="POST" action="">
        <input class="password" type="text" name="new_photo" placeholder="Lien de votre nouvelle photo de profil" required>
        <button class="submitpassword" type="submit" name="submit_photo">Modifier votre photo de profil</button>
    </form>
</div>';
// afficher un bouton pour modifier sa photo de profil

// ...

////////// Changer de mot de passe////////////////////////////////////////
if (isset($_POST['new_password'])) {
    // Récupérer le nouveau mot de passe
    $nouveau_mot_de_passe = $_POST['new_password'];

    // Lecture du fichier CSV
    $lignes = file('csv/utilisateurs.csv');

    // Rechercher l'utilisateur dans les lignes
    foreach ($lignes as $index => $ligne) {
        $utilisateur = str_getcsv($ligne);
        if ($utilisateur[0] == $username) {
            // Mettre à jour le mot de passe de l'utilisateur
            $utilisateur[1] = $nouveau_mot_de_passe;

            // Reconstruire la ligne avec les données mises à jour
            $nouvelle_ligne = implode(',', $utilisateur) . PHP_EOL;

            // Remplacer la ligne existante par la nouvelle ligne
            $lignes[$index] = $nouvelle_ligne;

            // Écrire les données mises à jour dans le fichier
            file_put_contents('csv/utilisateurs.csv', implode('', $lignes));
            $_SESSION['password'] = $nouveau_mot_de_passe;
            break;
        }
    }

    // Afficher un message de succès
    echo "Le mot de passe a été modifié avec succès.";
    header('Location: form_profil.php');
}

//////////// Changer de photo de profil ///////////////////////////////////////////

if (isset($_POST['new_photo'])) {
    // Récupérer le nouveau mot de passe
    $nouvelle_photo = $_POST['new_photo'];

    // Lecture du fichier CSV
    $lignes = file('csv/utilisateurs.csv');

    // Rechercher l'utilisateur dans les lignes
    foreach ($lignes as $index => $ligne) {
        $utilisateur = str_getcsv($ligne);
        if ($utilisateur[0] == $username) {
            // Mettre à jour le mot de passe de l'utilisateur
            $utilisateur[3] = $nouvelle_photo;

            // Reconstruire la ligne avec les données mises à jour
            $nouvelle_ligne = implode(',', $utilisateur) . PHP_EOL;

            // Remplacer la ligne existante par la nouvelle ligne
            $lignes[$index] = $nouvelle_ligne;

            // Écrire les données mises à jour dans le fichier
            file_put_contents('csv/utilisateurs.csv', implode('', $lignes));
            break;
        }
    }
    header('Location: form_profil.php');
}

/////////// Supprimer son compte //////////////////////////////////////////////////

if (isset($_POST['sup_compte'])) {

    // Supprimer l'utilisateur du fichier CSV (utilisateurs.csv)
    $fichierUtilisateurs = file('csv/utilisateurs.csv');

    foreach ($fichierUtilisateurs as $index => $ligne) {
        $utilisateur = str_getcsv($ligne);
        if ($utilisateur[0] === $username) {
            unset($fichierUtilisateurs[$index]);
            break;
        }
    }

    // Réécrire le fichier CSV sans l'utilisateur supprimé
    file_put_contents('csv/utilisateurs.csv', implode('', $fichierUtilisateurs));

    // Détruire la session et rediriger vers une page de confirmation ou de déconnexion
    session_destroy();
    header('Location: Home.php');
    exit();
}



/////////////////////////////////////////////////////////////////////////////////// 
    


// Récupérer le paramètre de tri choisi
$sortingOption = isset($_GET['tri']) ? $_GET['tri'] : '';


$commentaires = array();
$fichier = fopen('csv/commentaire.csv', 'r');
if ($fichier !== false) {
    while (($ligne = fgetcsv($fichier)) !== false) {
        if ($username == $ligne[1]) {  // Garder seulement les commentaires écris par l'utilisateur
            $commentaires[] = $ligne; // Stocke les commentaires dans un tableau
        }
    }
    fclose($fichier);

    // trier les commentaires selon le tri choisi (date)
    if ($sortingOption === 'date3') {
        usort($commentaires, function ($a, $b) {
            return strcmp($a[4], $b[4]);
        });
    } elseif ($sortingOption === 'date4') {
        usort($commentaires, function ($a, $b) {
            return strcmp($b[4], $a[4]);
        });
    }

    // trier les commentaires selon le tri choisi (note)
    if ($sortingOption === 'note1') {
        usort($commentaires, function ($a, $b) {
            return intval($a[3]) - intval($b[3]);
        });
    } elseif ($sortingOption === 'note2') {
        usort($commentaires, function ($a, $b) {
            return intval($b[3]) - intval($a[3]);
        });
    }

    // Vérifier si la requête POST contient le paramètre "delete"
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $commentaireASupprimer = $_POST['delete'];

        supprimerCommentaire($commentaireASupprimer);

        // Rediriger vers la même page pour actualiser la liste des commentaires
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }


    // Lire le fichier "csv/recettes.csv" et stocker les noms des recettes dans un tableau associatif
    $recettes = array();
    $fichierRecettes = fopen("csv/recettes.csv", "r");
    if ($fichierRecettes !== false) {
        while (($ligneRecette = fgetcsv($fichierRecettes)) !== false) {
            $recettes[$ligneRecette[0]] = $ligneRecette[1];
        }
        fclose($fichierRecettes);
    }
    echo'<style>.mesCommentaires{margin-left:400px; border:solid black; width:1000px; height:110px; border-radius:10px;background-color:lightgrey;}
    .border{border:solid black; border-radius:10px}
    </style>
    <br><br><div class="mesCommentaires">Mes commentaires:
    <br> Trier par :
    <nav>
    <ul>
  <li class="border dropdown">
    <a href="#">Date</a>
    <ul class="border dropdown-menu">
      <li><a class="border" href="?tri=date3">Plus récent</a></li>
      <li><a class="border" href="?tri=date4">Plus ancien</a></li>
    </ul>
  </li>
  <li class="border dropdown">
    <a href="#">Note</a>
    <ul class="dropdown-menu">
      <li><a class="border" href="?tri=note1">Moins bien noté</a></li>
      <li><a class="border" href="?tri=note2">Mieux noté</a></li>
    </ul>
  </li>
</ul>
</nav>
<div><br>';
    
    // Afficher les commentaires triés
    foreach ($commentaires as $commentaire) {
        $nomRecette = isset($recettes[$commentaire[2]]) ? $recettes[$commentaire[2]] : '';  // retrouve le nom de la recette associé à son id dans le tableau associatif
        
        // affiche un commentaire avec le nom de la recette commentée, le commentaire et la note
        echo '<style>.supr{background-color: #e6a19c;
        color: red;
        padding: 14px 20px;
        margin: 8px 0;
        border: solid red;
        border-radius: 10px;
        cursor: pointer;}
        .mds{border:solid grey;
            border-radius:20px;
            padding:10px; 
            width:1000px;
           }
            </style>
        <div class="mds"> 
                <div class="  border ">
                  <u>' . $nomRecette . '</u>
                  <p>' . $commentaire[0] . '   ' . $commentaire[3] . '</p>
                  <form action="" method="post">
                    <input type="hidden" name="delete" value="' . $commentaire[0] . '">
                    <button class="supr" type="submit">Supprimer</button>
                  </form>
                </div>
              </div>';
    }
} echo '<!DOCTYPE html>
<html>
<head>
  <title>Mon site web</title>
  <style>
    footer {
      background-color: #f9f9f9;
      padding: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

  <footer>
    <p>Votre mot de passe est strictement confidentiel.<br> Veuillez ne pas le partager.</p>
  </footer>
</body>
</html>' 

?>
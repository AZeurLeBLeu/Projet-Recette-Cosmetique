<?php
require("php_fonctionsGlobales.php");
session_start();

$id_recette_actuelle_str = $_GET['id']; // Récupérer l'id dans l'url
$id_recette_actuelle = intval($id_recette_actuelle_str); // Transformer l'id en entier


$username = $_SESSION['username'];
$password = $_SESSION['password'];

$fichier = fopen("csv/utilisateurs.csv", "r");

$est_admin = false; // défini le variable a fausse

while (($data = fgetcsv($fichier)) !== false) {
    // Vérifier si l'utilisateur est un administrateur
    if ($data[0] == $username && $data[2] == "y"){
        $est_admin = true; // Changer la variable du booléen pour savoir si c'est un admin
        break;
    }
}
fclose($fichier);



function recette(){
  // Vas chercher les étapes de la recette
  global $id_recette_actuelle;
  $fichier = fopen("csv/etapes.csv", "r"); 
  $i = 1;

  while (($data = fgetcsv($fichier)) !== false) {
    
    if ($data[0] == $id_recette_actuelle){
      
      while (isset($data[$i])){
        echo '<u>étape '.$i.'</u> : ' .$data[$i]. '<br>'; // affiche étape par étape
        $i++;
      }  
    }
  }
  fclose($fichier);
}



if (isset($_POST['validation'])) {    // Regarde si le bouton valider ou rejeter à été pressé
  $action = $_POST['validation']; 
  $id_recette_a_changer = $_POST['id_recette']; // Récupérer l'id de la recette

  if ($action === "valider") {  // Lance la fonction en conséquence
    validerRecette();
  } elseif ($action === "rejeter") {
    rejeterRecette(1);
  } elseif ($action === "supprimer"){
    rejeterRecette(2);
  }
}


function validerRecette()  // change la lettre de validation de la recette a valider
{
  global $id_recette_a_changer;

  $fichier = fopen("csv/recettes.csv", "r+");
  $tempFile = tmpfile(); // Créer un fichier temporaire

  while (($data = fgetcsv($fichier)) !== false) {
    if ($data[0] == $id_recette_a_changer) {
      $data[5] = 'v';
    }
    fputcsv($tempFile, $data); // Écrire les données dans le fichier temporaire
  }
  
  rewind($fichier); // Rembobiner les fichiers
  rewind($tempFile); 

  // Copier le contenu du fichier temporaire dans le fichier d'origine
  stream_copy_to_stream($tempFile, $fichier);

  fclose($fichier);
  fclose($tempFile);


  header('Location: form_recette.php?id='.$id_recette_a_changer.'&valide=v');  // redirection vers la page maintenant validée
}


function rejeterRecette($valide)  // fonction qui supprime la ligne de la recette à supprimer
{
    global $id_recette_a_changer;

    $fichier = fopen("csv/recettes.csv", "r+");
    $tempFile = tmpfile(); // Créer un fichier temporaire

    while (($data = fgetcsv($fichier)) !== false) {
        if ($data[0] != $id_recette_a_changer) {
            fputcsv($tempFile, $data); // Ignorer la ligne de la recette en recopiant le fichier de base
        }
    }

    fclose($fichier);

    $fichier = fopen("csv/recettes.csv", "w"); // Ouvrir le fichier en mode d'écriture pour le vider

    rewind($tempFile); // Rembobiner le fichier temporaire

    // Copier le fichier temporaire dans le fichier d'origine
    stream_copy_to_stream($tempFile, $fichier);

    fclose($fichier);
    fclose($tempFile);

    if ($valide == 1){
      header('Location: form_recetteAValider.php');  // redirection vers les autres recettes en cours de validation
    } elseif ($valide == 2){
      header('Location: form_accueil.php');  // redirection vers la recherche des recettes

    }
}





function boutton() {
  global $id_recette_actuelle;
  global $est_admin;
  $fichier = fopen("csv/recettes.csv", "r");

  $bouttonAffiche = false; // Variable pour vérifier si les boutons doivent être affichés

  while (($data = fgetcsv($fichier)) !== false) {
      if ($data[0] == $id_recette_actuelle && $data[5] == 'u') {
          $bouttonAffiche = true;
          break; // Sortir de la boucle dès que l'ID de la recette est trouvé
      }
  }

  fclose($fichier);

  if ($bouttonAffiche) {  // Afficher les boutons si la recette n'est pas encore valide
      echo '
      <form method="post" action="php_recette.php">
          <input type="hidden" name="id_recette" value="'.$id_recette_actuelle.'">
          <button name="validation" type="submit" value="valider">Valider recette</button>
          <button name="validation" type="submit" value="rejeter">Rejeter recette</button>
      </form>';
  }

  if ($est_admin == true && $bouttonAffiche == false){
    echo '
      <form method="post" action="php_recette.php">
          <input type="hidden" name="id_recette" value="'.$id_recette_actuelle.'">
          <button name="validation" type="submit" value="supprimer">Supprimer recette</button>
      </form>';
  }
}



  function titre(){   // Fonction qui affiche le titre + auteur + photo de profil de l'auteur
    // affiche le titre de la recette
    global $id_recette_actuelle;
    $fichier = fopen("csv/recettes.csv", "r"); 
    while (($data = fgetcsv($fichier)) !== false) {
      if ($data[0] == $id_recette_actuelle){
        echo $data[1]; // affiche le titre
        $auteur = $data[3];  // Récupérer l'auteur
        break;
      }
    }
    fclose($fichier);

    $fichier_utilisateur = fopen("csv/utilisateurs.csv", "r"); 
    while (($data = fgetcsv($fichier_utilisateur)) !== false) {
      if ($data[0] == $auteur){
        echo '<span style="float: right;" >Recette crée par '. $auteur .'<img style="width : 90px; border-radius: 100%; margin-left: 25px;" src="' .$data[3]. '"> </span>';  // Afficher l'auteur
        break;
      }
    }
    fclose($fichier_utilisateur);
  }


    function image(){
      global $id_recette_actuelle;
      $fichier = fopen("csv/recettes.csv", "r"); 
        
        while (($data = fgetcsv($fichier)) !== false) {
        if ($data[0] == $id_recette_actuelle){
          echo '<img src="' . $data[4] . '">';      // Affiche l'image de la recette
          echo '<p> '. $data[2] .' </p>';         // Affiche la description de la recette
        }
      }
      fclose($fichier);
    }

    
    function ingredients(){         // Vas chercher les ingrédients nécéssaires pour la recette
      global $id_recette_actuelle;

      $fichier = fopen("csv/recettes.csv", "r"); 
      while (($data = fgetcsv($fichier)) !== false) {
        if ($data[0] == $id_recette_actuelle){
          $i = 7;
          while ($data[$i]){
            echo "<p>".$data[$i]." : ".$data[$i+1]." L</p>";
            $i += 3;  
          }
        }     
      }
      fclose($fichier);
    }


    function prix(){
      global $id_recette_actuelle;

    // Chemin vers le fichier CSV
    $chemin_fichier = 'csv/recettes.csv';



    // Lecture du fichier CSV
    if (($fichier = fopen($chemin_fichier, 'r')) !== FALSE) {
        $total = 0; // Variable pour stocker le prix total

        // Parcourir chaque ligne du fichier CSV
        while (($donnees = fgetcsv($fichier, 1000, ',')) !== FALSE) {

            if ($donnees[0]== $id_recette_actuelle){
            // Parcourir les valeurs par groupe de 3
            for ($i = 7; $i < count($donnees); $i += 3) {
                // Récupérer les deux dernières valeurs de chaque trio
                $valeur1 = $donnees[$i + 1];
                $valeur2 = $donnees[$i + 2];

                // Vérifier si les valeurs sont numériques
                if (is_numeric($valeur1) && is_numeric($valeur2)) {
                    // Multiplier les deux valeurs
                    $resultat = $valeur1 * $valeur2;

                    // Ajouter le résultat au prix total
                    $total += $resultat;
                }
             }
            }
        }

        // Fermer le fichier CSV
        fclose($fichier);

        // Afficher le prix total
        echo 'Le prix total est : ' . $total.' €';
    } else {
        echo 'Erreur lors de l\'ouverture du fichier CSV.';
    }
  }

/////////////////////////////////
// Partie tri des commentaires///
/////////////////////////////////


function commentaires(){
  global $id_recette_actuelle;
  // Get the sorting option from the URL parameter
  $sortingOption = isset($_GET['tri']) ? $_GET['tri'] : '';

  // Read the CSV file into an array
  $commentaires = array();
  $fichier = fopen('csv/commentaire.csv', 'r');
  if ($fichier !== false) {
      while (($ligne = fgetcsv($fichier)) !== false) {
          
            $commentaires[] = $ligne;
          
      }
      fclose($fichier);

      // Perform sorting based on the selected option
      if ($sortingOption === 'date3') {
          usort($commentaires, function ($a, $b) {
              // Assuming the date is in the format 'Y-m-d'
              return strcmp($a[4], $b[4]);
          });
      } elseif ($sortingOption === 'date4') {
          usort($commentaires, function ($a, $b) {
              // Assuming the date is in the format 'Y-m-d'
              return strcmp($b[4], $a[4]);
          });
      }


    // Perform sorting based on the selected option
    if ($sortingOption === 'note1') {
      usort($commentaires, function ($a, $b) {
          return intval($a[3]) - intval($b[3]);
      });
    } elseif ($sortingOption === 'note2') {
      usort($commentaires, function ($a, $b) {
          return intval($b[3]) - intval($a[3]);
      });
    }
  }

  $valide = $_GET['valide'];

  if ($valide == 'v'){ // Que si la recette est validée
    // afficher les méthodes de tri
    echo '<nav>
    <ul>
      Trier par:
      <li class="dropdown">   
        <a href="#">Date</a>
        <ul class="dropdown-menu">
          <li><a href="?<?php redirection(); ?>&tri=date3">Plus ancien</a></li>
          <li><a href="?<?php redirection(); ?>&tri=date4">Plus récent</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Note</a>
        <ul class="dropdown-menu">
          <li><a href="?<?php redirection(); ?>&tri=note1">Moins bien notés</a></li>
          <li><a href="?<?php redirection(); ?>&tri=note2">Mieux notés</a></li>
        </ul>
      </li>
    </ul>
    </nav>';  

    // afficher noter et commenter la recette
    echo '<div class="col-md-6 marginTop">
    <div class=" p-5 bg-body-tertiary border rounded-3 width">';
    echo '<h2>Commentaire</h2>';
    echo'<a href="form_ajoutCommentaire.php?id=' . $id_recette_actuelle . '">Ajoutez un commentaire</a>'; // Bouton de redirection vers la page d'ajout de commentaire
    echo '<br>';
    echo'<a href="form_ajoutNote.php?id=' . $id_recette_actuelle . '">Notez la recette</a>';  // Bouton de redirection vers la page d'ajout de not



  foreach ($commentaires as $commentaire) {
    if ($commentaire[0] && $id_recette_actuelle == $commentaire[2]){
    echo 
        '<div class=" ">
          <div class="  border ">
            <u> '. $commentaire[1] .' </u>
            <p> '. $commentaire[0] .'   '. $commentaire[3] .''. $commentaire[4] .' </p>
          </div>
        </div>';
    }
  }
}
}





?>
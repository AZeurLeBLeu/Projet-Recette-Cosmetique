<?php
require("php_fonctionsGlobales.php");

session_start();
    
// Récupérer les informations de l'utilisateur à partir de la session
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


$notes = calculMoyenne();

$search = isset($_POST['search']) ? trim($_POST['search']) : ''; //récupérer le contenu de la barre de recherche si elle n'est pas vide

$handle = fopen("csv/recettes.csv", "r"); // ouvrir le fichier csv

echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

while (($data = fgetcsv($handle)) !== false) {

  if ($search === '' && stripos($data[5], 'v') === false) { // Affiche seulement si la recette est validée
    continue;
  } elseif ($search !== '' && (stripos($data[1], $search) === false || stripos($data[5], 'v') === false)) {
    continue;
  }

  // Récupérer l'ID de recette
$recette_id = $data[0];

// Vérifier si la recette a des notes enregistrées dans le tableau associatif
if (isset($notes[$recette_id])) {
    $note = $moyenne;
}

  
    // récupérer les données importantes de la ligne de la recette
    $nom = $data[1];
    $image = $data[4];
    $id = $data[0];
    $valide = $data[5];

    $lienrecette = "form_recette.php";
    // afficher une recette
    echo '<div class="">
              <div class="card shadow-sm margin">
              <img src="' . $image . '"  onclick=window.location.href="'. $lienrecette .'?id=' . $id . '&valide='. $valide .'">
                <div class="color card-body">
                  <p class="card-text">' . $nom . '</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    
                    </div>
                    <small class="text-body-secondary">' . $notes[$recette_id]['moyenne'] . '<i class="fa-regular fa-star"></i></small>
                  </div>
                </div>
              </div>
            </div>';

}

echo '</div>';

fclose($handle);
?>
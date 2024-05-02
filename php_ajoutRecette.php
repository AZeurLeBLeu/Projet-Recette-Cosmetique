<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $description = $_POST['description'];
  $lien_image = $_POST['lien_image'];
  $duree = $_POST['duree'];
  $ingredients = isset($_POST['ingredient']) ? $_POST['ingredient'] : [];
  $quantites = isset($_POST['quantite']) ? $_POST['quantite'] : [];
  $prixkg = isset($_POST['prixkg']) ? $_POST['prixkg'] : [];
  $etapes = isset($_POST['etapes']) ? $_POST['etapes'] : [];

  // Chemin vers le fichier CSV
  $fichierCSV = 'csv/questionnaire.csv';

  // Vérifier si le fichier CSV existe
  $fichierExiste = file_exists($fichierCSV);

  // Ouvrir le fichier CSV en mode ajout
  $handle = fopen($fichierCSV, 'a');

  // Obtenir le numéro de ligne actuel
  $compteur = 1;
  if ($fichierExiste) {
    $compteur = count(file($fichierCSV)) + 1;
  }

  // Construire la ligne à écrire dans le fichier CSV
  $ligne = [$compteur, $nom, $description, $lien_image, 'u', $duree];

  // Ajouter les paires d'ingrédient et quantité avec leurs prix au kilo
  for ($i = 0; $i < count($ingredients); $i++) {
    $ligne[] = $ingredients[$i];
    $ligne[] = $quantites[$i];
    $ligne[] = $prixkg[$i];
  }

  // Écrire la ligne dans le fichier CSV
  fputcsv($handle, $ligne);

  // Fermer le fichier
  fclose($handle);



  $fichierCSV = 'csv/etapes.csv';
  $fichierExiste = file_exists($fichierCSV);
  $handle = fopen($fichierCSV, 'a');
   $compteur = 1;
   if ($fichierExiste) {
     $compteur = count(file($fichierCSV)) + 1;
   }
   $ligne = [$compteur];
   for ($i = 0; $i < count($etapes); $i++) {
    $ligne[] = $etapes[$i];
   }
   fputcsv($handle, $ligne);
   fclose($handle);

















  // Redirection vers une page de confirmation
  header('Location: form_ajoutRecette.php');
  exit;
}
?>
<?php  

session_start();

    
function calculMoyenne(){   // Calcul des moyennes
    
    $notes_file = fopen("csv/commentaire.csv", "r"); 
    $notes = []; // Tableau associatif pour lier les ID de recette aux notes


    while (($note_data = fgetcsv($notes_file)) !== false) {
    $recette_id = $note_data[2];
    $note = (float) $note_data[3]; // Convertir la note en nombre

    // Vérifier si l'ID de recette existe déjà dans le tableau des notes
    if (isset($notes[$recette_id])) {
        // Ajouter la note à la somme existante
        $notes[$recette_id]['somme'] += $note;
        $notes[$recette_id]['count']++; // Incrémenter le nombre de notes
    } else {
        
        $notes[$recette_id] = [
            'somme' => $note,
            'count' => 1,
        ];
    }
    }

    // Calculer la moyenne des notes pour chaque recette
    foreach ($notes as $recette_id => $note_data) {
    $note_sum = $note_data['somme'];
    $note_count = $note_data['count'];
    $moyenne = $note_sum / $note_count;

    // Mettre à jour la valeur de la note moyenne dans le tableau des notes
    $notes[$recette_id]['moyenne'] = $moyenne;
    }

    fclose($notes_file); // Fermer le fichier des notes
    return $notes;
}



function afficherBouton(){     // Fonction qui regarde si l'utilisateur est  admin, et affiche un bouton pour valider les recettes si oui

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

    if ($est_admin == true){
        echo 'Valider des recette';
    }
}

function meilleureRecette($notes){ // Fonction qui récupère la recette la mieux notée pour l'affichier dans l'accueil
    $meilleureRecetteId = null;
    $meilleureNote = 0;

    foreach ($notes as $recetteId => $noteData) {
        $note = $noteData['moyenne'];
        if ($note > $meilleureNote) {
            $meilleureNote = $note;
            $meilleureRecetteId = $recetteId;
        }
    }

    return $meilleureRecetteId;
}

function afficherMeilleureRecette() {
    $notes = calculMoyenne();
    $meilleureRecetteId = meilleureRecette($notes);
    
    if ($meilleureRecetteId !== null) {
        // Récupérer les détails de la meilleure recette à partir de son ID
        $fichierRecettes = fopen("csv/recettes.csv", "r");
        while (($data = fgetcsv($fichierRecettes)) !== false) {
            if ($data[0] == $meilleureRecetteId) {
                $nomRecette = $data[1];
                $imageRecette = $data[4];
                // Afficher les détails de la meilleure recette
                echo '<center><div class="col-lg-4">
                        <img style="width: 200px; border-radius: 100%;" src="'. $imageRecette .'">
                        <h2 class="fw-normal">'.$nomRecette.'</h2>
                        <p>Elue recette du moment</p>
                    </div></center>';


                
                break;
            }
        }
        fclose($fichierRecettes);
    }
}



function imageProfil(){         // Fonction qui affiche la photo de profil de l'utilisateur
    $username = $_SESSION['username'];

    $fichier = fopen("csv/utilisateurs.csv","r");
    while (($data = fgetcsv($fichier)) !== false) {
        if ($data[0] == $username) {
            echo $data[3];
            break;
        }
    }
    fclose($fichier);
}

?>

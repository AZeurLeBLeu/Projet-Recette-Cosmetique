<?php

session_start();


function afficherRecette(){
    $handle = fopen("csv/recettes.csv", "r"); // ouvrir le fichier csv
    
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

    while (($data = fgetcsv($handle)) !== false) {

        if ($data[5] == 'u'){
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
                    </div>
                    </div>
                </div>
                </div>';

    }
    }
    echo '</div>';
}





fclose($handle);
?>
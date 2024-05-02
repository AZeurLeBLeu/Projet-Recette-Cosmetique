<?php
    session_start();

    if (isset($_POST['nom_inscription']) && isset($_POST['mdp_inscription'])) {
        $fichier = fopen('csv/utilisateurs.csv', 'a+');
        
        if ($fichier) {
            rewind($fichier); // Réinitialise le pointeur de fichier au début
            $user_exists = false;
            while (($data = fgetcsv($fichier)) !== FALSE){
                if ($data[0]==$_POST['nom_inscription']){
                    $user_exists = true;
                    header('Location: form_connexion.php');
                    break;
                }
            }
            if (!$user_exists) {
                $data = array($_POST['nom_inscription'], $_POST['mdp_inscription']);
                fputcsv($fichier, $data);
            }
            fclose($fichier);
        }
    }
    
    
    die();
    
?>
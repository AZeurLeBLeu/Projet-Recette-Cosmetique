
<?php
    session_start();
    if (isset($_POST['nom']) && isset($_POST['mdp'])) {   
        if (($fichier = fopen("csv/utilisateurs.csv", "r")) !== FALSE){
            $nom=$_POST['nom'];
            $mdp=$_POST['mdp'];
            while (($data = fgetcsv($fichier)) !== FALSE)
                { if ($data[0]==$nom && $data[1]==$mdp){
                    header('Location: form_accueil.php');
                }                   
        }
        }
    }
        fclose($handle);
    die();   

?>
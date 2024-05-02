<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/92db46d7c4.js" crossorigin="anonymous"></script>
    <title>Ajout Commentaire</title>
</head>
<body>
    <?php 
        session_start();
        $id_recette_actuelle_str = $_GET['id']; // Récupérer l'id dans l'url
        $id_recette_actuelle = intval($id_recette_actuelle_str); // Transformer l'id en entier
    
        date_default_timezone_set("Europe/Paris");
        $dateActuelle = date("Y-m-d");

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si le formulaire est envoyé...

            $data = array($_POST['commentaire'], $_SESSION['username'],$id_recette_actuelle,$_POST['note'],$dateActuelle); // Creer une ligne avec toutes les infos pour le csv

            $fichier = fopen("csv/commentaire.csv", "a");
            fputcsv($fichier, $data);   // Ecrire les infos du commentaire dans le csv
            fclose();

            header("Location: form_recette.php?id=".$id_recette_actuelle.""); // Redirection
            exit;
        }

        session_destroy();
    ?>
    
    <form action="" method="post">
    <body>
        <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalTour">
            <div class="modal-dialog" role="document">
              <div class="modal-content rounded-4 shadow">
                <div class="modal-body p-5">
                  <h2 class="fw-bold mb-0">Commenter la recette !</h2><br>
                    <textarea type="text" placeholder="Donnez-nous votre avis" style="width:400px; height:200px;" name="commentaire"></textarea>
                    <label >Note :</label> <br>                         <!--  Mettre la note  -->
            <button><input class="fa-regular fa-star"type="radio" name="note" value="1">
        <label ><i class="fa-regular fa-star"></i></label></button><br>

        <button><input class="fa-regular fa-star"type="radio" name="note" value="2">
        <label ><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></label></button><br>
        <button><input class="fa-regular fa-star"type="radio" name="note" value="3">
        <label ><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></label></button><br>
        <button><input class="fa-regular fa-star"type="radio" name="note" value="4">
        <label ><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></label></button><br>
        <button><input class="fa-regular fa-star"type="radio" name="note" value="5">
        <label ><i class="fa-regular fa-star"><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></i></label></button><br><br>
        
        <input class="btn btn-lg btn-primary mt-5 w-100"  value="Envoyer" type="submit">
                </div>
              </div>
            </div>
          </div>
          <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>          
         <!--  Ecrire le Commentaire  -->

      
        
    </form>
</body>
</html>
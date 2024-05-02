<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Le titre de ma page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <style>
          .connex{background-color: black; font-size: 15px;}
          </style>
      </head>
    <body>
    <?php 
        if (isset($_POST['nom_inscription']) && isset($_POST['mdp_inscription'])) {
            $fichier = fopen('csv/utilisateurs.csv', 'a+');
            
            if ($fichier) {
                rewind($fichier); // Réinitialise le pointeur de fichier au début
                $user_exists = false;
                while (($data = fgetcsv($fichier)) !== FALSE){
                    if ($data[0]==$_POST['nom_inscription']){
                        $user_exists = true;
                        break;
                    }
                }
                if (!$user_exists) {
                    $data = array($_POST['nom_inscription'], $_POST['mdp_inscription']);
                    fputcsv($fichier, $data);
                    $reussis = "Inscription réussie !";
                }
                else {
                    $erreur = " Erreur d'inscription : nom d'utilisateur déjà utilisé.";
                }
                fclose($fichier);
            }
        }
    ?>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0 fs-2">Inscription</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5 pt-0">
          <form action="Inscription.php" method="post">
            <div class="form-floating mb-3">
              <input type="text" name="nom_inscription" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Identifiant</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" name="mdp_inscription" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Mot de passe</label>
            </div>
            <input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" value="Inscription" onclick="window.location.href='form_acceuil.php'"></button>
            <small class="text-body-secondary">En s'inscrivant vous accepter les conditions d'utilisation</small>
            <hr class="my-4">
            <button type="button" class="btn btn-lg btn-primary connex" onclick="window.location.href='Connexion.php'">Se connecter</button>
            <?php if (isset($erreur)) echo "<style>h1{color: red; font-size: small;}</style><h1>$erreur</h1>"; 
            else echo "<style>h1{color: green; font-size: medium;}</style><h1>$reussis</h1>"; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
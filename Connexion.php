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
    session_start();

    
    $erreur = "";
    if (isset($_POST['nom']) && isset($_POST['mdp'])) {   
        if (($fichier = fopen("csv/utilisateurs.csv", "r")) !== FALSE){
            $nom=$_POST['nom'];
            $mdp=$_POST['mdp'];
            while (($data = fgetcsv($fichier)) !== FALSE){
                if ($data[0]==$nom && $data[1]==$mdp){
                    $_SESSION['username'] = $nom; // Définir la variable de session pour le nom d'utilisateur
                    $_SESSION['password'] = $mdp; // Définir la variable de session pour le mot de passe
                    header('Location: form_accueil.php');
                    exit(); // ajout de cette ligne pour arrêter l'exécution du script après la redirection
                }    
            }
            $erreur = "Erreur de connexion : nom d'utilisateur ou mot de passe incorrect.";
            fclose($fichier);
        }
    }
    ?>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0 fs-2">Se connecter</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
  
        <div class="modal-body p-5 pt-0">
          <form action="Connexion.php" method="post">
            <div class="form-floating mb-3">
              <input type="text" name="nom" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Identifiant</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" name="mdp" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Mot de passe</label>
            </div>
            <input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" value="Connexion">Veuillez entrer votre identifiant et votre mot de passe pour se connecter</button>
            <small class="text-body-secondary"></small>
            <hr class="my-4">
            <button type="button" class="btn btn-lg btn-primary connex" onclick="window.location.href='Inscription.php'">S'inscrire</button>
            <?php if ($erreur !== "") echo "<style>h1{color: red; font-size: small;}</style><h1>$erreur</h1>"; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
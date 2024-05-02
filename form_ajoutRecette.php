<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <title>Formulaire de questionnaire</title>
  <style>
    #logo{height:60px; border-radius: 30px; border: solid #000;;}
img{border-radius :30px;}
#white{background-color:#FFF}
.menue{background-color:#000;}
.nom{color: black;}
.menue{margin-top: 10px;}
.photo{width: 40px; height: 40px; border-radius: 30px;}
.Commente{padding-right: 1px;}
.Evaluer{padding-right: 1px;}
.div{boder:solid black; border-radius:15px; width: 800px;padding: 15px;}
footer {
      background-color: #f9f9f9;
      padding: 20px;
      text-align: center;
      margin-top: 200px;
    }
    body {
      font-family: Arial, sans-serif;
    }
    
    h1 {
      text-align: center;
    }
    
    form {
      max-width: 500px;
      margin: 0 auto;
    }
    
    label {
      display: block;
      margin-top: 10px;
    }
    
    input[type="text"],
    textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    
    button:hover {
      background-color: #45a049;
    }
    
    #ingredient-container,
    #etapes-container {
      margin-top: 10px;
    }
    
    .input-pair {
      margin-bottom: 5px;
    }
  </style>
  <script>
    function ajouterCases() {
      var container = document.getElementById("ingredient-container");

      var nouvellePaire = document.createElement("div");
      nouvellePaire.classList.add("input-pair");
      nouvellePaire.innerHTML = '<label for="ingredient">Ingrédient :</label><input type="text" name="ingredient[]"> ' +
                                '<label for="quantite">Quantité :</label><input type="text" name="quantite[]">' +
                                '<label for="prixkg">Prix au kg :</label><input type="text" name="prixkg[]"><br>';
      container.appendChild(nouvellePaire);
    }

    function ajouterEtapes() {
      var container = document.getElementById("etapes-container");

      var nouvelleEtapes = document.createElement("div");
      nouvelleEtapes.classList.add("input-pair");
      nouvelleEtapes.innerHTML = '<label for="etapes">Étape :</label><input type="text" name="etapes[]">';
      container.appendChild(nouvelleEtapes);
    }
  </script>
</head>
<body>
<header class="p-3 text-bg menue">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><img id="logo" src="img/logo.png"><li>
          <li><a href="Home.php" class="nav-link px-2 text-secondary menue">Home</a></li>
          <li><a href="faq.html" class="nav-link px-2 text-primary menue">FAQs</a></li>
        </ul>
    
        </form>

        <div class="text-end">
        <img class="photo" src="mars.jpeg" onclick="window.location.href=('form_profil.php')">
        </div>
      </div>
    </div>
  </header>
  <center><div class="text-bg-light div">
  <h1>Ajouter Votre Recette !</h1>
  <form method="post" action="php_ajoutRecette.php">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="description">Description :</label>
    <input type="text" name="description" id="description" required>

    <label for="lien_image">Image :</label>
    <input type="text" name="lien_image" id="lien_image" required>

    <label for="duree">Durée :</label>
    <input type="text" name="duree" id="duree" required>

    <div id="ingredient-container"></div>
    <button type="button" onclick="ajouterCases()">Ajouter une paire d'ingrédient et quantité</button>

    <div id="etapes-container"></div>
    <button type="button" onclick="ajouterEtapes()">Ajouter des étapes</button>
    
    <input type="submit" value="Soumettre">
  </form>
</div><center>
  <footer>
    <p>Il est interdit de mettre la recette d'un autre utilisateur.<br> Veuillez mettre votre propre recette ! .</p>
  </footer>
</body>
</html>

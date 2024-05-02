<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="recettes.css">
    <?php require("php_recetteAValider.php");?>
    <?php require("php_fonctionsGlobales.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/92db46d7c4.js" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
    .custom-blue-pastel {
  color: #47b9e6;
}
#logo{height:60px; border-radius: 30px; border: solid #47e69e;;}
img{border-radius :30px;}
.nom{color: black}
.menue{margin-top: 10px;}
.photo{width: 40px; height: 40px; border-radius: 30px;}
.Commente{padding-right: 1px;}
.Evaluer{padding-right: 1px;}
.resume{
    border-radius: 10px;
    padding-left: 5px;
    color: #47e69e;
    background-color: rgb(149, 110, 141);
}
.custom-green-pastel {
  color: #47e69e;
}
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

  .pic{display: flex;
justify-content: center;}

  

  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }

  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }

  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }

  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }
  .bd-mode-toggle {
    z-index: 1500;
  }
  body{
    background-color: #c7f0ce;
  }
  .color{
    background-color: rgb(180, 220, 255);
  }
  img{
    height: 400px;
  }
  .margin{
    margin: 15px; 
  }
</style>  
</head>
<body >
<header class="p-3 text-bg-light">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><img id="logo" src="logo.png"><li>
          <li><a href="#" class="nav-link px-2 text-secondary menue">Accueil</a></li>
          <li><a href="#" class="nav-link px-2 text-primary menue">FAQ</a></li>
          <li><a href="#" class="nav-link px-2 text-primary menue">Contact</a></li>
          
        </ul>


        <div class="text-end">
          <img class="photo" src="<?php imageProfil(); ?>">
          <button type="button" class="btn btn-primary"><i class="fa-solid fa-bell"></i></button>
        </div>
      </div>

    </div>
    
  </header>
  
  <div id="search-results"> 
         <?php afficherRecette(); ?>
  </div>
</body>
   
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>

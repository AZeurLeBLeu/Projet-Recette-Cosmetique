<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("php_recette.php");?>
    <title>Recettes</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
    <script src="https://kit.fontawesome.com/92db46d7c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="tri.css">
    
    
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    #logo{height:60px; width:60px; border-radius: 30px; border: solid #47e69e;;}
    .width{width:1300px;}
    .trier{margin-left:10px;}
img{border-radius :30px;}
.nom{color: black;}
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
.pic{display: flex;
justify-content: center;
}
.custom-green-pastel{
  background-color: #47e69e;
}
img{width: 500px;}
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
      .test{margin-top: 28px;}
    </style>
    
  </head>
  <body>
  <header class="p-3 text-bg-light">
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
        <img class="photo" src="<?php imageProfil(); ?>" onclick="window.location.href=('form_profil.php')">
          <button type="button" class="btn btn-primary"><i class="fa-solid fa-bell"></i></button>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="container py-4">
      <header class="pb-3 mb-4 border-bottom">
        <a flclass="d-flex align-items-center text-dark text-decoration-none">
          <!-- mettre le logo ici-->
          <span class="fs-4"><?php titre(); ?></span>
          <?php boutton(); ?>
        </a>
      </header>
      <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5 pic">
          <?php image(); ?>
        </div>
      </div>
      <div class="row align-items-md-stretch">
          <div class="col-md-6">
              <div class=" p-5 bg-body-tertiary border rounded-3 ">
                <h2 clas="custom-green-pastel">Ingrédients</h2>
                <?php ingredients(); ?> 
                <?php prix(); ?> 
              </div>
            </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Recette</h2>
            <?php recette(); ?> 
          </div>
        </div>
      </div>
        
<div class="width">


<?php commentaires(); ?> 
</div>
        
    
    <footer class="pt-3 mt-4 text-body-secondary border-top">
      &copy; 2023
    </footer>
  </div>
</main>
    
    

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
$_SESSION=array();
header("Location:?page=login");
?>

<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Croute Doree | Bienvenue</title>
  
  

      <link rel="stylesheet" href="pages/Generiques/loginAssets/css/style.css">
      <link rel="stylesheet" href="pages/Generiques/loginAssets/css/bootstrap.css">

  
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="side col-lg-6 col-lg-offset-6">
        <div class="row">
          <!-- formulaire de connexion principal -->
            <div class="col-lg-6">
              <hgroup>
                <h2>Croute Doree</h2>
              </hgroup>
              <form role="form" action="" method="post" name="connect" >
                <div class="group">
                  <input type="text" name="Login" id="Login" ><span class="highlight"></span><span class="bar"></span>
                  <label>Login</label>
                </div>
                <div class="group">
                  <input type="password" name="Pwd" id="Pwd"><span class="highlight"></span><span class="bar"></span>
                  <label>Password</label>
                </div>
                <button type="submit" name="submit" class="button buttonBlue">Connexion
                  <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                </button>
              </form>
            </div>
          <!-- fin formulaire de connexion principal -->   

          <!-- formulaire pour l'editeur -->

          <div class="col-lg-6">
            <hgroup>
              <h1>L'editeur</h1>
            </hgroup>
            <div class="editor">
              Ici nous presentons l'editeur du logiciel
              
            </div>
          </div>

        <!-- fin formulaire pour l'editeur -->
        </div>
        
      </div>
      
    </div>
  </div>
  
  <script src='pages/Generiques/loginAssets/js/jquery-2.2.1.js'></script>

  <script  src="pages/Generiques/loginAssets/js/index.js"></script>

</body>
</html>


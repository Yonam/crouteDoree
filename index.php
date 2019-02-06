
<?php 
session_start();
 ob_start();
  include("pages/include/connexionDB.php");
  require "pages/include/classes/class.auth.php";
  require "pages/include/classes/panier.class.php";
  require "pages/include/classes/encaissement.class.php";
  require "pages/include/classes/commande.class.php";
  $panier = new panier();
  $encaissement= new encaissement();

  if (!isset($_SESSION['tabEntrant']) && !isset($_SESSION['infosFourn'])) {
      $_SESSION['tabEntrant'] = array();
      $_SESSION['infosFourn'] = array();
  }



/*  $journee=$bdd->prepare("SELECT CODE_JOURNEE FROM journee WHERE STATUT=0");
  $journee->execute();
  if (!isset($_SESSION['journee'])) {
    $_SESSION['journee'] = $journee->fetchAll();
    
  }*/
  
  //verifier si la pages existe on scan toute les pages du controleurs
  $pages=scandir("controleurs/");

     // var_dump($pages);
  $page=!empty($_GET["page"])?$_GET["page"]:"login";
  //rec

  
if ($page == "reload_mdp_2") {
  include("controleurs/".$page.".php");
}else{
   //Pour la définition du mot de passe d'un nouvel utilisateur
  if (isset($_GET['definePass']) && $_GET['definePass']==1){ 
          include("controleurs/".$page.".php");

  }else{

    if (isset($_GET["page"]) && strstr($_GET["page"],"etat_")){
        include("controleurs/".$page.".php");
        $_SESSION["courante_page"] =$page;
    }else{
        if (in_array($page.".php", $pages)) {
            if ($page !== "login") {
                ?>
                <!DOCTYPE html>
                <meta charset="utf-8">
                <html lang="fr">
                <?php include("pages/include/headerNormal.php"); ?>

                <body>

                <div id="wrapper">
                    <!-- Navigation -->

                    <?php include("pages/include/new_menu.php"); ?>

                </div>
                <!-- /#wrapper -->
                <div id="page-wrapper">
                    <?php include("controleurs/".$page.".php"); ?>
                </div>

                <?php include("pages/include/footerNormal.php"); ?>

                </body>

                </html>
                <?php
            }
            else
            {
                include("controleurs/".$page.".php");
            }

            $_SESSION["courante_page"] =$page;

        }
        else{
            include("controleurs/".$page.".php");

        }
    }

  }
}





  






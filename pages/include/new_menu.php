<?php 

if (isset($_POST['logout'])) {
  $Auth->logout();
}

    $user=$_SESSION['Auth']->code_user;
    $final = 0;
    




?>


<?php

$menu =  '<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page="> Croûte dorée | Interface '. $_SESSION['Auth']->libelle.'</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">';

if ($_SESSION['Auth']->code_privilege == 2|| $_SESSION['Auth']->code_privilege == 1){
echo $menu;}
?>
<!-- /.navbar-header -->
<!-- /.dropdown-user -->

<!-- /.dropdown-user -->
<?php
$menu = '
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>PROFILS :'. $_SESSION['Auth']->login. '<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					   <li class="dropdown-header"> UTILISATEURS </li> 
                        <!-- <li><a href="?page=profil"><i class="fa fa-user fa-fw"></i> Profils </a>
                        </li>
                        <li><a href="?page=reload_mdp_2&id=2"><i class="fa fa-key fa-fw"></i> Mot de passe</a>
                        </li> -->
                        <li class="divider"></li>
                        <form method="post" action="">
                        <li><input class="btn btn-outline btn-danger fa fa-sign-out col-lg-12" type="submit" name="logout" value="Deconnexion">
                        </li>
                        </form>
                    </ul> 
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
             ';
if ($_SESSION['Auth']->code_privilege == 2|| $_SESSION['Auth']->code_privilege ==1 ){
    echo $menu; }
?>
<!-- /.dropdown-user -->
<?php
$menu = '
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 2|| $_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
                        <li>
                            <a href="index.php?page=acceuil"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord </a>
                        </li>
                                 ';
if ($_SESSION['Auth']->code_privilege == 2|| $_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
                        <li>
                            <a href="?page="><i class="fa fa-shopping-basket fa-fw"></i> Espace commande<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?page=vente"><i class="fa fa-cart-plus fa-fw"></i>Nouvelle</a>
                                </li>
                                <li>
                                    <a href="index.php?page=liste_vente"><i class="fa fa-cart-arrow-down fa-fw"></i>Liste des commandes du jour</a>
                                </li>
                                <li>
                                    <a href="index.php?page=liste_totale"><i class="fa fa-cart-arrow-down fa-fw"></i>Liste globale des commandes</a>
                                </li>
                                <li>
                                    <a href="?page="><i class="fa fa-history fa-fw"></i> Livraisons<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                      <li>
                                         <a href="?page=livraisonList"><i class="fa fa-truck fa-fw"></i> Livraisons en attente</a>
                                      </li>
                                    </ul>
                            
                                 </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 1 || $_SESSION['Auth']->code_privilege == 2){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
						<li>
                            <a href="?page="><i class="fa fa-diamond fa-fw"></i> Caisse<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=encaisser"><i class="fa fa-money fa-fw"></i> Gestion commandes </a>
                                </li>
								                
                            </ul>
                            
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 2){
    echo $menu;}
?>

<?php
$menu = '
            <li>
                            <a href="?page="><i class="fa fa-diamond fa-fw"></i> Caisse<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=encaisser"><i class="fa fa-money fa-fw"></i> Gestion commandes </a>
                                </li>
                                <li>
                                    <a href="?page="><i class="fa fa-history fa-fw"></i> Comptabilite<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                      <li>
                                         <a href="?page=sacs_farine"><i class="fa fa-ticket fa-fw"></i> Nombres de sacs</a>
                                      </li>
                                      <li>
                                         <a href="?page=controle_facture"><i class="fa fa-ticket fa-fw"></i> Controle de facture</a>
                                      </li>

                                      <li>
                                         <a href="?page=controle_annule"><i class="fa fa-ticket fa-fw"></i> Factures annulees</a>
                                      </li>
                                       <li>
                                         <a href="?page=evaluation"><i class="fa fa-ticket fa-fw"></i> Rendements Equipes </a>
                                      </li>
                           
                                      </ul>
                            
                                 </li>
                                
                            </ul>
                            
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>



<!-- /.dropdown-user -->
<?php
$menu = '
                        <li>
                            <a href="#"><i class="fa fa-medkit fa-fw"></i> Gestions pains<span class="fa arrow"></span> </a>
							<ul class="nav nav-second-level">
              
					           <li>
                                    <a href="?page=produit"><i class="fa fa-plus-square fa-fw"></i> Ajouter un produit</a>
                                </li>
								
								<li>
                                    <a href="?page=list_produit"><i class="fa fa-table fa-fw"></i> Liste Pains</a>
                                </li>
                                
                            </ul>
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<!-- /.dropdown-user -->
<?php
$menu = '
                        <li>
                            <a href="?page="><i class="fa fa-users fa-fw"></i> Gestion des clients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							      <li>
                                    <a href="?page=ajout_client">  <i class="fa fa-male fa-fw"></i>Ajouter un client</a>
                                   </li>
                                <li>
                                    <a href="?page=list_client"><i class="fa fa-table fa-fw"></i> Liste des clients</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 1 || $_SESSION['Auth']->code_privilege == 2 ){
    echo $menu;}
?>
<!-- /.dropdown-user -->

<!-- /.dropdown-user -->

<!-- /.dropdown-user -->
<?php
$menu = '
                       
						<li>
                             <a href="?page="><i class="fa fa-user fa-fw"></i> Gestion des utilisateurs<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=utilisateur"><i class="fa fa-user-plus fa-fw"></i> Ajouter un utilisateur</a>
                                        </li>
                                        <li>
                                            <a href="?page=liste_utilisateur"><i class="fa fa-user-times fa-fw"></i> Liste des utilisateurs</a>
                                        </li>
                                    </ul>
                            <!-- /.nav-second-level -->
                                </li>
                                 ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
						<li>
                            <a href="?page=logs"><i class="fa fa-files-o fa-fw"></i> Logs<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=logs_connexion"> <i class="fa fa-file-archive-o fa-fw"></i> Logs connexions</a>
                                </li>
                                <li>
                                    <a href="?page=logs"><i class="fa fa-file-code-o fa-fw"></i> Logs evenements</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
                     <!--   <li>
                            <a href="?page="><i class="fa fa-file-excel-o fa-fw"></i> Etats Statistiques <i class="fa fa-file-pdf-o fa-fw"></i><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                        <a href="?page="><i class="fa fa-file-pdf-o fa-fw"></i> Statistiques de ventes <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=tableau_recap_ticket">Recaps des tickets</a>
                                     </li>
                                      <li>
                                    <a href="?page=vente_credit_caisse">Vente crédit</a>
                                      </li>
									  <li>
                                    <a href="?page=Tableau_recap_encaissement">Recap Encaissement</a>
                                      </li>
									  <li>
                                    <a href="?page=tableau_recap_sortie_caisse"> Recap sortie caisse</a>
                                      </li>
									   <li>
                                    <a href="?page=recap_mouvement"> Recap Mouvement</a>
                                      </li>
                                    </ul>
                                  </li>-->
                                   ';
if ($_SESSION['Auth']->code_privilege == 1 /*|| $_SESSION['Auth']->code_privilege == 2*/){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
								  
								  <!--<li>
                                        <a href="?page="><i class="fa fa-file-excel-o fa-fw"></i> Statistiques Produits <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=generiq_produit"> Génériques Produits</a>
                                     </li>
                                      <li>
                                    <a href="?page=tableau_recap_produit_enrg">Enreg Produits</a>
                                      </li>
									  <li>
                                    <a href="?page=tableau_recap_produit_perime">Produits Périmés</a>
                                      </li>
                                    </ul>
                                  </li>-->
                                   ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->
<?php
$menu = '
								<!--  <li>
                                        <a href="?page="><i class="fa fa-file-pdf-o fa-fw"></i> Statistiques d\'Affaires <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=tableau_recap_compte">Situation Compte</a>
                                     </li>
                                      <li>
                                    <a href="?page=recap_chiffre_affaire">Chiffre d\'affaire</a>
                                      </li>
									  <li>
                                    <a href="?page=recap_benefice">Benefice primaire</a>
                                      </li>
                                    </ul>
                                  </li>->
                                   ';
if ($_SESSION['Auth']->code_privilege == 1){
    echo $menu;}
?>
<!-- /.dropdown-user -->

<?php
$menu = '                   </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         </Br> </Br>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>';
		if ($_SESSION['Auth']->code_privilege == 2|| $_SESSION['Auth']->code_privilege == 1){
echo $menu;}
?>
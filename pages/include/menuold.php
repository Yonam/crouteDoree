<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page="> OWO Pharma | Interface <?php echo "Utilisateurs" // ici on mettra une variable et une requete pour recupérer le profil de l'utilisateur?>  </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench fa-fw"></i><i class="fa fa-shopping-basket fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					   <li class="dropdown-header"> CAISSE </li> 
                        <li><a href="?page=historiq_caisse"><i class="fa fa-history fa-fw"></i> Historique vente </a>
                        </li> 
						<li><a href="?page=vente_credit_caisse"><i class="fa fa-credit-card fa-fw"></i> Vente credit jour </a>
                        </li>
						<li><a href="?page=sortie_caisse"><i class="fa fa-minus-square fa-fw"></i> Sortie caisse jour </a>
                        </li><li class="divider"></li>
						<li><a href="?page=arret_caisse"><i class="fa fa-close fa-fw"></i> Arrêt de caisse </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
			 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-gear fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-gear">
					   <li class="dropdown-header"> GESTION PHARMACIE </li> 
                        <li><a href="?page=list_produit"><i class="fa fa-medkit fa-fw"></i> Produits</a>
                        </li> <li class="divider"></li>
						<li><a href="?page=stock"><i class="fa fa-th-list fa-fw"></i> Stocks</a>
                        </li> <li class="divider"></li>
						<li><a href="?page=list_client"><i class="fa fa-users fa-fw"></i> Clients</a>
                        </li> <li class="divider"></li>
						<li><a href="?page=journee"><i class="fa fa-calendar-check-o fa-fw"></i> Journées</a>
                        </li> <li class="divider"></li>
                        <li><a href="?page=liste_vente"><i class="fa fa-shopping-basket fa-fw"></i> Ventes</a>
                        </li> <li class="divider"></li
                        <li><a href="?page=liste_utilisateur"><i class="fa fa-user fa-fw"></i> Utilisateurs</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-gears fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-gear">
					 <li class="dropdown-header"> PARAMETRES </li> 
                        <li>
                            <a href="?page=societe"><i class="fa fa-institution fa-fw"></i>
                            Societes    
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="?page=dictionnaire">
                                <i class="fa fa-book fa-fw"></i>
                                 Dictionnaires   
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="?page=donnees"><i class="fa fa-database fa-fw"></i>
                               Données 
								</a>
                        </li>
                        <li class="divider"></li>
                        <li >
                            <a class="text-center" href="?page=logs"><i class="fa fa-warning fa-fw"></i>
                                <strong>Logs</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					   <li class="dropdown-header"> UTILISATEURS </li> 
                        <li><a href="?page=utilisateur"><i class="fa fa-user fa-fw"></i> Profils </a>
                        </li>
                        <li><a href="?page=reinitialisation"><i class="fa fa-key fa-fw"></i> Mot de passe</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="?page="><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
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
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord </a>
                        </li>
						<li>
                                    <a href="#"><i class="fa fa-calendar-check-o fa-fw"></i> Gestion des journees<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=ouvrir_journee"><i class="fa fa-calendar-plus-o fa-fw"></i>Ouvrir une journee</a>
                                        </li>
                                        <li>
                                            <a href="?page=journee"><i class="fa fa-calendar-times-o fa-fw"></i>Journées de Caisse</a>
                                        </li>
                                    </ul>
                            <!-- /.nav-second-level -->
                                </li>
                        <li>
                            <a href="?page="><i class="fa fa-shopping-basket fa-fw"></i> Espace vente<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?page=vente"><i class="fa fa-cart-plus fa-fw"></i>Vendre</a>
                                </li>
                                <li>
                                    <a href="index.php?page=liste_vente"><i class="fa fa-cart-arrow-down fa-fw"></i>Liste des ventes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="?page="><i class="fa fa-diamond fa-fw"></i> Caisse<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=encaisser"><i class="fa fa-money fa-fw"></i> Encaisser</a>
                                </li>
								<li>
                                    <a href="?page=historiq_journee"> <i class="fa fa-history fa-fw"></i> Historique de la journee</a>
                                </li>
                                <li>
                                    <a href="?page=sortie_caisse"><i class="fa fa-hand-o-right fa-fw"></i> Sortie de caisse</a>
                                </li>
								 <li>
                                        <a href="?page="><i class="fa fa-history fa-fw"></i> Gestion Tickets<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                   <a href="?page=tickets_caisse"><i class="fa fa-ticket fa-fw"></i> Tickets de caisse</a>
                                                </li>
                                            </ul>
                            
                                 </li>
                            </ul>
                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-medkit fa-fw"></i> Gestions produits<span class="fa arrow"></span> </a>
							<ul class="nav nav-second-level">
              
					           <li>
                                    <a href="?page=produit"><i class="fa fa-plus-square fa-fw"></i> Ajouter un produit</a>
                                </li>
								
								<li>
                                    <a href="?page=list_produit"><i class="fa fa-table fa-fw"></i> Liste Produits</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="?page="><i class="fa fa-th-list fa-fw"></i> Stocks<span class="fa arrow"></span> </a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=stock"><i class="fa fa-bars fa-fw"></i> Etat du Stock</a>
                                </li>
								<li>
                                    <a href="?page=entree_stock"><i class="fa fa-sort-amount-asc fa-fw"></i> Entrée Stock </a>
                                </li>
								<li>
                                    <a href="?page=mise_rebus"><i class="fa fa-sort-amount-desc fa-fw"></i> Mise au rebus </a>
                                </li>
                                <li>
                                    <a href="?page=valeur_stock"><i class="fa fa-dollar fa-fw"></i> Valeur Stock </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page="><i class="fa fa-users fa-fw"></i> Gestion des clients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							      <li>
                                    <a href="?page=ajout_client">  <i class="fa fa-male fa-fw"></i>Ajouter un client</a>
                                   </li>
                                <li>
                                    <a href="?page=list_client"><i class="fa fa-table fa-fw"></i> Liste des clients</a>
                                </li>
                                <li>
                                    <a href="?page=compte_client"><i class="fa fa-exchange fa-fw"></i> Compte Clients</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						 <li>
                                    <a href="#"><i class="fa fa-truck fa-fw"></i> Gestion des fournisseurs<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=ajout_fournisseur"><i class="fa fa-plus-square fa-fw"></i>Ajouter un fournisseur</a>
                                        </li>
                                        <li>
                                            <a href="?page=liste_fournisseur"><i class="fa fa-table fa-fw"></i>Liste des fournisseurs</a>
                                        </li>
                                        <li>
                                            <a href="?page=compte_fournisseur"><i class="fa fa-shield fa-fw"></i>Gestion des comptes fournisseurs</a>
                                        </li>
                                    </ul>
                            <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-motorcycle fa-fw"></i> Gestion des commercials<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=ajout_commercial"><i class="fa fa-shopping-bag fa-fw"></i> Ajouter un commercial</a>
                                        </li>
                                        <li>
                                            <a href="?page=liste_commercial"><i class="fa fa-table fa-fw"></i> Liste des commercials</a>
                                        </li>
                                    </ul>
                            <!-- /.nav-second-level -->
                                </li>
                       
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
						<li>
                            <a href="?page="><i class="fa fa-files-o fa-fw"></i> Logs<span class="fa arrow"></span></a>
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
                        <li>
                            <a href="?page="><i class="fa fa-file-excel-o fa-fw"></i> Etats Statistiques <i class="fa fa-file-pdf-o fa-fw"></i><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                        <a href="?page="><i class="fa fa-file-pdf-o fa-fw"></i> Statistiques de ventes <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=tableau_recap_tickets_caisse ">Recaps des tickets</a>
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
                                    <a href="?page="> Recap Mouvement</a>
                                      </li>
                                    </ul>
                                  </li>
								  
								  <li>
                                        <a href="?page="><i class="fa fa-file-excel-o fa-fw"></i> Statistiques Produits <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page="> Génériques Produits</a>
                                     </li>
                                      <li>
                                    <a href="?page=tablaeu_recap_produit">Enreg Produits</a>
                                      </li>
									  <li>
                                    <a href="?page=tableau_recap_produit_perime">Produits Périmés</a>
                                      </li>
                                    </ul>
                                  </li>
								  <li>
                                        <a href="?page="><i class="fa fa-file-pdf-o fa-fw"></i> Statistiques d'Affaires <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=tableau_recap_compte">Situation Compte</a>
                                     </li>
                                      <li>
                                    <a href="?page=">Chiffre d'affaire</a>
                                      </li>
									  <li>
                                    <a href="?page=">Benefice primaire</a>
                                      </li>
                                    </ul>
                                  </li>
								  <li>
                                        <a href="?page="><i class="fa fa-file-excel-o fa-fw"></i> Statistiques des Journées <span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level">
                                      <li>
                                    <a href="?page=">Tickets arrêts caisse</a>
                                     </li>
                                      <li>
                                    <a href="?page="> Recap cloture caisse</a>
                                      </li>
									  <li>
                                    <a href="?page="> Ticket Mouvement Journée</a>
                                      </li>
									  <li>
                                    <a href="?page="> Recap Journée / Periode</a>
                                      </li>
                                    </ul>
                                  </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 </Br> </Br>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
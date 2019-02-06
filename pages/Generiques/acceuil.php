<?php 
    global $bdd;

        $sqlNbProd = 'select count(*) as nbProd from pains';
        $NbProd = $bdd->query($sqlNbProd);
        $NbProd = $NbProd->fetch(PDO::FETCH_ASSOC);

        $sqlNbCli = 'select count(*) as nbCli from client';
        $NbCli = $bdd->query($sqlNbCli);
        $NbCli = $NbCli->fetch(PDO::FETCH_ASSOC);


        $sqlNbProdVenteJour = 'select count(code_cmde) as nbCmde from commande where valide = 0';
        $NbProdVenteJour = $bdd->query($sqlNbProdVenteJour);
        $Nb_cmde = $NbProdVenteJour->fetch(PDO::FETCH_ASSOC);
 ?>


<br>
<h1 style="text-align: center">Bienvenue </h1>
<br>

<h3 class="col-lg-6">Aujourd'hui nous sommes le <?php echo date('d M Y'); ?></h3>
<h3 class="col-lg-6" style="text-align: right"> 
<?php
 
    echo "Appli de gestion.";
 

?> 
</h3>

<hr>

            <!-- /.row -->
            <div class="row">
                
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-medkit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $NbProd['nbProd'] ; ?></div>
                                    <div>Produits</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=list_produit">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $NbCli['nbCli'] ; ?></div>
                                    <div>Clients</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=list_client">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <h2 style="text-align: center">Statistiques de journée </h2>
            <br>
                                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $Nb_cmde['nbCmde'] ; ?></div>
                                    <div>Commandes en attente de validation</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Statistiques de ventes des produits

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Taux de vente par type de produits
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->


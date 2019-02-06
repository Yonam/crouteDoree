<?php $Auth->allow('admin'); 
global $bdd;
$sqlNbFourn = 'select count(*) as nbFourn from fournisseur';
$NbFourn = $bdd->query($sqlNbFourn);
$NbFourn = $NbFourn->fetch(PDO::FETCH_ASSOC);

$sqlNbProd = 'select count(*) as nbProd from produit';
$NbProd = $bdd->query($sqlNbProd);
$NbProd = $NbProd->fetch(PDO::FETCH_ASSOC);

$sqlNbCom = 'select count(*) as nbCom from commerciale';
$NbCom = $bdd->query($sqlNbCom);
$NbCom = $NbCom->fetch(PDO::FETCH_ASSOC);

$sqlNbCli = 'select count(*) as nbCli from client';
$NbCli = $bdd->query($sqlNbCli);
$NbCli = $NbCli->fetch(PDO::FETCH_ASSOC);


$sqlDateJournee = 'select date from journee where statut = 0';
$DateJournee = $bdd->query($sqlDateJournee);
$DateJournee = $DateJournee->fetch(PDO::FETCH_ASSOC);


$sqlNbVenteJour = 'select count(*) as nbVenteJour from vente where code_journee = (select code_journee from journee where statut = 0) and code_encaissement <> null';
$NbVenteJour = $bdd->query($sqlNbVenteJour);
$NbVenteJour = $NbVenteJour->fetch(PDO::FETCH_ASSOC);

$sqlNbProdVenteJour = 'select count(pv.code_produit) as nbProdVenteJour from produit_vendu pv where pv.code_vente in (select v.code_vente from vente v where v.code_journee = (select j.code_journee from journee j where statut = 0) and v.code_encaissement <> null)';
$NbProdVenteJour = $bdd->query($sqlNbProdVenteJour);
$NbProdVenteJour = $NbProdVenteJour->fetch(PDO::FETCH_ASSOC);

/*$sqlTotalOutCaisse = 'select count(*) as TotalOutCaisse from ';
$TotalOutCaisse = $bdd->query($sqlTotalOutCaisse);
$TotalOutCaisse = $TotalOutCaisse->fetch(PDO::FETCH_ASSOC);*/


?>



<br>
<h1 style="text-align: center">Bienvenue </h1>
<br>

<h3 class="col-lg-6">Aujourd'hui nous sommes le <?php echo date('d M Y'); ?></h3>
<h3 class="col-lg-6" style="text-align: right"> 
<?php
 if($DateJournee == false){
    echo "Aucune journée de caisse ouverte.";
 }else{
    echo  "La journée de caisse est le ".date('d M Y', strtotime(explode(" ",$DateJournee['date'])[0]));
 }

?> 
</h3>



            <br>
            <br>
            <br>
            <br>
            <h2 style="text-align: center">Statistiques de journée </h2>
            <br>
                                    <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $NbVenteJour['nbVenteJour'] ; ?></div>
                                    <div>Ventes</div>
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
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo "0" ; ?></div>
                                    <div>Sorties de caisses</div>
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
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user-md fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $NbProdVenteJour['nbProdVenteJour'] ; ?></div>
                                    <div>Produits vendus</div>
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


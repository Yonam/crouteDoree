<?php 

global $bdd;

$bdd->beginTransaction();
    $vente= $bdd->prepare('SELECT CM.CODE_CMDE, CM.DATE_CMDE, CM.DATE_LIVRAISON, CM.HEURE_LIVRAISON, CM.NUMERO_TICKET, CM.VALIDE, CL.NOM_CLIENT FROM commande CM JOIN client CL ON CM.CODE_CLIENT = CL.CODE_CLIENT WHERE CM.SUPPRIME = 0');
    $vente->execute();
$bdd->commit();

if (isset($_GET['liste'])) {
  $encaissement->liste($_GET['liste']);
}


 ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">Liste globale des commandes </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <form method="post" action="pages/etats/commandes.php">
                                <input type="submit" class="btn btn-danger" name="listeCommande" value="Imprimer">
                            </form>


                            <button class="btn btn-outline btn-success fa fa-money" type="button" data-toggle="modal" data-target="Recherche" > <?php echo "imprimer " ?></button>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                           <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">                               
                             <thead>
                                    <tr>
                                        <th style="text-align:center">Numero ticket</th>
                                        <th style="text-align:center">Date commande</th>
                                        <th style="text-align:center">Client</th>
                                        <th style="text-align:center">Livraison</th>
                                        <th style="text-align:center">Statut</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                <tbody>
                               <?php foreach ($vente as $d) { ?>
                                    <tr class="odd gradeX">
                                        <td style="text-align:center"><?php echo $d->NUMERO_TICKET; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_CMDE; ?></td>
                                        <td style="text-align:center"><?php echo $d->NOM_CLIENT; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_LIVRAISON.' '.$d->HEURE_LIVRAISON; ?></td>
                                         <td style="text-align:center">
                                                
                                           <?php 
                                                if ($d->VALIDE == 1) { ?>
                                                   <div style="text-decoration: bold"> validé</div> 
                                                <?php } else { ?>
                                                    <div style="text-decoration: bold"> attente </div> 
                                                <?php } ?>
                                        </td>
                                        <td style="text-align:center">
                                            <button class="btn btn-outline btn-success fa fa-money" type="button" data-toggle="modal" data-target="#myModal<?= $d->CODE_CMDE; ?>" > <?php echo "Lister la commande ".$d->CODE_CMDE; ?></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal<?= $d->CODE_CMDE; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="post" name="encaisser" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Liste des produits de la commande <?= $d->CODE_CMDE  ?>  </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php 
                                                        $liste = $encaissement->liste($d->CODE_CMDE);
                                                         ?>
                                                    
                                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                                                <?php if(isset($liste)){ ?>  
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="text-align:center">Produit</th>
                                                                            <th style="text-align:center">Prix unitaire</th>
                                                                            <th style="text-align:center">Quantite</th>
                                                                            <th style="text-align:center">Prix total</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr>
                                                                        <?php
                                                                            $total = 0;
                                                                         foreach ($liste as $l) { ?>

                                                
                                                                            <td style="text-align:center"><?=$l->LIBELLE;?></td>
                                                                            <td style="text-align:center"><?=$l->PRIX;?></td>
                                                                            <td style="text-align:center"><?=$l->QTE;?></td>
                                                                            <td style="text-align:center"><?=$l->TOTAL;?></td>

                                                                        </tr>
                                                                        <?php  $total+= $l->TOTAL;} } else{?>
                                                                            <br />
                                                                            <center class="ui-state-highlight ui-corner-all">Aucun article n'a été enregistré pour l' instant ...</center>
                                                                        <?php } ?>
                                                            
                                                                        <tr>

                                                                            <td colspan="2"><h3>Cout des marchandises : </h3></td>
                                                                            <td colspan="3"><h3><?= $total; ?></h3></td>
                                                                        </tr>
                                                                    
                                                                    </tbody>
                                                                </table>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="text" name="codeVente" hidden value="<?php if(isset($d)){ echo $d->CODE_CMDE;} ?>">
                                                        
                                                        <button type="button" class="btn btn-danger fa fa-close" data-dismiss="modal"> Fermer</button>
                                                    </div>
                                                </div>
                                                <!-- </form> -->
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        </td>

                                        <!-- <form method="post" name="annuler" action=""> -->
                                            <!-- <input type="text" name="vente" value="<?= $d->CODE_CMDE; ?>"> -->
                                            
                                            <!-- <td style="text-align:center">
                                                
                                                <button type="submit" class="btn btn-outline btn-danger fa fa-times" name="annuler"> Annuler </button>
                                            </td> -->

                                           
                                        </form>
                                    </tr>
                                <?php   } ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div class="modal fade" id="Recherche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" name="commande" action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Impression de liste </h4>
                        </div>
                        <div class="modal-body">
                            <?php 
                            $liste = $encaissement->liste($d->CODE_CMDE);
                             ?>
                        
                            


                        </div>
                        <div class="modal-footer">
                            
                            
                            <button type="button" class="btn btn-danger fa fa-close" data-dismiss="modal"> Fermer</button>
                        </div>
                    </div>
                    <!-- </form> -->
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


            
        


            


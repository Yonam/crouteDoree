<?php 

global $bdd;

$bdd->beginTransaction();
    $vente= $bdd->prepare('SELECT CM.CODE_CMDE, CM.DATE_CMDE, CM.DATE_LIVRAISON, CM.HEURE_LIVRAISON, CM.NUMERO_TICKET, CL.NOM_CLIENT, CP.QUANTITE, CP.PRIX_VENTE FROM commande CM JOIN commande_pain CP ON CM.CODE_CMDE = CP.CODE_CMDE JOIN client CL ON CM.CODE_CLIENT = CL.CODE_CLIENT WHERE CM.VALIDE = 0 AND CM.SUPPRIME = 0');
    $vente->execute();
$bdd->commit();

if (isset($_GET['liste'])) {
  $encaissement->liste($_GET['liste']);
}


 ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">Commandes en attente de validation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Liste des commandes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Numero ticket</th>
                                        <th style="text-align:center">Date commande</th>
                                        <th style="text-align:center">Client</th>
                                        <th style="text-align:center">Livraison</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                <tbody>
                               <?php foreach ($vente as $d) { ?>
                                    <tr class="odd gradeX">
                                        <td style="text-align:center"><?php echo $d->NUMERO_TICKET; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_CMDE; ?></td>
                                        <td style="text-align:center"><?php echo $d->NOM_CLIENT; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_LIVRAISON.' '.$d->HEURE_LIVRAISON; ?></td>
                                        

                                        <form method="post" name="annuler" action="">
                                            <input type="text" name="cmde" hidden="hidden" value="<?= $d->CODE_CMDE; ?>">
                                            
                                            <td style="text-align:center">
                                                
                                                <button type="submit" class="btn btn-outline btn-danger fa fa-times" name="annuler"> Annuler </button>
                                            </td>

                                            <td style="text-align:center">
                                                
                                                <button class="btn btn-outline btn-warning fa fa-liste" type="button" data-toggle="modal" data-target="#modificationCmde<?= $d->CODE_CMDE; ?>" > <?php echo "Modifier la commande ".$d->CODE_CMDE; ?></button>



                                                <div class="modal fade" id="modificationCmde<?= $d->CODE_CMDE; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="post" name="encaisser" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Liste des produits de la commande <?= $d->CODE_CMDE  ?>  </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="livraison">Date livraison</label>
                                                        <input class="col-lg-6 form-control" type="text" name="livraison" id="livraison" value="<?=$d->DATE_LIVRAISON  ?>">

                                                        <label for="heure">Heure de livraison</label>
                                                        <input class="col-lg-6 form-control" type="text" name="heure" id="heure" value="<?=$d->HEURE_LIVRAISON?>">

                                                        <label for="quantite">quantite </label>
                                                        <input class="col-lg-6 form-control" type="text" name="quantite" id="quantite" value="<?=$d->QUANTITE?>">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="text" name="code_commande" hidden value="<?php if(isset($d)){ echo $d->CODE_CMDE;} ?>">

                                                        <input type="text" name="prix_vente" hidden value="<?php if(isset($d)){ echo $d->PRIX_VENTE;} ?>">

                                                         <button type="submit" class="btn btn-outline btn-warning fa fa-check" name="modifier"> Valider </button>
                                                        <button type="button" class="btn btn-danger fa fa-close" data-dismiss="modal"> Fermer</button>
                                                    </div>
                                                </div>
                                                <!-- </form> -->
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php   } ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

        


            

            
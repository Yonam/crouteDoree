<?php 

global $bdd;

$bdd->beginTransaction();
    $vente= $bdd->prepare('SELECT CM.CODE_CMDE, CM.DATE_CMDE, CM.DATE_LIVRAISON, CM.HEURE_LIVRAISON, CM.NUMERO_TICKET, CM.VALIDE, CL.NOM_CLIENT FROM commande CM JOIN client CL ON CM.CODE_CLIENT = CL.CODE_CLIENT WHERE CM.SUPPRIME = 1');
    $vente->execute();
$bdd->commit();

if (isset($_GET['liste'])) {
  $encaissement->liste($_GET['liste']);
}


 ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">Liste des commandes annulees </h1>
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

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Numero ticket</th>
                                        <th style="text-align:center">Date commande</th>
                                        <th style="text-align:center">Client</th>
                                        <th style="text-align:center">Livraison</th>
                                    </tr>
                                <tbody>
                               <?php foreach ($vente as $d) { ?>
                                    <tr class="odd gradeX">
                                        <td style="text-align:center"><?php echo $d->NUMERO_TICKET; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_CMDE; ?></td>
                                        <td style="text-align:center"><?php echo $d->NOM_CLIENT; ?></td>
                                        <td style="text-align:center"><?php echo $d->DATE_LIVRAISON.' '.$d->HEURE_LIVRAISON; ?></td>
                                        
                                       

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


            
        


            


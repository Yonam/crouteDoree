<?php
global $bdd;
$clients= $bdd->prepare('SELECT CODE_CLI, TITRE, NOM_CLI, PRENOM_CLI, EMAIL, ADRESSE, TEL1, TEL2, STATUT,TOTAL_DU SOLDE, CREDIT_MAX, DELAI_PAIEMENT, REMISE, DROIT_CREDIT, DEPASSEMENT FROM client where client.DELETE = 0');
$clients->execute();
$data=$clients->fetchAll();
$four=array();




?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">COMPTE CLIENT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="btn btn-outline btn-primary fa fa-print" href="#"> IMPRIMER</a>
                            <!-- <a class="btn btn-outline btn-success fa fa-file" href="#"> EXPORTER</a> -->
                            
                            <B>  <h3> Liste des comptes clients </h3></B>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom et prénom(s)</th>
                                        <th>Credit Max</th>
                                        <th>Delai</th>
                                        <th>Remise</th>
                                        <th>Credit</th>
                                        <th>Dette</th>
                                        <th>Depassement</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                               <?php foreach ($data as $d){
                                //var_dump($data) ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $d->CODE_CLI; ?></td>
                                        <td><?php echo $d->TITRE." ".$d->NOM_CLI." ".$d->PRENOM_CLI; ?></td>
                                        <td><?php echo $d->CREDIT_MAX; ?></td>
                                        <td><?php echo $d->DELAI_PAIEMENT." jours"; ?></td>
                                        <td><?php echo $d->SOLDE." FCFA"; ?></td>
                                        <td><?php if($d->DROIT_CREDIT==0){echo "Oui";} else{echo "non";} ?></td>
                                        <td><?php echo $d->SOLDE; ?> FCFA</td>
                                        <td><?php if($d->DROIT_CREDIT==0) {echo $d->DEPASSEMENT." FCFA";} else {echo "Non Autorisé";}?>
                                            </td>
                                        <td class="center">

                                            <button class="btn btn-outline btn-default fa fa-history" type="button" data-toggle="modal" data-target="#myModalHist<?= $d->CODE_CLI; ?>" > Historique</button>
                                            
                                            <div class="modal fade" id="myModalHist<?= $d->CODE_CLI; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="post" action="">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Liste des mouvements du client <?= $d->CODE_CLI ?>  </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $opCompte = 'SELECT * FROM operationcompte where code_cli ='.$d->CODE_CLI; 
                                                            $opCompte = $bdd->query($opCompte);
                                                            $liste = $opCompte->fetchAll();

                                                            ?>
                                                        
                                                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                                                    <?php if(isset($liste) && $liste ==true){ ?>  
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="text-align:center">Date</th>
                                                                                <th style="text-align:center">Solde</th>
                                                                                <th style="text-align:center">Montant Versé</th>
                                                                                <th style="text-align:center">Reste à payer</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr>
                                                                            <?php
                                                                                $total = 0;
                                                                             foreach ($liste as $l) { ?>

                                                    
                                                                                <td style="text-align:center"><?=$l->DATE;?></td>
                                                                                <td style="text-align:center"><?=$l->SOLDE;?></td>
                                                                                <td style="text-align:center"><?=$l->MONTANT_VERSE;?></td>
                                                                                <td style="text-align:center"><?=$l->RESTE;?></td>

                                                                            </tr>
                                                                            <?php  } } else{?>
                                                                                <br />
                                                                                <center class="ui-state-highlight ui-corner-all">Aucun opération n'a été faite pour l' instant ...</center>
                                                                            <?php } ?>

                                                                        </tbody>
                                                                    </table>
                                                       </div>
                                                        <div class="modal-footer">
                                                            
                                                            <button type="button" class="btn btn-danger fa fa-close" data-dismiss="modal"> Fermer</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                            </div>



                                            <button class="btn btn-outline btn-primary  fa fa-money" type="button" data-toggle="modal" data-target="#myModal<?= $d->CODE_CLI; ?>" > Encaisser</button>

                                            <div class="modal fade" id="myModal<?= $d->CODE_CLI; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="post" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Encaissement pour le compte de <?= $d->NOM_CLI.' '.$d->PRENOM_CLI?>  </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <div class="form-group col-lg-12">
                                                            <label for="montant">Montant versé</label>
                                                            <input type="number" required class="form-control" id="montant" name="montant">
                                                        </div>

                                                        <div class="row">   
                                                            

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <!-- <hr> -->
                                                        <input type="text" name="codeVente" hidden value="<?php if(isset($d)){ echo $d->CODE_CLI;} ?>">
                                                        <button type="submit" class="btn btn-success fa fa-money" name="encaisserCli"
                                                            > Encaisser</button>
                                                        <button type="button" class="btn btn-danger fa fa-close" data-dismiss="modal"> Fermer</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                            </div>


                                        </td>
                                    </tr>
                                <?php } ?>
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




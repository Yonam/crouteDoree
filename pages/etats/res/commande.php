<link type="text/css" href="./res/assets/bootstrap/bootstrap.min.css" rel="stylesheet" >
<link type="text/css" href="./res/assets/bootstrap/sb-admin-2.min.css" rel="stylesheet" >
<page style="font-size: 14px">
    
    test de tableau imbriqué :<br>
    <table border="1" bordercolor="#007" bgcolor="#AAAAAA" align="center">
        <tr>
            <td border="1">
                <table style="border: solid 1px #FF0000; background: #FFFFFF; width: 100%; text-align: center">
                    <tr>
                        <th style="border: solid 1px #007700;width: 50%">C1 € «</th>
                        <td style="border: solid 1px #007700;width: 50%">C2 € «</td>
                    </tr>
                    <tr>
                        <td style="border: solid 1px #007700;width: 50%">D1 &euro; &laquo;</td>
                        <th style="border: solid 1px #007700;width: 50%">D2 &euro; &laquo;</th>
                    </tr>
                </table>
            </td>
            <td border="1">A2</td>
            <td border="1">AAAAAAAA</td>
        </tr>
        <tr>
            <td border="1">B1</td>
            <td border="1" rowspan="2">
                <table class="test1">
                    <tr>
                        <td style="border: solid 2px #007700">E1</td>
                        <td style="border: solid 2px #000077; padding: 2mm">
                            <table style="border: solid 1px #445500">
                                <tr>
                                    <td>
                                        <img src="./res/logo.gif" alt="Logo" width=100 />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: solid 2px #770000">F1</td>
                        <td style="border: solid 2px #007777">F2</td>
                    </tr>
                </table>
            </td>
            <td border="1"><barcode type="EAN13" value="45" style="width: 30mm; height: 6mm; font-size: 4mm"></barcode></td>
        </tr>
        <tr>
            <td border="1"><barcode type="C39" value="HTML2PDF" label="none" style="width: 35mm; height: 8mm"></barcode></td>
            <td border="1">A2</td>
        </tr>
    </table>



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
                    <form method="post">
                        <input type="submit" class="btn btn-danger" name="listeCommande" value="Imprimer">
                    </form>
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
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
   
</page>
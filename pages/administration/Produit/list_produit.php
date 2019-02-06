<?php 
    global $bdd;
    $produit = $bdd->prepare('SELECT CODE_PAIN, REFERENCE, LIBELLE, PRIX_UNIT FROM pains');
    $produit->execute();
    $data=$produit->fetchAll();
    $user=array()
?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">GESTION PRODUITS</h1>
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
                            <a class="btn btn-outline btn-warning fa fa-plus" href="?page=produit"> NOUVEAU</a>
                            <B>  <h3>  Liste des produits </h3></B>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Libelle</th>
                                        <th>Prix unitaire</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                <tbody>
                               <?php foreach ($data as $d){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $d->REFERENCE; ?></td>
                                        <td><?php echo $d->LIBELLE; ?></td>
                                        <td class="center"><?php echo $d->PRIX_UNIT; ?></td>
                                        <!-- <td class="center">
                                            <a class="btn btn-outline btn-success col-lg-4 col-lg-offset-1 fa fa-edit" href="?page=update_produit&amp;id=<?php echo $d->CODE_PAIN; ?>"> Modifier</a>
                                           
                                        </td> -->
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
<?php 
global $bdd;
$clients= $bdd->prepare('SELECT CODE_CLIENT, CA.LIBELLE_CATEGORIE, NOM_CLIENT,CONTACT_CLIENT FROM client CL JOIN categorie CA ON CL.CODE_CATEGORIE=CA.CODE_CATEGORIE');
$clients->execute();
$data=$clients->fetchAll();
$four=array();


if (isset($_SERVER['HTTP_REFERER'])) {
    if (strstr($_SERVER['HTTP_REFERER'], 'script_update_client.php')) {
    echo '<div class="alert alert-success alert-dismissable col-lg-8 col-lg-offset-1 pull-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Modification effectuée avec succès! 
        </div>';
    }
}


?>


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">LISTE CLIENTS</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- <a class="btn btn-outline btn-primary fa fa-print"  href="?page=etat_liste_client"> IMPRIMER</a> -->
                            <!-- <a class="btn btn-outline btn-primary fa fa-print" href="#"> IMPRIMER</a> -->
                            <!-- <a class="btn btn-outline btn-success fa fa-file" href="#"> EXPORTER</a> -->
                            <a class="btn btn-outline btn-warning fa fa-plus" href="?page=ajout_client"> NOUVEAU</a>
                            <B>  <h3> Information sur les clients </h3></B>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Categorie</th>
                                        <th>Nom</th>
                                        <th>Telephone</th>\
                                        <!-- <th>Action</th> -->
                                    </tr>
                                <tbody>
                               <?php 
                               $i = 0;
                               foreach ($data as $d){ 
                                $i++;
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $d->LIBELLE_CATEGORIE; ?></td>
                                        <td><?php echo $d->NOM_CLIENT; ?></td>
                                        <td><?php echo $d->CONTACT_CLIENT; ?></td>
                                        <!-- <td class="center"> -->
                                        <!-- <a type="button" id="" class="btn btn-primary fa fa-edit" href="?page=update_client&amp;id=<?php echo $d->CODE_CLIENT; ?>"> Mod</a> -->

                                        <!-- <button class="btn btn-outline btn-danger fa fa-trash-o" type="button" data-toggle="modal" data-target="#myModalSupr<?php echo $i;?>"> Sup</button> -->

                                        <!-- Modal -->
                                        <!-- <div class="modal fade" id="myModalSupr<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog panel panel-red">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Suppression de <?php echo $d->NOM_CLIENT ?> </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p>
                                                        VOULEZ VOUS VRAIMENT SUPPRIMER CE CLIENT?
                                                    </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" class="btn btn-danger fa fa-trash-o" href="pages/administration/Client/script_delete_client.php?id=<?php echo $d->CODE_CLIENT; ?>">Oui</a>
                                                        <button type="button" class="btn btn-default fa fa-close" data-dismiss="modal">Non</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content --
                                            </div>
                                            <!-- /.modal-dialog --
                                        </div> -->
                                        <!-- /.modal -->


                                       <!--  </td> -->
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



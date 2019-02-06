<?php 
    global $bdd;
    $utilisateur = $bdd->prepare('SELECT CODE_USER,NOM_USER,LOGIN,SUPPRIME,P.LIBELLE FROM utilisateur U JOIN privileges P WHERE U.code_privilege = P.code_privilege');
    $utilisateur->execute();
    $data=$utilisateur->fetchAll();
    //var_dump($data);
    $user=array();
?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">GESTION UTILISATEURS</h1>
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
                            <a class="btn btn-outline btn-warning fa fa-plus" href="?page=utilisateur"> NOUVEAU</a>
                            <B>  <h3>  Liste des comptes utilisateurs </h3></B>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>login</th>
                                        <th>Privilege</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                               <?php foreach ($data as $d){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $d->NOM_USER; ?></td>
                                        <td><?php echo $d->LOGIN; ?></td>
                                        <td class="center"><?php echo $d->LIBELLE; ?></td>

                                        <td class="center"><?php if($d->SUPPRIME == 0){echo "Actif";} else {echo "Desactivé";} ?></td>
                                        <td class="center">
                                            <a class="btn btn-outline btn-success col-lg-4 col-lg-offset-1 fa fa-edit" href="?page=update_utilisateur&amp;id=<?php echo $d->CODE_USER; ?>"> Modifier</a>
                                            <?php
                                                if($d->SUPPRIME == 1){
                                                    echo '<a class="btn btn-outline btn-primary col-lg-4 col-lg-offset-1 fa fa-unlock" href="pages/administration/utilisateurs/script_delete_utilisateur.php?idActive='.$d->CODE_USER.'" > Activer</a>';
                                                }else{
                                                    echo '<a class="btn btn-outline btn-warning col-lg-4 col-lg-offset-1 fa fa-lock" href="pages/administration/utilisateurs/script_delete_utilisateur.php?id='.$d->CODE_USER.'" > Désactiver</a>';
                                                }
                                            ?>
                                            <a class="btn btn-outline btn-danger col-lg-5 col-lg-offset-3 fa fa-refresh" href="pages/administration/utilisateurs/script_delete_utilisateur.php?idReinit=<?php echo $d->CODE_USER; ?>"> Réinitialiser</a>
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



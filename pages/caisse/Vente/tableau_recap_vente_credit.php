<?php
     $fournisseurs= $bdd->query('SELECT * FROM fournisseur F');
?>

            <div class="row">
                <div class="collg-12">
                    <h1 class="page-header">Liste des tickets de caisses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="btn btn-outline btn-primary fa fa-print" href="#"> IMPRIMER</a>
                            <a class="btn btn-outline btn-success fa fa-file" href="#"> EXPORTER</a>
                          <a class="btn btn-outline btn-warning fa fa-plus" href="?page=ajout_fournisseur"> NOUVEAU</a>
                            <B>  <h3> Liste des laboratoires,delegations medicales et fournisseurs pharmceutiques partenaires </h3></B>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <tr>
                                    <th><label for="date"> Date1 : </label></th>
                                    <td><input type="text" name="date" id="date_1">
                                            </td>
                                     <th><label for="date_ouverture"> Date2: </label></th>
                                    <td><input type="text" name="date_ouverture" id="date_2"></td>

                                     <form role="form" method="post">
                                     <td height="50" colspan="2"><br/>
                                    <input class="btn btn-outline btn-success" type="submit" name="go" id="go" value="Ouvrir" />
                                    </td>
                        </form>
                                 </tr>


                            <table class="table table-striped table-bordered table-hover">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                       <th>Date</th>
                                        <th>Id vente</th>
                                        <th>Client</th>
                                        <th>Responsable ouverture</th>
                                        <th>Responsable fermeture</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                               <?php while ($donnees = $fournisseurs->fetch()){  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $donnees['raison_social']; ?></td>
                                        <td><?php echo $donnees['contact']; ?></td>
                                        <td><?php echo $donnees['adresse']; ?></td>
                                        <td><?php echo $donnees['tel']; ?></td>
                                        <td><?php echo $donnees['email']; ?></td>
                                        <td class="center"><?php echo $donnees['solde_compte']; ?></td>
                                        <td class="center">
                                            <a class="btn btn-outline btn-primary fa fa-money" href="#"> Pay</a>
                                            <a class="btn btn-outline btn-success fa fa-edit" href="#"> Mod</a>
                                            <a class="btn btn-outline btn-warning fa fa-times" href="#"> Sup</a>
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



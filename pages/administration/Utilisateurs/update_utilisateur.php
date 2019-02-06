<?php
 global $bdd;
 $id=$_GET['id'];
    $privilege = $bdd->prepare('SELECT U.CODE_USER,U.NOM_USER, U.PRENOM_USER, U.LOGIN, U.STATUT, U.DATE_ENREGISTREMENT, P.CODE_PRIVILEGE,P.DESIGNATION FROM privileges P JOIN utilisateur U ON P.CODE_PRIVILEGE=U.CODE_PRIVILEGE WHERE CODE_USER=? ');
    $privilege->execute(array($id));
    $data=$privilege->fetchAll();
    $four=array()
?>



<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">MISE A JOUR UTILISATEUR</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <!-- /.section des identifiants -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">

                        <form role="form" method="post" action="pages/administration/Utilisateurs/script_update_utilisateur.php">
                        <?php foreach ($data as $d) {  ?>
                            <input type="hidden" name="memids" value="<?php echo $id; ?>" />
                            <formgroup class="col-lg-6">
                            <div class=" form-group col-lg-12">

                                <h3>INFORMATIONS GENERALES</h3>
                                <div class="form-group col-lg-6">
                                    <label for="nom">Nom </label>
                                    <input class="form-control" type="text" id="nom" name="nom" REQUIRED value="<?php echo $d->NOM_USER; ?>" />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="prenom">Prénom(s) </label>
                                    <input class="form-control" type="text" id="prenom" name="prenom" REQUIRED value="<?php echo $d->PRENOM_USER; ?>" />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="priv">Privilège</label>
                                    <select class="form-control" id="priv" name="priv">
                                        <?php foreach ($data as $d){
                                            echo '<option value="'.$d->CODE_PRIVILEGE.'">';

                                            echo $d->DESIGNATION ;

                                            echo '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" id="statut" name="statut"
                                            <?php
                                                if ($d->STATUT == true || $d->STATUT == 1) {
                                                    echo 'checked';
                                                }
                                            ?>

                                            >  Bloqué
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            </formgroup>

                            <formgroup class="col-lg-6">
                            <div class=" form-group col-lg-12">

                                <h3>INFORMATION DE CONNEXION</h3>
                                <div class="form-group col-lg-6">
                                    <label for="login">Login</label>
                                    <input  type = "text" class="form-control" id="login" name ="login" REQUIRED value="<?php echo $d->LOGIN; ?>"/>
                                </div>

                            </div>
                            </formgroup>
                            <div class="col-lg-10 col-lg-offset-1">
                                <button type="reset" class="btn btn-default col-lg-5">ANNULER</button>
                                <button type="submit" class="btn btn-success col-lg-5 col-lg-push-2" name="adduser">ENREGISTRER</button>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                    </div>
                    <!-- /.col-lg-6 (nested) -->

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.section des prix -->

        <!-- /.panel -->
    </div>

<!-- /.row -->
<script>




</script>

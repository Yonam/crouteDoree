<?php
 global $bdd;
 $id=$_GET['id'];
    $user = $bdd->prepare('SELECT LOGIN FROM utilisateur WHERE CODE_USER=?');
    $user->execute(array($id));
    $data=$user->fetchAll();
?>



<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">MODIFICATION DU MOT DE PASSE</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <!-- /.section des identifiants -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">

                        <form role="form" method="post" action="pages/Entite/Utilisateur/script_reload_mdp.php">
                        <?php foreach ($data as $d) {  ?>
                            <input type="hidden" name="memids" value="<?php echo $id; ?>" />

                            <div class=" form-group col-lg-8 col-lg-offset-2">

                                <h3>INFORMATIONS GENERALES</h3>
                                <div class="form-group col-lg-7">
                                    <label for="nom">Login  </label>
                                    <input class="form-control" readonly type="text" id="nom" name="nom" REQUIRED value="<?php echo $d->LOGIN; ?>"/>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="mdp">Nouveau mot de passe </label>
                                    <input class="form-control" type="text" id="mdp" name="mdp" REQUIRED />
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-7">
                                    <label for="mdp1">Confirmez le mot de passe </label>
                                    <input class="form-control" type="text" id="mdp1" name="mdp1" REQUIRED />
                                </div>
                            </div>


                            <div class="col-lg-8 col-lg-offset-2">
                                <button type="reset" class="btn btn-default col-lg-5" >ANNULER</button>
                                <button  type="submit" class="btn btn-success col-lg-5 col-lg-push-2" name="mod_mdp" >ENREGISTRER</button>
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

<!-- /.row -->
<script>




</script>

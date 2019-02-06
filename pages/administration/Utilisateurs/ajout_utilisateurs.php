<?php
 global $bdd;
    $privilege = $bdd->prepare('SELECT CODE_PRIVILEGE,LIBELLE FROM privileges');
    $privilege->execute();
    $data=$privilege->fetchAll();
    $four=array();


if (isset($_POST['adduser'])){

    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $privilege = isset($_POST['priv']) ? $_POST['priv'] : '';
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '0';
    $login = isset($_POST['login']) ? $_POST['login'] : '';

    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $login = htmlspecialchars($login);

        
        $verif = $bdd->query("SELECT login FROM utilisateur");

        $bool = true; 
        while ($donnees = $verif->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees['login'] == $login) {
                $bool = false;
            }    
        }
        if ($bool) {

            $req = $bdd->prepare("INSERT INTO utilisateur (CODE_PRIVILEGE,NOM_USER,LOGIN,SUPPRIME) VALUES(:code_privilege,:nom_user,:login, :statut)");
            $req->execute(array(
            'code_privilege'=>$privilege,
                        'nom_user'=>$nom, 
                        'login'=>$login,
            'statut' =>$statut
            ));
            $lastId = (int)$bdd->lastInsertId();
            
            echo '<body onload ="alert(\'Utilisateur ajouté avec succès\')">';
            header("Location:?page=liste_utilisateur");

        }else{
            echo '<body onload ="alert(\'Le login existe déjà. Entrez un autre login\')">';
        }
}

?>



<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ENREGISTREMENT UTILISATEUR</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <!-- /.section des identifiants -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">

                        <!-- <form role="form" method="post" action="pages/administration/Utilisateurs/script_utilisateur.php"> -->
                        <form role="form" method="post" action="">
                        <formgroup class="col-lg-6">
                            <div class=" form-group col-lg-12">

                                <h3>INFORMATIONS GENERALES</h3>
                                <div class="form-group col-lg-6">
                                    <label for="nom">Nom </label>
                                    <input class="form-control" type="text" id="nom" name="nom" REQUIRED 
                                    <?php
                                        if (isset($_POST['adduser']) && isset($_POST['nom'])) {
                                            echo 'value = "'.$_POST['nom'].'"';
                                        }
                                    ?>
                                    />
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="priv">Privilège</label>
                                    <select class="form-control" id="priv" name="priv">
                                        <?php foreach ($data as $d){
                                            echo '<option value="'.$d->CODE_PRIVILEGE.'"';    
                                            if (isset($_POST['adduser']) && isset($_POST['priv'])) {
                                               if ($_POST['priv'] == $d->CODE_PRIVILEGE) {
                                                   echo ' selected';
                                               }
                                            }
                                            echo '>';

                                            echo $d->LIBELLE ;

                                            echo '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" id="statut" name="statut" 
                                            <?php
                                                if (isset($_POST['adduser']) && isset($_POST['statut']) && $_POST['statut'] == 1) {
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

                                <h3>INFORMATIONS DE CONNEXION</h3>
                                <div class="form-group col-lg-6">
                                    <label for="login">Login</label>
                                    <input  type = "text" class="form-control" id="login" name ="login" REQUIRED 
                                    <?php
                                        if (isset($_POST['adduser']) && isset($_POST['login'])) {
                                            echo 'value = "'.$_POST['login'].'"';
                                        }
                                    ?>
                                    />
                                </div>

                            </div>
                            </formgroup>

                            <div class="col-lg-10 col-lg-offset-1 ">
                                <button type="reset" class="btn btn-default col-lg-5">ANNULER</button>
                                <button  type="submit" class="btn btn-success col-lg-5 col-lg-push-2 submit" name="adduser">ENREGISTRER</button>
                            </div>
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

<?php
include("/pages/include/connexionDB.php");

 /*$tva = $_POST['tva'] =0; 
 $achat =  $_POST['achat']=0; 
 $coef = $_POST['coef']=0; 
 $reduction = $_POST['reduction']=0;*/
 $vente=0;
?>

<?php

    if(!empty($_POST['pv'])){
        if($Auth->vente($_POST['pv'])){
            $vente=vente($_POST['pv']);
            header("Location:?page=produit");

        }else { ?>
            <script type="text/javascript">
                alert('Le Login ou le mot de passe est incorrect! \n veuillez re-essayer s\'il vous plait');
            </script>
       <?php }
    }
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ENREGISTREMENT DE PAINS</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

                    <!-- /.section des identifiants -->
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            
            <div class="panel-body">
                <div class="row">

                    <form role="form" method="post" action="pages/administration/Produit/script_ajout.php">
                            <div class=" form-group col-lg-12">
                                <h3 class="col-lg-10 col-lg-offset-1">INFORMATIONS</h3>

                                <div class="form-group col-lg-5 col-lg-offset-1">
                                    <label for="titre">*Reference</label>
                                    <input type="text" class="form-control" id="Reference" name="Reference" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-10 col-lg-offset-1">
                                    <label for="nom">* Nom du produit</label>
                                    <input class="form-control" type="text" id="nom" name="nom" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-5 col-lg-offset-1">
                                    <label for="tel">*Prix unitaire</label>
                                    <input type="text" class="form-control" id="prix" name="prix" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-5 col-lg-offset-1">
                                    <label for="nbrBySac">Nombre de pain par sac</label>
                                    <input type="number" class="form-control" name="nbrBySac" id="nbrBySac" REQUIRED/>          
                                </div>     

                              

                            </div>

                        <hr class="form-group col-lg-8 col-lg-offset-2">

                        
                        <div class="col-lg-8 col-lg-push-2">
                            <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
                            <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="addProduit" value="ENREGISTRER" />
                        </div>
                    </form>
                </div>

                </div>
        </div>
    </div>

</div>




<!-- DES FONCTIONS POUR LA GESTION DES TABS -->





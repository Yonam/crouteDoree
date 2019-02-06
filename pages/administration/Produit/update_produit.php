<?php
include("/pages/include/connexionDB.php");

 /*$tva = $_POST['tva'] =0; 
 $achat =  $_POST['achat']=0; 
 $coef = $_POST['coef']=0; 
 $reduction = $_POST['reduction']=0;*/
 $vente=0;
?>

<?php 
    global $bdd;
    $id=$_GET['id'];
    $bdd->beginTransaction();
        $produit=$bdd->prepare('SELECT * FROM produit WHERE code_produit=?');
        $produit->execute(array($id));

        $classe=$bdd->prepare('SELECT * FROM classe_produit');
        $classe->execute();

        $famille= $bdd->prepare('SELECT * FROM famille_produit');
        $famille->execute();

        $labo= $bdd->prepare('SELECT CODE_LAB,NOM_LABORATOIRE FROM laboratoire');
        $labo->execute();

        $localisation= $bdd->prepare('SELECT CODE_LOCALISATION,NOM_LOCALISATION FROM localisation');
        $localisation->execute();

        $exploitant= $bdd->prepare('SELECT CODE_EXPLOITANT,LIBELLE FROM exploitant');
        $exploitant->execute();

        $classe= $bdd->prepare('SELECT CODE_CLASSE,DESCRIPTION FROM classe_produit');
        $classe->execute();

        $specialite= $bdd->prepare('SELECT CODE_SPECIALITE,NOM_SPECIALITE FROM specialite');
        $specialite->execute();

        $forme= $bdd->prepare('SELECT CODE_FORME,NOM_FORME FROM forme');
        $forme->execute();
    $bdd->commit();
?>


<?php

    if(!empty($_POST['pv'])){
        if($Auth->vente($_POST['pv'])){
            $vente=vente($_POST['pv']);
            header("Location:?page=update_produit");

        }else { ?>
            <script type="text/javascript">
                alert('Le Login ou le mot de passe est incorrect! \n veuillez re-essayer s\'il vous plait');
            </script>
       <?php }
    }
?>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">MODIFICATION PRODUIT</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

                    <!-- /.section des identifiants -->
<div class="panel panel-default">
    
    <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tab1" >Les identifiants</a></li>
          <li><a data-toggle="tab" href="#tab2" >Informations</a></li>
          <li><a data-toggle="tab" href="#tab3" >Prix</a></li>
          <li><a data-toggle="tab" href="#tab4" >Autre</a></li>
        </ul>

        <div class="panel-body">
            <form role="form" method="post" action="pages/administration/Produit/script_update_produit.php" name="update_produit">
                <?php foreach ($produit as $p) { ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">

                    <input type="hidden" name="memids" value="<?php echo $id; ?>" />
                        <div class="col-lg-12">
                        <h1>les identifiants</h1>
                        <h3>Les codes</h3>
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="cip">CIP</label>
                                    <input class="form-control" id="cip" name="cip" value="<?php echo $p->CIP; ?>">
                                </div>
                                <div class="form-group col-lg-4 col-xm-2">
                                    <label for="barre">Barre</label>
                                    <input class="form-control" id="barre" name="barre" value="<?php echo $p->CODE_BARRE; ?>">
                                </div>
                                <!-- <div class="form-group col-lg-4 col-xm-2">
                                    <label for="interne">Interne</label>
                                    <input class="form-control" id="interne" name="interne" value=" ?>>
                                </div> -->
                                <div class="form-group col-lg-4 col-xm-2">
                                    <label for="famille">Famille</label>
                                    <select class="form-control" id="famille" name="famille" >
                                    <?php foreach ($famille as $f) { ?>
                                        <option value=<?php if($f->CODE_FAMILLE==$p->CODE_PRODUIT) {echo '"'.$f->CODE_FAMILLE.'"'." selected=\"selected\"";} else {echo '"'.$f->CODE_FAMILLE.'"';} ?>>

                                        <?php echo $f->NOM_FAMILLE; ?>

                                        </option>;
                                    <?php } ?>
                                </select> 
                                </div>
                                <div class="form-group col-lg-4 col-xm-2">
                                    <a class="btn btn-primary" role="tab" data-toggle="tab" href="#tab2" >suivant</a>
                                </div>
                            </div>   
                        </div>
                        <!--
                        <div class="col-lg-3">
                            <h3>La photo</h3>
                            <div class="form-group">
                            <br/>
                                <textarea class="form-control" rows="4" id="photo"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">File input</label>
                                <input type="file" id="photo" name="photo">
                            </div>
                        </div>
                        -->
                    </div>

                    <div class="tab-pane" id="tab2">

                        <div class="col-lg-10">
                                        
                            <h1>Informations</h1>
                            <div class="form-group col-lg-6">
                                <label for="dci">Denomination Commune Internatioanl</label>
                                <input class="form-control" id="dci" name="dci" value="<?php echo $p->DCI; ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="designation">Designation</label>
                                <input class="form-control" id="designation" name="designation" value="<?php echo $p->DESIGNATION; ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="commercialisation">Date commercialisation</label>
                                <input type="text" class="form-control mydatepicker"  data-provide="datepicker" placeholder="DD/MM/YYY" id="commercialisation" name="commercialisation" value="<?php echo $p->DATE_COMMERCIALISATION; ?>"/>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="enregistrement">Date enregistrement</label>
                                <input class="form-control datepicker" data-provide="datepicker" id="enregistrement" name="enregistrement" placeholder="DD/MM/YYY" type="text" value="<?php echo $p->DATE_ENREGISTREMENT; ?>"/>
                            </div>

                            <div class="form-group col-lg-6">
                                <a class="btn btn-primary col-lg-12" role="tab" data-toggle="tab" href="#tab3" >suivant</a>
                            </div>
                        </div> 
                    </div>

                    <div class="tab-pane" id="tab3">

                        <div class="col-lg-8">
                            
                        <h1>Prix</h1>
                            
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" onclick="desactiveTva();" value="1" id="tva" name="tva"
                                        <?php
                                            if ($p->SOUMIS_TVA == 1) {
                                                echo "checked";
                                            }
                                        ?>

                                        >Soumis a la TVA
                                    </label>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="taux_tva">Taux TVA</label>
                                    
                                    <select class="form-control" id="taux_tva" value="<?php echo $p->TAUX_TVA; ?>" name="taux_tva">
                                        <option <?php if($p->TAUX_TVA == 0.15){ echo "selected";} ?> value="0.15">0,15</option>
                                        <option <?php if($p->TAUX_TVA == 0.16){ echo "selected";} ?> value="0.16">0,16</option>
                                        <option <?php if($p->TAUX_TVA == 0.17){ echo "selected";} ?> value="0.17">0,17</option>
                                        <option <?php if($p->TAUX_TVA == 0.18){ echo "selected";} ?> value="0.18">0,18</option>
                                        <option <?php if($p->TAUX_TVA == 0.19){ echo "selected";} ?> value="0.19">0,19</option>
                                        <option <?php if($p->TAUX_TVA == 0.20){ echo "selected";} ?> value="0.20">0,20</option>
                                    </select>

                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="achat">Prix d'achat</label>
                                    <input class="form-control" type="number" id="achat" name="achat" value="<?php echo $p->PRIX_PRODUIT; ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="coef">Coeficient</label>
                                    <input class="form-control" type="number" id="coef" name="coef" onblur="calculPrix();">
                                </div>
                                
                                <div class="form-group col-lg-6 col-xm-2">
                                    <label for="vente">Prix de vente</label>
                                    <input class="form-control" id="vente" name="vente" value = "<?php echo $vente;?>" required value="<?php echo $p->PRIX_VENTE; ?>"/>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <a class="btn btn-primary col-lg-12" role="tab" data-toggle="tab" href="#tab4" >suivant</a>
                            </div>
                        </div> 

                        
                    </div>

                    <div class="tab-pane" id="tab4">

                        <div class="col-lg-11">
                            <h1 class="text-center">Autres informations</h1>
                                
                            <div class="form-group col-lg-4">
                                <label for="laboratoire">Laboratoire</label>
                                <select class="form-control" id="laboratoire" name="laboratoire">
                                    <?php foreach ($labo as $l) { ?>
                                        <option value=<?php if($l->CODE_LAB==$p->CODE_LAB) {echo '"'.$l->CODE_LAB.'"'." selected=\"selected\"";} else {echo '"'.$l->CODE_LAB.'"';} ?>>

                                        <?php echo $l->NOM_LABORATOIRE; ?>

                                        </option>;
                                    <?php } ?>
                                </select> 
                            </div>
                            
                            <div class="form-group col-lg-4">
                                <label for="localisation">Localisation</label>
                                <select class="form-control" id="localisation" name="localisation">
                                <?php foreach ($localisation as $l) { ?>
                                    <option value=<?php if($l->CODE_LOCALISATION==$p->CODE_LOCALISATION) {echo '"'.$l->CODE_LOCALISATION.'"'." selected=\"selected\"";} else {echo '"'.$l->CODE_LOCALISATION.'"';} ?>>

                                        <?php echo $l->NOM_LOCALISATION; ?>

                                        </option>;
                                    <?php } ?>
                                </select> 
                            </div>

                            <div class="form-group col-lg-4">
                            
                                <label for="exploitant">Exploitant</label>
                                <select class="form-control" id="exploitant" name="exploitant">
                                <?php foreach ($exploitant as $e) { ?>
                                    <option value=<?php if($e->CODE_EXPLOITANT==$p->CODE_EXPLOITANT) {echo '"'.$e->CODE_EXPLOITANT.'"'." selected=\"selected\"";} else {echo '"'.$e->CODE_EXPLOITANT.'"';} ?>>

                                        <?php echo $e->LIBELLE; ?>

                                    </option>;
                                    <?php } ?>
                                </select> 
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="classe">Classe</label>
                                <select class="form-control" id="classe" name="classe">
                                    <?php foreach ($classe as $c) { ?>
                                    <option value=<?php if($c->CODE_CLASSE==$p->CODE_CLASSE) {echo '"'.$c->CODE_CLASSE.'"'." selected=\"selected\"";} else {echo '"'.$c->CODE_CLASSE.'"';} ?>>

                                        <?php echo $c->DESCRIPTION; ?>

                                    </option>;
                                    <?php } ?>
                                </select> 
                            </div>
                            <div class="form-group col-lg-4">
                            
                                <label for="specialite">Specialite</label>
                                <select class="form-control" id="specialite" name="specialite">
                                    <?php foreach ($specialite as $s) { ?>
                                    <option value=<?php if($s->CODE_SPECIALITE==$p->CODE_SPECIALITE) {echo '"'.$s->CODE_SPECIALITE.'"'." selected=\"selected\"";} else {echo '"'.$s->CODE_SPECIALITE.'"';} ?>>

                                        <?php echo $s->NOM_SPECIALITE; ?>

                                    </option>;
                                    <?php } ?>
                                </select> 
                            </div>
                            <div class="form-group col-lg-4">
                            
                                <label for="forme">Forme</label>
                                <select class="form-control" id="forme" name="forme">
                                    <?php foreach ($forme as $f) { ?>
                                    <option value=<?php if($f->CODE_FORME==$p->CODE_FORME) {echo '"'.$f->CODE_FORME.'"'." selected=\"selected\"";} else {echo '"'.$f->CODE_FORME.'"';} ?>>

                                        <?php echo $f->NOM_FORME; ?>

                                    </option>;
                                    <?php } ?>
                                </select> 
                            </div>      
                        </div>
                        <div class="col-lg-9 col-lg-push-1">
                            <button type="submit" class="btn btn-success col-lg-5" name="addprod">Enregistrer le produit</button>
                            <button type="reset" class="btn btn-danger col-lg-5 col-lg-push-2">Annuler l'enregistrement</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>   
    </div>     
</div>




<!-- DES FONCTIONS POUR LA GESTION DES TABS -->

<script type="text/javascript">
    
   function desactiveTva(){
        if (document.getElementById('tva').checked == false){
           document.getElementById('taux_tva').disabled = true;
        }else{
            document.getElementById('taux_tva').disabled = false;
        }
    };

        function calculPrix() {

        var tva=document.update_produit.taux_tva.value;
        var pa=document.update_produit.achat.value;
        var coef=document.update_produit.coef.value;

        if (document.getElementById('tva').checked == true){
            var pv=(pa*coef)+(pa*tva);
        }
        else{
            var pv=(pa*coef);
        }

        document.update_produit.vente.value=pv;
       }
   
</script>

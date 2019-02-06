<?php 
global $bdd;
$id=$_GET['id'];
$commercial= $bdd->prepare('SELECT code_com, nom_com, prenom_com FROM commerciale where deleted = 0');
$commercial->execute();
$dataCom=$commercial->fetchAll();

$clients= $bdd->prepare('SELECT CL.CODE_CLI, CL.TITRE, CL.NOM_CLI, CL.PRENOM_CLI, CL.EMAIL, CL.ADRESSE, CL.TEL1, CL.TEL2, CL.STATUT,CL.TOTAL_DU,CL.CREDIT_MAX,CL.TYPE_PIECE,CL.NUM_PIECE,CL.DATE_PIECE, CL.CREDIT_MAX, CL.DELAI_PAIEMENT, CL.REMISE, CL.DROIT_CREDIT, CL.DEPASSEMENT, CM.CODE_COM, CM.NOM_COM, CM.PRENOM_COM FROM client CL JOIN commerciale CM ON CL.CODE_COM=CM.CODE_COM WHERE CL.CODE_CLI=?');
$clients->execute(array($id));
$data=$clients->fetchAll();
$four=array();


?>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header col-lg-6 col-lg-offset-3">ENREGISTREMENT CLIENT</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            
            <div class="panel-body">
                <div class="row">

                    <form role="form" method="post" action="pages/administration/Client/script_update_client.php">
                        <input type="hidden" name="memids" value="<?php echo $id; ?>" />
                    <?php foreach ($data as $d) { ?>    

                        <formgroup class="col-lg-6">
                            <div class=" form-group col-lg-12">
                                <h3 class="col-lg-10 col-lg-offset-1">INFORMATIONS GENERALES</h3>

                                <div class="form-group col-lg-4">
                                    <label for="titre">* Titre</label>
                                    <select class="form-control" id="titre" name="titre">
                                        <option <?php $result = ($d->TITRE == "Mr") ? "selected" : "" ; echo $result;   ?> value="Mr">Monsieur</option>
                                        <option <?php $result = ($d->TITRE == "Mme") ? "selected" : "" ; echo $result;   ?> value="Mme">Madame</option>
                                        <option <?php $result = ($d->TITRE == "Dle") ? "selected" : "" ; echo $result;   ?> value="Dle">Demoiselle</option>
                                    </select> 
                                </div>   

                                <div class="form-group col-lg-8">
                                    <label for="nom">* Nom du client</label>
                                    <input class="form-control" type="text" id="nom" name="nom" REQUIRED value="<?php echo $d->NOM_CLI; ?>"/>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="prenom">* Prénom(s) du client</label>
                                    <input class="form-control" type="text" id="prenom" name="prenom" REQUIRED value="<?php echo $d->PRENOM_CLI; ?>"/>
                                </div>


                                <div class="form-group col-lg-6">
                                    <label for="piece">* Type piece </label>
                                    <select  class="form-control"  id="piece" name="piece">
                                        <option <?php $result = ($d->TYPE_PIECE == "CNI") ? "selected" : "" ; echo $result;   ?>  value="CNI" >CNI</option>
                                        <option <?php $result = ($d->TYPE_PIECE == "PP") ? "selected" : "" ; echo $result;   ?>  value="PP">PASSEPORT</option>
                                        <option <?php $result = ($d->TYPE_PIECE == "CE") ? "selected" : "" ; echo $result;   ?>  value="CE">CARTE ELECTEUR</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="datep">*Date piece </label> <i class="fa fa-calendar"></i>
                                    <input type="text" class="form-control datepicker" data-provide="datepicker" placeholder="YYYY/MM/DD" id="datep" name="datep" REQUIRED value="<?php echo $d->DATE_PIECE; ?>" />
                                </div>

                                <div class="form-group col-lg-6 col-lg-offset-3">
                                    <label class="col-lg-8 col-lg-offset-2" for="numpiece">*Numero Piece</label>
                                    <input type="text" class="form-control" id="numpiece" name="numpiece" REQUIRED value="<?php echo $d->NUM_PIECE; ?>" />
                                </div>

                            </div>
                        </formgroup> 

                        <formgroup class="col-lg-6">
                            <div class=" form-group col-lg-12">
                                <h3 class="col-lg-10 col-lg-offset-1">INFORMATIONS DE COMPTE</h3>
                                    
                                <div class="form-group col-lg-6">
                                    <label for="commercial">* Commercial</label>
                                    <select class="form-control" id="commercial" name="commercial">
                                    <?php foreach ($dataCom as $dc) { ?>
                                        <option  <?php $result = ($d->CODE_COM == $dc->code_com) ? "selected" : "" ; echo $result;   ?> value="<?php echo $dc->code_com; ?>"><?php echo $dc->nom_com." ".$dc->prenom_com; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-xm-2">
                                    <label for="remise">Remise (%)</label>
                                    <input type="number" class="form-control" id="remise" name="remise" value="<?php echo $d->REMISE; ?>">
                                </div>

                                <hr class="form-group col-lg-8 col-lg-offset-2">                                       
                        
                                <div class="form-group col-lg-10 col-lg-offset-1">
                                    <label class="col-lg-6 col-lg-offset-1">Droit au credit</label>
                                    <input class="col-lg-1 col-lg-offset-3" type="checkbox"  onclick="desactiveCDD();" id="droit" name="droit" value="1" <?php $result = ($d->DROIT_CREDIT == 1) ? "checked" : "" ; echo $result;   ?> >
                                </div>
                                

                                <div class="form-group col-lg-6 col-xm-2">
                                    <label for="credit">Credit maximum (FCFA)</label>
                                    <input type="number" disabled class="form-control" id="credit" name="credit" value="<?php echo $d->CREDIT_MAX; ?>">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="depassement">Depassement (%)</label>
                                    <select class="form-control" disabled id="depassement" name="depassement">
                                        <option <?php $result = ($d->DEPASSEMENT == "1") ? "selected" : "" ; echo $result;   ?>  value="1">1</option>
                                        <option <?php $result = ($d->DEPASSEMENT == "5") ? "selected" : "" ; echo $result;   ?>  value="5">5</option>
                                        <option <?php $result = ($d->DEPASSEMENT == "10") ? "selected" : "" ; echo $result;   ?>  value="10">10</option>
                                        <option <?php $result = ($d->DEPASSEMENT == "15") ? "selected" : "" ; echo $result;   ?>  value="15">15</option>
                                        <option <?php $result = ($d->DEPASSEMENT == "30") ? "selected" : "" ; echo $result;   ?>  value="30">30</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-lg-offset-3">
                                    <label class="col-lg-8 col-lg-offset-2" for="delai">Delai(en jours)</label>
                                    <select class="form-control" id="delai" disabled name="delai">
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "15") ? "selected" : "" ; echo $result;   ?>  value="15">15</option>
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "30") ? "selected" : "" ; echo $result;   ?>  value="30">30</option>
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "45") ? "selected" : "" ; echo $result;   ?>  value="45">45</option>
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "60") ? "selected" : "" ; echo $result;   ?>  value="60">60</option>
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "90") ? "selected" : "" ; echo $result;   ?>  value="90">90</option>
                                        <option <?php $result = ($d->DELAI_PAIEMENT == "180") ? "selected" : "" ; echo $result;   ?>  value="180">180</option>
                                    </select> 
                                </div> 

                            </div>
                        </formgroup> 

                        <hr class="form-group col-lg-8 col-lg-offset-2">

                        <formgroup class="col-lg-8 col-lg-push-2">
                            <div class=" form-group col-lg-12">
                                <h3 class="col-lg-10 col-lg-push-3">CONTACTS DU CLIENT</h3>

                                <div class="form-group col-lg-3">
                                    <label for="tel1">* Téléphone 1</label>
                                    <input type="number" class="form-control" id="tel1" name="tel1" REQUIRED value="<?php echo $d->TEL1; ?>"/>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="tel2">Téléphone 2</label>
                                    <input type="number" class="form-control" id="tel2" name="tel2" value="<?php echo $d->TEL2; ?>">
                                </div>

                                <div class="form-group col-lg-6 col-xm-2">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $d->EMAIL; ?>">
                                </div>

                                <div class="form-group col-lg-12 col-xm-2">
                                    <label for="adresse">* Adresse</label>
                                    <input class="form-control" id="adresse" name="adresse" REQUIRED value="<?php echo $d->ADRESSE; ?>"/>
                                </div>

                            </div>
                        </formgroup>                                        

                        <hr class="form-group col-lg-10 col-lg-offset-1">

                        
                        <div class="col-lg-8 col-lg-push-2">
                            <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
                            <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2" name="update_cli" value="ENREGISTRER" />
                        </div>
                    <?php } ?>     
                    </form>
                </div>

                </div>
        </div>
    </div>

</div>



<!-- Custom Theme JavaScript -->

<script type="text/javascript" src="../../../assets/js/bootstrap-datepicker.min.js"></script>
<script>
function desactiveCDD(){
    if (document.getElementById('droit').checked == true){
       document.getElementById('credit').disabled = false;
       document.getElementById('depassement').disabled = false;
       document.getElementById('delai').disabled = false;
    }else{
        document.getElementById('credit').disabled = true;
        document.getElementById('depassement').disabled = true;
        document.getElementById('delai').disabled = true;
    }
};

$(document).ready(function(){
    if (document.getElementById('droit').checked == true){
       document.getElementById('credit').disabled = false;
       document.getElementById('depassement').disabled = false;
       document.getElementById('delai').disabled = false;
    }else{
        document.getElementById('credit').disabled = true;
        document.getElementById('depassement').disabled = true;
        document.getElementById('delai').disabled = true;
    }
});


$(document).ready(function(){
    var date_input=$('input[name="datep"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        language: 'fr',
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
})
</script>            
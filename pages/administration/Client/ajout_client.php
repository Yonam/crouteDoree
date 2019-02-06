<?php
global $bdd;
$categorie= $bdd->prepare('SELECT code_categorie,libelle_categorie FROM categorie');
$categorie->execute();
$data=$categorie->fetchAll();
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

                                <form role="form" method="post" action="pages/administration/Client/script_ajout_client.php">
                                        <div class=" form-group col-lg-12">
                                            <h3 class="col-lg-10 col-lg-offset-1">INFORMATIONS</h3>

                                            <div class="form-group col-lg-5 col-lg-offset-1">
                                                <label for="titre">*Categorie</label>
                                                <select class="form-control" id="categorie" name="categorie">
                                                    <?php foreach ($data as $d) { ?>
                                                        <option value="<?php echo $d->code_categorie; ?>"><?php echo $d->libelle_categorie; ?></option>
                                                  <?php  } ?>
                                                </select> 
                                            </div>   

                                            <div class="form-group col-lg-5">
                                                <label for="tel">*Numero de telephone</label>
                                                <input type="text" class="form-control" id="tel" name="tel"/>
                                            </div>

                                            <div class="form-group col-lg-10 col-lg-offset-1">
                                                <label for="nom">* Nom du client</label>
                                                <input class="form-control" type="text" id="nom" name="nom" REQUIRED/>
                                            </div>
                                        </div>

                                    <hr class="form-group col-lg-8 col-lg-offset-2">

                                    
                                    <div class="col-lg-8 col-lg-push-2">
                                        <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
                                        <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="addcli" value="ENREGISTRER" />
                                    </div>
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

</body>

</html>
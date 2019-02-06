<?php
include("/pages/include/connexionDB.php");
$labo=$bdd->query('SELECT code_lab,nom_laboratoire FROM laboratoire');
$classe=$bdd->query('SELECT code_classe,description FROM classe_produit');
$exploitant = $bdd->query('SELECT code_exploitant,libelle FROM exploitant');
$specialite=$bdd->query('SELECT code_specialite,nom_specialite FROM specialite');
$localisation=$bdd->query('SELECT code_localisation,nom_localisation FROM localisation');
$forme = $bdd->query('SELECT code_forme,nom_forme FROM forme');
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
                    <h1 class="page-header">ENREGISTREMENT PRODUIT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

                    <!-- /.section des identifiants -->
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="row">

                                <form role="form" method="post" action="pages/administration/Produit/script_ajout.php">

                                    <div class="col-lg-8">
                                    <h1>les identifiants</h1>
                                    <h3>Les codes</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label for="cip">CIP</label>
                                                <input class="form-control" id="cip" name="cip">
                                            </div>
                                            <div class="form-group col-lg-4 col-xm-2">
                                                <label for="barre">Barre</label>
                                                <input class="form-control" id="barre" name="barre">
                                            </div>
                                            <div class="form-group col-lg-4 col-xm-2">
                                                <label for="interne">Interne</label>
                                                <input class="form-control" id="interne" name="interne">
                                            </div>
                                            
                                        </div>
                                        
                                    </div>   
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
                                    
                                    <div class="col-lg-8">
                                        
                                        <h3>Informations</h3>
                                        <div class="form-group">
                                            <label for="dci">Denomination Commune Internatioanl</label>
                                            <input class="form-control" id="dci" name="dci">
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input class="form-control" id="designation" name="designation">
                                        </div>
                                        <div class="form-group">
                                            <label for="commercialisation">Date commercialisation</label>
                                            <input type="text" class="form-control mydatepicker"  data-provide="datepicker" placeholder="DD/MM/YYY" id="commercialisation" name="commercialisation"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="peremption">Date peremption</label>
                                            <input type="text" class="form-control datepicker" data-provide="datepicker" placeholder="DD/MM/YYY" id="peremption" name="peremption"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="enregistrement">Date enregistrement</label>
                                            <input class="form-control datepicker" data-provide="datepicker" id="enregistrement" name="enregistrement" placeholder="DD/MM/YYY" type="text"/>
                                        </div>
                                    </div> 

                                    <div class="col-lg-8">
                                        <form role="form" method="post" action="toto">
                                        <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Prix</h1>
                                        <hr style="border: 0.1em solid black" />
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" id="tva" name="tva">Soumis a la TVA
                                                </label>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="tva">Taux TVA</label>
                                                <input class="form-control" type="number" min="0" max="100" id="tva" name="tva">

                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="achat">Prix d'achat</label>
                                                <input class="form-control" type="number" id="achat" name="achat">
                                                
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label for="coef">Coeficient</label>
                                                <input class="form-control" type="number" id="coef" name="coef">

                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label for="reduction">Reduction</label>
                                                <input class="form-control" type="number" id="reduction" name="reduction">

                                            </div>
                                            
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label for="vente">Prix de vente</label>
                                                <input class="form-control" id="vente" name="vente" value = "<?php echo $vente;?>"  readonly/>
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label for="pv">Lancer le calcul du Prix de vente</label>
                                                <button type="submit" class="btn btn-primary col-lg-5" name="pv">Calculer</button>
                                                
                                            </div>
                                        </div>

                                            </form>
                                    </div> 
                                    <div class="col-lg-8">
                                        <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Autres informations</h1>
                                        <hr style="border: 0.1em solid black" />
                                            
                                            <div class="form-group col-lg-4">
                                                <label for="laboratoire">Laboratoire</label>
                                                <select class="form-control" id="laboratoire" name="laboratoire">
                                                    <?php while ($donnees = $labo->fetch()){
                                                        echo '<option value="'.$donnees['code_lab'].'">';

                                                        echo $donnees['nom_laboratoire'];

                                                        echo '</option>';
                                                    } ?>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="localisation">Localisation</label>
                                                <select class="form-control" id="localisation" name="localisation">
                                                    <?php while ($donnees = $localisation->fetch()){
                                                        echo '<option value="'.$donnees['code_localisation'].'">';

                                                                echo $donnees['nom_localisation'];

                                                        echo '</option>';
                                                     } ?>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="exploitant">Exploitant</label>
                                                <select class="form-control" id="exploitant" name="exploitant">
                                                    <?php while ($donnees = $exploitant->fetch()){
                                                        echo '<option value="'.$donnees['code_exploitant'].'">';

                                                        echo $donnees['libelle'];

                                                        echo '</option>';
                                                    } ?>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="classe">Classe</label>
                                                <select class="form-control" id="classe" name="classe">
                                                    <?php while ($donnees = $classe->fetch()){
                                                        echo '<option value="'.$donnees['code_clas'].'">';

                                                        echo $donnees['description'];

                                                        echo '</option>';
                                                    } ?>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="specialite">Specialite</label>
                                                <select class="form-control" id="specialite" name="specialite">
                                                    <?php while ($donnees = $specialite->fetch()){
                                                        echo '<option value="'.$donnees['code_specialite'].'">';

                                                        echo $donnees['nom_specialite'];

                                                        echo '</option>';
                                                    } ?>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="forme">Forme</label>
                                                <select class="form-control" id="forme" name="forme">
                                                    <?php while ($donnees = $forme->fetch()){
                                                        echo '<option value="'.$donnees['code_forme'].'">';

                                                        echo $donnees['nom_forme'];

                                                        echo '</option>';
                                                    } ?>
                                                </select> 
                                            </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-success col-lg-5" name="addprod">Enregistrer le produit</button>
                                        <button type="reset" class="btn btn-danger col-lg-5 col-lg-push-2">Annuler l'enregistrement</button>
                                    </div>

                                </form>
                            </div>
                                <!-- /.row -->


                        </div>
                        <!-- /.panel -->
        </div>
            <!-- /.row -->

    <script>
    $(document).ready(function(){
        var date_input=$('input[name="peremption"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="enregistrement"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="commercialisation"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>
    <script>
        function noPreview() {
            $('#image-preview-div').css("display", "none");
            $('#preview-img').attr('src', 'noimage');
            $('upload-button').attr('disabled', '');
        }

        function selectImage(e) {
            $('#file').css("color", "green");
            $('#image-preview-div').css("display", "block");
            $('#preview-img').attr('src', e.target.result);
            $('#preview-img').css('max-width', '550px');
        }

        $(document).ready(function (e) {

            var maxsize = 500 * 1024; // 500 KB

            $('#max-size').html((maxsize/1024).toFixed(2));

            $('#upload-image-form').on('submit', function(e) {

                e.preventDefault();

                $('#message').empty();
                $('#loading').show();

                $.ajax({
                    url: "upload_image.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data)
                    {
                        $('#loading').hide();
                        $('#message').html(data);
                    }
                });

            });

            $('#file').change(function() {

                $('#message').empty();

                var file = this.files[0];
                var match = ["image/jpeg", "image/png", "image/jpg"];

                if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
                {
                    noPreview();

                    $('#message').html('<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

                    return false;
                }

                if ( file.size > maxsize )
                {
                    noPreview();

                    $('#message').html('<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

                    return false;
                }

                $('#upload-button').removeAttr("disabled");

                var reader = new FileReader();
                reader.onload = selectImage;
                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>

 <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement d'un produit</h1>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#identifiants">Les identifiants</a></li>
                    <li><a data-toggle="tab" href="#informations">Les informations</a></li>
                    <li><a data-toggle="tab" href="#prix">Le prix</a></li>
                    <li><a data-toggle="tab" href="#autre">Autre</a></li>
                </ul>


                var tab2 = document.getElementById('tab2');
        var tab1 = document.getElementById('tab1');
        var clas1 = tab1.getAttribute('class')
        var clas2 = tab2.getAttribute('class'); // On récupère l'attribut « class »
        tab1.setAttribute('clas1', 'tab-pane');
        tab2.setAttribute('clas2', 'tab-pane active'); 
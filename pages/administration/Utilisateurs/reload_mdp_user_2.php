<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OWO PHARMA</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="assets/dist/css/popup.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="assets/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->


</head>

    <body>


    <!-- /#wrapper -->
    <div id="page-wrapper">






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

                        <form role="form" method="post" action="pages/caisse/Utilisateur/script_reload_mdp.php">
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

	</div>

	<script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/vendor/raphael/raphael.min.js"></script>
    <script src="assets/vendor/morrisjs/morris.min.js"></script>
    <script src="assets/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>
    <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>


    <!-- Bootstrap Core Js -->
    <script src="assets/dist/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="assets/dist/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="assets/dist/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="assets/dist/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="assets/dist/plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="assets/dist/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="assets/dist/plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="assets/dist/plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="assets/dist/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="assets/dist/plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="assets/dist/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="assets/dist/jss/admin.js"></script>
    <script src="assets/dist/jss/pages/forms/advanced-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="assets/dist/jss/demo.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    <script>
    
    $('#tab1 a').click(function (e) {
        e.preventDefault();
        $('a[href="' + $(this).attr('href') + '"]').tab('show');  
    });
    $('#tab2 a').click(function (e) {
        e.preventDefault();
        $('a[href="' + $(this).attr('href') + '"]').tab('show');  
    });
    $('#tab3 a').click(function (e) {
        e.preventDefault();
        $('a[href="' + $(this).attr('href') + '"]').tab('show');  
    });

</script>

<script>
    $(document).ready(function() {
        $('#dataTables-example2').DataTable({

            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
            "language":{
                "emptyTable": "Aucune donnée valide dans la table",
                "lengthMenu": "Afficher _MENU_ éléments",
                "first": "Premier",
                "last": "Dernier",
                "paginate":{
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "info": "Affichage de _START_ à _END_ des _TOTAL_ éléments",
                "infoEmpty": "Aucune donnée à afficher",
                
                "loadingRecords":"- Chargement- Veuillez patienter... ",
                "processing": "-Calcul- Veuillez patienter...",
                "search": "Rechercher  "

            },

            responsive: true
        });
    });

</script>

</body>

</html>




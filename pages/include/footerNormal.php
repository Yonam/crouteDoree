  <script src="assets/vendor/jquery/jquery.js"></script>
  

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
    <script src="assets/vendor/datatables/js/jquery.dataTables.js"></script>
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
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/filter.js"></script>
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


    <!-- bootstrap-daterangepicker  -->
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

    <script type="text/javascript">
        function updatePrice()
            {
                var qte = $("#quantite").val();
                var price = $("#prix_unit").val();
                var total = price * qte;
                console.log(total);
                $("#total").val(total);
            }
    </script>

    <script>
        $(function(){
            window.prettyPrint && prettyPrint();
            $('#livraison').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: 'linked'
            });
        });
    </script>

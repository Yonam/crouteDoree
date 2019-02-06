<?php
	global $bdd;
	$filtre = date("Y-m-d");

$bdd->beginTransaction();
    $liste= $bdd->prepare('SELECT CM.CODE_CMDE, CM.DATE_CMDE, CP.CODE_PAIN, P.LIBELLE FROM commande CM JOIN commande_pain CP ON CM.CODE_CMDE = CP.CODE_CMDE JOIN pains P ON CP.CODE_PAIN = P.CODE_PAIN  WHERE CM.DATE_CMDE = :filtre GROUP BY P.LIBELLE');
    $liste->execute(array('filtre'=>$filtre));

    
$bdd->commit(); 

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">RECAP DE L'UTILISATION DES SACS DE FARINE</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary fa fa-print" href="#"> IMPRIMER</a>
                <!-- <a class="btn btn-outline btn-success fa fa-file" href="#"> EXPORTER</a> -->
                
                <B>  <h3>  Liste des pains pour la commande  </h3></B>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>Pain</th>
                            <th>Quantite</th>
                            <th>Nombre de sacs</th>
                        </tr>
                    <tbody>
                   <?php foreach ($liste as $d){
                   		$quantite = $bdd->prepare('SELECT SUM(QUANTITE) SOMME FROM commande_pain WHERE CODE_PAIN = :code');
    					$quantite ->execute(array('code'=>$d->CODE_PAIN));

    					foreach ($quantite as $q) {

                   	?>


                        <tr class="odd gradeX">
                            <td><?php echo $d->LIBELLE; ?></td>
                            <td><?php echo $q->SOMME; ?></td>
                            <td class="center"><?php echo $d->LIBELLE; ?></td>

                           
                        </tr>
                    <?php
                    } } ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

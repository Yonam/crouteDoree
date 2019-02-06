<?php 
	include "../../include/connexionDB.php";
	include "../../include/classes/encaissement.class.php";
	$encaissement = new encaissement();
 ?>

<!DOCTYPE html>
<meta charset="utf-8">
<html lang="fr">
<head>
	<style type="text/css">
	table{
		border: 2px solid black;
		padding: 0.5em;
		border-collapse: collapse;
	}
	thead{
		background-color: #e18c3a;
		padding: 1em;
		border-bottom: 2px solid black;
		text-transform: uppercase;
	}

	td, th {
	  border: 1px solid #999;
	  padding: 0.5rem;
	  text-align: center;
	  font-size: 12px;

	}

	.recapitulatif{
		margin-top: 1em;
		border-top: 0.2em solid black;
		text-transform: lowercase;
		text-decoration: underline;
	}

	span{
		text-transform: lowercase;
		font-size: 12px;
	}

</style>
</head>

<body onload="window.print()">
	<div class="row" >
		    <div class="col-lg-12">
		        <div class="panel panel-default">
		            <div class="panel-heading">
		            	<?php
		            	setlocale(LC_TIME, "fr_FR", "French");
		            		$dated =  $_POST['date_livraison'];

$newDate = strftime("%d %B %Y", strtotime($dated));
		            	?>
	            		<h2 class="tab-header" style="text-align: center;"> Liste des livraisons pour le <?= $newDate ?></h2>
	            		<hr/>
	            		
		            </div>
		            <!-- /.panel-heading -->
		            <div class="panel-body">

		                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
		                    <thead>
		                        <tr>
		                            <th>Numero ticket</th>
		                            <th>Client</th>
		                            <th>Heure livraison</th>
		                            <th>Produits</th>
		                            <th>Quantite</th>

		                        </tr>
		                    </thead>
		                    <tbody>
		                   <?php 

		          			// ===== Requette de recuperation des elements de la commande suivant le jour ========= 

		                   

							$bdd->beginTransaction();
							    $req = $bdd->prepare('SELECT CODE_CMDE, DATE_CMDE, C.NOM_CLIENT, DATE_CMDE, HEURE_LIVRAISON, NUMERO_TICKET FROM commande CMD JOIN client C ON CMD.CODE_CLIENT = C.CODE_CLIENT WHERE DATE_LIVRAISON = :dated AND CMD.SUPPRIME = 0 ORDER BY HEURE_LIVRAISON ASC');
								$req->execute(array('dated' =>$_POST['date_livraison'] ));

								$prod = $bdd->prepare('SELECT DISTINCT(CODE_PAIN) code FROM commande_pain CP JOIN commande CM ON CP.CODE_CMDE = CM.CODE_CMDE WHERE CM.DATE_LIVRAISON = :dated AND CM.SUPPRIME = 0');
								$prod->execute(array('dated' =>$_POST['date_livraison'] ));
							$bdd->commit();

		                   foreach ($req as $p) { 
		                   	$liste = $encaissement->liste($p->CODE_CMDE);

		                   	?>

		                        <tr class="odd gradeX">
		                            <td style="text-align:center"><?php echo $p->NUMERO_TICKET; ?></td>
		                            <td style="text-align:center"><?php echo $p->NOM_CLIENT; ?></td>
		                            <td style="text-align:center"><?php echo $p->HEURE_LIVRAISON; ?></td>
		                            <td style="text-align:center"><?php 

		                            // =====  Affichage des produits de la commande  =====
		                            if(isset($liste)){
		                            	  $total = 0;
		                                 foreach ($liste as $l) {
		                                 	echo $l->LIBELLE;
		                                 }
		                            }
		                             ?></td>
		                             <td style="text-align:center"> <?= $l->QTE ?></td>
		                        </tr>
		                    <?php   } ?>
		                    </tbody>
		                    </tbody>
		                </table>
		                <div class="recapitulatif">
		                	<h4>Recapitulatif des produits </h4>
		                </div>
		                <?php 
		                	foreach ($prod as $p) {
		                		$qtes = $bdd->prepare('SELECT SUM(CP.QUANTITE) QTE, P.LIBELLE FROM commande_pain CP JOIN pains P ON CP.CODE_PAIN = P.CODE_PAIN JOIN commande CM ON CP.CODE_CMDE = CM.CODE_CMDE WHERE CP.CODE_PAIN = :code AND CM.DATE_LIVRAISON = :dated AND CM.SUPPRIME = 0');
		                		$qtes->execute(array('code' =>$p->code,
		                							'dated' =>$_POST['date_livraison']));

		                		foreach ($qtes as $q) { ?>
		                			<div>

		                				<span><?= $q->LIBELLE .' : '. $q->QTE ?></span>
		                			</div>

		                	<?php	}
		                	}
		                ?>
		            </div>
		            <!-- /.panel-body -->
		        </div>

		        
		        <!-- /.panel -->
		    </div>
	     <!-- /.col-lg-12 -->
		</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>

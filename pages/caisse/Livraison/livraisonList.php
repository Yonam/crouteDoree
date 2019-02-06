<?php 
	global $bdd;

	$dated = date('Y-m-d');

	$req = $bdd->prepare('SELECT DISTINCT(DATE_LIVRAISON) FROM commande WHERE DATE_LIVRAISON >= :dated ');
	$req->execute(array('dated'=>$dated));
	$listDates = $req->fetchAll();


?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" align="center">Liste globale des Livraisons </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->



<?php 
if (count($listDates) > 0) {

	foreach ($listDates as $d) { ?>
		<div class="row">
		    <div class="col-lg-12">
		        <div class="panel panel-default">
		            <div class="panel-heading">

		            	
	            		<h2 class="tab-header"> Liste des livraisons pour le <?= $d->DATE_LIVRAISON ?></h2>
	            		<form method="post" action="pages/caisse/livraison/livraisonPdf.php">
	            			<input type="text" name="date_livraison" id="date_livraison" value="<?= $d->DATE_LIVRAISON ?>" hidden="hidden">
		            		<input type="submit" name="generate_pdf" class="btn btn-success" value="imprimer cette liste">
	            		</form>
		            </div>
		            <!-- /.panel-heading -->
		            <div class="panel-body">

		                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
		                    <thead>
		                        <tr>
		                            <th style="text-align:center">Numero ticket</th>
		                            <th style="text-align:center">Client</th>
		                            <th style="text-align:center">Heure livraison</th>
		                            <th style="text-align:center">Produits</th>
		                            <th style="text-align:center">Total</th>

		                        </tr>
		                    </thead>
		                    <tbody>
		                   <?php 

		          			// ===== Requette de recuperation des elements de la commande suivant le jour ========= 

		                   $req = $bdd->prepare('SELECT CODE_CMDE, DATE_CMDE, C.NOM_CLIENT, DATE_CMDE, HEURE_LIVRAISON, NUMERO_TICKET FROM commande CMD JOIN client C ON CMD.CODE_CLIENT = C.CODE_CLIENT WHERE DATE_LIVRAISON = :dated AND CMD.SUPPRIME = 0 ORDER BY HEURE_LIVRAISON ASC');
							$req->execute(array('dated' => $d->DATE_LIVRAISON));
							$listProd = $req->fetchAll();

		                   foreach ($listProd as $p) { 
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
		                                 	echo $l->LIBELLE.'('.$l->QTE.')  ';

		                                 	$total+= $l->TOTAL;
		                                 }
		                            }
		                             ?></td>
		                             <td style="text-align:center"> <?= $total ?></td>
		                            

		                            
		                        </tr>
		                    <?php   } ?>
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

<?php 
	}
}else { ?>
	<h1 style="margin-top: 4em; text-align: center "> Désole :( <br/><br/> Il n'y a plus aucune livraison de prévue a partir d'aujourd'hui</h1>
 <?php } ?>


 <?php 
 	function fetch_data($dated){
 		include "pages/include/connexionDB.php";
 		
 		$sortie = '';
 		$date = $_POST['date_livraison'];
 		$req = $bdd->prepare('SELECT CODE_CMDE, DATE_CMDE, C.NOM_CLIENT, DATE_CMDE, NUMERO_TICKET FROM commande CMD JOIN client C ON CMD.CODE_CLIENT = C.CODE_CLIENT WHERE DATE_LIVRAISON = :dated AND SUPPRIME = 0');
		$req->execute(array('dated' => $dated));
		$listProd = $req->fetchAll();

		function panier($code){
       		$encaissement = new encaissement();
       		$liste = $encaissement->liste($code);
       		$produits[] = array();
       		$total = 0;
             foreach ($liste as $l) {
             	$produits["prod_price"] = $l->LIBELLE.'('.$l->QTE.')  ';
             	$total+= $l->TOTAL;
             }

             $produits["total"] = $total;
          return $produits;
       	}

		foreach ($listProd as $p) { 
           	

         $pains = panier($p->CODE_CMDE);
        $sortie .='
            <tr class="odd gradeX">
                <td style="text-align:center">'. $p->NUMERO_TICKET .'</td>
                <td style="text-align:center">'. $p->NOM_CLIENT .'</td>
                <td style="text-align:center">'. $p->DATE_CMDE .'</td>
                <td style="text-align:center">'.$pains['prod_price'].'</td>  
                <td style="text-align:center">'.$pains['total'].'</td>       
            </tr>';
        } 
    return $sortie;
 	}

 	/*if (isset($_POST['generate_pdf'])) {

 		require_once('pages/TCPDF/tcpdf.php');
 		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 		$obj_pdf->SetCreator(PDF_CREATOR);
 		$obj_pdf->SetTitle("Liste des livraisons");
 		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
 		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
 		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
 		$obj_pdf->SetDefaultMonospacedFont('helvetica');
 		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
 		$obj_pdf->setPrintHeader(false);
 		$obj_pdf->setPrintFooter(false);
 		$obj_pdf->SetAutoPageBreak(TRUE, 10);
 		$obj_pdf->SetFont('helvetica', '', 11);
 		$obj_pdf->AddPage();
 		$content = '';
 		$content .= '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
            <thead>
                <tr>
                    <th style="text-align:center">Numero ticket</th>
                    <th style="text-align:center">Client</th>
                    <th style="text-align:center">Date commande</th>
                    <th style="text-align:center">Produits</th>
                    <th style="text-align:center">Total</th>
                </tr>
            </thead>
            <tbody>';
 	$content .= fetch_data($_POST['date_livraison']);
 	$content .= '</tbody></table>';
 	$obj_pdf->writeHTML($content);
 	$obj_pdf->output('doc.pdf', 'I');
 	ob_end_clean();*/



// Include the main TCPDF library (search for installation path).

 ?>

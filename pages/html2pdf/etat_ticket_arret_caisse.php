<?php
//$int = 5;
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pharma', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

if (isset($_GET['id']) && !is_null($_GET['id'])) {
	
$journee= $bdd->prepare("SELECT journee.DATE FROM journee WHERE journee.CODE_JOURNEE = ".$_GET['id']);
$vente= $bdd->prepare("SELECT SUM(PV.MONTANT_VENTE) AS MONTANT_VENTE 
	FROM vente V
	JOIN produit_vendu PV ON V.CODE_VENTE= PV.CODE_VENTE
	WHERE V.CODE_JOURNEE =".$_GET['id']."");
$sortie= $bdd->prepare("SELECT SUM(SC.MONTANT_SORTIE_CAISSE) AS MONTANT_SORTIE FROM sortie_caisse SC WHERE SC.CODE_JOURNEE =".$_GET['id']);
$vente_credit= $bdd->prepare("SELECT SUM(PV.MONTANT_VENTE) AS MONTANT_VENTE_CREDIT 
	FROM vente V
	JOIN produit_vendu PV ON V.CODE_VENTE= PV.CODE_VENTE
	WHERE V.CODE_JOURNEE =".$_GET['id']."
	AND V.CODE_CLI <> null");
}else{
	$journee= $bdd->prepare("SELECT journee.DATE FROM journee WHERE statut = 0");
	$vente= $bdd->prepare("SELECT SUM(PV.MONTANT_VENTE) AS MONTANT_VENTE 
		FROM vente V
		JOIN produit_vendu PV ON V.CODE_VENTE= PV.CODE_VENTE
		WHERE V.CODE_JOURNEE =(SELECT CODE_JOURNEE FROM journee WHERE statut = 0)");
	$sortie= $bdd->prepare("SELECT SUM(SC.MONTANT_SORTIE_CAISSE) AS MONTANT_SORTIE FROM sortie_caisse SC WHERE SC.CODE_JOURNEE =(SELECT CODE_JOURNEE FROM journee WHERE statut = 0)");
	$vente_credit= $bdd->prepare("SELECT SUM(PV.MONTANT_VENTE) AS MONTANT_VENTE_CREDIT 
		FROM vente V
		JOIN produit_vendu PV ON V.CODE_VENTE= PV.CODE_VENTE
		WHERE V.CODE_JOURNEE =(SELECT CODE_JOURNEE FROM journee WHERE statut = 0)
		AND V.CODE_CLI <> null");
}


$journee->execute();
$vente->execute();
$sortie->execute();
$vente_credit->execute();


var_dump($journee->fetch());
var_dump($vente->fetch());
var_dump($sortie->fetch());
var_dump($vente_credit->fetch());

ob_start();

?>

<page backtop='6mm' footer="date;heure;page;">
	<page_header>
		<table style="text-align: center">
			<tr>

				<td style="width:100%; height:10em; border: dashed green; text-align:center; font-style: italic; font-size: 10px; padding-top: unset;">
					<em>PHARMACIE LA FRATERNITE</em><br>
					<small>Boulevard du Haho près de la clinique Saint Joseph</small><br>
					<small>08 BP 80326 Lomé TOGO_______Tel 22268155</small>
				</td>
 
			</tr>
		</table>

	</page_header>

	<page_footer>
		<hr>
	</page_footer>
	<br>
        <!-- <h6 align="center" >TICKET DE CAISSE</h6> -->


	<table id="table" margin-top >

	       <thead>
	       	<?php while ($journee = $journee->fetch()){  ?>
	       	<tr>
	       		<th colspan="2"  style="width:100%; height:7%; border:none; text-align:center; font-size: 9px; padding-top: unset;">
	       		
	       		<small>JOURNEE DE CAISSE DU <?php echo date($journee['DATE']); ?> </small>
				</th>
	       	</tr>
			<?php } ?>

			<tr>
				<th style="width:100%; height:0.5px; border:none; text-align:justify; font-size: 10px;">
   				
   				<?php while ($vente = $vente->fetch()){  
   					 echo 'VENTE TOTALE DE LA JOURNEE . . . . . . . . . . '.$vente['MONTANT_VENTE']; ?> <br> 
				<?php } ?>

   				<?php while ($sortie = $sortie->fetch()){  
   					 echo 'SORTIE(S) DE CAISSE DE LA JOURNEE . . . . . . . . . . '.$sortie['MONTANT_SORTIE']; ?> <br> 
				<?php } ?>

   				<?php while ($vente_credit = $vente_credit->fetch()){  
   					 echo 'VENTE(S) A CREDIT DE LA JOURNEE . . . . . . . . . . '.$vente_credit['MONTANT_VENTE_CREDIT']; ?><br>
   				<?php } ?>
   				
				</th>
			</tr>
	       	<tr></tr>
			
			<tr>
				<th>
		       		<th colspan="2"  style="width:100%; height:1px; padding-bottom: auto; margin: none; border: none; text-align:center; font-size: 12px;">
		       		<hr style="width:100%; height:1px; border: dashed grey; border-width: 1px;">
					<small>ARRET DE CAISSE DU <?php echo date('d-m-Y'); ?></small> <br><br>
					<hr style="width:100%; height:1px; border: dashed grey; border-width: 1px;">
				</th>
			</tr>

		  	</thead>
		  
		   	<tbody>		
                  
                <tr>
                </tr>
                                
		  	</tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');

try {
	$pdf = new HTML2PDF('p','A7','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Ticket d'arret de caisse.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
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


$reponse=$bdd->prepare("
SELECT
P.DCI,
F.NOM_FORME,
F.CODE_FORME,
P.DESIGNATION,
P.DATE_COMMERCIALISATION,
P.DATE_ENREGISTREMENT,
PF.DATE_PEREMPTION,
PF.CODE_PRODUIT,
PS.QTE_SORTIE
FROM
produit AS P
Inner Join forme AS F ON P.CODE_FORME = F.CODE_FORME
Inner Join produit_entree_fournisseur AS PF ON PF.CODE_PRODUIT = P.CODE_PRODUIT inner join
produit_sortie AS  PS ON PS.CODE_PRODUIT=P.CODE_PRODUIT");
$reponse->execute();

ob_start();

?>

<style type="text/css">
	table{width: 100%; border-collapse: collapse;margin-top:5mm;}
	#table tr{background-color:white;  color: black}
	#table tr th{border: 1px solid #aaa; width: 14%; text-align:center; padding: 15px}
	#table tr td{border: 1px solid #aaa; width: 14%; text-align:center; text-decoration:blink; padding: 15px}
	h2{font: normal 175% Arial, Helvetica, sans-serif;
  color: #008000;
  letter-spacing: -1px;
  margin: 0 0 10px 0;
  padding: 5px 0 0 0; }
</style>

<page backtop='35mm' footer="date;heure;page;">


	<page_header>
		<hr>
		<table align="center">
			<tr>
				<td style="width:20%">
					<img src="pages/html2pdf/logoPharma1.png" height="70" width="70" />
				</td>

				<td style="width:60%; text-align:center;">
					<h2>PHARMACIE LA FRATERNITE</h2>
					<small>Boulevard du Haho près de la clinique Saint Joseph</small><br>
					<small>08 BP 80326 Lomé TOGO_______Tel 22268155</small>

				</td>

				<td style="width:20%; text-align:right;">

					<img src="pages/html2pdf/logoPharma1.png" height="70" width="70" />
				</td>
			</tr>
		</table>

		<hr>
	</page_header>

	<page_footer>
	<hr>

	</page_footer>
                    <h3 align="center" >LISTE DES PRODUITS PÉRIMÉS</h3>

	<table id="table" margin-top style="font-size: 10px; width: all;" align="center">

	       <thead>
				<tr>
                    <th>DCI</th>
                    <th>Designation</th>
                    <th>Quantite</th>

				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $reponse->fetch()){  ?>
                    <tr class="odd gradeX">
                        <td><?php echo $donnees['DCI']; ?></td>
                        <td><?php echo $donnees['DESIGNATION']; ?></td>
                        <td><?php echo $donnees['QTE_SORTIE']; ?></td>
                    </tr>
                <?php } ?>
		  </tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');

try {
	$pdf = new HTML2PDF('P','A4','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des produits périmés.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
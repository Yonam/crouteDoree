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


if (isset($_GET['sql']) && $_GET['sql'] != ''){
	$reponse = $bdd->query($_GET['sql']);
}else{
	$reponse=$bdd->query("SELECT * FROM client where client.DELETE = 0 order by code_cli");
}

       		
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
                    <h3 align="center" >COMPTES DES CLIENTS</h3>

	<table id="table" margin-top style="font-size: 8px; width: all;" align="center">

	       <thead>
				<tr>
	                <th>Nom et prénom(s)</th>
                    <th>Credit Max</th>
                    <th>Delai</th>
                    <th>Remise</th>
                    <th>Credit</th>
                    <th>Dette</th>
                    <th>Depassement</th>
				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $reponse->fetch()){  ?>
                    <tr class="odd gradeX">
	                    <td><?php echo $donnees['TITRE']." ".$donnees['NOM_CLI']." ".$donnees['PRENOM_CLI']; ?></td>
	                    <td><?php echo $donnees['CREDIT_MAX']; ?></td>
	                    <td><?php echo $donnees['DELAI_PAIEMENT']; ?> jours</td>
	                    <td><?php echo $donnees['REMISE']; ?> FCFA</td>
	                    <td><?php if($donnees['DROIT_CREDIT']==0){echo "Autorisé";} else{echo "Non Autorisé";} ?></td>
	                    <td><?php echo $donnees['TOTAL_DU']; ?> FCFA</td>
	                    <td><?php if($donnees['DROIT_CREDIT']==0) {if($donnees['DEPASSEMENT'] ==null) {echo "0 FCFA";} else {echo $donnees['DEPASSEMENT']." FCFA";}} else {echo "Non Autorisé";}?></td>
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
	$pdf->Output("Comptes des clients.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
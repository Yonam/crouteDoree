<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pharma', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}



       		$reponse=$bdd->query("SELECT * FROM commerciale order by code_com");
ob_start();

?>

<style type="text/css">
	table{width: 100%; border-collapse: collapse;margin-top:5mm;}
	#table tr{background-color:white;  color: black}
	#table tr th{border: 1px solid #aaa; width: 17%; text-align:center; padding: 15px}
	#table tr td{border: 1px solid #aaa; width: 17%; text-align:left; text-decoration:blink; padding: 15px}
	h2{font: normal 175% Arial, Helvetica, sans-serif;
  color: #528CCC;
  letter-spacing: -1px;
  margin: 0 0 10px 0;
  padding: 5px 0 0 0; }

#table .chiffre{border: 1px solid #aaa; width: 10%; text-align:center; padding: 15px}
	#table .chiffre{border: 1px solid #aaa; width: 10%; text-align:left; text-decoration:blink; padding: 15px}
	h2{font: normal 175% Arial, Helvetica, sans-serif;
  color: #528CCC;
  letter-spacing: -1px;
  margin: 0 0 10px 0;
  padding: 5px 0 0 0; }

</style>

<page backtop='60mm' footer="date;heure;page;">

	<page_header>
	        <table>
	            <tr>
	            <td style="width:25%">
				<img src="gesma.jpg" height="50" width="50" />
			     </td>
		
				<td style="width:50%; text-align:center;">
						<h1>ROOK IT</h1>
						votre partenaire de technologie de proximite
				deriere le supermache carrefour agoe kleve super<br>
					Tel:(+228)22 25 16 08
					Tel:(+228)22 56 48 97
				
				</td>
				
				<td style="width:25%; text-align:right;">
						
			       <img src="gesma.jpg" height="50" width="50" />
				</td>
				</tr>
			</table>	      
					
		<hr>
	</page_header>

	<page_footer>
		<hr>
		Pied de page
	</page_footer>
                    <h2 align="center" >LISTE DES COMMERCIAUX</h2>

	<table id="table" margin-top>

	       <thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Date d'embauche</th>
					<th>Telephone</th>
					<th class="chiffre">Chiffre</th>
					<th>Pourcentage</th>					
				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $reponse->fetch()){  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $donnees['nom_com']; ?></td>
                                        <td><?php echo $donnees['prenom_com']; ?></td>
                                        <td><?php echo $donnees['date_emb']; ?></td>
                                        <td><?php echo $donnees['tel_com']; ?>
                                        <?php echo $donnees['tel_urg']; ?></td>
                                        <td class="chiffre"><?php echo $donnees['chiffre']; ?></td>
                                        <td><?php echo $donnees['pourcentage']; ?></td>
           
                                    </tr>
                                <?php } ?>
		  </tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();

require_once 'html2pdf-4.4.0/html2pdf.class.php';

try {

	$pdf = new HTML2PDF('landscape','A4','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des commerciaux.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
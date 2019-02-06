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



       		$reponse=$bdd->query("SELECT * FROM client order by code_cli");
ob_start();

?>

<style type="text/css">
	table{width: 100%; border-collapse: collapse;margin-top:5mm;}
	#table tr{background-color:white;  color: black}
	#table tr th{border: 1px solid #aaa; width: 14%; text-align:center; padding: 15px}
	#table tr td{border: 1px solid #aaa; width: 14%; text-align:center; text-decoration:blink; padding: 15px}
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
                    <h2 align="center" >LISTE DES CLIENTS</h2>

	<table id="table" margin-top>

	       <thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Telephone</th>
					<th>Dette</th>
					<th>Plafond</th>
					<th>Delais</th>					
				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $reponse->fetch()){  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $donnees['Nom_cli']; ?></td>
                                        <td><?php echo $donnees['prenom_cli']; ?></td>
                                        <td><?php echo $donnees['Email']; ?></td>
                                        <td><?php echo $donnees['tel1']; ?></td>
                                        <td><?php echo $donnees['total_du']; ?></td>
                                        <td><?php echo $donnees['credit_maximun']; ?></td>
                                        <td><?php echo $donnees['nbr_jr_avant_paie']; ?></td>
           
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
	$pdf->Output("Liste des clients.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
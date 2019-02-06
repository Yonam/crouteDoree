<?php
//$int = 5;
try
{
	$bd= new PDO ('mysql:host=localhost;dbname=gestmagasin','root','');
}
catch(Exception $e)
{
	die('erreur de connexion:'.$e->getmessage());
}


       		$reponse=$bd->query("select numcli,nomcli,prenomcli,adressecli from client order by numcli");
ob_start();

?>

<style type="text/css">
	table{width: 100%; border-collapse: collapse;margin-top:5mm;}
	#table tr{background-color:white;  color: black}
	#table tr th{border: 1px solid #aaa; width: 25%; text-align:center; padding: 15px}
	#table tr td{border: 1px solid #aaa; width: 25%; text-align:center; text-decoration:blink; padding: 15px}
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
					<th>Numero</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Adresse</th>
					
				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $reponse->fetch()){  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $donnees['numcli']; ?></td>
                                        <td><?php echo $donnees['nomcli']; ?></td>
                                        <td><?php echo $donnees['prenomcli']; ?></td>
                                        <td><?php echo $donnees['adressecli']; ?></td>
           
                                    </tr>
                                <?php } ?>
		  </tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();

require_once 'html2pdf/html2pdf.class.php';

try {

	$pdf = new HTML2PDF('P','A4','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des clients.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
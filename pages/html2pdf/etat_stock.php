<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pharma', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}


if (isset($_GET['sql']) && $_GET['sql'] != ''){
	$reponse=$bdd->prepare("SELECT * FROM produit order by designation");
	$reponse->execute();
}
//elseif(isset($_GET['dci']) && $_GET['dci'] != ''){
//	$reponse=$bdd->prepare("SELECT * FROM produit where dci =:dci order by code_produit");
//	$reponse->execute(array('dci' => $_GET['dci']));
//}
else{
	$reponse=$bdd->prepare("SELECT p.CIP,p.DESIGNATION,p.DCI,p.QTE_STOCK FROM produit p ORDER BY p.designation");
	$reponse->execute();
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
    <h3 align="center" >ETAT DU STOCK DE PRODUITS</h3>

	<table id="table" margin-top style="font-size: 8px; width: all;" align="center">

	       <thead>
				<tr>
					<th style="width: unset;">CIP</th>
					<th style="width: unset;">DCI</th>
					<th style="width: unset;">Désignation</th>
					<th style="width: unset;">Quantité en stock</th>
				</tr>
		  </thead>
		  
		   <tbody>	
              <?php while ($donnees = $reponse->fetch()){  ?>
                <tr class="odd gradeX">
                    <td style="width: unset;"><?php echo $donnees['CIP']; ?></td>
                    <td style="width: unset;"><?php echo $donnees['DCI']; ?></td>
                    <td style="width: unset;"><?php echo $donnees['DESIGNATION']; ?></td>
                    <td style="width: unset;"><?php echo $donnees['QTE_STOCK']; ?></td>
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
	$pdf->Output("Etat du stock.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
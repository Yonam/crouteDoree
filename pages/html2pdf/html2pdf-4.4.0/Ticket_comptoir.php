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

$id = $_POST['id'];

	$vente= $bdd->prepare("SELECT V.DATE_VENTE,V.CODE_VENTE,V.CODE_ENCAISSEMENT,U1.NOM_USER AS NOM_ENCAISSEUR,P.DESIGNATION,P.CODE_PRODUIT,P.PRIX_PRODUIT,PV.NB_VENDU,PV.MONTANT_VENTE FROM produit_vendu AS PV Inner Join produit AS P ON PV.CODE_PRODUIT=P.CODE_PRODUIT join vente AS V ON V.CODE_VENTE=PV.CODE_VENTE Inner Join encaissement AS E ON V.CODE_ENCAISSEMENT = E.CODE_ENCAISSEMENT Inner Join utilisateur AS U1 ON E.CODE_USER = U1.CODE_USER ORDER by P.PRIX_PRODUIT WHERE E.CODE_ENCAISSEMENT =:id");
     $vente->execute(array('id' => $id));


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

<page backtop='60mm' footer="date;heure;page;">


	<page_header>
		<table>
			<tr>

				<td style="width:40%; text-align:center;">
					<h1>Pharmacie LA FRATERNITE</h1>
					[Informations complémentaires]  <br>
					Tel:(+228)[00 00 00 00]

				</td>
 
			</tr>
		</table>

		<hr>
	</page_header>

	<page_footer>
		<hr>

	</page_footer>
                    <h2 align="center" >TICKETS DE CAISSE</h2>

	<table id="table" margin-top>

	       <thead>
				<tr>
					<th>DATE</th>
    				<th>VENDEUR </th>
    				<th>DESIGNATION </th>
     				<th>PRIX PRODUIT</th>
    				<th>QUANTITE </th>
					<th>CAISSE</th>
					<th>TOTAL</th>
				</tr>
		  </thead>
		  
		   <tbody>	
                  <?php while ($donnees = $vente->fetch()){  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $donnees['DATE_VENTE']; ?></td>
                                        <td><?php echo $donnees['DESIGNATION']; ?></td>
                                        <td><?php echo $donnees['PRIX_PRODUIT']; ?></td>
                                        <td><?php echo $donnees['NB_VENDU']; ?></td>
                                        <td><?php echo $donnees['MONTANT_VENTE']; ?></td>
                                        <td><?php echo $donnees['NOM_ENCAISSEUR']; ?></td>
                                    </tr>
                                <?php } ?>
		  </tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');

try {
	$pdf = new HTML2PDF('p','A8','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des produits.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
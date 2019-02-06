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

$id = $_GET['codeVente'];

	$vente1= $bdd->prepare("SELECT V.DATE_VENTE, V.CODE_VENTE,V.CODE_ENCAISSEMENT, U1.NOM_USER NOM_ENCAISSEUR,U.NOM_USER, M.MONTANT MONTANT FROM vente V  JOIN utilisateur U ON V.CODE_USER = U.CODE_USER JOIN encaissement E ON V.CODE_ENCAISSEMENT = E.CODE_ENCAISSEMENT JOIN utilisateur U1 ON E.CODE_USER = U1.CODE_user JOIN mode_payement M ON E.CODE_PAYEMENT = M.CODE_PAYEMENT WHERE E.CODE_ENCAISSEMENT =:id");
    $vente1->execute(array('id' => $id));

$vente= $bdd->prepare("SELECT
V.DATE_VENTE,
V.CODE_VENTE,
V.CODE_ENCAISSEMENT,
U1.NOM_USER AS NOM_ENCAISSEUR,
U.PRENOM_USER,
M.MONTANT AS MONTANT,
PV.NB_VENDU,
PV.CODE_VENTE,
P.DESIGNATION,
P.PRIX_VENTE,
P.PRIX_PRODUIT,
PV.CODE_PRODUIT
FROM 
produit as P inner join produit_vendu AS PV ON PV.CODE_PRODUIT=P.CODE_PRODUIT JOIN
vente AS V ON V.CODE_VENTE=PV.CODE_VENTE
Inner Join utilisateur AS U ON V.CODE_USER = U.CODE_USER
Inner Join encaissement AS E ON V.CODE_ENCAISSEMENT = E.CODE_ENCAISSEMENT
Inner Join utilisateur AS U1 ON E.CODE_USER = U1.CODE_USER
Inner Join mode_payement AS M  ON E.CODE_PAYEMENT = M.CODE_PAYEMENT  WHERE E.CODE_ENCAISSEMENT =:id");
$vente->execute(array('id' => $id));



ob_start();

?>

<!-- <style type="text/css">
	table{width: 100%; border-collapse: collapse;margin-top:5mm;}
	#table tr{background-color:white;  color: black}
	#table tr th{border: 1px solid #aaa; width: 14%; text-align:center; padding: 15px}
	#table tr td{border: 1px solid #aaa; width: 14%; text-align:center; text-decoration:blink; padding: 15px}
	h2{font: normal 175% Arial, Helvetica, sans-serif;
  color: #008000;
  letter-spacing: -1px;
  margin: 0 0 10px 0;
  padding: 5px 0 0 0; }
</style> -->

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
			<?php while ($donnees1 = $vente1->fetch()){  ?>
	       	<tr>
	       		<th colspan="2"  style="width:100%; height:7%; border:none; text-align:center; font-size: 9px; padding-top: unset;">
	       		<small>Vente à crédit </small> <br>
	       		<small>Vendu le <?php echo date($donnees1['DATE_VENTE']); ?></small> <br>
				<small>VENDEUR  <?php echo $donnees1['NOM_USER']; ?> _ _ _ _ _ CAISSIER <?php echo $donnees1['NOM_ENCAISSEUR']; ?></small>
				</th>
	       	</tr>
			<tr>

				<th style="width:100%; height:0.5px; border:none; text-align:justify; font-size: 8px;">
   				<?php while ($donnees = $vente->fetch()){  
   					echo $donnees['DESIGNATION'].'. . . . . . . . '.$donnees['PRIX_PRODUIT'].' X '.$donnees['NB_VENDU'].' = '.$donnees['PRIX_PRODUIT']*$donnees['NB_VENDU']; ?> <br>
				<?php } ?>
				</th>
			</tr>
			<tr></tr>
			

		       	<tr>
		       		<th colspan="2"  style="width:100%; height:1px; padding-bottom: auto; margin: none; border: none; text-align:center; font-size: 12px;">
		       		<hr style="width:100%; height:1px; border: dashed grey; border-width: 1px;">
					<small>TOTAL <?php echo '. . . . . . . . . . . . '.$donnees1['MONTANT']; ?></small> <br><br>
					<hr style="width:100%; height:1px; border: dashed grey; border-width: 1px;">

					<small>MERCI ET BONNE GUERISON!</small> 
					</th>
		       	</tr>
		       	<?php } ?>
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
	$pdf->Output("Ticket de caisse.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
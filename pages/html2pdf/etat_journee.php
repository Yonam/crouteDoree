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
	$reponse=$bdd->prepare("SELECT J.CODE_JOURNEE, J.DATE, J.DATE_OUVERTURE,J.DATE_FERMETURE,J.DATE_CLOTURE, J.MONTANT_FERMETURE, J.MONTANT_CLOTURE, J.MONTANT_MANQUANT,J.MONTANT_SURPLUS,U.LOGIN,J.STATUT FROM journee J JOIN utilisateur U ON J.CODE_USER_OUVRIR=U.CODE_USER ORDER BY code_journee DESC LIMIT 0 , 15");
	$reponse->execute();
}
//elseif(isset($_GET['dci']) && $_GET['dci'] != ''){
//	$reponse=$bdd->prepare("SELECT * FROM produit where dci =:dci order by code_produit");
//	$reponse->execute(array('dci' => $_GET['dci']));
//}
else{
	$reponse=$bdd->prepare("SELECT J.CODE_JOURNEE, J.DATE, J.DATE_OUVERTURE,J.DATE_FERMETURE,J.DATE_CLOTURE, J.MONTANT_FERMETURE, J.MONTANT_CLOTURE, J.MONTANT_MANQUANT,J.MONTANT_SURPLUS,U.LOGIN,J.STATUT FROM journee J JOIN utilisateur U ON J.CODE_USER_OUVRIR=U.CODE_USER ORDER BY code_journee DESC LIMIT 0 , 15");
	$reponse->execute();
}

ob_start();

?>

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
    <h3 align="center" >LISTE DES JOURNEES</h3>

	<table id="table" margin-top style="font-size: 8px; width: all;" align="center">

	       <thead>
				<tr>
					<th style="width: unset;">Journee</th>
					<th style="width: unset;">Date ouverture</th>
					<th style="width: unset;">Date fermeture</th>
					<th style="width: unset;">Montant fermeture</th>
					<th style="width: unset;">Date cloture</th>
					<th style="width: unset;">Montant cloture</th>
					<th style="width: unset;">Montant Manquant</th>
					<th style="width: unset;">Montant surplus</th>
					<th style="width: unset;">Operateur</th>
					<th style="width: unset;">Etat</th>
				</tr>
		  </thead>
		  
		   <tbody>	
              <?php while ($donnees = $reponse->fetch()){  ?>
                <tr class="odd gradeX">
						<td style="width: unset;"><?php echo $donnees['DATE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['DATE_OUVERTURE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['DATE_FERMETURE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['MONTANT_FERMETURE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['DATE_CLOTURE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['MONTANT_CLOTURE']; ?></td>
					<td style="width: unset;"><?php echo $donnees['MONTANT_MANQUANT']; ?></td>
					<td style="width: unset;"><?php echo $donnees['MONTANT_SURPLUS']; ?></td>
					<td style="width: unset;"><?php echo $donnees['LOGIN']; ?></td>
					<td style="width: unset;"><?php echo $donnees['STATUT']; ?></td>
                </tr>
            <?php } ?>
		</tbody>	
	</table>

</page>

<?php

$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');

try {
	$pdf = new HTML2PDF('L','A4','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des produits.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pharma', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}


if (isset($_GET['liste']) && $_GET['liste'] != ''){
	$reponse = $bdd->query($_GET['liste']);
}//else{
// 	$reponse=$bdd->query("SELECT * FROM encaissement order by CODE_ENCAISSEMENT");
// }

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
                    <h2 align="center" >TIcket caisse</h2>

	<table id="table" margin-top>
                                                                <?php if(isset($liste)){ ?>  
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="text-align:center">Produit</th>
                                                                            <th style="text-align:center">Prix unitaire</th>
                                                                            <th style="text-align:center">Quantite</th>
                                                                            <th style="text-align:center">Prix total</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <tr>
                                                                        <?php
                                                                            $total = 0;
                                                                         foreach ($liste as $l) { ?>

                                                
                                                                            <td style="text-align:center"><?=$l->DESIGNATION;?></td>
                                                                            <td style="text-align:center"><?=$l->PRIX_PRODUIT;?></td>
                                                                            <td style="text-align:center"><?=$l->NB_VENDU;?></td>
                                                                            <td style="text-align:center"><?=$l->MONTANT_VENTE;?></td>

                                                                        </tr>
                                                                        <?php  $total+= $l->MONTANT_VENTE;} } else{?>
                                                                            <br />
                                                                            <center class="ui-state-highlight ui-corner-all">Aucun article n'a été enregistré pour l' instant ...</center>
                                                                        <?php } ?>
                                                            
                                                                        <tr>

                                                                            <td colspan="2"><h3>Cout des marchandises : </h3></td>
                                                                            <td colspan="3"><h3><?= $total; ?></h3></td>
                                                                        </tr>
                                                                    
                                                                    </tbody>
                                                                </table>


</page>

<?php

$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');

try {
	$pdf = new HTML2PDF('LANDSCAPE','A8','fr');
	$pdf->writeHTML($content);
	$pdf->Output("Liste des produits.pdf");

} catch (HTML2PDF_exception $e) {
	die($e);
}

?>
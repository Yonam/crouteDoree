

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
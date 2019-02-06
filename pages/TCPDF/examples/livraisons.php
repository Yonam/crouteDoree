<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once('../../include/connexionDB.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$dated = $_POST['date_livraison'];
$req = $bdd->prepare('SELECT CODE_CMDE, DATE_CMDE, C.NOM_CLIENT, DATE_CMDE, NUMERO_TICKET FROM commande CMD JOIN client C ON CMD.CODE_CLIENT = C.CODE_CLIENT WHERE DATE_LIVRAISON = :dated');
$req->execute(array('dated' => $dated));
$listProd = $req->fetchAll();

$tbl = <<<EOD
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
    <thead>
        <tr>
            <th style="text-align:center">Numero ticket</th>
            <th style="text-align:center">Client</th>
            <th style="text-align:center">Date commande</th>
            <th style="text-align:center">Produits</th>
            <th style="text-align:center">Total</th>
        </tr>
    </thead>
    <tbody>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

foreach ($listProd as $p) { 
    $liste = $encaissement->liste($p->CODE_CMDE);

$tbl = <<<EOD 

        <tr class="odd gradeX">
            <td style="text-align:center"><?php echo $p->NUMERO_TICKET; ?></td>
            <td style="text-align:center"><?php echo $p->NOM_CLIENT; ?></td>
            <td style="text-align:center"><?php echo $p->DATE_CMDE; ?></td>
            <td style="text-align:center"><?php 

            // =====  Affichage des produits de la commande  =====
            if(isset($liste)){
                  $total = 0;
                 foreach ($liste as $l) {
                    echo $l->LIBELLE.'('.$l->QTE.')  ';

                    $total+= $l->TOTAL;
                 }
            }
             ?></td>
             <td style="text-align:center"> <?= $total ?></td>
            

            
        </tr>
    <?php   } ?>
    </tbody>
    </tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');




// -----------------------------------------------------------------------------



// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

<?php
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    
    // data request

    global $bdd;

    var_dump($_POST);

    $bdd->beginTransaction();
        $vente= $bdd->prepare('SELECT CM.CODE_CMDE, CM.DATE_CMDE, CM.DATE_LIVRAISON, CM.HEURE_LIVRAISON, CM.NUMERO_TICKET, CM.VALIDE, CL.NOM_CLIENT FROM commande CM JOIN client CL ON CM.CODE_CLIENT = CL.CODE_CLIENT WHERE DATE_LIVRAISON = :dated');
        $vente->execute(array('dated'=>$date));
    $bdd->commit();

    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/res/commandes.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('commandes.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
<?php

/**
 * Created by PhpStorm.
 * User: OLA
 * Date: 21/07/2017
 * Time: 22:54
 */
include "../../include/connexionDB.php";

function compress_image($source_url, $destination_url, $quality = 70) {
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

function upload_fichier($destination) {
    $nom = common\Config::APP_DOSSIER_IMAGES . "005." . recuperer_extension_fichier();

    compress_image($_FILES['url']['tmp_name'], $nom);
}

function recuperer_extension_fichier() {
    $extension_upload = strtolower(substr(strrchr($_FILES['url']['name'], '.'), 1));
    return $extension_upload;
}

function liste_extensions_valides() {
    $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
    return $extensions_valides;
}



if (isset($_POST['addprod'])){

        $cip = isset($_POST['cip']) ? $_POST['cip'] : '';
        //$barre = isset($_POST['barre']) ? $_POST['barre'] : '';
        $interne = isset($_POST['interne']) ? $_POST['interne'] : '';
        $famille = isset($_POST['famille']) ? $_POST['famille'] : '';
        $dci = isset($_POST['dci']) ? $_POST['dci'] : '';
        $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
        $commercialisation = isset($_POST['commercialisation']) ? $_POST['commercialisation'] : '';
        $peremption = isset($_POST['peremption']) ? $_POST['peremption'] : '';
        $enregistrement = isset($_POST['enregistrement']) ? $_POST['enregistrement'] : '';
        $tva = isset($_POST['tva']) ? $_POST['tva'] : '';
        $taux_tva = isset($_POST['taux_tva']) ? $_POST['taux_tva'] : 0;
        $vente = isset($_POST['vente']) ? $_POST['vente'] : '';
        $laboratoire = isset($_POST['laboratoire']) ? $_POST['laboratoire'] : '';
        $exploitant = isset($_POST['exploitant']) ? $_POST['exploitant'] : '';
        $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
        $localisation = isset($_POST['localisation']) ? $_POST['localisation'] : '';
        $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';
        $forme = isset($_POST['forme']) ? $_POST['forme'] : '';
        $photo = isset($_POST['photo']) ? $_POST['photo'] : '';


        if (isset($_POST['photo'])) {

        }


        //Formattage

                
                $req = $bdd->prepare("INSERT INTO produit (CODE_FAMILLE,CODE_FORME,CODE_CLASSE,CODE_EXPLOITANT,CODE_LOCALISATION,CODE_SPECIALITE,CODE_LAB,DESIGNATION,DCI,SOUMIS_TVA,DATE_COMMERCIALISATION,DATE_ENREGISTREMENT,PRIX_PRODUIT,CIP,TAUX_TVA) VALUES (:code_famille,:code_forme,:code_classe,:code_exploitant,:code_localisation,:code_specialite,:code_lab,:designation,:dci,:soumis_tva,:date_commercialisation,:date_enregistrement,:prix_produit,:cip,:taux_tva)");
                $req->execute(array(
                    'code_famille'=>$famille,
                    'code_forme'=>$forme,
                    'code_classe'=>$classe,
                    'code_exploitant'=>$exploitant,
                    'code_localisation'=>$localisation,
                    'code_specialite'=>$specialite,
                    'code_lab'=>$laboratoire,
                    'designation'=>$designation,
                    'dci' =>$dci,
                    'soumis_tva'=>$tva,
                    'date_commercialisation'=>$commercialisation,
                    'date_enregistrement'=>$enregistrement,
                    'prix_produit'=>$vente,
                    'cip'=>$cip,
                    'taux_tva'=>$taux_tva));
                $lastId = (int)$bdd->lastInsertId();
        }
        // echo json_encode($json);
      echo '<body onload ="alert(\'Produit ajouté avec succès\')">';

       echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_produit">';
    
?>
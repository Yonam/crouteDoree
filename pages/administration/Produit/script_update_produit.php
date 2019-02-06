<?php

/**
 * Created by PhpStorm.
 * User: OLA
 * Date: 21/07/2017
 * Time: 22:54
 */
include "../../include/connexionDB.php";
if (isset($_POST['addprod'])){

        $cip = isset($_POST['cip']) ? $_POST['cip'] : '';
        $barre = isset($_POST['barre']) ? $_POST['barre'] : '';
        $interne = isset($_POST['interne']) ? $_POST['interne'] : '';
        $famille = isset($_POST['famille']) ? $_POST['famille'] : '';
        $dci = isset($_POST['dci']) ? $_POST['dci'] : '';
        $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
        $commercialisation = isset($_POST['commercialisation']) ? $_POST['commercialisation'] : '';
        $peremption = isset($_POST['peremption']) ? $_POST['peremption'] : '';
        $enregistrement = isset($_POST['enregistrement']) ? $_POST['enregistrement'] : '';
        $tva = isset($_POST['tva']) ? $_POST['tva'] : '';
        $taux_tva = isset($_POST['taux_tva']) ? $_POST['taux_tva'] : '';
        $vente = isset($_POST['vente']) ? $_POST['vente'] : '';
        $laboratoire = isset($_POST['laboratoire']) ? $_POST['laboratoire'] : '';
        $exploitant = isset($_POST['exploitant']) ? $_POST['exploitant'] : '';
        $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
        $localisation = isset($_POST['localisation']) ? $_POST['localisation'] : '';
        $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';
        $forme = isset($_POST['forme']) ? $_POST['forme'] : '';
        $id = isset($_POST['memids']) ? $_POST['memids'] : '';

        //Formattage
       

                $req = $bdd->prepare("UPDATE produit SET CODE_FAMILLE=:code_famille,CODE_FORME=:code_forme,CODE_CLASSE=:code_classe,CODE_CLASSE=:code_classe,CODE_EXPLOITANT=:code_exploitant,CODE_LOCALISATION=:code_localisation,CODE_SPECIALITE=:code_specialite,CODE_LAB=:code_lab,DESIGNATION=:designation,DCI=:dci,SOUMIS_TVA=:soumis_tva,DATE_COMMERCIALISATION=:date_commercialisation,DATE_ENREGISTREMENT=:date_enregistrement,PRIX_PRODUIT=:prix_produit,CIP=:cip,CODE_BARRE=:code_barre,TAUX_TVA=:taux_tva WHERE code_produit=:id");
        
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
                    'code_barre'=>$barre,
                    'taux_tva'=>$taux_tva,
                    'id'=>$id));
                $lastId = (int)$bdd->lastInsertId();
        }

        // echo json_encode($json);
      echo '<body onload ="alert(\'Produit modifie avec succès\')">';
       echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_produit">';
    
?>
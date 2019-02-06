<?php
include "../../include/connexionDB.php";
if (isset($_POST['update_cli'])){

    $commercial = isset($_POST['commercial']) ? $_POST['commercial'] : null;
    $titre = isset($_POST['titre']) ? $_POST['titre'] : null;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $datep = isset($_POST['datep']) ? $_POST['datep'] : null;
    $piece = isset($_POST['piece']) ? $_POST['piece'] : null;
    $numpiece = isset($_POST['numpiece']) ? $_POST['numpiece'] : null;
    $droit = isset($_POST['droit']) ? $_POST['droit'] : '0';
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $tel1 = isset($_POST['tel1']) ? $_POST['tel1'] : null;
    $tel2 = isset($_POST['tel2']) ? $_POST['tel2'] : null;
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : null;
    $credit = isset($_POST['credit']) ? $_POST['credit'] : null;
    $remise = isset($_POST['remise']) ? $_POST['remise'] : null;
    $depassement = isset($_POST['depassement']) ? $_POST['depassement'] : null;
    $delai = isset($_POST['delai']) ? $_POST['delai'] : null;
    $code= isset($_POST['memids']) ? $_POST['memids'] : null;
    //Formattage
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $email = htmlspecialchars($email);
    $adresse = utf8_decode($adresse);
    $tel1 = htmlspecialchars($tel1);
    $tel2 = htmlspecialchars($tel2);
    $numpiece = htmlspecialchars($numpiece);
    $piece = htmlspecialchars($piece);
    //TEST
    
    $req = $bdd->prepare("UPDATE client SET TITRE= :titre, NOM_CLI=:Nom_cli, PRENOM_CLI=:prenom_cli, TYPE_PIECE=:type_piece, NUM_PIECE=:num_piece, DATE_PIECE=:date_piece,
    EMAIL=:Email, ADRESSE=:adresse, TEL1=:tel1, TEL2=:tel2, STATUT=:statut,TOTAL_DU=:total_du, CREDIT_MAX=:credit_max, DELAI_PAIEMENT=:delai_paiement, REMISE=:remise, DROIT_CREDIT=:droit_credit, DEPASSEMENT=:depassement WHERE CODE_CLI=:code");
    $req->execute(array(
    'titre' =>$titre,
    'Nom_cli'=>$nom, 
    'prenom_cli'=>$prenom, 
    'type_piece'=>$piece, 
    'num_piece'=>$numpiece,
    'date_piece'=>$datep, 
    'Email'=>$email,
    'adresse'=>$adresse,
    'tel1'=>$tel1, 
    'tel2'=>$tel2, 
    'statut'=>0,
    'total_du'=>0, 
    'credit_max'=>$credit,
    'delai_paiement'=>$delai, 
    'remise' =>$remise,
    'droit_credit'=>$droit,
    'depassement' =>$depassement,
    'code'=>$code));

}
                
echo '<body onload ="alert(\'Client mis a jour avec succès\')">';
echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_client">';


?>
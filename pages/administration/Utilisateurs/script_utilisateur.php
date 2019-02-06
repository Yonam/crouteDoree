<?php
/**
 * Created by PhpStorm.
 * User: OLA
 * Date: 19/07/2017
 * Time: 22:54
 */
include "../../include/connexionDB.php";
if (isset($_POST['adduser'])){

    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $privilege = isset($_POST['priv']) ? $_POST['priv'] : '';
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '0';
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $date = date("Y-m-d H:i:s");

    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $login = htmlspecialchars($login);

        
        $verif = $bdd->query("SELECT login FROM utilisateur");

        $bool = true; 
        while ($donnees = $verif->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees['login'] != $login) {
                $bool = false;
            }    
        }
        if ($bool) {

            $req = $bdd->prepare("INSERT INTO utilisateur (CODE_PRIVILEGE,NOM_USER,PRENOM_USER,LOGIN,STATUT,DATE_ENREGISTREMENT) VALUES(:code_privilege,:nom_user,:prenom_user,:login, :statut, :date_enregistrement)");
            $req->execute(array(
            'code_privilege'=>$privilege,
                        'nom_user'=>$nom, 
                        'prenom_user'=>$prenom, 
                        'login'=>$login,
            'statut' =>$statut,
            'date_enregistrement' => $date
            ));
            $lastId = (int)$bdd->lastInsertId();
            
            // print_r($_POST);
            echo '<body onload ="alert(\'Utilisateur ajouté avec succès\')">';
            echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=liste_utilisateur">';

        }else{
            echo '<body onload ="alert(\'Le login existe déjà. Entrez un autre login\')">';
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
}
?>
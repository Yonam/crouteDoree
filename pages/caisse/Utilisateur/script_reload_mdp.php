<?php
/**
 * Created by PhpStorm.
 * User: OLA
 * Date: 19/07/2017
 * Time: 22:54
 */
include "../../include/connexionDB.php";
if (isset($_POST['mod_mdp'])){
    //<editor-fold defaultstate="collapsed" desc=" case 'ajout_client' ">

     // if (isset($_GET['form'])) {
       //     if ( isset($_POST['nom']) && isset($_POST['prenom']) ) {
                $pass = sha1($_POST['mdp']);
                $id = isset($_POST['memids']) ? $_POST['memids'] : '';

                $req = $bdd->prepare('UPDATE utilisateur SET MDP=:pass WHERE CODE_USER=:code');
                $req->execute(array(
                'pass' => $pass,
                'code' => $id));
                $lastId = (int)$bdd->lastInsertId();
}

echo '<body onload ="alert(\'Mot de passe enréristré avec succès\')">';
echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=login">';
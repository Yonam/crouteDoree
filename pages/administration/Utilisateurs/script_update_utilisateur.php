<?php
/**
 * Created by PhpStorm.
 * User: OLA
 * Date: 19/07/2017
 * Time: 22:54
 */
include "../../include/connexionDB.php";
if (isset($_POST['adduser'])){
    //<editor-fold defaultstate="collapsed" desc=" case 'ajout_client' ">

     // if (isset($_GET['form'])) {
       //     if ( isset($_POST['nom']) && isset($_POST['prenom']) ) {
                $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
                $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
                $privilege = isset($_POST['priv']) ? $_POST['priv'] : '';
                $statut = isset($_POST['statut']) ? $_POST['statut'] : '';
                $login = isset($_POST['login']) ? $_POST['login'] : '';
                $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
                $id = isset($_POST['memids']) ? $_POST['memids'] : '';
               // $date_enr=date('Y-m-d');
                //Formattage
                $nom = htmlspecialchars($nom);
                $prenom = htmlspecialchars($prenom);
                $login = htmlspecialchars($login);
                $pass = htmlspecialchars($pass);
                //TEST
            /**    ECHO $titre ; ?> </Br> <?Php
               ECHO $nom ; ?> </Br> <?Php
                ECHO $prenom ; ?> </Br> <?Php
                ECHO $email ; ?> </Br> <?Php
                ECHO  $adresse ; ?> </Br> <?Php
                ECHO   $tel1 ; ?> </Br> <?Php
                ECHO  $tel2 ; ?> </Br> <?Php

                ECHO  $piece ; ?> </Br> <?Php
                 ECHO   $numpiece ; ?> </Br> <?Php
                  ECHO   $datep ; ?> </Br> <?Php
                ECHO  $droit ; ?> </Br> <?Php
                ECHO  $depassement ; ?> </Br> <?Php
**/
                    {
                        $req = $bdd->prepare("UPDATE utilisateur SET NOM_USER=:nom_user,PRENOM_USER=:prenom_user,LOGIN=:login WHERE CODE_USER=:code");
                        $req->execute(array(
                						'nom_user'=>$nom, 
                						'prenom_user'=>$prenom, 
                						'login'=>$login,
                            'code'=>$id
                        //'date_enr'=>$date_enr
                        ));
                        $lastId = (int)$bdd->lastInsertId();
                    }
               // }
               // echo json_encode($json);
				echo '<body onload ="alert(\'Utilisateur mis a jour avec succès\')">';
				echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=liste_utilisateur">';
            }
     //  }
?>
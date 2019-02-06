<?php
/**
 * Created by PhpStorm.
 * User: CANAAN-LAND
 * Date: 17/07/2017
 * Time: 15:51
 */

/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
-----------------------------------
*/
//

if (isset($_POST['togin'])){ // execution uniquement apres envoi du formulaire (test si la variable POST existe)
    $Login = addslashes($_POST['Login']); // mise en variable du nom d'utilisateur
    $Pwd = addslashes(md5($_POST['Pwd'])); // mise en variable du mot de passe chiffr? ? l'aide de md5
    $log=$_SESSION['Login'];

// requete sur la table utilisateur (on r?cup?re les infos de la personne)
echo $Login;
    echo $Pwd;

    $res=$bdd->query("SELECT code_user, nom_u, prenom_u,login, code_priv,pwd  FROM utilisateur WHERE login='$Login' AND pwd='$Pwd'"); // requ?te sur la table utilisateurs
    $utlisateur=$res->fetch();


    if ($utilisateur) {	// On test s'il y a un utilisateur correspondant

        $_SESSION['code_priv'] == "1"; // enregistrement de la session

        // d?claration des variables de session
        $_SESSION['Code_priv'] = $utilisateur['code_priv']; // le privil?ge de l'utilisateur (permet de d?finir ?ventuellement des niveaux d'utilisateurs)
        $_SESSION['Nom'] = $utilisateur['nom']; // Son Nom
        $_SESSION['Prenom'] = $utilisateur['prenom']; // Son Prenom
        $_SESSION['Login'] = $utilisateur['login']; // Son Login
        // $_SESSION['Pwd'] = $row_verif['Pwd']; // Son mot de passe (? ?viter)
        $ip = ip;

        Echo "ok";
        $action="C";
        $statut="0";
//
        $reqt='INSERT INTO connexion VALUES ("","' . mysql_real_escape_string($_SESSION['Login']).'", "'.mysql_real_escape_string($statut).'", "'. mysql_real_escape_string($ip).'",NOW(), "'.mysql_real_escape_string($_POST['Submit']).'", "'.mysql_real_escape_string($action).'")';
        mysql_query($reqt) or die('Erreur log SQL !' . $reqt . '<br />' . mysql_error());

        header("Location:?page=acceuil"); // redirection si OK

    }
    else {

        $statut="1";
        $action="C";
        $reqt='INSERT INTO connexion VALUES ("","' . mysql_real_escape_string($_SESSION['Login']).'", "'.mysql_real_escape_string($statut).'", "'. mysql_real_escape_string($ip).'",NOW(), "'.mysql_real_escape_string($_POST['Submit']).'", "'.mysql_real_escape_string($action).'")';
        //$reqt="INSERT INTO logs(id_utilisateur,login,evenement,statut) VALUES (".$_SESSION['IdPriv'].",".$_SESSION['Login'].",".$evenement.",".$statut.")";
        mysql_query($reqt) or die('Erreur log SQL !' . $reqt . '<br />' . mysql_error());

        header("Location:index.php?erreur=login"); // redirection si utilisateur non reconnu

    }
}

    // Gestion de la  d?connexion
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ // Test sur les param?tres d'URL qui permettront d'identifier un contexte de d?connexion
    $log=$_SESSION['Login'];
    $evenement= " Déconnexion";
    $statut="ok";
    $reqs='INSERT INTO logs VALUES ("","'.$_SESSION['IdPriv'].'","' . mysql_real_escape_string($log).'",NOW(), "'.mysql_real_escape_string($evenement).'","'.mysql_real_escape_string($statut).'")';
    mysql_query($reqs) or die('Erreur log SQL !' . $reqs . '<br />' . mysql_error());
    $Prenom = $_SESSION['Prenom']; // On garde le pr?nom en variable pour dire au revoir (soyons polis :-)
    session_unset('IdPriv');
    header("Location:index.php?erreur=delog&prenom=$prenom");
//    echo '<meta http-equiv="refresh" content="0;URL=index.php">';

}

?>
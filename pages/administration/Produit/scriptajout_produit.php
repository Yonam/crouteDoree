<?php
session_start();
    include "../../include/connexionDB.php";

//Fonction pour valider les valeurs saisies dans les champs en fonction de la taille
function is_valid($value, $taille)
{
    return  (is_string($value) and strlen($value)<$taille);
}

// les variables

    $barre=$_POST['barre'];
    $cip=$_POST['cip'];
    $interne=$_POST['interne'];
    $dci=$_POST['dci'];
    $designation=$_POST['designation'];
    $peremption=$_POST['peremption'];
    $tva=$_POST['tva'];
    $achat=$_POST['achat'];
    $coef=$_POST['coef'];
    $reduction=$_POST['reduction'];
    $vente=$_POST['vente'];
    $labo=$_POST['laboratoire'];
    $localisation=$_POST['localisation'];
    $exploitant=$_POST['exploitant'];
    $classe=$_POST['classe'];
    $specialite=$_POST['specialite'];
    $forme=$_POST['forme'];

//Si cliquer sur envoyer
if (isset($_POST['submit'])) {
    //Traitement des champs
    $message = "";
    if (empty($_POST['cip'])) {
        $message = "Veuillez renseigner le numero CIP du produit !";
    }
    elseif (empty($_POST['barre'])) {
        $message = "Veuillez renseigner le code barre du produit !";
    }
    elseif (empty($_POST['interne'])) {
        $message = "Veuillez renseigner le code interne du produit !";
    }
    elseif (empty($_POST['dci'])) {
        $message = "Veuillez renseigner la molecule de base du produit !";
    }
    elseif (empty($_POST['designation'])) {
        $message = "Veuillez renseigner le nom du produit !";
    }
    elseif (empty($_POST['peremption'])) {
        $message = "Veuillez renseigner la date de peremption du produit !";
    }
    elseif (empty($_POST['achat'])) {
        $message = "Veuillez renseigner le prix d'achat du produit !";
    }
    elseif (empty($_POST['coef'])) {
        $message = "Veuillez renseigner le coeficient multiplicatif du produit !";
    }

    elseif (empty($_POST['vente'])) {
        $message = "Veuillez renseigner le prix de vente du produit !";
    }

    //si aucune erreur, on verifie les valeurs et on enregistre
    if (empty($message)) {
        $requete = $bdd->prepare('INSERT INTO produit(code_barre, code_cip, code_interne,dci,designation,date_peremption,Soumis_tva,prix_achat,multiplicateur,reduction,prix_vente,code_lab,code_localisation,code_exploitant, code_clas,code_specialite,code_forme)
                                VALUES(:barre,:cip,:interne,:dci,:designation,:permption,:tva,:achat,:coef,:reduction,:vente,:labo,:localisation,:exploitant,:classe,:specialite,:forme)');
// On lie les variables définie au-dessus au paramètres de la requête préparée
        $requete->bindValue(':barre', $barre, PDO::PARAM_STR);
        $requete->bindValue(':cip', $cip, PDO::PARAM_STR);
        $requete->bindValue(':interne', $interne, PDO::PARAM_STR);
        $requete->bindValue(':dci', $dci, PDO::PARAM_STR);
        $requete->bindValue(':designation', $designation, PDO::PARAM_STR);
        $requete->bindValue(':peremption', $peremption, PDO::PARAM_STR);
        $requete->bindValue(':tva', $tva, PDO::PARAM_STR);
        $requete->bindValue(':achat', $achat, PDO::PARAM_STR);
        $requete->bindValue(':coef', $coef, PDO::PARAM_STR);
        $requete->bindValue(':reduction', $reduction, PDO::PARAM_STR);
        $requete->bindValue(':vente', $vente, PDO::PARAM_STR);
        $requete->bindValue(':labo', $labo, PDO::PARAM_STR);
        $requete->bindValue(':localisation', $localisation, PDO::PARAM_STR);
        $requete->bindValue(':exploitant', $exploitant, PDO::PARAM_STR);
        $requete->bindValue(':classe', $classe, PDO::PARAM_STR);
        $requete->bindValue(':specialite', $specialite, PDO::PARAM_STR);
        $requete->bindValue(':forme', $forme, PDO::PARAM_STR);
//On exécute la requête
        $requete->execute();

        // Un petit message pour confirmer l'insertion

        echo "Insertion reussie!";
        http_redirect();
    }
        else
            $message = "Champ CIP invalide !";

}

?>
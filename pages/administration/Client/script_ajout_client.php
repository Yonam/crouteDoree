<?php

include "../../include/connexionDB.php";
if (isset($_POST['addcli'])){

    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : null;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
    //Formattage
    $nom = htmlspecialchars($nom);
    $tel = htmlspecialchars($tel);

    $verif = $bdd->prepare("SELECT * FROM client WHERE NOM_CLIENT = :nom");
    $verif ->execute(array('nom'=>$nom));
    $client = $verif->fetchAll();

    if (count($client) > 0) {
        echo '<body onload ="alert(\'Ce client a deja été enrégistré\')">';
        echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_client">';
    } else {

            $req = $bdd->prepare("INSERT INTO client (CODE_CATEGORIE,NOM_CLIENT, CONTACT_CLIENT) VALUES(:categorie,:nom,:tel)");
            $req->execute(array(
            'categorie'=>$categorie,
			'nom'=>$nom, 
			'tel'=>$tel));
            $lastId = (int)$bdd->lastInsertId();

            echo '<body onload ="alert(\'Client ajouté avec succès\')">';
            echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_client">';
        
    }
}
   
	
          //  }
     //  }
//}


?>
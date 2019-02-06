<?php 
	require_once('../../pages/include/connexionDB.php');

	$req = $bdd->prepare('SELECT CODE_PAIN, REFERENCE, LIBELLE, PRIX_UNIT FROM pains');
	$req->execute();
	$req = $req->fetchAll();
	echo json_encode($req);
?>
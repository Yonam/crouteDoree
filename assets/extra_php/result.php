<?php 
	include "../../pages/include/connexionDB.php";
	
	$req = $bdd->prepare('SELECT CODE_CLIENT, NOM_CLIENT FROM client');
	$req->execute();
	$req = $req->fetchAll();
	echo json_encode($req);
?>
<?php 
	require_once('../../pages/include/connexionDB.php');
	$nom = $_GET['name'];
	
		$req = $bdd->prepare('SELECT CODE_CLIENT FROM client WHERE NOM_CLIENT = :nom');
		$req->execute(array('nom' => $nom));
		$req = $req->fetchAll();
		echo json_encode($req);
	
	
	
?>
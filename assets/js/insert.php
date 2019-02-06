<?php 
	require_once('../../pages/include/connexionDB.php');
	$nom = $_POST['name'];
	

		$req = $bdd->prepare('INSERT INTO client(CODE_CATEGORIE,NOM_CLIENT) VALUES ("1",:nom)');
		$req->execute(array('nom' => $nom));
		$lastId = (int)$bdd->lastInsertId();
		
	
	
	
?>


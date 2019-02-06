<?php
include "../../include/connexionDB.php";
		
		/*if ($_SESSION['commande'] == array())

		$tab = array('ids' => array(), 'qte' => array());
		foreach ($_SESSION['commande'] as $commande => $qte) {

			$tab['ids'][]=$commande;
			$tab['qte'][]=$qte;

		}*/
	if (isset($_POST['commande'])) {
		$prix = isset($_POST['prix_unit']) ? $_POST['prix_unit'] : null;
		$ticket = isset($_POST['ticket']) ? $_POST['ticket'] : null;
		$id = isset($_POST['idProduit']) ? $_POST['idProduit'] : null;
		$qte = isset($_POST['quantite']) ? $_POST['quantite'] : null;
		$client = isset($_POST['client']) ? $_POST['client'] : null;
		$idClient = isset($_POST['idClient']) ? $_POST['idClient'] : null;
		$user = isset($_POST['user']) ? $_POST['user'] : null;
		$livraison = isset($_POST['livraison']) ? $_POST['livraison'] : null;
		$time = isset($_POST['time']) ? $_POST['time'] : null;
		$date = date("Y-m-d");


		

		// =========== insertion requete =================

		//================== controle sur le nom du client =====================

		//================== Verifie si le client est deja dan la base =====================
		$verifClient = $bdd->prepare('SELECT CODE_CLIENT FROM client WHERE NOM_CLIENT = :nom');
		$verifClient->execute(array('nom'=>$client));
		$verifClient = $verifClient->fetchAll();

		var_dump($verifClient);
		//================== Si oui, on continue les traitements =====================
		if (count($verifClient != null)) {
			if ($date > $livraison) {
			echo '<body onload ="alert(\'Date de livraison pas valide\')">';
			echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=vente">';
			} else {
			//Insertion des données de la vente en premier (création de la vente)
	    	$sqlVente = $bdd->prepare('INSERT INTO commande (code_client, code_user, date_cmde, date_livraison, heure_livraison,numero_ticket) VALUES (:client , :user, :commande, :livraison, :heure, :ticket)');
	    	$sqlVente->execute(array(
	    	'client' => $idClient,
	    	'user' => $user,
	    	'commande' => $date,
	    	'livraison' => $livraison,
	    	'heure' => $time,
	    	'ticket' => $ticket
	    	));



		
			$sqlCod = 'select MAX(code_cmde) as max_code from commande';
			$codeVente = $bdd->query($sqlCod);
			$codeVente = $codeVente->fetch(PDO::FETCH_ASSOC);

			

			$sqlProduitVendu = $bdd-> prepare('INSERT INTO commande_pain (code_cmde, code_pain, quantite, prix_vente, total) values (:max_code, :pain, :quantite, :prix, :total)');
			$sqlProduitVendu->execute(
				array(
					'max_code'=>$codeVente["max_code"],
					'pain' => $id,
					'quantite' => $qte,
					'prix' => $prix,
					'total' => $prix * $qte));
			    
			    		/*$sqlUpdateCommande = $bdd->prepare("UPDATE commande set VALIDE = 1 where NUMERO_TICKET ='".$ticket."'  ");
			$sqlUpdateCommande->execute();*/

		// ============== Message de validation ==============


			echo '<body onload ="alert(\'Commande ajoutee avec succès\')">';
			echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=vente">';
		}

		//================== Sinon on l'enregistre d'abord =====================
		} else {
			$req = $bdd->prepare('INSERT INTO client(CODE_CATEGORIE,NOM_CLIENT, CONTACT_CLIENT) VALUES ("1",:nom)');
			$req->execute(array('nom' => $nom));
			$lastId = (int)$bdd->lastInsertId();


			//================== On prend soin de le garder en memoire pour le reste du travail =====================
			$sqlCod = 'select MAX(CODE_CLIENT) as max_code from client';
			$codeClient = $bdd->query($sqlCod);
			$codeClient = $codeClient->fetch(PDO::FETCH_ASSOC);

			if ($date > $livraison) {
				echo '<body onload ="alert(\'Date de livraison pas valide\')">';
			echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=vente">';
			} else {
				//Insertion des données de la vente en premier (création de la vente)
		    $sqlVente = $bdd->prepare('INSERT INTO commande (code_client, code_user, date_cmde, date_livraison, heure_livraison,numero_ticket) VALUES (:client , :user, :commande, :livraison, :heure, :ticket)');
		    $sqlVente->execute(array(
		    	'client' => $codeClient["max_code"],
		    	'user' => $user,
		    	'commande' => $date,
		    	'livraison' => $livraison,
		    	'heure' => $time,
		    	'ticket' => $ticket
		    ));



			
				$sqlCod = 'select MAX(code_cmde) as max_code from commande';
				$codeVente = $bdd->query($sqlCod);
				$codeVente = $codeVente->fetch(PDO::FETCH_ASSOC);

				

				$sqlProduitVendu = $bdd-> prepare('INSERT INTO commande_pain (code_cmde, code_pain, quantite, prix_vente, total) values (:max_code, :pain, :quantite, :prix, :total)');
				$sqlProduitVendu->execute(
					array(
						'max_code'=>$codeVente["max_code"],
						'pain' => $id,
						'quantite' => $qte,
						'prix' => $prix,
						'total' => $prix * $qte));

						/*	$sqlUpdateCommande = $bdd->prepare("UPDATE commande set VALIDE = 1 where NUMERO_TICKET ='".$ticket."'  ");
		         $sqlUpdateCommande->execute();

				    */
			// ============== Message de validation ==============


			echo '<body onload ="alert(\'Commande ajoutee avec succès\')">';
			echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=vente">';
			}
		}
	}


		


?>
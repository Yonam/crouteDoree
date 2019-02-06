<?php
class encaissement{

	public function __construct(){
		
		
		if (!isset($encaissement)) {
			$encaissement = array();
		}

		if(isset($_POST['encaisser'])){
			$this->store();
		}

		if(isset($_POST['modifier'])){
			$this->edit();
		}

		if(isset($_POST['annuler'])){
			$this->clean();
		}

	}
	 

	public function liste($codecmde){
		
	global $bdd;
    $liste=$bdd->prepare('SELECT P.LIBELLE LIBELLE,CP.PRIX_VENTE PRIX,CP.QUANTITE QTE, CP.TOTAL TOTAL, C.CODE_CMDE CODE  FROM commande_pain CP JOIN pains P ON CP.CODE_PAIN = P.CODE_PAIN JOIN commande C ON C.CODE_CMDE = CP.CODE_CMDE WHERE C.CODE_CMDE ='.$codecmde);
    $liste->execute();
    $liste = $liste->fetchAll();
    return $liste;

	}


	public function compte($codeClient){
		
	global $bdd;
    $compte=$bdd->prepare('SELECT C.code_cli, solde, montant_verse,reste,date FROM operationcompte O JOIN client C ON O.code_cli = '.$codeClient);
    $compte->execute();
    $compte = $compte->fetchAll();
    return $compte;

	}


	public function store(){
    	global $bdd;
		
		//Création du mode de payement
    	/*$sqlModPay = 'INSERT INTO mode_payement (montant, montant_paye, montant_reste) values ('.$_POST["encaisser"].','.$_POST["encaisser"].' , 0)';
	    $bdd->query($sqlModPay);

		//Création de l'encaissement
	    $sqlEncaissement = 'INSERT INTO encaissement (code_journee, code_payement, code_vente, code_user, type, date_encaissement) values ((select code_journee from journee where statut = 0), (select max(code_payement) from mode_payement),'.$_POST["codeVente"].' , '.$_SESSION["Auth"]->code_user.', "Espèce", CURDATE())';
	    $bdd->query($sqlEncaissement);*/

	    //Mise à jour de la vente
	    $sqlVente = 'UPDATE commande SET VALIDE = 1 WHERE CODE_CMDE = '.$_POST["codeVente"];
	    $bdd->query($sqlVente);
/*
	    $sqlCodeEncaiss = $bdd->prepare("select MAX(code_encaissement) as codeEncaiss from encaissement");
	    $sqlCodeEncaiss->execute();
	    $codeEncaiss = $sqlCodeEncaiss->fetch();*/


		echo '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Commande validée avec succès. 
    	</div>';

    	/*=============== GENERATION DE L'ETAT DU TICKET ================*/
    	/*header("Location:?page=etat_ticket_caisse&codeVente=".$codeEncaiss->codeEncaiss."&sql=SELECT * FROM `encaissement` e WHERE e.code_encaissement =".$codeEncaiss->codeEncaiss);*/

	}

	public function edit(){
		global $bdd;
		/*$date_livraison = isset($_POST['livraison']) ? $_POST['livraison'] : null;
		$heure_livraison = isset($_POST['heure']) ? $_POST['heure'] : null;
		$code_cmde = isset($_POST['code_commande']) ? $_POST['heure'] :null;*/

		$req = $bdd->prepare('UPDATE commande SET DATE_LIVRAISON = :livraison, HEURE_LIVRAISON = :heure WHERE CODE_CMDE = :cmde');
		$req -> execute(array(
			'livraison'=> $_POST['livraison'], 
			'heure'=> $_POST['heure'], 
			'cmde'=> $_POST['code_commande']
		));

		$prix = $_POST['quantite']*$_POST['prix_vente'];
		$qte = $bdd->prepare('UPDATE commande_pain SET QUANTITE = :quantite, TOTAL = :total WHERE CODE_CMDE = :cmde');
		$qte -> execute(array(
			'quantite'=> $_POST['quantite'],
			'total'=> $prix,
			'cmde'=> $_POST['code_commande']
		));

		

		echo '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Commande modifiee avec succès. 
    	</div>';
	}

	public function clean(){
		global $bdd;
		
	    	$sqlCleanProd = 'UPDATE commande SET SUPPRIME = "1" WHERE CODE_CMDE='.$_POST['codeVente'];
	    	$bdd->query($sqlCleanProd);

	    echo '<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Commande supprimee avec succès. 
    	</div>';
	}

}
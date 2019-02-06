<?php
class panier{

	// private $id= $_SESSION["Auth"]->code_user;
	 

	public function __construct(){
		
		
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}

		if (isset($_POST['panier'])){
			if (isset($_POST['panier']) && $_POST['panier'] == "Valider la vente"){
				$this->store();
			}
			if(isset($_POST['reinitialiser'])){
				$_SESSION['panier'] = array();
			}

			if (isset($_POST['recalculer'])){
				if (isset($_POST['panier']['quantite'])){
					$this->recalc();
				}
			}
		}
		
		
	}

	public function recalc(){
		foreach ($_SESSION['panier'] as $product_id => $quantite) {
			if(isset($_POST['panier']['quantite'][$product_id])){
				$_SESSION['panier'][$product_id] = $_POST['panier']['quantite'][$product_id];
			}
		}
	}

	public function add($product_id){
		if (isset($_SESSION['panier'][$product_id])) {
			$_SESSION['panier'][$product_id]++;
		}else {
			$_SESSION['panier'][$product_id] = 1;	
		}
	}

	public function del($product_id){
		
			unset($_SESSION['panier'][$product_id]);
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php?page=vente#ancorPanier">';

	}


	public function total(){
		$total = 0;
		$ids = array_keys($_SESSION['panier']);
         if (empty($ids)) {
           $produit =array();
         }else{

          global $bdd;
          $produit=$bdd->prepare('SELECT CODE_PAIN,PRIX_UNIT FROM pains WHERE CODE_PAIN IN ('.implode(',',$ids).')');
          $produit->execute();
          $produit=$produit->fetchAll(PDO::FETCH_OBJ);
         }
		foreach ($produit as $p ) {

			$total += $p->PRIX_UNIT * $_SESSION['panier'][$p->CODE_PAIN];
		}

		return $total;
	}


	/*=============== fonction reviens =======================*/

	public function reviens($product_id){
		$reviens = 0;
		$ids = $product_id;
         if (empty($ids)) {
           $produit =array();
         }else{

          global $bdd;
          $produit=$bdd->prepare('SELECT CODE_PAIN,PRIX_UNIT FROM pains WHERE CODE_PAIN =:id');
          $produit->execute(array('id'=>$ids));
          $produit=$produit->fetchAll(PDO::FETCH_OBJ);
         }
		foreach ($produit as $p ) {
			$reviens += $p->PRIX_UNIT * $_SESSION['panier'][$product_id];
		}

		return $reviens;
	}

	/*=============== fonction count =======================*/

	public function count(){
		return array_sum($_SESSION['panier']);
	}

	/*=============== fonction store =======================*/

	public function store(){
		global $bdd;
		
		if ($_SESSION['panier'] == array())

		$tab = array('ids' => array(), 'qte' => array());
		foreach ($_SESSION['panier'] as $panier => $qte) {

			$tab['ids'][]=$panier;
			$tab['qte'][]=$qte;

		}
		//Insertion des données de la vente en premier (création de la vente)
	    $sqlVente = 'INSERT INTO Commande (code_client, code_user, date_cmde, date_livraison, heure_livraison,numero_ticket) values ('.$_POST['client'].', '.$_SESSION["Auth"]->code_user.',"'. date("Y-m-d").'","'.$_POST['dateLivraison'].'","'.$_POST['time'].'","'.$_POST['numTicket'].'")';
	    $bdd->query($sqlVente);



		foreach ($_SESSION['panier'] as $id => $qte) {
			$sqlCod = 'select MAX(code_cmde) as max_code from commande';
			$codeVente = $bdd->query($sqlCod);
			$codeVente = $codeVente->fetch(PDO::FETCH_ASSOC);

			$sqlPrix = 'select PRIX_UNIT from pains where CODE_PAIN = '.$id;
			$prixVente = $bdd->query($sqlPrix);
			$prixVente = $prixVente->fetch(PDO::FETCH_ASSOC);

			if ($prixVente['PRIX_UNIT'] == null) {
				$prixVente['PRIX_UNIT'] = $prixVente['PRIX_UNIT'];
			}

			$sqlProduitVendu = $bdd-> prepare('INSERT INTO commande_pain (code_cmde, code_pain, quantite, prix_vente, total) values (:max_code, :pain, :quantite, :prix, :total)');
			$sqlProduitVendu->execute(
				array(
					'max_code'=>$codeVente["max_code"],
					'pain' => $id,
					'quantite' => $qte,
					'prix' => $prixVente['PRIX_UNIT'],
					'total' => $prixVente['PRIX_UNIT'] * $qte));
		}	    

		echo '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Commande enregistrée avec succès. 
    	</div>';

    	$_SESSION['panier'] = array();

	}
}
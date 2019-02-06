<?php
	
	$json = array('error' => true);
	if (isset($_GET['id'])){
		global $bdd;
		$id= $_GET['id'];
		$produit=$bdd->prepare('SELECT CODE_PAIN FROM pains WHERE CODE_PAIN=:id');
        $produit->execute(array('id'=>$_GET['id']));
        $produit=$produit->fetchAll();

        // si le produit est vide
        if (empty($produit)) {
        	$json['message'] = "Ce produit n'existe pas";
        }
        // on rajoute l'identifiant du produit au panier par la fonction add
        $panier->add($produit[0]->CODE_PAIN);
        // echo '<body onload ="alert(\'Produit ajoute avec succes avec succès\')">';
        
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=vente#ancorPanier">';
	} else {
		$json['message'] = 'Vous n\'avez pas selectionne de produit';
	}

	echo json_encode($json);
	?>
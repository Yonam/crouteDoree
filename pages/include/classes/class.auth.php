<?php class Auth{

	/**
	* Permet d'identifier un utilisateur et de garder ses infos dans une variable SESSION
	**/
	function login($d){
		global $bdd;
		$date = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
    $bdd->beginTransaction();

        $reload=$bdd->prepare('SELECT code_user,login FROM utilisateur WHERE login=:login AND mdp IS NULL');
        $reload->execute(array(':login'=>$d['Login']));
        $reload=$reload->fetchAll();

        $req=$bdd->prepare('SELECT code_user,login,mdp,utilisateur.code_privilege,privileges.libelle libelle FROM utilisateur LEFT JOIN privileges ON utilisateur.code_privilege=privileges.code_privilege WHERE login=:login AND mdp=:mdp');
        $req->execute(array(':login'=>$d['Login'], ':mdp'=>sha1($d['Pwd'])));
		$data=$req->fetchAll();
    $bdd->commit();


		if(count($reload)>0){
			foreach ($reload as $r) {
				$identif=$r->code_user;
			}
			echo '<body onload ="alert(\'Votre mot de passe doit etre renseigné \')">';

			//ecriture dans la table de logs de connexion

			/*$co = $bdd->prepare('INSERT INTO connexion(login, statut, ip, date_connexion, action) VALUES (:login, 0,:ip, :dated, "premiere connexion")');
			$co -> execute(array('ip'=>$ip,'dated'=>$date,'login'=>$d['Login']));*/

			echo '<meta http-equiv="refresh" content="0;URL=?page=reload_mdp_2&amp;id='.$identif.'">';
		}
		//print_r($data);
		if(count($data)>0){

			$date = date("Y-m-d H:i:s");
			if ($data[0]->connecte==1) {

			/*$co = $bdd->prepare('INSERT INTO connexion(login, statut, ip, date_connexion, action) VALUES (:login, 0,:ip, :dated, "Connexion multiple")');
			$co -> execute(array('ip'=>$ip,'dated'=>$date,'login'=>$d['Login']));*/
				echo '<body onload ="alert(\'Cet utilisateur est deja connecte au systeme \')">';
				return false;
			} else{

			/*$co = $bdd->prepare('INSERT INTO connexion(login, statut, ip, date_connexion, action) VALUES (:login, 1,:ip, :dated, "Connexion reussie")');
			$co -> execute(array('ip'=>$ip,'dated'=>$date,'login'=>$d['Login']));*/

			$_SESSION['Auth']=$data[0];
			$req = $bdd->prepare("UPDATE utilisateur SET connecte=1 WHERE CODE_USER = ". $_SESSION['Auth']->code_user);
                $req->execute();

          
			return true;
			}
		return false;
		}
	}	

	function vente($d){
		$tva = $_POST['tva']; 
		$achat =  $_POST['achat']; 
		$coef = $_POST['coef']; 
		$reduction = $_POST['reduction'];
		$vente = (((($tva * $achat)/100)*$coef))- $reduction;
		
			return $vente;
	}


	/**
	* Permet a l'utilisateur d'avoir une page forbidden en cas de non autorisation
	**/

	function allow($rang){
		global $bdd;
		$req=$bdd->prepare('SELECT level FROM privileges');
		$req->execute();
		$data=$req->fetchAll();
		$roles= array();
		foreach ($data as $d) {
			$roles[$d->level]=$d->level;
		}
		$this->user('level');
	}

	/**
	* Recupere des informations de l'utilisateur
	**/

	function user($field){
		if(isset($_SESSION['Auth']->slug)){
			
		}
	}

	function logout(){

		global $bdd;
		$date = date('Y-m-d H:i:s');
		$login = $_SESSION['Auth']->login;
		$ip = $_SERVER['REMOTE_ADDR'];

		/*$co = $bdd->prepare('INSERT INTO connexion(login, statut, ip, date_connexion, action) VALUES (:login, 1,:ip, :dated, "Deconnexion reussie")');
			$co -> execute(array('ip'=>$ip,'dated'=>$date,'login'=>$d['Login']));*/
		$req = $bdd->prepare("UPDATE utilisateur SET connecte=0 WHERE CODE_USER = ". $_SESSION['Auth']->code_user);
        $req->execute();

        header("Location:?page=");
	}

}

$Auth=new Auth();
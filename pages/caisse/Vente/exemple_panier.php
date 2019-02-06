<?php
// caddie_add.php... sert à ajouter un produit...
session_start();
if(isset($_GET['prod']) && isset($_GET['qtte']))
{
	// si on a spécifié un produit anisi qu'une quantité :
	// on vérifie si un panier existe déja...
	
	if(session_is_registered('panier') && is_array($panier))
	{
		
		// si le panier existe déja...
		$nbprod = count($panier);
		// on compte le nombre d'éléments dans le panier...
		for($i=0;$i<$nbprod;$i++)
		{
			// on fait une boucle qui va passer en revue chaque produit du panier
			// pour voir si le produit que l'on veut rajouter existe déja
			if($panier[$i]['prod'] == $_GET['prod'])
			{
				// le produit existe...
				$prodin = "true";
				// inscrit dans une variable que le produit existe...
				$prodline = $i;
				// et on précise aussi quel est son emplacment dans le caddie
			}
		}
		if(isset($prodin) && $prodin == "true")
		{
			// si le produit existe déja...
			// ...la quantité précédente est effacée...
			array_splice($panier,$prodline,1);
			// ...pour laisser place à celle qui le client vient de rajouter...
			array_push($panier,array("prod" => $_GET['prod'],"qtte" => $_GET['qtte']));
		}
		else
		{
			// sinon on rajoute le produit dans le panier tt simplement...
			array_push($panier,array("prod" => $_GET['prod'],"qtte" => $_GET['qtte']));
		}	
		header("Location: prof_commandes.php");
		// on peut faire une redirection vers une page qui va faire la liste de tous les produits...
	}
	else
	{
		// si le panier n'existe pas...
		session_register('panier');
		// on le créer...
		$panier = array ();
		// on rajoute le produit et la quantité...
		array_push($panier,array("prod" => $_GET['prod'],"qtte" => $_GET['qtte']));
		// le panier à été crée...
		header("Location: caddie_list.php");
		// on peut faire une redirection vers une page qui va faire la liste de tous les produits...
	}
}
else
{
	// les variable prod et qtte n'existent pas...
	header("Location: caddie_list.php");
}
?>
####################
<?php
// panier_update.php... ...sert à modifier la quantité d'un produit...
session_start();

if(isset($_GET['prod']) && isset($_GET['qtte']))
{
	// on vérifie qu'un produit et une 'nouvelle' quantité ont été spécifés...
	// si oui,
	if($_GET['qtte'] != 0)
	{
	// si la 'nouvelle' quantité est différente de zéro....
		$nbprod = count($panier);
		for($i=0;$i<$nbprod;$i++)
		{
		// on fait une boucle qui passe en revue chaque élément du panier...
			if ($panier[$i]['prod'] == $_GET['prod'])
			{
				// lorsque l'on tombe sur le produit à modifier,
				// on donne la valeur de la 'nouvelle' quantité à la quantité du produit dan sle panier...
				$panier[$i] = array("prod" => $_GET['prod'],"qtte" => $_GET['qtte']);
			}
		}
	}
	else
	{
		// si la 'nouvelle' quantité est égale à 0, ca revient au même que de supprimer...
		$nbprod = count($panier);
		for($i=0;$i<$nbprod;$i++)
		{
			// on fait une boucle qui passe en rebue tout le panier...
			if($panier[$i]['prod'] == $_GET['prod'])
			{
				// dès qu'on tombe sur la valeur à 'modifier'(ici en l'occurence il s'agit de supprmier ..)
				array_splice($panier,$i,1);
			}
		}
	}
	header("Location: caddie_list.php");
	// on redirige le client vers une page avec la liste de produits...
}
?>
############################
<?php
// caddie_del.php... ...sert à supprimer un élément du caddie...
session_start();

if(isset($_GET['prod']))
{
	// si un produit ets spécifié.;;
	$nbprod = count($panier);
	for($i=0;$i<$nbprod;$i++)
	{
		// on fait une boucle qui parcours le panier...
		if($panier[$i]['prod'] == $_GET['prod'])
		{
			// une fois arrivé au produit voulu, on le supprime...
			array_splice($panier,$i,1);
		}
	}
	header("Location: caddie_list.php");
	// on redirige le client vers une page qui liste les produits & les quantités...
}
?>
############################
// caddie_list.php ...sert à lister les produits du caddie
	if(session_is_registered('panier'))
	{
		if(is_array($panier))
		{
			$nbart = count($panier);
			if($nbart == 0)
			{
				echo "Votre panier est vide.<br>\n";
			}
			else
			{
				echo "Il y a des articles dans votre panier.<br><br>\n";
				echo "<table width=\"90%\" cellpadding=\"3\" align=\"center\" border=\"0\" cellspacing=\"0\"><tr bgcolor=\"#AE888C\"><td height=\"23\" align=\"center\" class=normalprof height=\"37\"><strong><font color=\"#FFFFFF\">Marques</font></strong></td><td align=\"center\" class=normalprof><strong><font color=\"#FFFFFF\">Nom du produit</font></strong></td><td align=\"center\" class=normalprof><strong><font color=\"#FFFFFF\">Quantité</font></strong></td><td align=\"center\" class=normalprof><strong><font color=\"#FFFFFF\">Modification</font></strong></td></tr>";
				for($i=0;$i<$nbart;$i++)
				{
					if(is_array($panier[$i]))
					{
						mysql_select_db($database_mysql_connect,$mysql_connect) or die(mysql_error());
						$getprodinfo = mysql_query("SELECT idproduit, marque, nom, prix, promoexiste, promotype, promored, promodatedebut, promodatefin FROM produits_tbl WHERE idproduit = '".$panier[$i]['prod']."'", $mysql_connect) or die(mysql_error());
						while($row_getprodinfo = mysql_fetch_array($getprodinfo,MYSQL_ASSOC))
						{
							$getmarque = mysql_query("SELECT marque FROM idmarques_tbl WHERE idmarque = '".$row_getprodinfo['marque']."'");
							$row_getmarque = mysql_fetch_assoc($getmarque);
							echo "<tr bgcolor=\"#FFFFFF\"><td align=\"center\" style=\"BORDER-BOTTOM: #AE888C 1px solid ; BORDER-LEFT: #AE888C 1px solid\" height=\"23\" class=normalprof>\n";
							echo "<form name=\"panier_update_form".$i."\" method=\"get\" action=\"prof_panier_update.php\">\n";
							echo $row_getmarque['marque']."</td><td align=\"center\" style=\"BORDER-BOTTOM: #AE888C 1px solid\" class=normalprof>".$row_getprodinfo['nom']."</td><td align=\"center\" style=\"BORDER-BOTTOM: #AE888C 1px solid\" class=normalprof> <input type=\"hidden\" name=\"prod\" value=\"".$panier[$i]['prod']."\">\n<input type=\"text\" size=\"2\" name=\"qtte\" value=\"".$panier[$i]['qtte']."\">  </td><td style=\"BORDER-BOTTOM: #AE888C 1px solid ; BORDER-RIGHT: #AE888C 1px solid\" class=normalprof align=\"center\" valign=\"bottom\"><a href=\"prof_panier_del.php?prod=".$panier[$i]['prod']."\">Retirer</a> || <a href=\"javascript:document.panier_update_form".$i.".submit()\">Modifier</a></form>\n</td></tr>";
							echo "</td></tr>";
						}					
					}
				}
				mysql_free_result($getprodinfo);
				echo "</table>";
			}
			echo "<div align=\"center\"><a href=\"prof_commandes_confirm.php\"><strong>Valider le panier</strong></a></div>";
			echo "<br><a href=\"prof_panier_clear.php\">Supprimer tous les produits du panier</a>";
		}
		else
		{
			echo "Votre panier est vide.<br>\n";
		}
	}
	else
	{
		echo "Votre panier est vide.<br>\n";
	}
	if(session_is_registered('continueachat'))
	{
		printf("<a href=\"%s\"Voir le dernier produit ajouté au caddie </a>",$continueachat);
	}
	else
	{
		echo "<br><a href=\"prof_marques.php\">? Nos marques</a><br><a href=\"prof_produits.php\">? Nos produits</a>";
	}

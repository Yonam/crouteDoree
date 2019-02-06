<?php
// ici sont les fonctions a utiliser sur le panier de vente

function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['DESIGNATION'] = array();
      $_SESSION['panier']['NB_VENDU'] = array();
      $_SESSION['panier']['PRIX_PRODUIT'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

function ajouterArticle($DESIGNATION,$NB_VENDU,$PRIX_PRODUIT){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($DESIGNATION,  $_SESSION['panier']['DESIGNATION']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['NB_VENDU'][$positionProduit] += $NB_VENDU ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['DESIGNATION'],$DESIGNATION);
         array_push( $_SESSION['panier']['NB_VENDU'],$NB_VENDU);
         array_push( $_SESSION['panier']['PRIX_PRODUIT'],$PRIX_PRODUIT);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function supprimerArticle($DESIGNATION){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['DESIGNATION'] = array();
      $tmp['qte_vendu'] = array();
      $tmp['PRIX_PRODUIT'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['DESIGNATION']); $i++)
      {
         if ($_SESSION['panier']['DESIGNATION'][$i] !== $DESIGNATION)
         {
            array_push( $tmp['DESIGNATION'],$_SESSION['panier']['DESIGNATION'][$i]);
            array_push( $tmp['qte_vendu'],$_SESSION['panier']['qte_vendu'][$i]);
            array_push( $tmp['PRIX_PRODUIT'],$_SESSION['panier']['PRIX_PRODUIT'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($DESIGNATION,$NB_VENDU){
   //Si le panier éxiste
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($NB_VENDU > 0)
      {
         //Recharche du produit dans le panier
         $positionProduit = array_search($DESIGNATION,  $_SESSION['panier']['DESIGNATION']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['NB_VENDU'][$positionProduit] = $NB_VENDU ;
         }
      }
      else
      supprimerArticle($DESIGNATION);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


/**
 * Montant total du panier
 */
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['DESIGNATION']); $i++)
   {
      $total += $_SESSION['panier']['NB_VENDU'][$i] * $_SESSION['panier']['PRIX_PRODUIT'][$i];
   }
   return $total;
}

/**
 * Permet de savoir si le panier est verrouillé
 * @return booleen
 */

function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

/**
 * Compte le nombre d'articles différents dans le panier
 */

function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['DESIGNATION']);
   else
   return 0;

}

function supprimePanier(){
   unset($_SESSION['panier']);
}

function retournerPanier()
{
   # code...
 return $_SESSION['panier'];
}
?>
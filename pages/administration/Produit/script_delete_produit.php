<?php
//including the database connection file
include "../../include/connexionDB.php";
 
//getting id of the data from url
$id =$_GET['id'];
 
//deleting the row from table


$query = $bdd->prepare("DELETE FROM produit WHERE code_produit=?");
$query->execute(array($id));
 
//redirecting to the display page (index.php in our case)

header('Location:../../../index.php?page=list_produit');

// echo '<body onload ="alert(\'Produit supprime avec succès\')">';
// echo $id;
// echo '<meta http-equiv="refresh" content="0;URL=">';
?>
<?php
/**
 * Created by PhpStorm.
 * User: Yoni
 * Date: 7/3/2017
 * Time: 1:45 AM
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=pharma', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$barre=isset($_POST['nom']) ? $_POST['nom'] : 'Insert error';

$req=$bdd->prepare('INSERT INTO motif(description) VALUES(:description)');
$req->bindValue(':description', $barre, PDO::PARAM_STR);
$req->execute();
echo 'Le produit a bien été ajouté !';

?>
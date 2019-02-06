<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=boulangerie', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

?>
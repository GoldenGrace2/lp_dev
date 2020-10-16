<?php

function connexionBD() {

	try 

	{
	$idConnexion=new PDO('mysql:host='.BDD_SERVER.';port=3306;
	dbname='.BDD_DATABASE.';charset=UTF8;', BDD_LOGIN, BDD_PASSWORD);

	$idConnexion->query('SET NAMES utf8;');
	return $idConnexion;

	} 

	catch (PDOException $e) {

		echo 'Erreur : '.$e->getMessage().'<br />'; die();

		}
	}
	function deconnexionBD(&$idConnexion) {
	$idConnexion=null;
	}
?>
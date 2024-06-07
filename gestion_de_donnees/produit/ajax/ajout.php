<?php 
require('../../../database.php');
require('../../controller/produit/produitController.php');
require '../../../vendor/autoload.php';
use Pro\TechlogNewVersion\Crud;

		
		$produit=$_POST['produit'];
		$qualite=$_POST['qualite'];
		$categories=$_POST['categories'];
		$tarif=$_POST['tarif'];
		






     $table='produit_deb';
$colonnes=['produit', 'qualite', 'tarif', 'id_cat'];
$valeurs=[$produit, $qualite, $tarif, $categories];

//$crud= new Crud;

     Crud::insertion($bdd, $table, $colonnes, $valeurs);


include('content.php');
		 ?>
		
		

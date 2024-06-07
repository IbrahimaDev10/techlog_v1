<?php 
require('../../../database.php');
require('../../controller/navire/navireController.php');
require '../../../vendor/autoload.php';
use Pro\TechlogNewVersion\Crud;

		$date=date('y-m-d');
		$navire=htmlspecialchars($_POST['navire_add_nav']);
		$type=htmlspecialchars($_POST['type_navire_add_nav']);
		$load_port=htmlspecialchars($_POST['load_port_add_nav']);
		$destination=htmlspecialchars($_POST['destination_add_nav']);
		
		$eta=htmlspecialchars($_POST['eta_add_nav']);
		$etb=htmlspecialchars($_POST['etb_add_nav']);
		$etd=htmlspecialchars($_POST['etd_add_nav']);
		$proprietaire=htmlspecialchars($_POST['proprietaire_add_nav']);

	//	print_r($_POST['client']);
		if(!empty($_POST['affreteur_add_nav'])){
		$chatered=$_POST['affreteur_add_nav'];
        $affreteur=implode("/ ",$chatered);
	}
	else{
		$affreteur='';
	}
	if(!empty($_POST['client_add_nav'])){
		$cli=$_POST['client_add_nav'];
		
		$client=implode("/ ",$cli);
	}
	else{
		$client='';
	}

		$num_manifeste=$_POST['num_manifeste_add_nav'];



     $table='navire_deb';
$colonnes=['navire', 'type', 'load_port', 'destination', 'eta', 'etb', 'etd',  'chatered', 'client_navire', 'num_manifeste', 'proprietaire'];
$valeurs=[$navire, $type, $load_port, $destination, $eta, $etb, $etd, $affreteur, $client, $num_manifeste, $proprietaire];

//$crud= new Crud;

     Crud::insertion($bdd, $table, $colonnes, $valeurs);

		
include('content.php');			
 ?>			
	

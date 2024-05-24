<?php 
include('../database.php');
if(isset($_POST['valider_cargo_plan1']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale="C1";
		$nom_ch=$_POST['nom_chargeur'];


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$nombre=$nombre_sac[$key];
	$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
		$poids=$nombre*$ps/1000;
		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$ps);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

	}
	}
	catch(Exception $e){

	}
	  $message="reussie";
	  header('location:auth2.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}


if(isset($_POST['valider_cargo_plan2']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale="C2";
		$nom_ch=$_POST['nom_chargeur'];


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$nombre=$nombre_sac[$key];
	$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
	
	
		$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$ps);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message2="reussie";
	  header('location:auth2.php?m='.$idm);

	}

	else{
		 $message2="Veuillez choisir un produit existant";
	}

	
}

if(isset($_POST['valider_cargo_plan3']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale="C3";
		$nom_ch=$_POST['nom_chargeur'];


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$nombre=$nombre_sac[$key];
	$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
	
	
		$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$ps);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message3="reussie";
	  header('location:auth2.php?m='.$idm);

	}

	else{
		 $message3="Veuillez choisir un produit existant";
	}

	
}


if(isset($_POST['valider_cargo_plan4']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale="C4";
		$nom_ch=$_POST['nom_chargeur'];


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$nombre=$nombre_sac[$key];
	$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
	
	
		$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$ps);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message4="reussie";
	  header('location:auth2.php?m='.$idm);

	}

	else{
		 $message4="Veuillez choisir un produit existant";
	}

	
}


if(isset($_POST['valider_cargo_plan5']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale="C5";
		$nom_ch=$_POST['nom_chargeur'];


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$nombre=$nombre_sac[$key];
	$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
	
	
		$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$ps);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message5="reussie";
	  header('location:auth2.php?m='.$idm);

	}

	else{
		 $message5="Veuillez choisir un produit existant";
	}

	
}



if(isset($_POST['valider_cp_vrac1']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale="C1";
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 


	foreach ($produit as $key=>$prod) {
	
	$tonnage=$tonnage[$key];
	//$ps=$poids_sac[$key];
	$nch=$nom_ch[$key];
	
	
		//$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	

	  $message="reussie";
	  header('location:auth2_cale.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}


if(isset($_POST['valider_cp_vrac2']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale="C2";
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$tonnage=$tonnage[$key];
	
	$nch=$nom_ch[$key];
	
	
		//$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message="reussie";
	  header('location:auth2_cale.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}

if(isset($_POST['valider_cp_vrac3']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale="C3";
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$tonnage=$tonnage[$key];
	
	$nch=$nom_ch[$key];
	
	
		//$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message="reussie";
	  header('location:auth2_cale.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}

if(isset($_POST['valider_cp_vrac4']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale="C4";
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$tonnage=$tonnage[$key];
	
	$nch=$nom_ch[$key];
	
	
		//$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message="reussie";
	  header('location:auth2_cale.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}

if(isset($_POST['valider_cp_vrac5']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['nom_chargeur'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale="C5";
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{


	foreach ($produit as $key=>$prod) {
	
	$tonnage=$tonnage[$key];
	
	$nch=$nom_ch[$key];
	
	
		//$poids=$nombre*$ps/1000;



		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$prod);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	}
	}
	catch(Exception $e){

	}
	  $message="reussie";
	  header('location:auth2_cale.php?m='.$idm);

	}

	else{
		 $message="Veuillez choisir un produit existant";
	}

	
}



?>
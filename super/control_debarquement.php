<?php 
include('../database.php');

$message="";
if(isset($_POST['valider_navire'])){
	if(!empty($_POST['navire']) and !empty($_POST['type_navire']) and !empty($_POST['load_port']) and !empty($_POST['destination']) and !empty($_POST['description']) and !empty($_POST['eta']) and !empty($_POST['etb']) and !empty($_POST['etd']) and !empty($_POST['client'])){
		$date=date('y-m-d');
		$navire=htmlspecialchars($_POST['navire']);
		$type=htmlspecialchars($_POST['type_navire']);
		$load=htmlspecialchars($_POST['load_port']);
		$dest=htmlspecialchars($_POST['destination']);
		$desc=htmlspecialchars($_POST['description']);
		$eta=htmlspecialchars($_POST['eta']);
		$etb=htmlspecialchars($_POST['etb']);
		$etd=htmlspecialchars($_POST['etd']);

		print_r($_POST['client']);
		
		$cli=$_POST['client'];
	
$a=implode("/ ",$cli);
echo $a;




	



$insertNavire = $bdd->prepare("INSERT INTO navire_deb(navire,type,load_port,destination,description,eta,etb,etd,client_navire) VALUES(?,?,?,?,?,?,?,?,?)");
$insertNavire->bindParam(1,$navire);
$insertNavire->bindParam(2,$type);
$insertNavire->bindParam(3,$load);
$insertNavire->bindParam(4,$dest);
$insertNavire->bindParam(5,$desc);
$insertNavire->bindParam(6,$eta);
$insertNavire->bindParam(7,$etb);
$insertNavire->bindParam(8,$etd);
$insertNavire->bindParam(9,$a);

$insertNavire->execute();
echo "reussi";

header('location:debarquement.php');



}
else{
	echo "veuillez remplir";
}
}




if(isset($_POST['valider_produit'])){
	if(!empty($_POST['produit']) and !empty($_POST['qualite'])){

	
		$qualite=$_POST['qualite'];
		$produit=$_POST['produit'];
		//$pr=array(1,2,3);
		//$array=array($produit,$qualite,$poids_sac);



	
		// code...
	

   $insertProduit= $bdd->prepare("INSERT INTO produit_deb(produit,qualite) VALUES(?,?)");
   try{
   //$insertProduit->beginTransaction();
   // foreach ($array as $key => $value) {
    	//foreach($value as $values)
    	// code...
    
   	
   	// code...
   
		//foreach ($qualite as $qual) {
			//foreach ($poids_sac as $ps) {
foreach ($produit as $key=>$prod) {
	$qual=$qualite[$key];
	
	// code...
   $insertProduit->bindParam(1,$prod);
    $insertProduit->bindParam(2,$qual);
    



$insertProduit->execute();
//$insertProduit->commit();
//}
//}

}
}
catch(Exception $e){
	//$insertProduit->rollback();*/
}

echo "reussi";

}
else{
	echo "veuillez remplir";
}
}





if(isset($_POST['valider_client'])){
	if(!empty($_POST['client'])){
		
		$client=$_POST['client'];
     $verify = $bdd->prepare("select client from client where client=?");
$verify->bindParam(1,$client);
$verify->execute();
$row=$verify->fetch();

if(!$row){
$insertClient = $bdd->prepare("INSERT INTO client(client) VALUES(?)");
$insertClient->bindParam(1,$client);

$insertClient->execute();

echo "reussi";
header('location:debarquement.php');
}
else{
	echo "Ce client existe déja";
}
}
else{
	echo "veuillez remplir";
}
}


if(isset($_POST['valider_transporteur'])){
	if(!empty($_POST['transporteur'])){
		
		$transporteur=$_POST['transporteur'];
$verify = $bdd->prepare("select nom from transporteur where nom=?");
$verify->bindParam(1,$transporteur);
$verify->execute();
$row=$verify->fetch();

if(!$row){
$insertClient = $bdd->prepare("INSERT INTO transporteur(nom) VALUES(?)");
$insertClient->bindParam(1,$transporteur);

$insertClient->execute();
echo "reussi";
header('location:debarquement.php');
}
else{
  echo "Le transporteur existe déja";

}
}



else{
	echo "veuillez remplir";
}
}


if(isset($_POST['valider_chauffeur'])){
	if(!empty($_POST['camions']) and !empty($_POST['chauffeur']) and!empty($_POST['permis']) and !empty($_POST['tel']) and !empty($_POST['transporteur'])){

		$camions=$_POST['camions'] ;
		
		$chauffeur=$_POST['chauffeur'];
		$permis=$_POST['permis'];
		$tel=$_POST['tel'];
		$transporteur=$_POST['transporteur'];


 
$insertChauf = $bdd->prepare("INSERT INTO chauffeur(num_camions,nom_chauffeur,n_permis,num_telephone,id_transporteur) VALUES(?,?,?,?,?)");
$insertChauf->bindParam(1,$camions);
$insertChauf->bindParam(2,$chauffeur);
$insertChauf->bindParam(3,$permis);
$insertChauf->bindParam(4,$tel);
$insertChauf->bindParam(5,$transporteur);

$insertChauf->execute();

echo "reussi";
header('location:debarquement.php');


}
else{
	echo "veuillez remplir";
}

}



if(isset($_POST['valider_dispatching'])){
	if(!empty($_POST['navire']) and !empty($_POST['produitDIS']) and !empty($_POST['nombre_sac']) and !empty($_POST['client']) and !empty($_POST['destination']) and !empty($_POST['BL'])){
		$nav=$_POST['navire'];
		$produit=$_POST['produitDIS'];
		$nombre_sac=$_POST['nombre_sac'];
		$client=$_POST['client'];
		$des=$_POST['destination'];
		$n_bl=$_POST['BL'];


	$selectPoids=$bdd->prepare("select poids from produit_deb where id=?");
	$selectPoids->bindParam(1,$produit);
	$selectPoids->execute();
	$chercheProduit=$selectPoids->fetch();
	if ($chercheProduit) {
		$poids=$nombre_sac*$chercheProduit['poids']/1000;

		 $insertDispatching= $bdd->prepare("INSERT INTO dispatching(clients,n_bl,nombre_sac,poids_kg,mangasin,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");

		$insertDispatching->bindParam(1,$client);
		 $insertDispatching->bindParam(2,$n_bl);
		 $insertDispatching->bindParam(3,$nombre_sac);
		 $insertDispatching->bindParam(4,$poids);
		 $insertDispatching->bindParam(5,$des);
		 $insertDispatching->bindParam(6,$produit);
		 $insertDispatching->bindParam(7,$nav);

		 $insertDispatching->execute();

		 echo "reussie";

	}
	else{
		echo "Veuillez choisir un produit existant";
	}
}
	else{
	echo "veuillez remplir";
}
}

if (isset($_POST['begin_declare'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SAC'){
		 	header('location:auth2.php?m='.$nav);
		 }
		 else {
		 	header('location:auth2_cale.php?m='.$nav);
		 }
		 
		 
		} catch (Exception $e) {
			
		}
	}
	else{
		$message=1;
		

	
}


}

 


	
if (isset($_POST['begin_dispat'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	//header('location:gestion_stock2.php?m='.$nav);
		 	header('location:dispatessai.php?m='.$nav);
		 }
		 else{
		 	header('location:ajout_dispatch_vrac.php?m='.$nav);
		 }
		} catch (Exception $e) {
			
		}
	}
	# code...
}


if(isset($_POST['valider_entrepot'])){
	if(!empty($_POST['entrepot']) and !empty($_POST['adresse']) and !empty($_POST['capacite']) and !empty($_POST['agrement'])){

		$entrepot=strtoupper($_POST['entrepot']);
		$cap=strtoupper($_POST['capacite']);
		$add=strtoupper($_POST['adresse']);
		$num=$_POST['agrement'];



 
$insertChauf = $bdd->prepare("INSERT INTO mangasin(mangasin,adresse,num_agrement,capacite) VALUES(?,?,?,?)");
$insertChauf->bindParam(1,$entrepot);
$insertChauf->bindParam(2,$add);
$insertChauf->bindParam(3,$num);
$insertChauf->bindParam(4,$cap);


$insertChauf->execute();

echo "reussi";
header('location:debarquement.php');


}
else{
	echo "veuillez remplir";
}

}



?>
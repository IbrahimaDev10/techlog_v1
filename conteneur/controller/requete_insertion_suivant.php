<?php 

function afficher_connaissement($bdd,$val){
	$connais=$bdd->prepare("SELECT id_bl from connaissement_conteneur where n_bl=?");
	$connais->bindParam(1,$val);
	$connais->execute();
	return $connais;
}

function produit($bdd){
	$produit=$bdd->query("SELECT produit,qualite,id from produit_deb");
	return $produit;
}

if(isset($_POST['ajouter'])){

	$num_conteneur=$_POST['num_conteneur'];
	$num_plomb=$_POST['num_plomb'];
	$type=$_POST['type'];
	$sac=$_POST['manifest'];
	$produit=$_POST['produit'];
	$poids_produit=$_POST['poids_produit'];
	
	$id_bl=$_POST['id_bl'];


    $insertProduit= $bdd->prepare("INSERT INTO numero_conteneur(num_conteneur,num_plomb,type,sacs,poids,id_connaissement_conteneur,id_produit,poids_kg) VALUES(?,?,?,?,?,?,?,?)");
   try{
   //$insertProduit->beginTransaction();
   // foreach ($array as $key => $value) {
    	//foreach($value as $values)
    	// code...
    
   	
   	// code...
   
		//foreach ($qualite as $qual) {
			//foreach ($poids_sac as $ps) {
foreach ($num_conteneur as $key=>$num) {
	$num_plom=$num_plomb[$key];
	
	$typ=$type[$key];
	$sa=$sac[$key];
	$produi=$produit[$key];
	$poids_produi=$poids_produit[$key];
	$poid=$sa*$poids_produi/1000;
	$id_b=$id_bl[$key];
	
	// code...
   $insertProduit->bindParam(1,$num);
    $insertProduit->bindParam(2,$num_plom);
    $insertProduit->bindParam(3,$typ);
    $insertProduit->bindParam(4,$sa);

    $insertProduit->bindParam(5,$poid);
    $insertProduit->bindParam(6,$id_b);
    $insertProduit->bindParam(7,$produi);
    $insertProduit->bindParam(8,$poids_produi);
    



$insertProduit->execute();
//$insertProduit->commit();
//}
//}

}
}
catch(Exception $e){
	//$insertProduit->rollback();*/
}


}
 ?>

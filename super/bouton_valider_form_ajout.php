<?php 

if (isset($_POST['begin_declare'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {
		 $Navdec->bindParam(1,$nav);
		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	header('location:ajout_declaration_chargement_sacherie.php?m='.$nav);
		 	$_GET['p']=0;
		 }
		 else if($find['type']=='VRAQUIER') {
		 	header('location:ajout_declaration_chargement_vrac.php?m='.$nav);
		 }
			else{
		$message=1;	
} 
		} catch (Exception $e) {
			
		}
	}
	else{
		header('location:debarquement.php?p='.$mes);
	}
}
if(isset($_POST['sub'])){
	header('location:debarquement.php');
}
if (isset($_POST['begin_dispat'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		
		 $Navdec->bindParam(1,$nav);
		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
	
		 	header('location:dispatessai.php?m='.$nav);
		 }
		 if($find['type']=='VRAQUIER'){
	
		 	header('location:dispatch_vrac.php?m='.$nav);
		 }
	
	
		}
	}
	



if (isset($_POST['begin_transit2'])) {
  if(!empty($_POST['navire'])){
    $nav=$_POST['navire'];
      header('location:ajout_transit_heritier.php?m='.$nav);
    }
    else{
      echo "VEUILLEZ CHOISIR UN NAVIRE";
    }
  }

if (isset($_POST['begin_transit'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
	//	$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
/*		try {
		 $Navdec->bindParam(1,$nav);
		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='VRAQUIER'){
		 	header('location:ajout_declaration.php?m='.$nav);
		 } */
		
		 	header('location:ajout_numero_declaration.php?m='.$nav);
		 }
		 else{
		 	header('location:debarquement.php');
		 }
		

}

if (isset($_POST['ajout_connaissement'])) {
  if(!empty($_POST['navires'])){
    $nav=$_POST['navires'];
      header('location:ajout_connaissement.php?m='.$nav);
    }
    else{
      echo "VEUILLEZ CHOISIR UN NAVIRE";
    }
  }



  if (isset($_POST['ajout_relache'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
	
		 	header('location:ajout_relache.php?m='.$nav);
	
	
		}
	}

	 if (isset($_POST['ajout_bon'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
	
		 	header('location:ajout_bon.php?m='.$nav);
	
	
		}
	}

	 if (isset($_POST['navire_debarquer']) AND $_SESSION['profil']=='superviseur') {
	//if(!empty($_POST['navires2'])){
		$nav=$_POST['navires2'];
	
		 	header('location:../transfert_vrac/tr_manifest?m='.$nav);
	
	
		//}
	}
    if (isset($_POST['navire_debarquer']) AND $_SESSION['profil']=='pont') {
	//if(!empty($_POST['navires2'])){
		$nav=$_POST['navires2'];
	
		 	header('location:../transfert_vrac_pont/tr_manifest');
	
	
		//}
	}
function navire($bdd){
  $les_nav=$bdd->query('SELECT id,navire,type from navire_deb');
  return $les_nav;
}
 ?>
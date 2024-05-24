<?php
include('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	if(empty($_SESSION['profil'])){
		header('location:../index.php');
	}
	
	echo $_SESSION['profil'];

	$navire=$bdd->query("select * from navire_deb order by id desc");
	$navire2=$bdd->query("select * from navire_deb order by id desc");
	$navire3=$bdd->query("select * from navire_deb order by id desc");
	$chercheNav = $bdd->query("select * from navire_deb order by id desc");
	$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
	$transNav = $bdd->query("select * from navire_deb order by id desc");

$chercheNavDIS = $bdd->query("select * from navire_deb order by id desc");
$client = $bdd->query("select * from client order by id desc");
$mangasin = $bdd->query("select * from mangasin order by id desc");
$NavireDispat = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");

$NavireDispatCli = $bdd->query("select * from navire_deb order by id desc");
$NavireDispatMang = $bdd->query("select * from navire_deb order by id desc");

$CalculNavire=$bdd->query("select count(navire) from navire_deb");
$CalculProduit=$bdd->query("select count(produit) from produit_deb");
$CalculClient=$bdd->query("select count(client) from client");
$CalculTransporteur=$bdd->query("select count(nom) from transporteur");

$LesNavires=$bdd->query("select *  from navire_deb ");
$LesProduits=$bdd->query("select * from produit_deb ");
$LesClients=$bdd->query("select * from client ");
$LesTransporteurs=$bdd->query("select * from transporteur ");


	$MesClients = $bdd->query("select * from client order by id desc");

$transp=$bdd->query("select * from transporteur order by id desc");

$mangasinier_affect=$bdd->query("select * from simar_user where profil='Mangasinier' ");



$new_mang=$bdd->query('select * from mangasin');
$mangasin_affect=$bdd->query('select * from mangasin');

	$message="";
	$mes=1;

$anneeclient=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");
$anneenavire=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");




$req=$bdd->query('select * from simar_user');
$count=$req->rowCount();




if (isset($_POST['inscription'])) {
    if(!empty($_POST['prenom']) and !empty($_POST['nom'])  and !empty($_POST['email'])  and !empty($_POST['telephone'] ) and !empty($_POST['profil'])  and !empty($_POST['mot_passe']) and !empty($_POST['retaper_mot_passe']) ){ 

    $prenom=htmlspecialchars(addslashes($_POST['prenom']));
    $nom=htmlspecialchars(addslashes($_POST['nom']));
    $email=htmlspecialchars(addslashes($_POST['email']));
    $telephone= htmlspecialchars(addslashes(str_replace(" ", "", $_POST['telephone'])));
    $profil=htmlspecialchars(addslashes($_POST['profil']));

$pass_compare1=$_POST['mot_passe'];
$pass_compare2=$_POST['retaper_mot_passe'];

    //$pass=htmlspecialchars($_POST['password']);
    $pass=htmlspecialchars(addslashes(password_hash($_POST['mot_passe'], PASSWORD_DEFAULT)));

    $select = $bdd->prepare("SELECT * FROM simar_user WHERE telephone =?");

$select->bindParam(1, $telephone);
$users=$select->execute();
$users = $select->fetch();

}

if(!$users)
{
if($pass_compare1==$pass_compare2){
$req1=$bdd->prepare('INSERT INTO simar_user(email,prenom,nom,telephone,profil,mot_de_passe) VALUES( ?,?,?,?,?,?)');
    $req1->bindParam(1, $email); 
    $req1->bindParam(2, $prenom);
    $req1->bindParam(3, $nom);
    $req1->bindParam(4, $telephone);
    $req1->bindParam(5, $profil);
    $req1->bindParam(6, $pass);   
    $req1->execute();
             echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
  <strong>l' ajout de l' utilisateur à réussi avec succés  !'</strong>'
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>"; 


$sujet = "Confirmation d'inscription";
    $message = "Bonjour " . $prenom . ",\n\nVotre inscription a été validée avec succès. Voici votre mot de passe : " . $_POST['mot_passe'] . "\n\nCordialement,\nVotre équipe.";
    $destinataire = $email;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Remplacez par l'hôte SMTP de votre fournisseur de messagerie
    $mail->SMTPAuth = true;
    $mail->Username = 'ibra099@simartechlog.com'; // Remplacez par votre adresse e-mail d'expéditeur
    $mail->Password = 'Techlog@2023'; // Remplacez par votre mot de passe d'e-mail
    $mail->SMTPSecure = 'SSL'; // Remplacez par 'ssl' si nécessaire
    $mail->Port = 465; // Le port SMTP de votre fournisseur de messagerie (remplacez-le si nécessaire)

    $mail->setFrom('ibra099@simartechlog.com', 'Ibrahima'); // Remplacez par votre adresse e-mail et votre nom
    $mail->addAddress($destinataire, $prenom); // Ajoute l'e-mail et le prénom de l'utilisateur destinataire

    $mail->Subject = $sujet;
    $mail->Body = $message;

    if ($mail->send()) {
        echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <strong>L'ajout de l'utilisateur a réussi avec succès ! Un e-mail de confirmation a été envoyé à l'adresse fournie.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <strong>L'ajout de l'utilisateur a réussi, mais l'e-mail de confirmation n'a pas pu être envoyé. Veuillez contacter l'administrateur.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    

    
}
else{
echo"<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
  <strong>les deux mot de passes ne sont pas identiques</strong>'
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}




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
		 if($find['type']=='SACHERIE'){
		 	header('location:auth3.php?m='.$nav);
		 	$_GET['p']=0;
		 	
		 }
		 else if($find['type']=='VRAQUIER') {
		 	header('location:auth2_cale.php?m='.$nav);
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
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	header('location:gestion_stock.php?m='.$nav);
		 }
		else if($find['type']=='VRAQUIER'){
		 	header('location:gestion_stock.php?m='.$nav);
		 }
		 else{
		 	header('location:gestion_stock_vrac.php?m='.$nav);
		 }
		} catch (Exception $e) {
			
		}
	}
	else{
		$message=1;

		

	
}
	# code...
}






if (isset($_POST['begin_transit'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='VRAQUIER'){
		 	header('location:auth_transit.php?m='.$nav);
		 }
		else  if($find['type']=='SACHERIE'){
		 	header('location:auth_transit.php?m='.$nav);
		 }
		 else{
		 	header('location:debarquement.php');
		 }
		} catch (Exception $e) {
			
		}
	}
	else{
		$message=1;

		

	
}
	# code...
}

	# code...
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

	//	print_r($_POST['client']);
		
		$cli=$_POST['client'];
	
$a=implode("/ ",$cli);
//echo $a;




	



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

echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("REUSSI","Navire ajouté avec success");';
                echo '}, 100);</script>';

      echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
   
//header('location:debarquement.php');



}
else{
			 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Verifier les informations   ","erreur");';
                echo '}, 100);</script>';

                 echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
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
		$code=$_POST['code'];
		$adresse=$_POST['adresse'];
		$tel=$_POST['telephone'];
		$email=$_POST['email'];
     $verify = $bdd->prepare("select client from client where client=?");
$verify->bindParam(1,$client);
$verify->execute();
$row=$verify->fetch();

if(!$row){
$insertClient = $bdd->prepare("INSERT INTO client(client,code_ppm_client,adresse_client,tel_client,email_client) VALUES(?,?,?,?,?)");
$insertClient->bindParam(1,$client);
$insertClient->bindParam(2,$code);
$insertClient->bindParam(3,$adresse);
$insertClient->bindParam(4,$tel);
$insertClient->bindParam(5,$email);

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

		$camions=str_replace(" ", "_", $_POST['camions']);
		
		$chauffeur=str_replace(" ", "_", $_POST['chauffeur']);
		$permis=str_replace(" ", "_", $_POST['permis']);
		$tel=str_replace(" ", "_", $_POST['tel']);
		$transporteur=str_replace(" ", "_", $_POST['transporteur']);


 
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


$navi=$bdd->query("select * from navire_deb");

if(isset($_POST['affecter'])){
	if(!empty($_POST['mangasinier']) and !empty($_POST['mangasin'])){
		$mangasinier=$_POST['mangasinier'];
		$mangasin=$_POST['mangasin'];
		$a=implode("/", $mangasin);
		$insert=$bdd->prepare("INSERT INTO affecter_mangasinier(id_mangasinier,id_mangasin_affecter) values(?,?) ");
		$insert->bindParam(1,$mangasinier);
		$insert->bindParam(2,$a);
		$insert->execute();
	}
	else{
		echo "veuillez choisir";
	}
}

?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>
	</head>
<body >

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 
 .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 #colRouge{
 	color: red;
 }
 #dateclient{
 	color:white;
 	background:blue;
 	font-size: 20px;
 	font-weight: bold;
 }
 #colmedium{
 	vertical-align: middle;
 }
 .details{
 	color: black;
 	font-weight: bold;
 }
 #front_details_clients{
 	color: white;
 	border: solid;
 	border-color: blue;
 	border-width: 8px;
 	background: rgb(57,223,215);
 }

.cel_clients{
	color: white;
	 float: right;
}
#celAlign{
	vertical-align: middle;
}

.logoo{
      border-radius: 50px;
       height: 150px;
        width: 200px;
       
        z-index: 2;
        text-align: center;

    }
    .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }

 .btn{
 	background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
       color:white;
       font-weight: bold;
}

#coltd{
	background: white;
}

</style>


  
  <!--Topbar -->
  <div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
				<li class="nav-item dropdown dropdown-list-toggle">
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					   <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">4</span>
					</a> 				 
					<div class="dropdown-menu dropdown-list">
						<div class="dropdown-header">Notifications</div>
						<div class="dropdown-list-content dropdown-list-icons">
							<div class="custome-list-notif"> 
							<a href="#" class="dropdown-item dropdown-item-unread">
								<div class="dropdown-item-icon bg-primary text-white">
								  <i class="fas fa-code"></i>
								</div>
								<div class="dropdown-item-desc">
									nouveau navire
								  <div class="time text-primary"> il y'a 3 Minutes</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="far fa-user"></i>
								</div>
								<div class="dropdown-item-desc">
								  greve niveau du port
								  <div class="time">il y'a 7 semaines</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-danger text-white">
								  <i class="fas fa-check"></i>
								</div>
								<div class="dropdown-item-desc">
									Storage has been cleared, now you can get back to work!
								  <div class="time">20 Hours Ago</div>
								</div>
							  </a>

						  
							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="fas fa-bell"></i>
								</div>
								<div class="dropdown-item-desc">
								    Welcome to Atrana Template, I hope you enjoy using this template!
								  <div class="time">Yesterday</div>
								</div>
							  </a>
 
							</div>
						</div>

						<div class="dropdown-footer text-center">
						  <a href="#">View All</a>
						</div>

					  
				  </li>
			 
				  <li class="nav-item dropdown">
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="../assets/images/avatar/avatar-1.png" alt="">
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>My Profile</span></a>
						<a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
						<hr class="dropdown-divider">
						<a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>My Profile</span></a>
					</ul>
				  </li>
			</ul>
		</div>
	</div>

	<!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" >
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-4"><img style="width: 150px; height: 150px;  border-radius: 50px; color: white;" src="../assets/images/mylogo.ico"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
		<?php include('page.php'); ?>
				</li>
		
 <li><a href="" data-bs-toggle="modal" data-bs-target="#admin" >Ajouter nouveau utilisateur</a></li>
  <li><a href="" data-bs-toggle="modal" data-bs-target="#affecter" >AFFECTER UN MANGASINIER</a></li>
						<li><a href=""  >Ajouter nouveau produit</a></li>
 

				
     <li>
                    <a href="#">
						<i class='bx bx-data icon bx-4x' style="color: yellow;" ></i> 
						MES DONNEES
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">


                       <li><button  class="btn text-white "   id="btnNavire" onclick="visible_navire()"> NAVIRES</button></li>
						<li><button  class="btn text-white "  onclick="visible_produit()"> PRODUITS</button></li>
						<li><button  class="btn text-white "  onclick="visible_client()"> CLIENTS</button></li>
						<li><button  class="btn text-white "  onclick="visible_entrepots()"> ENTREPOTS</button></li>
						<li><button  class="btn text-white "  onclick="visible_transporteur()"> TRANSPORTEURS</button></li>
						<li><button  class="btn text-white "  onclick="visible_chauffeur()"> CHAUFFEURS</button></li>
						                        
                    </ul>
                </li>                              
                                      




				
     				               



               

				<!-- Divider-->
                
  

 




               
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/bg_page.jpg');  background-size: cover;
   background-position: center center;
  background-repeat: no-repeat;  margin: 0px; border: none; border-radius: 0px; z-index: -5; ">
		<div class="container-fluid dashboard">
			<div class="content-header">
<div class="row">
				<?php 
          if(isset($_GET['p'])){
          	if($_GET['p']==1){
          	
	

			 	                echo '<div style="font-size:70px;" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <strong>Veuillez choisir un navire</strong>
  <form method="POST">
  <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close" name="sub"></button>
  
  </form>
</div>';

}
}



			 ?>
			

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); border: solid; border-color: white; border-width: 10px; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-inbox icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white;">NAVIRES</h6>
									<?php while($cal=$CalculNavire->fetch()){ ?>
									<h3 style="color:white;"><a><?php echo $cal['count(navire)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: rgb(0,141,202); border: solid; border-color: white; border-width: 10px;">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<h6  style="font-weight: bold; color: white;">PRODUITS</h6>
									<?php while($cal=$CalculProduit->fetch()){ ?>
									<h3 style="color:white;"><a><?php echo $cal['count(produit)']; ?></a></h3>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: rgb(0,141,202); border: solid; border-color: white; border-width: 10px; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-chart-bar  icon-home bg-info text-light"></i>
								</div>
								<div class="col-8">
									<h6  style="font-weight: bold; color: white;">CLIENTS</h6>
									<?php while($cal=$CalculClient->fetch()){ ?>
									<h3 style=" color: white;"><a><?php echo $cal['count(client)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); border: solid; border-color: white; border-width: 7px;">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white;">TRANSPORTS</h6>
									<?php while($cal=$CalculTransporteur->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; "><a><?php echo $cal['count(nom)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>
		<br><br><br><br>


<center>
<div  id="calnavire"  style="display: none;"  class="col-md-12">
	<form>
		<select name="datenavire" id="datenavire" style="margin-top: 10px;" onchange="func_date_navire()">
			<option selected="">ANNEE</option>
			<?php while($annee=$anneenavire->fetch()){ ?>
				<option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
			<?php } ?>
		</select>


	</form>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="hnavire text-white" >Mes navires</h1>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                 <table class='table table-hover table-bordered table-striped'  border='5' style="  border-color: black;" >
                   <thead> 
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >NAVIRE</th>
                       
                           <th style="border-color:white;" scope="col" >ACOSTAGE</th>
                            <th style="border-color:white;" scope="col" >MANIFESTE</th>
                           <th style="border-color:white;" scope="col" >CLIENTS</th>

                            
                               
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                               
                                  
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $navi->fetch()){
      $calculLigne=$bdd->prepare("select count(navire) from navire_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $nav_produit = $bdd->prepare("select  n.*, p.* from navire_deb as n
inner join produit_manifest as p on n.id=p.id_navire where n.id=? ");
       $nav_produit->bindParam(1,$row['id']);
       $nav_produit->execute();
     // $navid= $nav_produit->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(navire)']; ?></span> </td>
                         <td > <?php echo  $row['navire']?></td>
                                
                              <td ><?php echo $row['eta']; ?> </td>
                             
                            <td  ><?php while($navid= $nav_produit->fetch()){ echo $navid['produit_navire']; ?>:<span style="color: red;"><?php echo $navid['poids_manifest']; ?>T</span><br>  <?php } ?> </td> 
                          
                      
                      	 <td> <?php echo $row['client_navire']; ?></td>
                             <td >

   <div class="modal fade" id="vue_details_navire<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-left: 0px;">
        <div class="modal-header" style="background: blue;">
          <h5 class="modal-title" id="myModalLabel" style="color: white;">DETAILS DU NAVIRE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align: left;">
          
         <h5 class="details" id="front_details_clients" >TYPE: <span class="cel_clients" >	 <?php echo $row['type'] ?></span></h5> 
          <h5 class="details" id="front_details_clients" > LOAD PORT: <span class="cel_clients" >	 <?php echo $row['load_port'] ?></span></h5> 
           <h5 class="details" id="front_details_clients" > DESTINATION: <span class="cel_clients" >	 <?php echo $row['destination'] ?></span></h5>
            <h5 class="details" id="front_details_clients" > DESCRIPTION: <span class="cel_clients" >	 <?php echo $row['description'] ?></span></h5>
        <h5 class="details" id="front_details_clients" > ETA: <span class="cel_clients" >	 <?php echo $row['eta'] ?></span></h5>
        <h5 id="front_details_clients"> ETB: <span class="cel_clients"> <?php echo $row['etb'] ?></span></h5>
        <h5 id="front_details_clients">ETD: <span class="cel_clients" ><?php echo $row['etd'] ?></span></h5>
          	
          	
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>


                          	<button  id="<?php echo $row['id'] ?>" name="deleteNavire" type="submit"  class="fabtn1 " onclick="deleteNavire(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify"  href="modifier_navire.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
                          	<button  id="<?php echo $row['id'] ?>" name="details_nav" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_navire<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </button></td>    
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>
</center>
 <br><br><br><br>


 <div  id="calproduits" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 class="hproduit" style="color: white; background:  rgb(0,141,202);" >Mes produits</h1>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col" > </th>
                        <th style="border-color:white;" scope="col" >PRODUIT</th>
                        <th style="border-color:white;" scope="col" >POIDS</th>
                        <th style="border-color:white;" scope="col" > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesProduits->fetch()){

                            $calculLigne=$bdd->prepare("select count(produit) from produit_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(dis.poids_t),dis.id_produit, p.* from produit_deb as p
        inner join dispatching as dis on p.id=dis.id_produit
        
       
                        	where p.id=?  ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();
              	
                                     ?>
                          <tr  style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(produit)']; ?></span> </td>
       
                                 <td > <?php echo $row['produit']   ; ?> </td>
                                 <td><span id="colRouge"><?php if(!empty($calT['sum(dis.poids_t)'])){ echo $calT['sum(dis.poids_t)']. ' T'; } ?> </span></td> 
                                 <td  >
                          	<button  id="<?php echo $row['id'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify"  href="modifier_produit.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
     </div>
  </div>


 <div  id="calclient" class="col-md-12" style="display: none;">
 		
  <div class="card">
    <div class="card-header">

      <center>
        <h1 class="hclient text-white" style=" background:  rgb(0,141,202);"  >Mes clients</h1>
            	<form>
		<select name="dateclient" id="dateclient" style="margin-top: 10px;" onchange="func_date_client()">
			<option selected="">ANNEE</option>
			<?php while($annee=$anneeclient->fetch()){ ?>
				<option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
			<?php } ?>
		</select>


	</form>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr id="colmedium" style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	 <th style="border-color:white;" scope="col" ></th>
                        
                        <th style="border-color:white;" scope="col" >CLIENT</th>
                        <th style="border-color:white;" scope="col" >PRODUIT</th>
                       
                         <th style="border-color:white;" scope="col" >TOTAUX</th>
                          
                         	<th style="display: none;">ziod</th>
                         	<th style="display: none;">ziod</th>
                         
                     
                        <th style="border-color:white;" scope="col" >ACTIONS</th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesClients->fetch()){
                  $calculLigne=$bdd->prepare("select count(client) from client where id<=? ");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

             $cli=$bdd->prepare("select cli.*,dis.id_client,dis.id_produit, p.*,
                     c.* 
                        	from client as cli inner join dispatching as dis on  dis.id_client=cli.id
                        	inner join produit_deb as p on p.id=dis.id_produit
                        	inner join categories as c on c.id_categories=p.id_cat  
                        	where cli.id=? group by p.id_cat");
      $cli->bindParam(1,$row['id']);
      $cli->execute();

      $calculTonne=$bdd->prepare("select cli.*, sum(dis.poids_t),dis.id_client, p.* from client as cli
        inner join dispatching as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
       
                        	where cli.id=? group by p.id_cat ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();


      $calculCat=$bdd->prepare("select cli.*, sum(dis.poids_t),dis.id_client, p.*,c.*,count(c.nom_categories), count(p.id_cat) as tot
       from client as cli 
        inner join dispatching as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
        inner join categories as c on c.id_categories=p.id_cat 
       
                        	where cli.id=?   ");
      $calculCat->bindParam(1,$row['id']);
      $calculCat->execute();
      //$cl=$cli->fetch();              	
       $total=$calculCat->fetch();                              ?>
                          <tr  style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(client)']; ?></span> </td>
                          	<td >	<?php echo  $row['client']; ?> </td>
                          	
                          	 
                          	
                          	<td >
                          		<?php 
                          	 ?>	
                          		<?php while($cl=$cli->fetch()){  echo  $cl['nom_categories'];?> <br><br>  <?php } ?> <span style="background: red;color: white;"><?php  
                          		echo "TOTAL";
                           ?> </span>   </td>
                          	
                          	<td id="colRouge">	<?php while($clTonne=$calculTonne->fetch()){  echo  number_format($clTonne['sum(dis.poids_t)'], 3,',',' '). ' T <br><br>'; } ?> 
                          		<?php  echo  $total['sum(dis.poids_t)'];
                           ?>  T </td>

<div class="modal fade" id="vue_details_client<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-left: 0px;">
        <div class="modal-header" style="background: blue;">
          <h5 class="modal-title" id="myModalLabel" style="color: white;">DETAILS CLIENT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align: left;">
          
          
        <h5 class="details" id="front_details_clients" > CODE PPM: <span class="cel_clients" >	 <?php echo $row['code_ppm_client'] ?></span></h5>
        <h5 id="front_details_clients"> ADRESSE: <span class="cel_clients"> <?php echo $row['adresse_client'] ?></span></h5>
        <h5 id="front_details_clients">TELEPHONE: <span class="cel_clients" ><?php echo $row['tel_client'] ?></span></h5>
         <h5 id="front_details_clients">EMAIL: <span class="cel_clients" ><?php echo $row['email_client'] ?></span></h5>
          	
          	
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>


                          <td>
                          	<button  id="<?php echo $row['id'] ?>" name="deletecli" type="submit"  class="fabtn1 " onclick="deleteClient(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify"  href="modifier_client.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
      <button  id="<?php echo $row['id'] ?>" name="details" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_client<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </button></td>         
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
     </div>
  </div>






 <div  id="caltransporteur" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >Mes TRANSPORTEURS</h1>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >TRANSPORTEUR</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesTransporteurs->fetch()){
              $calculLigne=$bdd->prepare("select count(nom) from transporteur where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5'>
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(nom)']; ?></span> </td>
                                 <td ><?php echo $row['nom']; ?></td>
                               <td  >
                          	<button  id="<?php echo $row['id'] ?>" name="deleteNavi" type="submit"  class="fabtn1 " onclick="deleteNavi(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify"  href="modifier_transporteur.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>          
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
     </div>
  </div>


  <div  id="calEntrepots" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 class="hproduit" style="color: white; background:  rgb(0,141,202);" >Mes produits</h1>
    </center>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 100%;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > </th>
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >NOM ENTREPOT </th>
                        <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >N AGREMENT</th>
                        <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >SUPERFICIE (m²)</th>
                        <th id="celAlign"  colspan="2" style="border-color:white;" scope="col" > CAPACITE DE STOCKAGE </th>
                        <th id="celAlign" colspan="2" style="border-color:white;" scope="col" > QUANTITE STOCKEE </th>
                        <th id="celAlign" colspan="2" style="border-color:white;" scope="col" > ESPACE A STOCKER </th>
                         <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > ACTIONS </th>
                               </tr>
                               <tr  style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center; vertical-align: middle;" border='5'>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>

                               </tr>
                                  </thead>
                    <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $new_mang->fetch()){

                            $calculLigne=$bdd->prepare("select count(mangasin) from mangasin where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(rm.poids),rm.id_destination, mg.* from register_manifeste as rm
        inner join mangasin as mg on rm.id_destination=mg.id
        
       
                        	where mg.id=?  ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();

// ICI ON CALCUL LE STOCKAGE EN SAC MANGASINS
       $sac_stocker=$calT['sum(rm.poids)']*1000/50;

       // ICI ON CALCUL LES RESTANTS MANGASINS
       $poids_restant=$row['poids_stock']-$calT['sum(rm.poids)'];
       $sac_restant=$row['sac_stock']-$calT['sum(rm.poids)']*1000/50;

              	
                                     ?>
                          <tr  style="text-align:center; vertical-align: middle;" border='5' id="<?php echo $row['id'] ?>">
                          	<td style="vertical-align: middle;" ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(mangasin)']; ?></span> </td>
          <td style="vertical-align: middle;" > <?php echo $row['mangasin']   ; ?> </td>
                                 <td style="vertical-align: middle;" > <?php echo $row['num_agrement']   ; ?> </td>
        <td style="vertical-align: middle;" > <?php echo $row['superficie']; ?> </td>
         <td style="vertical-align: middle;" > <?php echo $row['sac_stock']; ?> </td>
       <td style="vertical-align: middle;" > <?php echo $row['poids_stock']; ?> </td>
       <td style="vertical-align: middle;"> <?php echo number_format($sac_stocker, 0,',',' '); ?></td> 
       <td style="vertical-align: middle;"> <?php echo number_format($calT['sum(rm.poids)'], 3,',',' '); ?></td> 
                                 
       <td style="vertical-align: middle;"> <?php echo number_format($sac_restant, 0,',',' '); ?></td>
       <td style="vertical-align: middle;"> <?php echo number_format($poids_restant, 3,',',' '); ?></td> 
                                 
                                 <td style="vertical-align: middle;"  >
                          	<button style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg" type="submit"  class="fabtn1 " onclick="deleteMg(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a style="float:center;" class="fabtn" type="" name="modify"  href="modifier_Mg.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
<button style="float:right;"  id="<?php echo $row['id'] ?>" name="details" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_client<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </button></td>    
                              </tr>
                      <?php } ?>	
                    </tbody>

                </table>
                 </center>
             </div>
          </div>
     </div>
  </div>



  


	



<div class="modal fade" id="navires" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout navire</h1></center>
        <button type="button" class="btn-close " style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form  method="POST">

      

  
      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="navire" name="navire">

                           <select name="type_navire" class="mb-3 " style="width:50%">
                            <option value="">type de chargement</option>
                          
                            <option value="SACHERIE"> EN SACS</option>
                            <option value="VRAQUIER"> EN VRAC</option>
                             </select>
                            


  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="LOAD PORT" name="load_port">
  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="DESTINATION" name="destination">

  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="PRODUIT(S)" name="description">

	<label for="exampleFormControlInput1" class="form-label">ETA</label>
  
  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="ETA" name="eta">
  
	<label for="exampleFormControlInput1" class="form-label">ETB</label>
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETB" name="etb">

<label for="exampleFormControlInput1" class="form-label">ETD</label>  
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETD" name="etd">



<fieldset><legend>choix du client</legend>
	
<?php while ($clients=$MesClients->fetch()) {
	// code...
 ?>

  <input type="Checkbox"  style="height: 20px;width: 10%; font-size: 30px;  background-color: none;" id="" placeholder="client" name="client[]"  value="<?php echo $clients['client'];	 ?>"><?php 	echo  $clients['client']; ?>
<?php } ?>
  </fieldset>                              
 
         <center>
      <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_navire">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="produits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout produit</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form  method="POST">

      

  
                           
                           

  <div class="form-group position-relative has-icon-left mb-4" id="lesinputs">
                                                                               
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>                       
                      
                       <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_produit">valider</button>
					</form>

				</div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>


		
	
  <div class="modal fade"  id="admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT UTILISATEUR</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="EMAIL" name="email"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="PRENOM" name="prenom"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="NOM" name="nom"><br>
  <input type="text"  class="form-control"  id="telephoneInput" placeholder="TELEPHONE" name="telephone" oninput="formatTelephone()" required><br>
  

    <select name="profil" class="form-control  " >
                            <option value="">profil</option>
                            <option value="Admin">Administrateur</option>
                            <option value="Mangasinier">Mangasinier</option>
                            <option value="Pointeur">Pointeur_manifest</option>
                            <option value="superviseur">superviseur</option>
                           	
                           </select><br>
                            
 <input type="password" class="form-control"  id="exampleFormControlInput1" placeholder="MOT DE PASSE " name="mot_passe"><br>
 <input type="password" class="form-control"  id="exampleFormControlInput1" placeholder="RETAPER MOT DE PASSE " name="retaper_mot_passe"><br>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="inscription">valider</button>
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>
	</div>

	


<div class="modal fade"  id="affecter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AFFECTER MANGASINIER</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

      
  
  

    <select name="mangasinier" class="form-control  " >
                            <option value="">mangasinier</option>
    <?php while($mang=$mangasinier_affect->fetch()){ ?>                        
                            <option value=<?php echo $mang['id_sim_user']; ?>> <?php echo $mang['prenom'].' '.$mang['nom']; ?></option>
                          <?php } ?>
                           	
                           </select><br>
                            
 <fieldset style=" "><legend>CHOISIR LES MANGASINS</legend>
	
<?php while ($mangasin=$mangasin_affect->fetch()) {
	// code...
 ?>

  <?php 	echo  $mangasin['mangasin']; ?><input type="Checkbox"  style="height: 15px; margin-right: 10px; font-size: 30px;  background-color: none;" id=""  name="mangasin[]"  value="<?php echo $mangasin['id'];	 ?>"><span>	 </span>
<?php } ?>
  </fieldset> <br>	                             
 



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="affecter">valider</button>
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>
	</div>






<div class="modal fade" id="client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter client</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> CLIENT</a>  
					</div>
					</div>
      	<form  method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="client" name="client"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="CODE PPM" name="code"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="ADRESSE" name="adresse"><br>
  <input type="text"  class="form-control"  id="telephoneInput" placeholder="TELEPHONE" name="telephone" oninput="formatTelephone()" required><br>
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="EMAIL" name="email"><br>
</div>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_client">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="chauffeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter transporteur</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> TRANSPORTEUR</a>  
					</div>
					</div>
      	<form  method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="chauffeur" name="chauffeur">

      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="camions" name="camions">

      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="numero permis" name="permis">

   <label>vous pouvez entrer deux numero séparés par un /</label>   
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="tel1 / tel2" name="tel">



            <select id="" name="transporteur" class="" style="width: 50%; height: 40px; font-size: 100%"  >
                   <option value="">transporteur</option>
                        <?php 
                        while ($tr=$transp->fetch()) {
                           	?>
             <option value="<?= $tr['id']; ?>"><?php echo $tr['nom']; ?> </option>	
                           <?php } ?> 
                       </select>






         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_chauffeur">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="transporteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter transporteur</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> TRANSPORTEUR</a>  
					</div>
					</div>
      	<form  method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="transporteur" name="transporteur">
</div>




         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_transporteur">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="entrepot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Entrepot</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> Entrepot</a>  
					</div>
					</div>
      	<form  method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="entrepot" name="entrepot">
</div>
  <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="adresse" name="adresse">
</div>
  <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="capacite" name="capacite">
</div>

  <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="numero d'agrement" name="agrement">
</div>




         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_entrepot">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>







      

  


		   </div>
		</div>
	</div>


	<!-- Footer -->				
	<footer>
		<div class="footer">
			<div class="float-start">
				<p>2023 &copy; Ibradev</p>
			</div>
				<div class="float-end">
					<p>Created with 
						<span class="text-danger">
							<i class="fa fa-heart"></i> by 
							<a href="https://www.facebook.com/andreew.co.id/" class="author-footer">Ibradev</a>
						</span> 
					</p>
			</div>
		</div>
	</footer>


	<!-- Preloader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<!-- Loader -->
	<div class="loader-overlay"></div>

	        <?php 
if(isset($_GET['z'])){

 ?>
 <div class="flash-data" data-flashdata=<?=$_GET['z']; ?>></div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- General JS Scripts -->
	<script src="../assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="../assets/modules/jquery/jquery.min.js"></script>
	<script src="../assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="../assets/modules/apexcharts/apexcharts.js"></script>
	<script src="../assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>



  






  



	<script type="text/javascript">
		function imprimer(dname){
			var printContents=document.getElementById(dname).innerHTML;
			var originalContents=document.body.innerHTML;
			document.body.innerHTML=printContents;
			window.print();
			document.body.innerHTML=originalContents;


		}
	</script>

	<script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function go(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_cargo_plan').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectDeclaration_chargement.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }
        </script>



<script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function go2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_cale').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaCale.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta');
                idnaviresta = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta="+idnaviresta);
            }
        </script>






<script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function go3(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_var').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaVar.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta2');
                idnaviresta2 = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta2="+idnaviresta2);
            }
        </script>



        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goDC(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('selnavire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }
        </script>



        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goDIS(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produitDIS').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduitDIS.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('selnavireDIS');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }
        </script>

        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function func_date_client(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('calclient').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_date_client.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('dateclient');
                iddate_client = sel.options[sel.selectedIndex].value;
                xhr.send("idDate_client="+iddate_client);
            }
        </script>

        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function func_date_navire(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lesele = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('calnavire').innerHTML = lesele;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_date_navire.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('datenavire');
                iddate_navire = sel.options[sel.selectedIndex].value;
                xhr.send("idDate_navire="+iddate_navire);
            }
        </script>

<script>
  function visible_navire() {
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    
   
    
    
    if (navire.style.display === "none") {
      navire.style.display = "table";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
       navire.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      navire.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_produit() {
    var produit = document.getElementById("calproduits");
   var navire = document.getElementById("calnavire");
   var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
var chauffeur = document.getElementById("calchauffeur");
 var entrepot = document.getElementById("calEntrepots");

    
    if (produit.style.display === "none") {
      produit.style.display = "table";
      navire.style.display = "none";
      client.style.display = "none";
      produit.scrollIntoView({ behavior: 'smooth' });
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
     
    } else {
      produit.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_client() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    
    
    if (client.style.display === "none") {
      client.style.display = "table";
       client.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       transporteur.style.display = "none";
       chauffeur.style.display = "none";
       entrepot.style.display = "none";


    } else {
      client.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_transporteur() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");

    
    
    if (transporteur.style.display === "none") {
      transporteur.style.display = "table";
       transporteur.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       chauffeur.style.display = "none";
       entrepot.style.display = "none";


    } else {
      transporteur.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_chauffeur() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    
    
    if (chauffeur.style.display === "none") {
      chauffeur.style.display = "table";
       chauffeur.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       transporteur.style.display = "none";
       entrepot.style.display = "none";


    } else {
      chauffeur.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_entrepots() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    
    
    if (entrepot.style.display === "none") {
      entrepot.style.display = "table";
       entrepot.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       transporteur.style.display = "none";
       chauffeur.style.display = "none";


    } else {
      entrepot.style.display = "none";
     
    }
    
    
  }
</script>




 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteProduit(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_produit.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }

 


 </script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteClient(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_client.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  function deleteChauffeur(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_chauffeur.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 	<script type="text/javascript">
  function deleteNavire(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_navire.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
function formatTelephone() {
  var telephoneInput = document.getElementById('telephoneInput');
  var telephone = telephoneInput.value;

  // Supprimer tous les espaces de la chaîne
  var telephoneSansEspaces = telephone.replace(/\s/g, '');

  // Formater le numéro de téléphone avec les espaces
  var telephoneFormate = telephoneSansEspaces.replace(/(\d{2})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');

  // Mettre à jour la valeur de l'input avec le numéro de téléphone formaté
  telephoneInput.value = telephoneFormate;
}
</script>


<script>
   function setModalContent(buttonId) {
  var modal = document.getElementById("vue_details_client");
  var buttonIdInput = modal.querySelector("#buttonIdInput");
  var codePpmClient = modal.querySelector("#code_ppm_client");
  var adresseClient = modal.querySelector("#adresse_client");
  var telClient = modal.querySelector("#tel_client");

  // Mettre à jour les valeurs avec les données correspondantes
  buttonIdInput.
  buttonIdInput
value = buttonId;
  codePpmClient.textContent = "<?php echo $row['code_ppm_client'] ?>";
  adresseClient.textContent = "<?php echo $row['adresse_client'] ?>";
  telClient.textContent = "<?php echo $row['tel_client'] ?>";
}
  </script>








 </body>
</html>

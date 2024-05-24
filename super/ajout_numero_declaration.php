<?php
require('control_dc.php');

$idm=$_GET['m'];

include('bouton_valider_form_ajout.php');

$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");
$transNav = $bdd->query("select * from navire_deb order by id desc");

if(isset($_POST['ajout_con']) and isset($_GET['m'])){
	if(!empty($_POST['num_declaration'])){
		//$nav=$_POST['navire'];
		
		
		$num_declaration=$_POST['num_declaration'];
		$des_douaniere=$_POST['des_douaniere'];
		$statut=$_POST['statut_douanier'];
	//	$con=$_POST['con'];
		$poids=$_POST['poids'];
		$id_bl=$_POST['id_bl'];
		

     
	
			 $insertDispat= $bdd->prepare("INSERT INTO declaration(destination_douane,num_declaration,poids,statut_douanier,id_bl) VALUES(?,?,?,?,?)");
			 

		 $insertDispat->bindParam(1,$des_douaniere);
		 $insertDispat->bindParam(2,$num_declaration);
		 $insertDispat->bindParam(3,$poids);
		 $insertDispat->bindParam(4,$statut);
		 $insertDispat->bindParam(5,$id_bl);
		

		 $insertDispat->execute();

	
	
	  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("GOOD","<i class="fas fa-check-circle"></i>");';
                echo '}, 100);</script>';

     
	  //header('location:gestion_stock2.php?m='.$idm);

	}

	else{
		 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Verifier les informations   ","erreur");';
                echo '}, 100);</script>';
   
	}

	
}

$mes_declarations=$bdd->prepare("SELECT d.*,dis.*,m.mangasin, nc.id_navire FROM declaration as d 
inner join dispats as dis on dis.id_dis=d.id_bl
inner join mangasin as m on m.id=dis.id_mangasin
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
where nc.id_navire=?");
$mes_declarations->bindParam(1,$idm);
$mes_declarations->execute();


$type_nav=$bdd->prepare('SELECT type from navire_deb where id=?');
$type_nav->bindParam(1,$idm);
$type_nav->execute();
$type_navs=$type_nav->fetch();

if($type_navs['type']=='SACHERIE'){

$dispat=$bdd->prepare("SELECT nc.id_connaissement, nc.num_connaissement, dis.*, mg.mangasin,p.produit,p.qualite FROM dispats as dis 
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
inner join mangasin as mg on mg.id=dis.id_mangasin
inner join produit_deb as p on p.id=nc.id_produit
 where nc.id_navire=?");
$dispat->bindParam(1,$idm);
$dispat->execute(); 

}

if($type_navs['type']=='VRAQUIER'){

$dispat=$bdd->prepare("SELECT nc.id_connaissement, nc.num_connaissement, dis.*, mg.mangasin,p.produit,p.qualite FROM dispats as dis 
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
inner join mangasin as mg on mg.id=dis.id_mangasin
inner join produit_deb as p on p.id=dis.id_produits
 where nc.id_navire=?");
$dispat->bindParam(1,$idm);
$dispat->execute(); 

}


?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>ajouter destination</title>
  <?php include('link_deb.php'); ?>
	<!-- Bootstrap CSS-->
	
</head>
<body >
<style type="text/css">
	
.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

.ajout_dis{
	background-color: rgb(0,141,202);
	font-weight: bold;
	width: 75%;
	border: solid;
	border-top-right-radius: 45%;
	border-bottom-right-radius: 45%;

	 }

	.logoo{
      border-radius: 50px;
       height: 80px;
        width: 100px;
       
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

</style>
<?php include('navbar.php'); ?>


  
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
									The Atrana template has the latest update!
								  <div class="time text-primary">3 Min Ago</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="far fa-user"></i>
								</div>
								<div class="dropdown-item-desc">
								   Sri asks you for friendship!
								  <div class="time">12 Hours Ago</div>
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
					  <img src="assets/images/avatar/avatar-1.png" alt="">
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
<?php include('sidebar_pre_deb.php'); ?>


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background:white;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">


						<div class="modal fade" id="form_modif_dec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">


      
    
  
      ?>

<center>

   <div class="mb-3">
    

     <label>N° DECLARATION</label>  
  <input type="text" class="form-control"  id="num_dec"  name="conditionnedis"  > <br>
    
   <label>id</label>  
  <input type="text" class="form-control"  id="id_dec"  name="conditionnedis"  > <br>
   <label>navire</label>  
  <input type="text" class="form-control"  id="navire_dec"  name="conditionnedis"  > <br>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" data-role="save_dec"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" >valider</a>
</form> 
        
      <div class="modal-footer">
         
        </div>
        </div> 
      </div>
    </div>
  </div>
</div>

				
 <div class="container-fluid" >
				<div class="row">
					<center>
			<h6 class="ajout_dis" style="color: white;">AJOUT NUMERO DECLARATION</h6>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">NUMERO DECLARATION</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">
	

                    
                            <input type="text" class="" placeholder="numero de declaration" name="num_declaration" style=" width:45%; margin-right:5%; margin-bottom: 10px;">
<select name='id_bl' style="width:50%;">	
	<option value="">choisir une destination</option>
	<?php while($con=$dispat->fetch()){ ?>
	<option value="<?php echo $con['id_dis'] ?>"> Destination <?php echo $con['mangasin'] ?> (connaissement <?php echo $con['num_connaissement'] ?> Produit <?php echo $con['produit'] ?> <?php echo $con['qualite'] ?>) </option>
<?php	} ?>
</select>
<?php $choix_destination=$bdd->query('SELECT id,mangasin from mangasin'); ?>


            <select id="prod1" name="des_douaniere" class=" " style="width:45%;  margin-bottom:20px;" onchange="getpoids()">

                        <option value="">choisir destination_douaniere </option>
                                 <option value="declaration">declaration </option>
                                 <option value="transfert">transfert </option> 
                                 <option value="APE">APE</option>
                                 <option value="Autres">Autres </option>        
             
                                
                                </select>

                        
                           
                             


                            <select name="statut_douanier" class=" " style="width:45%; margin-right:20px; margin-bottom:20px;">
                              <option selected>Statut douanier</option>
                            <option value="AES">AES</option>
                            <option value="AMEF">AMEF</option>
                            <option value="AUTRES">AUTRES</option>   
                            </select>
                             <input type="text" class="" placeholder="poids declares" name="poids" style="width:45%; margin-right:20px ">
                           <input type="file" name="image" id="image" style="width:45%; margin-right:20px">


             
                                               </div>                             
    

   <center>
<button class="btn" style="width: 100%;" name="ajout_con">ajouter</button>
   </center>                                         
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>

	<div class="col col-lg-6">
		<br>
		
			
		
		 <div  class="table-responsive" border=1 id="tableau_num_dec" >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<tr style="background: blue; text-align: center; vertical-align: middle; color: white;">
				<th colspan="4">
		DECLARATION 
	</th>
</tr>
 	<tr style="color: white; background: blue; font-size:12px; vertical-align: center; text-align: center; ">
 	<th>N° de declaration</th>
 	<th>Quantite</th>
 	<th>Destination</th>
 	<th>Actions</th>

 	</thead>

 <?php while($aff=$mes_declarations->fetch()){?>
 	<tr style="font-size:12px; background: white; vertical-align: center; text-align: center; vertical-align:middle;">
<td style="" id="<?php echo $aff['id_declaration'].'num_dec' ?>"><?php echo $aff['num_declaration'] ?></td>
<td style="" id="<?php echo $aff['id_declaration'].'num_dec' ?>"><?php echo $aff['poids'] ?></td>
<td style="" id="<?php echo $aff['id_declaration'].'num_dec' ?>"><?php echo $aff['mangasin'] ?></td>
<td style="display: flex; justify-content: center;"><a data-role='modifier_dec' data-id="<?php echo $aff['id_declaration'] ?>"><i class="fa fa-edit"></i></a>
<a ><i class="fa fa-trash"></i></a></td>
<span id="<?php echo $aff['id_declaration'].'navire_dec' ?>" ><?php echo $aff['id_navire'] ?></span>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>

	</div>

<?php include('formulaire_ajout.php'); ?>
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
            function pdispat(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('dis1').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","form_dispat2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p1');
                idp1 = sel.options[sel.selectedIndex].value;
                xhr.send("idP1="+idp1);
            }
        </script>

    <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('click','a[data-role=modifier_dec]',function(){
		var id=$(this).data('id');
		
		
		var num_dec=$('#'+id+'num_dec').text();
		
		var navire=$('#'+id+'navire_dec').text();
		//var cale=$('#'+id +'cales').text();

		
		$('#num_dec').val(num_dec);

		$('#id_dec').val(id);
		$('#navire_dec').val(navire);
		$('#form_modif_dec').modal('toggle');
	});
	});

    $(document).ready(function(){
		$(document).on('click','a[data-role=save_dec]',function(){
		
		var num_dec= $('#num_dec').val(); 
		 
		var id= $('#id_dec').val(); 
		var navire= $('#navire_dec').val();  
			$.ajax({
		url:'modifier_num_declaration.php',
		method:'post',
		data:{num_dec:num_dec,id:id,navire:navire},
		success: function(response){
			$('#tableau_num_dec').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#form_modif_dec').modal('toggle');
		}
	});
		});
		});   	
        </script>


 </body>
</html>

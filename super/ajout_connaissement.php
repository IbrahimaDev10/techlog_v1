<?php
require('control_dc.php');

$idm=$_GET['m'];

$navire=$bdd->prepare("SELECT type from navire_deb where id=?");
$navire->bindParam(1,$idm);
$navire->execute();
$navs=$navire->fetch();

include('bouton_valider_form_ajout.php');



$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");
$transNav = $bdd->query("select * from navire_deb order by id desc");

$affreteur=$bdd->query("select * from affreteur");

$banque=$bdd->query("select * from banque");

/*
  	if($navs['type']=='VRAQUIER'){
		$num_connaissement=$_POST['num_connaissement'];
		
        // $conditionnement=$_POST['produit'];
		// $cond=explode('-', $conditionnement);
		//  $client=$_POST['client'];
          $banques=$_POST['banque'];
           $fournisseur=$_POST['affreteur'];
           $poids=$_POST['poids'];
           $produit=explode('-', $_POST['produit']);
           $id_produit=$produit[0];
           $poids_sac=$_POST['poids_sac'];
           $client=$_POST['client'];
     
	
			 $insertDispat= $bdd->prepare("INSERT INTO numero_connaissements(num_connaissement,id_navire,id_banque,id_fournisseur,poids_connaissement,id_produit,id_client,poids_kg) VALUES(?,?,?,?,?,?,?,?)");
			 

		 $insertDispat->bindParam(1,$num_connaissement);
		 $insertDispat->bindParam(2,$idm);

		     $insertDispat->bindParam(3,$banques);
		      $insertDispat->bindParam(4,$fournisseur);
		       $insertDispat->bindParam(5,$poids);
		       $insertDispat->bindParam(6,$id_produit);
		       $insertDispat->bindParam(7,$client);
		       $insertDispat->bindParam(8,$poids_sac);

		 $insertDispat->execute();

	
	
	  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("GOOD","<i class="fas fa-check-circle"></i>");';
                echo '}, 100);</script>';

     
	  //header('location:gestion_stock2.php?m='.$idm);
            }
          

	*/




	


$mes_connaissement=$bdd->prepare("SELECT nc.*,b.*,af.*,p.produit,p.qualite FROM numero_connaissements as nc LEFT join banque as b on b.id=nc.id_banque
	LEFT join produit_deb as p on p.id=nc.id_produit
	left join affreteur as af on af.id=nc.id_fournisseur where id_navire=?");
$mes_connaissement->bindParam(1,$idm);
$mes_connaissement->execute();



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
	<?php include('navbar.php'); ?>
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


	<!--Content Start-->
	<div class="content-start transition" style="background:white;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

				<div class="modal fade" id="form_modif_con" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    
     <center>
        
              <label>CHOISIR UN PRODUIT</label><br>         	
                            <select id='produit_modifier' name="produit" class=" "  onchange="getpoids()"  style=" width:45%; margin-right:5%; ">

                        <option value="">CHOISIR UN PRODUIT </option>
                       <?php   
                           $p=$bdd->prepare("SELECT p.*, dc.conditionnement from declaration_chargement as dc
                             inner join produit_deb as p on p.id=dc.id_produit where dc.id_navire=? group by dc.id_produit,dc.conditionnement");
                            $p->bindParam(1,$idm);
                            $p->execute();
                            while ($a2=$p->fetch()) {
                            	?>
                                                            
                           <option value=<?php   echo   $a2["id"].'-'.$a2["conditionnement"]; ?> ><?php  echo  $a2["produit"]; ?> <?php  echo $a2["qualite"];  ?>
	                           <?php if($navs['type']=='SACHERIE'){   echo $a2["conditionnement"].' KG'; } ?>  </option>
                           <?php } ?>
                                 
                           </select> 
<?php if($navs['type']=='VRAQUIER'){ ?>
	<select name='poids_sac'>
		<option disabled="true"   >choisir poids sac</option>	
    <option value="0">AUCUN</option> 
		<option value="20">20 kg</option>
		<option value="25">25 kg</option>
		<option value="40">40 kg</option>
		<option value="45">45 kg</option>
		<option value="50">50 kg</option>
		
	</select>
<?php 	 
} 
?>

                           <br><br>
                       

      <label>BANQUE</label><br> 
    <select id="bank" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from banque");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['banque']	 ?> 	</option> <?php 	} ?>
    		 <option value="0" >AUCUNE</option>
   
</select><br><br>

     <label>AFFRETEUR</label><br> 
    <select id="affret" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from affreteur");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	><?php echo $p['affreteur']	?> 	</option> <?php 	} ?>
    		 <option value="0" >AUCUN</option>
   
</select><br><br>

    

    </center><br>
     <label>N° CONNAISSEMENT</label>  
  <input type="text" class="form-control"  id="nc"  name="conditionnedis"  > <br>
    <label>POIDS</label>  
  <input type="text" class="form-control"  id="poids2"  name="conditionnedis"  > <br>

  <div style="display: none;">
   <label>id</label>  
  <input type="text" class="form-control"  id="id_con"  name="conditionnedis"  > <br>
   <label>navire</label>  
  <input type="text" class="form-control"  id="navire_con"  name="conditionnedis"  > <br>
  </div>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" data-role="save_con"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" >valider</a>
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
			<h6 class="ajout_dis" style="color: white;">AJOUT CONNAISSEMENT</h6>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">CONNAISSEMENT</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">
	<center>	
                    
                            <input type="text" class="" placeholder="numero de connaissement" name="num_connaissement" id=num_connaissement style=" width:45%; margin-right:5%; margin-bottom: 10px;"><br><br>
                      <?php  ?>
                            <select  name="produit" class=" " id='produit'  onchange="getpoids()"  style=" width:45%; margin-right:5%; ">

                        <option value="">CHOISIR UN PRODUIT </option>
                       <?php   if($navs['type']=='SACHERIE'){
                           $p=$bdd->prepare("SELECT p.*, dc.conditionnement from declaration_chargement as dc
                             inner join produit_deb as p on p.id=dc.id_produit where dc.id_navire=? group by dc.id_produit,dc.conditionnement");
                            $p->bindParam(1,$idm);
                            $p->execute();
                            while ($a2=$p->fetch()) {
                            	?>
                                                            
                           <option value=<?php   echo   $a2["id"].'-'.$a2["conditionnement"]; ?> ><?php  echo  $a2["produit"]; ?> <?php  echo $a2["qualite"];  ?> <?php if($navs['type']=='SACHERIE'){ echo $a2["conditionnement"].' KG'; } ?>  </option>
                           <?php } 

                           } ?>

                            <?php   if($navs['type']=='VRAQUIER'){
                           $p=$bdd->prepare("SELECT c.*, dc.conditionnement from declaration_chargement as dc
                             inner join categories as c on c.id_categories=dc.categories_id where dc.id_navire=? group by c.nom_categories");
                            $p->bindParam(1,$idm);
                            $p->execute();
                            while ($a2=$p->fetch()) {
                              ?>
                                                            
                           <option value=<?php echo  $a2["id_categories"] ?> ><?php  echo  $a2["nom_categories"]; ?>  </option>
                           <?php } 

                           } ?>

                                 
                           </select> <br><br>

                          

                           <?php if($navs['type']=='VRAQUIER'){ ?>



<?php  
} 
?>

                           
                       

                           <select id="client" name="client" class=" "  style=" width:45%; margin-right:5%; ">

                        <option value="">CHOISIR UN CLIENT</option>
                        <?php  
                            $c=$bdd->query("select * from client");
                             
                            while ($a1=$c->fetch()) {
                               ?>                             
                           <option value=<?php echo   $a1["id"]; ?>>  <?php   echo  $a1["client"];?> </option>

                              <?php } ?>   
                              </select> <br><br>

                                    <select name="banque" class=" " id='banque'   style=" width:45%; margin-right:5%; ">
                           <option selected="" >CHOISIR UNE BANQUE</option>
                           <?php while($bank=$banque->fetch()){ ?>

                    <option  value=<?php echo htmlspecialchars($bank['id']); ?> ><?php echo htmlspecialchars($bank['banque']); ?></option>
                <?php } ?>
                <option value="0" >AUCUNE</option>
                </select>
                <br><br>

    
                        
                           
                             

                   
                         
                               <select  name="affreteur" class="" id='fournisseur'   style=" width:45%; margin-right:5%; ">
                           <option selected="" >CHOISIR UN FOURNISSEUR</option>
                           <?php while($aff=$affreteur->fetch()){ ?>

                    <option value=<?php echo htmlspecialchars($aff['id']); ?> ><?php echo htmlspecialchars($aff['affreteur']); ?></option>
                <?php } ?>
                 <option value="0" >AUCUN</option>
                </select>

                 </select><br><br>

                  <input type="text" class=""   placeholder="POIDS (TONNES)"  name="poids" id="poids" style=" width:45%; margin-right:5%; margin-bottom: 10px;">
                  <input type="text" class="" id='id_navire'  value="<?php echo $idm; ?>"   style=" width:45%; margin-right:5%; margin-bottom: 10px; display:none;">

                  <input type="text" class="" id='type'  value="<?php echo $navs['type']; ?>"   style=" width:45%; margin-right:5%; margin-bottom: 10px; display:none;">

                      
                </center>
                       
                        

             
                                               </div>                             
    

   <center>
<a class="btn" style="width: 100%;" name="ajout_con" data-role='ajout_con'>ajouter</a>
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
		<center>
		
		</center>
		 <div  class="table-responsive" border=1 id="tableau_num_connaissement">
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="color: white; background: blue; font-size:12px; vertical-align: center; text-align: center; vertical-align:middle;">
 	<th colspan="6" ><h6 style="color: white;">NUMERO DE CONNAISSEMENT</h6> </th></tr>
 	<tr style="background: blue; color: white; font-size:12px; text-align: center; vertical-align:middle;">
 		<th>N° CONNAISSEMENT</th>
 			<th>PRODUIT & <br>QUALITE</th>
 		<th>BANQUE</th>
 		<th>FOURNISSEUR</th>
 		<th>POIDS</th>
 		<th>ACTION</th>
 	</tr>

 	</thead>

 <?php while($aff=$mes_connaissement->fetch()){ ?>
 	<tr style="font-size:12px; background: white; vertical-align: middle; text-align: center; vertical-align:middle;">
<td id=<?php echo $aff['id_connaissement'].'nc' ?>><?php echo $aff['num_connaissement'] ?></td>
<td ><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <span style="color:red;"> <?php echo $aff['poids_kg'].' KG'; ?></span></td>
<td ><?php echo $aff['banque'] ?></td>
<td  ><?php echo $aff['affreteur'] ?></td>
<td style=" white-space: nowrap;" id="<?php echo $aff['id_connaissement'].'poids'; ?>"><?php echo number_format($aff['poids_connaissement'], 3,',',' '); ?></td>
<span id=<?php echo $aff['id_connaissement'].'banque' ?>><?php echo $aff['id_banque'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'affreteur' ?>><?php echo $aff['id_fournisseur'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'navire_con' ?>><?php echo $aff['id_navire'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'produit_con' ?>><?php echo $aff['id_produit'].'-'.$aff['poids_kg'] ?></span>

<td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_connaissement" data-id="<?php echo $aff['id_connaissement']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteConnaissement(<?php echo $aff['id_connaissement'] ?>)"><i class="fas fa-trash"></i></a></td>

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

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
		$(document).on('click','a[data-role=modifier_connaissement]',function(){
		var id=$(this).data('id');
		var poids=$('#'+id+'poids').text();
		var banque=$('#'+id+'banque').text();
		var nc=$('#'+id+'nc').text();
		var affreteur=$('#'+id+'affreteur').text();
		var navire=$('#'+id+'navire_con').text();
		var produit=$('#'+id+'produit_con').text();
		//var cale=$('#'+id +'cales').text();

		$('#poids2').val(poids);
		$('#nc').val(nc);
		$('#bank').val(banque);
		$('#affret').val(affreteur);
		$('#id_con').val(id);
		$('#navire_con').val(navire);
		$('#produit_modifier').val(produit);
		$('#form_modif_con').modal('toggle');
	});
	});

    $(document).ready(function(){
		$(document).on('click','a[data-role=save_con]',function(){
		var poids= $('#poids2').val(); 
		var nc= $('#nc').val(); 
		var banque= $('#bank').val(); 
		var affreteur= $('#affret').val();  
		var id= $('#id_con').val(); 
		var navire= $('#navire_con').val(); 
		var produit= $('#produit_modifier').val(); 

			$.ajax({
		url:'modifier_num_connaissement.php',
		method:'post',
		data:{poids:poids,nc:nc,banque:banque,affreteur:affreteur,id:id,navire:navire,produit:produit},
		success: function(response){
			$('#tableau_num_connaissement').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#form_modif_con').modal('toggle');
		}
	});
		});
		});   	
        </script>

<script type="text/javascript">
  function deleteConnaissement(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'navire_con').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_connaissement_register.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#tableau_num_connaissement').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
 $(document).on('click','a[data-role=ajout_con]',function(){
      
       var num_connaissement = $('#num_connaissement').val();
       var banque = $('#banque').val();
       var fournisseur = $('#fournisseur').val();
       var client = $('#client').val();
       var produit = $('#produit').val();
       var poids = $('#poids').val();

       var id_navire = $('#id_navire').val();
    
       var type = $('#type').val();
        
     if(num_connaissement!='' && poids!='' && produit!='' && client!='' && id_navire!='' && type==='SACHERIE'){ 

        
        $.ajax({
		url:'ajax_ajout_connaissement/ajout_connaissement.php',
		method:'post',
		data:{num_connaissement:num_connaissement,banque:banque,produit:produit,poids:poids,id_navire:id_navire,type:type,fournisseur:fournisseur,client:client},
		success: function(response){
			$('#tableau_num_connaissement').html(response);
			
		
		}
	});
    }


    if(num_connaissement!='' && poids!='' && produit!='' && client!='' && id_navire!='' && type==='VRAQUIER'){ 

        
        $.ajax({
    url:'ajax_ajout_connaissement/ajout_connaissement.php',
    method:'post',
    data:{num_connaissement:num_connaissement,banque:banque,produit:produit,poids:poids,id_navire:id_navire,type:type,fournisseur:fournisseur,client:client},
    success: function(response){
      $('#tableau_num_connaissement').html(response);
      
    
    }
  });
    }
    else{
   Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir tous les champs obligatoires.',
        confirmButtonText: 'OK'
    });
    }

    });
	

</script>


 </body>
</html>

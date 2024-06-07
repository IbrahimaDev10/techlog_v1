<?php
include('../database.php');


header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if(empty($_SESSION['profil'])){
		header('location:../index.php');
	}
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
$LesNavires=$bdd->query("select * from navire_deb order by id desc");
$LesProduits=$bdd->query("select * from produit_deb order by id desc");
$LesClients=$bdd->query("select * from client order by id desc");
$LesTransporteurs=$bdd->query("select * from transporteur order by id desc");
	$MesClients = $bdd->query("select * from client order by id desc");
$transp=$bdd->query("select * from transporteur order by id desc");
	$message="";
	$mes=1;
include('bouton_valider_form_ajout.php');

?>
<!doctype html>
<html lang="fr">
  <head>
   




	<title>Debarquement</title>
        <meta charset="utf-8">
  
    <meta content="" name="keywords">
    <meta content="" name="description">


	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>

	<link rel="stylesheet" type="text/css" href="debarquement.css">
    <link rel="stylesheet" type="text/css" href="css/imprimer.css" media='print'>
</head>
<body onload="loc_btn()">

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 

  .CellTotalElement{
	background-color:yellow; 
	color: red;
}
	100% {
		-webkit-transform: scale(1);
		transform: scale(1);
		opacity: 1
	}
}
.lienforme{
	background-color: blue;
	color: white;
	font-size: 20px;
}
.hnavire{
	background-color: #1B2B65;
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}

.hproduit{
	background-color: green;
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}
.hclient{
	background-color: rgb(0,128,128);
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}
.htransporteur{
	background-color: rgb(240,171,79);
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}

.hdeclaration{
	background-color: background: linear-gradient(to bottom, blue, #1B2B65);
	 background: linear-gradient(to left, blue, #1B2B65);
	  background: linear-gradient(to top, blue, #1B2B65);
	border: solid;
	
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
	font-weight: bold;
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
    .colcel, #soustotal, #total{
      font-size: 12px;

    }

 
#exampleFormControlInput1{
  width: 50%;

}
	
</style>
<style type="text/css">
	.operation-menu {
        position: relative;
    display: inline-block;
}

.operation-btn {
	font-size: 16px important!;
	background:white;
	color: black;
	margin-top: 5px;
	margin-bottom: 5px;
	border-radius: 40px;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
}

.submenu-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
   margin-top: 10px;

    left: 100%;
}

.submenu-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-decoration: none;
    display: block;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
    margin-top: 10px;
}

.submenu-btn:hover {
    background-color: #3e8e41;
}

.operation-menu:hover .dropdown-content,
.submenu-content:hover {
    display: block;
}

</style>

  
  <!--Topbar -->

 
	<!--Sidebar-->
  <?php include('navbar.php'); ?>

	<?php include('sidebar_pre_deb.php'); ?>

	<div class="sidebar-overlay"></div>


	<!--Content Start-->
<!--	<div class="content-start transition" style="background-image: url('../images/img_port.jpg');  background-size: cover;
   background-position: center center;
  background-repeat: no-repeat;  margin: 0px; border: none; border-radius: 0px; z-index: -5; " > !-->
  <div class="content-start transition" style="background:white;" >
		<div class="container-fluid dashboard">
			<div class="content-header">
<div class="row">
				



			</div>

			
onclick="visibleBtn()"  id="btn_pre_debarquement"
<!-- FDYFDS
 <div class="LesOperations"  style="height: 40%;"  >
        <div class="row">
         
          
            <div class="col col-md-6 col-lg-6" >
                <center>	
                    <a  class="dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  ><i class="fas fa-sign-out-alt">	</i>
                        PRE-DEBARQUEMENT
                    </a>
                    <ul id="drop_NN" class="dropdown-menu" aria-labelledby="dropdownMenuButton
                    " style="background: white;">
          <center>
          <li>
                             <a id="btn_voir_deb" style="background: none !important; color:blue !important;" class="btn" onclick="visibleCargoPlan()" > <i class="fas fa-eye">  </i>
                        MES DECLARATIONS DE CHARGEMENT
                    </a>
                  </li>
                  <li>
                                        <a style="background: none !important; color:blue !important;" class="dropdown-toggle" type="button" id="dropdownMenuButton3"   aria-haspopup="true" aria-expanded="false"  onclick="afficherMenuDebarquement()"><i class="fas fa-add"></i>
                        AJOUTER LES DECLARATIONS DE CHARGEMENT
                    </a>

                  </li>
                  
                  </ul>
                    <ul id="drop_NN3" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
                     <li> <a style="color: black !important;"  data-bs-toggle="modal" data-bs-target="#DC" >AJOUTER LES CALES</a></li>
                        <br>  
                        <li><a style="color: black !important;"  data-bs-toggle="modal" data-bs-target="#connaissement" >AJOUTER LES NUMEROS DE CONNAISSEMENTS</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#daap" >AJOUTER LES DISPATCHING</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER LES NUMEROS DE DECLARATIONS</a></li><br>

                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER LES INTERVENANTS</a></li>
                        </center>
                        
                    </ul>
                  
                </center>
              
                    </center>
                    
                
            </div>

                     <div class="col col-md-6 col-lg-6">
                <center>	
                    <a id="btn_debarquement" href="../transfert/tr_manifest.php" class="btn "  > <i class="fas fa-cog">	</i>
                        DEBARQUEMENT
                    </a>
                    
                    </center>
                
            </div> 
              
           
    </div>
 </div> !-->

<!-- <div class="LesOperations" style="height: 40%;  justify-content: center; ">
    <div class="row">
        <div class="col col-md-6 col-lg-6 operation-menu" style="display: flex; justify-content: center; ">

        	
    <a class="operation-btn" >PRE-DEBARQUEMENT <i class="dropdown-toggle"></i>
</a>
    <span class="dropdown-content">
        <button class="submenu-btn">MES DECLARATIONS DE CHARGEMENT</button>
        <button class="submenu-btn b2-btn">AJOUTER LES DECLARATIONS DE CHARGEMENT <i class="dropdown-toggle"></i></button>
        <span class="submenu-content">
            <button class="submenu-btn">B21</button>
            <button class="submenu-btn">B22</button>
            <button class="submenu-btn">B23</button>
        </span>
    </span>
  </div> 


 
        <div class="col col-md-6 col-lg-6" style="display: flex; justify-content: center; ">
            <center>
                <a id="btn_debarquement" href="../transfert/tr_manifest.php" class="btn" > <i class="fas fa-cog"></i> DEBARQUEMENT </a>
            </center>
        </div> 
    </div>
</div> !-->

<div class="LesOperations"  style="height: 40%;"  >
        <div class="row">
         
          
            <div class="col col-md-6 col-lg-6 operation-menu" >
                <center>    
                    <a id="btn_pre_debarquement"  class="btn " onclick="visibleBtn()" ><i class="fas fa-sign-out-alt">  </i>
                        PRE-DEBARQUEMENT 
                    </a>
                    </center>
                    
                
            </div>

                     <div class="col col-md-6 col-lg-6">
                <center>    
                  <!--  <a id="btn_debarquement" href="../transfert/tr_manifest" class="btn "  > <i class="fas fa-cog"> </i> !-->
                    <a <?php if($_SESSION['profil']=='pont'){ ?> href='../transfert_vrac_pont/tr_manifest' <?php } ?> id="btn_debarquement" <?php if($_SESSION['profil']=='superviseur'){ ?> data-bs-target='#navire_debarquement' data-bs-toggle='modal' <?php } ?> class="btn "  > <i class="fas fa-cog"> </i>
                        DEBARQUEMENT
                    </a>
                    
                    </center>
                
            </div> 
              
           
    </div>
 </div>
 

  <div id="btn_pre_deb" class="LesOperationsDEB" style="display: none; float: left; background:rgb(0,162,232) !important; border-radius: 0 !important;" >
        <div class="row">

            <center>    
                    <a id="btn_voir_deb" style="background: none !important;" class="btn" onclick="visibleCargoPlan()" > <i class="fas fa-eye"> </i>
                        MES DECLARATIONS DE CHARGEMENT
                    </a>
                    
                    </center><br>   
         
          <div  class="dropdown">
                    <a style="background: none !important;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-add"></i>
                        AJOUTER LES DECLARATIONS DE CHARGEMENT
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <li> <a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DC" >AJOUTER LES CALES</a></li>
                        <br>  
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#connaissement" >AJOUTER CONNAISSEMENTS</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#daap" >AJOUTER DISPATCHING</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER DECLARATIONS</a></li><br>

                   <!--     <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER LES INTERVENANTS</a></li> !-->
                        </center>
                        
                    </ul>
                  
                </div>
                </center> 
            

                     
                
                
            
              
           
    </div>
 </div>

 
<!--
  <div id="btn_pre_deb" class="LesOperationsDEB" style="display: none; float: left; background:rgb(0,162,232) !important; border-radius: 0 !important;" >
        <div class="row">

            <center>	
                    <a id="btn_voir_deb" style="background: none !important;" class="btn" onclick="visibleCargoPlan()" > <i class="fas fa-eye">	</i>
                        MES DECLARATIONS DE CHARGEMENT
                    </a>
                    
                    </center><br>   
         
          <div  class="dropdown">
                    <a style="background: none !important;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-add"></i>
                        AJOUTER LES DECLARATIONS DE CHARGEMENT
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <li> <a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DC" >AJOUTER LES CALES</a></li>
                        <br>  
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#connaissement" >AJOUTER LES NUMEROS DE CONNAISSEMENTS</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#daap" >AJOUTER LES DISPATCHING</a></li>
                        <br>
                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER LES NUMEROS DE DECLARATIONS</a></li><br>

                        <li><a style="color: black !important;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#transit">AJOUTER LES INTERVENANTS</a></li>
                        </center>
                        
                    </ul>
                  
                </div>
                </center> 
             

                     
                
                
            
              
           
    </div>
 </div>   !-->


				
				
				

				<div id="fetch_cargo_plan" class="col col-md-12" style="display: none;" >
					<div class="card" style="" >
						<div class="card-header" style="background:rgba(140,212,232,0.9);">
							
								
								<center>
              <h3 class="hdeclaration text-white" style="font-size: 22px !important; font-weight: bold;" >DECLARATION DE CHARGEMENT</h3>
              </center>
							 
							<select id="navire" name="navire" class="form-control  " onchange='go()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$navire->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?></option>	
                           <?php } ?> 
                       </select>

						</div>
						<div class="card-body"> 
						
		

						  </div>
						</div>
					</div>



				









					







<div class="modal fade" id="modif_disclientvrac" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <label>CLIENT</label><br> 
    <select id="clientdisv" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from client");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['client']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

     <label>DESTINATION</label><br> 
    <select id="destinationdisv" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from mangasin");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['mangasin']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

     <label>PRODUIT</label><br> 
    <select id="produitclientdisv" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from produit_deb");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['produit']	 ?> <?php echo $p['qualite']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

    </center><br>
     <label>BL</label>  
  <input type="text" class="form-control"  id="nbl_disv"  name="conditionnedis"  > <br>
    <label>CONDITIONNEMENT</label>  
  <input type="text" class="form-control"  id="conditionnedisv"  name="conditionnedis"  > <br>
  <label>poids</label>
  <input type="text" class="form-control"  id="poidsclientdisv" name="nombre_sac" ><br>
 
    <input type="text" class="form-control"  id="naviredisv" name="nav" hidden="true" >

     <input type="text" class="form-control"  id="idclientdisv" name="dec" hidden="true" ><br>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" id="save_client_disvrac" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
</form> 
        
      <div class="modal-footer">
         
        </div>
        </div> 
      </div>
    </div>
  </div>
</div>

















<div class="modal fade" id="modif_disclient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <label>RECEPTIONNAIRE</label><br> 
    <select id="clientdis" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from client");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['client']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

     <label>DESTINATION</label><br> 
    <select id="destinationdis" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from mangasin");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['mangasin']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

     <label>PRODUIT</label><br> 
    <select id="produitclientdis" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from produit_deb");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['produit']	 ?> <?php echo $p['qualite']	 ?> 	</option> <?php 	} ?>
   
</select><br><br>

    </center><br>
     <label>BL</label>  
  <input type="text" class="form-control"  id="nbl_dis"  name="conditionnedis"  > <br>
    <label>CONDITIONNEMENT</label>  
  <input type="text" class="form-control"  id="conditionnedis"  name="conditionnedis"  > <br>
  <label>NOMBRE SAC</label>
  <input type="text" class="form-control"  id="sacclientdis" name="nombre_sac" ><br>
 
    <input type="text" class="form-control"  id="naviredis" name="nav" hidden="true" >

     <input type="text" class="form-control"  id="idclientdis" name="dec" hidden="true" ><br>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" id="save_client_dis" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
</form> 
        
      <div class="modal-footer">
         
        </div>
        </div> 
      </div>
    </div>
  </div>
</div>










<div class="modal fade" id="modif_dec_vrac" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <label>PRODUIT</label><br> 
    <select id="id_produit_vrac" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from produit_deb");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['produit']	 ?>	</option> <?php 	} ?>
   
</select>

    </center><br>
  
  <label> POIDS</label>
  <input type="text" class="form-control"  id="poids_vrac" name="poids" ><br>
  <label>NOM CHARGEUR</label>
   <input type="text" class="form-control"  id="chform_vrac"  name="nom_chargeur"  ><br>
   <label>CALE</label>
   <center>
    <select id="caleform_vrac"  name="cales"    style="width: 50%;" >
      <option value="" > </option>
       <option value="C1" >C1</option>
       <option value="C2" >C2</option>
       <option value="C3" >C3</option>
       <option value="C4" >C4</option>
       <option value="C5" >C5</option>

    </select>
    <input style="display: none;" type="text" class="form-control"  id="navire_dc_vrac" name="navire_dc_vrac" >

     <input style="display: none;" type="text" class="form-control"  id="iddec_vrac" name="dec"  ><br>
    </center>
    
</div>


</center>



         <center>
        <a style="width: 50%;" id="save_vrac" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration2">valider</a>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="update_tab_transit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
      <div class="modal-body" style="">
      <input type="text" id="val_id" >  
      <div>  <a class="btn btn-primary" style="width: 100%;" target="blank" href="ajout_transit_heritier.php?m=<?php echo $row['id_trans_navire'].'-'.$row['id_trans_reelle'] ?>">Ajouter nouvel declaration<i class="fas fa-add"></i></a></div>
    </div>
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="modif_disvrac" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



   <div class="mb-3">
    
     <label>BL </label>
   <input type="text" class="form-control"  id="bl_disv"  name="nom"  ><br>

    <label>CONDITIONNEMENT</label>  
  <input type="text" class="form-control"  id="conditionnement_disv"  name="conditionnement"  > <br>
   <label>POIDS</label>  
  <input type="text" class="form-control"  id="poids_disv"  > <br>
 

  <label>PRODUIT</label><br> 
    <select id="produitclientupdisv" style="width: 50%;">
      <?php $prod=$bdd->query("select * from produit_deb");
      while($p=$prod->fetch()){ ?>
        <option value="<?php echo $p['id'];  ?>"  > <?php echo $p['produit']   ?> <?php echo $p['qualite']   ?>   </option> <?php   } ?>
   
</select><br><br>

   <label>RECEPTIONNAIRE</label><br> 
    <select id="clientupdisv" style="width: 50%;">
      <?php $prod=$bdd->query("select * from client");
      while($p=$prod->fetch()){ ?>
        <option value="<?php echo $p['id'];  ?>"  > <?php echo $p['client']  ?>   </option> <?php   } ?>
   
</select><br><br>

 <label>BANQUE</label><br> 
    <select id="banqueupdisv" style="width: 50%;">
      <?php $banque=$bdd->query("select * from banque");
      while($bank=$banque->fetch()){ ?>
        <option value="<?php echo htmlspecialchars($bank['banque']); ?>" > <?php echo $bank['banque']   ?>   </option> <?php   } ?>
   
</select><br><br>

     <label>DESTINATION</label><br> 
    <select id="destinationupdisv" style="width: 50%;">
      <?php $prod=$bdd->query("select * from mangasin");
      while($p=$prod->fetch()){ ?>
        <option value="<?php echo $p['id'];  ?>" > <?php echo $p['mangasin']   ?>   </option> <?php   } ?>
   
</select><br><br>

      
   <center>
   
<div style="display: none;">
    <input type="text" class="form-control"  id="navire_disv" name="nav" >

     <input type="text" class="form-control"  id="id_disv" name="dec"  ><br>
     </div>
    </center>
    
    
</div>


</center>



        
        
 
       
      <div class="modal-footer">
    <a id="save_disvrac"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
     </div> 
        
      </div>
      </form>
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
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form action="control_debarquement.php" method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="navire" name="navire">
</div>

<div class="mb-3">
                           <select name="type_navire" class="mb-3 " style="width:50%">
                            <option value="">type de chargement</option>
                          
                            <option value="SACHERIE"> EN SACS</option>
                            <option value="VRAQUIER"> EN VRAC</option>
                             </select>
                            </div>	


<div class="mb-3">   
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="LOAD PORT" name="load_port">
</div>
<div class="mb-3">   
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="DESTINATION" name="destination">
</div>
<div class="mb-3"> 
  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="PRODUIT(S)" name="description">
</div>
<div class="mb-3">
	<label for="exampleFormControlInput1" class="form-label">ETA</label>
  
  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="ETA" name="eta">
</div>
<div class="mb-3">   
	<label for="exampleFormControlInput1" class="form-label">ETB</label>
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETB" name="etb">
</div>
<div class="mb-3"> 
<label for="exampleFormControlInput1" class="form-label">ETD</label>  
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETD" name="etd">
</div>

<div class="mb-3"> 
<fieldset><legend>choix du client</legend>
	
<?php while ($clients=$MesClients->fetch()) {
	// code...
 ?>

  <input type="Checkbox"  style="height: 20px;width: 10%; font-size: 30px;  background-color: none;" id="" placeholder="client" name="client[]"  value="<?php echo $clients['client'];	 ?>"><?php 	echo  $clients['client']; ?>
<?php } ?>
  </fieldset>
</div>
 
                                    
                      
                           







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
      	<form action="control_debarquement.php" method="POST">

      

  
                           <div class="form-group position-relative has-icon-left mb-4">
                           	<select name="nombre" id="nombre" onchange="goInput()">
                           		<option value="">selectionner le nombre de produit</option>
                           		<option value="1">1</option>
                           		<option value="2">2</option>
                           		<option value="3">3</option>
                           		<option value="4">4</option>
                           	</select>
                           	  <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                           

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



<?php include('formulaire_ajout.php') ?>



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
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> CLIENT</a>  
					</div>
					</div>
      	<form action="control_debarquement.php" method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="client" name="client">
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
      	<form action="control_debarquement.php" method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="chauffeur" name="chauffeur">
</div>
   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="camions" name="camions">
</div>
   <div class="mb-3">
      
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="numero permis" name="permis">
</div>
   <div class="mb-3">
   <label>vous pouvez entrer deux numero séparés par un /</label>   
  <input type="text" class="form-control" style="height: 60px; font-size: 30px;" id="exampleFormControlInput1" placeholder="tel1 / tel2" name="tel">
</div>

<div class=" mb-3">
            <select id="" name="transporteur" class="" style="width: 50%; height: 40px; font-size: 100%"  >
                   <option value="">transporteur</option>
                        <?php 
                        while ($tr=$transp->fetch()) {
                           	?>
             <option value="<?= $tr['id']; ?>"><?php echo $tr['nom']; ?> </option>	
                           <?php } ?> 
                       </select>

</div> 




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
      	<form action="control_debarquement.php" method="POST">

      

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
      	<form action="control_debarquement.php" method="POST">

      

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






<div class="modal fade" id="dispatching" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">DISPATCHING</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> DISPATCHING</a>  
					</div>
					</div>
      	<form action="control_debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavireDIS" name="navire" class="form-control form-control-xl " onchange='goDIS()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$chercheNavDIS->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> <pre><?php echo $chNav['dates']; ?></pre></option>	
                           <?php } ?> 
                       </select>
                           </div> 
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                           <div class="form-group position-relative has-icon-left mb-4">
                           <select id="produitDIS" name="produitDIS" class="form-control form-control-xl " >
                           	<option  selected>selectionner un produit</option>
						</select>

                        </div>


                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Nombre sac" name="nombre_sac">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                        </div>  

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Numero BL" name="BL">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                        </div>                                               

 <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="client" class="form-control form-control-xl " >
                            <option value="">choisir client</option>
                            <?php 
                            while ($chCLI=$client->fetch()) {
                            	?>
                            <option value="<?= $chCLI['client']; ?>"><?php echo $chCLI['client']; ?></option>	
                           <?php } ?> 
                       </select>
                           </div>



<div class="form-group position-relative has-icon-left mb-4">
                           <select id="" name="destination" class="form-control form-control-xl " >
                            <option value="">choisir destination</option>
                            <?php 
                            while ($chMAN=$mangasin->fetch()) {
                            	?>
                            <option value="<?= $chMAN['mangasin']; ?>"><?php echo $chMAN['mangasin']; ?> </option>	
                           <?php } ?> 
                       </select>
                           </div>                      
                        


                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispatching">valider</button>
					</form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="auth-login.html" class="font-bold">Login</a>.</p>
                    </div>
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

  <script src="../assets/js/ui-chartjs.js"></script>



  
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../lib/lightbox/js/lightbox.min.js"></script>
    <script src="js/connaissement/afficher.js?=<?php echo time(); ?>"></script>
    <script src="js/par_receptionnaire/afficher.js?=<?php echo time(); ?>"></script>
    <script src="js/par_destination/afficher.js?=<?php echo time(); ?>"></script>
    <script src="js/cale/afficher.js?=<?php echo time(); ?>"></script>
    <script src="js/declaration/afficher.js?=<?php echo time(); ?>"></script>





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
            function goInput(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('lesinputs').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","NombreInput.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('nombre');
                idnombre = sel.options[sel.selectedIndex].value;
                xhr.send("idNombre="+idnombre);
            }
        </script>


  



	<script type="text/javascript">
		function imprimer(dname){
      window.print();

		}
	</script>


<script type='text/javascript'>
    // Fonction pour récupérer l'objet XMLHttpRequest
    function getXhr() {
        var xhr = null; 
        if (window.XMLHttpRequest) // Firefox et autres
            xhr = new XMLHttpRequest(); 
        else if (window.ActiveXObject) { // Internet Explorer 
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else { // XMLHttpRequest non supporté par le navigateur 
            alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
            xhr = false; 
        } 
        return xhr;
    }

    // Fonction pour charger les options du select
    function loadOptions() {
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function() {
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if (xhr.readyState == 4 && xhr.status == 200) {
                var leselect = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('fetch_cargo_plan').innerHTML = leselect;
            }
        }

        // Ici on va voir comment faire du post
        xhr.open("POST", "select_dc2.php", true);
        // Ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // Ne pas oublier de poster les arguments
        // Ici, l'id de l'auteur
        var sel = document.getElementById('navire');
        var idnavire = sel.options[sel.selectedIndex].value;
        xhr.send("idNavire=" + idnavire);
    }

    // Fonction pour sauvegarder idNavire dans le stockage local
    function saveIdNavire() {
        var sel = document.getElementById('navire');
        var idnavire = sel.options[sel.selectedIndex].value;
        localStorage.setItem('idNavire', idnavire);
    }

    // Chargement initial
    window.onload = function() {
        // Vérifier s'il existe une valeur dans le stockage local
        var idnavire = localStorage.getItem('idNavire');
        if (idnavire) {
            // Sélectionner l'option correspondante dans le select
            document.getElementById('navire').value = idnavire;
            // Charger les options du select
            loadOptions();
          
      
        }
       
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
                xhr.open("POST","select_dc2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
                saveIdNavire();
                loc_bl();
            }
            //ICI ON CHARGE LES LOCALES STORAGES
            loadOptions();

          

    document.addEventListener("DOMContentLoaded", function() {
    loc_btn();
    loc_cargo_plan();
    loc_bl();
    

});
            
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


<script type="text/javascript">
  function deleteDec(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       var navire = $('#' + id+'navire' ).text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_declaration.php',
              data:{delete_id:id,navire,navire},
              success:function(response){
              
                   $('#parcale').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function deleteDecvrac(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id).children('td[data-target=navire_vrac]').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_declarationvrac.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parcale').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function deleteDispatching(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'navire_dis').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_dispatching.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parconnaissement').html(response);

              }

         });

       }


     }

 


 </script>



 <script type="text/javascript">
  function deleteDispatchingvrac(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'id_navire_dis_delvrac').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_dispatchingvrac.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parclient').html(response);

              }

         });

       }


     }


 </script>

 <script type="text/javascript">
  function deleteTransit(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'id_navire_del_trans').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_transit.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#partransit').html(response);

              }

         });

       }


     }


 </script>

<script>
  function visibleBanque() {
    var parbanque = document.getElementById("parbanque");
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parbl = document.getElementById("parbl");
    var partransit = document.getElementById("partransit"); 
    if (parbanque.style.display === "none") {
      parbanque.style.display = "table";
      parproduit.style.display = "none";
      parcale.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parbl.style.display = "none";
      partransit.style.display = "none";
     

       parbanque.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parbanque.style.display = "none";
     
    }
    
    
  }
</script>


 
<script>
  function visibleProduit() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parproduit.style.display === "none") {
      parproduit.style.display = "table";
      parcale.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
       parbanque.style.display = "none";
     

       parproduit.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parproduit.style.display = "none";
     
    }
    
    
  }
</script>



<script>
  function visibleCale() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit"); 
    var btncale = document.getElementById("btncale"); 
     var parbanque = document.getElementById("parbanque");
    if (parcale.style.display === "none") {
      parcale.style.display = "block";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       btncale.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parcale.style.display = "none";
     
    }
    
    
  }
</script>



<script>
  function visibleClient() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parclient.style.display === "none") {
      parclient.style.display = "table";
      parcale.style.display = "none";
      parproduit.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       parclient.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parclient.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visibleDestination() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit"); 
     var parbanque = document.getElementById("parbanque");
    if (pardestination.style.display === "none") {
      pardestination.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      parbl.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       pardestination.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      pardestination.style.display = "none";
     
    }
    
    
  }
</script>

<script>
    function loc_bl(){
    var les_bl = document.getElementById("parconnaissement");
    var visibilite_bl = localStorage.getItem('Visibilite_bl'); 
    if(visibilite_bl === "table"){
        les_bl.style.display = visibilite_bl;
    }

}

  function visibleBl() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parconnaissement.style.display === "none") {
      parconnaissement.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      pardestination.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";

     

       parconnaissement.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parbl.style.display = "none";
     
    }

         localStorage.setItem('Visibilite_bl', 'table'); 
       loc_bl();
    
  }
</script>


<script>
  function visibleBl_unique() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
     
     var connaissement_simple = document.getElementById("connaissement_simple"); 
    if (connaissement_simple.style.display === "none") {
      connaissement_simple.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      pardestination.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
      parconnaissement.style.display = "none";
     

       parconnaissement.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parbl.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visibleTransit() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parbl = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
    var parbanque = document.getElementById("parbanque"); 
    if (partransit.style.display === "none") {
      partransit.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      parbl.style.display = "none";
      pardestination.style.display = "none";
      parbanque.style.display = "none";
     

       partransit.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      partransit.style.display = "none";
     
    }
    
    
  }
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update]',function(){
		var id=$(this).data('id');
        var pol_modif_cale=$(this).data('pol_modif_cale');
		var cale=$('#'+id+'cales').text();
   
		var sac=$('#'+id+'sac').text();
		sac = sac.replace(' ', '');
		var navire=$('#'+id+'navire').text();
		var ch=$('#'+id+'nom_chargeur').text();
		var produit = $('#'+id+'produit').text();
var produitId = $('#'+id+'produit-id').text();
var produitText = $('#'+id+'produit').text();
var type = $('#'+id +'type').text();
var poids_is_vrac = $('#'+id+'poids_is_vrac').text();




//$('#id_produit').val(produitId);




		var cond=$('#'+id+'conditionnement').text();
		cond = cond.replace(' KGS', '');
		$('#caleform').val(cale);
		$('#chform').val(ch);
		$('#iddec').val(id);

		$('#id_produit').val(produitId);
		$('#conditionnement').val(cond);
		$('#sac').val(sac);
		$('#navire_dc').val(navire);
    $('#type').val(type);
    $('#poids_is_vrac').val(poids_is_vrac);

           if(pol_modif_cale>0){
        $('#info_politique_modif_cale').css('display','block');
        $('#caleform').prop('disabled','true');
        $('#chform').prop('disabled','true');
        $('#id_produit').prop('disabled','true');
        $('#conditionnement').prop('disabled','true');
       }
        if(pol_modif_cale==0){
        $('#info_politique_modif_cale').css('display','none');
        $('#caleform').prop('disabled',false);
        $('#chform').prop('disabled',false);
        $('#id_produit').prop('disabled',false);
        $('#conditionnement').prop('disabled',false);
       }
		
		$('#modif_dec').modal('toggle');
	});
		

	$(document).ready(function(){
    $(document).on('click','a[data-role=saves]',function(){
	var cale=$('#caleform').val();
	var ch=$('#chform').val();
	var id=$('#iddec').val();
	var produitId=$('#id_produit').val();
	var sac=$('#sac').val();
	var navire=$('#navire_dc').val();
  var type=$('#type').val();
  var poids_is_vrac=$('#poids_is_vrac').val();



	var cond=$('#conditionnement').val();
	$.ajax({
		url:'tableau/cale/ajax/update.php',
		method:'post',
		data:{cale:cale,ch:ch,id:id,cond:cond,produitId:produitId,sac:sac,navire:navire,type:type,poids_is_vrac:poids_is_vrac},
		success: function(response){
			$('#body_cale').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_dec').modal('toggle');
		}
	});

	});
});
});
</script>





<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_transit]',function(){
		var id=$(this).data('id');
		var num_dec = $('#'+id +'numero_declaration').text();
		var poids_dec = $('#'+id +'poids_declarer').text();
		poids_dec=poids_dec.replace(" ","");
		poids_dec=poids_dec.replace(",",".");
		var statut = $('#'+id +'statut_douaniere').text();
		var des_douane = $('#'+id +'destination_douaniere').text();
		var navire = $('#'+id +'navire_trans').text();
    var bl = $('#'+id +'bl_transit').text();
    var id_bl = $('#'+id +'id_bl_transit').text();

		
		//var id_produit = $('#'+id+'id_produit_transit').text();
//var produit = $('#'+id +'produit_transit').text();

/*
var existingOption = $('#id_produit_tr option[value="' + id_produit + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(produit);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_produit,
      text: produit
   });
   $('#id_produit_tr').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
//$('#id_produit').val(produitId); */


var existingOptionStatut = $('#statut option[value="' + statut + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(statut);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: statut,
      text: statut
   });
   $('#statut').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#statut').val(statut);


 var existingOptionStatut = $('#n_bl_transit option[value="' + id_bl + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(bl);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: id_bl,
      text: bl
   });
   $('#n_bl_transit').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#n_bl_transit').val(id_bl);




 var existingOptionDes = $('#des_douane option[value="' + des_douane + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(des_douane);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: des_douane,
      text: des_douane
   });
   $('#des_douane').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#des_douane').val(des_douane);



		//$('#id_produit_tr').val(id_produit);
		$('#num_dec').val(num_dec);
		$('#poids_dec').val(poids_dec);
		$('#id_trans').val(id);
		$('#navire_transit').val(navire);
		
		
		
		$('#modif_transit').modal('toggle');
	});
		

	 $(document).on('click','a[data-role=save_transit]',function(){
	var num_dec=$('#num_dec').val();
	// var id_produit=$('#id_produit_tr').val();
	var poids_dec=$('#poids_dec').val();
	var id=$('#id_trans').val();
	var des_douane=$('#des_douane').val();
	var statut=$('#statut').val();
	var navire=$('#navire_transit').val();
  var bl=$('#n_bl_transit').val();

	
	$.ajax({
		url:'modifier_transit2.php',
		method:'post',
		data:{num_dec:num_dec,id:id,poids_dec:poids_dec,des_douane:des_douane,statut:statut,navire:navire,bl:bl},
		success: function(response){
			$('#partransit').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_transit').modal('toggle');
		}
	});

	});
});
</script>





<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=update_table_transit]',function(){
    var id=$(this).data('id');
    
    
   $('#val_id').val(id);
    
    
    
    
    $('#update_tab_transit').modal('toggle');
  });
    

   
});
</script>






<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_transitvrac]',function(){
			var id=$(this).data('id');
			var num_dec = $('#'+id +'numero_declarationvrac').text();
			var poids_dec = $('#'+id +'poids_declarervrac').text();
			var navire = $('#'+id +'navire_transvrac').text();
			var statut = $('#'+id +'statut_douanierevrac').text();
    var bl = $('#'+id +'bl_transitvrac').text();
    var id_bl = $('#'+id +'id_bl_transitvrac').text();
	
		
		
		poids_dec=poids_dec.replace(" ","");
		poids_dec=poids_dec.replace(",",".");
		
		var des_douane = $('#'+id +'destination_douanierevrac').text();
		
		






 var existingOptionDes = $('#des_douanev option[value="' + des_douane + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(des_douane);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: des_douane,
      text: des_douane
   });
   $('#des_douanev').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#des_douanev').val(des_douane);


 var existingOptionDes = $('#n_bl_transitvrac option[value="' + id_bl + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(bl);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: id_bl,
      text: bl
   });
   $('#n_bl_transitvrac').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#n_bl_transitvrac').val(id_bl);



 var existingOptionStatut = $('#statutv option[value="' + statut + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(statut);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: statut,
      text: statut
   });
   $('#statutv').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}

$('#statutv').val(statut); 




		$('#id_transv').val(id);
		$('#num_decv').val(num_dec);
		$('#poids_decv').val(poids_dec);
		$('#navire_transitv').val(navire);
		 
		
		$('#modif_transitv').modal('toggle');
	});
		

	$(document).on('click','a[data-role=save_transitvrac]',function(){
	var num_dec=$('#num_decv').val();
	// var id_produit=$('#id_produit_tr').val();
	var poids_dec=$('#poids_decv').val();
	var id=$('#id_transv').val();
	var des_douane=$('#des_douanev').val();
	var statut=$('#statutv').val();
	var navire=$('#navire_transitv').val();
  var bl=$('#n_bl_transitvrac').val();

	
	$.ajax({
		url:'modifier_transit2vrac.php',
		method:'post',
		data:{num_dec:num_dec,id:id,poids_dec:poids_dec,des_douane:des_douane,statut:statut,navire:navire,bl:bl},
		success: function(response){
			$('#partransit').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_transitv').modal('toggle');
		}
	});

	});
});
</script>





<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_vrac]',function(){
		var id=$(this).data('id');
		var cale=$('#'+id).children('td[data-target=cales_vrac]').text();
		var poids=$('#'+id).children('td[data-target=poids_vrac]').text();
		poids = poids.replace(' ', '');
		poids = poids.replace(',', '.');
		var navire=$('#'+id).children('td[data-target=navire_vrac]').text();
		var ch=$('#'+id).children('td[data-target=nom_chargeur_vrac]').text();
		var produit = $('#'+id).children('td[data-target=produit_vrac]').text();
var produitId = $('#'+id +'produit-id-vrac').text();
var produitText = $('#'+id).children('td[data-target=produit_vrac]').text();

var existingOption = $('#id_produit option[value="' + produitId + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(produitText);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: produitId,
      text: produitText
   });
   $('#id_produit_vrac').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
//$('#id_produit').val(produitId);




	
		$('#caleform_vrac').val(cale);
		$('#chform_vrac').val(ch);
		$('#iddec_vrac').val(id);

		$('#id_produit_vrac').val(produitId);
		
		$('#poids_vrac').val(poids);
		$('#navire_dc_vrac').val(navire);
		
		$('#modif_dec_vrac').modal('toggle');
	});
		

	$('#save_vrac').click(function(){
	var cale=$('#caleform_vrac').val();
	var ch=$('#chform_vrac').val();
	var id=$('#iddec_vrac').val();
	var produitId=$('#id_produit_vrac').val();
	var poids=$('#poids_vrac').val();
	var navire=$('#navire_dc_vrac').val();

	
	$.ajax({
		url:'modifier_declaration2_vrac.php',
		method:'post',
		data:{cale:cale,ch:ch,id:id,produitId:produitId,poids:poids,navire:navire},
		success: function(response){
			$('#parcale').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_dec_vrac').modal('toggle');
		}
	});

	});
});
</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_dis]',function(){
        var id = $(this).data('id');
        var pol_modif = $(this).data('pol_modif');
        //var cond = $('#' + id+'conditionnement' ).text();
        
       
        var id_navire = $('#' + id+'navire_dis' ).text();
        var id_num_dec = $('#' + id+'id_num_dec' ).text();
        var id_con_dis = $('#' + id+'id_con_dis_dis' ).text();
        var decharge = $('#' + id+'type_decharge' ).text();
        var sac = $('#' + id+'sac_dis' ).text();
        var type_navire = $('#' + id+'type_navire' ).text();
         var id_produit= $('#' + id+'id_produit_diss' ).text();
         var poids_sac = $('#' + id+'poids_sac_diss' ).text();
          var poids = $('#' + id+'poids_diss' ).text();
          var des_douane = $('#' + id+'des_douane_dis' ).text();
         // sac=sac.replace(' ','');
          //poids=poids.replace(' ','');
        //   sac = sac.replace(' ', '');

       
       

        // var des_douane= $('#'+id+'des_douane_dis').text();
       // var zero=0;

  
   
     //id_num_dec prend la valeur id_dis
     
       
         $('#dec_dis').val(id_num_dec);
         $('#id_con_dis').val(id_con_dis);
         $('#type_decharge_dis').val(decharge);
        $('#sac_dis').val(sac);
    
        $('#navire_dis').val(id_navire);
        $('#type_nav').val(type_navire);
        $('#poids_sac_dis').val(poids_sac);
        $('#produit_dis').val(id_produit);
        $('#poids_dis').val(poids);
        $('#poids_dis').val(poids);
        $('#des_douane').val(des_douane);
        $('#id_dis').val(id);
        var tp= $('#type_nav').val();
        var type_de_decharge=$('#type_decharge_dis').val();
       // $('#des_douane').val(des_douane);
      if (tp=='VRAQUIER') {
        $('#visible_sac').css('display','none');
        $('#visible_poids').css('display','block');

         //$('#conditionnement_dis').val(zero);
       } 
      if (tp=='SACHERIE') {
        $('#visible_sac').css('display','block');
        $('#visible_poids').css('display','none');
         $('#type_decharge_dis_global').css('display','none');
          $('#visible_poids_sac_dis').css('display','none');
         //$('#conditionnement_dis').val(zero);
       }        

             if (type_de_decharge==2) {
        $('#visible_poids_sac_dis').css('display','none');
         //$('#conditionnement_dis').val(zero);
       } 
       if (type_de_decharge==1 && tp=='VRAQUIER') {
        $('#visible_poids_sac_dis').css('display','block');
         //$('#conditionnement_dis').val(zero);
       } 
       if(pol_modif>0){
        $('#info_politique_modif').css('display','block');
        $('#dec_dis').prop('disabled','true');
        $('#id_con_dis').prop('disabled','true');
        $('#des_douane').prop('disabled','true');
        $('#produit_dis').prop('disabled','true');
        $('#poids_sac_dis').prop('disabled','true');
        $('#type_decharge_dis').prop('disabled','true');
       }
        if(pol_modif==0){
        $('#info_politique_modif').css('display','none');
        $('#dec_dis').prop('disabled',false);
        $('#id_con_dis').prop('disabled',false);
        $('#des_douane').prop('disabled',false);
        $('#produit_dis').prop('disabled',false);
        $('#poids_sac_dis').prop('disabled',false);
        $('#type_decharge_dis').prop('disabled',false);
       }
       
             //  $('#id_dis').val(id);

      
      $('#modif_dis').modal('toggle');
  
    
    });

   

    
             
   $(document).on('click','a[data-role=save_dis]',function(){
      
       var sac = $('#sac_dis').val();
        
       //var cond = $('#conditionnement_dis').val();
       var id = $('#id_dis').val();
       var id_navire = $('#navire_dis').val();
       var type_navire= $('#type_nav').val();
       
      
      var num_dec=$('#dec_dis').val();
      var id_con_dis=$('#id_con_dis').val();
     // var des_douane=$('#des_douane').val();

     var poids_sac = $('#poids_sac_dis').val();
        var poids = $('#poids_dis').val();
      var type_decharge=$('#type_decharge_dis').val()
    var des_douane=$('#des_douane').val();

     var produit = $('#produit_dis').val();

        
        $.ajax({
		url:'tableau/connaissement/ajax/update.php',
		method:'post',
		data:{id:id,id_navire:id_navire,type_navire:type_navire,num_dec:num_dec,poids_sac:poids_sac,poids:poids,type_decharge:type_decharge,des_douane:des_douane,sac:sac,id_con_dis:id_con_dis,produit:produit},
		success: function(response){
			$('#body_connaissement').html(response);
			
		$('#modif_dis').modal('toggle');
		}
	});
    });
});
    
            

  
   
   

</script>

<script type="text/javascript">
  $(document).ready(function(){
        $(document).on('change','select[data-role=type_chargement]',function(){
        var types=$('#type_decharge_dis').val();
        if (types==1) {
            $('#visible_poids_sac_dis').css('display','block');
        }
        if (types==2) {      
              $('#visible_poids_sac_dis').css('display','none');
        }
    });
    });
  </script>

<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_disvrac]',function(){
        var id = $(this).data('id');
        var cond = $('#' + id+'conditionnementvrac' ).text();
        var bl = $('#' + id+'bl_disvrac' ).text(); 
        var navire = $('#' + id+'id_navirevrac' ).text();
        var poids = $('#' + id+'poids_disvrac' ).text();
           poids = poids.replace(' ', '');

          var idclient = $('#'+id+'id_client_disvrac').text();
        var client = $('#'+id+'cli_disvrac').text();
        var iddestidis = $('#'+id+'id_mg_disvrac').text();
        var destidis= $('#'+id+'mg_disvrac').text();
        var idproduitdis = $('#'+id+'id_prod_disvrac').text();
        var produitdis= $('#'+id+'prod_disvrac').text(); 
        var banquedis= $('#'+id+'banque_disvrac').text(); 


          var existingOption = $('#clientupdisv option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

         var existingOption = $('#banqueupdisv option[value="' + banquedis+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(banquedis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: banquedis,
      text: banquedis
   });
   $('#banqueupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

        var existingOptiondesti = $('#destinationupdisv option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}


       var existingOptionpdis = $('#produitclientupdisv option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   
           $('#clientupdisv').val(idclient);
        $('#destinationupdisv').val(iddestidis);
        $('#produitclientupdisv').val(idproduitdis);
       
        
        $('#conditionnement_disv').val(cond);
        $('#poids_disv').val(poids);
        $('#bl_disv').val(bl);
        $('#navire_disv').val(navire);
       
       
       
       
        $('#id_disv').val(id);
        
        $('#modif_disvrac').modal('toggle');
    });
    
    $('#save_disvrac').click(function(){
       var bl = $('#bl_disv').val();
       var poids = $('#poids_disv').val();
       var cond = $('#conditionnement_disv').val();
       var id = $('#id_disv').val();
       var navire = $('#navire_disv').val();

        var client =$('#clientupdisv').val();
        var destination= $('#destinationupdisv').val();
        var produit= $('#produitclientupdisv').val();
        var banquedis= $('#banqueupdisv').val();
        

        
        $.ajax({
    url:'modifier_bl_vrac.php',
    method:'post',
    data:{bl:bl,poids:poids,cond:cond,id:id,navire:navire,client:client,produit:produit,destination:destination,banquedis:banquedis},
    success: function(response){
      $('#parbl').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#modif_disvrac').modal('toggle');
    }
  });
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_disclient]',function(){
        var id = $(this).data('id');
        //ID DU TRANSPORTEUR
        
        var idclient = $('#'+id+'idclientdiscol').text();
        var client = $('#'+id+'clientdis').text();
        var iddestidis = $('#'+id+'iddestidis').text();
        var destidis= $('#'+id+'destidis').text();
        var idproduitdis = $('#'+id+'idproduitdis').text();
        var produitdis= $('#'+id+'produitdis').text();
        var condidis= $('#'+id+'condidis').text();
        var navire= $('#'+id+'navdis').text();
        var n_bl= $('#'+id+'n_bl_dis').text();

        var sac= $('#'+id+'sacsdis').text();
        sac = sac.replace(' ', '');
        //NOM DU TRANSPORTEUzR
        

        var existingOption = $('#clientdis option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

        var existingOptiondesti = $('#destinationdis option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}


       var existingOptionpdis = $('#produitclientdis option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   

        //$('#m_trans_cam').val(id_tr);
        $('#clientdis').val(idclient);
        $('#destinationdis').val(iddestidis);
        $('#produitclientdis').val(idproduitdis);
        $('#conditionnedis').val(condidis);
        $('#sacclientdis').val(sac);
        $('#naviredis').val(navire);
        $('#idclientdis').val(id);
        $('#nbl_dis').val(n_bl);
        
        $('#modif_disclient').modal('toggle');
    });
    
    $('#save_client_dis').click(function(){
    	
        var client = $('#clientdis').val();
        var destination=$('#destinationdis').val();
         var produit = $('#produitclientdis').val();
          var cond = $('#conditionnedis').val();
           var sac = $('#sacclientdis').val();
            var navire = $('#naviredis').val();
            var n_bl = $('#nbl_dis').val();
     
            var id = $('#idclientdis').val();
        

        
        $.ajax({
		url:'modifier_clientdis.php',
		method:'post',
		data:{client:client,destination:destination,produit:produit,cond:cond,sac:sac,navire:navire,n_bl:n_bl,id:id},
		success: function(response){
			$('#parclient').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_disclient').modal('toggle');
		}
	});
    });
});

</script>







<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_disclientvrac]',function(){
        var id = $(this).data('id');
        //ID DU TRANSPORTEUR
        
        var idclient = $('#'+id+'idclientdiscolvrac').text();
        var client = $('#'+id+'clientdisvrac').text();
        
        var iddestidis = $('#'+id+'iddestidisvrac').text();
        var destidis= $('#'+id+'destidisvrac').text();
        var idproduitdis = $('#'+id+'idproduitdisvrac').text();
        var produitdis= $('#'+id+'produitdisvrac').text();
        var condidis= $('#'+id+'condidisvrac').text();
        var navire= $('#'+id+'navdisvrac').text();
        var n_bl= $('#'+id+'n_bl_disvrac').text();

        var sac= $('#'+id+'poidsdisvrac').text();
        sac = sac.replace(' ', '');
        //NOM DU TRANSPORTEUzR
       

        var existingOption = $('#clientdisv option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 



        var existingOptiondesti = $('#destinationdisv option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 


       var existingOptionpdis = $('#produitclientdisv option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
  

       
       
        $('#destinationdisv').val(iddestidis);
        $('#produitclientdisv').val(idproduitdis);
        $('#conditionnedisv').val(condidis);
        $('#poidsclientdisv').val(sac);
        $('#naviredisv').val(navire);
        $('#idclientdisv').val(id);
        $('#nbl_disv').val(n_bl);
        $('#clientdisv').val(idclient);
        
        $('#modif_disclientvrac').modal('toggle');
    });
    
    $('#save_client_disvrac').click(function(){
    	
        var client = $('#clientdisv').val();

        var destination=$('#destinationdisv').val();
         var produit = $('#produitclientdisv').val();
          var cond = $('#conditionnedisv').val();
           var sac = $('#poidsclientdisv').val();
           sac=sac.replace(" ","");
            var navire = $('#naviredisv').val();
            var n_bl = $('#nbl_disv').val();
     
            var id = $('#idclientdisv').val();
        

        
        $.ajax({
		url:'modifier_clientdisvrac.php',
		method:'post',
		data:{client:client,destination:destination,produit:produit,cond:cond,sac:sac,navire:navire,n_bl:n_bl,id:id},
		success: function(response){
			$('#parclient').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_disclientvrac').modal('toggle');
		}
	});
    });
});

</script>
<script type="text/javascript">
/*  function loc_btn(){
    var les_btn = document.getElementById("btn_pre_deb");
    var visibilite = localStorage.getItem('Visibilite'); 
    if(visibilite === "table"){
        les_btn.style.display = visibilite;
    }

} 
    function loc_cargo_plan(){
    var les_cargo_plan = document.getElementById("fetch_cargo_plan");
    var visibilite_cargo = localStorage.getItem('Visibilite_cargo'); 
    if(visibilite_cargo === "table"){
        les_cargo_plan.style.display = visibilite_cargo;
    }
} */

function visibleBtn(){
    var btn = document.getElementById("btn_pre_deb");
    btn.style.display = "table";
    //localStorage.setItem('Visibilite', 'table'); 
   // loc_btn();
}
</script>

<script type="text/javascript">
   

	function visibleCargoPlan(){
		var cargo_plan=document.getElementById("fetch_cargo_plan");
		cargo_plan.style.display="table";
      //  localStorage.setItem('Visibilite_cargo', 'table'); 
       // loc_cargo_plan();

	}
   
</script>

<style>
  #b {
    visibility: hidden;
  }
</style>


<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_cale]', function () {
            var contentToPrint = $('#parcale').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_produit]', function () {
            var contentToPrint = $('#tab_par_produit').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_connaissement]', function () {
            var contentToPrint = $('#tab_par_connaissement').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_client]', function () {
            var contentToPrint = $('#tab_par_client').html();
            var printWindow = window.open('', '_blank');
             var cssLinkp = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
              
          //   var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLinkp +  '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 

        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_destination]', function () {
            var contentToPrint = $('#tab_par_destination').html();
            var printWindow = window.open('', '_blank');

             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var entete_head=('#entete_head').css('background','red');
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + entete_head +  '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
	function afficherMenuDebarquement() {
    var menuDebarquement = document.getElementById("drop_NN3");
    if (menuDebarquement.style.display === "none") {
        menuDebarquement.style.display = "block";
    } else {
        menuDebarquement.style.display = "none";
    }
}



</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var b2Btn = document.querySelector('.b2-btn');
        var submenuContent = document.querySelector('.submenu-content');

        b2Btn.addEventListener('click', function() {
            if (submenuContent.style.display === 'block') {
                submenuContent.style.display = 'none';
            } else {
                submenuContent.style.display = 'block';
            }
        });
    });
</script>

<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('change','select[data-role=filtre_par_poids]',function(){
  //$('#type').css('display', 'block');

     var navire = $('#filtre_id_navire').val();
     var poids = $('#par_poids').val();
     

  



        $.ajax({
        url:'filtre_par_poids.php',
        method:'post',
        data:{navire:navire,poids:poids},
        success: function(response){
          $('#tab_par_produit').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});



  /* partie recherche tableau */

  function cherche_par_connaissement() {
    // Récupérer la valeur saisie dans l'input de recherche
    var id=$(this).data('id');
    var id_tableau=$(this).data('id_tableau');
    var recherche = document.getElementById(id).value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll('#'+id_tableau+ " tbody tr");

    // Parcourir toutes les lignes de la table
    lignes.forEach(function(ligne) {
        // Récupérer le texte de chaque cellule dans la ligne
        var contenuCellules = ligne.textContent.toUpperCase();
        
        // Vérifier si la valeur de recherche est présente dans le contenu de la ligne
        if (contenuCellules.indexOf(recherche) > -1) {
            // Afficher la ligne si elle correspond à la recherche
            ligne.style.display = "";
        } else {
            // Masquer la ligne si elle ne correspond pas à la recherche
            ligne.style.display = "none";
        }
    });
}  

  
</script>
 </body>
</html>

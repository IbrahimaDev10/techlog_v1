<?php 
require('../database.php');
require('controller/acces_transfert.php');
require('controller/afficher_les_transferts.php');
$_SESSION['prod']=$_POST['produit'];
$lesproduits=$_POST['produit'];
$explode=explode('-', $lesproduits);
$produit=$explode[0];
$poids_sac=$explode[1];
$navire=$explode[2];
$destination=$explode[3];
$nouvelle_destination=$explode[4];
//$destination=$explode[4];

echo $produit;
echo $poids_sac;
echo $destination;
echo $navire;
echo $nouvelle_destination;
echo $_SESSION['prod'];
 // design https://www.flaticon.com/fr/chercher?word=transfert%20de%20donn%C3%A9es

 ?>
 

        <div class="container-fluid LesOperations" >
        <div class="row">

      <h3 class="TitreOperation">OPERATIONS</h3>
<span style="background: blue !important; display: flex; justify-content: center;">  <h1 style="color: white !important;"> TRANSFERT DE  :</h1> 
  <?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
        $new_destination=entrepot_a_transferer($bdd,$nouvelle_destination);
  if($infos=$res4->fetch()){ ?> <h1 style="color: yellow !important;"> <?php echo $infos['mangasin'] ?> <?php } ?> <span style="color: white;"> VERS </span> <?php if($infos2=$new_destination->fetch()){ echo $infos2['mangasin']; } ?>   </h1></span> 
       
            <div class=" col col-md-6 col-lg-2">
              <center>
                <div  class="dropdown">
                    <a style="font-size: 12px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopu0p="true" aria-expanded="false">
TRANSFERT
<!--  ?TRANSFERTS -->
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;"> 
                      <center>  
                        
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain"  onclick="visibleSain()"> SAINS</a></li>
                        <br>  
                        <li><a style="color: black !important;" class="dropdown-item" id="btnMouille"  onclick="visibleMouille()"> MOUILLES</a></li><br>
                        <li><a style="color: black !important;" class="dropdown-item" id="btnFlasque"  onclick="visibleFlasque()"> FLASQUES</a></li><br>
                        <li><a style="color: black !important;" class="dropdown-item" id="btnBalayure"  onclick="visibleBalayure()"> BALAYURES</a></li>
                        </center>
                        
                        
                    </ul>
                  
                </div>
            </div>
       <!-- 
        <div class="col col-md-6 col-lg-3">
                <div  class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        DOCUMENTS DE LIVRAISON
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <li> <a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleDeclaration()">DECLARATION</a></li>
                        <br>  
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleRelache()">RELACHE</a></li>
                        <br>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleEnleve()">BON D'ENLEVEMENT</a></li>
                        </center>
                        
                    </ul>
                  
                </div>
                </center>
            </div> !-->

            <div class="col col-md-6 col-lg-2">
                
                    <a style="font-size: 12px;" class="btn btn-primary " onclick="visibleAvaries()" >
                        AVARIES DE LIVRAISONS
                    </a>
                    
                    
                </center>
            </div>

                     <div class="col col-md-6 col-lg-2">
                
                    <a style="font-size: 12px;" class="btn btn-primary " onclick="visibleRecond()" >
                        RECONDITIONNEMENT
                    </a>
                    
                    
                </center>
            </div>
         <div class="col col-md-6 col-lg-2">
                <center>
                  <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>

                    <a style="font-size: 12px;" class="btn btn-primary " data-roles="afficher_pv_recond" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>" >
                        PV DE RECONDITIONNEMENT
                    </a>
                  <?php } ?>
                    
                    
                </center>
            </div>   
        <div class="col col-md-6 col-lg-2">
                <center>
                    <a style="font-size: 12px;" class="btn btn-primary " data-roles="afficher_pv" data-id="<?php echo $c; ?>" >
                        PV FINAL DE LIVRAISON
                    </a>
                    
                    
                </center>
            </div>        

        <div class="col col-md-6 col-lg-2" >
                <div  class="dropdown">
                    <a style="font-size: 12px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       SITUATIONS
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li> <a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleBon()" data-roles="situation_bon" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">BON D'ENLEVEMENT</a></li>
                      <?php  } ?>
                        <br>  
                          <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleRelaches()" data-roles="situation_relache" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">RELACHE</a></li>
                      <?php } ?>
                        <br>
                          <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleTransit()" data-roles="situation_transit" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">TRANSIT</a></li>
                      <?php } ?>
                        </center>
                        
                    </ul>
                  
                </div>    
            </div>
           
    </div>
 </div>

<!-- <div class="container-fluid" id="TableSain" style="display: none; width: 100%;">

  <div class="col-md-12 col-lg-12">      
<a id="insertion_sain" type="submit" class="btn1"data-roles="afficher_form_tr_sain" data-produit="<?php //echo $produit; ?>" data-poids_sac="<?php //echo $poids_sac; ?>" data-navire="<?php //echo $navire; ?>" data-destination="<?php //echo $destination; ?>" >Insertion </a>

</div> !-->



<div class="container-fluid" class="" id="TableLivraison" style="display: none;" >
      <div class="row">

<div class="col-md-12 col-lg-12"> 
  <br>
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_form_tr_sain" data-produit="<?php //echo $produit; ?>" data-poids_sac="<?php //echo $poids_sac; ?>" data-navire="<?php //echo $navire; ?>" data-destination="<?php //echo $destination; ?>" >AJOUTER LIVRAISON  </a>
<?php   } ?>
<br>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERTS SAINS</td> 
  
       
  
    <?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$res4->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php } ?>


        
    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td class="colaffiches" scope="col"   >DATE</td>
      <td class="colaffiches" scope="col" > HEURE</td>
      <td class="colaffiches" scope="col"  >N° DECLARATION</td>
      <td class="colaffiches"  >N° RELACHE</td>
      <td class="colaffiches"  >BL SIMAR</td>
      <td class="colaffiches"  >BL FOURNISSEUR</td>
      <td class="colaffiches"  >CAMION</td>
      <td class="colaffiches"  >CHAUFFEUR</td>
      <td class="colaffiches"  >SAC</td>
      <td class="colaffiches"  >POIDS</td>
      <td class="colaffiches"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  <?php //affichage_transfert_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
  <?php $statut='sain';
  affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>
   

 




 </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="container-fluid" class="" id="TableFlasque" style="display: none;" >
      <div class="row">

           

        

<div class="col-md-12 col-lg-12">  
<br><br>    
<?php // $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   //if($find=$res4->fetch()){ ?>     
<a class="btn1"  style="background:rgb(0,162,232); margin-bottom: 0 !important;" data-roles="afficher_formulaire_liv_flasque" data-produit="<?php //echo $find['id_produit']; ?>" data-poids_sac="<?php //echo $find['poids_kg']; ?>" data-navire="<?php //echo $find['id_navire']; ?>" data-destination="<?php //echo $find['id_mangasin']; ?>" >AJOUTER TRANSFERT FLASQUE  </a>
<?php  // } ?>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1 style="margin-top: 0;">



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERT DES FLASQUES</td> 
  
   <?php //$infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    //while($inf=$infos->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php //echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php //echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php //echo $inf['produit']; ?> <?php //echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php //echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php //echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php //echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php //} ?>


      <?php 

 

       ?>

    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > HEURE</td>
      <td id="mytd" scope="col"  >N° DECLARATION</td>
      <td id="mytd" scope="col"  >N° RELACHE</td>
      <td id="mytd" scope="col"  >BL SIMAR</td>
      <td id="mytd" scope="col"  >BL FOURNISSEUR</td>
      <td id="mytd" scope="col"  >CAMION</td>
      <td id="mytd" scope="col"  >CHAUFFEUR</td>
      <td id="mytd" scope="col"  >SAC</td>
      <td id="mytd" scope="col"  >POIDS</td>
       <td id="mytd" scope="col"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  
<?php $statut='flasque';
  affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="container-fluid" class="" id="TableMouille" style="display: none;" >
      <div class="row">

           

        

<div class="col-md-12 col-lg-12">  
<br><br>    
<?php // $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   //if($find=$res4->fetch()){ ?>     
<a class="btn1"  style="background:rgb(0,162,232); margin-bottom: 0 !important;" data-roles="afficher_formulaire_liv_mouille" data-produit="<?php //echo $find['id_produit']; ?>" data-poids_sac="<?php //echo $find['poids_kg']; ?>" data-navire="<?php //echo $find['id_navire']; ?>" data-destination="<?php //echo $find['id_mangasin']; ?>" >AJOUTER TRANSFERT MOUILLE  </a>
<?php  // } ?>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1 style="margin-top: 0;">



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERT DES MOUILLES</td> 
  
   <?php //$infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    //while($inf=$infos->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php //echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php //echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php //echo $inf['produit']; ?> <?php //echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php //echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php //echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php //echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php //} ?>


      <?php 

 

       ?>

    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > HEURE</td>
      <td id="mytd" scope="col"  >N° DECLARATION</td>
      <td id="mytd" scope="col"  >N° RELACHE</td>
      <td id="mytd" scope="col"  >BL SIMAR</td>
      <td id="mytd" scope="col"  >BL FOURNISSEUR</td>
      <td id="mytd" scope="col"  >CAMION</td>
      <td id="mytd" scope="col"  >CHAUFFEUR</td>
      <td id="mytd" scope="col"  >SAC</td>
      <td id="mytd" scope="col"  >POIDS</td>
       <td id="mytd" scope="col"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  
<?php $statut='mouille';
  affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="container-fluid" class="" id="TableBalayure" style="display: none;" >
      <div class="row">

           

        

<div class="col-md-12 col-lg-12">  
<br><br>    
<?php // $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   //if($find=$res4->fetch()){ ?>     
<a class="btn1"  style="background:rgb(0,162,232); margin-bottom: 0 !important;" data-roles="afficher_formulaire_liv_balayure" data-produit="<?php //echo $find['id_produit']; ?>" data-poids_sac="<?php //echo $find['poids_kg']; ?>" data-navire="<?php //echo $find['id_navire']; ?>" data-destination="<?php //echo $find['id_mangasin']; ?>" >AJOUTER TRANSFERT BALAYURE  </a>
<?php  // } ?>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1 style="margin-top: 0;">



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERT DES BALAYURES</td> 
  
   <?php //$infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    //while($inf=$infos->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php //echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php //echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php //echo $inf['produit']; ?> <?php //echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php //echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php //echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php //echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php //} ?>


      <?php 

 

       ?>

    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > HEURE</td>
      <td id="mytd" scope="col"  >N° DECLARATION</td>
      <td id="mytd" scope="col"  >N° RELACHE</td>
      <td id="mytd" scope="col"  >BL SIMAR</td>
      <td id="mytd" scope="col"  >BL FOURNISSEUR</td>
      <td id="mytd" scope="col"  >CAMION</td>
      <td id="mytd" scope="col"  >CHAUFFEUR</td>
      <td id="mytd" scope="col"  >SAC</td>
      <td id="mytd" scope="col"  >POIDS</td>
       <td id="mytd" scope="col"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  
<?php $statut='balayure';
  affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>



<?php 
      $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
  while($row=$res4->fetch()){ ?>


<div class="modal fade" id="form_tr_sain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">TRANSFERT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >

       </center> 


      </div>
  <div >

     <label style="margin-top: 5px !important;">NAVIRE: <span style="color: red;"> <?php echo $row['navire']; ?></span></label><br>  
         <label style="margin-top: 5px !important;">PRODUIT: <span style="color: red;"><?php echo $row['produit'].' '.$row['qualite'].' '.$row['poids_kg'] ?></span></label><br>

  
   

    
  </div>

        <form  method="POST">
   
 
 <div class="mb-3"> 
  
    
    <label>DATE</label>
     <label style="float: right;">HEURE </label><br>   
   <input type="date" id="date_liv" class="selectform"   name="date" >

   
  
        <input style="float: right;" type="time" class="selectform"  id="heure_liv"  name="sac"  > 
      <?php $connaissement=declaration($bdd,$produit,$poids_sac,$navire,$destination); ?>  
<select id="dec_liv">
	<option>choisir une declaration</option>
	<?php while($con=$connaissement->fetch()){ ?>
		<option value="<?php echo $con['id_declaration_transfert'] ?>"><?php echo $con['num_dec_transfert'];  ?></option>
	<?php } ?>

</select>

      <div style="background: blue">
   <div class="mb-3">
      <center>  
    <h6 style="background: white; color: blue;">TRANSPORT</h6>
   
 <h6 style="color: white;">CAMIONS  </h6>
  </center> 
<input class="inputtransportform" type="text" id="myInput"  placeholder="SAISIR LE N° DE CAMION"  onkeyup="filtreca();" autocomplete="off">
<input class="inputtransportform" type="text" id="myInputTransp" placeholder="transporteur" style=" float: right;" disabled="true" >

<div id="camionList" style="background: white; display: none; color: black; font-weight: bold; " >
  </div>
 

<br>  





<input type="" name="input2" id="val_input2" hidden="true"  >
 <center> <br>  
<h6 style="color: white;">CHAUFFEUR  </h6> 
</center> 
<input class="inputtransportform" type="text" id="myInputc"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau();" autocomplete="off">

<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>
          
         
         <label style="float: left;">SAC </label><br> 
        <input style="height: 25px;" type="number"  id="sac_liv"  name="sac" value="0" ><br>
        
                <label>destination </label>
        <input style="height: 25px;" type="text" class="form-control"  id="destination_livraison"    ><br>
      </div>
         
         
       <div style="">     
        <label>poids_sac </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="poids_sac_liv"  name="sac"  value="<?php echo $row['poids_kg']; ?>" ><br>    
        <label>id_produit </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_produit_tr"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_liv"  name="sac"   ><br> 
        <label>id_navire </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_tr"  name="sac"  value="<?php echo $row['id_navire']; ?>" ><br> 
        <label>destination </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_destination_tr"  name="sac" value="<?php echo $row['id_mangasin']; ?>" ><br>
                <label>statut </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="statut"  name="sac" >  
                        <label>etat </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="etat_reception"  name="sac" value="non" > 
        </div>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_s"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_liv">valider</a>
          <a  id="ajout_m"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_liv_mouille">valider mouille</a>
          



         
      </div>
  </center>
      
    </div>
  </div>
</div>


<?php } ?>
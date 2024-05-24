<?php
require('../database.php');
require("controller/bl_suivant.php");
require('controller/control_choix_des_excedents.php');
require('../reception_test/controller/stock_depart.php');
require('controller/afficher_les_livraisons.php');
?>


          <?php if (isset($_POST['idProduit'])) {

             $b=$_POST["idProduit"];
             $e=explode('-', $b);
             $c=$e[0];

      $produit=$e[0];
      $poids_sac=$e[1];
      $navire=$e[2];
      $destination=$e[3];
      echo  $produit;
      echo $poids_sac;

             include("requete.php");


     function entrepot($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT dis.id_dis,  mg.mangasin,mg.id,nav.navire,nc.num_connaissement, nc.id_navire from dispat as dis 


                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join mangasin as mg  ON  dis.id_mangasin = mg.id 
      
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                     
                 where mg.id_mangasinier=?  group by nav.id; ");             
           $res4->bindParam(1,$_SESSION['id']);
              
              $res4->execute();
        $res4->execute();
        return $res4;
      }          


           ?>


         <div class="container-fluid LesOperations" >
        <div class="row">
       <?php $res4=entrepot($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
              <span style="background: blue !important; display: flex; justify-content: center;">  <h1 style="color: white !important;"> ENTREPOT :</h1> <h1 style="color: yellow !important;"> <?php echo $row['mangasin']; ?></h1></span> <?php } ?>

       
            <div class=" col col-md-6 col-lg-2">
              <center>
                <div  class="dropdown">
                    <a style="font-size: 12px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        LIVRAISONS
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;"> 
                      <center>  
                        
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain"  onclick="visibleSain()"> SAINS</a></li>
                        <br>  
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain2"  onclick="visibleMouille()"> AVARIES</a></li><br>
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain3"  onclick="visibleBalayure()"> BALAYURES</a></li>
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
                        <?php  $res4=entrepot($bdd,$produit,$poids_sac,$navire,$destination);
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
    <input type="" name="" id="input_navire" value="<?php echo $navire; ?>">
        <input type="" name="" id="input_produit" value="<?php echo $produit; ?>">
        <input type="" name="" id="input_destination" value="<?php echo $destination; ?>">
        <input type="" name="" id="input_poids_sac" value="<?php echo $poids_sac; ?>">        

<br><br>  
 <div class="container-fluid" class="" id="TableLivraison" style="display: none;" >
      <div class="row">

          <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
        
<?php
 
 ?>


  </center>
  <?php //afficher_stock_depart_livraison($bdd,$produit,$poids_sac,$navire,$destination);?>



          
          
<?php 
/*
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)']; */

 ?>
 
<div class="col col-md-6" style="border: solid; border-color: blue;">
  <h3 style="background: black; text-align: center; color: white !important;">RESTE A LIVRER</h3>
  <h6 style="float: right;">SACS SAINS LIVRES: <span style="color: red;"><?php //echo $TLivres['sum(sac_liv)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivres['sum(poids_liv)'].' T' ?></span></h6>
     <h6 style="float: right;">SACS MOUILLES LIVRES: <span style="color: red;"><?php //echo $TLivresMo['sum(sac_mo)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivresMo['sum(poids_mo)'].' T' ?></span></h6>
      <h6 style="float: right;">SACS BALAYURES LIVRES: <span style="color: red;"><?php //echo '0 SACS' ?></span> SOIT <span style="color: red;"><?php //echo '0 T' ?></span></h6>
      <h6 style="float: right;">PERTE SUR RECONDITIONNEMENT: <span style="color: red;"><?php //echo $perte_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $perte_poids.' T' ?></span></h6>

       <h6 style="background: yellow; float: right;">RESTE A LIVRER: <span style="color: red;"><?php //echo $sac_reste_livrer.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $poids_reste_livrer.' T' ?></span></h6>

      </div>
    
  </div>
</div>



<?php  //} //FIN DU FETCH ?>


      

<br><br>
<div class="col-md-12 col-lg-12"> 
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_formulaire_liv_sain" data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON SAINS</td> 
  
       
  
    <?php $infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$infos->fetch()){ 

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
  <?php //affichage_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
   

 




 </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="container-fluid" class="" id="TableMouille" style="display: none;" >
      <div class="row">

            <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
        
<?php
 /* $TotalLivresMo=total_livraison_mouille($bdd,$c);
  $Sains_Recap=sain_reception($bdd,$c);
$SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
$SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
$TotalLivresL=total_livraison_sain($bdd,$c);

$recond_DEPART_Recap=reconditionnement_reception($bdd,$c);
$recond_LIV=reconditionnement_livraison($bdd,$c);

$TLivresMo=$TotalLivresMo->fetch();


 while($sain=$Sains_Recap->fetch()){
    $avr=$SomAvr_DEPART_Recap->fetch();
    

$rec=$recond_DEPART_Recap->fetch();
$rec_liv=$recond_LIV->fetch();


  $SomRa_DEPART_Recap->execute();

  $ra=$SomRa_DEPART_Recap->fetch();

  $TLivres=$TotalLivresL->fetch();
 

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;
$perte=$rec['sum(sac_eventres)']-$rec['sum(sac_av_recond)']-$rec['sum(sac_balayure_recond)'];

$total_sac=$SacSain+$SacMouille+$avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']+$ra['sum(sac_flasque_ra)']+$ra['sum(sac_mouille_ra)']-$perte;
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];*/

 ?>


  </center>
  <?php afficher_stock_depart_livraison($bdd,$produit,$poids_sac,$navire,$destination); ?>



          
          
<?php 
/*
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)']; */

 ?>
 
<div class="col col-md-6" style="border: solid; border-color: blue;">
  <h3 style="background: black; text-align: center; color: white !important;">RESTE A LIVRER</h3>
  <h6 style="float: right;">SACS SAINS LIVRES: <span style="color: red;"><?php //echo $TLivres['sum(sac_liv)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivres['sum(poids_liv)'].' T' ?></span></h6>
     <h6 style="float: right;">SACS MOUILLES LIVRES: <span style="color: red;"><?php //echo $TLivresMo['sum(sac_mo)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivresMo['sum(poids_mo)'].' T' ?></span></h6>
      <h6 style="float: right;">SACS BALAYURES LIVRES: <span style="color: red;"><?php //echo '0 SACS' ?></span> SOIT <span style="color: red;"><?php //echo '0 T' ?></span></h6>
      <h6 style="float: right;">PERTE SUR RECONDITIONNEMENT: <span style="color: red;"><?php //echo $perte_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $perte_poids.' T' ?></span></h6>

       <h6 style="background: yellow; float: right;">RESTE A LIVRER: <span style="color: red;"><?php //echo $sac_reste_livrer.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $poids_reste_livrer.' T' ?></span></h6>

      </div>
    
  </div>
</div>


        
<br>
<div class="col-md-12 col-lg-12">      
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_formulaire_liv_mouille" data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON MOUILLE  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON DES MOUILLES</td> 
  
   <?php $infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$infos->fetch()){ 

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
  
<?php affichage_livraison_mouille($bdd,$produit,$poids_sac,$navire,$destination); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>



<div class="container-fluid" class="" id="TableBalayure"  style="display: none;">
      <div class="row">

             <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
    <?php
 /* $TotalLivresMo=total_livraison_mouille($bdd,$c);
  $Sains_Recap=sain_reception($bdd,$c);
$SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
$SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
$TotalLivresL=total_livraison_sain($bdd,$c);

$recond_DEPART_Recap=reconditionnement_reception($bdd,$c);
$recond_LIV=reconditionnement_livraison($bdd,$c);

$TLivresMo=$TotalLivresMo->fetch();


 while($sain=$Sains_Recap->fetch()){
    $avr=$SomAvr_DEPART_Recap->fetch();
    

$rec=$recond_DEPART_Recap->fetch();
$rec_liv=$recond_LIV->fetch();


  $SomRa_DEPART_Recap->execute();

  $ra=$SomRa_DEPART_Recap->fetch();

  $TLivres=$TotalLivresL->fetch();
 

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;
$perte=$rec['sum(sac_eventres)']-$rec['sum(sac_av_recond)']-$rec['sum(sac_balayure_recond)'];

$total_sac=$SacSain+$SacMouille+$avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']+$ra['sum(sac_flasque_ra)']+$ra['sum(sac_mouille_ra)']-$perte;
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];*/

 ?>


  </center>
  <?php afficher_stock_depart_livraison($bdd,$produit,$poids_sac,$navire,$destination); ?>



          
          
<?php 
/*
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)']; */

 ?>
 
<div class="col col-md-6" style="border: solid; border-color: blue;">
  <h3 style="background: black; text-align: center; color: white !important;">RESTE A LIVRER</h3>
  <h6 style="float: right;">SACS SAINS LIVRES: <span style="color: red;"><?php //echo $TLivres['sum(sac_liv)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivres['sum(poids_liv)'].' T' ?></span></h6>
     <h6 style="float: right;">SACS MOUILLES LIVRES: <span style="color: red;"><?php //echo $TLivresMo['sum(sac_mo)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivresMo['sum(poids_mo)'].' T' ?></span></h6>
      <h6 style="float: right;">SACS BALAYURES LIVRES: <span style="color: red;"><?php //echo '0 SACS' ?></span> SOIT <span style="color: red;"><?php //echo '0 T' ?></span></h6>
      <h6 style="float: right;">PERTE SUR RECONDITIONNEMENT: <span style="color: red;"><?php //echo $perte_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $perte_poids.' T' ?></span></h6>

       <h6 style="background: yellow; float: right;">RESTE A LIVRER: <span style="color: red;"><?php //echo $sac_reste_livrer.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $poids_reste_livrer.' T' ?></span></h6>

      </div>
    
  </div>
</div>



<br>
<div class="col-md-12 col-lg-12">      
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_formulaire_liv_balayure" data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON BALAYURE  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON DES BALAYURES</td> 
  
       
  


    <?php $infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$infos->fetch()){ 

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

    
        
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
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
      <td> ACTIONS </td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
 
 <?php affichage_livraison_balayure($bdd,$produit,$poids_sac,$navire,$destination); ?>

</tbody>
 
 
</table>
</div>
</div>
</div>
</div>



<div class="container-fluid" class="" id="TableAvaries" style="display: none;" >
      <div class="row">

      

<br>
<div class="col-md-12 col-lg-12"> 
<?php $selectid_dis= bouton_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination);
  if($sel=$selectid_dis->fetch()){
  echo $sel['id_decliv']; ?>     
<a  class="btn1"  style="background: rgb(65,180,190); " data-role='affiche_formulaire_av'   
data-declaration="<?php echo $sel['id_decliv'] ?>" >AJOUTER AVARIES  </a>
<?php } ?>

</div>
<br><br>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="4"  > AVARIES DE LIVRAISON</td> 
  
  

      
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > SAC FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>

      

  
     </tr>
     
    
     </thead>

<tbody> 
  


<?php affichage_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="container-fluid" id="TableRecond" style="display: none;">  
  <br>

  
  <div class="col-md-12 col-lg-12"> 
  <?php $selectid_dis=bouton_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination); 
     if($sel=$selectid_dis->fetch()){
  ?>     
<a  class="btn1"  style="background: rgb(65,180,190); " data-role='affiche_formulaire_reond_liv'  data-declaration="<?php echo $sel['dec_liv']; ?>" >AJOUTER RECONDITIONNEMENT  </a>
<?php } ?>
<br><br>
</div>

 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
  <!--    <td  rowspan="2"   >N°</td>  !-->
       <td   rowspan="2"   >DATE</td>
      <!--  <td   colspan="2"   >FLASQUES DE LIVRAISON</td> !-->
        <td  rowspan="2"  >SACS DECHIRES</td>
     
      <td   colspan="2" > RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
       <td   rowspan="2"  >FLASQUES RESTANTS</td>
  </tr>
      
 <tr id="th_table_rec" >
   <!--   <td  >SACS</td> !-->
    
    <!--  <td  >POIDS</td> !-->

   

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>

     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>
  <?php

     

        
      //  $recondLigne = compte_ligne_reconditionnement_livraison($bdd,$c);
    
        
     // $SomAvrLigne = compte_ligne_avaries_livraison($bdd,$c); 
      
    //  $afficher_somme_avaries_livraison=afficher_somme_avaries_livraison($bdd,$c);
        

        //  $poids_kg=find_poids_kg($bdd,$c);

  //  $compterecond=compte_reconditionnement_livraison($bdd,$c);

  // $compte=$compterecond->fetch();

 /* if($compte['count(id_dis_recond_liv)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="13">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php } */ ?> 

  <?php
       // $recond=afficher_reconditionnement_livraison($bdd,$c);
  $recond=afficher_recond_livraison($bdd,$produit,$poids_sac,$navire,$destination);
 
   while($rec=$recond->fetch()){ 
     $somme_avaries=somme_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination);
    $som_av=$somme_avaries->fetch();

   /* $precedent= $rec['id_recond_liv'];
    $recond2=reconditionnement_livraison_precedent($bdd,$precedent);  
           
  

     
        $afficher_somme_avaries_livraison->execute();

        $poids_kg->execute();




    $avr=$afficher_somme_avaries_livraison->fetch();
//$ra=$SomRa->fetch();
$poids=$poids_kg->fetch();
$rec2=$recond2->fetch();

    

$poidsf_avr=$avr['sum(sac_flasque_liv)']*$poids['poids_kg']/1000;
$sacflasque=$avr['sum(sac_flasque_liv)'];
$poidsflasque=$poidsf_avr;
$perte=$rec['sac_eventres_liv']-$rec['sac_av_recond_liv']-$rec['sac_balayure_recond_liv'];




//$perte_recul recupere de valeur de l'avant dernier du perte en sac pour l'afficher dans la cellule suivante du flasques receptionnés 
$perte_recul=$sacflasque-$rec2['sum(sac_eventres_liv)'] ;
$poids_recul=$perte_recul*$poids['poids_kg']/1000;
*/
$perte=$rec['sac_eventres_liv']-$rec['sac_av_recond_liv']-$rec['sac_balayure_recond_liv'];
 
 $date=explode('-', $rec['dates_recond_liv']);
   
  /*  
   $diff=$aff['poids_declarer']-$aff['sum(rec.poids_recep)'];

   $float = $bdd->prepare("SELECT count(bl_recep) from reception

                   WHERE id_dis_recep_bl=? and dates_recep=? and id_recep<=?  ");
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates_recep']);
        $float->bindParam(3,$aff['id_recep']);

        $float->execute();
        $f=$float->fetch(); */
        $restant_flasque=$som_av['sum(avl.sac_flasque_liv)']-$rec['cumulative_sum'];
     
    ?>
   
      
     <tr id="tr_data_sain" >

  <!--    <td style="width: 5%;" class="colaffiche"> <?php //echo $rec2['count(sac_av_recond_liv)'] ?> !-->

<td style="width: 10%;" class="colaffiche" > <?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
<?php /* if( $recligne=$recondLigne->fetch()){ 
  $avrLigne=$SomAvrLigne->fetch();
//$raLigne=$SomRaLigne->fetch();
 $poidsf_avrLigne=$avrLigne['sum(sac_flasque_liv)']*$poids['poids_kg']/1000;

$sacflasqueLigne=$avrLigne['sum(sac_flasque_liv)'];
$poidsflasqueLigne=$sacflasqueLigne*$poids['poids_kg']/1000; */

  ?>

  <?php //} ?>
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($rec['sac_eventres_liv'], 0,',',' '); ?></td>
   
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($rec['sac_av_recond_liv'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($rec['poids_av_recond_liv'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['sac_balayure_recond_liv'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($rec['poids_balayure_recond_liv'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>

     <td style="width: 10%;" class="colaffiche" > <?php /*if($rec2['count(sac_av_recond_liv)']==1){ echo number_format($perte_recul, 0,',',' '); } if($rec2['count(sac_av_recond_liv)']>1){ echo number_format($perte_recul, 0,',',' '); }*/  ?> <?php echo $restant_flasque; ?> </td>
   

   
      


</tr>


  <?php   } ?>




</tbody>
             

            

</table>
</div>
</div>
</div>
<br><br>



<?php 
       $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
  while($row=$res4->fetch()){ ?>


<div class="modal fade" id="form_livraison" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT LIVRAISON</h3></center>
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
        <br>
        <div id="changer_select">
        

 
         
        </div>

                
             <label style="float: left;" >CAMION </label> <label style="float: right;">CHAUFFEUR </label><br>
        <input style="height: 25px; width: 40%; float: left; " type="int"   id="camion_liv"  name="sac"  >
          <input style="height: 25px; width: 40%; float: right;" type="int"   id="chauf_liv"  name="sac"  ><br><br> 
            
          <label style="float: left;">TELEPHONE </label>   <label style="float: right;">PERMIS </label ><br>  
       
        <input style="height: 25px; width: 40%; float: left;" type="phone"   id="tel_liv"  name="sac"  >
           
        <input style="height: 25px; width: 40%; float: right;" type="int"   id="permis_liv"  name="sac"  ><br><br>  
          
         
         <label style="float: left;">SAC </label><br> 
        <input style="height: 25px;" type="number"  id="sac_liv"  name="sac" value="0" ><br><br>
        
                <label>DESTINATION</label><br>
        <input style="height: 25px;" type="text"  id="destination_livraison"    ><br>
      </div>
         <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="statut"  name="sac"   ><br>
         
       <div style="display: none;">     
        <label>poids_sac </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="poids_sac_liv"  name="sac" value="<?php echo $poids_sac; ?>"  ><br>    
        <label>id_produit </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_produit_liv"  name="sac" value="<?php echo $produit; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_liv"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 
        <label>id_navire </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_liv"  name="sac" value="<?php echo $navire; ?>"  ><br> 
        <label>destination </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_destination_liv"  name="sac" value="<?php echo $destination; ?>"  ><br>
        </div>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_s"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_liv">valider</a>
          <a  id="ajout_m"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_liv_mouille" >valider mouille</a>
           <a  id="ajout_bal"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_bal">valider balayure</a>



         
      </div>
  </center>
      
    </div>
  </div>
</div>



<div style="z-index: 9999999;" class="modal fade" id="form_avaries_livraison" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT AVARIES DE LIVRAISON</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_avl" class="form-control"   name="date" ><br>
   <label> FLASQUES DE LIVRAISONS EN SACS</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=flasque_avl ><br>
     <label>MOUILLE DE LIVRAISON EN SACS</label>
     <input style="height: 25px;" type="number" class="form-control" value="0"  id="mouille_avl"  name="camion"  ><br>
     <div style="">  
   <label>id_dis</label>  
   <input type="text" id="id_dis_avl"  class="form-control"   name="FF" value="<?php echo $row['id_dis'];  ?>" ><br>
      <label>id_nav</label>  
   <input type="text" id="id_navire_avl"  class="form-control"   name="FF" value="<?php echo $navire;  ?>" ><br> 
    <label>id_produit</label>  
   <input type="text" id="id_produit_avl"  class="form-control"   name="FF" value="<?php echo $produit;  ?>" ><br> 
    <label>poids_sac</label>  
   <input type="text" id="poids_sac_avl"  class="form-control"   name="FF" value="<?php echo $poids_sac;  ?>" ><br> 
    <label>destination</label>  
   <input type="text" id="id_destination_avl"  class="form-control"   name="FF" value="<?php echo $destination;  ?>" ><br> 
    <label>declaration</label>  
   <input type="text" id="id_declaration_avl"  class="form-control"  name="FF"  ><br> 
   </div> 
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_avl" style="width: 50%;" class="btn btn-primary " name="valider_reception" data-role="ajout_avl">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>


<div style="z-index: 9999999;" class="modal fade" id="form_reconditionnement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">RECONDITIONNEMENT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_recond" class="form-control"   name="date" ><br>
   <label> SACS EVENTRES</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_eventres ><br>
   <label> SACS RECONDITIONNER</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_recond ><br>
     <label>balayure sac</label>
     <input style="height: 25px;" type="number" class="form-control" value="0"  id="sac_balayure"  name="camion"  ><br>
   <label>balayure poids</label>  
   <input type="number" id="poids_balayure"  class="form-control"   name="FF" value="0" ><br>
   <div style=""> 

    <input type="text" id="poids_sac_recond"  class="form-control"   name="FF" value="<?php echo $poids_sac;  ?>" ><br>     
      <input type="text" id="id_dis_recond"  class="form-control"   name="FF" value="<?php echo $row['id_dis'];  ?>" ><br>
       <input type="text" id="navire_recond"  class="form-control"   name="FF"  value="<?php echo $navire;  ?>" ><br>   
      <input type="text" id="id_produit_recond"  class="form-control"   name="FF"  value="<?php echo $produit;  ?>" ><br> 
      <input type="text" id="id_destination_recond"  class="form-control"   name="FF"  value="<?php echo $destination;  ?>" ><br> 
       <input type="text" id="id_declaration_recond"  class="form-control"   name="FF"   ><br> 
      </div>
    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_recond" style="width: 50%;" class="btn btn-primary " name="valider_reception" data-role="ajout_recond">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="form_relache" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;">AJOUT RELACHE</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_rel" class="form-control"   name="date" ><br>

   
   
     
      <label>NUMERO RELACHE </label>
        <input style="height: 25px;" type="text" class="form-control"  id="num_rel"  name="sac"  ><br>
              <label>POIDS RELACHE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="poids_rel"  name="sac" value="0" ><br>
         
           <label>BANQUE </label>
           <input disabled="true" style="height: 25px;" type="text" class="form-control"     value="<?php echo htmlspecialchars($row['banque']); ?>"  ><br> 
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="banque_rel"  name="sac" value="<?php echo $row['id_banque_dis']; ?>"   ><br>    
        <label>NAVIRE </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_rel"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br>    
        <label>ID_DIS </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_rel"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br>  

        </div>  

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_rel"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_relache">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>



<div class="modal fade" id="form_enleve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT BON D'ENLEVEMENT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_enleve" class="form-control"   name="date" ><br>

   
   
     
      <label>NUMERO BON D'ENLEVEMET </label>
        <input style="height: 25px;" type="text" class="form-control"  id="num_enleve"  name="sac"  ><br>
              <label>POIDS  </label>
        <input style="height: 25px;" type="int" class="form-control"  id="poids_enleve"  name="sac" value="0" ><br>
         
              
        <label>NAVIRE </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_enleve"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br>    
        <label>ID_DIS </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_enleve"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_rel"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_bon_enlevement">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>



<div class="modal fade" id="form_declaration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT RELACHE</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_dec" class="form-control"   name="date" ><br>

   
   
     
      <label>NUMERO DECLARATION </label>
        <input style="height: 25px;" type="text" class="form-control"  id="num_dec"  name="sac"  ><br>
              <label>POIDS A DECLARER </label>
        <input style="height: 25px;" type="int" class="form-control"  id="poids_dec"  name="sac" value="0" ><br>
         
              
        <label>NAVIRE </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_dec"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br>    
        <label>ID_DIS </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_dec"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_dec"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_dec">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>






<div class="modal fade" id="form_update_livraison_sain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFIER LIVRAISON</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >

       </center> 


      </div>
  

        <form  method="POST">
   
 
 <div class="mb-3"> 
  
    
    <label>DATE</label>
     <label style="float: right;">HEURE </label><br>   
   <input type="date" id="date_liv_update_sain" class="selectform"   name="date" >

   
  
        <input style="float: right;" type="time" class="selectform"  id="heure_liv_update_sain"  name="sac"  ><br><br>  
        <?php $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();

         $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec2->bindParam(1,$c);
         $choose_dec2->execute(); ?>
         <label style="float: left; width: 40%; margin-right: 3%;"> choisir une relache</label>
         <label style="float: right; width: 40%; margin-right: 3%;"> choisir une relache</label> <br>  
        <select id="dec_liv_update_sain" style="float: left; width: 40%; margin-right: 3%;">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel->bindParam(1,$c);
         $choose_rel->execute();

         $choose_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel2->bindParam(1,$c);
         $choose_rel2->execute(); ?>

        <select id="rel_liv_update_sain" style="float: right; width: 40%; margin-right: 3%;">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br><br> 

        <?php $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon->bindParam(1,$c);
         $choose_bon->execute();

         $choose_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon2->bindParam(1,$c);
         $choose_bon2->execute();


          ?>
        <label > choisir un bon fournisseur</label><br> 
        <select id="bl_fournisseur_update_sain">
          <option value="">Choisir une bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br><br> 


             <label>CAMION </label>
        <input style="height: 25px;" type="int" class="form-control"  id="camion_liv_update_sain"  name="sac"  ><br>
             <label>CHAUFFEUR </label>
        <input style="height: 25px;" type="int" class="form-control"  id="chauffeur_liv_update_sain"  name="sac"  ><br>
        <div style="display: none;"> 
             <label>TELEPHONE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="tel_liv_update_sain"  name="sac" hidden="true" ><br>
             <label>PERMIS </label>
        <input style="height: 25px;" type="int" class="form-control"  id="permis_liv_update_sain"  name="sac"  ><br>
        </div>
          
         
         <label>SAC </label>
        <input style="height: 25px;" type="number" class="form-control"  id="sac_liv_update_sain"  name="sac" value="0" ><br>
      </div>
         
         
       <div style="display: none;">     
  
        <label>id </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_liv_update_mouille"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_liv_update_sain"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_produit_update_sain"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="poids_sac_update_sain"  name="sac" value="<?php echo $row['poids_kg']; ?>"  ><br>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_destination_update_sain"  name="sac" value="<?php echo $row['id_mangasin']; ?>"  ><br>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_update_sain"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br>


        </div>  
        <input  style="height: 25px;" type="text" class="form-control"  id="id_liv_update_sains"  name="sac"  ><br>  

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_"  style="width: 50%;" class="btn btn-primary " name="valider" data-roles="click_update_livraison_sain">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>


<div class="modal fade" id="form_update_livraison_mouille" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFIER LIVRAISON</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >

       </center> 


      </div>
 

        <form  method="POST">
   
 
 <div class="mb-3"> 
  
    
    <label>DATE</label>
     <label style="float: right;">HEURE </label><br>   
   <input type="date" id="date_liv_update_mouille" class="selectform"   name="date" >

   
  
        <input style="float: right;" type="time" class="selectform"  id="heure_liv_update_mouille"  name="sac"  ><br><br>  
        <?php $choose_dec=declaration_livres_sain($bdd,$c);
              $choose_dec2=declaration_livres_mouille($bdd,$c);
              $choose_dec3=declaration_livres_balayure($bdd,$c);

          ?>
         <label style="float: left; width: 40%; margin-right: 3%;"> choisir une declaration</label>
         <label style="float: right; width: 40%; margin-right: 3%;"> choisir une relache</label> <br>  
        <select id="dec_liv_update_mouille" style="float: left; width: 40%; margin-right: 3%;">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();
            $lesdec3=$choose_dec3->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)']-$lesdec3['sum(liv_balayure.poids_bal)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel= relache_livres_sain($bdd,$c);
               $choose_rel2= relache_livres_mouille($bdd,$c);
               $choose_rel3= relache_livres_balayure($bdd,$c); ?>

        <select id="rel_liv_update_mouille" style="float: right; width: 40%; margin-right: 3%;">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();
            $lesrel3=$choose_rel3->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)']-$lesrel3['sum(liv_balayure.poids_bal)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br><br> 

       <?php $choose_bon=bon_livres_sain($bdd,$c);
              $choose_bon2=bon_livres_mouille($bdd,$c);
              $choose_bon3=bon_livres_balayure($bdd,$c);


          ?>
        <label > choisir un bon fournisseur</label><br> 
        <select id="bl_fournisseur_update_mouille">
          <option value="">Choisir une bon d'enlevement</option>

          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();
            $lesbon3=$choose_bon3->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)']-$lesbon3['sum(liv_balayure.poids_bal)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br><br> 


             <label>CAMION </label>
        <input style="height: 25px;" type="int" class="form-control"  id="camion_liv_update_mouille"  name="sac"  ><br>
             <label>CHAUFFEUR </label>
        <input style="height: 25px;" type="int" class="form-control"  id="chauffeur_liv_update_mouille"  name="sac"  ><br>
        <div style="display: none;"> 
             <label>TELEPHONE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="tel_liv_update_mouille"  name="sac" hidden="true" ><br>
             <label>PERMIS </label>
        <input style="height: 25px;" type="int" class="form-control"  id="permis_liv_update_mouille"  name="sac"  ><br>
        </div>
          
         
         <label>SAC </label>
        <input style="height: 25px;" type="number" class="form-control"  id="sac_liv_update_mouille"  name="sac" value="0" ><br>
      </div>
         
         
       <div style="display: none;">     
  
        <label>id </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_liv_update_sain"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_liv_update_mouille"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 

        </div>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_"  style="width: 50%;" class="btn btn-primary " name="valider" data-roles="click_update_livraison_mouille">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>




<div class="modal fade" id="form_update_livraison_balayure" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFIER LIVRAISON</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >

       </center> 


      </div>
  <div >

  <?php 
      while($find_bl=$bl->fetch()){
        if($find_bl['max(s.id_liv)']>$find_bl['max(m.id_mo)'] and $find_bl['max(s.id_liv)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(s.id_liv)']+1;
        }
        if($find_bl['max(m.id_mo)']>$find_bl['max(s.id_liv)'] and $find_bl['max(m.id_mo)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(m.id_mo)']+1;
        }
        if($find_bl['max(b.id_bal)']>$find_bl['max(m.id_mo)'] and $find_bl['max(b.id_bal)']>$find_bl['max(s.id_liv)']){
          $val_bl=$find_bl['max(b.id_bal)']+1;
        }
          ?>
      
      
        <label style="margin-top: 5px !important;">NAVIRE: <span style="color: red;"> <?php echo $find_bl['navire']; ?></span></label><br>  
         <label style="margin-top: 5px !important;">PRODUIT: <span style="color: red;"><?php echo $find_bl['produit'].' '.$find_bl['qualite'].' '.$find_bl['poids_kg'] ?></span></label><br> 
          <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $find_bl['id_dis_liv'].''.$val_bl; ?></span></label><br> 

    <?php } 
   
    ?>

    
  </div>

        <form  method="POST">
   
 
 <div class="mb-3"> 
  
    
    <label>DATE</label>
     <label style="float: right;">HEURE </label><br>   
   <input type="date" id="date_liv_update_balayure" class="selectform"   name="date" >

   
  
        <input style="float: right;" type="time" class="selectform"  id="heure_liv_update_balayure"  name="sac"  ><br><br>  
        <?php $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();

         $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec2->bindParam(1,$c);
         $choose_dec2->execute(); ?>
         <label style="float: left; width: 40%; margin-right: 3%;"> choisir une relache</label>
         <label style="float: right; width: 40%; margin-right: 3%;"> choisir une relache</label> <br>  
        <select id="dec_liv_update_balayure" style="float: left; width: 40%; margin-right: 3%;">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel->bindParam(1,$c);
         $choose_rel->execute();

         $choose_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel2->bindParam(1,$c);
         $choose_rel2->execute(); ?>

        <select id="rel_liv_update_balayure" style="float: right; width: 40%; margin-right: 3%;">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br><br> 

        <?php $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon->bindParam(1,$c);
         $choose_bon->execute();

         $choose_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon2->bindParam(1,$c);
         $choose_bon2->execute();


          ?>
        <label > choisir un bon fournisseur</label><br> 
        <select id="bl_fournisseur_update_balayure">
          <option value="">Choisir une bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br><br> 


             <label>CAMION </label>
        <input style="height: 25px;" type="int" class="form-control"  id="camion_liv_update_balayure"  name="sac"  ><br>
             <label>CHAUFFEUR </label>
        <input style="height: 25px;" type="int" class="form-control"  id="chauffeur_liv_update_balayure"  name="sac"  ><br>
        <div style="display: none;"> 
             <label>TELEPHONE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="tel_liv_update_balayure"  name="sac" hidden="true" ><br>
             <label>PERMIS </label>
        <input style="height: 25px;" type="int" class="form-control"  id="permis_liv_update_balayure"  name="sac"  ><br>
        </div>
          
         
         <label>SAC </label>
        <input style="height: 25px;" type="number" class="form-control"  id="sac_liv_update_balayure"  name="sac" value="0" ><br>
      </div>
         
         
       <div style="display: none;">     
  
        <label>id </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_liv_update_balayure"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_liv_update_balayure"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 

        </div>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_"  style="width: 50%;" class="btn btn-primary " name="valider" data-roles="click_update_livraison_balayure">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>









<div class="modal fade" id="form_livraison_mouille" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT LIVRAISON AVARIES</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <div >

     <label style="margin-top: 5px !important;">NAVIRE: <span style="color: red;"> <?php echo $row['navire']; ?></span></label><br>  
         <label style="margin-top: 5px !important;">PRODUIT: <span style="color: red;"><?php echo $row['produit'].' '.$row['qualite'].' '.$row['poids_kg'] ?></span></label><br>

  
   

    
  </div>
       <br> <br>
        <form  method="POST">



<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_mo" class="form-control"   name="date" ><br>

   
   
     
      <label>HEURE </label>
        <input style="height: 25px;" type="time" class="form-control"  id="heure_mo"  name="sac"  ><br>

                <?php 
       $bl=bl_suivant($bdd,$c);
      $find_bl=$bl->fetch();
        echo $find_bl['max(s.bl_simar)'];
        echo $find_bl['max(m.bl_simar_mo)'];
        if($find_bl['max(s.bl_simar)']>$find_bl['max(m.bl_simar_mo)'] and $find_bl['max(s.bl_simar)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(s.bl_simar)']+1;
        }
        if($find_bl['max(m.bl_simar_mo)']>$find_bl['max(s.bl_simar)'] and $find_bl['max(m.bl_simar_mo)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(m.bl_simar_mo)']+1;
        }
        if($find_bl['max(b.id_bal)']>$find_bl['max(m.bl_simar_mo)'] and $find_bl['max(b.id_bal)']>$find_bl['max(s.bl_simar)']){
          $val_bl=$find_bl['max(b.id_bal)']+1;
        }
           if(empty($find_bl['max(b.id_bal)'])and empty($find_bl['max(m.bl_simar_mo)']) and empty($find_bl['max(s.bl_simar)'])){
          $val_bl=$row['id_dis'].'1';
        }
          ?>
      
      
       
         <?php  if(empty($find_bl['max(b.id_bal)'])and empty($find_bl['max(m.bl_simar_mo)']) and empty($find_bl['max(s.bl_simar)'])){ ?> 
          <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $find_bl['id_dis_liv'].''.$val_bl; ?></span></label><br>
          <?php   } 
            if(!empty($find_bl['max(b.id_bal)']) or !empty($find_bl['max(m.bl_simar_mo)']) or !empty($find_bl['max(s.bl_simar)'])){  
          ?> <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $val_bl; ?></span></label><br>
        <?php   } ?>



         <input id="bl_simar_mo" type="text" name="" value="<?php echo $val_bl; ?>">


       <?php $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();

         $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec2->bindParam(1,$c);
         $choose_dec2->execute(); ?>

        <select id="dec_mo">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel->bindParam(1,$c);
         $choose_rel->execute();

         $choose_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel2->bindParam(1,$c);
         $choose_rel2->execute(); ?>

        <select id="rel_mo">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br>

        <?php $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon->bindParam(1,$c);
         $choose_bon->execute();

         $choose_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon2->bindParam(1,$c);
         $choose_bon2->execute();


          ?>

        <select id="bl_fournisseur_mo">
          <option value="">Choisir une bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br>


 
             <label>CAMION </label>
        <input style="height: 25px;" type="int" class="form-control"  id="camion_mo"  name="sac"  ><br>
             <label>CHAUFFEUR </label>
        <input style="height: 25px;" type="int" class="form-control"  id="chauf_mo"  name="sac"  ><br>
             <label>TELEPHONE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="tel_mo"  name="sac"  ><br>
             <label>PERMIS </label>
        <input style="height: 25px;" type="int" class="form-control"  id="permis_mo"  name="sac"  ><br>
          
         
         <label>SAC </label>
        <input style="height: 25px;" type="number" class="form-control"  id="sac_mo"  name="sac" value="0" ><br>
         
         
       <div style="display: none;">     
        <label>poids_sac </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="poids_sac_mo"  name="sac" value="<?php echo $row['poids_kg']; ?>"  ><br>    
        <label>id_produit </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_produit_mo"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_mo"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 
        <label>id_navire </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_mo"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br> 
        </div>    

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_liv_mouille">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>





<div style="z-index: 9999999;" class="modal fade" id="form_reconditionnement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">RECONDITIONNEMENT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_recond" class="form-control"   name="date" ><br>
   <label> SACS EVENTRES</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_eventres ><br>
   <label> SACS RECONDITIONNER</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_recond ><br>
     <label>balayure sac</label>
     <input style="height: 25px;" type="number" class="form-control" value="0"  id="sac_balayure"  name="camion"  ><br>
   <label>balayure poids</label>  
   <input type="number" id="poids_balayure"  class="form-control"   name="FF" value="0" ><br>
   <div style="display: none;">  
    <input type="text" id="poids_sac_recond"  class="form-control"   name="FF" value="<?php echo $row['poids_kg'];  ?>" ><br>     
      <input type="text" id="id_dis_recond"  class="form-control"   name="FF" value="<?php echo $row['id_dis'];  ?>" ><br>
       <input type="text" id="navire_recond"  class="form-control"   name="FF"  value="<?php echo $row['id_navire'];  ?>" ><br>   
      <input type="text" id="id_produit_recond"  class="form-control"   name="FF"  value="<?php echo $row['id_produit'];  ?>" ><br> 
      <input type="text" id="id_destination_recond"  class="form-control"   name="FF"  value="<?php echo $row['id_mangasin'];  ?>" ><br> 
      </div>
    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout_recond" style="width: 50%;" class="btn btn-primary " name="valider_reception" data-role="ajout_recond">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="form_livraison_balayure" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT LIVRAISON BALAYURE</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">


      ?>



   <div class="mb-3">
    
    <label>DATE</label>
     <label style="float: right;">HEURE </label><br>   
   <input type="date" id="date_bal" class="selectform"   name="date" >

   
   
     
      
        <input style="float: right;" type="time" class="selectform"  id="heure_bal"  name="sac"  ><br><br>  
        <?php $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();

         $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec2->bindParam(1,$c);
         $choose_dec2->execute(); ?>

        <select id="dec_bal">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel->bindParam(1,$c);
         $choose_rel->execute();

         $choose_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel2->bindParam(1,$c);
         $choose_rel2->execute(); ?>

        <select id="rel_bal">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br>

        <?php $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon->bindParam(1,$c);
         $choose_bon->execute();

         $choose_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon2->bindParam(1,$c);
         $choose_bon2->execute();


          ?>

        <select id="bl_fournisseur_bal">
          <option value="">Choisir une bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br>


             <label>CAMION </label>
        <input style="height: 25px;" type="int" class="form-control"  id="camion_bal"  name="sac"  ><br>
             <label>CHAUFFEUR </label>
        <input style="height: 25px;" type="int" class="form-control"  id="chauf_bal"  name="sac"  ><br>
             <label>TELEPHONE </label>
        <input style="height: 25px;" type="int" class="form-control"  id="tel_bal"  name="sac"  ><br>
             <label>PERMIS </label>
        <input style="height: 25px;" type="int" class="form-control"  id="permis_bal"  name="sac"  ><br>
          
         
         <label>SAC </label>
        <input style="height: 25px;" type="number" class="form-control"  id="sac_bal"  name="sac" value="0" ><br>
         
         
       <div style="display: none;">     
        <label>poids_sac </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="poids_sac_bal"  name="sac" value="<?php echo $row['poids_kg']; ?>"  ><br>    
        <label>id_produit </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_produit_bal"  name="sac" value="<?php echo $row['id_produit']; ?>"  ><br>
        <label>id_dis </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_dis_bal"  name="sac" value="<?php echo $row['id_dis']; ?>"  ><br> 
        <label>id_navire </label>
        <input disabled="true" style="height: 25px;" type="text" class="form-control"  id="id_navire_bal"  name="sac" value="<?php echo $row['id_navire']; ?>"  ><br> 
        </div>   

</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="ajout"  style="width: 50%;" class="btn btn-primary " name="valider" data-role="ajout_bal">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>


<?php   } ?>













<div class="container-fluid" class="" id="TableRelache" style="display: none;"  >
      <div class="row">
 <center>
      <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_relache" >AJOUTER RELACHE  </a>
<br>
</div>  <br>
         
        
              
      <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
    
      <?php $recap_Relache=$bdd->prepare("SELECT rel.*, sum(liv.sac_liv), sum(liv.poids_liv) from relache as rel
      left join livraison_sain as liv on rel.id_rel=liv.relache_liv 
      WHERE rel.id_dis_rel=? GROUP BY rel.num_rel,rel.id_rel order by rel.id_rel");
   $recap_Relache->bindParam(1,$c);
   $recap_Relache->execute();

           
          $relacheT=$bdd->prepare("SELECT sum(poids_rel) from relache 
      WHERE id_dis_rel=? ");
   $relacheT->bindParam(1,$c);
   $relacheT->execute();

            $livraisonT=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain 
      WHERE id_dis_liv=? ");
   $livraisonT->bindParam(1,$c);
   $livraisonT->execute();
   
 
      ?>
         <td style="  background: rgb(65,180,190);"  class="titreAVR" colspan="6"  >SITUATION DES RELACHES</td>
         <?php  
          $infos_rel=$bdd->prepare("SELECT dis.poids_kg, dis.n_bl,  p.*, mg.mangasin, nav.navire, nav.type,cli.client,b.banque
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         left join banque as b on b.id=dis.id_banque_dis
         where dis.id_dis=?
         ");
        $infos_rel->bindParam(1,$c);
        $infos_rel->execute();
       

       if($inf=$infos_rel->fetch()){

     ?>
      <tr class="entete_relache"    >
     <td style="border: none;" >NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td >TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td  >PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td >CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        <td  >CONNAISSEMENT:<span id="lesInfos"> <?php echo $inf['n_bl']; ?></span></td>

         
          </tr>
         <tr class="entete_relache"    >
          <td >ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td colspan="2"  >RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
          <td colspan="2"  >BANQUE:<span id="lesInfos"> <?php echo $inf['banque']; ?></span></td>
        </tr>
           
       
<?php } ?>
            <tr id="entete_table_relache"  >
              <td  style="">POIDS MANIFEST</td>
              <td   >N° RELACHE</td>
              
              <td  >QUANTITE RELACHE</td>
              <td  >BALANCE</td>
             
               <td  >RESTE A LIVRER SUR RELACHE</td>

            </tr>

          <?php 
          $recap_Relacherow=$bdd->prepare("SELECT rel.*, sum(liv.sac_liv), sum(liv.poids_liv) from relache as rel
      left join livraison_sain as liv on rel.id_rel=liv.relache_liv 
      WHERE rel.id_dis_rel<=? GROUP BY rel.num_rel,rel.id_rel");
   $recap_Relacherow->bindParam(1,$c);
   $recap_Relacherow->execute();

             $compte_relache=$bdd->prepare("SELECT count(num_rel) from relache where id_dis_rel=?");
   $compte_relache->bindParam(1,$c);
   $compte_relache->execute();

            


          while($recapl=$recap_Relache->fetch()){
             $manifest=$bdd->prepare("SELECT poids_t from dispatching where id_dis=?");
             $manifest->bindParam(1,$c);
             $manifest->execute();
           $manif=$manifest->fetch();

            $relache_inferieur=$bdd->prepare("SELECT sum(poids_rel) from relache where id_dis_rel=? and id_rel<=?");
             $relache_inferieur->bindParam(1,$c);
             $relache_inferieur->bindParam(2,$recapl['id_rel']);
             $relache_inferieur->execute();
           $relinf=$relache_inferieur->fetch();



            $reste_relache=$recapl['poids_rel']-$recapl['sum(liv.poids_liv)'];
            $balance=$manif['poids_t']-$relinf['sum(poids_rel)'];

            $Sains0 = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains0->bindParam(1,$c);
        $Sains0->execute();

     /*   $SainsL0 = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $SainsL0->bindParam(1,$c);
        $SainsL0->execute(); */

      $recond_DEPART0 = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART0 ->bindParam(1,$c);
        $recond_DEPART0 ->execute();

                  $SomAvr_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");

      /*            $recond_DEPARTL0 = $bdd->prepare("SELECT count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_DEPARTL0 ->bindParam(1,$c);
        $recond_DEPARTL0 ->execute(); */
        
        
        $SomAvr_DEPART0->bindParam(1,$c);
        $SomAvr_DEPART0->execute(); 

       /*                $SomAvl_DEPARTL0 = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvl_DEPARTL0->bindParam(1,$c);
        $SomAvl_DEPARTL0->execute(); */





                          $SomRa_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART0->bindParam(1,$c);
        $SomRa_DEPART0->execute();


       $sain=$Sains0->fetch();
            $avr=$SomAvr_DEPART0->fetch();
  //  $avl=$SomAvl_DEPARTL0->fetch();
   // $sainl=$SainsL0->fetch();
//$ra=$SomRa_DEPART->fetch();
$rec=$recond_DEPART0->fetch();
// $recl=$recond_DEPARTL0->fetch();
 $ra=$SomRa_DEPART0->fetch();

 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']-$ra['sum(sac_flasque_ra)']-$ra['sum(sac_mouille_ra)']+$rec['sum(sac_av_recond)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];


/*
$poidsf_avrL=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSainL=$SacSain - $sainl['sum(sac_liv)']-$avl['sum(sac_flasque_liv)']-$avl['sum(sac_mouille_liv)']+$recl['sum(sac_av_recond_liv)'];
$poidsSainL=$SacSainL*$sain['poids_sac_recep']/1000;
$poidsflasqueL=$poidsf_avrL;
$SacMouilleL=$avl['sum(sac_mouille_liv)'];
$poidsMouilleL=$SacMouilleL*$sain['poids_sac_recep']/1000; */

//$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'];
/*
$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'] ;
$total_poidsL=$poidsSainL+$poidsMouilleL+$recl['sum(poids_balayure_recond_liv)']; */





             ?>
   <tr style="vertical-align: middle; text-align: center ; color: red; background: white;" >
    <?php if($com=$compte_relache->fetch()){ ?>
    <td rowspan="<?php echo $com['count(num_rel)']; ?>"><?php echo $manif['poids_t'] ?></td>
  <?php } ?>
     <td><?php echo $recapl['num_rel'] ?></td>
   
     <td><?php echo $recapl['poids_rel'] 
      ?></td>
     <td><?php echo $balance ?></td>
     <td><?php echo $reste_relache  ?></td>
     
   </tr>
 <?php } ?>
  <?php while($relT=$relacheT->fetch()){
                      
    $livT=$livraisonT->fetch(); 
    $reste_relacheT=$relT['sum(poids_rel)']-$livT['sum(poids_liv)'];
    $balanceT=$relT['sum(poids_rel)'];


    ?>
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
      <td colspan="2"> TOTAL</td>
      <td><?php echo $relT['sum(poids_rel)'] ?></td>
       <td><?php echo $balanceT ?></td>
    <td><?php echo $reste_relacheT ?></td>
 
    </tr>

    <?php  } ?>

 
     
      

          </table>
          </center>
        </div>


</div>
</div>



<div class="container-fluid" class="" id="TableEnleve" style="display: none;"  >
      <div class="row">

        
        <center> 
          <br>
              
      <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
    
      <?php $recap_enleve=$bdd->prepare("SELECT be.*, sum(liv.sac_liv), sum(liv.poids_liv) from bon_enlevement as be
      left join livraison_sain as liv on be.id_enleve=liv.relache_liv 
      WHERE be.id_dis_enleve=? GROUP BY be.num_enleve,be.id_enleve");
   $recap_enleve->bindParam(1,$c);
   $recap_enleve->execute();

           
          $enleveT=$bdd->prepare("SELECT sum(poids_enleve) from bon_enlevement 
      WHERE id_dis_enleve=? ");
   $enleveT->bindParam(1,$c);
   $enleveT->execute();

            $livraisonT=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain 
      WHERE id_dis_liv=? ");
   $livraisonT->bindParam(1,$c);
   $livraisonT->execute();
   
 
      ?>
         <td style="  background: rgb(65,180,190);"  class="titreAVR" colspan="6"  >SITUATION DES BONS D'ENLEVEMENT</td>
         <?php  
          $infos_be=$bdd->prepare("SELECT dis.poids_kg, p.*, mg.mangasin, nav.navire, nav.type,cli.client
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         where dis.id_dis=?
         ");
        $infos_be->bindParam(1,$c);
        $infos_be->execute();
       

       if($inf=$infos_be->fetch()){

     ?>
      <tr  style="  background: rgb(65,180,190); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
     <td  >NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td >TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td  >PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td >CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>

         <td >ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
         <tr>

           <tr  style="  background: rgb(65,180,190); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
          <td colspan="5"  >RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           
        </tr>
<?php } ?>
            <tr id="entete_table_declaration" style=" background: rgb(65,180,190);"  >
              <td  scope="col" style="color: white; vertical-align: middle;">STOCK DEPART</td>
              <td  scope="col" style="color: white; vertical-align: middle;">BON D'ENLEVEMENT</td>
             
              <td  scope="col" style="color: white; vertical-align: middle;">QUANTITE</td>
              <td  scope="col" style="color: white; vertical-align: middle;">BALANCE</td>
             
               <td  scope="col" style="color: white; vertical-align: middle;">RESTE A LIVRER SUR BON D'ENLEVEMENT</td>

            </tr>

          <?php 
          $recap_Enleverow=$bdd->prepare("SELECT be.*, sum(liv.sac_liv), sum(liv.poids_liv) from bon_enlevement as be
      left join livraison_sain as liv on be.id_enleve=liv.bl_fournisseur_liv 
      WHERE be.id_dis_enleve<=? GROUP BY be.num_enleve,be.id_enleve");
   $recap_Enleverow->bindParam(1,$c);
   $recap_Enleverow->execute();

             $compte_enleve=$bdd->prepare("SELECT count(num_enleve) from bon_enlevement where id_dis_enleve=?");
   $compte_enleve->bindParam(1,$c);
   $compte_enleve->execute();


          while($recapl=$recap_enleve->fetch()){
           

            $reste_relache=$recapl['poids_enleve']-$recapl['sum(liv.poids_liv)'];

            $Sains0 = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains0->bindParam(1,$c);
        $Sains0->execute();

     /*   $SainsL0 = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $SainsL0->bindParam(1,$c);
        $SainsL0->execute(); */

      $recond_DEPART0 = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART0 ->bindParam(1,$c);
        $recond_DEPART0 ->execute();

                  $SomAvr_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");

      /*            $recond_DEPARTL0 = $bdd->prepare("SELECT count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_DEPARTL0 ->bindParam(1,$c);
        $recond_DEPARTL0 ->execute(); */
        
        
        $SomAvr_DEPART0->bindParam(1,$c);
        $SomAvr_DEPART0->execute(); 

       /*                $SomAvl_DEPARTL0 = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvl_DEPARTL0->bindParam(1,$c);
        $SomAvl_DEPARTL0->execute(); */





                          $SomRa_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART0->bindParam(1,$c);
        $SomRa_DEPART0->execute();


       $sain=$Sains0->fetch();
            $avr=$SomAvr_DEPART0->fetch();
  //  $avl=$SomAvl_DEPARTL0->fetch();
   // $sainl=$SainsL0->fetch();
//$ra=$SomRa_DEPART->fetch();
$rec=$recond_DEPART0->fetch();
// $recl=$recond_DEPARTL0->fetch();
 $ra=$SomRa_DEPART0->fetch();

 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']-$ra['sum(sac_flasque_ra)']-$ra['sum(sac_mouille_ra)']+$rec['sum(sac_av_recond)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];


/*
$poidsf_avrL=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSainL=$SacSain - $sainl['sum(sac_liv)']-$avl['sum(sac_flasque_liv)']-$avl['sum(sac_mouille_liv)']+$recl['sum(sac_av_recond_liv)'];
$poidsSainL=$SacSainL*$sain['poids_sac_recep']/1000;
$poidsflasqueL=$poidsf_avrL;
$SacMouilleL=$avl['sum(sac_mouille_liv)'];
$poidsMouilleL=$SacMouilleL*$sain['poids_sac_recep']/1000; */

//$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'];
/*
$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'] ;
$total_poidsL=$poidsSainL+$poidsMouilleL+$recl['sum(poids_balayure_recond_liv)']; */



             ?>
   <tr style="vertical-align: middle; text-align: center ; color: red; background: white;" >
    <?php if($com=$compte_enleve->fetch()){ ?>
    <td rowspan="<?php echo $com['count(num_enleve)']; ?>"><?php echo $total_poids ?></td>
  <?php } ?>
     <td><?php echo $recapl['num_enleve'] ?></td>
     
     <td><?php echo $recapl['poids_enleve'] ?></td>
     <td><?php echo $reste_relache ?></td>
     <td><?php echo $reste_relache  ?></td>
     
   </tr>
 <?php } ?>
   <?php while($relT=$enleveT->fetch()){
    $livT=$livraisonT->fetch(); 
    $reste_relacheT=$relT['sum(poids_enleve)']-$livT['sum(poids_liv)'];
    ?>
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
      <td style="color: white;" colspan="2"> TOTAL</td>
      <td style="color: white;"><?php echo $relT['sum(poids_enleve)'] ?></td>
       <td style="color: white;"><?php echo $reste_relacheT ?></td>
    <td style="color: white;"><?php echo $reste_relacheT ?></td>
 
    </tr>

    <?php  } ?>

 
     
      

          </table>
          </center>
        </div>




<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_enleve" >AJOUTER BON D'ENLEVEMENT  </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php   $relache=$bdd->prepare("SELECT * from bon_enlevement where id_dis_enleve=?");
        $relache->bindParam(1,$c);
        $relache->execute();

 
  ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >RELACHE</td> 

       
  
    
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
          <td id="mytd" scope="col"   >DATE</td>
     
     
      <td id="mytd" scope="col" > N° BON</td>
      <td id="mytd" scope="col"  >POIDS BON</td>
    
      <td id="mytd">ACTIONS</td>
  
     </tr>
     
    
     </thead>

<tbody> 
<?php   while($rel=$relache->fetch()){
        $dt=explode('-', $rel['date_enleve']);


 ?>
 <tr> 
 <td class="colaffiche"> <?php  echo $dt[2].'-'.$dt[1].'-'.$dt[0]; ?> </td>
 <td class="colaffiche"> <?php  echo $rel['num_enleve'] ?> </td>
 <td class="colaffiche"> <?php  echo $rel['poids_enleve'] ?> </td>
 
 <form>  
 <td  style="vertical-align: middle; text-align: center; " >

 <div style="display: flex; justify-content: center;">   <a class="fabtn"  id="<?php echo $rel['id_enleve'] ?>"    onclick="deleteRelache(<?php echo $rel['id_enleve'] ?>)" > <i class="fa fa-trash  " ></i> </a>

 <a  class="fabtn" name="modify"  data-role="update_relache"  data-id="<?php echo $rel['id_enleve']; ?>"   > <i class="fa fa-edit " ></i></a>
 <a  class="fabtn" target="blank" name="modify"  href="fichier_reception.php?id=<?php echo $rel['id_enleve']; ?>" > <i class="fa fa-folder "  ></i></a>
 </div>

  
</td>
</form>


  </tr>
   
<?php   } ?>
  




 </tbody>
</table>
</div>
</div>
</div>
</div>





<div class="container-fluid" class="" id="TableDeclaration" style="display: none;"  >
      <div class="row">

          <center>
            <br>
    <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
    
      <?php $recap_Declaration=$bdd->prepare("SELECT decl.*, sum(liv.sac_liv), sum(liv.poids_liv) from declaration_liv as decl
      left join livraison_sain as liv on decl.id_decliv=liv.dec_liv 
      WHERE decl.id_dis_decliv=? GROUP BY decl.num_decliv,decl.id_decliv");
   $recap_Declaration->bindParam(1,$c);
   $recap_Declaration->execute();

           
          $declarationT=$bdd->prepare("SELECT sum(poids_decliv) from declaration_liv 
      WHERE id_dis_decliv=? ");
   $declarationT->bindParam(1,$c);
   $declarationT->execute();

            $livraisonT=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain 
      WHERE id_dis_liv=? ");
   $livraisonT->bindParam(1,$c);
   $livraisonT->execute();
   
 
      ?>
      <thead>
      <td style="background: rgb(0,162,232);" class="titreAVR" colspan="5"  >SITUATION DES DECLARATIONS</td>

      <?php
          
        $infos_dec=$bdd->prepare("SELECT dis.poids_kg, p.*, mg.mangasin, nav.navire, nav.type,cli.client
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         where dis.id_dis=?
         ");
        $infos_dec->bindParam(1,$c);
        $infos_dec->execute();
       

       if($inf=$infos_dec->fetch()){

     ?>
      <tr  style="background: rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
     <td  >NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td >TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td colspan="2" >PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td >CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
       
        <tr  style="background: rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
         
          <td colspan="3" >RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           
        </tr>
<?php } ?>
        
            <tr id="entete_table_declaration" style="background: rgb(0,162,232);"  >
              <td  scope="col" style="color: white; vertical-align: middle;">STOCK DEPART</td>
              <td  scope="col" style="color: white; vertical-align: middle;">N° DECLARATION</td>
              
              <td  scope="col" style="color: white; vertical-align: middle;">QUANTITE DECLARER</td>
              <td  scope="col" style="color: white; vertical-align: middle;">BALANCE</td>
             
               <td  scope="col" style="color: white; vertical-align: middle;">RESTE A LIVRER SUR DECLARATION</td>

            </tr>
          </thead> 
<?php 
          $recap_Declarationrow=$bdd->prepare("SELECT decl.*, sum(liv.sac_liv), sum(liv.poids_liv) from declaration_liv as decl
      left join livraison_sain as liv on decl.id_decliv=liv.dec_liv 
      WHERE decl.id_dis_decliv<=? GROUP BY decl.num_decliv,decl.id_decliv");
   $recap_Declarationrow->bindParam(1,$c);
   $recap_Declarationrow->execute();

             $compte_Declaration=$bdd->prepare("SELECT count(num_decliv) from declaration_liv where id_dis_decliv=?");
   $compte_Declaration->bindParam(1,$c);
   $compte_Declaration->execute();


          while($recapl=$recap_Declaration->fetch()){
           

            $reste_declaration=$recapl['poids_decliv']-$recapl['sum(liv.poids_liv)'];

            $Sains0 = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains0->bindParam(1,$c);
        $Sains0->execute();

     /*   $SainsL0 = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $SainsL0->bindParam(1,$c);
        $SainsL0->execute(); */

      $recond_DEPART0 = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART0 ->bindParam(1,$c);
        $recond_DEPART0 ->execute();

                  $SomAvr_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");

      /*            $recond_DEPARTL0 = $bdd->prepare("SELECT count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_DEPARTL0 ->bindParam(1,$c);
        $recond_DEPARTL0 ->execute(); */
        
        
        $SomAvr_DEPART0->bindParam(1,$c);
        $SomAvr_DEPART0->execute(); 

       /*                $SomAvl_DEPARTL0 = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvl_DEPARTL0->bindParam(1,$c);
        $SomAvl_DEPARTL0->execute(); */





                          $SomRa_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART0->bindParam(1,$c);
        $SomRa_DEPART0->execute();


       $sain=$Sains0->fetch();
            $avr=$SomAvr_DEPART0->fetch();
  //  $avl=$SomAvl_DEPARTL0->fetch();
   // $sainl=$SainsL0->fetch();
//$ra=$SomRa_DEPART->fetch();
$rec=$recond_DEPART0->fetch();
// $recl=$recond_DEPARTL0->fetch();
 $ra=$SomRa_DEPART0->fetch();

 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']-$ra['sum(sac_flasque_ra)']-$ra['sum(sac_mouille_ra)']+$rec['sum(sac_av_recond)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

   ?>
   

    <tr style="vertical-align: middle; text-align: center ; color: red; background: white;" >
    <?php if($com=$compte_Declaration->fetch()){ ?>
    <td rowspan=<?php echo $com['count(num_decliv)']; ?> ><?php echo $total_poids ?> </td>
  <?php } ?>
     <td><?php echo $recapl['num_decliv'] ?></td>
    
     <td><?php echo $recapl['poids_decliv'] ?></td>
     <td><?php echo $reste_declaration ?></td>
     <td><?php echo $reste_declaration  ?></td>
     
   </tr>
 <?php } ?>
   <?php while($relT=$declarationT->fetch()){
    $livT=$livraisonT->fetch(); 
    $reste_declarationT=$relT['sum(poids_decliv)']-$livT['sum(poids_liv)'];
    ?>

    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
      <td style="color: white;" colspan="2"> TOTAL</td>
      <td style="color: white;"><?php echo $relT['sum(poids_decliv)'] ?></td>
       <td style="color: white;"><?php echo $reste_declarationT ?></td>
    <td style="color: white;"><?php echo $reste_declarationT ?></td>
 
    </tr>

    <?php  } ?>


            
        

        </table>
      </div>
</center>

      


<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_declaration" >AJOUTER DECLARATION  </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php   $declare=$bdd->prepare("SELECT * from declaration_liv where id_dis_decliv=?");
        $declare->bindParam(1,$c);
        $declare->execute();

 
  ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="4"  >DECLARATION</td> 

       
  
    
    
    <tr  style="background: rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
          <td id="mytd" scope="col"   >DATE</td>
     
     
      <td id="mytd" scope="col" > N° DECLARATION</td>
      <td id="mytd" scope="col"  >POIDS DECLARATION</td>
      
      <td id="mytd">ACTIONS</td>
  
     </tr>
     
    
     </thead>

<tbody> 
<?php   while($dec=$declare->fetch()){
        $dt=explode('-', $dec['date_decliv']);


 ?>
 <tr> 
 <td class="colaffiche"> <?php  echo $dt[2].'-'.$dt[1].'-'.$dt[0]; ?> </td>
 <td class="colaffiche"> <?php  echo $dec['num_decliv'] ?> </td>
 <td class="colaffiche"> <?php  echo number_format($dec['poids_decliv'],3,',',' ') ?> </td>
 
 <form>  
 <td  style="vertical-align: middle; text-align: center; " >

 <div style="display: flex; justify-content: center;">   <a class="fabtn"  id="<?php echo $dec['id_decliv'] ?>"    onclick="deleteRelache(<?php echo $rel['id_decliv'] ?>)" > <i class="fa fa-trash  " ></i> </a>

 <a  class="fabtn" name="modify"  data-role="update_relache"  data-id="<?php echo $dec['id_decliv']; ?>"   > <i class="fa fa-edit " ></i></a>
 <a  class="fabtn" target="blank" name="modify"  href="fichier_reception.php?id=<?php echo $dec['id_decliv']; ?>" > <i class="fa fa-folder "  ></i></a>
 </div>

  
</td>
</form>


  </tr>
   
<?php   } ?>
  




 </tbody>
</table>
</div>
</div>
</div>
</div>






 








<?php 
           }

  ?>
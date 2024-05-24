<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
    $produit=$_POST['valeur_produit'];
      $poids_sac=$_POST['valeur_poids_sac'];
      $navire=$_POST['valeur_navire'];
      $destination=$_POST['valeur_destination']; 
      $table_sain_visible=$_POST['table_sain_visible'];
      $table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];
      $table_avaries_reception_visible=$_POST['table_avaries_reception_visible'];

 ?>
 <?php if($table_sain_visible==1){ ?>
<div class="container-fluid" id="tableSain"  >  
  
 <div class="col-md-12 col-lg-12">
       
<div class="table-responsive"  id="tabsain" border='1'>




 <table class='table table-hover table-bordered table-striped table-responsive'  border='2' style="margin-top: 0px;" >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="11" class="titreSAIN"  >RECEPTION DES SACS SAINS</td>
 
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202)); text-align: center; color: white; font-weight: bold;"  >
      <td id="mytd" scope="col" rowspan="2"  >ROTATIONS</td>
      <td id="mytd" scope="col" rowspan="2"  >DATE</td>
      <td id="mytd" scope="col" rowspan="2"  >HEURE</td>
     
     
      <td id="mytd" scope="col" rowspan="2" > N° BL</td>
      <td id="mytd" scope="col" rowspan="2" >CAMIONS</td>
      <td id="mytd" scope="col" rowspan="2" >CHAUFFEUR</td>
      <td id="mytd" scope="col" rowspan="2" >DECLARATION</td>
      

      <td id="mytd" scope="col" rowspan="2" >SACS</td>
    
      <td id="mytd"  scope="col" rowspan="2" >POIDS</td>
       <td id="mytd"  scope="col" rowspan="2" >SACS MANQUANTS</td>
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>

  <?php affichage_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
 
</tbody>
             

            

</table>
</div>
</div>
</div>
<?php } ?>

<?php if($table_avaries_deb_visible==1){ 
$statut=$_POST['statut']; ?>

<div class="container-fluid" id="TableReceptionAvaries" <?php if($table_avaries_deb_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_deb_visible==1){

 ?> style="display: block;" <?php } ?>> 

        <div class="row">
            
            
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
   <input type="" name="" id="input_statut" value="<?php echo $statut; ?>">

 <thead style=" background: #1B2B65;" >
  <td   id="titreAVDEB" colspan="12"  >RECEPTION DES <?php echo strtoupper($statut).'S'; ?></td> 
 
       
    
    <tr id="tr_attente_avdeb"  >
      
      
      <td scope="col"    >ROTATIONS</td>
       <td scope="col"   >DATE</td>
              <td scope="col"    >HEURE</td>
       
                      <td scope="col"    >BL</td>
               <td scope="col"   >CAMIONS</td> 
               <td scope="col"   >CHAUFFEUR</td>
               <td scope="col"   >N° DECLARATION</td>

                        
      <td scope="col"   >SAC</td>
      <td scope="col"   >POIDS</td>
      <td scope="col"    >ACTIONS</td>
      
     
  </tr>
    
      
      
     </thead>


<tbody>

<?php


 affichage_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>
	<?php } ?>

<?php if($table_avaries_reception_visible==1){ ?>
    <div class="container-fluid" class="" id="avaries_receptions" <?php if($table_avaries_reception_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_reception_visible==1){

 ?> style="display: block;" <?php } ?> >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER AVARIES  </a>
<br><br>

<span style="" id="poids_sac_avr" ><?php echo $afdis['poids_sac'] ?></span>
<span style="display: none;" id="id_produit_avr" ><?php echo $afdis['id_produit'] ?></span>
<span style="display: none;" id="id_destination_avr" ><?php echo $afdis['id_mangasin'] ?></span>
<span style="display: none;" id="id_navire_avr" ><?php echo $afdis['id_navire'] ?></span>
<span style="display: none;" id="id_declaration_avr" ><?php echo $afdis['id_declaration'] ?></span>

</div>
<?php } ?>

<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php 
 ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td>  
    
   
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
       <td id="mytd"  scope="col"  >ACTIONS</td>
     </tr>
    
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>
 </tbody>
</table>
</div>
</div>
</div>
</div>	
	<?php } ?>
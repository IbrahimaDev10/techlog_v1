<?php 
require('../../database.php');

$navire=$_POST['navire'];
$produit=$_POST['produits'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];

$client=$_POST['client'];
$sac=$_POST['sac'];
$id=$_POST['id'];

$bl=$_POST['bl'];

$date1=$_POST['date1'];




?>


<div id='element_pont' class="row">

  

    <div <?php if($sac!=0){ ?> class="col-lg-4" <?php } ?> <?php if($sac==0){ ?> class="col-lg-4" <?php } ?> >  
           <label>BL </label>
        <input type="text" class="form-control"   name="sacm"  id="bl_pont" value="<?php echo $bl ?>"   
    disabled="true" >  <?php  if($sac==0){ ?> <br>  <?php   } ?> 
 </div>   
  <?php  $select_tare=$bdd->prepare('SELECT poids_tare_sac,id_tare from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
     $select_tare->bindParam(1,$produit);
     $select_tare->bindParam(2,$poids_sac);
     $select_tare->bindParam(3,$navire);
     $select_tare->bindParam(4,$destination);
     $select_tare->bindParam(5,$client);
     $select_tare->execute();
     $sel_tare=$select_tare->fetch(); 
      ?>
 <div class="col-lg-4">          
       <label <?php if($sac==0){ ?> style='display: none;' <?php } ?> >NBRE DE SAC</label>
        <input type="number" class="form-control"   name="sacm"  id="nbre_sac_pont"   value="<?php  echo $sac; ?>" 
     disabled="true" <?php if($sac==0){ ?> style='display: none;' <?php } ?>>
 </div> 

 <div class="col-lg-4"> 
  <label <?php if($sac==0){ ?> style='display: none;' <?php } ?>>TARE SAC</label>
    <input type="number" class="form-control"   name="sacm"  id="val_tare_sac" disabled="true"  value="<?php  echo $sel_tare['poids_tare_sac']; ?>"
    <?php if($sac==0){ ?> style='display: none;' <?php } ?> <?php  if($sac!=0){ ?> style="background: black; color: white; display: block;" <?php } ?> > <br>   
 </div>
   


 <div class="col-lg-3">  
    <label>DATE PONT</label>
        <input type="date" class="form-control"   name="sacm"  id="date_pont" value='<?php echo $date1; ?>'  > 
    </div>

<div class="col-lg-3">  
    <label>TICKET PONT</label>
    <input type="number" class="form-control"   name="sacf"  id="ticket_pont"  
     >
 </div> 
 <div class="col-lg-3">  
     <label>POIDS BRUT </label>
    <input type="number" class="form-control"   name="sacm"  id="poids_pont"  
     oninput='calcul_poids_pont()'> 
 </div>

    <div class="col-lg-3">  
          <label>TARE VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="tare_vehicule"  
     oninput='calcul_poids_pont()' > <br>   
     </div> 
   
     
<div class="col-lg-6">   
        <label>NET PONT BASCULE</label>
    <input type="text" class="form-control"   name="sacm"  id="net_pont"  
     disabled="true" style="background: black; color: white;"> <br>
</div>

    

          
    <input style="display: none;" type="number" class="form-control"   name="sacm"  id="val_id_tare_sac" disabled="true"  value="<?php  echo $sel_tare['id_tare']; ?>"
    style="" > 
<div class="col-lg-6"> 
         <label>NET MARCHAND</label>
    <input type="number" class="form-control"   name="sacm"  id="net_marchand"  value="0"
     disabled="true" style="background: black; color: white;"> </div>
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_pont'>
<input type="text" name="" id='poids_sac_pont'>
<input type="text" name="" id='navire_pont' value="<?php echo $navire; ?>" >
<input type="text" name="" id='destination_pont'>
<input type="text" name="" id='client_pont'>

   <input type="text" name="" id='id_pont' value="<?php echo $id ?>"> </div>
 </div>


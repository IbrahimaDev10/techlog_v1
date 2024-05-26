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

$date=$_POST['dates'];

$ticket=$_POST['ticket'];
$poids_brut=$_POST['poids_brut'];
$tare_vehicule=$_POST['tare_vehicule'];
$net_marchand=$_POST['net_marchand'];

$id_tare_sac=$_POST['id_tare_sac'];
$tare_sac=$_POST['tare_sac'];


?>


<div id='element_pont'>

   <div class="mb-3">

           <label>BL </label>
        <input type="text" class="form-control"   name="sacm"  id="bl_pont" value="<?php echo $bl ?>"   
    disabled="true" > <br>
    <label>DATE PONT</label>
        <input type="date" class="form-control"   name="sacm"  id="date_pont" value='<?php echo $date; ?>'  > <br> 
       <label>NBRE DE SAC</label>
        <input type="number" class="form-control"   name="sacm"  id="nbre_sac_pont"   value="<?php  echo $sac; ?>" 
     disabled="true"> <br> 

    <label>TICKET PONT</label>
    <input type="number" class="form-control"   name="sacf"  id="ticket_pont"   value="<?php  echo $ticket; ?>" 
     >
     <br> 
     <label>POIDS BRUT VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="poids_pont"  value="<?php  echo $poids_brut; ?>"
     oninput='calcul_poids_pont()'> <br> </div>
<div style="">
          <label>TARE VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="tare_vehicule"  value="<?php  echo $tare_vehicule; ?>"
     oninput='calcul_poids_pont()' > <br> 

     

        <label>NET PONT BASCULE</label>
    <input type="text" class="form-control"   name="sacm"  id="net_pont"  
     disabled="true" style="background: black; color: white;"> <br>


   

          <label>TARE SAC</label>
    <input type="number" class="form-control"   name="sacm"  id="val_tare_sac" disabled="true"  value="<?php echo $tare_sac ?>"
    style="background: black; color: white; " >
    <input style="display: none;" type="number" class="form-control"   name="sacm"  id="val_id_tare_sac" disabled="true"  value="<?php echo $id_tare_sac ?>"
    style="" > <br> 

         <label>NET MARCHAND</label>
    <input type="number" class="form-control"   name="sacm"  id="net_marchand"  value="<?php echo $net_marchand ?>"
     disabled="true" style="background: black; color: white;"> <br>
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_pont' value="<?php echo $produit; ?>" >
<input type="text" name="" id='poids_sac_pont' value="<?php echo $poids_sac; ?>">
<input type="text" name="" id='navire_pont' value="<?php echo $navire; ?>" >
<input type="text" name="" id='destination_pont'  value="<?php echo $destination; ?>">
<input type="text" name="" id='client_pont'  value="<?php echo $client; ?>">

   <input type="text" name="" id='id_pont' value="<?php echo $id ?>"> </div>
 </div>


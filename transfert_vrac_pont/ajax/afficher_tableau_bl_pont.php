<?php require('../../database.php');
    require('../controller/afficher_pont_bascule.php');
$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$client= $_POST['client']; 
$transfert_sain=$_POST['transfert_sain'];

//$statut=$_POST['statut'];

$statut='sain';
 ?>

       

<div class="container-fluid bg-white" id="Table_pont" style="background: white; border: solid; border-radius: 2%;">



  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('../entete_tableau_pont.php'); ?>
 <div class="table-body" id="tbody_transfert_deb" >
    <tbody  >
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
     affichage_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
    //}   ?> 
    </tbody>   
    </div>    

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>

<div class="modal fade" id="form_tare_sac" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries Tare Sac</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
         


   <div class="mb-3">
       

    <label>TARE SAC</label>
    <input type="number" class="form-control"   name="sacf"  id="tare_sac"  value="0"
     >


   
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_tare' value="<?php echo $produit; ?>"  >
<input type="text" name="" id='poids_sac_tare' value="<?php echo $poids_sac; ?>" >
<input type="text" name="" id='navire_tare' value="<?php echo $navire; ?>" >
<input type="text" name="" id='destination_tare' value="<?php echo $destination; ?>" >
<input type="text" name="" id='client_tare' value="<?php echo $client; ?>" >
    </div>
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="ajouter_tare" >enregistrer</a></center>
        </div>
    

    
</form> 
</div>
       
      <div class="modal-footer">
 
        
      </div>
    
  </div>
</div>
</div>

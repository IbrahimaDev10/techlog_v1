<?php
require('../database.php');

 require('controller/afficher_les_debarquements.php');

$poids_sac= $_POST['poids_sac'];
$navire= $_POST['id_navire'];

 $destination= $_POST['id_destination'];
  $produit= $_POST['id_produit']; 
  

if(isset($_POST['delete_id'])){
	$id = $_POST['delete_id'];
	$c=$_POST['dis_bl'];


$supprimerDemande=$bdd->prepare('delete from transfert_avaries where id_tr_avaries=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();
 



  
  
 ?>

 <div id="tr_avariess">
  <div class="container-fluid" id="TableAvariesTrans" >
  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
   

  </div>
<br>


  <div class="col-md-12 col-lg-12">      
<button type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>
<br><br>

    </div>

 <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead >
  <td  colspan="15" class="titreTRANSAV" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >TRANSFERT DES AVARIES DE DEBARQUEMENT</td>    

 
     
    
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >
      
      
      
       <td scope="col"  rowspan="3"  >DATES</td>
              <td scope="col"  rowspan="3"  >HEURE</td>
                     <td scope="col"  rowspan="3"  >CALE</td>
                      <td scope="col"  rowspan="3"  >BL</td>
               <td scope="col" rowspan="3"  >CAMIONS</td> 
               <td scope="col"  rowspan="3"  >CHAUFFEUR</td>
               <td scope="col"  rowspan="3"  >TRANSPORT</td>
               <td scope="col"  rowspan="3"  >N°DEC / TRANSFERT</td>            
      <td scope="col" colspan="2"  >FLASQUES</td>
      <td scope="col" colspan="2"  >MOUILLES</td>
      <td scope="col" colspan="2"  >TOTAL AVARIES</td>
      <td scope="col" rowspan="2"  >ACTIONS</td>
      
     
  </tr>
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
      
      <td scope="col"  >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >SACS</td>
      <td scope="col"  >POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>
 
 <?php affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>
</tbody>
             

  
</table> 
</div>  
</div> 
  </div>          
<?php 	} ?>
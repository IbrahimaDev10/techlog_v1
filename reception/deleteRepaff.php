<?php
require('../database.php');
require('controller/afficher_les_receptions.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
if(isset($_POST['delete_id'])){ 
$c=$_POST['id_dis'];
$id=$_POST['delete_id'];
try{
  $delete=$bdd->prepare("DELETE from reception where id_recep=?");
  $delete->bindParam(1,$id);
  $delete->execute();
}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
?>
<?php 
$produit=$_POST['id_produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['id_navire'];
$destination=$_POST['id_destination'];	               
               ?>
<div class="container-fluid" id="tableSain" > 
<div class="col-md-12 col-lg-12">            
<div class="table-responsive" border=1>
 <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >
    
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="11" class="titreSAIN"  >RECEPTION DES SACS SAINS</td>
   
<tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202)); text-align: center; color: white; font-weight: bold;"  >
        <td  scope="col" rowspan="2"  >ROTATIONS</td>
      <td  scope="col" rowspan="2"  >DATES</td>
     <td  scope="col" rowspan="2" > HEURE</td>
     
      <td  scope="col" rowspan="2" > N° BL</td>
      <td  scope="col" rowspan="2" >CAMIONS</td>
      <td  scope="col" rowspan="2" >CHAUFFEUR</td>
      <td  scope="col" rowspan="2" >N° DECLARATION</td>
      
      <td  scope="col" rowspan="2" >SACS</td>
    
      <td i  scope="col" rowspan="2" >POIDS</td>
       <td   scope="col" rowspan="2" >SACS MANQUANTS</td>
       <td   scope="col" rowspan="2" >ACTIONS</td>
     </tr> 
     </thead>
<tbody>
<?php affichage_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
</tbody>       
</table>
</div>
</div>
</div>
<br><br>
<?php  
  } ?>


<?php
require('../database.php');
require('controller/afficher_les_receptions.php');  
if(isset($_POST['id']) ){
  if(!empty($_POST['date']) and !empty($_POST['bl']) and !empty($_POST['sac'])) {
$date=$_POST['date'];
$d=explode('-', $date);
   $insertdate=$d[2].'-'.$d[1].'-'.$d[0];

$bl=$_POST['bl'];

$sac=$_POST['sac'];
$manquant=$_POST['manquant'];
$poids_sac=$_POST['poids_sac'];


$c=$_POST['id_dis_bl'];

$id=$_POST['id'];
$heure=$_POST['heure'];
$poids=$sac*$poids_sac/1000;

try{
$update=$bdd->prepare("UPDATE reception SET dates_recep=?, bl_recep=?, sac_recep=?,poids_recep=?, manquant_recep=?, heure_recep=? where id_recep=?");
  $update->bindParam(1,$insertdate);
  $update->bindParam(2,$bl);
  $update->bindParam(3,$sac);
  $update->bindParam(4,$poids);
  $update->bindParam(5,$manquant);
  $update->bindParam(6,$heure);
  $update->bindParam(7,$id);
 
  $update->execute();

  
  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
}
else{ 
  echo"erreur";
}





$produit=$_POST['id_produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['id_navire'];
$destination=$_POST['id_destination'];   
$compterecep=compte_nbre_reception_sain($bdd,$produit,$poids_sac,$navire,$destination);

$comptera=$bdd->prepare("select count(date_ra) from reception_avaries where id_dis_bl_ra=?");
$comptera->bindParam(1,$c);
$comptera->execute();



                 


   

               ?>



<div class="container-fluid" id="tableSain" >  
  <br>
  
 <div class="col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' style="margin-top: 0px;" >

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
<br><br>

 



<?php  
   } ?>
 
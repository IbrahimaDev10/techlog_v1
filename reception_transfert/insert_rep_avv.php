<?php
require('../database.php'); 
require("controller/acces_reception.php");  
if(isset($_POST['id']) ){
  if(  !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sacf'])) {
$date=$_POST['date'];
$bl=$_POST['bl'];
$chauffeur=$_POST['chauffeur'];
$camion=$_POST['camion'];
$sacf=$_POST['sacf'];
//$sacm=$_POST['sacm'];
$poidsf=$_POST['poidsf'];

$manquant=$_POST['manquant'];
$poids_sac=$_POST['poids_sac'];
$client=$_POST['id_client'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];
$declaration=$_POST['id_declaration'];
$id_dis_bl=$_POST['id_dis_bl'];
$id_produit=$_POST['id_produit'];
$id=$_POST['id'];
$getid=$_POST['getid'];
$heure=$_POST['heure'];
$statut=$_POST['statut'];
//$poidsm=$sacm*$poids_sac/1000;
//$poids=$sac*$poids_sac/1000;

try{
$insert=$bdd->prepare("INSERT INTO reception_transfert_des_avaries(dates,heure,camion,chauffeur,id_declaration,sac,poids,manquant,id_destination,id_produit,poids_sac,id_navire,statut) values(?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$heure);
  #$insert->bindParam(3,$bl);
  $insert->bindParam(3,$camion);
  $insert->bindParam(4,$chauffeur);
  $insert->bindParam(5,$declaration);
  $insert->bindParam(6,$sacf);
  $insert->bindParam(7,$poidsf);
  
  $insert->bindParam(8,$manquant);
  $insert->bindParam(9,$destination);
  $insert->bindParam(10,$id_produit);
  $insert->bindParam(11,$poids_sac);
  

  $insert->bindParam(12,$navire);
  $insert->bindParam(13,$statut);
  $insert->execute();
  $a=$_SESSION['id'];
  echo $id;
  echo $getid;

  $update=$bdd->prepare("UPDATE transfert_des_avaries set etat_reception='oui' where id=?");
  $update->bindParam(1,$id);
  $update->execute();
  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
} 
}
else{
  echo $e;
}


//METTRE LE CODE POUR RECHARGER LA PAGE


?> 

  <div class="main" id="pole">
          <div class="col-md-12 col-lg-12">
    <h3 class="operation" >POLE DE RECEPTION</h3>
</div>
<div class="col-md-12 col-lg-12">
      <div  class="table-responsive" border=1 >
      
        
 <table  class='table table-hover table-bordered table-striped'  border='2'   id='tabledec2' >
  <td colspan="9" style="background: black; color: white;" class="titre"><i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i>  CAMIONS EN ATTENTES (SAINS)</td>
  
  <tr class="tr_attente_sain" >
     <th >DATE</th>
    <th >NAVIRE</th>
    <th >PRODUIT</th>
  <th >BL</th>
  <th >CAMION</th>
  <th >CHAUFFEUR</th>
  <th >SAC</th>
  <th >POIDS</th>
  <th >ACTIONS</th></tr>
<tbody>
  <?php afficher_camions_en_attentes_sain($bdd); ?>
      </tbody>
    </table>
  
</div>
</div>
<br><br>

<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>


  <table class='table table-hover table-bordered table-striped' id='table' border='2'> 
    

 <thead >
       
     <td colspan="10" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMION EN ATTENTES (AVARIES)</td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > </tr>
      
      <tr  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
      
       <td scope="col"    >DATES</td> 
           <td   >NAVIRE</td>
    <td  >PRODUIT</td>    
                 <td scope="col"  >BL</td>
               <td scope="col"   >CAMIONS</td> 
               <td scope="col"   >CHAUFFEUR</td>       
  <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >STATUT</td>
      <td scope="col"  >ACTIONS</td>
      
     
  </tr>



      
     </thead>



<tbody>
<?php afficher_camions_en_attentes_avaries($bdd); ?>
</tbody>
</table>
</div>
  

</div>

         
     </div>
        <br><br>
     



<?php  
}

?>  

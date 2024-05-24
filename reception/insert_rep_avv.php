<?php
require('../database.php'); 
require("controller/acces_reception.php");  
if(isset($_POST['id']) ){
  if( !empty($_POST['bl']) and !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sacf'])) {
$date=$_POST['date'];
$bl=$_POST['bl'];
$chauffeur=$_POST['chauffeur'];
$camion=$_POST['camion'];
$sacf=$_POST['sacf'];
$sacm=$_POST['sacm'];
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
$poidsm=$sacm*$poids_sac/1000;
//$poids=$sac*$poids_sac/1000;

try{
$insert=$bdd->prepare("INSERT INTO reception_avaries(date_ra,heure_ra,bl_ra,camion_ra,chauffeur_ra,id_declaration_ra,sac_flasque_ra,poids_flasque_ra,sac_mouille_ra,poids_mouille_ra,manquant_ra,poids_sac_ra,id_produit_ra,id_dis_bl_ra,id_destination_ra,id_client_ra,id_navire_ra) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$heure);
  $insert->bindParam(3,$bl);
  $insert->bindParam(4,$camion);
  $insert->bindParam(5,$chauffeur);
  $insert->bindParam(6,$declaration);
  $insert->bindParam(7,$sacf);
  $insert->bindParam(8,$poidsf);
  $insert->bindParam(9,$sacm);
  $insert->bindParam(10,$poidsm);
  $insert->bindParam(11,$manquant);
  $insert->bindParam(12,$poids_sac);
  $insert->bindParam(13,$id_produit);
  $insert->bindParam(14,$id_dis_bl);
  $insert->bindParam(15,$destination);
  $insert->bindParam(16,$client);
  $insert->bindParam(17,$navire);
  $insert->execute();
  $a=$_SESSION['id'];
  echo $id;
  echo $getid;

  $delete=$bdd->prepare("delete from pre_reception_avaries where id_pre_ra=?");
  $delete->bindParam(1,$id);
  $delete->execute();
  
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
       
    
    <td colspan="11" class="titre" style="background: black; color: orange;"><i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i>CAMIONS EN ATTENTES (AVARIES)</td>
    <tr class="tr_attente_avaries" >
      
      
      
       <td scope="col"  rowspan="3"  >DATES</td> 
           <td  rowspan="3" >NAVIRE</td>
    <th  rowspan="3">PRODUIT</th>    
                 <td scope="col"  rowspan="3"  >BL</td>
               <td scope="col" rowspan="3"  >CAMIONS</td> 
               <td scope="col"  rowspan="3"  >CHAUFFEUR</td>       
      <td scope="col" colspan="2"  >FLASQUES</td>
      <td scope="col" colspan="2"  >MOUILLES</td>
      <td scope="col" rowspan="2" >ACTIONS</td>
      
     
  </tr>
    <tr class="tr_attente_avaries" >
      
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
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

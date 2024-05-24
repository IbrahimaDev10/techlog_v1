<?php
require('../database.php'); 
require("controller/acces_reception.php"); 
if(isset($_POST['id']) ){
  if(!empty($_POST['date'])  and !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sac'])) {
$date=$_POST['date'];
//$bl=$_POST['bl'];
$getid=$_POST['getid'];
$chauffeur=$_POST['chauffeur'];
$camions=$_POST['camion'];
$sac=$_POST['sac'];
$manquant=$_POST['manquant'];
//$sac_reelle=$sac+$manquant;
$poids_sac=$_POST['poids_sac'];
//$client=$_POST['id_client'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];
$declaration=$_POST['id_declaration'];
$id_dis_bl=$_POST['id_dis_bl'];
$id_produit=$_POST['id_produit'];
$id=$_POST['id'];
$heure=$_POST['heure'];
$poids=$sac*$poids_sac/1000;
//$poids_reelle=$sac_reelle*$poids_sac/1000;
$a=$_SESSION['id'];

try{
$insert=$bdd->prepare("INSERT INTO reception_transfert_sain(dates,heure,camion,chauffeur,id_declaration,sac,poids,manquant,id_destination,id_produit,poids_sac,id_navire) values(?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$heure);

 
  $insert->bindParam(3,$camions);
  $insert->bindParam(4,$chauffeur);
   $insert->bindParam(5,$declaration);
  $insert->bindParam(6,$sac);
  $insert->bindParam(7,$poids);
  $insert->bindParam(8,$manquant);
   $insert->bindParam(9,$destination);
  $insert->bindParam(10,$id_produit);
  $insert->bindParam(11,$poids_sac);
  $insert->bindParam(12,$navire);
  $insert->execute();

   $update=$bdd->prepare("UPDATE transfert_sain set etat_reception='oui' where id_trsain=?");
  $update->bindParam(1,$id);
  $update->execute();
  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
}


//METTRE LE CODE POUR RECHARGER LA PAGE





?> 

  <div class="main" id="pole">
         <div class="col-md-12 col-lg-12">
    <h3 class="operation"   >POLE DE RECEPTION</h3>
</div>
<div class="col-md-12 col-lg-12">
      <div  class="table-responsive" border=1 >
        
 <table  class='table table-hover table-bordered table-striped'  border='2'   id='tabledec2' >
   <td colspan="9" style="background: black; color: white;" class="titre"><i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i> CAMIONS EN ATTENTES (SAINS)</td>
  
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

 
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

 <thead >
       
     <td colspan="11" class="titre" style="background: black; color: orange;"><i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i>CAMIONS EN ATTENTES (AVARIES)</td>
    <tr class="tr_attente_avaries"  >
      
      
      
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
      <td scope="col"  >POIDS</td>
      <td scope="col"  >SACS</td>
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

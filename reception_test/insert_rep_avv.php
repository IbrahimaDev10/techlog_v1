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


 if($statut=='sain' or $statut=='mouille' or $statut=='balayure' ){
                   $poids_reel=$_POST['sacf']*$poids_sac/1000;
                  }
                   if($statut=='flasque'){
                   $poids_reel=$_POST['poidsf'];
                  }

$control_doublon=$bdd->prepare('SELECT bl from reception_navire where  id_produit=? and poids_sac=? and id_navire=? and id_destination=? and bl=?');

$control_doublon->bindParam(1,$id_produit);
$control_doublon->bindParam(2,$poids_sac);
$control_doublon->bindParam(3,$navire);
$control_doublon->bindParam(4,$destination);
$control_doublon->bindParam(5,$bl);
$control_doublon->execute();

$control=$control_doublon->fetch();


if(empty($control['bl'])){


try{
$insert=$bdd->prepare("INSERT INTO reception_navire(dates,heure,camion,chauffeur,id_declaration,sac,poids,manquant,id_destination,id_produit,poids_sac,id_navire,statut,bl) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$heure);
  #$insert->bindParam(3,$bl);
  $insert->bindParam(3,$camion);
  $insert->bindParam(4,$chauffeur);
  $insert->bindParam(5,$declaration);
  $insert->bindParam(6,$sacf);
  $insert->bindParam(7,$poids_reel);
  
  $insert->bindParam(8,$manquant);
  $insert->bindParam(9,$destination);
  $insert->bindParam(10,$id_produit);
  $insert->bindParam(11,$poids_sac);
  

  $insert->bindParam(12,$navire);
  $insert->bindParam(13,$statut);
  $insert->bindParam(14,$bl);
  $insert->execute();
  $a=$_SESSION['id'];
  echo $id;
  echo $getid;

  $update=$bdd->prepare("UPDATE transfert_debarquement set etat_reception='oui' where id_register_manif=?");
  $update->bindParam(1,$id);
  $update->execute();

  $doublon=0;
  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}

}
else{
  $doublon=1;
} 

}
else{
  //echo $e;
}


//METTRE LE CODE POUR RECHARGER LA PAGE

$a=$_SESSION['id'];
?> 

       <div class="main" id="pole" >

     
 <div class="row">
  <?php $total_camions_en_attentes=total_camions_en_attentes($bdd,$a); ?> 
  <div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:left;"><h6>NBRE CAMIONS EN ATTENTES: <?php if($total_camions=$total_camions_en_attentes->fetch()) ?> <span style="color:red; background: white;"><?php echo $total_camions['count(trd.id_register_manif)']; ?></span> </h6>   </span>  
      </div>
     
<div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl_camion" oninput='cherche_par_bl_camion()' > </span>  
      </div>
        


<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>

  
 
  <br>
  
 <table class='table table-hover table-bordered table-striped' id='table_camion' border='2' >
    

 <thead >
       
     <td colspan="12" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMION EN ATTENTES <a  class="agrandir_table" data-role="agrandir_table" ><i class="fa fa-eye"></i></a> </td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > </tr>
      
      <tr style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
      
       <td scope="col"    >DATES</td> 
       <td scope="col"    >HEURE</td>
           <td   >NAVIRE</td>
           <td scope="col"    >ENTREPOT</td>
    <td class="produit_hide" >PRODUIT</td>    
                 <td class="bl_hide" scope="col"  >BL</td>
               <td class="camion_hide" scope="col"   >CAMIONS</td> 
               <td class="chauffeur_hide" scope="col"   >CHAUFFEUR</td>       
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

         
     </div>  
     
<?php if($doublon==0){

 ?>
<script type="text/javascript">
   Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Camion receptionne avec succes.',
        confirmButtonText: 'OK'
    });
</script>
<?php } ?>

<?php if($doublon==1){

 ?>
<script type="text/javascript">
   Swal.fire({
        icon: 'error',
        title: 'Double emploi detcte',
        text: "Impossible d'enregistrer le meme bl plusieurs fois.'",
        confirmButtonText: 'OK'
    });
</script>
<?php } ?>

<?php  
}

?>  

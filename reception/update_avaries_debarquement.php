<?php 
require("../database.php");
require('controller/afficher_les_receptions.php');
if(isset($_POST['id'])){
	$date=$_POST['date'];
	$date2=date("Y-m-d", strtotime($date));
	$sacf=$_POST['sacf'];
	$sacm=$_POST['sacm'];
	$id_dis=$_POST['id_dis'];
  $bl=$_POST['bl'];
   $heure=$_POST['heure'];
   $poids_sac=$_POST['poids_sac'];
   $poidsf=$_POST['poidsf'];
   $poidsm=$sacm*$poids_sac/1000;
	$id=$_POST['id'];

$produit=$_POST['id_produit'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];

	try {
		$update=$bdd->prepare("UPDATE reception_avaries SET date_ra=?, sac_flasque_ra=?,sac_mouille_ra=?, poids_flasque_ra=?, poids_mouille_ra=?, bl_ra=?, heure_ra=? WHERE id_ra=? ");
		$update->bindParam(1,$date2);
		$update->bindParam(2,$sacf);
		$update->bindParam(3,$sacm);
    $update->bindParam(4,$poidsf);
    $update->bindParam(5,$poidsm);
    $update->bindParam(6,$bl);
    $update->bindParam(7,$heure);
		$update->bindParam(8,$id);
		$update->execute();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

 ?>

  <div class="container-fluid" id="tableAvariesDeb" > 

        <div class="row">
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >

 <thead style=" background: #1B2B65;" >
  <td   id="titreAVDEB" colspan="12"  >AVARIES DE DEBARQUEMENT</td> 
 
    
    <tr id="tr_attente_avdeb"  >
      
      
       <td scope="col"  rowspan="3"  >ROTATIONS</td>
       <td scope="col"  rowspan="3"  >DATE</td>
        <td scope="col"  rowspan="3"  >HEURE</td>      
       
                      <td scope="col"  rowspan="3"  >BL</td>
               <td scope="col" rowspan="3"  >CAMIONS</td> 
               <td scope="col"  rowspan="3"  >CHAUFFEUR</td>
              <td scope="col"  rowspan="3"  >N° DECLARATION</td>
                        
      <td scope="col" colspan="2"  >FLASQUES</td>
      <td scope="col" colspan="2"  >MOUILLES</td>
      <td scope="col"  rowspan="3"  >ACTIONS</td>
      
     
  </tr>
    <tr id="tr_attente_avdeb" >
      
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >SACS</td>
      <td scope="col"  >POIDS</td>
      </tr>

     </thead>


<tbody>

<?php affichage_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination); ?>
</tbody>
</table> 
</div>
</div>
</div>
</div>

<?php  }
    ?>
 
 
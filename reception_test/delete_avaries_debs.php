<?php 
require("../database.php");
require('controller/afficher_les_receptions.php');
if(isset($_POST['delete_id'])){
	
	$id_dis=$_POST['id_dis'];
	$id=$_POST['delete_id'];
	try {
		$delete=$bdd->prepare("DELETE FROM reception_avaries WHERE id_ra=? ");
		
		$delete->bindParam(1,$id);
		$delete->execute();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
$poids_sac=$_POST['poids_sac'];
  $produit=$_POST['id_produit'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];
 
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


<?php } ?>
 
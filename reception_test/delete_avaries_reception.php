<?php 
require("../database.php");
require("controller/afficher_les_receptions.php");
if(isset($_POST['delete_id'])){
	
	$id_dis=$_POST['id_dis'];
	$id=$_POST['delete_id'];
	try {
		$delete=$bdd->prepare("DELETE FROM avaries_de_reception WHERE id=? ");
		
		$delete->bindParam(1,$id);
		$delete->execute();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

$produit=$_POST['id_produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['id_navire'];
$destination=$_POST['id_destination'];
$id_declaration=$_POST['id_declaration'];


 ?>

  <div class="container-fluid" class="" id="avaries_receptions" >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER AVARIES  </a>
<br><br>
</div>
<?php } ?>
<
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td> 
     
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"  >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
         


      
    
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     </tr>
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>

 </tbody>
</table>
</div>
</div>
</div>
</div>


<?php } ?>
 
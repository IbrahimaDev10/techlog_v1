<?php 
require("../database.php");
require("controller/afficher_les_receptions.php");
if(isset($_POST['id'])){
	$date=$_POST['date'];
	$date2=date("Y-m-d", strtotime($date));
	$sacf=$_POST['sacf'];
	$sacm=$_POST['sacm'];
	$id_dis=$_POST['id_dis'];
	$id=$_POST['id'];
	try {
		$update=$bdd->prepare("UPDATE avaries_de_reception SET date_avr=?, sac_flasque_avr=?,sac_mouille_avr=? WHERE id_avr=? ");
		$update->bindParam(1,$date2);
		$update->bindParam(2,$sacf);
		$update->bindParam(3,$sacm);
		$update->bindParam(4,$id);
		$update->execute();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

$produit=$_POST['id_produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['id_navire'];
$destination=$_POST['id_destination'];


 ?>

  <div class="" id="avaries_receptions">
   <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id_dis_recep_bl'] ?>" data-navire="<?php echo $afdis['id_navire_recep'] ?>" >AJOUTER AVARIES  </a>
<br><br>

<span style="" id="poids_sac_avr" ><?php echo $afdis['poids_kg'] ?></span>
<span style="display: none;" id="id_produit_avr" ><?php echo $afdis['id_produit'] ?></span>
<span style="display: none;" id="id_destination_avr" ><?php echo $afdis['id_mangasin'] ?></span>
<span style="display: none;" id="id_navire_avr" ><?php echo $afdis['id_navire'] ?></span>

</div>
<?php } ?>       
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >
    

 <thead style="background:  rgb(65,180,190);">
   <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td>
   
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
         


      
    
       <td id="mytd"  scope="col" >ACTIONS</td>
     </tr>
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>
 </tbody>
</table>
</div>
</div>
<?php } ?>
 
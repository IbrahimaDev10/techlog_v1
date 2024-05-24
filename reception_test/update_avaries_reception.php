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
		$update=$bdd->prepare("UPDATE avaries_de_reception SET dates=?, sac_flasque=?,sac_mouille=? WHERE id=? ");
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
<?php if(empty($_POST['date'])){ ?>
  <center><div  class="err" id="LesErreursVIDES" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermerVIDES" ></a><h3 id="perreurVIDES" > ERREUR</h3>
    
 <h5 id="perreur"> Veuillez inserer une date  </span> </h5>
</div>
<?php   } ?>

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
 
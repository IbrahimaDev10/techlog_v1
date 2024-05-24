<?php 
require("../database.php");
 require('controller/afficher_les_debarquements.php');

$poids_sac= $_POST['poids_sac'];
$navire= $_POST['id_navire'];

 $destination= $_POST['id_destination'];
  $produit= $_POST['id_produit']; 

if(isset($_POST['id'])){

	 $date=$_POST['date'];
	 $d=explode('-', $date);
	 $insertdate=$d[2].'-'.$d[1].'-'.$d[0];
	 $heure=$_POST['heure'];
	 $cale='A';
	 $declaration=$_POST['declaration'];
	 $camion=$_POST['camion'];
	 $chauffeur=$_POST['chauffeur'];
	 $bl=$_POST['bl'];
	 $c=$_POST['dis_bl'];
	 $sacf=$_POST['sacf'];
	 $sacm=$_POST['sacm'];
   if(empty($sacf)){
          $sacf=0;
        }
         if(empty($sacm)){
          $sacm=0;
        }
	  $poidsf=$_POST['poidsf'];
	 $poidsm=$_POST['poidsm'];
	 $poids_sac=$_POST['poids_sac'];
     $poids_mouille=$sacm*$poids_sac/1000;
	 //$poids=$_POST['sac']*$poids_sac/1000;
	$id=$_POST['id'];
	$update=$bdd->prepare("UPDATE transfert_avaries set date_tr_avaries=?, heure_tr=?, bl_tr=?, id_cam=?, id_chauffeur_tr=?, id_declaration_tr=?, cale_tr_avaries=?, sac_flasque_tr_av=?, poids_flasque_tr_av=?,  sac_mouille_tr_av=?, poids_mouille_tr_av=?   where id_tr_avaries=?");
	$update->bindParam(1,$insertdate);
	$update->bindParam(2,$heure);
	$update->bindParam(3,$bl);
	$update->bindParam(4,$camion);
    $update->bindParam(5,$chauffeur);
    $update->bindParam(6,$declaration);
    $update->bindParam(7,$cale);
    $update->bindParam(8,$sacf);
    $update->bindParam(9,$poidsf);
    $update->bindParam(10,$sacm);
    $update->bindParam(11,$poids_mouille);
    $update->bindParam(12,$id);

	$update->execute();



	?>
<div id="tr_avariess">
<div class="container-fluid" id="TableAvariesTrans" >
  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
     

  </div>
<br>


        <div class="col-md-12 col-lg-12">      
<button type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>
<br><br>


</span>
    </div>

 <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead >
    <td  colspan="15" class="titreTRANSAV" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;"  >TRANSFERT DES AVARIES DE DEBARQUEMENT</td> 

    
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >
      
      
      
       <td scope="col"  rowspan="3"  style="vertical-align: top;">DATES</td>
              <td scope="col"  rowspan="3" style="vertical-align: top;" >HEURE</td>
                     <td scope="col"  rowspan="3" style="vertical-align: top;" >CALE</td>
                      <td scope="col"  rowspan="3" style="vertical-align: top;" >BL</td>
               <td scope="col" rowspan="3" style="vertical-align: top;" >CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="vertical-align: top;">CHAUFFEUR</td>
               <td scope="col"  rowspan="3" style="vertical-align: top;" >TRANSPORT</td>
               <td scope="col"  rowspan="3"style="vertical-align: top;" >N°DEC / TRANSFERT</td>            
      <td scope="col" colspan="2" >FLASQUES</td>
      <td scope="col" colspan="2" >MOUILLES</td>
      <td scope="col" colspan="2" >TOTAL AVARIES</td>
      <td scope="col" rowspan="2"  >ACTIONS</td>
      
     
  </tr>
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >
      
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>
  <?php affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>

</tbody>
             

  
</table> 
</div>  
</div> 
  </div> 
  <?php } ?>         

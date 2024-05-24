<?php require('../database.php');
require('controller/afficher_les_debarquements.php'); 
$navire=$_POST['navire'];
$affiche=afficher_facture($bdd,$navire);
$affiche_total=afficher_facture_total($bdd,$navire);

?>

<div class="table-responsive"  >
<center>
<table  class='table table-hover table-bordered table-striped table-responsive'  border='1' style="width:80%;"  >
    
 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
 	<tr style="background:black; color:white; text-align: center; vertical-align: middle; ">
 		<th>TRANSPOR <br>
 		TEUR</th>
 		<th>QTE DEBARQUE</th>
 		<th>HISTORIQUE</th>	
 	</tr>
 	</thead>
 	<tbody>
 		<?php while($aff=$affiche->fetch()){ ?>
         
     

 			<tr style=" color:black; text-align: center; vertical-align: middle; ">
 			<td><?php echo $aff['nom']; ?></td>
 			<td><?php echo $aff['sum(manif.poids)']; ?></td>
 			

 			    <div class="modal fade" id="detail_transporteur<?php echo $aff['id_trans'];?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">LISTE DES FLOATS </h3><br>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">TRANSPORTEUR: <span style="color:yellow;"><?php echo $aff['nom']; ?></span></h3></center>

                <center>
              
          </div>
            <div class="modal-body" style="">

              <?php $liste_camion=$bdd->prepare('SELECT trs.*, cam.*,td.sac,td.poids from transfert_debarquement as td 
              inner join camions as cam on cam.id_camions=td.camions
              inner join transporteur as trs on trs.id=cam.id_trans
              where td.id_navire=? and trs.id=?

              ');
              $liste_camion->bindParam(1,$aff['id_navire']);
              $liste_camion->bindParam(2,$aff['id_trans']);
              $liste_camion->execute();
              while($liste_cam=$liste_camion->fetch()){ ?>
              
              		<span> camion: <?php echo $liste_cam['num_camions']; ?></span>
              		<span>poids: <?php echo $liste_cam['poids']; ?></span><br><br>
              
              <?php } ?>

       </center>
        
      </div>
     
 
  </div>


  
</div>
</div>

<td><a  data-bs-toggle='modal' data-bs-target="#detail_transporteur<?php echo $aff['id_trans'];?>" ><i class="fas fa-eye"></i></a></td>

 			</tr>
      <?php } ?>
      <?php while($aff_total=$affiche_total->fetch()){ ?>
      <tr style="background:black; color:white; text-align:center; vertical-align:middle;">
        <td>TOTALE</td>
        <td><?php echo $aff_total['sum(manif.poids)']; ?></td>
        <td></td>
      </tr>
    <?php } ?>

 
 		
 	</tbody>
 </table>
 </center>
</div>




        
        
 
       
    
 


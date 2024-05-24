<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $connaissement=connaissement($bdd,$id_navire); ?>
               <select style="max-width: 200px;" id="connaissement" data-role="choix_connaissement">
               	<option>choisir un connaissement</option>
               	<?php while($con=$connaissement->fetch()){ ?>
               		<option value="<?php echo $con['id_navire'].'-'.$con['id_connaissement'].'-'.$con['id_dis']; ?>"><?php echo $con['num_connaissement']; ?> ( BANQUE:<?php echo $con['banque']; ?>) <?php echo $con['produit'] ?> <?php echo $con['qualite'] ?> <?php echo $con['poids_kg'].' KG' ?>  <?php echo $con['mangasin'] ?></option>
               	<?php } ?>
               </select>


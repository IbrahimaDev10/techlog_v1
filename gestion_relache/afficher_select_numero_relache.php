<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $connaissement=numero_relache($bdd,$id_navire); ?>
               <select id="connaissement" data-role="choix_connaissement">
               	<option>choisir un numero de connaissement</option>
               	<?php while($con=$connaissement->fetch()){ ?>
               		<option value="<?php echo $con['navire_id'].'-'.$con['banque_id'].'-'.$con['id_relache'].'-'.$con['produit_id'].'-'.$con['poids_sac']; ?>"> <?php echo $con['numero_relache']; ?> ( BANQUE:<?php echo $con['banque']; ?>) </option>
               	<?php } ?>
               </select>
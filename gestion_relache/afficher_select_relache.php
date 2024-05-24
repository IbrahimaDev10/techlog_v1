<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $relache=relache($bdd,$id_navire); ?>
               <select id="connaissement" data-role="choix_relache">
               	<option>choisir une relache</option>
               	<?php while($con=$relache->fetch()){ ?>
               		<option value="<?php echo $con['id_relache']; ?>"><?php echo $con['num_relache'].' DU '.$con['date_relache']; ?> BL: <?php echo $con['num_connaissement'] ?> ( BANQUE:<?php echo $con['banque']; ?>)</option>
               	<?php } ?>
               </select>


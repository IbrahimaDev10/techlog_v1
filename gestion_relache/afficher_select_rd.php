<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $connaissemen=numero_dispat_relache($bdd,$id_navire); ?>
               <select id="relache_dispatcher" data-role="choix_connaissement">
               	<option>choisir un numero connaissement</option>
               	<?php while($con=$connaissemen->fetch()){ ?>
               		<option value="<?php echo $con['id_navire'].'-'.$con['id_dis_relache'].'-'.$con['id_relache']; ?>"><?php echo $con['num_relache']; ?> DESTINATION <?php echo $con['mangasin']; ?> ( BANQUE:<?php echo $con['num_relache'].' '.$con['banque']; ?>)</option>
               	<?php } ?>
               </select>
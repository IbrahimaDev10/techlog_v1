<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 

        $id_navire=$_POST['id_navire'];
      

 $bon=choix_du_bon($bdd,$id_navire); ?>
               <select id="connaissement" data-role="choix_connaissement" >
               	<option>choisir un bonff</option>
               	<?php while($bons=$bon->fetch()){ ?>
               		<option value="<?php echo $bons['id_bon'].'-'.$bons['client_id'].'-'.$bons['navire_id']; ?>" ><?php echo $bons['numero_bon']; ?> </option>
               	<?php } ?>
               </select>


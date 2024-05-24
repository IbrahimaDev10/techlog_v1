<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $client=client($bdd,$id_navire); ?>
               <select id="connaissement" data-role="choix_connaissement" style="max-width: 200px;">
               	<option>choisir client</option>
               	<?php while($cli=$client->fetch()){ ?>
               		<option value="<?php echo $cli['id_client']; ?>"><?php echo $cli['client']; ?> </option>
               	<?php } ?>
               </select>


<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_navire=$_POST['id_navire'];
 $banque=banque($bdd,$id_navire); ?>
               <select style="max-width: 200px;" id="connaissement" data-role="choix_connaissement">
               	<option>choisir une banque</option>
               	<?php while($bank=$banque->fetch()){ ?>
               		<option value="<?php echo $bank['id_navire'].'-'.$bank['id_banque'] ?>"><?php echo $bank['banque'];  ?></option>
               	<?php } ?>
               </select>


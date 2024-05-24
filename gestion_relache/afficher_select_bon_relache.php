<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 


        $id_dis=$_POST['id_connaissement'];
        $explode=explode('-', $id_dis);
        $id_navire=$explode[0];
        $id_banque=$explode[1];
        $id_produit=$explode[3];
        $poids_sac=$explode[4];
 $connaissemen=numero_relache_pour_bon($bdd,$id_navire,$id_banque,$id_produit,$poids_sac);  ?>
               <select id="destination" data-role="choix_connaissement" style="max-width: 200px;">
               	<option>choisir une relache</option>
               	<?php while($con=$connaissemen->fetch()){ ?>
               		<option value="<?php echo $con['id_bon_dispat']; ?>"> <?php echo $con['numero_bon']; ?> </option>
               	<?php } ?>
               </select>


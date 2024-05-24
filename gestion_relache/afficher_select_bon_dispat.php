<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 
$explode= explode('-', $_POST['id_connaissement']) ;
        $id_navire=$explode[2];
        $id_client=$explode[1];

 $connaissement=connaissement_pour_destination($bdd,$id_navire,$id_client); ?>
               <select id="destination"  style="max-width: 100px;">
               	<option>choisir une destinationSS</option>
               	<?php while($con=$connaissement->fetch()){ ?>
               		<option value="<?php echo $con['id_dis'] ?>" ><?php echo $con['num_connaissement'].' '.$con['produit'].' '.$con['qualite'].' '.$con['poids_kg'].' KG '.$con['mangasin']   ?> </option>
               	<?php } ?>
               </select>


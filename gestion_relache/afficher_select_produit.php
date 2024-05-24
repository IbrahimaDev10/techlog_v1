<?php 
require('../database.php');
require('controller/afficher_navire.php'); ?>

<?php 
$explode= explode('-', $_POST['id_connaissement']) ;
        $id_navire=$explode[0];
        $id_banque=$explode[1];

 $produit=produit($bdd,$id_navire,$id_banque); ?>
               <select id="produit" >
               	<option>choisir un produit</option>
               	<?php while($prod=$produit->fetch()){ ?>
               		<option value="<?php echo $prod['id_produit'].'-'.$prod['poids_kg']; ?>"><?php echo $prod['produit'].' '.$prod['qualite'].' '.$prod['poids_kg'].' '.'KG'; ?> </option>
               	<?php } ?>
               </select>


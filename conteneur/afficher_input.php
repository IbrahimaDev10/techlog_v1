<?php 
require('../database.php');
require("controller/requete_insertion_suivant.php");
if(!empty($_POST['nombre']) and $_POST['nombre']>=1){
$indice=$_POST['nombre'];
 $val=$_POST['infos'];
 echo $_POST['infos'];
 echo $indice;
          $connais=afficher_connaissement($bdd,$val);
        $con=$connais->fetch();  
  for ($i=0; $i <$indice ; $i++) { ?>

  <br>

  <div style="background: blue;">
      <input class="left_conteneur" type="text" placeholder="N° CONTENEUR" name="num_conteneur[]">
      <input class="right_conteneur" type="text" placeholder="N° PLOMB" name="num_plomb[]">
      
      <select style="height: 27px; width: 30%;" name="type[]">
      	<option value="">TYPE</option>
      	<option value=20>20</option>
      	<option value=40>40</option>
      	<option value=45>45</option>
      </select><br><br>
            <select style="height: 27px; width: 30%;" name="produit[]">
      	<option value="">CHOISIR LE PRODUIT</option>
      	<?php
      	$produit=produit($bdd);
      	 while($prod=$produit->fetch()){?>
         <option value="<?php echo $prod['id']; ?>"><?php echo $prod['produit'].' '.$prod['qualite']; ?></option>
      	<?php  	
      	 } ?> 

      </select>
            <select style="height: 27px; width: 30%;" name="poids_produit[]">
      	<option value="">CHOISIR LE POIDS DU PRODUIT</option>
      	<option value=20>25</option>
      	<option value=40>45</option>
      	<option value=50>50</option>
      </select>
      <input style="width: 30%;" class="right_conteneur"  type="text" placeholder="MANIFEST EN SACS" name="manifest[]">
      
      <input style="display: none;" class="right_conteneur"  type="text" placeholder="MANIFEST EN SACS" name="id_bl[]" value="<?php echo $con['id_bl']; ?>"><br><br>
      </div>

<?php 

} ?>
 <button class="btn btn-primary" name="ajouter">AJOUTER</button>
<?php  
}
else {
	echo "veuillez saisir un nombre";
}

 ?>

 <select id="produit" class="mysel" name="produit" style=" height: 30px;  width: 30%; float: right;" data-role='produit'>
                            <option  value="" >selectionner le produit</option>
                        

<?php 

require('../database.php');
require('controller/acces_transfert.php');
$navire=$_POST['navire'];
$explode=explode('-', $navire);
$navire=$explode[0];
$id_mangasinier=$explode[1];
$_SESSION['navire']=$_POST['navire'];
$liste_produit=choix_produit_transfert($bdd,$navire,$id_mangasinier);
while($lp=$liste_produit->fetch()){
 ?>
 
 <option value="<?php echo $lp['id_produit'].'-'.$lp['poids_kg'].'-'.$lp['id_navire'].'-'.$lp['id_mangasin'].'-'.$lp['id_nouvelle_destination'] ?>"><?php echo $lp['produit'].' '.$lp['qualite'].' '.$lp['poids_kg'].' KG '; ?>DESTINATION <?php echo $lp['mangasin'] ?></option>
 <?php } ?>
 </select>
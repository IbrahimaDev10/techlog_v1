<?php 
require("../database.php");
if(isset($_POST['id_dis'])){
	$id_dis=$_POST['id_dis'];
	$inter=$_POST['intervenant'];

	$insert=$bdd->prepare("INSERT INTO intervenant_produit(id_dis_inter_prod,id_inter) values(?,?) ");
	$insert->bindParam(1,$id_dis);
	$insert->bindParam(2,$inter);
	$insert->execute();

 $intervenant=$bdd->prepare("select inter.*,intprod.* from intervenant as inter inner join intervenant_produit as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_dis_inter_prod=?");
             $intervenant->bindParam(1,$id_dis);
             $intervenant->execute();

 ?>

 <div id="afficher_intervenant">
          <div class="row">
           <?php while ($inter=$intervenant->fetch()) { ?>
            <div class="col-md-6 col-lg-4">
            <p><?php echo $inter['nom_intervenant']; ?></p>
            </div>
          <?php } ?>
          </div>
         <?php } ?>
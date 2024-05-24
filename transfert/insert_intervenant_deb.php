<?php 
require("../database.php");
if(isset($_POST['id_navire'])){
  $id_navire=$_POST['id_navire'];
  $id_client=$_POST['id_client'];
  $inter=$_POST['intervenant'];

  $insert=$bdd->prepare("INSERT INTO intervenant_produit_deb(id_client_inter_prod,id_navire_inter_prod,id_inter) values(?,?,?) ");
  $insert->bindParam(1,$id_client);
  $insert->bindParam(2,$id_navire);
  $insert->bindParam(3,$inter);
  $insert->execute();

 $intervenant=$bdd->prepare("SELECT inter.*,intprod.* from intervenant_deb as inter inner join intervenant_produit_deb as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_client_inter_prod=? and intprod.id_navire_inter_prod=?  ");
             $intervenant->bindParam(1,$id_client);
             $intervenant->bindParam(2,$id_navire);
             $intervenant->execute();

             $intervenant_compte=$bdd->prepare("SELECT  inter.*,intprod.*, count(inter.nom_intervenant) from intervenant_deb as inter inner join intervenant_produit_deb as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_client_inter_prod=? and intprod.id_navire_inter_prod=?  ");
             $intervenant_compte->bindParam(1,$id_client);
            $intervenant_compte->bindParam(2,$id_navire);
             $intervenant_compte->execute();

 ?>

 <center>
     <div class="container-fluid" id="afficher_intervenant" style="width: 100%;">
      <div class="row">
        <div class=" col col-md-3 col-lg-2">
            <p style="color: black !important;">STEVEDORE</p><br><br><br>
            </div>
           <?php while ($inter=$intervenant->fetch()) { ?>
            <div class="col col-md-3 col-lg-2">
            <p><?php echo $inter['nom_intervenant']; ?></p>
            </div>
          <?php } $compter_intervenant=$intervenant_compte->fetch(); 
           ?>
           <div
           <?php if($compter_intervenant['count(inter.nom_intervenant)']==0){  ?>   class="col col-md-3 col-lg-10" <?php } ?> <?php if($compter_intervenant['count(inter.nom_intervenant)']==1){  ?>   class="col col-md-3 col-lg-8" <?php } ?> <?php if($compter_intervenant['count(inter.nom_intervenant)']==2){ ?>   class="col col-md-3 col-lg-6" <?php } ?>  <?php if($compter_intervenant['count(inter.nom_intervenant)']==3){ ?>   class="col col-md-3 col-lg-4" <?php } ?> 
            <?php if($compter_intervenant['count(inter.nom_intervenant)']==4){ ?>   class="col col-md-3 col-lg-2" <?php } ?>  >
            <p style="color: black !important; float: right;">CHEF OFFICIER OF MASTER</p>

            </div>
          </div>
         </div>
         </center>
       <?php } ?>
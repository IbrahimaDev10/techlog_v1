<?php
    use Pro\TechlogNewVersion\Entete_tableaux_vrac;
 ?>
  <div class="table-responsive" >

 


<table  class='table table-bordered  table-responsive'  border='1'   >
    
 <!--<div class="table-headers"> !-->
 <thead  >
 	<tr style="background: blue; color:white; text-align: center; vertical-align: middle;">
 		<td colspan="10"> <span style="float: left;">CAMIONS PESES </span> <br>
 			<?php $element_entete=Entete_tableaux_vrac::entete_des_tableaux_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
  $entete=$element_entete->fetch();
     
   ?>  
   <br>
   <div class="row">

    <div class="col-lg-4">
   <span>NAVIRE: <span style="color: yellow"> <?php echo $entete['navire']; ?></span></span> </div>  
   <div class="col-lg-4">
   <span>PRODUIT: <span style="color: yellow"><?php echo $entete['produit']; ?> <?php echo $entete['poids_kgs'].' KG' ?></span></span></div>
   <div class="col-lg-4">
   <span>DESTINATION: <span style="color: yellow"><?php echo $entete['mangasin']; ?> </span></span></div>

   <div class="col-lg-4">
   <span>POIDS MANIFEST: <span style="color: yellow"><?php echo number_format($entete['sum(dis.quantite_poids)'],'3',',','').' T'; ?> </span></span></div>

   </div>
   
 		</td>
 	</tr>
 	<tr style="background: blue; color:white; text-align: center; vertical-align: middle;">

 	 <th>DATE</th><th>BL</th> <th>CAMION</th> <th>CHAUFFEUR</th> <th>TELEPHONE</th><th>TICKET PONT</th> <th>SAC</th> <th>NET PONT BASCULE</th> <th >NET MARCHAND</th> <th>ACTION</th>
 	</tr>
 </thead>

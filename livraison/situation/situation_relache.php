<?php require('../../database.php');
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];
require('../controller/afficher_situations.php');
 ?>
 <div id="situation_relache">
  <?php include('bouton_imprimer.php'); ?>
 	<div class="table-responsive" border=1>
<table class="table table-hover table-bordered table-striped table-responsive'" >
<thead>

<tr style="background: black; color:yellow; vertical-align: middle; text-align: center; border: none;">
    <td colspan="8">SITUATION DES RELACHES</td>
  </tr>
  <?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
             if($titre=$res4->fetch()){
     ?>
  <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">NAVIRE:</td> <td colspan="6" style="color: red; border: none;"><?php echo $titre['navire']; ?></td>
   
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;"  colspan="2">PRODUIT</td>
    <td colspan="6" style="color: red; border: none;"><?php echo $titre['produit'].' '.$titre['qualite'].' '.$titre['poids_kg'].'KG'; ?></td>
   
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">ENTREPOT</td>
    <td colspan="6" style="color: red; border: none;"><?php echo $titre['mangasin']; ?></td>
   
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">RECEPTIONNAIRE</td>
    <td colspan="6" style="color: red; border: none;"><?php echo $titre['client']; ?></td>
   
    </tr>
  <?php } ?>

<tr style="background: blue; color:white; text-align: center; vertical-align: middle; font-size: 12px; ">	
	<th>N° ET DATES RELACHE</th>
	<th>BANQUE</th>
	<th>BL</th>
	<th>QUANTITE RELACHE</th>
	<th>BALANCE</th>
	<th>LIVRAISON</th>
	<th>RESTE A LIVRER SUR RELACHE</th>
	<th>DISPONIBILITE</th>

		</tr>

</thead>
<tbody>	

<?php 
      $num_bon='NULL';
       $rowspanCumul=0;
     
 /*     $cumul_bon=cumul_des_bons($bdd,$produit,$poids_sac,$navire,$destination);
$cumul_bons=$cumul_bon->fetch();  */	

      $bon=afficher_situation_relache($bdd,$produit,$poids_sac,$navire,$destination);

 $bons=$bon->fetchAll(PDO::FETCH_ASSOC);



foreach ($bons as $row) {
     $total_livre_par_relache= $row['sum(ls.poids_liv)']+ $row['sum(lm.poids_mo)'] + $row['sum(lb.poids_bal)'];
       $qt_reste_relache=$row['quantite']-$total_livre_par_relache;

  ?>
  <tr style="text-align: center; vertical-align: middle; font-size: 12px;" >	
    
    <td><?php echo $row['num_relache']; ?></td>
    <td><?php echo $row['banque']; ?></td>
    <td><?php echo $row['num_connaissement']; ?></td>
    <td><?php echo $row['quantite']; ?></td>
     <td></td>
    <td><?php echo $total_livre_par_relache; ?></td>
   
    <td><?php echo $qt_reste_relache; ?></td>         
            
            
           
     <td></td>
    

  </tr>

<?php 	} ?>

 </tbody>
	</table>
</div>
 	</div>
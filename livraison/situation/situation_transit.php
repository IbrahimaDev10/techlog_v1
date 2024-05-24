<?php require('../../database.php');
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];
require('../controller/afficher_situations.php');
 ?>
 <div id="situation_bon">
  <?php include('bouton_imprimer.php'); ?>
 	<div class="table-responsive" border=1>
<table class="table table-hover table-bordered table-striped table-responsive'" >
<thead>
	<tr style="background: black; color:yellow; vertical-align: middle; text-align: center;">
		<td colspan="10">SITUATION TRANSIT DES STOCK</td>
	</tr>

<?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
             if($titre=$res4->fetch()){
     ?>
  <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">NAVIRE:</td> <td colspan="4" style="color: red; border: none;"><?php echo $titre['navire']; ?></td>
    <td style="border: none;" colspan="4"></td>
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;"  colspan="2">PRODUIT</td>
    <td colspan="4" style="color: red; border: none;"><?php echo $titre['produit'].' '.$titre['qualite'].' '.$titre['poids_kg'].'KG'; ?></td>
    <td style="border: none;" colspan="4"></td>
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">ENTREPOT</td>
    <td colspan="4" style="color: red; border: none;"><?php echo $titre['mangasin']; ?></td>
    <td style="border: none;" colspan="4"></td>
    </tr>
    <tr style="background: white; color:black; font-size: 14px; border: none;">
    <td style="border: none;" colspan="2">RECEPTIONNAIRE</td>
    <td colspan="4" style="color: red; border: none;"><?php echo $titre['client']; ?></td>
    <td style="border: none;" colspan="4"></td>
    </tr>
  <?php } ?>

<tr style="background: blue; color:white; vertical-align: middle; text-align: center; font-size: 12px; ">	
	<th>N° ET DATES DECLARATION</th>
	<th>BL</th>
	<th>TITRE PRECEDENT</th>
	<th>QUANTITE T.P</th>
	<th>QUANTITE DECLARE</th>
	<th>CUMUL DECLARE</th>
	<th>RESTE A DECLARER</th>
	<th>LIVRAISON</th>
	<th>RESTE A DECLARERE SUR LIVRAISON</th>
	<th>ETAT APPROV</th>

		</tr>

</thead>
<tbody>	

<?php 
      $num_bon='NULL';
       $rowspanCumul=0;
     
 /*     $cumul_bon=cumul_des_bons($bdd,$produit,$poids_sac,$navire,$destination);
$cumul_bons=$cumul_bon->fetch();  */	

      $bon=afficher_situation_transit($bdd,$produit,$poids_sac,$navire,$destination);

 $bons=$bon->fetchAll(PDO::FETCH_ASSOC);



foreach ($bons as $row) {
     $total_livre_par_declaration= $row['sum(ls.poids_liv)']+ $row['sum(lm.poids_mo)'] + $row['sum(lb.poids_bal)'];
       $qt_reste_declaration=$row['poids_decliv']-$total_livre_par_declaration;

  ?>
  <tr style="vertical-align: middle; text-align: center; font-size: 12px;">	
    
    <td><?php echo $row['num_decliv']; ?></td>
    <td><?php echo $row['num_connaissement']; ?></td>
    <td></td>
    <td></td>
    <td><?php echo $row['poids_decliv']; ?></td>
    
    <td></td>
              
            
             <td > </td> 
           
   
    <td><?php echo $total_livre_par_declaration; ?></td>
    <td><?php echo $qt_reste_declaration; ?></td>
      <td></td>
  </tr>

<?php 	} ?>

 </tbody>
	</table>
</div>
 	</div>
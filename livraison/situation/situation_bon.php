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
	<tr style="background: black; color:yellow; vertical-align: middle; align-items: center; text-align: center; border: none;">
		<td colspan="11">SITUATION DES BONS D'ENLEVEMENT FOURNISSEUR</td>
	</tr>
	<?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
             if($titre=$res4->fetch()){
     ?>
	<tr style="background: white; color:black; font-size: 14px; border: none;">
		<td style="border: none;" colspan="2">NAVIRE:</td> <td colspan="4" style="color: red; border: none;"><?php echo $titre['navire']; ?></td>
		<td style="border: none;" colspan="5"></td>
		</tr>
		<tr style="background: white; color:black; font-size: 14px; border: none;">
		<td style="border: none;"  colspan="2">PRODUIT</td>
		<td colspan="4" style="color: red; border: none;"><?php echo $titre['produit'].' '.$titre['qualite'].' '.$titre['poids_kg'].'KG'; ?></td>
		<td style="border: none;" colspan="5"></td>
		</tr>
		<tr style="background: white; color:black; font-size: 14px; border: none;">
		<td style="border: none;" colspan="2">ENTREPOT</td>
		<td colspan="4" style="color: red; border: none;"><?php echo $titre['mangasin']; ?></td>
		<td style="border: none;" colspan="5"></td>
		</tr>
		<tr style="background: white; color:black; font-size: 14px; border: none;">
		<td style="border: none;" colspan="2">RECEPTIONNAIRE</td>
		<td colspan="4" style="color: red; border: none;"><?php echo $titre['client']; ?></td>
		<td style="border: none;" colspan="5"></td>
		</tr>
	<?php } ?>
	
<tr style="background: blue; color:white; vertical-align: middle; text-align: center; font-size: 12px; ">	
	<th>N° ET DATES DES BONS D'ENLEVEMENT</th>
	<th>BL</th>
	<th>N° ET QTE DE RELACHE</th>
	<th>DESTINATAIRE</th>
	<th>DESTINATION</th>
	<th>QUANTITE</th>
	<th>CUMUL DES BONS</th>
	<th>BALANCE</th>
	<th>LIVRAISON</th>
	<th>RESTE A LIVRER SUR BON</th>
	<th>CUMUL RESTE A LIVRER SUR BON</th>
		</tr>

</thead>
<tbody>	

<?php 
      $num_bon_navire='NULL';
       $rowspanCumul=0;

             $num_bon_navire2='NULL';
       $rowspanCumul2=0;

       $numero_bon_unique='NULL';
       $rowspanBon_unique=0;
       

       $ct=0;
     
      $cumul_bon=cumul_des_bons($bdd,$produit,$poids_sac,$navire,$destination);
$cumul_bons=$cumul_bon->fetch();  	

      $bon=afficher_situation_bon($bdd,$produit,$poids_sac,$navire,$destination);

 $bons=$bon->fetchAll(PDO::FETCH_ASSOC);



foreach ($bons as $row) {
     $total_livre_par_bon= $row['sum(ls.poids_liv)']+ $row['sum(lm.poids_mo)'] + $row['sum(lb.poids_bal)'];

       $qt_reste_bon=$row['poids_enleve']-$total_livre_par_bon;


     //$cumul_livre sert a calculer le reste a livrer sur bon
       $cumul_livre=$row['sum(ls.poids_liv)']+ $row['sum(lm.poids_mo)'] + $row['sum(lb.poids_bal)'];

      

     

  ?>
  <tr style="vertical-align: middle; text-align: center; font-size: 12px;">	
    
    <td><?php echo $row['num_enleve']; ?></td>
    <td><?php echo $row['num_connaissement']; ?></td>

 <?php if($numero_bon_unique!=$row['id_enleve']){
        	$rowspanBon_unique=0;
        	$numero_bon_unique=$row['id_enleve'];
      foreach ($bons as $r) {
       if($r['id_enleve']===$numero_bon_unique){
       	$rowspanBon_unique++;
      }
  }
     ?> 

             <td  rowspan="<?php echo $rowspanBon_unique; ?>" > <table>
             	<?php 
                       $id_bon=$row['id_enleve'];
             	  $bon_relache= afficher_relache_lie_au_bon($bdd,$id_bon);
      while($bon_relaches=$bon_relache->fetch()){ ?>
             	<tr >
             	<td style="vertical-align: middle; text-align: center;" > <?php echo $bon_relaches['num_relache']; ?> <br></td></tr>
              <?php } ?> </table></td> 
         <?php } ?>

    <td></td>
    <td></td>
    <td><?php echo $row['poids_enleve']; ?></td>
              
        <?php if($num_bon_navire!=$row['navire']){
        	$rowspanCumul=0;
        	$num_bon_navire=$row['navire'];
      foreach ($bons as $r) {
       if($r['navire']===$num_bon_navire){
       	$rowspanCumul++;
      }
  }
     ?>    
             <td rowspan="<?php echo $rowspanCumul ?>" > <?php echo $cumul_bons['sum(be.poids_enleve)'] ?> </td> 
         <?php } ?>
           
     <td></td>
    <td><?php echo $total_livre_par_bon; ?></td>
    <td><?php echo $qt_reste_bon; ?></td>
    <?php if($num_bon_navire2!=$row['navire']){
        	$rowspanCumul2=0;
        	$num_bon_navire2=$row['navire'];
        //	$cumul_livre=$total_livre_par_bon;
      foreach ($bons as $r) {
       if($r['navire']===$num_bon_navire2){
       	$rowspanCumul2++;
       	// $total_livre_par_bon2 RECUPERE LIGNE PAR LIGNE LE TOTAL LIVRE PAR BON
       	$total_livre_par_bon2= $r['sum(ls.poids_liv)']+ $r['sum(lm.poids_mo)'] + $r['sum(lb.poids_bal)'];
       	// $ct RECUPERE LE CUMUL TOTAL LIVRE PAR BON
       	$ct=$cumul_livre+$total_livre_par_bon2;

      }
  }
  $reste_a_livrer= $cumul_bons['sum(be.poids_enleve)']-$ct;
     ?>    
             <td rowspan="<?php echo $rowspanCumul2 ?>" > <?php echo $reste_a_livrer; ?> </td> 
         <?php } ?>
  </tr>

<?php 	} ?>

 </tbody>
	</table>
</div>
 	</div>
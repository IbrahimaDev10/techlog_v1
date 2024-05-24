<?php require("../database.php");
$c=$_POST['id'];
  require("requete.php");
   ?>

<div id="pv"  >

<div style="background: white; ">

 <div class="container-fluid">
  <div class="row">
   <div class=" col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 40px; width: 200px;">
  </div>

  </div>
</div>

 <div class="container-fluid">
  <div class="row">
  <div class=" col-md-12 col-lg-12" > <h6 style="font-weight: bolder; color: rgb(50, 159, 170); margin-bottom: 2px;">Societé des Industries Maritimes</h6>
  <h6 style=" color: rgba(50, 159, 218, 0.9); margin-bottom: 2px;">Shipping - Manutention - Transit</h6>
  <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Logistique - Transport -Entreposage</h6>
</div>
 <div class=" col-md-3 col-lg-3">
    </div>
    <div class="col-md-9 col-lg-9" >
   
  <h6 style="float: right;">Dakar le ................................</h6>  
  </div>


 </div>
  </div>

   <br>
  <div id="entete">
  <center>
  <h6>PROCES VERBAL DE FIN DE LIVRAISON</h6>
  </center>
</div>
<br>
<div class="table-responsive"  >
          
     <center>
  <table class='table ' id='table' style="border: none; width: 70%;" >

<?php
   $titre=titre_entete_pv($bdd,$c);
 while($t=$titre->fetch()){ ?>

  <tr style="border: none; font-size: 12px;">
    <td style="border: none; margin-bottom: 3px; font-size: 12px;">NAVIRE</td>
    <td style="border: none; margin-bottom: 3px; font-size: 12px;"><span style="color:red;"> :<?php echo $t['navire']; ?></span></td>
  </tr> 
    <tr style="border: none; font-size: 12px;">
    <td style="border: none; margin-bottom: 1px; font-size: 12px;">MANUTENTIONNAIRE</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:SIMAR SA</span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 3px; font-size: 12px;">CLIENT</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:<?php echo $t['client']; ?></span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 1px;">VARIETE</td>
    <td colspan="2" style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="vertical-align: middle; color: red;">  :<?php    echo $t['produit'].' '. $t['qualite'].' '.$t['poids_kg'].' KGS';  ?></span></td>
  </tr>   
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 1px;">ENTREPOT DE STOCKAGE</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:<?php echo $t['mangasin'] ?></span></td>
  </tr>
    <?php } ?>

  
  </table>
  </center> 
  </div>

         
  <button class="btn-primary hide-on-print" id="mybutton" class="hide-on-print" data-role="ajout_intervenant" data-id="<?php echo $t['id_dis_recep_bl'] ?>" >ajouter un intervenant</button>
    
  <div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 50%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="2"> RECEPTION</th>      
  </tr>
   <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  > NATURE DES SACS </td>
            <td id="colcol"  > NOMBRE DE SACS </td>
            
           </tr>

</thead>
<tbody>
  <?php
         
  $Sains_Recap=sain_reception($bdd,$c);
  $SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap->execute();




 while($sain=$Sains_Recap->fetch()){ 
  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();

  $sac_sains=$sain['sum(sac_recep)'] -($avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(sac_mouille_ra)'] + $ra['sum(sac_flasque_ra)'];
   

    ?>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >SACS SAINS </td>
            <td id="colcol"  > <?php echo number_format($sac_sains,0,',',' '); ?> </td>
            
           </tr>
      <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUE RECEPTION </td>
            <td id="colcol"  > <?php echo number_format($avr['sum(sac_flasque_avr)'],0,',',' '); ?> </td>
            
           </tr>
       <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES RECEPTION </td>
            <td id="colcol"  >  <?php echo number_format($avr['sum(sac_mouille_avr)'],0,',',' '); ?> </td>
            
           </tr>  
        <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(sac_flasque_ra)'],0,',',' '); ?> </td>
            
           </tr>   
            <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(sac_mouille_ra)'],0,',',' '); ?> </td>
            
           </tr> 

            <tr   style="text-align: center; vertical-align: middle; font-size: 12px; background: black; color: white;  "  > 
            <td  style="color: white;"  >CUMUL SACS RECEPTIONNES </td>
            <td id="colcol" style="color: white;" > <?php echo number_format($cumul_sac,0,',',' '); ?> </td>
            
           </tr>  
         
           

</tbody>
</table>
</center>
</div>
<style type="text/css" >
  .reg{
    bottom: 0;
  }
  .footer{
    display: none !important;
  }
</style>

<div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 100%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="8"> RECONDITIONNEMENT DE RECEPTION</th> 
</tr>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
  <th>NATURE DES SACS</th>
   <th>NOMBRE DE SACS</th>
    <th>POIDS DES AVARIES</th>
     <th>RECONDITIONNEMENT EN SACS</th>
      <th>RECONDITIONNEMENT EN POIDS</th>
      <th>SACS BALAYURES</th>
      <th>POIDS BALAYURES</th>
       <th>PERTES EN SACS</th>
   </tr>
 </thead>
 <tbody>
   <tr style="text-align: center; vertical-align: middle; font-size: 12px;  " >
    <th>FLASQUES</th>
    <?php  $recond_DEPART_Recap=reconditionnement_reception($bdd,$c);
           $SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
           $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
           $SomRa_DEPART_Recap->execute();
           $poids_kg=find_poids_kg($bdd,$c);



       $rec=$recond_DEPART_Recap->fetch();
       $avaries_recep=$SomAvr_DEPART_Recap->fetch();
       $avaries_deb=$SomRa_DEPART_Recap->fetch();
       $kg=$poids_kg->fetch();
       $poids_avaries=$rec['sum(sac_eventres)']*$kg['poids_kg']/1000;
       $perte_sac=$rec['sum(sac_eventres)']-($rec['sum(sac_av_recond)']+$rec['sum(sac_balayure_recond)']);
       $stock_depart_sacs=$sac_sains+$rec['sum(sac_av_recond)'];
       $stock_depart_poids=$stock_depart_sacs*$kg['poids_kg']/1000;
       $total_mouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
       $poids_total_mouille=$total_mouille*$kg['poids_kg']/1000;
       $flasque_restant=$avr['sum(sac_flasque_avr)'] + $ra['sum(sac_flasque_ra)'] - $rec['sum(sac_eventres)']; 
    
  ?>
  <td><?php echo number_format($rec['sum(sac_eventres)'],0,',',' '); ?></td>
  <td><?php echo number_format($poids_avaries,3,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(sac_av_recond)'],0,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(poids_av_recond)'],3,',',' '); ?></td>
   <td><?php echo number_format($rec['sum(sac_balayure_recond)'],0,',',' '); ?></td>
   <td><?php echo number_format($rec['sum(poids_balayure_recond)'],3,',',' '); ?></td>
  <td><?php echo number_format($perte_sac,0,',',' '); ?></td>

  </tr>

   
 </tbody>
</table>
</center>
</div>
 <center>
<h6 style="color: black !important; font-weight: bold;"> > Nouveaux stocks après reconditionnement <span style="color: red;"><?php echo number_format($stock_depart_sacs,0,',',' '); ?></span> sacs sains soit <span style="color: red;"><?php echo number_format($stock_depart_poids,3,',',' ').' T'; ?> </span>/  total mouilles: <span style="color: red;"> <?php echo number_format($total_mouille,0,',',' '); ?></span> sacs /  total balayures: <span style="color: red;"> <?php echo number_format($rec['sum(sac_balayure_recond)'],0,',',' '); ?></span> sacs soit <span style="color: red;"> <?php echo number_format($rec['sum(poids_balayure_recond)'],3,',',' ').' T'; ?> </span>/ <?php if($flasque_restant!=0){ ?>
FLASQUES RESTANTS:  <span style="color: red;"><?php echo number_format($flasque_restant,0,',',' '); ?></span> sacs 
<?php } ?> </h6><br>



</center>
<br>




<div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 50%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1' >
    
 
<thead>
         
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="8"> RECONDITIONNEMENT EN COURS DE LIVRAISON</th> 
</tr>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
  <th>NATURE DES SACS</th>
   <th>NOMBRE DE SACS</th>
    <th>POIDS DES AVARIES</th>
     <th>RECONDITIONNEMENT EN SACS</th>
      <th>RECONDITIONNEMENT EN POIDS</th>
       <th>SACS BALAYURES</th>
       <th>POIDS BALAYURES</th>
       <th>PERTES EN SACS</th>
   </tr>
 </thead>
 <tbody>
   <tr style="text-align: center; vertical-align: middle; font-size: 12px;  " >
    <th>SACS FLASQUES DE RECEPTIONS</th>
    <?php  $recond_LIV=reconditionnement_livraison($bdd,$c);
           $poids_kg=find_poids_kg($bdd,$c);
           $afficher_somme=afficher_somme_livraison_sain($bdd,$c);
           $afficher_somme_avaries=afficher_somme_avaries_livraison($bdd,$c);
           

       $aff_som_avaries=$afficher_somme_avaries->fetch();
       $aff_som=$afficher_somme->fetch();
       $rec=$recond_LIV->fetch();
       $kg=$poids_kg->fetch();
       $poids_avaries=$rec['sum(sac_eventres_liv)']*$kg['poids_kg']/1000;
       $perte_sac=$rec['sum(sac_eventres_liv)']-($rec['sum(sac_av_recond_liv)']+$rec['sum(sac_balayure_recond_liv)']);
       $flasque_livraison_restant=$aff_som_avaries['sum(sac_flasque_liv)']-$rec['sum(sac_eventres_liv)'];
       $stock_depart_sac_liv=$stock_depart_sacs+$rec['sum(sac_av_recond_liv)']-$aff_som['sum(sac_liv)']-$aff_som_avaries['sum(sac_flasque_liv)'];
       $stock_depart_poids=$stock_depart_sacs*$kg['poids_kg']/1000;
    
  ?>
  <td><?php echo number_format($rec['sum(sac_eventres_liv)'],0,',',' '); ?></td>
  <td><?php echo number_format($poids_avaries,3,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(sac_av_recond_liv)'],0,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(poids_av_recond_liv)'],3,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(sac_balayure_recond_liv)'],0,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(poids_balayure_recond_liv)'],3,',',' '); ?></td>
  <td><?php echo number_format($perte_sac,0,',',' '); ?></td>

  </tr>

   
 </tbody>
</table>
</center>
</div>
 <center>
<h6 style="color: black !important; font-weight: bold;"> > LIVRES <span style="color: red;"><?php echo number_format($aff_som['sum(sac_liv)'],0,',',' '); ?></span> sacs soit <span style="color: red;"><?php echo number_format($aff_som['sum(poids_liv)'],3,',',' ').' T'; ?> flasque de livraison: <span style="color: red;"><?php echo number_format($flasque_livraison_restant,0,',',' '); ?></span> sacs / mouille de livraison: <span style="color: red;"><?php echo number_format($aff_som_avaries['sum(sac_mouille_liv)'],0,',',' '); ?></span> sacs  / mouille de reception: <span style="color: red;"><?php echo number_format($avaries_recep['sum(sac_mouille_avr)'],0,',',' '); ?></span> sacs / mouille de debarquement: <span style="color: red;"><?php echo number_format($avaries_deb['sum(sac_mouille_ra)'],0,',',' '); ?></span> sacs </h6>
</center>

<?php } ?>


   
<a  style="margin:auto-right; width: 20%;" class="btn-primary hide-on-print" data-role="imprimer_pv_reception">imprimer</a><br>

</div>
</div>

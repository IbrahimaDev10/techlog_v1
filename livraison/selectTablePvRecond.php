<?php require("../database.php");
     $c=$_POST['id'];
      // require("requete.php"); 
      require('../reception/controller/acces_reception.php');
//require('controller/mes_reconditionnement.php');
require('../reception/controller/afficher_les_receptions.php');
require('../reception/controller/stock_depart.php');
require('controller/reste_a_livrer.php');

  
      

  $produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];
echo $produit;
echo $poids_sac;
echo $destination;
echo $navire;

       ?>

       <div  id="pv_recond"  >

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
  <h6>PROCES VERBAL DE RECONDITIONNEMENT</h6>
  </center>
</div>
<br>
<div class="table-responsive"  >
          
     <center>
  <table class='table ' id='table' style="border: none; width: 70%;" >

<?php
   $titre=titre_entete_pv($bdd,$produit,$poids_sac,$navire,$destination);
 if($t=$titre->fetch()){ ?>

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

         
  <button class="btn-primary hide-on-print" id="mybutton" class="hide-on-print" data-role="ajout_intervenant" data-id="<?php //echo $t['id_dis_recep_bl'] ?>" >ajouter un intervenant</button>
    
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
         
/*  $Sains_Recap=sain_reception($bdd,$c);
  $SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap->execute(); */




/* while($sain=$Sains_Recap->fetch()){ 
  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();

  $sac_sains=$sain['sum(sac_recep)'] -($avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(sac_mouille_ra)'] + $ra['sum(sac_flasque_ra)']; */
   

    ?>
  <?php
         
  $Sains_Recap=sain_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomAvr_DEPART_Recap=avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap->execute();




 while($sain=$Sains_Recap->fetch()){ 

  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();


  $sac_sains=$sain['sum(rec.sac_recep)'] -($avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(ra.sac_mouille_ra)'] + $ra['sum(ra.sac_flasque_ra)'];
   echo  $sac_sains;

    ?>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >SACS SAINS </td>
            <td id="colcol"  > <?php echo number_format($sac_sains,0,',',' '); ?> </td>
            
           </tr>
      <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUE RECEPTION </td>
            <td id="colcol"  > <?php echo number_format($avr['sum(avr.sac_flasque_avr)'],0,',',' '); ?> </td>
            
           </tr>
       <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES RECEPTION </td>
            <td id="colcol"  >  <?php echo number_format($avr['sum(avr.sac_mouille_avr)'],0,',',' '); ?> </td>
            
           </tr>  
        <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(ra.sac_flasque_ra)'],0,',',' '); ?> </td>
            
           </tr>   
            <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(ra.sac_mouille_ra)'],0,',',' '); ?> </td>
            
           </tr> 

            <tr   style="text-align: center; vertical-align: middle; font-size: 12px; background: black; color: white;  "  > 
            <td  style="color: white;" >CUMUL SACS RECEPTIONNES </td>
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
    
<?php afficher_stock_depart_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>



 



</center>
<br>


 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
   <!--   <td  rowspan="2"   >N°</td>
       <td   rowspan="2"   >DATE</td> !-->
    <!--    <td   colspan="2"   >FLASQUES DE LIVRAISON</td> !-->
        <td  rowspan="2"  >SACS DECHIRES</td>
     
      <td   colspan="2" > RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
  <!--     <td   rowspan="2"  >FLASQUES RESTANTS</td> !-->
  </tr>
      
 <tr id="th_table_rec" >
    <!--   <td   >SACS</td> !-->
    
    <!--  <td    >POIDS</td> !-->

   

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>

     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>

  <?php $som_sain=somme_sain_livrer($bdd,$produit,$poids_sac,$navire,$destination);
        $som_mouille=somme_mouille_livrer($bdd,$produit,$poids_sac,$navire,$destination);
        $som_balayure=somme_balayure_livrer($bdd,$produit,$poids_sac,$navire,$destination);
        $som_recond=somme_recond_livraison($bdd,$produit,$poids_sac,$navire,$destination);
         $recond_DEPART_Recap=reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination);
         $som_av_liv=somme_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination);

         /* test */
         $new_som_sain=somme_sain_livres($bdd,$produit,$poids_sac,$navire,$destination);
         $new_som_mouille=somme_mouille_livres($bdd,$produit,$poids_sac,$navire,$destination);
         $new_som_balayure=somme_balayure_livres($bdd,$produit,$poids_sac,$navire,$destination);

        while($som_sains=$som_sain->fetch()){
          $som_mouilles=$som_mouille->fetch();
          $som_balayures=$som_balayure->fetch();
          $som_reconds=$som_recond->fetch();
          $som_av_livs=$som_av_liv->fetch();

          $new_som_sains=$new_som_sain->fetch();
          $new_som_mouilles=$new_som_mouille->fetch();
          $new_som_balayures=$new_som_balayure->fetch();

          $rec=$recond_DEPART_Recap->fetch();

          $perte=$som_reconds['SUM(rl.sac_eventres_liv)']-$som_reconds['SUM(rl.sac_av_recond_liv)']- $som_reconds['SUM(rl.sac_balayure_recond_liv)'];
          
          // Calcul du nouveau stock depart
         //VARIABLE DU FONCTION DERIVEE RECEPTION
          $mouille_reception_livraison=$avr['sum(avr.sac_mouille_avr)']+$ra['sum(ra.sac_mouille_ra)']+$som_av_livs['sum(avl.sac_mouille_liv)'];
           $flasque_reception_livraison=$avr['sum(avr.sac_flasque_avr)']+$ra['sum(ra.sac_flasque_ra)']+$som_av_livs['sum(avl.sac_flasque_liv)'];
           $sac_sains=$sain['sum(rec.sac_recep)'] -($avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']);
         
          $balayure_reception_livraison=$rec['sum(recon.sac_balayure_recond)']+$som_reconds['SUM(rl.sac_balayure_recond_liv)'];

           $cumul_sac=$sac_sains + $ra['sum(ra.sac_mouille_ra)'] + $ra['sum(ra.sac_flasque_ra)'];
            $perte_sac=$rec['sum(recon.sac_eventres)']-($rec['sum(recon.sac_av_recond)']+$rec['sum(recon.sac_balayure_recond)']);
            $stock_depart_sacs=$cumul_sac-$perte_sac;

          $total_livres= $som_sains['sum(liv.sac_liv)']+$som_mouilles['sum(liv.sac_mo)']+$som_balayures['sum(liv.sac_bal)'];

          $stock_depart_sac_liv= $stock_depart_sacs-$total_livres-$perte;
          $stock_depart_poids=$stock_depart_sac_liv*$som_sains['poids_kg']/1000;

          $restant_mouille=$mouille_reception_livraison-$som_mouilles['sum(liv.sac_mo)'];
          $restant_flasque=$flasque_reception_livraison-$rec['sum(recon.sac_eventres)']-$som_reconds['SUM(rl.sac_eventres_liv)'];
          $restant_poids_mouille=$restant_mouille*$som_sains['poids_kg']/1000;

          $restant_balayure=$balayure_reception_livraison-$som_balayures['sum(liv.sac_bal)'];
         ?>

     <tr id="tr_data_sain" >

    
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($som_reconds['SUM(rl.sac_eventres_liv)'], 0,',',' '); ?></td>
   
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($som_reconds['SUM(rl.sac_av_recond_liv)'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($som_reconds['SUM(rl.poids_av_recond_liv)'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($som_reconds['SUM(rl.sac_balayure_recond_liv)'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($som_reconds['SUM(rl.poids_balayure_recond_liv)'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>

   
   

   
      


</tr>


  




</tbody>
             

            

</table>
</div>
</div>


 	
<h6 style="color: black !important; font-weight: bold;"> >Nouveaux stocks après reconditionnement <span style="color: red;"> <?php echo $new_som_sains['sum(liv.sac_liv)']; ?> <?php echo $new_som_mouilles['sum(liv.sac_liv)']; ?> <?php echo $new_som_balayures['sum(liv.sac_liv)']; ?> <?php echo $som_av_livs['sum(avl.sac_mouille_liv)'] ?> <?php echo number_format($stock_depart_sac_liv,0,',',' '); ?></span> sacs soit <span style="color: red;"><?php echo number_format($stock_depart_poids,3,',',' '); ?> T    </span>  dont =><span style="background: yellow;">  mouille restant: <span style="color: red;"><?php echo number_format($restant_mouille,0,',',' '); ?></span> sacs  soits <span style="color: red;"><?php echo number_format($restant_poids_mouille,3,',',' '); ?> T </span>  balayure restant: <span style="color: red;"><?php echo number_format($restant_balayure,0,',',' '); ?></span>  flasques restants: <span style="color: red;"><?php echo number_format($restant_flasque,0,',',' '); ?></span></h6></span>
</center>




   
<a  style="margin:auto-right; width: 20%;" class="btn-primary hide-on-print" data-role="imprimer_pv_reception">imprimer</a><br>
<?php } ?>
<?php } // FERMETURE BOUCLE $sain_RECAP ?>

</div>
</div>

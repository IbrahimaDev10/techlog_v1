<style type="text/css">
  *{
    font-family: Times-New-Roman;
  }
  table{
    border-collapse: collapse;
  }
  @media print {
    /* Masquer le titre et la date dans la version imprimée */
    #btn_imprimer_pv, #ajout_intervenant, .sub_inter {
        display: none !important;
    }
       #reception_pvs {
        height: 300px;
    }
    @import url('../assets/modules/bootstrap-5.1.3/css/bootstrap.css');
}
</style>

 <div id="pvrec" >

<div style="background: white;">

 <div class="container-fluid">
  <div class="row">
   <div class=" col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 40px; width: 200px;">
  </div>

  </div>
</div>
<?php $type_navires=type_de_navires($bdd,$navire);
$tn=$type_navires->fetch(); ?>
 <div class="container-fluid">
  <div class="row">
  <div class=" col-md-12 col-lg-12" > <h6 style="font-weight: bolder; color: blue; margin-bottom: 2px;">Societé des Industries Maritimes</h6>
  <h6 style=" color:blue; margin-bottom: 2px;">Shipping - Manutention - Transit</h6>
  <h6 style="float: left; color: blue; ">Logistique - Transport -Entreposage</h6>
</div>
 <div class=" col-md-3 col-lg-3">
    </div>
    <div class="col-md-9 col-lg-9" >
      <?php
        if($tn['type']=='SACHERIE'){
       $date_reception=Date_Reception($bdd,$produit,$poids_sac,$navire,$destination);
       $date_reception_fin=Date_Reception_fin($bdd,$produit,$poids_sac,$navire,$destination);
       } 
       if($tn['type']=='VRAQUIER'){
       $date_reception=Date_Reception_vrac($bdd,$produit,$poids_sac,$navire,$destination);
       $date_reception_fin=Date_Reception_fin_vrac($bdd,$produit,$poids_sac,$navire,$destination);
       }

        ?>
   
  <h6 style="float: right;">Dakar le <?php  ?>
   
   <?php if($date_receptions_fin=$date_reception_fin->fetch()){?> <span style="color:black;"><?php  $datePV2 = date_create_from_format('Y-m-d', $date_receptions_fin['dates']);
                $date_convertiPV2 = $datePV2->format('d-m-Y');
                 echo $date_convertiPV2; } ?></span> </h6>  
  </div>


 </div>
  </div>

   <br>
  <div id="entete" style="background: blue; ">
  <center>
  <h3 style="color: white;">PROCES VERBAL DE RECEPTION</h3>
  </center>
</div>
<br>
<div class="table-responsive"  >
          
     <center>
  <table class='table ' id='table' style="border: none; width: 80%;" >

<?php
  if($tn['type']=='SACHERIE'){
   $titre=titre_entete_pv($bdd,$produit,$poids_sac,$navire,$destination);
  }
    if($tn['type']=='VRAQUIER'){
   $titre=titre_entete_pv_vrac($bdd,$produit,$poids_sac,$navire,$destination);
  }
 if($t=$titre->fetch()){ 
     
     $etb = date_create_from_format('Y-m-d', $t['etb']);
                $etb_converti = $etb->format('d-m-Y');

  ?>

  <tr style="border: none; font-size: 12px; font-weight: bold;">
    <td style="border: none; margin-bottom: 5px; font-size: 12px;">NAVIRE </td>
    <td style="border: none; margin-bottom: 5px; font-size: 12px;"><span style="color:blue;"> :<?php echo $t['navire']; ?>  <?php echo $etb_converti; ?></span></td>
  </tr> 
    <tr style="border: none; font-size: 12px; font-weight: bold;">
    <td style="border: none; margin-bottom: 5px; ">MANUTENTIONNAIRE</td>
    <td style="border: none; margin-bottom: 5px; f"><span style="color:blue;">:SIMAR SA</span></td>
  </tr> 
    <tr style="font-weight: bold; font-size: 12px; ">
    <td style="border: none; font-size: 12px; margin-bottom: 5px; ">CLIENT</td>
    <td style="border: none; margin-bottom: 5px; "><span style="color:blue;">:<?php echo $t['client']; ?></span></td>
  </tr> 
    <tr style="font-weight: bold; font-size: 12px; ">
    <td style="border: none; font-size: 12px; margin-bottom: 5px;">VARIETE</td>
    <td colspan="2" style="border: none; margin-bottom: 5px; "><span style="vertical-align: middle; color:blue;">  :<?php    echo $t['produit'].' '. $t['qualite'].' '.$t['poids_kg'].' KGS';  ?></span></td>
  </tr>   
    <tr style="font-weight: bold; font-size: 12px; ">
    <td style="border: none; font-size: 12px; margin-bottom: 5px;">ENTREPOT DE STOCKAGE</td>
    <td style="border: none; margin-bottom: 5px; "><span style="color:blue;">:<?php echo $t['mangasin'] ?></span></td>
  </tr>

    
    <?php } ?>

    <tr style="font-weight: bold;">
    
    
  </tr>

  
  </table>
  </center> 
  </div>
              
                <br> 
                <a class="btn btn-primary " id="ajout_intervenant"  style=" background: blue !important; color: white !important;  " class="btn hide-on-print" data-role="ajout_intervenant" data-produit="<?php echo $produit; ?>" data-poids_sac="<?php echo $poids_sac; ?>" data-navire="<?php echo $navire; ?>" data-destination="<?php echo $destination; ?>" >ajouter intervenant </a>

  <center>
  <div style="width: 80%; display: flex; justify-content: center; ">

  
  <span style="  margin-bottom: 5px; color: black; font-weight: bold; font-size: 14px;">DATE DEBUT:  <?php if($tn['type']=='SACHERIE'){
       $date_reception=Date_Reception($bdd,$produit,$poids_sac,$navire,$destination);
       $date_reception_fin=Date_Reception_fin($bdd,$produit,$poids_sac,$navire,$destination);
       } 
       if($tn['type']=='VRAQUIER'){
       $date_reception=Date_Reception_vrac($bdd,$produit,$poids_sac,$navire,$destination);
       $date_reception_fin=Date_Reception_fin_vrac($bdd,$produit,$poids_sac,$navire,$destination);
       } ?>
   
   <?php if($date_receptions=$date_reception->fetch()){?> <span style="color:blue;"><?php  $datePV = date_create_from_format('Y-m-d', $date_receptions['dates']);
                $date_convertiPV = $datePV->format('d-m-Y');
                 echo $date_convertiPV; } ?></span>  </span>


                   <span style=" margin-bottom: 5px;  color: black; margin-left: 20px; font-weight: bold; font-size: 14px;">DATE FIN:  
   
   <?php if($date_receptions_fin=$date_reception_fin->fetch()){?> <span style="color:blue;"><?php  $datePV2 = date_create_from_format('Y-m-d', $date_receptions_fin['dates']);
                $date_convertiPV2 = $datePV2->format('d-m-Y');
                 echo $date_convertiPV2; } ?></span>  </h6> 


                 </div> </center> 
                 
 
         
  
    
  <div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 80%;" class='table table-hover table-bordered table-striped table-responsive' id="reception_pvs" border='1'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="  text-align: center; vertical-align: middle; font-size: 12px; background: blue; color:white; font-weight: bold;"  >
     <th colspan="3"> RECEPTION</th>      
  </tr>
   <tr   style="text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold;"  > 
            <th  style="color: black; font-weight: bold;"  > NATURE DES SACS </th>
            <th style="font-weight: bold;" id="colcol"  > NBRE DE SACS </th>
            <th style="font-weight: bold;" id="colcol"  > POIDS (T) </th>
            
           </tr>

</thead>
<tbody>
  <?php
         
  //$Sains_Recap=sain_reception($bdd,$produit,$poids_sac,$navire,$destination);
 /* $SomAvr_DEPART_Recap=avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap->execute(); */
 if($tn['type']='SACHERIE'){
  $Total_reception=Total_Reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_avaries_reception=Total_Avaries_de_reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_reception_flasque_deb= Total_Reception_flasque_deb($bdd,$produit,$poids_sac,$navire,$destination);

     $total_reception_mouille_deb= Total_Reception_mouille_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $total_reception_balayure_deb= Total_Reception_balayure_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $recond_transfert=Total_Recond_transfert($bdd,$produit,$poids_sac,$navire,$destination);
    }

     if($tn['type']='VRAQUIER'){
  $Total_reception=Total_Reception_vrac($bdd,$produit,$poids_sac,$navire,$destination);

    $total_avaries_reception=Total_Avaries_de_reception_vrac($bdd,$produit,$poids_sac,$navire,$destination);

    $total_reception_flasque_deb= Total_Reception_flasque_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination);

     $total_reception_mouille_deb= Total_Reception_mouille_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination);

      $total_reception_balayure_deb= Total_Reception_balayure_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination);

      $recond_transfert=Total_Recond_transfert_vrac($bdd,$produit,$poids_sac,$navire,$destination);
    }



 while($Total_receptions=$Total_reception->fetch()){ 
      $total_avaries_receptions=$total_avaries_reception->fetch();

      $fl_deb=$total_reception_flasque_deb->fetch();
       $m_deb=$total_reception_mouille_deb->fetch();
        $bl_deb=$total_reception_balayure_deb->fetch();

        $recond_tr=$recond_transfert->fetch();
/*  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();

  $sac_sains=$sain['sum(rec.sac_recep)'] -($avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(ra.sac_mouille_ra)'] + $ra['sum(ra.sac_flasque_ra)']; */
  $sac_sains= $Total_receptions['sum(rta.sac)']-($total_avaries_receptions['sum(avt.sac_flasque)'] + $total_avaries_receptions['sum(avt.sac_mouille)']);

  $poids_sains= $sac_sains*$Total_receptions['poids_sac']/1000;
  $poids_mouille_reception= $total_avaries_receptions['sum(avt.sac_mouille)']*$Total_receptions['poids_sac']/1000;
  $poids_flasque_reception=$total_avaries_receptions['sum(avt.sac_flasque)']*$Total_receptions['poids_sac']/1000;


  $total_sacs_receptionnes=$sac_sains+$total_avaries_receptions['sum(avt.sac_flasque)']+$total_avaries_receptions['sum(avt.sac_mouille)']+$fl_deb['sum(rta.sac)']+$m_deb['sum(rta.sac)']+$bl_deb['sum(rta.sac)'];

  $total_poids_receptionnes=$poids_sains+$poids_mouille_reception+$poids_flasque_reception+$fl_deb['sum(rta.poids)']+$m_deb['sum(rta.poids)']+$bl_deb['sum(rta.poids)'];

  $perte_sur_reconditionnement=$recond_tr['sum(rt.sac_eventres)']-($recond_tr['sum(rt.sac_recond)'] + $recond_tr['sum(rt.sac_balayure)']);
  $sac_stock_depart=$total_sacs_receptionnes-$perte_sur_reconditionnement;
  $poids_stock_depart=$sac_stock_depart*$Total_receptions['poids_sac']/1000;

    ?>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold;"  > 
            <td  style="color: black;"  >SACS SAINS </td>
            <td id="colcol"  > <?php echo number_format($sac_sains,0,',',' '); ?> </td>
             <td id="colcol"  > <?php echo number_format($poids_sains,3,',',' '); ?> </td>
            
           </tr>
      <tr   style="text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold; "  > 
            <td  style="color: black;"  >FLASQUE RECEPTION </td>
            <td id="colcol"  > <?php echo number_format($total_avaries_receptions['sum(avt.sac_flasque)'],0,',',' '); ?> </td>
          <td id="colcol"  > <?php echo number_format($poids_flasque_reception,3,',',' '); ?> </td>
            
           </tr>
       <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  font-weight: bold;"  > 
            <td  style="color: black;"  >MOUILLES RECEPTION </td>
            <td id="colcol"  >  <?php echo number_format($total_avaries_receptions['sum(avt.sac_mouille)'],0,',',' '); ?> </td>
            <td id="colcol"  > <?php echo number_format($poids_mouille_reception,3,',',' '); ?> </td>
            
           </tr>  
        <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  font-weight: bold;"  > 
            <td  style="color: black;"  >FLASQUES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($fl_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            <td id="colcol"  > <?php echo number_format($fl_deb['sum(rta.poids)'],3,',',' '); ?> </td>
            
           </tr>   
            <tr   style="text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold; "  > 
            <td  style="color: black;"  >MOUILLES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($m_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            <td id="colcol"  > <?php echo number_format($m_deb['sum(rta.poids)'],3,',',' '); ?> </td>
            
           </tr> 
          <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  font-weight: bold;"  >
           <td  style="color: black;"  >BALAYURES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($bl_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            <td id="colcol"  > <?php echo number_format($bl_deb['sum(rta.poids)'],3,',',' '); ?> </td>
            
           </tr>

            <tr   style="text-align: center; vertical-align: middle; font-size: 18px; background: blue; color: white;  font-weight: bold;"  > 
            <td  style="color: yellow; "  >CUMUL SACS RECEPTIONNES </td>
            <td id="colcol" style="color: yellow;" > <?php echo number_format($total_sacs_receptionnes,0,',',' '); ?>  </td>
            <td id="colcol" style="color: yellow;" > <?php echo number_format($total_poids_receptionnes,3,',',' '); ?>  </td>
            
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


 <?php } ?> 
 
<center> 
<div class="container-fluid" id='liste_intervenant'>
<div class="row">

  <?php  $compte_intervenants= compte_intervenants($bdd,$produit, $poids_sac,$navire,$destination);
        $compte=$compte_intervenants->fetch();
         $col=1; 
         $col_simar=1;
         if($compte['count(inter_rep.id)']==0){
          $col=0;
          $col_simar=12;
         }
          if($compte['count(inter_rep.id)']==1){
          $col=6;
          $col_simar=6;
         }
         if($compte['count(inter_rep.id)']==2){
          $col=4;
          $col_simar=4;
         }
         if($compte['count(inter_rep.id)']==3){
          $col=3;
          $col_simar=3;
         }
         if($compte['count(inter_rep.id)']==4){
          $col=2;
          $col_simar=4;
         }
         if($compte['count(inter_rep.id)']==5){
          $col=2;
          $col_simar=2;
         } ?>
 
<div class="col col-md-<?php echo $col_simar; ?> col-lg-<?php echo $col_simar; ?>" style="">
  <span style="color: black; font-size: 16px; font-weight: bold; text-decoration: underline;"> SIMAR</span>
  
</div>
<?php   $les_intervenants=afficher_les_intervenants($bdd,$produit, $poids_sac,$navire,$destination);
while($inter=$les_intervenants->fetch()){ ?>
<div class="col col-md-<?php echo $col; ?> col-lg-<?php echo $col; ?>" style="color: black; font-size: 16px; font-weight: bold;">
  <span style="color: black; font-size: 16px; font-weight: bold; text-decoration: underline;"> <?php  echo $inter['nom_intervenant'] ?></span> <a class="sub_inter" title='supprimer ' style="color: blue;" data-role='supprimer_intervenant'  onclick="deleteIntervenant(<?php echo $inter['id'] ?>)"  > <i class="fas fa-trash"></i></a>
  
</div>
<?php  } ?>




</div></div> </center>
 
<a class="btn btn-primary " id="btn_imprimer_pv"  style=" background: blue !important; color: white !important;  " class="btn hide-on-print" data-role="imprimer_pv">imprimer</a>

    <div class="container-fluid reg" style="">
  <div class="row">

 <div class=" col-md-12 col-lg-12"  > 
  <div class="footers" style="border-left: 2px solid rgba(50, 159, 218, 0.9) !important; border-bottom: 2px solid rgba(50, 159, 218, 0.9) !important; border-right: 2px solid rgba(50, 159, 218, 0.9) !important;   width: 92%; font-size: 12px; position: fixed; bottom:0;">
  <center>
  <h6 style="font-size: 12px !important; ">
    RC 2000 B 69 -NINEA 0394586 2G3 -NITI 202204477/B Adresse: 2, Place de l'independance - BP 27190 Dakar - <br> Tel: 33 823 69 96- Fax: 33 823 69 95 - www.simarsn.com
  </h6>
  </center>
   
  </div>
</div>
  
 

</div></div>
</div>
</div>
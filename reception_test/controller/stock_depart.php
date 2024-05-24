<?php
require('situations_receptions_de_transferts.php');
require('mes_reconditionnement.php');

 function reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination){
      $recond_DEPART_Recap = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends,  sum(recon.sac_eventres), sum(recon.sac_av_recond), sum(recon.poids_av_recond),sum(recon.sac_balayure_recond), sum(recon.poids_balayure_recond)  from reconditionnement_reception as recon
               inner join transit_extends as ex on ex.id_trans_extends=recon.id_declaration_recond
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

        $recond_DEPART_Recap->bindParam(1,$produit);
        $recond_DEPART_Recap->bindParam(2,$poids_sac);
        $recond_DEPART_Recap->bindParam(3,$navire);
        $recond_DEPART_Recap->bindParam(4,$destination);
        $recond_DEPART_Recap->execute();
        return $recond_DEPART_Recap;
      }

       function sain_reception($bdd,$produit,$poids_sac,$navire,$destination){
          $Sains_Recap = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends, rec.poids_sac_recep, sum(rec.sac_recep), sum(rec.poids_recep)  from reception as rec
            inner join transit_extends as ex on ex.id_trans_extends=rec.id_dec
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

        $Sains_Recap->bindParam(1,$produit);
        $Sains_Recap->bindParam(2,$poids_sac);
        $Sains_Recap->bindParam(3,$navire);
        $Sains_Recap->bindParam(4,$destination);
        $Sains_Recap->execute();
        return $Sains_Recap;
      }

       function avaries_reception($bdd,$produit,$poids_sac,$navire,$destination){
                  $SomAvr_DEPART_Recap = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends, sum(avr.sac_flasque_avr),sum(avr.sac_mouille_avr) from avaries_de_reception as avr
                    inner join transit_extends as ex on ex.id_trans_extends=avr.id_declaration_avr
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
               inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
           WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

       $SomAvr_DEPART_Recap->bindParam(1,$produit);
         $SomAvr_DEPART_Recap->bindParam(2,$poids_sac);
        $SomAvr_DEPART_Recap->bindParam(3,$navire);
         $SomAvr_DEPART_Recap->bindParam(4,$destination);
         $SomAvr_DEPART_Recap->execute();
        return $SomAvr_DEPART_Recap;

      }

        function reception_avaries_reception($bdd,$produit,$poids_sac,$navire,$destination){
                 $SomRa_DEPART_Recap = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends, sum(ra.sac_flasque_ra),sum(ra.sac_mouille_ra),sum(ra.poids_flasque_ra),sum(ra.poids_mouille_ra) from reception_avaries as ra
                  inner join transit_extends as ex on ex.id_trans_extends=ra.id_declaration_ra
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

        $SomRa_DEPART_Recap->bindParam(1,$produit);
         $SomRa_DEPART_Recap->bindParam(2,$poids_sac);
         $SomRa_DEPART_Recap->bindParam(3,$navire);
          $SomRa_DEPART_Recap->bindParam(4,$destination);
          $SomRa_DEPART_Recap->execute();
        return $SomRa_DEPART_Recap;

      }

        function MyPoids2($bdd,$produit,$poids_sac,$navire,$destination){
             $MyPoids = $bdd->prepare("SELECT  dis.poids_kg, nc.id_navire from dispat as dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

               $MyPoids2->bindParam(1,$produit);
        $MyPoids2->bindParam(2,$poids_sac);
        $MyPoids2->bindParam(3,$navire);
         $MyPoids2->bindParam(4,$destination);
       $MyPoids2->excute();

        return $MyPoids2 ;
}



function afficher_stock_depart_reception($bdd,$produit,$poids_sac,$navire,$destination){
   $recond_DEPART_Recap=reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination);
           //$poids_kg=find_poids_kg($bdd,$c);

$MyPoids=MyPoids($bdd,$produit,$poids_sac,$navire,$destination);
$MyPoids->execute();

$Sains_Recap=sain_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomAvr_DEPART_Recap=avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap->execute();




 $sain=$Sains_Recap->fetch();

  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();

  $sac_sains=$sain['sum(rec.sac_recep)'] -($avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(ra.sac_mouille_ra)'] + $ra['sum(ra.sac_flasque_ra)'];

 $rec=$recond_DEPART_Recap->fetch();
       //$kg=$poids_kg->fetch();
         $poids=$MyPoids->fetch();
       $poids_avaries=$rec['sum(recon.sac_eventres)']*$poids['poids_kg']/1000;
       $perte_sac=$rec['sum(recon.sac_eventres)']-($rec['sum(recon.sac_av_recond)']+$rec['sum(recon.sac_balayure_recond)']);
       $stock_depart_sacs=$cumul_sac-$perte_sac;
       $stock_depart_poids=$stock_depart_sacs*$poids['poids_kg']/1000;
       $total_mouille=$avr['sum(avr.sac_mouille_avr)']+$ra['sum(ra.sac_mouille_ra)'];
       $poids_total_mouille=$total_mouille*$poids['poids_kg']/1000;
       $flasque_restant=$avr['sum(avr.sac_flasque_avr)'] + $ra['sum(ra.sac_flasque_ra)'] - $rec['sum(recon.sac_eventres)']; 
       

     
     
         
  ?>
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

  <td><?php echo number_format($rec['sum(recon.sac_eventres)'],0,',',' '); ?></td>
  <td><?php echo number_format($poids_avaries,3,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(recon.sac_av_recond)'],0,',',' '); ?></td>
  <td><?php echo number_format($rec['sum(recon.poids_av_recond)'],3,',',' '); ?></td>
   <td><?php echo number_format($rec['sum(recon.sac_balayure_recond)'],0,',',' '); ?></td>
   <td><?php echo number_format($rec['sum(recon.poids_balayure_recond)'],3,',',' '); ?></td>
  <td><?php echo number_format($perte_sac,0,',',' '); ?></td>

  </tr>
   
 </tbody>
</table>
</center>
</div>
 <center>
<h6 style="color: black !important; font-weight: bold;"> > Nouveaux stocks après reconditionnement <span style="color: red;"><?php echo number_format($stock_depart_sacs,0,',',' '); ?></span> sacs soit <span style="color: red;"><?php echo number_format($stock_depart_poids,3,',',' ').' T'; ?> </span> total mouilles: <span style="color: red;"> <?php echo number_format($total_mouille,0,',',' '); ?></span> sacs soit <span style="color: red;"> <?php echo number_format($poids_total_mouille,3,',',' '); ?></span> </span> total balayures: <span style="color: red;"> <?php echo number_format($rec['sum(recon.sac_balayure_recond)'],0,',',' '); ?></span> sacs soit <span style="color: red;"> <?php echo number_format($rec['sum(recon.poids_balayure_recond)'],3,',',' '); ?></span> <?php if($flasque_restant!=0){ ?>
FLASQUES RESTANTS:  <span style="color: red;"><?php echo number_format($flasque_restant,0,',',' '); ?></span> sacs 
<?php } ?> </h6><br>



</center>
<br>
<a  style="margin:auto-right; width: 20%;" class="btn-primary hide-on-print" data-role="imprimer_pv_reception">imprimer</a><br>

<?php } ?>

<?php 
function afficher_stock_depart_livraison($bdd,$produit,$poids_sac,$navire,$destination){
   $Total_reception=Total_Reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_avaries_reception=Total_Avaries_de_reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_reception_flasque_deb= Total_Reception_flasque_deb($bdd,$produit,$poids_sac,$navire,$destination);

     $total_reception_mouille_deb= Total_Reception_mouille_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $total_reception_balayure_deb= Total_Reception_balayure_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $recond_transfert=Total_Recond_transfert($bdd,$produit,$poids_sac,$navire,$destination);



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

  $total_sacs_receptionnes=$sac_sains+$total_avaries_receptions['sum(avt.sac_flasque)']+$total_avaries_receptions['sum(avt.sac_mouille)']+$fl_deb['sum(rta.sac)']+$m_deb['sum(rta.sac)']+$bl_deb['sum(rta.sac)'];

  $perte_sur_reconditionnement=$recond_tr['sum(rt.sac_eventres)']-($recond_tr['sum(rt.sac_recond)'] + $recond_tr['sum(rt.sac_balayure)']);
  $sac_stock_depart=$total_sacs_receptionnes-$perte_sur_reconditionnement;
  $poids_stock_depart=$sac_stock_depart*$Total_receptions['poids_sac']/1000;
          
  ?>
   <div class="col col-md-6" style="border: solid; border-color: blue;">
    <h3 style="background: black; text-align: center; color: white !important;">STOCK DEPART</h3>
   <h6 >STOCK DEPART: <span style="color: red;"><?php echo number_format($sac_stock_depart,0,',',' ').' SACS' ?></span> SOIT <span style="color: red;"><?php echo number_format($poids_stock_depart,3,',',' ').' T' ?></span></h6>
  <h6>SAINS: <span style="color: red;"><?php //echo $stock_depart_sacs.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $stock_depart_sacs.' T' ?></span></h6>
     <h6>MOUILLE: <span style="color: red;"><?php //echo $total_mouille.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $poids_total_mouille.' T' ?></span></h6>
       <h6>BALAYURE: <span style="color: red;"><?php //echo $rec['sum(sac_balayure_recond)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $rec['sum(poids_balayure_recond)'].' T' ?></span></h6>
        <h6 style="background: yellow;" >STOCK DEPART: <span style="color: red;"><?php echo number_format($sac_stock_depart,0,',',' ').' SACS' ?></span> SOIT <span style="color: red;"><?php echo number_format($poids_stock_depart,3,',',' ').' T' ?></span></h6>
      </div>
 <?php } } ?>
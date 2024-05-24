<?php 

 function compterecond($bdd,$produit,$poids_sac,$navire,$destination){
     $compterecond=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,  count(recon.id_declaration_recond),ex.id_trans_extends from reconditionnement_reception as recon 
      inner join transit_extends as ex on ex.id_trans_extends=recon.id_declaration_recond

    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

 $compterecond->bindParam(1,$produit);
 $compterecond->bindParam(2,$poids_sac);
 $compterecond->bindParam(3,$navire);
 $compterecond->bindParam(4,$destination);
 $compterecond->execute();

        return $compterecond; 
  } 

  function recond($bdd,$produit,$poids_sac,$navire,$destination){
     $recond=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,  recon.id_declaration_recond,ex.id_trans_extends,recon.* from reconditionnement_reception as recon 
      inner join transit_extends as ex on ex.id_trans_extends=recon.id_declaration_recond

    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

 $recond->bindParam(1,$produit);
        $recond->bindParam(2,$poids_sac);
        $recond->bindParam(3,$navire);
         $recond->bindParam(4,$destination);
        $recond->execute();

        return $recond;
  }

  function SomAvrLigne($bdd,$produit,$poids_sac,$navire,$destination){    
       $SomAvrLigne = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends, sum(avr.sac_flasque_avr) from avaries_de_reception as avr
        inner join transit_extends as ex on ex.id_trans_extends=avr.id_declaration_avr
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

                    WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
          $SomAvrLigne->bindParam(1,$produit);
        $SomAvrLigne->bindParam(2,$poids_sac);
        $SomAvrLigne->bindParam(3,$navire);
         $SomAvrLigne->bindParam(4,$destination); 
         $SomAvrLigne->execute();
           return $SomAvrLigne;
         }


 

         function SomRaLigne($bdd,$produit,$poids_sac,$navire,$destination){
               $SomRaLigne  = $bdd->prepare("SELECT  sum(ra.sac_flasque_ra),sum(ra.sac_mouille_ra),sum(ra.poids_flasque_ra),sum(ra.poids_mouille_ra), dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dis.id_produit,dis.poids_kg,ex.id_trans_extends from reception_avaries as ra
                 inner join transit_extends as ex on ex.id_trans_extends=ra.id_declaration_ra
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

       $SomRaLigne ->bindParam(1,$produit);
        $SomRaLigne ->bindParam(2,$poids_sac);
        $SomRaLigne ->bindParam(3,$navire);
         $SomRaLigne ->bindParam(4,$destination);
        $SomRaLigne->execute();

        return $SomRaLigne  ;
        }
     
     function SomRa($bdd,$produit,$poids_sac,$navire,$destination){
               $SomRa = $bdd->prepare("SELECT  sum(ra.sac_flasque_ra),sum(ra.sac_mouille_ra),sum(ra.poids_flasque_ra),sum(ra.poids_mouille_ra), nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends from reception_avaries as ra
                 inner join transit_extends as ex on ex.id_trans_extends=ra.id_declaration_ra
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

       $SomRa->bindParam(1,$produit);
        $SomRa->bindParam(2,$poids_sac);
        $SomRa->bindParam(3,$navire);
         $SomRa->bindParam(4,$destination);
        //$SomRa->execute();

        return $SomRa ;
        }

         function MyPoids($bdd,$produit,$poids_sac,$navire,$destination){
             $MyPoids = $bdd->prepare("SELECT  dis.poids_kg, nc.id_navire from dispat as dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

               $MyPoids->bindParam(1,$produit);
        $MyPoids->bindParam(2,$poids_sac);
        $MyPoids->bindParam(3,$navire);
         $MyPoids->bindParam(4,$destination);
        //$SomRa->execute();

        return $MyPoids ;
}

     function recondLigne($bdd,$produit,$poids_sac,$navire,$destination){
        $recondLigne = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends, count(recon.sac_av_recond)  from reconditionnement_reception as recon
           inner join transit_extends as ex on ex.id_trans_extends=recon.id_declaration_recond
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

                    WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");

          $recondLigne->bindParam(1,$produit);
        $recondLigne->bindParam(2,$poids_sac);
        $recondLigne->bindParam(3,$navire);
         $recondLigne->bindParam(4,$destination); 
         $recondLigne->execute();
           return $recondLigne;
         }


 /* $SomAvrLigne = $bdd->prepare("SELECT  sum(sac_flasque_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        
        $SomAvrLigne->bindParam(1,$c);
        $SomAvrLigne->execute(); */
   
   function SomAvr($bdd,$produit,$poids_sac,$navire,$destination){
           $SomAvr = $bdd->prepare("SELECT  sum(avr.sac_flasque_avr),nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,ex.id_trans_extends from avaries_de_reception as avr
            inner join transit_extends as ex on ex.id_trans_extends=avr.id_declaration_avr
                 inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");
            $SomAvr->bindParam(1,$produit);
        $SomAvr->bindParam(2,$poids_sac);
        $SomAvr->bindParam(3,$navire);
         $SomAvr->bindParam(4,$destination); 
           return $SomAvr;
         }
	 ?>

	 <?php function afficher_reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination){ ?>
<tbody>
  <?php
  $compterecond=compterecond($bdd,$produit,$poids_sac,$navire,$destination);
   $compte=$compterecond->fetch();

  if($compte['count(recon.id_declaration_recond)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="13">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php  } ?> 
  <?php
       $recond= recond($bdd,$produit,$poids_sac,$navire,$destination);

       $SomRa=SomRa($bdd,$produit,$poids_sac,$navire,$destination);
       $SomAvr=SomAvr($bdd,$produit,$poids_sac,$navire,$destination);
       $MyPoids=MyPoids($bdd,$produit,$poids_sac,$navire,$destination);
       $recondLigne=recondLigne($bdd,$produit,$poids_sac,$navire,$destination);
       $SomAvrLigne=SomAvrLigne($bdd,$produit,$poids_sac,$navire,$destination);
       $SomRaLigne=SomRaLigne($bdd,$produit,$poids_sac,$navire,$destination);
   while($rec=$recond->fetch()){ 

       

  $recond2 = $bdd->prepare("SELECT sum(sac_eventres), sum(poids_eventres), count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_recond<=?
                    ");
        
        
        $recond2 ->bindParam(1,$rec['id_recond']);
        $recond2 ->execute();

     

        $SomRa->execute();
         $SomAvr->execute();


        $MyPoids->execute();




    $avr=$SomAvr->fetch();
$ra=$SomRa->fetch();
$poids=$MyPoids->fetch();
$rec2=$recond2->fetch();

    

$poidsf_avr=$avr['sum(avr.sac_flasque_avr)']*$poids['poids_kg']/1000;
$sacflasque=$avr['sum(avr.sac_flasque_avr)']+$ra['sum(ra.sac_flasque_ra)'];
$poidsflasque=$poidsf_avr+$ra['sum(ra.poids_flasque_ra)'];
$perte=$rec['sac_eventres']-$rec['sac_av_recond']-$rec['sac_balayure_recond'];




//$perte_recul recupere de valeur de l'avant dernier du perte en sac pour l'afficher dans la cellule suivante du flasques receptionnés 
$perte_recul=$sacflasque-$rec2['sum(sac_eventres)'];
$poids_recul=$perte_recul*$poids['poids_kg']/1000;
 
 $date=explode('-', $rec['dates_recond']);
   
  /*  
   $diff=$aff['poids_declarer']-$aff['sum(rec.poids_recep)'];

   $float = $bdd->prepare("SELECT count(bl_recep) from reception

                   WHERE id_dis_recep_bl=? and dates_recep=? and id_recep<=?  ");
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates_recep']);
        $float->bindParam(3,$aff['id_recep']);

        $float->execute();
        $f=$float->fetch(); */
     
    ?>
   
      
     <tr id="tr_data_sain" >

      <td style="width: 5%;" class="colaffiche"> <?php echo $rec2['count(sac_av_recond)'] ?>

<td style="width: 10%;" class="colaffiche" > <?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
<?php if( $recligne=$recondLigne->fetch()){ 
  $avrLigne=$SomAvrLigne->fetch();
$raLigne=$SomRaLigne->fetch();
 $poidsf_avrLigne=$avrLigne['sum(avr.sac_flasque_avr)']*$poids['poids_kg']/1000;

$sacflasqueLigne=$avrLigne['sum(avr.sac_flasque_avr)']+$raLigne['sum(ra.sac_flasque_ra)'];
$poidsflasqueLigne=$sacflasqueLigne*$poids['poids_kg']/1000;

  ?>
<td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(recon.sac_av_recond)'] ?>" > <?php echo number_format($sacflasqueLigne, 0,',',' '); ?> </td>
    <td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(recon.sac_av_recond)'] ?>" ><?php echo number_format($poidsflasqueLigne, 3,',',' '); ?></td>
  
  <?php } ?>
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($rec['sac_eventres'], 0,',',' '); ?></td>
   
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($rec['sac_av_recond'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($rec['poids_av_recond'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['sac_balayure_recond'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($rec['poids_balayure_recond'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>

     <td style="width: 10%;" class="colaffiche" > <?php if($rec2['count(sac_av_recond)']==1){ echo number_format($perte_recul, 0,',',' '); } if($rec2['count(sac_av_recond)']>1){ echo number_format($perte_recul, 0,',',' '); }  ?> </td>
   

   
      


</tr>


  <?php   } ?>




</tbody>

<?php } ?>

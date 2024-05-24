<?php 

 function compterecond($bdd,$produit,$poids_sac,$navire,$destination){
     $compterecond=$bdd->prepare("SELECT nc.id_produit,nc.poids_kg,nc.id_navire,mg.id,  count(recon.declaration_id),d.id_declaration from reconditionnement_reception as recon 
      inner join declaration as d on   d.id_declaration=recon.declaration_id

    inner join dispats as dis on dis.id_dis=d.id_bl
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
    inner join mangasin as mg on mg.id=recon.id_destination

     WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and recon.id_destination=?");

 $compterecond->bindParam(1,$produit);
 $compterecond->bindParam(2,$poids_sac);
 $compterecond->bindParam(3,$navire);
 $compterecond->bindParam(4,$destination);
 $compterecond->execute();

        return $compterecond; 
  } 

  function recond($bdd,$produit,$poids_sac,$navire,$destination){
     $recond=$bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,  recon.declaration_id,d.id_declaration,recon.*,mg.id from reconditionnement_reception as recon 
      inner join declaration as d on d.id_declaration=recon.declaration_id

    inner join dispats as dis on dis.id_dis=d.id_bl
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
    inner join mangasin as mg on mg.id=recon.id_destination
     WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and recon.id_destination=?");

 $recond->bindParam(1,$produit);
        $recond->bindParam(2,$poids_sac);
        $recond->bindParam(3,$navire);
         $recond->bindParam(4,$destination);
        $recond->execute();

        return $recond;
  }

	 ?>

	 <?php function afficher_reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination){ ?>
<tbody>
  <?php
  $compterecond=compterecond($bdd,$produit,$poids_sac,$navire,$destination);
   $compte=$compterecond->fetch();

  if($compte['count(recon.declaration_id)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="13">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php  } ?> 
  <?php
       $recond= recond($bdd,$produit,$poids_sac,$navire,$destination);

   /*    $SomRa=SomRa($bdd,$produit,$poids_sac,$navire,$destination);
       $SomAvr=SomAvr($bdd,$produit,$poids_sac,$navire,$destination);
       $MyPoids=MyPoids($bdd,$produit,$poids_sac,$navire,$destination);
       $recondLigne=recondLigne($bdd,$produit,$poids_sac,$navire,$destination);
       $SomAvrLigne=SomAvrLigne($bdd,$produit,$poids_sac,$navire,$destination);
       $SomRaLigne=SomRaLigne($bdd,$produit,$poids_sac,$navire,$destination); */
   while($rec=$recond->fetch()){ 

       
/*
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

*/


//$perte_recul recupere de valeur de l'avant dernier du perte en sac pour l'afficher dans la cellule suivante du flasques receptionnés 
/*
$perte_recul=$sacflasque-$rec2['sum(sac_eventres)'];
$poids_recul=$perte_recul*$poids['poids_kg']/1000; */
$perte=$rec['sac_eventres']-$rec['sac_recond']-$rec['sac_balayure'];
 
 $date=explode('-', $rec['dates']);
   
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

      <td  class="colaffiche"> <?php //echo $rec2['count(sac_av_recond)'] ?>

<td  class="colaffiche" > <?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>

<td  class="colaffiche"> <?php //echo $date ?>  </td>
    <td  class="colaffiche"  ><?php //echo number_format($poidsflasqueLigne, 3,',',' '); ?></td>
  
  
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($rec['sac_eventres'], 0,',',' '); ?></td>
   
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($rec['sac_recond'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($rec['poids_recond'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['sac_balayure'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($rec['poids_balayure'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php //echo number_format($perte, 0,',',' '); ?></td>

    
   

   
      


</tr>


  <?php   } ?>




</tbody>

<?php } ?>

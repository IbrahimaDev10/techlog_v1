<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="insert_reconditionnement" data-id="<?php echo $afdis['id_dis_recep_bl'] ?>" data-navire_recond="<?php echo $afdis['id_navire_recep'] ?>" data-id_produit_recond="<?php echo $afdis['id_produit_recep'] ?>"  data-poids_sac_recond="<?php echo $afdis['poids_sac_recep'] ?>" data-id_destination_recond="<?php echo $afdis['id_destination_recep'] ?>">AJOUTER RECONDITIONNEMENT  </a>
<br><br>
</div>

 $select=$bdd->prepare("SELECT count(id_dis_recond) from reconditionnement_reception WHERE id_dis_recond=?");
 $select->bindParam(1,$c);
 $select->execute(); 
 $count=$select->fetch();
  if($count['count(id_dis_recond)']<1){























   <div class="container-fluid" class="" id="avaries_receptions" style="display: none;">
      <div class="row">


<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php $avaries_rep=$bdd->prepare("SELECT nav.navire, p.*, avr.*,sum(avr.sac_flasque_avr),sum(avr.sac_mouille_avr), dis.id_dis from avaries_de_reception as avr
inner join dispatching as dis on dis.id_dis=avr.id_dis_avr
inner join produit_deb as p on p.id=dis.id_produit
inner join navire_deb as nav on nav.id=dis.id_navire where id_dis_avr=? group by avr.date_avr, avr.id_avr with rollup ");
$avaries_rep->bindParam(1,$c);
$avaries_rep->execute();
 ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="8"  >STOCK DE DEPART</td>  
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col" colspan="2"  >SAINS</td>
     
     
      <td id="mytd" scope="col" colspan="2"> MOUILLES</td>
      <td id="mytd" scope="col" colspan="2" >BALAYURES</td>
      <td id="mytd" scope="col" colspan="2" >TOTAL</td>
  
     </tr>
     <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
       <td id="mytd" scope="col" > SACS</td>
      <td id="mytd" scope="col"  >POIDS</td>
             <td id="mytd" scope="col" > SACS</td>
      <td id="mytd" scope="col"  >POIDS</td>
           <td id="mytd" scope="col" > SACS</td>
      <td id="mytd" scope="col"  >POIDS</td>
           <td id="mytd" scope="col" > SACS</td>
      <td id="mytd" scope="col"  >POIDS</td>
    </tr>
    
     </thead>

<tbody> 
 <?php while($sain=$Sains->fetch()){ 
    $avr=$SomAvr_DEPART->fetch();
$ra=$SomRa_DEPART->fetch();
$rec=$recond_DEPART->fetch();

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']+$rec['sac_av_recond'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sac_balayure_recond'];
$total_poids=$poidsSain+$poidsMouille+$rec['poids_balayure_recond'];

  ?> 

  <tr style="text-align: center; vertical-align: middle;">
   <td  ><?php echo number_format($SacSain, 0,',',' '); ?></td> 
   <td  ><?php echo number_format($poidsSain, 3,',',' '); ?></td> 
   <td><?php echo number_format($SacMouille, 0,',',' '); ?></td> 
   <td ><?php echo number_format($poidsMouille, 3,',',' '); ?></td>
   <td ><?php echo number_format($rec['sac_balayure_recond'], 0,',',' '); ?></td>
   <td ><?php echo number_format($rec['poids_balayure_recond'], 3,',',' '); ?></td>
  <td ><?php echo number_format($total_sac, 0,',',' '); ?></td>
  <td ><?php echo number_format($total_poids, 3,',',' '); ?></td>
   

  </tr>


<?php  } ?>

 </tbody>
</table>
</div>
</div>
</div>
</div>
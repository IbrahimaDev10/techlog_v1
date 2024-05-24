<?php
require('jointure_requete_reception.php');

function compte_nbre_reception_sain($bdd,$produit, $poids_sac,$navire,$destination){ 
 
  $compterecep=$bdd->prepare("SELECT count(dates) from reception_transfert_sain where id_produit=? and poids_sac=? AND id_navire=? AND id_destination=?");
  $compterecep->bindParam(1,$produit);
  $compterecep->bindParam(2,$poids_sac);
  $compterecep->bindParam(3,$navire);
  $compterecep->bindParam(4,$destination);
  $compterecep->execute();
  return $compterecep;

}

function compte_nbre_reception_avaries($bdd,$produit, $poids_sac,$navire,$destination){

  $comptera=$bdd->prepare("select count(dates) from reception_transfert_des_avaries where id_produit=? and poids_sac=? AND id_navire=? AND id_destination=?");
  $comptera->bindParam(1,$produit);
  $comptera->bindParam(2,$poids_sac);
  $comptera->bindParam(3,$navire);
  $comptera->bindParam(4,$destination);
  $comptera->execute();
  return $comptera;

  }

 
 /*   function afficher_sain($bdd,$produit,$poids_sac,$navire,$destination){ 
 $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, rec.*, sum(rec.sac_recep),sum(rec.poids_recep),sum(rec.manquant_recep),cam.*   FROM reception as rec 
                
                inner join  produit_deb as p on rec.id_produit_recep=p.id 


                inner join navire_deb as nav on rec.id_navire_recep=nav.id 
                
                inner join client as cli on rec.id_client_recep=cli.id
                inner join mangasin as mang on rec.id_destination_recep=mang.id
                
                left join chauffeur as ch on rec.chauffeur_recep=ch.id_chauffeur 
                left join camions as cam on rec.camion_recep=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on rec.id_dec=trs.id_trans

                   WHERE rec.id_produit_recep=? and rec.poids_sac_recep=?and rec.id_navire_recep=? and rec.id_destination_recep=?  group by rec.dates_recep, rec.id_recep with rollup ");
        
        
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
        $affiche->execute();

        return $affiche;
    } */


  /*   function afficher_sain($bdd,$produit,$poids_sac,$navire,$destination){
     
 $affiche = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,dis.id_navire,  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, rec.*, sum(rec.sac_recep),sum(rec.poids_recep),sum(rec.manquant_recep),cam.*   FROM reception as rec 
                inner join dispatching as dis on dis.id_dis=rec.id_dis_recep_bl
                inner join  produit_deb as p on dis.id_produit=p.id 
               

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on rec.chauffeur_recep=ch.id_chauffeur 
                left join camions as cam on rec.camion_recep=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on rec.id_dec=trs.id_trans

                   WHERE dis.id_produit=? and dis.poids_kg=?and dis.id_navire=? and dis.id_mangasin=?  group by rec.dates_recep, rec.id_recep with rollup ");
        
        
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
        $affiche->execute();

        return $affiche;
    }  */
    function nc_dis(){
      return 'inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis'; 
    }


    function afficher_sain($bdd,$produit,$poids_sac,$navire,$destination){
     
 $affiche = $bdd->prepare('SELECT dis.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier, ts.*, sum(ts.sac),sum(ts.poids), ts.id as id_unique,nc.id_navire, dt.* from reception_transfert_sain as ts  
            inner join declaration_transfert as dt on dt.id_declaration_transfert=ts.id_declaration  
            inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
            inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

           left join mangasin as mang on mang.id=ts.id_destination
           left join produit_deb as p on p.id=ts.id_produit
           left join navire_deb as nav on nav.id=ts.id_navire
              

                    WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and ts.id_destination=?  group by ts.dates, id_unique with rollup ');
          
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
        $affiche->execute();

        return $affiche;
    }


    function afficherT_sain($bdd,$produit,$poids_sac,$navire,$destination){

    $afficheT = $bdd->prepare('SELECT nc.*,dis.id_dis, sum(dis.quantite_poids), sum(dis.quantite_sac)from dispat as dis ' . connaissement_dispat() .
     ' where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=?');             
             $afficheT->bindParam(1,$produit);
             $afficheT->bindParam(2,$poids_sac);
             $afficheT->bindParam(3,$navire);
             $afficheT->bindParam(4,$destination);
        $afficheT->execute();
        return $afficheT;

    }



function afficher_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut){
     $afficheAvaries_ra = $bdd->prepare(' SELECT dis.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier, rts.*, sum(rts.sac),sum(rts.poids), rts.id as id_unique,nc.id_navire, dt.* from reception_transfert_des_avaries as rts  
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rts.id_declaration  
            inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
            inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

           left join mangasin as mang on mang.id=rts.id_destination
           left join produit_deb as p on p.id=rts.id_produit
           left join navire_deb as nav on nav.id=rts.id_navire
              

                    WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rts.id_destination=? and statut=?  group by rts.dates, id_unique with rollup ');
        
        
        $afficheAvaries_ra->bindParam(1,$produit);
        $afficheAvaries_ra->bindParam(2,$poids_sac);
        $afficheAvaries_ra->bindParam(3,$navire);
         $afficheAvaries_ra->bindParam(4,$destination);
          $afficheAvaries_ra->bindParam(5,$statut);
        $afficheAvaries_ra->execute();
        return $afficheAvaries_ra;
    }


function afficher_avaries($bdd,$produit,$poids_sac,$navire,$destination){

$avaries_rep=$bdd->prepare("SELECT dis.id_produit /*,dis.poids_kg,dis.id_mangasin */,nc.id_navire,  nav.navire, p.*, avt.*,sum(avt.sac_flasque),sum(avt.sac_mouille),dt.* from avaries_de_transfert as avt
  inner join declaration_transfert as dt  on dt.id_declaration_transfert=avt.declaration_id
inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

inner join produit_deb as p on p.id=dis.id_produit
inner join navire_deb as nav on nav.id=nc.id_navire
inner join mangasin as mg on mg.id=avt.destination_id
 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and avt.destination_id=? group by avt.dates, avt.id with rollup ");
  $avaries_rep->bindParam(1,$produit);
        $avaries_rep->bindParam(2,$poids_sac);
        $avaries_rep->bindParam(3,$navire);
         $avaries_rep->bindParam(4,$destination);
        $avaries_rep->execute();

        return $avaries_rep;
    }


/*function bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination){
    $selectid_dis=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,dis.id_navire, rec.id_dis_recep_bl, rec.id_navire_recep from reception as rec 
    inner join dispatching as dis on dis.id_dis=rec.id_dis_recep_bl
     WHERE dis.id_produit=? and dis.poids_kg=? and dis.id_navire=? and dis.id_mangasin=?");

 $selectid_dis->bindParam(1,$produit);
        $selectid_dis->bindParam(2,$poids_sac);
        $selectid_dis->bindParam(3,$navire);
         $selectid_dis->bindParam(4,$destination);
        $selectid_dis->execute();

        return $selectid_dis;
      } */

      function bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination){
    $selectid_dis=$bdd->prepare("SELECT /*dis.id_mangasin,nc.id_navire,dis.id_produit,dis.poids_kg, */ dt.*,mg.mangasin,mg.id, rts.* from reception_transfert_sain as rts
      inner join declaration_transfert as dt on dt.id_declaration_transfert=rts.id_declaration

  /*  inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis */
    left join mangasin as mg on mg.id=rts.id_destination
     WHERE rts.id_produit=? and rts.poids_sac=? and rts.id_navire=? and rts.id_destination=?");

 $selectid_dis->bindParam(1,$produit);
        $selectid_dis->bindParam(2,$poids_sac);
        $selectid_dis->bindParam(3,$navire);
         $selectid_dis->bindParam(4,$destination);
        $selectid_dis->execute();

        return $selectid_dis;
      }

      function affichage_sain($bdd,$produit,$poids_sac,$navire,$destination){

 ?>
  <?php
  $compterecep=compte_nbre_reception_sain($bdd,$produit,$poids_sac,$navire,$destination);

   $compte=$compterecep->fetch();

  if($compte['count(dates)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="11">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php } ?> 
  <?php
         $affiche=afficher_sain($bdd,$produit,$poids_sac,$navire,$destination);
   while($aff=$affiche->fetch()){ 
    

 
   $date=explode('-', $aff['dates']);
   
  
   //$diff=$aff['poids_declarer']-$aff['sum(rec.poids_recep)'];

/*   $float = $bdd->prepare("SELECT count(bl_recep) from reception

                   WHERE id_produit_recep=? and poids_sac_recep=? and dates_recep=? and id_navire_recep=? and id_recep<=?  ");
        
        $float->bindParam(1,$produit);
        $float->bindParam(2,$poids_sac);
        $float->bindParam(3,$aff['dates_recep']);
         $float->bindParam(4,$navire);
        $float->bindParam(5,$aff['id_recep']);

        $float->execute();
        $f=$float->fetch(); */
     
    ?>
   
      <?php if(empty($aff['id_unique']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle;" >

      <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
       <td id="mytd"  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
   
  
     
  
   
    <td id="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(ts.sac)'], 0,',',' ') ?></td>
  
    <td id="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(ts.poids)'], 3,',',' '); ?></td>
    
<td  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
<td  class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_unique']) and !empty($aff['dates'])) {
        ?>
     <tr id="tr_data_sain" >

<td  class="colaffiche" ><?php //echo  $f['count(bl_recep)'] ?>  </td>
    <td id="<?php echo $aff['id_unique'].'date' ?>" class="colaffiche" ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?> </td>
 <?php  $heure=explode(':', $aff['heure']);  ?>
 <td class="colaffiche"    id="<?php echo $aff['id_unique'].'heure' ?>" ><?php echo $heure[0].':'.$heure[1]; ?></td>
   
    <td  class="colaffiche"   id="<?php echo $aff['id_unique'].'bl' ?>" ><?php //echo $aff['bl_recep'] ?></td>
    <td class="colaffiche" ><?php echo $aff['camion'] ?></td>
    <td  class="colaffiche"><?php echo $aff['chauffeur'] ?></td>
    <td  class="colaffiche"><?php echo $aff['num_dec_transfert']; ?></td>

    
    <td id="<?php echo $aff['id_unique'].'sac' ?>" class="colaffiche"><?php echo number_format($aff['sac'], 0,',',' '); ?></td>


    <td id="mytd" class="colaffiche"><?php echo number_format($aff['poids'], 3,',',' '); ?></td>

   <td id="<?php echo $aff['id_unique'].'manquant' ?>" class="colaffiche"><?php echo number_format($aff['manquant'], 0,',',' '); ?></td>
     
     <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_unique'].'poids_sac' ?>" ><?php echo $aff['poids_sac']; ?></span>
      <span style="" class="colaffiche" id="<?php echo $aff['id_unique'].'id_destination' ?>" ><?php echo $aff['id_mangasin']; ?></span>
       <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_unique'].'id_produit' ?>" ><?php echo $aff['id_produit']; ?></span>
        <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_unique'].'id_navire' ?>" ><?php echo $aff['id_navire']; ?></span>
      <span style="display: none;" class="colaffiche" id="<?php //echo $aff['id_recep'].'id_dis_up' ?>" ><?php //echo $aff['id_dis_recep_bl']; ?></span>

      

<form>  
 <td  style="vertical-align: middle; text-align: center; " >

 <div style="display: flex; justify-content: center;">   

 <a  class="fabtn" name="modify"  data-role="update_receptionaff"  data-id="<?php echo $aff['id_unique']; ?>"   > <i class="fa fa-edit " ></i></a>

 <a  class="fabtn" target="blank" name="modify"  href="fichier_reception.php?id=<?php echo $aff['id_unique']; ?>" > <i class="fa fa-folder "  ></i></a>
 <a class="fabtn"  id="<?php echo $aff['id'] ?>"    onclick="deletereceptionaff(<?php echo $aff['id_unique'] ?>)" > <i class="fa fa-trash  " ></i> </a>
 </div>

  
</td>
</form>
</tr>

 
  <?php } ?>

  <?php  if(empty($aff['id_unique']) and empty($aff['dates'])) {
    // $afficheT=afficherT_sain($bdd,$produit,$poids_sac,$navire,$destination); 
     //$affT=$afficheT->fetch();
    //$rob_sacT=$affT['sum(dis.quantite_sac)']-$aff['sum(rec.sac_recep)'];
     //$rob_poidsT=$affT['sum(dis.quantite_poids)']-$aff['sum(rec.poids_recep)']; ?>

  
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <span  id="<?php //echo $affT['id_dis'].'iddiss'; ?>"><?php //echo $affT['id_dis'] ?>
  <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS RECEPTIONNES = <span style="color:red;"> <?php //echo number_format($aff['sum(rec.sac_recep)'], 0,',',' '); ?></span>  </td>
  <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;" >  </td>
  

  <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS RECEPTIONNES = <span style="color:red;"><?php //echo number_format($aff['sum(rec.poids_recep)'], 3,',',' '); ?></span></td> 
   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> </td>

   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php //echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
    <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;" >  </td>
   

   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php //echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> </td>
    <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php //echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> </td>
   <td id="mytd" class=""  style="background: black; color: white; font-weight: bold; text-align: center;"> </td>
  
   </tr> 
<?php } 
 
?> 

  

  
 
 

  <?php   } 
//LA FIN DE FERMETURE DU FONCTION
}

function affichage_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut){
      
    $comptera=compte_nbre_reception_avaries($bdd,$produit, $poids_sac,$navire,$destination);
	 $compte=$comptera->fetch();

  if($compte['count(dates)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="12">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php } ?>

 <?php
      $afficheAvaries_ra = afficher_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut);
  while($a=$afficheAvaries_ra->fetch()){ 
   $date=explode('-', $a['dates']);
   
   /* $float = $bdd->prepare("SELECT count(bl_ra) from reception_avaries

                     WHERE id_produit_ra=? and poids_sac_ra=? and date_ra=? and id_ra<=? ");
        
        $float->bindParam(1,$produit);
        $float->bindParam(2,$poids_sac);
        $float->bindParam(3,$a['date_ra']);
        $float->bindParam(4,$a['id_ra']);

        $float->execute();
        $f=$float->fetch(); */
  
   //$diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
     
    ?>
    <tr style="text-align: center; font-weight: bold; " >
      <?php if(empty($a['id_unique']) and !empty($a['dates'])) {?>
      <td colspan="7" class="colaffnull" style="background:rgb(82,82,226); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   

    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(rts.sac)'], 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(rts.poids)'], 3,',',' '); ?></td>
    
     <td  style="background:rgb(82,82,226); color: white;"></td>
    
    


   
   <?php }



   else if(!empty($a['id_unique']) and !empty($a['dates'])) {?>
<tr id="tr_data_attente_avdeb" style="text-align: center;">

   <td   ><?php //echo  $f['count(bl_ra)'] ?></td>
    <td id="<?php echo $a['id_unique'].'date_deb' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
    <?php  $heure=explode(':', $a['heure']);  ?>
 <td class="colaffiche"    id="<?php echo $a['id_unique'].'heures' ?>" ><?php echo $heure[0].':'.$heure[1]; ?></td>
   
    
    <td id="<?php echo $a['id_unique'].'bl_deb' ?>" ><?php //echo $a['bl_ra'] ?></td>
    <td ><?php echo $a['camion'] ?></td>
    <td ><?php echo $a['chauffeur'] ?></td>
    <td ><?php echo $a['num_dec_transfert'] ?></td>
<span style="display: none;" id="<?php echo $a['id_unique'].'id_dis_deb' ?>" ><?php //echo $a['id_dis_bl_ra'] ?></span>
<span style="display: none;" id="<?php echo $a['id_unique'].'poids_sac_deb' ?>" ><?php echo $a['poids_sac'] ?></span>
<span style="display: none;" id="<?php echo $a['id_unique'].'id_produit_deb' ?>" ><?php echo $a['id_produit'] ?></span>
<span style="display: none;" id="<?php echo $a['id_unique'].'id_destination_deb' ?>" ><?php echo $a['id_destination'] ?></span>
<span style="display: none;" id="<?php echo $a['id_unique'].'id_navire_deb' ?>" ><?php echo $a['id_navire'] ?></span>

    <td id="<?php echo $a['id_unique'].'flasque_deb' ?>" ><?php echo number_format($a['sac'], 0,',',' '); ?></td>
    <td id="<?php echo $a['id_unique'].'poids_flasque_deb' ?>" ><?php echo $a['poids'] ?></td>

      <td  ><a style="color: #1B2B65;"  data-role="update_recep_deb" data-id="<?php echo $a['id_unique']; ?>" ><i class="fas fa-edit">  </i></a>
         <a style="color: #1B2B65;" target="blank" name="modify"  href="fichier_reception_avaries.php?id=<?php echo $a['id_unique']; ?>" > <i class="fa fa-folder "  ></i></a>
        <button style="color: #1B2B65;" class="fabtn1"  id="<?php echo $a['id_unique'] ?>" name="delete" type="submit"   onclick="delete_avaries_deb(<?php echo $a['id_unique']; ?>)" > <i class="fa fa-trash  " ></i> </button></td>
       </tr>

  
  <?php } ?>

  <?php   if(empty($a['id_unique']) and empty($a['dates'])) { /*
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)'];*/ ?>
<tr style="font-weight: bold;">
  <td colspan="7" class="" style="background: black; color: white; font-weight: bold; text-align: center;" > TOTAL </td>
  <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($a['sum(rts.sac)'], 0,',',' '); ?> </td>
  <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($a['sum(rts.poids)'], 3,',',' '); ?> </td>
  <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php //echo number_format($a['sum(pre.sac_mouille_ra)'], 0,',',' '); ?> </td>
 
  </tr>
  
 

  <?php  }  

}
// FERMETURE FONCTION
}


function affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination){


    $avaries_rep=afficher_avaries($bdd,$produit,$poids_sac,$navire,$destination);

 while($av=$avaries_rep->fetch()){ 
if(!empty($av['id']) and !empty($av['dates'])){
  //$d1=explode('-',$av['date_avr']);
 //$d=$d1[2].'-'.$d1[1].'-'.$d1[0];
  $total_avaries=$av['sac_flasque']+$av['sac_mouille'];
  $d=date("d-m-Y",strtotime($av['dates']));

  ?> 

  <tr style="text-align: center; vertical-align: middle;">
   <td id=<?php echo $av['id'].'date_avr' ?> ><?php echo $d; ?></td> 

   <td id=<?php echo $av['id'].'sac_flasque_avr' ?> ><?php echo $av['sac_flasque'] ?></td>
   <td id=<?php echo $av['id'].'sac_mouille_avr' ?> ><?php echo $av['sac_mouille'] ?></td>
   <td  ><?php echo $total_avaries; ?></td>
   <span style="display: none;" id=<?php echo $av['id'].'id_dis_avr' ?> > <?php //echo $av['id_dis_avr'] ?> </span> 
    <span style="display: none;" id=<?php echo $av['id'].'poids_sac_avr' ?> > <?php echo $av['poids_kg'] ?> </span> 
     <span style="display: none;" id=<?php echo $av['id'].'id_produit_avr' ?> > <?php echo $av['id_produit'] ?> </span>
      <span style="display: none;" id=<?php echo $av['id'].'id_destination_avr' ?> > <?php echo $av['destination_id'] ?> </span>
   <span style="display: none;" id=<?php echo $av['id'].'id_navire_avr' ?> > <?php echo $av['id_navire'] ?> </span>  
   <td> 
 <a class="fabtn"   name="modify"  data-role="update_avr_reception"  data-id="<?php echo $av['id']; ?>"  id="btnbtn" > <i class="fa fa-edit " ></i></a>
<a   id="<?php echo $av['id'] ?>" name="delete"   class="fabtn1 " onclick="delete_avaries_rep(<?php echo $av['id'] ?>)" > <i class="fa fa-trash  " ></i> </a></td>

  </tr>
<?php } ?>

<?php if(empty($av['id']) and !empty($av['dates'])){ 

$sous_total_avaries=$av['sum(avt.sac_flasque)']+$av['sum(avt.sac_mouille)'];
  ?>
  <tr style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); color:white; text-align: center; vertical-align: middle;">
  <td ><?php echo $av['dates'] ?></td>
     <td><?php echo $av['sum(avt.sac_flasque)'] ?></td>
   <td><?php echo $av['sum(avt.sac_mouille)'] ?></td> 
   <td><?php echo $sous_total_avaries ?></td> 
   <td></td>
   </tr>

<?php } ?>

<?php if(empty($av['id']) and empty($av['dates'])){ 

$sum_total_avaries=$av['sum(avt.sac_flasque)']+$av['sum(avt.sac_mouille)'];
  ?>
  <tr style="background: black; color:white;  text-align: center; vertical-align: middle;">
  <td style="color:white;" >TOTAL</td>
     <td style="color:white;"><?php echo $av['sum(avt.sac_flasque)'] ?></td>
   <td style="color:white;"><?php echo $av['sum(avt.sac_mouille)'] ?></td> 
   <td style="color:white;"><?php echo $sum_total_avaries; ?></td> 
   <td style="color:white;"></td>
   </tr>

<?php } } 
  //FERMETURE FONCTION
}

?>




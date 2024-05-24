  <?php  
  function  filtreur_par_date($bdd,$produit,$poids_sac,$navire,$destination,$statut){
     $filtre_date = $bdd->prepare("SELECT manif.dates from transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=?  group by manif.dates ");
        
        
        
      $filtre_date->bindParam(1,$produit);
        $filtre_date->bindParam(2,$poids_sac);
        $filtre_date->bindParam(3,$navire);
        $filtre_date->bindParam(4,$destination);
        $filtre_date->bindParam(5,$statut);
        $filtre_date->execute();
        return $filtre_date;
      }

       function  filtreur_par_date_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
     $filtre_date = $bdd->prepare("SELECT manif.dates from transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?  group by manif.dates ");
        
        
        
      $filtre_date->bindParam(1,$produit);
        $filtre_date->bindParam(2,$poids_sac);
        $filtre_date->bindParam(3,$navire);
        $filtre_date->bindParam(4,$destination);
        $filtre_date->bindParam(5,$statut);
         $filtre_date->bindParam(6,$client);
        $filtre_date->execute();
        return $filtre_date;
      }

      function  filtreur_par_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut){
     $filtre_cale = $bdd->prepare("SELECT dc.cales,dc.id_dec  from transfert_debarquement as manif 
             inner join declaration_chargement as dc on dc.id_dec=manif.cale
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=?   group by  manif.cale ");
        
        
        
      $filtre_cale->bindParam(1,$produit);
        $filtre_cale->bindParam(2,$poids_sac);
        $filtre_cale->bindParam(3,$navire);
        $filtre_cale->bindParam(4,$destination);
        $filtre_cale->bindParam(5,$statut);
        $filtre_cale->execute();
        return $filtre_cale;
      }

           function  filtreur_par_cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
     $filtre_cale = $bdd->prepare("SELECT dc.cales,dc.id_dec  from transfert_debarquement as manif 
             inner join declaration_chargement as dc on dc.id_dec=manif.cale
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?   group by  manif.cale ");
        
        
        
      $filtre_cale->bindParam(1,$produit);
        $filtre_cale->bindParam(2,$poids_sac);
        $filtre_cale->bindParam(3,$navire);
        $filtre_cale->bindParam(4,$destination);
        $filtre_cale->bindParam(5,$statut);
        $filtre_cale->bindParam(6,$client);
        $filtre_cale->execute();
        return $filtre_cale;
      }

      function  afficher_filtre_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut,$cale){
     $par_cale = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),cam.*,nc.*,dch.cales,dch.id_dec,rem.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                
            

               

                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and manif.cale=?  group by manif.cale, manif.id_register_manif with rollup ");
        
        
        
        $par_cale->bindParam(1,$produit);
        $par_cale->bindParam(2,$poids_sac);
        $par_cale->bindParam(3,$navire);
        $par_cale->bindParam(4,$destination);
        $par_cale->bindParam(5,$statut);
        $par_cale->bindParam(6,$cale);
        $par_cale->execute();
        return $par_cale;
      }



      function  filtreur_par_destinataire($bdd,$produit,$poids_sac,$navire,$destination,$statut){
     $filtre_destinataire = $bdd->prepare("SELECT manif.destinataire from transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=?  group by manif.destinataire ");
        
        
        
      $filtre_destinataire->bindParam(1,$produit);
        $filtre_destinataire->bindParam(2,$poids_sac);
        $filtre_destinataire->bindParam(3,$navire);
        $filtre_destinataire->bindParam(4,$destination);
        $filtre_destinataire->bindParam(5,$statut);
        $filtre_destinataire->execute();
        return $filtre_destinataire;
      }

      function  filtreur_par_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut){
     $filtre_declaration = $bdd->prepare("SELECT d.num_declaration,d.id_declaration from transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=?  group by d.id_declaration ");
        
        
        
      $filtre_declaration->bindParam(1,$produit);
        $filtre_declaration->bindParam(2,$poids_sac);
       $filtre_declaration->bindParam(3,$navire);
        $filtre_declaration->bindParam(4,$destination);
        $filtre_declaration->bindParam(5,$statut);
        $filtre_declaration->execute();
        return $filtre_declaration;
      }

      
         function  filtreur_par_declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
     $filtre_declaration = $bdd->prepare("SELECT d.num_declaration,d.id_declaration from transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
            

               

                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?  group by d.id_declaration  ");
        
        
        
      $filtre_declaration->bindParam(1,$produit);
        $filtre_declaration->bindParam(2,$poids_sac);
       $filtre_declaration->bindParam(3,$navire);
        $filtre_declaration->bindParam(4,$destination);
        $filtre_declaration->bindParam(5,$statut);
         $filtre_declaration->bindParam(6,$client);
        $filtre_declaration->execute();
        return $filtre_declaration;
      }





      function  afficher_filtre_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$date){
     $par_date = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),cam.*,nc.*,dch.cales,dch.id_dec,rem.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and manif.dates=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $par_date->bindParam(1,$produit);
        $par_date->bindParam(2,$poids_sac);
        $par_date->bindParam(3,$navire);
        $par_date->bindParam(4,$destination);
        $par_date->bindParam(5,$statut);
        $par_date->bindParam(6,$date);
        $par_date->execute();
        return $par_date;
      }


  function  afficher_filtre_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut,$declaration){
     $par_declaration = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),cam.*,nc.*,dch.cales,dch.id_dec,rem.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and manif.id_declaration=?  group by manif.id_declaration, manif.id_register_manif  with rollup ");
        
        
        
       $par_declaration->bindParam(1,$produit);
        $par_declaration->bindParam(2,$poids_sac);
        $par_declaration->bindParam(3,$navire);
        $par_declaration->bindParam(4,$destination);
        $par_declaration->bindParam(5,$statut);
        $par_declaration->bindParam(6,$declaration);
        $par_declaration->execute();
        return $par_declaration;
      }



      ?> 







   <?php  
 function affichage_filtre_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$date){

 ?>

  <?php $par_date=afficher_filtre_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$date);
   while($aff=$par_date->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

$rotation=$bdd->prepare("SELECT count(bl) from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and statut=? and dates=?  and id_register_manif<=?");

   $rotation->bindParam(1,$produit);
   $rotation->bindParam(2,$poids_sac);
   $rotation->bindParam(3,$destination);
   $rotation->bindParam(4,$navire);
   $rotation->bindParam(5,$statut);
   $rotation->bindParam(6,$aff['dates']);
   $rotation->bindParam(7,$aff['id_register_manif']);
   $rotation->execute();

   $rot=$rotation->fetch();

  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php echo  $rot['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_cale_rm' ?>"><?php echo $aff['id_dec'] ?></span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['la_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_kg'] ?></span>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php echo $aff['id_produit'] ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'statut_rm' ?>"><?php echo $aff['statut'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
 ?>
  <td <?php if($aff['etat_reception']=='non'){  ?> style="color: red;" <?php } ?> <?php if($aff['etat_reception']=='oui'){  ?> style="color: green;" <?php } ?>  > <div style="" id='etat_recep'><?php if($aff['etat_reception']=='non'){ echo "NON RECEPTIONNE"; } if($aff['etat_reception']=='oui'){ echo "RECEPTIONNE";}  ?> <?php //echo $aff_tdeb['sum(manif.sac)']; ?> </div> </td>



<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_register'  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn" target="blank" href="fichier_debarquement_sain.php?id=<?php echo $aff['id_register_manif'] ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>
 



 <?php  
 function affichage_filtre_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut,$declaration){

 ?>

  <?php $par_declaration=afficher_filtre_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut,$declaration);
   while($aff=$par_declaration->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

$rotation=$bdd->prepare("SELECT count(bl) from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and statut=? and dates=?  and id_register_manif<=?");

   $rotation->bindParam(1,$produit);
   $rotation->bindParam(2,$poids_sac);
   $rotation->bindParam(3,$destination);
   $rotation->bindParam(4,$navire);
   $rotation->bindParam(5,$statut);
   $rotation->bindParam(6,$aff['dates']);
   $rotation->bindParam(7,$aff['id_register_manif']);
   $rotation->execute();

   $rot=$rotation->fetch();

  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['id_declaration'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  </td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['id_declaration'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php echo  $rot['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_cale_rm' ?>"><?php echo $aff['id_dec'] ?></span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['la_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_kg'] ?></span>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php echo $aff['id_produit'] ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'statut_rm' ?>"><?php echo $aff['statut'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
 ?>
  <td  style="color: green;"> <div style="background:black;" id='etat_recep'><?php if($aff['etat_reception']=='non'){ echo "NON RECEPTIONNE"; } if($aff['etat_reception']=='oui'){ echo "RECEPTIONNE";}  ?> </div> </td>



<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_register'  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn" target="blank" href="fichier_debarquement_sain.php?id=<?php echo $aff['id_register_manif'] ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['id_declaration'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>


 <?php  
 function affichage_filtre_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut,$cale){

 ?>

  <?php $par_cale=afficher_filtre_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut,$cale);
   while($aff=$par_cale->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

$rotation=$bdd->prepare("SELECT count(bl) from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and statut=? and dates=?  and id_register_manif<=?");

   $rotation->bindParam(1,$produit);
   $rotation->bindParam(2,$poids_sac);
   $rotation->bindParam(3,$destination);
   $rotation->bindParam(4,$navire);
   $rotation->bindParam(5,$statut);
   $rotation->bindParam(6,$aff['dates']);
   $rotation->bindParam(7,$aff['id_register_manif']);
   $rotation->execute();

   $rot=$rotation->fetch();

  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['cale'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  </td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['cale'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php echo  $rot['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_cale_rm' ?>"><?php echo $aff['id_dec'] ?></span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['la_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_kg'] ?></span>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php echo $aff['id_produit'] ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'statut_rm' ?>"><?php echo $aff['statut'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
 ?>
  <td  style="color: green;"> <div style="background:black;" id='etat_recep'><?php if($aff['etat_reception']=='non'){ echo "NON RECEPTIONNE"; } if($aff['etat_reception']=='oui'){ echo "RECEPTIONNE";}  ?> </div> </td>



<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_register'  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn" target="blank" href="fichier_debarquement_sain.php?id=<?php echo $aff['id_register_manif'] ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['cale'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>
  
   

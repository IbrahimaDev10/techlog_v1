<?php    


    
    $a=$_SESSION['id'];


/*  function camions_en_attentes_sains($bdd,$a){

$select=$bdd->prepare("select pre.*,rm.*,cam.*,ch.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            inner join camions as cam on cam.id_camions=rm.camions
            inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join mangasin as mang on mang.id=rm.id_destination
            inner join produit_deb as p on p.id=rm.id_produit
            inner join navire_deb as nav on nav.id=rm.id_navire

            where mang.id_mangasinier=?");
            $select->bindParam(1,$a);
             $select->execute();
             return $select;
               
             }  */

             function camions_en_attentes_sains($bdd,$a){

$select=$bdd->prepare("select cam.*,ch.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier, ts.* from transfert_sain as ts  
           
           left join camions as cam on cam.id_camions=ts.camion_trsain
           left join chauffeur as ch on ch.id_chauffeur=ts.chauffeur_trsain
           left join mangasin as mang on mang.id=ts.id_destination
           left join produit_deb as p on p.id=ts.id_produit
           left join navire_deb as nav on nav.id=ts.id_navire

            where mang.id_mangasinier=? and ts.etat_reception='non' ");
            $select->bindParam(1,$a);
             $select->execute();
             return $select;
               
             } 

             function camions_en_attentes_avaries($bdd,$a){

               $afficheAvaries = $bdd->prepare("SELECT trav.*, trav.id as id_unique, cam.*,ch.*, nav.navire, p.*, mg.id_mangasinier from transfert_des_avaries as trav  
                inner join camions as cam on cam.id_camions=trav.id_camion 
                inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur
                inner join navire_deb as nav on nav.id=trav.id_navire
                inner join produit_deb as p on p.id=trav.id_produit
               inner join mangasin as mg on mg.id=trav.id_destination where mg.id_mangasinier=? AND trav.etat_reception='non' ");
                $afficheAvaries->bindParam(1,$a);
             $afficheAvaries->execute();
                return $afficheAvaries;
        

      }

 /*       function choix_du_navire($bdd,$a){
$naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
              $naviress->bindParam(1,$a);
              $naviress->execute();
              return $naviress;

    } */

      function choix_du_navire($bdd,$a){
        $naviress=$bdd->prepare("SELECT dis.id_dis, tr.id_transfert,dt.id_transfertD, mg.mangasin,nav.navire,nc.num_connaissement, nc.id_navire from dispat_transfert as dt 
                 LEFT JOIN dispat as dis on dt.id_dis_transfertD=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 INNER join mangasin as mg on mg.id=dt.id_nouvelle_destinationD
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 
                 
                 LEFT join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=?  group by nav.id");
              $naviress->bindParam(1,$a);
              $naviress->execute();
              return $naviress;

    }


    
  

         function camions_en_attentes_sains2($bdd){

      $select=$bdd->query("select pre.*,rm.*,cam.*,ch.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            inner join camions as cam on cam.id_camions=rm.camions
            inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join mangasin as mang on mang.id=rm.id_destination
            inner join produit_deb as p on p.id=rm.id_produit
            inner join navire_deb as nav on nav.id=rm.id_navire");
       return $select;
    }

        function camions_en_attentes_avaries2($bdd){
               $afficheAvaries = $bdd->query("select pre.*,trav.*,cam.*,ch.*, nav.navire, p.*, mg.id_mangasinier from pre_reception_avaries as pre inner join transfert_avaries as trav on pre.id_pre_tr_av=trav.id_tr_avaries inner join camions as cam on cam.id_camions=trav.id_cam inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr
                inner join navire_deb as nav on nav.id=trav.id_navire
                inner join produit_deb as p on p.id=trav.id_produit
               inner join mangasin as mg on mg.id=id_destination_tr  ");
               return $afficheAvaries;
             }
        
        


         function choix_du_navire2($bdd){
$naviress=$bdd->query("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                
                 group by nav.navire");
   return $naviress;
           
           }

   /*        function sain_reception($bdd,$c){
          $Sains_Recap = $bdd->prepare("SELECT poids_sac_recep, sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains_Recap->bindParam(1,$c);
        $Sains_Recap->execute();
        return $Sains_Recap;
      }  */

      

  /*  function reconditionnement_reception($bdd,$c){
      $recond_DEPART_Recap = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_eventres), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");

        $recond_DEPART_Recap ->bindParam(1,$c);
        $recond_DEPART_Recap ->execute();
        return $recond_DEPART_Recap;
      }  */

      
      
          

     
      function find_poids_kg($bdd,$c){
        $poids_kg=$bdd->prepare("SELECT poids_kg from dispatching where id_dis=?");
        $poids_kg->bindParam(1,$c);
        $poids_kg->execute();
        return $poids_kg;
      }
      function afficher_intervenant($bdd,$c){
                     $intervenant=$bdd->prepare("SELECT inter.*,intprod.* from intervenant as inter inner join intervenant_produit as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_dis_inter_prod=?");
                     $intervenant->bindParam(1,$c);
                   $intervenant->execute();
             return $intervenant;
      }

      function titre_entete_pv($bdd,$produit,$poids_sac,$navire,$destination){
        $titre=$bdd->prepare("SELECT dis.id_dis, dis.poids_kg, p.*,mg.mangasin, nav.navire,nav.type,cli.client,ex.id_trans_extends,nc.id_navire from dispat as dis
         inner join transit_extends as ex on ex.id_bl_extends=dis.id_dis
  inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
  inner join client as cli on cli.id=dis.id_client
  inner join navire_deb as nav on nav.id=nc.id_navire
  inner join produit_deb as p on p.id=dis.id_produit
  inner join mangasin as mg on mg.id=dis.id_mangasin
   WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by dis.id_dis ");
$titre->bindParam(1,$produit);
$titre->bindParam(2,$poids_sac);
 $titre->bindParam(3,$navire);
 $titre->bindParam(4,$destination);
 $titre->execute();

  return $titre;
 
      }



function afficher_camions_en_attentes_sain($bdd){

  ?>
  <?php

  $a=$_SESSION['id'];
  if($_SESSION['profil']=="Mangasinier"){
  $select=camions_en_attentes_sains($bdd,$a);
  }
  else{
    $select=camions_en_attentes_sains2($bdd);

  }
 

   while($aff=$select->fetch()){ ?>
<tr class="tr_data_attente_sain" border="2" >
  <td id="<?php echo $aff['id_trsain'].'date' ?>" ><?php echo $aff['date_trsain']; ?></td>
  <td id="<?php echo $aff['id_trsain'].'nav' ?>" ><?php echo $aff['navire']; ?></td>
  <td id="<?php echo $aff['id_trsain'].'prod' ?>" class="produit_sain"><?php echo $aff['produit']; ?> <?php echo $aff['qualite']; ?> <span style="color: red;"> <?php //echo $aff['poids_sac'].'KGS'; ?></span></td>
    
     <td class="bl_sain" id="<?php echo $aff['id_trsain'].'bl' ?>" class="colcel"><?php //echo $aff['bl']; ?></td>
      <td id="<?php echo $aff['id_trsain'].'camion' ?>" class="colcel"><?php echo $aff['num_camions']; ?></td>
       <td class="chauffeur_sain" id="<?php echo $aff['id_trsain'].'chauffeur' ?>" class="colcel"><?php echo $aff['nom_chauffeur']; ?></td>
      <td id="<?php echo $aff['id_trsain'].'sac' ?>" class="colcel"><?php echo $aff['sac_trsain']; ?></td>
       <td id="<?php echo $aff['id_trsain'].'poids' ?>" class="colcel"><?php echo $aff['poids_trsain']; ?></td>
       <span style="display: none;" id="<?php echo $aff['id_trsain'].'poids_sac'   ?>"> <?php echo $aff['poids_sac']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_trsain'].'getid'   ?>"> <?php echo $_SESSION['id'];   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_produit'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_dis_bl'   ?>"> <?php //echo $aff['id_dis_bl']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_declaration'   ?>"> <?php echo $aff['dec_trsain']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_destination'   ?>"> <?php echo $aff['id_destination']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_client'   ?>"> <?php //echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_navire'   ?>"> <?php echo $aff['id_navire']   ?></span>


        <td class="colcel">
          <a class="btnbtn" data-role="insert_reception" data-id="<?php echo $aff['id_trsain']; ?>" ><i class="fa fa-edit "></i></a>
          </td>

        </tr>
        <?php } 
            }

             // FERMETURE FONCTION
       function afficher_camions_en_attentes_avaries($bdd){     
        ?>
        <?php
   
  
    $a=$_SESSION['id'];
    if($_SESSION['profil']=="Mangasinier"){
  $afficheAvaries=camions_en_attentes_avaries($bdd,$a);
}
else {
  $afficheAvaries=camions_en_attentes_avaries2($bdd);
}


 while($aff=$afficheAvaries->fetch()){ 
  if(!empty($aff['id'])){
  ?>
  
  <tr class="tr_data_attente_avaries" >
  <td id="<?php echo $aff['id_unique'].'date_ra' ?>" class="colcel"><?php echo $aff['dates'] ?></td>  
  <td  ><?php echo $aff['navire'] ?></td> 
  <td class="produit_hide"><?php echo $aff['produit']; ?> <?php echo $aff['qualite']; ?> <span style="color: red;"> <?php //echo $aff['poids_sac_tr_av'].'KGS'; ?></span></td> 
   <td class="bl_hide" id="<?php echo $aff['id_unique'].'bl_ra' ?>"><?php //echo $aff['bl_tr'] ?></td>
  <td class="camion_hide" id="<?php echo $aff['id_unique'].'camion_ra' ?>"><?php echo $aff['num_camions'] ?></td> 
  <td class="chauffeur_hide" id="<?php echo $aff['id_unique'].'chauffeur_ra' ?>" ><?php echo $aff['nom_chauffeur'] ?></td> 
  <td id="<?php echo $aff['id_unique'].'sac_flasque_ra' ?>" ><?php echo $aff['sac'] ?></td>
  <td id="<?php echo $aff['id_unique'].'poids_flasque_ra' ?>" ><?php echo $aff['poids'] ?></td> 
  <td id="<?php echo $aff['id_unique'].'statut_ra' ?>" <?php if($aff['statut']=='mouille'){ echo "style='color:green;'"; } ?>
  <?php if($aff['statut']=='flasque'){ echo "style='color:red;'"; } ?> <?php if($aff['statut']=='balayure'){ echo "style='color:blue;'"; } ?> <?php if($aff['statut']=='sain'){ echo "style='color:black;'"; } ?> ><?php echo $aff['statut'] ?></td>
  
   <span style="display: none;" id="<?php //echo $aff['id_pre_ra'].'getid_avaries'   ?>"> <?php //echo $_GET['id'];   ?></span>
  <span style="display: none;" id="<?php echo $aff['id_unique'].'poids_sac_ra'   ?>"> <?php echo $aff['poids_sac']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_unique'].'id_produit_ra'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php //echo $aff['id_pre_ra'].'id_dis_bl_ra'   ?>"> <?php //echo $aff['id_dis_bl_tr']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_unique'].'id_declaration_ra'   ?>"> <?php echo $aff['id_declaration']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_unique'].'id_destination_ra'  ?>"> <?php echo $aff['id_destination']   ?></span>
           <span style="display: none;" id="<?php //echo $aff['id_pre_ra'].'id_client_ra'?>"> <?php //echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_unique'].'id_navire_ra'?>"> <?php echo $aff['id_navire']   ?></span> 
  
 
  <td style="display: flex; justify-content: center;">
          <a class="btnbtn"  data-role="update_reception_avaries" data-id="<?php echo $aff['id_unique']; ?>" ><i class="fa fa-edit "></i></a>
          <a class="btn_detail"  data-bs-toggle="modal" data-bs-target="#<?php echo $aff['id_unique'].'details_bl' ?>" data-id="<?php echo $aff['id_unique']; ?>" ><i class="fa fa-eye "></i></a>
          </td> 

  

  </tr>
  <?php } ?>
<?php } 

 } ?>


   

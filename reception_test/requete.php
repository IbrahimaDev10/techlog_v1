<?php 

/* $recond = $bdd->prepare("SELECT *  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond ->bindParam(1,$c);
        $recond ->execute(); */
  
     /*   $recondLigne = $bdd->prepare("SELECT  count(sac_av_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recondLigne ->bindParam(1,$c);
        $recondLigne ->execute(); */

         

 /* $SomAvrLigne = $bdd->prepare("SELECT  sum(sac_flasque_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        
        $SomAvrLigne->bindParam(1,$c);
        $SomAvrLigne->execute(); */
    
                /*          $SomRaLigne = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRaLigne->bindParam(1,$c);
        $SomRaLigne->execute(); */

       
        
        
        

             /*     $SomAvr = $bdd->prepare("SELECT  sum(sac_flasque_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        
        $SomAvr->bindParam(1,$c); */
      
    
                /*         $SomRa = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa->bindParam(1,$c); */

    

     

               /*          $MyPoids = $bdd->prepare("SELECT  poids_kg from dispatching
                   WHERE id_dis=? ");
        
        
        $MyPoids->bindParam(1,$c); */

    


 /*       $selectid_dis=$bdd->prepare("SELECT * from reception where id_dis_recep_bl=?");
$selectid_dis->bindParam(1,$c);
$selectid_dis->execute(); */
  

 /* $compterecond=$bdd->prepare("select count(id_dis_recond) from reconditionnement_reception where id_dis_recond=?");
$compterecond->bindParam(1,$c);
$compterecond->execute(); */

 
$comptera=$bdd->prepare("select count(date_ra) from reception_avaries where id_dis_bl_ra=?");
$comptera->bindParam(1,$c);
$comptera->execute(); 


 




        $afficheAvaries = $bdd->prepare("select pre.*,trav.*,cam.*,ch.* from pre_reception_avaries as pre inner join transfert_avaries as trav on pre.id_pre_tr_av=trav.id_tr_avaries inner join camions as cam on cam.id_camions=trav.id_cam inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr where trav.id_dis_bl_tr=? ");
        
        
        $afficheAvaries->bindParam(1,$c);
        $afficheAvaries->execute();


        $afficheAvaries_ra = $bdd->prepare("SELECT pre.*, p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin, sum(pre.sac_flasque_ra),sum(pre.poids_flasque_ra),sum(pre.poids_mouille_ra),sum(pre.sac_mouille_ra), trs.numero_declaration   FROM reception_avaries as pre
                
                inner join  produit_deb as p on pre.id_produit_ra=p.id 

                inner join navire_deb as nav on pre.id_navire_ra=nav.id 
                
                inner join client as cli on pre.id_client_ra=cli.id
                inner join mangasin as mang on pre.id_destination_ra=mang.id
                inner join transit as trs on trs.id_trans=pre.id_declaration_ra
               

                   WHERE pre.id_dis_bl_ra=? group by pre.date_ra, pre.id_ra with rollup ");
        
        
        $afficheAvaries_ra->bindParam(1,$c);
        $afficheAvaries_ra->execute();


     
//-------------------------------requetes PV DE RECONDITIONNEMENT

 /*   $recondPV = $bdd->prepare("SELECT count(sac), sum(sac_eventres), sum(sac), sum(poids),sum(sac_balayure), sum(poids_balayure)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");

     $SainsPV = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $SainsPV->bindParam(1,$c);
        $SainsPV->execute();
        
        
        $recondPV ->bindParam(1,$c);
        $recondPV ->execute();  */

        
        
        
        
        

                  $SomAvrPV = $bdd->prepare("SELECT  sum(sac_flasque),sum(sac_mouille) from avaries_de_reception
                   WHERE id_dis=? ");
        
        
        $SomAvrPV->bindParam(1,$c);
         $SomAvrPV ->execute();
      



                          $SomRaPV = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRaPV->bindParam(1,$c);
         $SomRaPV ->execute();
     




    


 ?>
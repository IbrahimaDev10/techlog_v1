<?php 	

 function afficher_infos($bdd,$produit,$poids_sac,$navire,$destination){
    $infos= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire   FROM dispat as dis
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=nc.id_banque
                 

                  where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=? group by dis.id_produit,dis.poids_kg, dis.id_mangasin");             
           $infos->bindParam(1,$produit);
            $infos->bindParam(2,$poids_sac);
             $infos->bindParam(3,$navire);
             $infos->bindParam(4,$destination);
       $infos->execute();
        return $infos;
      }

    
$Sains = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains->bindParam(1,$c);
        $Sains->execute();

      $recond_DEPART = $bdd->prepare("SELECT count(sac_recond), sum(sac_recond), sum(poids_recond),sum(sac_balayure), sum(poids_balayure)  from reconditionnement_reception
                   WHERE declaration_id=? ");
        
        
        $recond_DEPART->bindParam(1,$c);
        $recond_DEPART ->execute();

         

                  $SomAvr_DEPART = $bdd->prepare("SELECT  sum(sac_flasque),sum(sac_mouille) from avaries_de_reception
                   WHERE destination_id=? ");
        
        
        $SomAvr_DEPART->bindParam(1,$c);
        $SomAvr_DEPART->execute();



                          $SomRa_DEPART = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART->bindParam(1,$c);


        

      

 
 $SainsL = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $SainsL->bindParam(1,$c);
        $SainsL->execute();

      $recond_DEPARTL = $bdd->prepare("SELECT count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_DEPARTL ->bindParam(1,$c);
        $recond_DEPARTL ->execute();

                  $SomAvl_DEPARTL = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvl_DEPARTL->bindParam(1,$c);
        $SomAvl_DEPARTL->execute();



                          
        
        
 

       // $SomRa_DEPART->execute();
  
          


          // -----requetes recapitution stock depart
   /*    function total_livraison_sain($bdd,$c) {   
           $TotalLivresL = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $TotalLivresL->bindParam(1,$c);
        $TotalLivresL->execute();
        return $TotalLivresL;
      } */
   
   function total_livraison_mouille($bdd,$c) {
         $TotalLivresMo = $bdd->prepare("SELECT poids_sac_mo,  sum(sac_mo), sum(poids_mo)  from livraison_mouille
                   WHERE id_dis_mo=? ");
               $TotalLivresMo->bindParam(1,$c);
        $TotalLivresMo->execute();
        return $TotalLivresMo;

      }

  /*  function sain_reception($bdd,$c){
          $Sains_Recap = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains_Recap->bindParam(1,$c);
        $Sains_Recap->execute();
        return $Sains_Recap;
      }

    function reconditionnement_reception($bdd,$c){
      $recond_DEPART_Recap = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_eventres), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");

        $recond_DEPART_Recap ->bindParam(1,$c);
        $recond_DEPART_Recap ->execute();
        return $recond_DEPART_Recap;
      } */
      function reconditionnement_livraison($bdd,$c){
        $recond_LIV = $bdd->prepare("SELECT count(sac_av_recond_liv),sum(sac_eventres_liv),  sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_LIV ->bindParam(1,$c);
        $recond_LIV ->execute();
        return $recond_LIV;
      }
       /*      function avaries_reception($bdd,$c){
                  $SomAvr_DEPART_Recap = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        $SomAvr_DEPART_Recap->bindParam(1,$c);
        $SomAvr_DEPART_Recap->execute();
        return $SomAvr_DEPART_Recap;

      } */


    /*  function reception_avaries_reception($bdd,$c){
                 $SomRa_DEPART_Recap = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART_Recap->bindParam(1,$c);

        return $SomRa_DEPART_Recap;

      } */
     


  /*    function afficher_livraison_sain($bdd,$c){
         $affiche = $bdd->prepare("SELECT r.*,d.*, be.*, liv.*, sum(liv.sac_liv),sum(liv.poids_liv)  FROM livraison_sain as liv 
                
             left join relache as r on r.id_rel=liv.relache_liv
             inner join declaration_liv as d on d.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv

                   WHERE liv.id_dis_liv=? group by liv.date_liv, liv.id_liv with rollup ");
        $affiche->bindParam(1,$c);
        $affiche->execute();
        return $affiche;
      } */

     

      function afficher_somme_livraison_sain($bdd,$c){
        $afficher_somme=$bdd->prepare("SELECT sum(sac_liv), sum(poids_liv) from livraison_sain where id_dis_liv=? ");
        $afficher_somme->bindParam(1,$c);
        $afficher_somme->execute();
        return $afficher_somme;
      }
            function afficher_somme_avaries_livraison($bdd,$c){
        $afficher_somme_avaries=$bdd->prepare("SELECT sum(sac_flasque_liv), sum(sac_mouille_liv) from avaries_de_livraison where id_dis_liv=? ");
        $afficher_somme_avaries->bindParam(1,$c);
        $afficher_somme_avaries->execute();
        return $afficher_somme_avaries;
      }

      function afficher_reconditionnement_livraison($bdd,$c){
         $recond = $bdd->prepare("SELECT *  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        $recond ->bindParam(1,$c);
        $recond ->execute();
        return $recond;
      }

      function reconditionnement_livraison_precedent($bdd,$precedent){
        $recond2 = $bdd->prepare("SELECT sum(sac_eventres_liv), sum(poids_eventres_liv), count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_recond_liv<=? ");
        
        
        $recond2 ->bindParam(1,$precedent);
        $recond2 ->execute();
        return $recond2;
      }

  function compte_reconditionnement_livraison($bdd,$c){
     $compterecond=$bdd->prepare("select count(id_dis_recond_liv) from reconditionnement_livraison where id_dis_recond_liv=?");
         $compterecond->bindParam(1,$c);
        $compterecond->execute();
        return $compterecond;
  }

  function compte_ligne_reconditionnement_livraison($bdd,$c) {

    $recondLigne = $bdd->prepare("SELECT count(sac_av_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recondLigne->bindParam(1,$c);
        $recondLigne ->execute();
        return $recondLigne;
  }
  function compte_ligne_avaries_livraison($bdd,$c){
    $SomAvrLigne = $bdd->prepare("SELECT  sum(sac_flasque_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvrLigne->bindParam(1,$c);
        $SomAvrLigne->execute(); 
        return $SomAvrLigne;
  }



  $Sains_RecapMOU = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains_RecapMOU->bindParam(1,$c);
        $Sains_RecapMOU->execute();

      $recond_DEPART_RecapMOU = $bdd->prepare("SELECT count(sac_recond), sum(sac_eventres), sum(sac_recond), sum(poids_recond),sum(sac_balayure), sum(poids_balayure)  from reconditionnement_reception
                   WHERE declaration_id=? ");
        
        
        $recond_DEPART_RecapMOU ->bindParam(1,$c);
        $recond_DEPART_RecapMOU ->execute();

                  $SomAvr_DEPART_RecapMOU = $bdd->prepare("SELECT  sum(sac_flasque),sum(sac_mouille) from avaries_de_reception
                   WHERE declaration_id=? ");
        
        
        $SomAvr_DEPART_RecapMOU->bindParam(1,$c);
        $SomAvr_DEPART_RecapMOU->execute();



                          $SomRa_DEPART_RecapMOU = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART_RecapMOU->bindParam(1,$c);



        $TotalLivresLMOU = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $TotalLivresLMOU->bindParam(1,$c);
        $TotalLivresLMOU->execute();

         $TotalLivresMoMOU = $bdd->prepare("SELECT poids_sac_mo,  sum(sac_mo), sum(poids_mo)  from livraison_mouille
                   WHERE id_dis_mo=? ");
               $TotalLivresMoMOU->bindParam(1,$c);
        $TotalLivresMoMOU->execute();

//---------REQUETE RECAP POUR LA TABLE LIVRAISON DES BALAYURES----------//

         $TotalLivresL_BAL = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $TotalLivresL_BAL->bindParam(1,$c);
        $TotalLivresL_BAL->execute();

         $TotalLivresMo_BAL = $bdd->prepare("SELECT poids_sac_mo,  sum(sac_mo), sum(poids_mo)  from livraison_mouille
                   WHERE id_dis_mo=? ");
               $TotalLivresMo_BAL->bindParam(1,$c);
        $TotalLivresMo_BAL->execute();

         $Sains_Recap_BAL = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains_Recap_BAL->bindParam(1,$c);
        $Sains_Recap_BAL->execute();

      $recond_DEPART_Recap_BAL = $bdd->prepare("SELECT count(sac_recond), sum(sac_eventres), sum(sac_recond), sum(poids_recond),sum(sac_balayure), sum(poids_balayure)  from reconditionnement_reception
                   WHERE declaration_id=? ");
        
        
        $recond_DEPART_Recap_BAL ->bindParam(1,$c);
        $recond_DEPART_Recap_BAL ->execute();

                  $SomAvr_DEPART_Recap_BAL = $bdd->prepare("SELECT  sum(sac_flasque),sum(sac_mouille) from avaries_de_reception
                   WHERE declaration_id=? ");
        
        
        $SomAvr_DEPART_Recap_BAL->bindParam(1,$c);
        $SomAvr_DEPART_Recap_BAL->execute();

                                  $SomRa_DEPART_Recap_BAL = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART_Recap_BAL->bindParam(1,$c);


     //requete pour afficher le next bl
       
   

   function res4($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire   FROM dispat as dis
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=nc.id_banque
                 

                  where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=?");             
            $res4->bindParam(1,$produit);
             $res4->bindParam(2,$poids_sac);
             $res4->bindParam(3,$navire);
             $res4->bindParam(4,$destination);
        $res4->execute();
        return $res4;
      }

 ?>
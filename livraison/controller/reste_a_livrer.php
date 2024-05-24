<?php 
function somme_sain_livrer($bdd,$produit,$poids_sac,$navire,$destination){
         $som_sain = $bdd->prepare("SELECT r.*,ds.*, be.*,dis.id_dis,dis.poids_kg,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_sain as liv 
                
             left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
        $som_sain->bindParam(1,$produit);
         $som_sain->bindParam(2,$poids_sac);
         $som_sain->bindParam(3,$navire);
          $som_sain->bindParam(4,$destination);
         $som_sain->execute();
        return  $som_sain;
      }

      function somme_sain_livres($bdd,$produit,$poids_sac,$navire,$destination){
         $new_som_sain = $bdd->prepare("SELECT r.*,ds.*, be.*,dis.id_dis,dis.poids_kg,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_sain as liv 
                
             left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and liv.statut='sain' ");
        $new_som_sain->bindParam(1,$produit);
         $new_som_sain->bindParam(2,$poids_sac);
         $new_som_sain->bindParam(3,$navire);
          $new_som_sain->bindParam(4,$destination);
         $new_som_sain->execute();
        return  $new_som_sain;
      }

      function somme_mouille_livres($bdd,$produit,$poids_sac,$navire,$destination){
         $new_som_mouille = $bdd->prepare("SELECT r.*,ds.*, be.*,dis.id_dis,dis.poids_kg,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_sain as liv 
                
             left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and liv.statut='mouille' ");
        $new_som_mouille->bindParam(1,$produit);
         $new_som_mouille->bindParam(2,$poids_sac);
         $new_som_mouille->bindParam(3,$navire);
          $new_som_mouille->bindParam(4,$destination);
         $new_som_mouille->execute();
        return  $new_som_mouille;
      }

         function somme_balayure_livres($bdd,$produit,$poids_sac,$navire,$destination){
         $new_balayure_mouille = $bdd->prepare("SELECT r.*,ds.*, be.*,dis.id_dis,dis.poids_kg,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_sain as liv 
                
             left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and liv.statut='balayure' ");
        $new_balayure_mouille->bindParam(1,$produit);
         $new_balayure_mouille->bindParam(2,$poids_sac);
         $new_balayure_mouille->bindParam(3,$navire);
          $new_balayure_mouille->bindParam(4,$destination);
         $new_balayure_mouille->execute();
        return  $new_balayure_mouille;
      }

       function somme_mouille_livrer($bdd,$produit,$poids_sac,$navire,$destination){
         $som_mouille = $bdd->prepare("SELECT r.*,ds.*, be.*,dis.id_dis,nc.id_navire, sum(liv.sac_mo),sum(liv.poids_mo),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_mouille as liv 
                
             inner join dispatching_relache as r on r.id_dis_relache=liv.relache_mo
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_mo
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_mo
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             inner join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
         $som_mouille->bindParam(1,$produit);
         $som_mouille->bindParam(2,$poids_sac);
         $som_mouille->bindParam(3,$navire);
          $som_mouille->bindParam(4,$destination);
         $som_mouille->execute();
        return  $som_mouille;
      }

       function somme_balayure_livrer($bdd,$produit,$poids_sac,$navire,$destination){
         $som_balayure = $bdd->prepare("SELECT r.*,ds.*, be.*, liv.*,dis.id_dis,nc.id_navire, sum(liv.sac_bal),sum(liv.poids_bal),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_balayure as liv 
                
             inner join dispatching_relache as r on r.id_dis_relache=liv.relache_bal
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_bal
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_bal
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             inner join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
         $som_balayure->bindParam(1,$produit);
         $som_balayure->bindParam(2,$poids_sac);
         $som_balayure->bindParam(3,$navire);
          $som_balayure->bindParam(4,$destination);
         $som_balayure->execute();
        return  $som_balayure;
      }

       function somme_recond_livraison($bdd,$produit,$poids_sac,$navire,$destination){
    $som_recond=$bdd->prepare("SELECT 
    dis.id_produit, dis.poids_kg, dis.id_mangasin, nc.id_navire, 
    SUM(rl.sac_eventres_liv),SUM(rl.sac_av_recond_liv), SUM(rl.poids_av_recond_liv), SUM(rl.sac_balayure_recond_liv),SUM(rl.poids_balayure_recond_liv),
    ex.id_trans_extends
FROM
    reconditionnement_livraison AS rl
INNER JOIN declaration_sortie AS ds ON ds.id_decliv = rl.id_declaration_recliv
INNER JOIN transit_extends AS ex ON ex.id_trans_extends = ds.id_dec_entrant
INNER JOIN dispat AS dis ON dis.id_dis = ex.id_bl_extends
INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis
WHERE 
    dis.id_produit = ? 
    AND dis.poids_kg = ? 
    AND nc.id_navire = ? 
    AND dis.id_mangasin =?");

  $som_recond->bindParam(1,$produit);
         $som_recond->bindParam(2,$poids_sac);
         $som_recond->bindParam(3,$navire);
          $som_recond->bindParam(4,$destination);
         $som_recond->execute();

        return $som_recond;
      }

       function somme_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination){

$som_av_liv=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,sum(avl.sac_flasque_liv),sum(avl.sac_mouille_liv),ds.id_decliv,ex.id_trans_extends from avaries_de_livraison as avl
   inner join declaration_sortie as ds on ds.id_decliv=avl.id_declaration_av_liv
      inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant

    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
  $som_av_liv->bindParam(1,$produit);
        $som_av_liv->bindParam(2,$poids_sac);
        $som_av_liv->bindParam(3,$navire);
         $som_av_liv->bindParam(4,$destination);
        $som_av_liv->execute();

        return $som_av_liv;
    }

 ?>
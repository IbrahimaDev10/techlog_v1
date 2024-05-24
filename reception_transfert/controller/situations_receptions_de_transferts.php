<?php // RESULTAT DES RECEPTIONS_TRANSFERTS 

    //TOTAL RECEPTION (sain)
    function Total_Reception($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_transfert_des_avaries as rta
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rta.id_declaration
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' ");

        $total_reception->bindParam(1,$produit);
        $total_reception->bindParam(2,$poids_sac);
        $total_reception->bindParam(3,$navire);
        $total_reception->bindParam(4,$destination);
        $total_reception->execute();
        return $total_reception;
      }

       function Total_Reception_flasque_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_flasque_deb = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_transfert_des_avaries as rta
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rta.id_declaration
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='flasque' ");

        $total_reception_flasque_deb->bindParam(1,$produit);
        $total_reception_flasque_deb->bindParam(2,$poids_sac);
        $total_reception_flasque_deb->bindParam(3,$navire);
        $total_reception_flasque_deb->bindParam(4,$destination);
        $total_reception_flasque_deb->execute();
        return $total_reception_flasque_deb;
      }

             function Total_Reception_mouille_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_mouille_deb = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_transfert_des_avaries as rta
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rta.id_declaration
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='mouille' ");

        $total_reception_mouille_deb->bindParam(1,$produit);
        $total_reception_mouille_deb->bindParam(2,$poids_sac);
        $total_reception_mouille_deb->bindParam(3,$navire);
        $total_reception_mouille_deb->bindParam(4,$destination);
        $total_reception_mouille_deb->execute();
        return $total_reception_mouille_deb;
      }

                   function Total_Reception_balayure_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_balayure_deb = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_transfert_des_avaries as rta
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rta.id_declaration
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='balayure' ");

        $total_reception_balayure_deb->bindParam(1,$produit);
        $total_reception_balayure_deb->bindParam(2,$poids_sac);
        $total_reception_balayure_deb->bindParam(3,$navire);
        $total_reception_balayure_deb->bindParam(4,$destination);
        $total_reception_balayure_deb->execute();
        return $total_reception_balayure_deb;
      }



       function Total_Avaries_de_reception($bdd,$produit,$poids_sac,$navire,$destination){
          $total_avaries_reception = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, avt.*, sum(avt.sac_flasque), sum(avt.sac_mouille)  from avaries_de_transfert as avt
            inner join declaration_transfert as dt on dt.id_declaration_transfert=avt.declaration_id
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=avt.destination_id
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and avt.destination_id=?  ");

        $total_avaries_reception->bindParam(1,$produit);
        $total_avaries_reception->bindParam(2,$poids_sac);
        $total_avaries_reception->bindParam(3,$navire);
        $total_avaries_reception->bindParam(4,$destination);
        $total_avaries_reception->execute();
        return $total_avaries_reception;
      }

       function Total_Recond_transfert($bdd,$produit,$poids_sac,$navire,$destination){
          $recond_transfert = $bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,dt.id_declaration_transfert,mg.id, rt.*, sum(rt.sac_eventres), sum(rt.sac_recond),sum(rt.sac_balayure), sum(rt.poids_recond), sum(rt.poids_balayure), sum(rt.poids_eventres)  from reconditionnement_reception_transfert as rt
            inner join declaration_transfert as dt on dt.id_declaration_transfert=rt.declaration_id
                 inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rt.id_destination
                 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and rt.id_destination=? ");

        $recond_transfert->bindParam(1,$produit);
        $recond_transfert->bindParam(2,$poids_sac);
        $recond_transfert->bindParam(3,$navire);
        $recond_transfert->bindParam(4,$destination);
        $recond_transfert->execute();
        return $recond_transfert;
      }
?>
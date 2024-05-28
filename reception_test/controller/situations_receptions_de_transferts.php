<?php // RESULTAT DES RECEPTIONS_TRANSFERTS 

    //TOTAL RECEPTION (sain)
    function Total_Reception($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' ");

        $total_reception->bindParam(1,$produit);
        $total_reception->bindParam(2,$poids_sac);
        $total_reception->bindParam(3,$navire);
        $total_reception->bindParam(4,$destination);
        $total_reception->execute();
        return $total_reception;
      }

       function Total_Reception_flasque_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_flasque_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='flasque' ");

        $total_reception_flasque_deb->bindParam(1,$produit);
        $total_reception_flasque_deb->bindParam(2,$poids_sac);
        $total_reception_flasque_deb->bindParam(3,$navire);
        $total_reception_flasque_deb->bindParam(4,$destination);
        $total_reception_flasque_deb->execute();
        return $total_reception_flasque_deb;
      }

             function Total_Reception_mouille_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_mouille_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='mouille' ");

        $total_reception_mouille_deb->bindParam(1,$produit);
        $total_reception_mouille_deb->bindParam(2,$poids_sac);
        $total_reception_mouille_deb->bindParam(3,$navire);
        $total_reception_mouille_deb->bindParam(4,$destination);
        $total_reception_mouille_deb->execute();
        return $total_reception_mouille_deb;
      }

                   function Total_Reception_balayure_deb($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_balayure_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='balayure' ");

        $total_reception_balayure_deb->bindParam(1,$produit);
        $total_reception_balayure_deb->bindParam(2,$poids_sac);
        $total_reception_balayure_deb->bindParam(3,$navire);
        $total_reception_balayure_deb->bindParam(4,$destination);
        $total_reception_balayure_deb->execute();
        return $total_reception_balayure_deb;
      }



       function Total_Avaries_de_reception($bdd,$produit,$poids_sac,$navire,$destination){
          $total_avaries_reception = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,mg.id, avt.*, sum(avt.sac_flasque), sum(avt.sac_mouille)  from avaries_de_reception as avt
            inner join declaration as d on d.id_declaration=avt.declaration_id
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=avt.destination_id
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and avt.destination_id=?  ");

        $total_avaries_reception->bindParam(1,$produit);
        $total_avaries_reception->bindParam(2,$poids_sac);
        $total_avaries_reception->bindParam(3,$navire);
        $total_avaries_reception->bindParam(4,$destination);
        $total_avaries_reception->execute();
        return $total_avaries_reception;
      }

       function Total_Recond_transfert($bdd,$produit,$poids_sac,$navire,$destination){
          $recond_transfert = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,d.id_declaration,mg.id, rt.*, sum(rt.sac_eventres), sum(rt.sac_recond),sum(rt.sac_balayure), sum(rt.poids_recond), sum(rt.poids_balayure), sum(rt.poids_eventres)  from reconditionnement_reception as rt
            inner join declaration as d on d.id_declaration=rt.declaration_id
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rt.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rt.id_destination=? ");

        $recond_transfert->bindParam(1,$produit);
        $recond_transfert->bindParam(2,$poids_sac);
        $recond_transfert->bindParam(3,$navire);
        $recond_transfert->bindParam(4,$destination);
        $recond_transfert->execute();
        return $recond_transfert;
      }


          function Date_Reception($bdd,$produit,$poids_sac,$navire,$destination){
          $date_reception = $bdd->prepare("SELECT rta.dates  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' order by rta.dates  ");

        $date_reception->bindParam(1,$produit);
        $date_reception->bindParam(2,$poids_sac);
        $date_reception->bindParam(3,$navire);
        $date_reception->bindParam(4,$destination);
        $date_reception->execute();
        return $date_reception;
      }

      function Date_Reception_fin($bdd,$produit,$poids_sac,$navire,$destination){
          $date_reception_fin = $bdd->prepare("SELECT rta.dates  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' order by rta.dates desc ");

        $date_reception_fin->bindParam(1,$produit);
        $date_reception_fin->bindParam(2,$poids_sac);
        $date_reception_fin->bindParam(3,$navire);
        $date_reception_fin->bindParam(4,$destination);
        $date_reception_fin->execute();
        return $date_reception_fin;
      }

      //TOTAL RECEPTION VRAC

          function Total_Reception_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,dis.poids_kgs,dis.id_produits,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' ");

        $total_reception->bindParam(1,$produit);
        $total_reception->bindParam(2,$poids_sac);
        $total_reception->bindParam(3,$navire);
        $total_reception->bindParam(4,$destination);
        $total_reception->execute();
        return $total_reception;
      }

       function Total_Reception_flasque_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_flasque_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='flasque' ");

        $total_reception_flasque_deb->bindParam(1,$produit);
        $total_reception_flasque_deb->bindParam(2,$poids_sac);
        $total_reception_flasque_deb->bindParam(3,$navire);
        $total_reception_flasque_deb->bindParam(4,$destination);
        $total_reception_flasque_deb->execute();
        return $total_reception_flasque_deb;
      }

             function Total_Reception_mouille_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_mouille_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='mouille' ");

        $total_reception_mouille_deb->bindParam(1,$produit);
        $total_reception_mouille_deb->bindParam(2,$poids_sac);
        $total_reception_mouille_deb->bindParam(3,$navire);
        $total_reception_mouille_deb->bindParam(4,$destination);
        $total_reception_mouille_deb->execute();
        return $total_reception_mouille_deb;
      }

                   function Total_Reception_balayure_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $total_reception_balayure_deb = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire ,mg.id, rta.*, sum(rta.sac), sum(rta.poids)  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='balayure' ");

        $total_reception_balayure_deb->bindParam(1,$produit);
        $total_reception_balayure_deb->bindParam(2,$poids_sac);
        $total_reception_balayure_deb->bindParam(3,$navire);
        $total_reception_balayure_deb->bindParam(4,$destination);
        $total_reception_balayure_deb->execute();
        return $total_reception_balayure_deb;
      }



       function Total_Avaries_de_reception_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $total_avaries_reception = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,mg.id, avt.*, sum(avt.sac_flasque), sum(avt.sac_mouille)  from avaries_de_reception as avt
            inner join declaration as d on d.id_declaration=avt.declaration_id
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=avt.destination_id
                 WHERE dia.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and avt.destination_id=?  ");

        $total_avaries_reception->bindParam(1,$produit);
        $total_avaries_reception->bindParam(2,$poids_sac);
        $total_avaries_reception->bindParam(3,$navire);
        $total_avaries_reception->bindParam(4,$destination);
        $total_avaries_reception->execute();
        return $total_avaries_reception;
      }

       function Total_Recond_transfert_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $recond_transfert = $bdd->prepare("SELECT nc.id_produit,nc.poids_kg,dis.id_mangasin,nc.id_navire,d.id_declaration,mg.id, rt.*, sum(rt.sac_eventres), sum(rt.sac_recond),sum(rt.sac_balayure), sum(rt.poids_recond), sum(rt.poids_balayure), sum(rt.poids_eventres)  from reconditionnement_reception as rt
            inner join declaration as d on d.id_declaration=rt.declaration_id
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rt.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rt.id_destination=? ");

        $recond_transfert->bindParam(1,$produit);
        $recond_transfert->bindParam(2,$poids_sac);
        $recond_transfert->bindParam(3,$navire);
        $recond_transfert->bindParam(4,$destination);
        $recond_transfert->execute();
        return $recond_transfert;
      }


          function Date_Reception_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $date_reception = $bdd->prepare("SELECT rta.dates  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' order by rta.dates  ");

        $date_reception->bindParam(1,$produit);
        $date_reception->bindParam(2,$poids_sac);
        $date_reception->bindParam(3,$navire);
        $date_reception->bindParam(4,$destination);
        $date_reception->execute();
        return $date_reception;
      }

      function Date_Reception_fin_vrac($bdd,$produit,$poids_sac,$navire,$destination){
          $date_reception_fin = $bdd->prepare("SELECT rta.dates  from reception_navire as rta
            inner join declaration as d on d.id_declaration=rta.id_declaration
                 inner join dispats as dis on dis.id_dis=d.id_bl
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join mangasin as mg on mg.id=rta.id_destination
                 WHERE dis.id_produits=? and dis.poids_kgs=? and nc.id_navire=? and rta.id_destination=? and rta.statut='sain' order by rta.dates desc ");

        $date_reception_fin->bindParam(1,$produit);
        $date_reception_fin->bindParam(2,$poids_sac);
        $date_reception_fin->bindParam(3,$navire);
        $date_reception_fin->bindParam(4,$destination);
        $date_reception_fin->execute();
        return $date_reception_fin;
      }

      function type_de_navires($bdd,$navire){
        $type_navires=$bdd->prepare("SELECT type from navire_deb WHERE id=?");
        $type_navires->bindParam(1,$navire);
        $type_navires->execute();
        return $type_navires;
      }

?>
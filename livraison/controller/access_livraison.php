
<?php
  function choix_du_navire($bdd,$a){
$naviress=$bdd->prepare("SELECT dis.id_dis,  mg.mangasin,nav.navire,nc.num_connaissement, nc.id_navire from dispats as dis 

                 inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                 INNER join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 
                 
                
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.id; ");
              $naviress->bindParam(1,$a);
             
              $naviress->execute();
              return $naviress;

    }

  	
 function choix_du_navire_issus_transfert($bdd,$a){
$naviress=$bdd->prepare("SELECT dis.id_dis, tr.id_transfert,dt.id_transfertD, mg.mangasin,nav.navire,nc.num_connaissement, nc.id_navire from dispat_transfert as dt 
                 LEFT JOIN dispat as dis on dt.id_dis_transfertD=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 INNER join mangasin as mg on mg.id=dt.id_nouvelle_destinationD
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 
                 
                 LEFT join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=?  group by nav.id ");
              $naviress->bindParam(1,$a);
             
              $naviress->execute();
              return $naviress;

    } 
/* SELECT dis.id_dis, tr.id_transfert,dt.id_transfertD, mg.mangasin,nav.navire,nc.num_connaissement from dispat as dis 

                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 INNER join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 LEFT JOIN dispat_transfert as dt on dt.id_dis_transfertD=dis.id_dis
                 
                 LEFT join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=10 OR tr.id_nouvelle_destination=28 group by nav.id;



                 SELECT dis.*, tr.*, mg.*, nav.*, nc.* from dispat as dis 

                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 left join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join transfert as tr on tr.id_nouvelle_destination=mg.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? OR tr.id_nouvelle_destination=? group by nc.id_navire */
 ?>
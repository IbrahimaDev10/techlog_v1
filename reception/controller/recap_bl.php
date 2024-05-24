<?php  

function ticket_recep_sain($bdd,$id){
  	$donnees=$bdd->prepare("SELECT dis.poids_kg, tr.numero_declaration, dis.n_bl,nav.navire,p.produit,p.qualite,r.bl_recep,r.sac_recep,r.poids_recep,r.manquant_recep,r.camion_recep,r.chauffeur_recep,mg.mangasin,ch.n_permis,ch.num_telephone,rm.bl ,b.banque  from reception as r
  		inner join dispatching as dis on dis.id_dis=r.id_dis_recep_bl
  		inner join produit_deb as p on p.id=dis.id_produit
  		inner join mangasin as mg on mg.id=dis.id_mangasin
  		inner join navire_deb as nav on nav.id=dis.id_navire
  		inner join transit as tr on tr.id_trans=r.id_dec
      left join register_manifeste as rm on rm.bl=r.bl_recep
      left join chauffeur as ch on ch.id_chauffeur=rm.chauffeur 
      left join banque as b on b.id=dis.id_banque_dis 

  		
  		WHERE r.id_recep=?");
  	$donnees->bindParam(1,$id);
  	$donnees->execute();
  	return $donnees;
  }

  function ticket_recep_avaries($bdd,$id){
    $donnees=$bdd->prepare("SELECT dis.poids_kg, tr.numero_declaration, dis.n_bl,nav.navire,p.produit,p.qualite,ra.bl_ra,ra.sac_flasque_ra,ra.poids_flasque_ra,ra.sac_mouille_ra,ra.poids_mouille_ra,ra.camion_ra,ra.chauffeur_ra,mg.mangasin,ch.n_permis,ch.num_telephone,trav.bl_tr from reception_avaries as ra
      inner join dispatching as dis on dis.id_dis=ra.id_dis_bl_ra
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on mg.id=dis.id_mangasin
      inner join navire_deb as nav on nav.id=dis.id_navire
      left join transit as tr on tr.id_trans=ra.id_declaration_ra
      left join transfert_avaries as trav on trav.bl_tr=ra.bl_ra
      left join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr


      
      WHERE ra.id_ra=?");
    $donnees->bindParam(1,$id);
    $donnees->execute();
    return $donnees;
  }

  ?>
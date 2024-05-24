<?php  

function ticket_livraison_sain($bdd,$id){
  	$donnees=$bdd->prepare("SELECT dis.poids_kg, dc.num_decliv, dis.n_bl,nav.navire,p.produit,p.qualite,liv.id_liv,liv.sac_liv,liv.poids_liv,liv.tel_liv,liv.camion_liv,liv.chauffeur_liv,mg.mangasin,b.banque  from livraison_sain as liv
  		inner join dispatching as dis on dis.id_dis=liv.id_dis_liv
  		inner join produit_deb as p on p.id=dis.id_produit
  		inner join mangasin as mg on mg.id=dis.id_mangasin
  		inner join navire_deb as nav on nav.id=dis.id_navire
  		inner join declaration_liv as dc on dc.id_decliv=liv.dec_liv

      left join banque as b on b.id=dis.id_banque_dis 

  		
  		WHERE liv.id_liv=?");
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
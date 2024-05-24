<?php  

function ticket_livraison_sain($bdd,$id){
  	$donnees=$bdd->prepare("SELECT dis.poids_kg, ds.num_decliv, dis.id_dis,nav.navire,p.produit,p.qualite,liv.id_liv,liv.sac_liv,liv.poids_liv,liv.tel_liv,liv.camion_liv,liv.chauffeur_liv,liv.num_permis_liv,mg.mangasin,b.banque,ex.id_trans_extends,nc.num_connaissement  from livraison_sain as liv
      inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
      inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
  		inner join dispat as dis on dis.id_dis=ex.id_bl_extends
  		inner join produit_deb as p on p.id=dis.id_produit
  		inner join mangasin as mg on mg.id=dis.id_mangasin
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
  		inner join navire_deb as nav on nav.id=nc.id_navire
  		

      left join banque as b on b.id=nc.id_banque

  		
  		WHERE liv.id_liv=?");
  	$donnees->bindParam(1,$id);
  	$donnees->execute();
  	return $donnees;
  }

  function ticket_livraison_mouille($bdd,$id){
    $donnees=$bdd->prepare("SELECT dis.poids_kg, dc.num_decliv, dis.n_bl,nav.navire,p.produit,p.qualite,liv.id_mo,liv.sac_mo,liv.poids_mo,liv.tel_mo,liv.camion_mo,liv.chauffeur_mo,liv.num_permis_mo,mg.mangasin,b.banque  from livraison_mouille as liv
      inner join dispatching as dis on dis.id_dis=liv.id_dis_mo
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on mg.id=dis.id_mangasin
      inner join navire_deb as nav on nav.id=dis.id_navire
      inner join declaration_liv as dc on dc.id_decliv=liv.dec_mo

      left join banque as b on b.id=dis.id_banque_dis 

      
      WHERE liv.id_mo=?");
    $donnees->bindParam(1,$id);
    $donnees->execute();
    return $donnees;
  }

   function ticket_livraison_balayure($bdd,$id){
    $donnees=$bdd->prepare("SELECT dis.poids_kg, dc.num_decliv, dis.n_bl,nav.navire,p.produit,p.qualite,liv.id_bal,liv.sac_bal,liv.poids_bal,liv.tel_bal,liv.camion_bal,liv.chauffeur_bal,liv.num_permis_bal,mg.mangasin,b.banque  from livraison_balayure as liv
      inner join dispatching as dis on dis.id_dis=liv.id_dis_bal
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on mg.id=dis.id_mangasin
      inner join navire_deb as nav on nav.id=dis.id_navire
      inner join declaration_liv as dc on dc.id_decliv=liv.dec_bal

      left join banque as b on b.id=dis.id_banque_dis 

      
      WHERE liv.id_bal=?");
    $donnees->bindParam(1,$id);
    $donnees->execute();
    return $donnees;
  }

 

  ?>
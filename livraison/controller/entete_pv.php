<?php  function titre_entete_pv2($bdd,$produit,$poids_sac,$navire,$destination){
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
 
      } ?>
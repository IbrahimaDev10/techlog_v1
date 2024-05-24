<?php 
function afficher_declaration($bdd){
	 $declaration=$bdd->query("SELECT ex.*,re.*, dis.n_bl,dis.poids_t,dis.poids_kg, p.produit,p.qualite, mg.mangasin, cli.client,nav.navire,b.banque from transit_extends as ex
      inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
      inner join dispatching as dis on dis.id_dis=ex.id_bl_extends
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on dis.id_mangasin=mg.id
      inner join client as cli on cli.id=dis.id_client
      inner join navire_deb as nav on nav.id=dis.id_navire
      left join banque as b on b.id=dis.id_banque_dis"
      );
	 return $declaration;
}

 ?>
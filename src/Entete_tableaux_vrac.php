<?php 
namespace Pro\TechlogNewVersion;

class Entete_tableaux_vrac {
    public static function entete_des_tableaux_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){
   $element_entete= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.des_douane,sum(dis.quantite_sac),sum(dis.quantite_poids), nc.num_connaissement,nc.poids_kg,dis.poids_kgs,dis.id_dis   FROM dispats as dis 
                 left join declaration as d on d.id_declaration=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? group by nc.id_produit,nc.poids_kg,dis.id_mangasin  ");
        $element_entete->bindParam(1,$produit);
        $element_entete->bindParam(2,$poids_sac);
        $element_entete->bindParam(3,$navire);
        $element_entete->bindParam(4,$destination);
        $element_entete->bindParam(5,$client);
        $element_entete->execute();
        return $element_entete;
}
}

 ?>
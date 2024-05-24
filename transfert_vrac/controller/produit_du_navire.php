<?php 

       function produit_du_navire($bdd,$navire_initiale){	
         $produit_nav = $bdd->prepare("SELECT dis.*,mang.mangasin, p.produit,p.qualite,nc.*,nav.type,cli.client, nav.id as nav_id, d.* FROM dispats as dis
               LEFT join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join navire_deb as nav on nav.id=nc.id_navire
                inner join produit_deb as p on dis.id_produits=p.id
                inner join client as cli on cli.id=nc.id_client
                
                 inner join mangasin as mang on dis.id_mangasin=mang.id
                

            WHERE nc.id_navire=? group by dis.id_produits, dis.poids_kgs,nc.id_client, dis.id_mangasin " );
        $produit_nav->bindParam(1,$navire_initiale);
       
        
        $produit_nav->execute();
        return $produit_nav;

        } ?>
<?php 
    function connaissement_dispat(){
      return ' inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis '; 
    }
   

    function transit_extends_reception(){
    	return ' inner join transit_extends as ex on rec.id_dec=ex.id_trans_extends ';
    }
        function transit_extends_reelle(){
    	return ' inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle ';
    }

    function produit_dispat(){
    	return ' inner join  produit_deb as p on dis.id_produit=p.id ';
    }
    function navire_connaissement(){
    	return ' inner join navire_deb as nav on nc.id_navire=nav.id ';
    }
    function client_dispat(){
        return ' inner join client as cli on dis.id_client=cli.id ';
    }
    function mangasin_dispat(){
    	return ' inner join mangasin as mang on dis.id_mangasin=mang.id ';
    }
    function chauffeur_reception(){
    	return ' left join chauffeur as ch on rec.chauffeur_recep=ch.id_chauffeur ';
    }
    function camion_reception(){
    	return ' left join camions as cam on rec.camion_recep=cam.id_camions ';
    }
    function transporteur_camion(){
    	return ' left join transporteur as trp on cam.id_trans=trp.id ';
    }
    function declaration_extends(){
    	return ' inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends ';
    }
    function dispat_extends(){
    	return ' inner join dispat as dis on ex.id_bl_extends=dis.id_dis ';
    }

 ?>
<?php 
  function segment($bdd,$produit,$poids_sac,$navire,$destination){
 $donnees = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av),ex.id_trans_reelle,re.id_trans_reelle, dis.*,dc.*,nc.*  FROM transfert_avaries as trav 
                
             inner join transit_extends as ex on trav.id_declaration_tr=ex.id_trans_extends
                inner join dispat as dis on ex.id_bl_extends=dis.id_dis
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join camions as cam on trav.id_cam=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join chauffeur as ch on trav.id_chauffeur_tr=ch.id_chauffeur 
                inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends
               


                    WHERE dis.id_produit=? and  dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and trav.bl_tr!='ref' group by trav.date_tr_avaries, trav.id_tr_avaries with rollup ");
        
        
       $donnees->bindParam(1,$produit);
        $donnees->bindParam(2,$poids_sac);
        $donnees->bindParam(3,$navire);
        $donnees->bindParam(4,$destination);
       $donnees->execute();
        return $donnees;
      }


       function afficher_variable($bdd,$id){
 $variable = $bdd->prepare("SELECT   p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av),ex.id_trans_reelle,re.id_trans_reelle, dis.*,dc.*  FROM transfert_avaries as trav 
                
             inner join transit_extends as ex on trav.id_declaration_tr=ex.id_trans_extends
                inner join dispat as dis on ex.id_bl_extends=dis.id_dis
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join camions as cam on trav.id_cam=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join chauffeur as ch on trav.id_chauffeur_tr=ch.id_chauffeur 
                inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends
               
                

              
               


                    WHERE trav.id_tr_avaries=?  ");
        
        
      $variable->bindParam(1,$id);
      
       $variable->execute();
        return $variable;
      }

  function ticket_deb_sain($bdd,$id){
  	$donnees=$bdd->prepare("SELECT dis.poids_kg, tr.numero_declaration, dis.n_bl,nav.navire,p.produit,p.qualite,rm.bl,rm.sac,rm.poids,mg.mangasin,ch.nom_chauffeur,ch.n_permis,ch.num_telephone, cam.num_camions from register_manifeste as rm
  		inner join dispatching as dis on dis.id_dis=rm.id_dis_bl
  		inner join produit_deb as p on p.id=dis.id_produit
  		inner join mangasin as mg on mg.id=dis.id_mangasin
  		inner join navire_deb as nav on nav.id=dis.id_navire
  		inner join transit as tr on tr.id_bl=dis.id_dis
  		inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
  		inner join camions as cam on cam.id_camions=rm.camions
  		
  		WHERE rm.id_register_manif=?");
  	$donnees->bindParam(1,$id);
  	$donnees->execute();
  	return $donnees;
  }

 ?>
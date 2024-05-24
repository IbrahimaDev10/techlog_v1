
<?php 
 function afficher_situation_bon($bdd,$produit,$poids_sac,$navire,$destination){

 	$bon=$bdd->prepare('SELECT be.id_enleve, be.num_enleve,be.poids_enleve,be.date_enleve,nc.num_connaissement,nc.id_navire,dis.id_dis,dis.id_mangasin,dis.id_produit, sum(ls.sac_liv),sum(ls.poids_liv),sum(lm.sac_mo),sum(lm.poids_mo),sum(lb.sac_bal),sum(lb.poids_bal), nav.navire from bon_enlevement as be  
 		left join livraison_sain as ls on ls.bl_fournisseur_liv= be.id_enleve
 		left join livraison_mouille as lm on lm.bl_fournisseur_mo= be.id_enleve
 		left join livraison_balayure as lb on lb.bl_fournisseur_bal= be.id_enleve
 		inner join dispat as dis on dis.id_dis=be.id_dis_enleve
 		inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 		inner join navire_deb as nav on nav.id=nc.id_navire
 		where dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by be.id_enleve
 		 ');
 	$bon->bindParam(1,$produit);
 	$bon->bindParam(2,$poids_sac);
 	$bon->bindParam(3,$navire);
 	$bon->bindParam(4,$destination);
 	$bon->execute();
 	return $bon;

 }

 function afficher_relache_lie_au_bon($bdd,$id_bon){
 	$bon_relache=$bdd->prepare("SELECT nr.num_relache,disr.id_dis_relache, 
 	ls.sac_liv, ls.poids_liv, lm.sac_mo ,lm.poids_mo, lb.sac_bal, lb.poids_bal from dispatching_relache as disr   
 		left join livraison_sain as ls on ls.relache_liv= disr.id_dis_relache
 		left join livraison_mouille as lm on lm.relache_mo= disr.id_dis_relache
 		left join livraison_balayure as lb on lb.relache_bal= disr.id_dis_relache
 		 inner join numero_relache as nr on nr.id_relache=disr.id_relache
 		
 		 where ls.bl_fournisseur_liv=? OR lm.bl_fournisseur_mo=? OR lb.bl_fournisseur_bal=? group by disr.id_dis_relache

 		 ");
 	$bon_relache->bindParam(1,$id_bon);
 	$bon_relache->bindParam(2,$id_bon);
 	$bon_relache->bindParam(3,$id_bon);
 	$bon_relache->execute();
 	return $bon_relache;

}


  function afficher_situation_relache($bdd,$produit,$poids_sac,$navire,$destination){

 	$bon=$bdd->prepare('SELECT nr.num_relache,nr.quantite,nc.num_connaissement,nc.id_navire,dis.id_dis,dis.id_mangasin,dis.id_produit, sum(ls.sac_liv),sum(ls.poids_liv),sum(lm.sac_mo),sum(lm.poids_mo),sum(lb.sac_bal),sum(lb.poids_bal), b.banque from numero_relache as nr   
 		left join livraison_sain as ls on ls.relache_liv= nr.id_relache
 		left join livraison_mouille as lm on lm.relache_mo= nr.id_relache
 		left join livraison_balayure as lb on lb.relache_bal= nr.id_relache
 		 
 		        inner join dispat as dis on dis.id_dis=nr.id_dis_relache 
        inner join numero_connaissement as nc on nc.id_connaissement=nr.id_connaissement 
        
        inner join banque as b on b.id=nc.id_banque
 		where dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by nr.id_relache
 		 ');
 	$bon->bindParam(1,$produit);
 	$bon->bindParam(2,$poids_sac);
 	$bon->bindParam(3,$navire);
 	$bon->bindParam(4,$destination);
 	$bon->execute();
 	return $bon;

 }


  function afficher_situation_transit($bdd,$produit,$poids_sac,$navire,$destination){

 	$bon=$bdd->prepare('SELECT ds.num_decliv,ds.poids_decliv,ds.date_decliv,nc.num_connaissement,nc.id_navire,dis.id_dis,dis.id_mangasin,dis.id_produit, sum(ls.sac_liv),sum(ls.poids_liv),sum(lm.sac_mo),sum(lm.poids_mo),sum(lb.sac_bal),sum(lb.poids_bal),ex.id_trans_extends from declaration_sortie as ds  
 		left join livraison_sain as ls on ls.dec_liv= ds.id_decliv
 		left join livraison_mouille as lm on lm.dec_mo= ds.id_decliv
 		left join livraison_balayure as lb on lb.dec_bal= ds.id_decliv
 		 inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
        
 		where dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by ds.id_decliv
 		 ');
 	$bon->bindParam(1,$produit);
 	$bon->bindParam(2,$poids_sac);
 	$bon->bindParam(3,$navire);
 	$bon->bindParam(4,$destination);
 	$bon->execute();
 	return $bon;

 }

 /*function cumul_des_bons($bdd,$produit,$poids_sac,$navire,$destination){

$cumul_bon=$bdd->prepare(" SELECT be.id_enleve, nc.num_connaissement,nc.id_navire,dis.id_dis, sum(ls.poids_liv),sum(lm.poids_mo),sum(lb.poids_bal) from bon_enlevement as be  
 		left join livraison_sain as ls on ls.bl_fournisseur_liv= be.id_enleve
 		left join livraison_mouille as lm on lm.bl_fournisseur_mo= be.id_enleve
 		left join livraison_balayure as lb on lb.bl_fournisseur_bal= be.id_enleve
 		left join dispat as dis on dis.id_dis=be.id_dis_enleve
 		inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 		where dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");

 $cumul_bon->bindParam(1,$produit);
 	$cumul_bon->bindParam(2,$poids_sac);
 	$cumul_bon->bindParam(3,$navire);
 	$cumul_bon->bindParam(4,$destination);
 	$cumul_bon->execute();
 	return $cumul_bon; */

 	function cumul_des_bons($bdd,$produit,$poids_sac,$navire,$destination){

$cumul_bon=$bdd->prepare(" SELECT count(be.num_enleve), sum(be.poids_enleve), nc.num_connaissement,nc.id_navire,dis.id_dis from bon_enlevement as be  
 		
 		left join dispat as dis on dis.id_dis=be.id_dis_enleve
 		inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 		where dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");

 $cumul_bon->bindParam(1,$produit);
 	$cumul_bon->bindParam(2,$poids_sac);
 	$cumul_bon->bindParam(3,$navire);
 	$cumul_bon->bindParam(4,$destination);
 	$cumul_bon->execute();
 	return $cumul_bon;
 }

  function res4($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire   FROM dispat as dis
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=nc.id_banque
                 

                  where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=?");             
            $res4->bindParam(1,$produit);
             $res4->bindParam(2,$poids_sac);
             $res4->bindParam(3,$navire);
             $res4->bindParam(4,$destination);
        $res4->execute();
        return $res4;
      }

       function entrepot($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT dis.id_dis, tr.id_transfert,dt.id_transfertD, mg.mangasin,mg.id,nav.navire,nc.num_connaissement, nc.id_navire from dispat as dis 


                 
                 LEFT JOIN dispat_transfert as dt on dt.id_dis_transfertD=dis.id_dis
                 
                 LEFT join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 left join mangasin as mg  ON (
        CASE
            WHEN dt.id_dis_transfertD !='NULL'  THEN dt.id_nouvelle_destinationD = mg.id 
        ELSE mg.id = dis.id_mangasin
 
        END
    )
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                     
                 where mg.id_mangasinier=? OR dt.id_mangasinier_transfert=? group by nav.id; ");             
           $res4->bindParam(1,$_SESSION['id']);
              $res4->bindParam(2,$_SESSION['id']);
              $res4->execute();
        $res4->execute();
        return $res4;
      }
 ?>
<?php 
function navire($bdd){
	$navire=$bdd->query("SELECT navire, eta,etb,id from navire_deb");
	return $navire;
}

function mangasin($bdd){
	$mangasin=$bdd->query("SELECT mangasin, id from mangasin");
	return $mangasin;
}

function connaissement($bdd,$id_navire){
	$connaissement=$bdd->prepare("SELECT nc.id_navire,nc.num_connaissement, dis.*,p.*,mg.mangasin from dispat as dis
		inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
		inner join produit_deb as p on p.id=dis.id_produit
		inner join mangasin as mg on mg.id=dis.id_mangasin
		where nc.id_navire=? ");
	$connaissement->bindParam(1,$id_navire);
	$connaissement->execute();
	return $connaissement;
}

 function choix_du_navire_transfert($bdd,$a){
$naviress=$bdd->prepare("SELECT dis.*, mg.mangasin,nav.navire,nc.id_navire,user.id_sim_user from dispat as dis 
                  
                 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? and dis.demande_transfert=1 group by nc.id_navire");
              $naviress->bindParam(1,$a);
              $naviress->execute();
              return $naviress;

    } 




/* function choix_produit_transfert($bdd,$navire,$id_mangasinier){
     $liste_produit = $bdd->prepare("SELECT dis.*, mg.mangasin,nav.navire,nc.id_navire,nc.num_connaissement,user.id_sim_user,p.* from dispat as dis 
                  
                 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                
                 inner join produit_deb as p on p.id=dis.id_produit
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? and nc.id_navire=? and dis.demande_transfert=1 group by dis.id_produit,dis.poids_kg ");
      $liste_produit->bindParam(1,$id_mangasinier);
       $liste_produit->bindParam(2,$navire);
        
      $liste_produit->execute();
      return $liste_produit;

  } */


  function choix_produit_transfert($bdd,$navire,$id_mangasinier){
     $liste_produit = $bdd->prepare("SELECT dis.*, mg.mangasin,nav.navire,nc.id_navire,nc.num_connaissement,user.id_sim_user,p.*,tr.* from dispat as dis 
                  
                 inner join transfert as tr on tr.id_dis_transfert=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on tr.id_nouvelle_destination=mg.id
                
                 inner join produit_deb as p on p.id=dis.id_produit
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join simar_user as user on user.id_sim_user=tr.id_session_mangasinier
                 where tr.id_session_mangasinier=? and nc.id_navire=? and dis.demande_transfert=1 group by dis.id_produit,dis.poids_kg ");
      $liste_produit->bindParam(1,$id_mangasinier);
       $liste_produit->bindParam(2,$navire);
        
      $liste_produit->execute();
      return $liste_produit;

  } 

  function res4($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire,nc.num_connaissement FROM dispat as dis  
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
      inner join produit_deb as p on dis.id_produit=p.id 
      inner join navire_deb as nav on nc.id_navire=nav.id 
      inner join client as cli on dis.id_client=cli.id 
      inner join mangasin as mang on mang.id=dis.id_mangasin 
      left join banque as b on b.id=nc.id_banque where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=? and dis.demande_transfert=1 ");             
            $res4->bindParam(1,$produit);
             $res4->bindParam(2,$poids_sac);
             $res4->bindParam(3,$navire);
             $res4->bindParam(4,$destination);
        $res4->execute();
        return $res4;
      }

  
   /*   function entrepot_transferer($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare("SELECT nav.navire,mang.mangasin,  dis.*,nc.id_navire,nc.num_connaissement,tr.* FROM dispat as dis  
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
      inner join produit_deb as p on dis.id_produit=p.id 
      inner join navire_deb as nav on nc.id_navire=nav.id 
      inner join client as cli on dis.id_client=cli.id 
      inner join mangasin as mang on mang.id=dis.id_mangasin 
       where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=? and dis.demande_transfert=1 ");             
            $res4->bindParam(1,$produit);
             $res4->bindParam(2,$poids_sac);
             $res4->bindParam(3,$navire);
             $res4->bindParam(4,$destination);
        $res4->execute();
        return $res4;
      } */


   function declaration($bdd,$produit,$poids_sac,$navire,$destination){
	$connaissement=$bdd->prepare("SELECT p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire,nc.num_connaissement,dt.* FROM dispat as dis inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
		inner join produit_deb as p on dis.id_produit=p.id 
		inner join navire_deb as nav on nc.id_navire=nav.id 
		inner join client as cli on dis.id_client=cli.id 
		inner join mangasin as mang on mang.id=dis.id_mangasin
	      inner join declaration_transfert as dt on dt.id_bl_transfert=dis.id_dis
	 left join banque as b on b.id=nc.id_banque where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=? and dis.demande_transfert=1 ");             
            $connaissement->bindParam(1,$produit);
            $connaissement->bindParam(2,$poids_sac);
            $connaissement->bindParam(3,$navire);
            $connaissement->bindParam(4,$destination);
            $connaissement->execute();
	return $connaissement;
}  

 


/* function afficher_infos($bdd,$produit,$poids_sac,$navire,$destination){
    $infos= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire   FROM dispat as dis
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=nc.id_banque
                 

                  where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=? group by dis.id_produit,dis.poids_kg, dis.id_mangasin");             
           $infos->bindParam(1,$produit);
            $infos->bindParam(2,$poids_sac);
             $infos->bindParam(3,$navire);
             $infos->bindParam(4,$destination);
       $infos->execute();
        return $infos;
      } */
       
 function entrepot_a_transferer($bdd,$nouvelle_destination){
  $new_destination=$bdd->prepare("SELECT mangasin from mangasin where id=?");
  $new_destination->bindParam(1,$nouvelle_destination);
  $new_destination->execute();
  return $new_destination;
}
 ?>


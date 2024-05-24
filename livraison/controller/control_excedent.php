<?php 
// CONTROLE DES DECLARATIONS, RELACHES, BON FOURNISSEUR
//SI L'UN D'ENTRES EUX EST EN EXCES LE CONTROLLEUR BLOC L'INSERTION

//REQUETE DES POIDS DEC REL BON

function poids_declaration($bdd,$dec){
	$poids_declaration=$bdd->prepare("SELECT poids_decliv from declaration_sortie WHERE id_decliv=?");
	$poids_declaration->bindParam(1,$dec);
	$poids_declaration->execute();
	return $poids_declaration;
}
/*
function poids_relache($bdd,$rel){
	$poids_relache=$bdd->prepare("SELECT quantite from numero_relache WHERE id_relache=?");
	$poids_relache->bindParam(1,$rel);
	$poids_relache->execute();
	return $poids_relache;
} */

function poids_bl_fournisseur($bdd,$bl_fournisseur){
	$poids_bl_fournisseur=$bdd->prepare("SELECT quantite from bon WHERE id_bon=?");
	$poids_bl_fournisseur->bindParam(1,$bl_fournisseur);
	$poids_bl_fournisseur->execute();
	return $poids_bl_fournisseur;
}


//REQUETES SOMMES DES POIDS LIVRES POUR VERIFICATION DE LA DECLARATION

function poids_livraison_sain($bdd,$dec){
	$poids_livraison_sain=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE dec_liv=? and statut='sain' ");
	$poids_livraison_sain->bindParam(1,$dec);
	$poids_livraison_sain->execute();
	return $poids_livraison_sain;
}

function poids_livraison_mouille($bdd,$dec){
	$poids_livraison_mouille=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE dec_liv=? and statut='mouille' ");
	$poids_livraison_mouille->bindParam(1,$dec);
	$poids_livraison_mouille->execute();
	return $poids_livraison_mouille;
}

function poids_livraison_balayure($bdd,$dec){
	$poids_livraison_balayure=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE dec_liv=? and statut='balayure' ");
	$poids_livraison_balayure->bindParam(1,$dec);
	$poids_livraison_balayure->execute();
	return $poids_livraison_balayure;
}

//REQUETES SOMMES DES POIDS LIVRES POUR VERIFICATION DE LA DECLARATION

function poids_rel_livraison_sain($bdd,$rel){
	$poids_rel_livraison_sain=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE relache_liv=?");
	$poids_rel_livraison_sain->bindParam(1,$rel);
	$poids_rel_livraison_sain->execute();
	return $poids_rel_livraison_sain;
}

function poids_rel_livraison_mouille($bdd,$rel){
	$poids_rel_livraison_mouille=$bdd->prepare("SELECT sum(poids_mo) from livraison_mouille WHERE relache_mo=?");
	$poids_rel_livraison_mouille->bindParam(1,$rel);
	$poids_rel_livraison_mouille->execute();
	return $poids_rel_livraison_mouille;
}

function poids_rel_livraison_balayure($bdd,$rel){
	$poids_rel_livraison_balayure=$bdd->prepare("SELECT sum(poids_bal) from livraison_balayure WHERE relache_bal=?");
	$poids_rel_livraison_balayure->bindParam(1,$rel);
	$poids_rel_livraison_balayure->execute();
	return $poids_rel_livraison_balayure;
}




function poids_bl_livraison_sain($bdd,$bl_fournisseur){
	$poids_bl_livraison_sain=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE bl_fournisseur_liv=? and statut='sain' ");
	$poids_bl_livraison_sain->bindParam(1,$bl_fournisseur);
	$poids_bl_livraison_sain->execute();
	return $poids_bl_livraison_sain;
}

function poids_bl_livraison_mouille($bdd,$bl_fournisseur){
	$poids_bl_livraison_mouille=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE bl_fournisseur_liv=? and statut='mouille' ");
	$poids_bl_livraison_mouille->bindParam(1,$bl_fournisseur);
	$poids_bl_livraison_mouille->execute();
	return $poids_bl_livraison_mouille;
}

function poids_bl_livraison_balayure($bdd,$bl_fournisseur){
	$poids_bl_livraison_balayure=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain WHERE bl_fournisseur_liv=? and statut='balayure' ");
	$poids_bl_livraison_balayure->bindParam(1,$bl_fournisseur);
	$poids_bl_livraison_balayure->execute();
	return $poids_bl_livraison_balayure;
}

 /*  function relache_ou_non($bdd,$c){

         $cherche_relache= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=dis.id_banque_dis
                 

                   WHERE dis.id_dis=? ");
        $cherche_relache->bindParam(1,$c);
        $cherche_relache->execute();
        return $cherche_relache;
       }
       */

       function relache_ou_non($bdd,$produit,$poids_sac,$navire,$destination){

         $cherche_relache= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,b.*,nc.id_navire   FROM dispat as dis
              inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                left join banque as b on b.id=nc.id_banque
                 

                  where dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=? and dis.id_mangasin=?");             
            $cherche_relache->bindParam(1,$produit);
             $cherche_relache->bindParam(2,$poids_sac);
             $cherche_relache->bindParam(3,$navire);
             $cherche_relache->bindParam(4,$destination);
             $cherche_relache->execute();
        return $cherche_relache;
       }

       function statu_relache($bdd,$rel){
       	$statu=$bdd->prepare("SELECT status from numero_relache  
       		 where id_dis_relache=?
       		");
       	$statu->bindParam(1,$rel);
       	$statu->execute();
       	return $statu;
       }
 ?>
  <?php

  /*     function declaration_livres_sain($bdd,$c){
   $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();
         return $choose_dec;
       } */


    function declaration_livres_sain($bdd,$produit,$poids_sac,$navire,$destination){
   $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,ex.id_trans_reelle  from declaration_sortie as dc 
          left join transit_extends as ex on ex.id_trans_extends=dc.id_dec_entrant
          left join dispat as dis on dis.id_dis=ex.id_bl_extends
          left join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and statut!='' group by dc.id_decliv ");
  $choose_dec->bindParam(1,$produit);
        $choose_dec->bindParam(2,$poids_sac);
        $choose_dec->bindParam(3,$navire);
         $choose_dec->bindParam(4,$destination);
       $choose_dec->execute();
         return $choose_dec;
       }

/*
   function  declaration_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination){
          $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,ex.id_trans_reelle  from declaration_sortie as dc 
          left join transit_extends as ex on ex.id_trans_extends=dc.id_dec_entrant
          left join dispat as dis on dis.id_dis=ex.id_bl_extends
          left join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and statut='mouille' group by dc.id_decliv ");
  $choose_dec2->bindParam(1,$produit);
        $choose_dec2->bindParam(2,$poids_sac);
        $choose_dec2->bindParam(3,$navire);
         $choose_dec2->bindParam(4,$destination);
       $choose_dec2->execute();
         return $choose_dec2;
       }
      
     function  declaration_livres_balayure($bdd,$produit,$poids_sac,$navire,$destination){
         $choose_dec3=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,ex.id_trans_reelle  from declaration_sortie as dc 
          left join transit_extends as ex on ex.id_trans_extends=dc.id_dec_entrant
          left join dispat as dis on dis.id_dis=ex.id_bl_extends
          left join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv 
  
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and statut='balayure' group by dc.id_decliv ");
  $choose_dec3->bindParam(1,$produit);
        $choose_dec3->bindParam(2,$poids_sac);
        $choose_dec3->bindParam(3,$navire);
         $choose_dec3->bindParam(4,$destination);
       $choose_dec3->execute();
         return $choose_dec3; 
       
       } 
       
*/

      
/*
    function  relache_livres_sain($bdd,$produit,$poids_sac,$navire,$destination){
       $choose_rel=$bdd->prepare("SELECT nr.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,b.banque from numero_relache as nr
        left join livraison_sain as liv_sain on liv_sain.relache_liv=nr.id_relache  
        inner join dispat as dis on dis.id_dis=nr.id_dis_relache 
        inner join numero_connaissement as nc on nc.id_connaissement=nr.id_connaissement 
        
        inner join banque as b on b.id=nc.id_banque
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  group by nr.id_relache");
        $choose_rel->bindParam(1,$produit);
        $choose_rel->bindParam(2,$poids_sac);
        $choose_rel->bindParam(3,$navire);
         $choose_rel->bindParam(4,$destination);
         $choose_rel->execute();
         return $choose_rel;
       }  */
        /*
     function  relache_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination){
         $choose_rel2=$bdd->prepare("SELECT nr.*, sum(liv_mouille.poids_mo),nc.id_navire,dis.id_dis,b.banque from numero_relache as nr 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=nr.id_relache 
    
       
       inner join dispat as dis on dis.id_dis=nr.id_dis_relache 
        inner join numero_connaissement as nc on nc.id_connaissement=nr.id_connaissement 
        
        inner join banque as b on b.id=nc.id_banque
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  group by nr.id_dis_relache");
        $choose_rel2->bindParam(1,$produit);
        $choose_rel2->bindParam(2,$poids_sac);
        $choose_rel2->bindParam(3,$navire);
         $choose_rel2->bindParam(4,$destination);
         $choose_rel2->execute();
         return $choose_rel2;
       }  */

    /*
      function  relache_livres_sain($bdd,$produit,$poids_sac,$navire,$destination){
         $choose_rel=$bdd->prepare("SELECT br.*,rel.*,bd.*,liv.statut, sum(liv.poids_liv) ,nc.id_navire,dis.id_dis, b.banque from bon_relache as br
          left join livraison_sain as liv on liv.relache_liv=br.id_bon_relache
          inner join relaches as rel on rel.id_relache=br.id_relache
          inner join bon_dispat as bd on bd.id_bon_dispat=br.id_bon_dispat_rel
      
       inner join dispat as dis on dis.id_dis=bd.id_dis 
        inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
        
        inner join banque as b on b.id=nc.id_banque
        WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?   group by br.id_bon_relache");
         $choose_rel->bindParam(1,$produit);
         $choose_rel->bindParam(2,$poids_sac);
         $choose_rel->bindParam(3,$navire);
          $choose_rel->bindParam(4,$destination);
          $choose_rel->execute();
         return  $choose_rel;
       } */


        
      

/*
   function  bon_livres_sain($bdd,$produit,$poids_sac,$navire,$destination){
       $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,b.banque  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
          left join dispat as dis on dis.id_dis=bon.id_dis_enleve
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join banque as b on b.id=nc.id_banque
    
          WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by bon.id_enleve");
          $choose_bon->bindParam(1,$produit);
        $choose_bon->bindParam(2,$poids_sac);
        $choose_bon->bindParam(3,$navire);
         $choose_bon->bindParam(4,$destination);
         $choose_bon->execute();
         return $choose_bon; 
       } */

        function  bon_livres_sain($bdd,$produit,$poids_sac,$navire,$destination){
       $choose_bon=$bdd->prepare("SELECT bn.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,b.banque  from bon as bn
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bn.id_bon
          
          left join dispat as dis on dis.id_dis=bn.bon_id_dis
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join banque as b on b.id=nc.id_banque
    
          WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");
          $choose_bon->bindParam(1,$produit);
        $choose_bon->bindParam(2,$poids_sac);
        $choose_bon->bindParam(3,$navire);
         $choose_bon->bindParam(4,$destination);
         $choose_bon->execute();
         return $choose_bon; 
       }

       /*
         
     function  bon_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination){     
          $choose_bon2=$bdd->prepare("SELECT bn.*,bd.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,b.banque  from bon_dispat as bd
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bd.id_bon_dispat
          left join bon as bn on bn.id_bon=bd.id_bon
          left join dispat as dis on dis.id_dis=bd.id_dis
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join banque as b on b.id=nc.id_banque
    
          WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and statut='mouille' group by bn.id_bon");
          $choose_bon2->bindParam(1,$produit);
        $choose_bon2->bindParam(2,$poids_sac);
        $choose_bon2->bindParam(3,$navire);
         $choose_bon2->bindParam(4,$destination);
         $choose_bon2->execute();
         return $choose_bon2;
       }

     function  bon_livres_balayure($bdd,$produit,$poids_sac,$navire,$destination){     
          $choose_bon3=$bdd->prepare("SELECT bn.*,bd.*, sum(liv_sain.poids_liv),nc.id_navire,dis.id_dis,b.banque  from bon_dispat as bd
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bd.id_bon_dispat
          left join bon as bn on bn.id_bon=bd.id_bon
          left join dispat as dis on dis.id_dis=bd.id_dis
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
          left join banque as b on b.id=nc.id_banque
    
          WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and statut='balayure' group by bn.id_bon");
          $choose_bon3->bindParam(1,$produit);
        $choose_bon3->bindParam(2,$poids_sac);
        $choose_bon3->bindParam(3,$navire);
         $choose_bon3->bindParam(4,$destination);
         $choose_bon3->execute();
         return $choose_bon3;
       }  
       */ 

       function relache_simar($bdd){
        $relache_simar=$bdd->query("select id_rel, num_rel from relache where num_rel='depassement' ");
        return $relache_simar;
       }

       function identifier_type_relache($bdd,$rel){
        $identifier=$bdd->prepare("select num_rel from relache where id_rel=?");
        $identifier->bindParam(1,$rel);
        $identifier->execute();
        return $identifier;
       }

       function depassement($bdd){
        $depassement=$bdd->query("SELECT * from depassement_relache");
        return $depassement;
       }

    

        ?>
<?php 
 //ma requete
function type_de_navire($bdd,$navire){
  $type_de_navire=$bdd->prepare('SELECT type from navire_deb where id=?');
  $type_de_navire->bindParam(1,$navire);
  $type_de_navire->execute();
  return $type_de_navire;
}

function tare_sac($bdd,$produit,$poids_sac,$navire,$destination,$client){
     $my_tare=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
     $my_tare->bindParam(1,$produit);
     $my_tare->bindParam(2,$poids_sac);
     $my_tare->bindParam(3,$navire);
     $my_tare->bindParam(4,$destination);
     $my_tare->bindParam(5,$client);
     $my_tare->execute();
     return $my_tare;
}


 function  afficher_transfert_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),cam.*,nc.*,dch.cales,dch.id_dec,rem.*,det.*,bd.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                left join detail_chargement as det on det.register_manif_id=manif.id_register_manif
                left join bon_debarquement as bd on bd.id_bon=manif.id_bon_deb
                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->execute();
        return $affiche;
      }


 function  afficher_transfert_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),sum(manif.poids_brut), sum(manif.poids_brut),sum(manif.tare_vehicule), cam.*,nc.*,dch.cales,dch.id_dec,rem.*,det.*,bd.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id

               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                left join detail_chargement as det on det.register_manif_id=manif.id_register_manif
                left join bon_debarquement as bd on bd.id_bon=manif.id_bon_deb
                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->bindParam(6,$client);
        $affiche->execute();
        return $affiche;
      }


 function  afficher_transfert_deb_vrac_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),sum(manif.poids_brut), sum(manif.poids_brut),sum(manif.tare_vehicule), cam.*,nc.*,dch.cales,dch.id_dec,rem.*,det.*,bd.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id

               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                left join detail_chargement as det on det.register_manif_id=manif.id_register_manif
                left join bon_debarquement as bd on bd.id_bon=manif.id_bon_deb
                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=? and manif.dates=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->bindParam(6,$client);
        $affiche->bindParam(7,$date_filtre);
        $affiche->execute();
        return $affiche;
      }

      function  afficher_transfert_deb_vrac_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$cale_filtre){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),sum(manif.poids_brut), sum(manif.poids_brut),sum(manif.tare_vehicule), cam.*,nc.*,dch.cales,dch.id_dec,rem.*,det.*,bd.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id

               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                left join detail_chargement as det on det.register_manif_id=manif.id_register_manif
                left join bon_debarquement as bd on bd.id_bon=manif.id_bon_deb
                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?  and manif.cale=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->bindParam(6,$client);
        $affiche->bindParam(7,$cale_filtre);
        $affiche->execute();
        return $affiche;
      }



        function  afficher_transfert_deb_vrac_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$declaration_filtre){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,d.*, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),sum(manif.poids_brut), sum(manif.poids_brut),sum(manif.tare_vehicule), cam.*,nc.*,dch.cales,dch.id_dec,rem.*,det.*   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on dis.id_produits=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id

               
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                left join remorque as rem on rem.id_remorque=manif.remorque_id
                left join detail_chargement as det on det.register_manif_id=manif.id_register_manif
                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' and manif.statut=? and nc.id_client=?  and manif.id_declaration=?  group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->bindParam(6,$client);
        $affiche->bindParam(7,$declaration_filtre);
        $affiche->execute();
        return $affiche;
      }




     
function  afficher_facture($bdd,$navire){
     $affiche = $bdd->prepare("SELECT nav.navire,nav.type,nav.id as navid, sum(manif.sac),sum(manif.poids),cam.id_camions,cam.id_trans,trp.*,manif.id_navire  FROM transfert_debarquement as manif 
            
                

                inner join navire_deb as nav on nav.id=manif.id_navire
                inner join camions as cam on cam.id_camions=manif.camions 

                inner join transporteur as trp on cam.id_trans=trp.id
               
               
                

                   WHERE  manif.id_navire=? group by trp.id ");
        

        $affiche->bindParam(1,$navire);

        $affiche->execute();
        return $affiche;
      }


function  afficher_facture_total($bdd,$navire){
     $affiche_total = $bdd->prepare("SELECT nav.navire,nav.type,nav.id as navid, sum(manif.sac),sum(manif.poids),cam.id_camions,cam.id_trans,trp.*,manif.id_navire   FROM transfert_debarquement as manif 
            
                

                inner join navire_deb as nav on nav.id=manif.id_navire
                inner join camions as cam on cam.id_camions=manif.camions 

                inner join transporteur as trp on cam.id_trans=trp.id
               
               
                

                   WHERE  manif.id_navire=?   ");
        

        $affiche_total->bindParam(1,$navire);

        $affiche_total->execute();
        return $affiche_total;
      }




  function resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client){

$resfiltre =$bdd->prepare("SELECT nav.type,dis.id_dis,dis.poids_kgs,dis.des_douane, nc.*,d.* FROM dispats as dis
                inner join declaration as d on d.id_bl=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join navire_deb as nav on nc.id_navire=nav.id 
                   WHERE nc.id_navire=? and dis.id_produits=? AND dis.poids_kgs=? AND dis.id_mangasin=? and nc.id_client=? ");
        $resfiltre->bindParam(1,$navire);
         $resfiltre->bindParam(2,$produit);
          $resfiltre->bindParam(3,$poids_sac);
           $resfiltre->bindParam(4,$destination);
           $resfiltre->bindParam(5,$client);
        $resfiltre->execute();
        return $resfiltre;
      }

function filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client){

        $filtreColonne= $bdd->prepare("SELECT nav.type,dis.*, nc.*,d.* FROM dispats as dis
                 inner join declaration as d on d.id_bl=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join navire_deb as nav on nc.id_navire=nav.id 
                   WHERE nc.id_navire=? and dis.id_produits=? AND dis.poids_kgs=? AND dis.id_mangasin=? and nc.id_client=? ");
        $filtreColonne->bindParam(1,$navire);
         $filtreColonne->bindParam(2,$produit);
          $filtreColonne->bindParam(3,$poids_sac);
           $filtreColonne->bindParam(4,$destination);
           $filtreColonne->bindParam(5,$client);
        $filtreColonne->execute();
        return $filtreColonne;
        } 

  //SACHERIE
function element_du_formulaire($bdd,$produit,$poids_sac,$navire,$destination){
   $element_form= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,nc.*,d.*   FROM dispats as dis 
                 left join declaration as d on d.id_declaration=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  ");
        $element_form->bindParam(1,$produit);
        $element_form->bindParam(2,$poids_sac);
        $element_form->bindParam(3,$navire);
        $element_form->bindParam(4,$destination);
        $element_form->execute();
        return $element_form;
}

function element_du_formulaire_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){
   $element_form= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,nc.*,d.*   FROM dispats as dis 
                 left join declaration as d on d.id_declaration=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE dis.id_produits=? and  dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=?  ");
        $element_form->bindParam(1,$produit);
        $element_form->bindParam(2,$poids_sac);
        $element_form->bindParam(3,$navire);
        $element_form->bindParam(4,$destination);
        $element_form->bindParam(4,$client);
        $element_form->execute();
        return $element_form;
}

function entete_des_tableaux($bdd,$produit,$poids_sac,$navire,$destination){
   $element_entete= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.des_douane,sum(dis.quantite_sac),sum(dis.quantite_poids), nc.num_connaissement,nc.poids_kg   FROM dispats as dis 
                 left join declaration as d on d.id_declaration=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by nc.id_produit,nc.poids_kg,dis.id_mangasin  ");
        $element_entete->bindParam(1,$produit);
        $element_entete->bindParam(2,$poids_sac);
        $element_entete->bindParam(3,$navire);
        $element_entete->bindParam(4,$destination);
        $element_entete->execute();
        return $element_entete;
}
   
 function  declaration($bdd,$produit,$poids_sac,$navire,$destination){

 $resdes= $bdd->prepare("SELECT d.*, dis.*, nc.*   FROM dispats as dis
               inner join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis


                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by d.id_declaration
                   ");
       
          $resdes->bindParam(1,$produit);
        $resdes->bindParam(2,$poids_sac);
       $resdes->bindParam(3,$navire);
        $resdes->bindParam(4,$destination);
        $resdes->execute();
        return $resdes;

    }

    function  declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){

 $resdes= $bdd->prepare("SELECT d.*, dis.*, nc.*,cli.client,cli.id  FROM dispats as dis
               inner join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join client as cli on cli.id=nc.id_client



                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? group by d.id_declaration
                   ");
       
          $resdes->bindParam(1,$produit);
        $resdes->bindParam(2,$poids_sac);
       $resdes->bindParam(3,$navire);
        $resdes->bindParam(4,$destination);
        $resdes->bindParam(5,$client);
        $resdes->execute();
        return $resdes;

    }

         function  suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration){

 $suivi_dec_select= $bdd->prepare("SELECT d.id_declaration, d.num_declaration,d.poids, dis.id_dis, nc.num_connaissement,sum(td.poids)   FROM declaration as d 
               left join transfert_debarquement as td on d.id_declaration=td.id_declaration
               left join dispats as dis on dis.id_dis=d.id_bl
               left join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis



                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and d.id_declaration=? group by d.id_declaration
                   ");
       
         $suivi_dec_select->bindParam(1,$produit);
        $suivi_dec_select->bindParam(2,$poids_sac);
       $suivi_dec_select->bindParam(3,$navire);
        $suivi_dec_select->bindParam(4,$destination);
        $suivi_dec_select->bindParam(5,$id_declaration);
        $suivi_dec_select->execute();
        return $suivi_dec_select;

    }


      function  suivi_declaration_select_vrac($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration,$client){

 $suivi_dec_select= $bdd->prepare("SELECT d.id_declaration, d.num_declaration,d.poids, dis.id_dis, nc.num_connaissement, cli.client,sum(td.poids)   FROM declaration as d 
               left join transfert_debarquement as td on d.id_declaration=td.id_declaration
               left join dispats as dis on dis.id_dis=d.id_bl
               left join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               left join client as cli on cli.id=nc.id_client


                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and d.id_declaration=? and nc.id_client=? group by d.id_declaration
                   ");
       
         $suivi_dec_select->bindParam(1,$produit);
        $suivi_dec_select->bindParam(2,$poids_sac);
       $suivi_dec_select->bindParam(3,$navire);
        $suivi_dec_select->bindParam(4,$destination);
        $suivi_dec_select->bindParam(5,$id_declaration);
         $suivi_dec_select->bindParam(6,$client);
        $suivi_dec_select->execute();
        return $suivi_dec_select;

    }


     function  suivi_declaration($bdd,$produit,$poids_sac,$navire,$destination){

 $suivi_dec= $bdd->prepare("SELECT d.num_declaration,d.poids, dis.id_dis, nc.num_connaissement,sum(td.poids)   FROM transfert_debarquement as td
               inner join declaration as d on d.id_declaration=td.id_declaration
               inner join dispats as dis on dis.id_dis=d.id_bl
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis


                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  group by d.id_declaration
                   ");
       
          $suivi_dec->bindParam(1,$produit);
        $suivi_dec->bindParam(2,$poids_sac);
       $suivi_dec->bindParam(3,$navire);
        $suivi_dec->bindParam(4,$destination);
        $suivi_dec->execute();
        return $suivi_dec;

    }

     function  suivi_declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){

 $suivi_dec= $bdd->prepare("SELECT d.num_declaration,d.poids, dis.id_dis, nc.num_connaissement,sum(td.poids),sum(td.poids_brut), sum(td.tare_vehicule)   FROM transfert_debarquement as td
               inner join declaration as d on d.id_declaration=td.id_declaration
               inner join dispats as dis on dis.id_dis=d.id_bl
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join client as cli on cli.id=td.id_client


                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=?  group by d.id_declaration
                   ");
       
          $suivi_dec->bindParam(1,$produit);
        $suivi_dec->bindParam(2,$poids_sac);
       $suivi_dec->bindParam(3,$navire);
        $suivi_dec->bindParam(4,$destination);
         $suivi_dec->bindParam(5,$client);
        $suivi_dec->execute();
        return $suivi_dec;

    }


    function affichage_suivi_declaration($bdd,$produit,$poids_sac,$navire,$destination,$client){
      $type_de_navire=type_de_navire($bdd,$navire);
      $type_nav=$type_de_navire->fetch();

      if($type_nav['type']=='SACHERIE'){
        $suivi_dec=suivi_declaration($bdd,$produit,$poids_sac,$navire,$destination); }
              if($type_nav['type']=='VRAQUIER'){
        $suivi_dec=suivi_declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client); }
        while($suivi_decs=$suivi_dec->fetch()){ ?>
        <tr style="text-align:center; vertical-align: middle; background:white;">
          <?php   $rob=$suivi_decs['poids']-$suivi_decs['sum(td.poids)']; ?>
            <td><?php echo $suivi_decs['num_declaration'] ?></td>
             <td><?php echo number_format($suivi_decs['poids'], 3,',',' ') ?></td>
             <td><?php echo number_format($suivi_decs['sum(td.poids)'], 3,',',' ') ?></td>
              <td><?php echo number_format($rob, 3,',',' ') ?></td>
        </tr>
<?php 
        }
    }
    ?>
    <?php  
/*
function  cale($bdd,$produit,$poids_sac,$navire,$destination){
    $rescale= $bdd->prepare("SELECT nc.*, dis.*,d.*  FROM dispats as dis
                        
                inner join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  ");
         $rescale->bindParam(1,$produit);
         $rescale->bindParam(2,$poids_sac);
         $rescale->bindParam(3,$navire);
         $rescale->bindParam(4,$destination); 
         $rescale->execute();
         return $rescale;
     } */

     function  cale($bdd,$produit,$poids_sac,$navire,$destination){
    $rescale= $bdd->prepare("SELECT nc.id_connaissement, dis.id_dis, dc.*  FROM dispats as dis
                        
               
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join declaration_chargement as dc on dc.id_produit=nc.id_produit and nc.poids_kg=dc.conditionnement and nc.id_navire=dc.id_navire

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by dc.cales ");
         $rescale->bindParam(1,$produit);
         $rescale->bindParam(2,$poids_sac);
         $rescale->bindParam(3,$navire);
         $rescale->bindParam(4,$destination); 
         $rescale->execute();
         return $rescale;
     }


     function  cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){
    $rescale= $bdd->prepare("SELECT nc.id_connaissement, dis.id_dis, dc.*,c.*  FROM dispats as dis
                        
               
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join declaration_chargement as dc on dc.categories_id=nc.categories_id_vrac
               inner join categories as c on c.id_categories=dc.categories_id

               

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? group by dc.cales ");
         $rescale->bindParam(1,$produit);
         $rescale->bindParam(2,$poids_sac);
         $rescale->bindParam(3,$navire);
         $rescale->bindParam(4,$destination); 
          $rescale->bindParam(5,$client); 
         $rescale->execute();
         return $rescale;
     }

/* function  afficher_sain($bdd,$produit,$poids_sac,$navire,$destination){
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,ex.id_trans_reelle,re.numero_declaration, manif.*, dis.*, sum(manif.sac),sum(manif.poids),cam.*   FROM register_manifeste as manif 
             inner join transit_extends as ex on manif.id_declaration=ex.id_trans_extends
                inner join dispatching as dis on ex.id_bl_extends=dis.id_dis
                inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                

                   WHERE dis.id_produit=? and  dis.poids_kg=? and dis.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' group by manif.dates, manif.id_register_manif with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->execute();
        return $affiche;
    } */

    function  afficher_sain($bdd,$produit,$poids_sac,$navire,$destination){
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,ex.id_trans_reelle,re.id_trans_reelle, manif.*,manif.id_declaration as la_declaration, dis.*, sum(manif.sac),sum(manif.poids),cam.*,nc.*,dc.*,dch.cales,dch.id_dec   FROM register_manifeste as manif 
             inner join transit_extends as ex on manif.id_declaration=ex.id_trans_extends
                inner join dispat as dis on ex.id_bl_extends=dis.id_dis
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends
                left join declaration_chargement as dch on dch.id_dec=manif.cale
                

                   WHERE dis.id_produit=? and  dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  and manif.bl!='ref' group by manif.dates, manif.id_register_manif  with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->execute();
        return $affiche;
      }


function  afficher_total_debarque($bdd,$produit,$poids_sac,$navire,$destination){
     $affiche_tdeb = $bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids)  FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?    ");
        
        
        
      $affiche_tdeb->bindParam(1,$produit);
        $affiche_tdeb->bindParam(2,$poids_sac);
        $affiche_tdeb->bindParam(3,$navire);
        $affiche_tdeb->bindParam(4,$destination);
     
        $affiche_tdeb->execute();
        return $affiche_tdeb;
      }

  function  afficher_total_debarque_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){
     $affiche_tdeb = $bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids)  FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join mangasin as mang on dis.id_mangasin=mang.id
                inner join client as cli on cli.id=nc.id_client
                
                

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=?   ");
        
        
        
      $affiche_tdeb->bindParam(1,$produit);
        $affiche_tdeb->bindParam(2,$poids_sac);
        $affiche_tdeb->bindParam(3,$navire);
        $affiche_tdeb->bindParam(4,$destination);
        $affiche_tdeb->bindParam(5,$client);
     
        $affiche_tdeb->execute();
        return $affiche_tdeb;
      }    


    function afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination){

    $afficheT = $bdd->prepare("SELECT nc.*,  sum(quantite_sac), sum(quantite_poids) from dispats as dis
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
      WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? ");   $afficheT->bindParam(1,$produit);
        $afficheT->bindParam(2,$poids_sac);
        $afficheT->bindParam(3,$navire);
        $afficheT->bindParam(4,$destination);
        $afficheT->execute();
        return $afficheT;
    }


        function afficher_sainT_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client){

    $afficheT = $bdd->prepare("SELECT nc.*,  sum(quantite_sac), sum(quantite_poids) from dispats as dis
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
    inner join client as cli on cli.id=nc.id_client
      WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? ");   $afficheT->bindParam(1,$produit);
        $afficheT->bindParam(2,$poids_sac);
        $afficheT->bindParam(3,$navire);
        $afficheT->bindParam(4,$destination);
        $afficheT->bindParam(5,$client);
        $afficheT->execute();
        return $afficheT;
    }




   // TOTAL DEBARQUES PAR LIGNE
    function afficher_total_debarque_par_ligne($bdd,$produit,$poids_sac,$navire,$destination,$id){
     $affiche_tdeb = $bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids)  FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and manif.id_register_manif<=?    ");
        
        
        
      $affiche_tdeb->bindParam(1,$produit);
        $affiche_tdeb->bindParam(2,$poids_sac);
        $affiche_tdeb->bindParam(3,$navire);
        $affiche_tdeb->bindParam(4,$destination);
        $affiche_tdeb->bindParam(5,$id);
     
        $affiche_tdeb->execute();
        return $affiche_tdeb;
      }

      



 function afficher_avaries_deb($bdd,$produit,$poids_sac,$navire){
     $avaries_deb=$bdd->prepare("SELECT  av.*, sum(av.sac_flasque),sum(av.sac_mouille), dc.* FROM avaries as av
    
     left join declaration_chargement as dc on dc.id_dec=av.cale_avaries
      WHERE dc.id_produit=? and dc.conditionnement=? and dc.id_navire=? and av.ref=1  GROUP BY av.date_avaries, av.id_avaries WITH ROLLUP");
 $avaries_deb->bindParam(1,$produit);
 $avaries_deb->bindParam(2,$poids_sac);
 $avaries_deb->bindParam(3,$navire);
 $avaries_deb->execute();
 return $avaries_deb;
}

function afficher_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination){
 $afficheAvaries = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av),ex.id_trans_reelle,re.id_trans_reelle, dis.*,dc.*,nc.*  FROM transfert_avaries as trav 
                
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
        
       

        $afficheAvaries->bindParam(1,$produit);
        $afficheAvaries->bindParam(2,$poids_sac);
        $afficheAvaries->bindParam(3,$navire);
        $afficheAvaries->bindParam(4,$destination);
        $afficheAvaries->execute();
        return $afficheAvaries;
      }
function entete_sain($bdd,$produit,$poids_sac,$navire,$destination){
  $entete=$bdd->prepare('SELECT nc.*, sum(dis.quantite_poids) from dispat as dis
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
    where  dis.id_produit=? and  dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?');
    $entete->bindParam(1,$produit);
        $entete->bindParam(2,$poids_sac);
        $entete->bindParam(3,$navire);
        $entete->bindParam(4,$destination);
        $entete->execute();
        return $entete;
}
    function affichage_sain($bdd,$produit,$poids_sac,$navire,$destination){

 ?>

  <?php $affiche=afficher_sain($bdd,$produit,$poids_sac,$navire,$destination);
   while($aff=$affiche->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php //echo  $f['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="" id="<?php echo $aff['id_register_manif'].'id_cale_rmS' ?>"><?php echo $aff['id_dec'] ?>GRGRR</span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span  id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['id_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_kg'] ?></span>
      <span  id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php echo $aff['id_produit'] ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
if($diff>=0){ ?>
  <td  style="color: green;"><?php echo "RAS" ?> 
  <?php// if($en_cours=$cherche_en_cours->fetch()){  ?><br>  <?php //} ?>
<?php //if($receptio=$cherche_reception->fetch()){  ?><br>  <?php //} ?></td>
<?php } ?>
<?php  
if($diff<0){ ?>
  <td   style="color: red;"><?php echo "EXCEDENT SUR DECLARATION / DESTINATION DE ".$diff.'T' ?></td>

<?php } ?>

<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"  data-role='update_register'   data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn" target="blank" href="fichier_debarquement_sain.php?id=<?php echo $aff['id_register_manif'] ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>

 <?php 
   function affichage_avaries_deb($bdd,$produit,$poids_sac,$navire){

         $avaries_deb=afficher_avaries_deb($bdd,$produit,$poids_sac,$navire);
      while($avrs=$avaries_deb->fetch()){

      if(!empty($avrs['date_avaries']) and !empty($avrs['id_avaries'])){
              $date=explode('-', $avrs['date_avaries']);
             $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
          <tr style="text-align: center; vertical-align: middle; background: white;">
<td id="<?php echo $avrs['id_avaries'].'date_avaries_deb' ?>"><?php echo $dt; ?></td>
          <td><?php //echo $avrs['produit'] ?> <?php //echo $avrs['qualite'] ?> <?php //echo $avrs['poids_sac_avaries'].' KGS'; ?></td>
          <td id="<?php echo $avrs['id_avaries'].'cale_avaries_deb' ?>"><?php echo $avrs['cales']; ?> </td>
              <span style="display: none;" id="<?php echo $avrs['id_avaries'].'id_cale_avaries_deb' ?>"><?php echo $avrs['id_dec']; ?></span>
               <span  id="<?php echo $avrs['id_avaries'].'conditionnement_avaries_deb' ?>"><?php echo $avrs['conditionnement']; ?> </span>
               <span  id="<?php echo $avrs['id_avaries'].'produit_avaries_deb' ?>"><?php echo $avrs['id_produit']; ?>
          </span>
          <td id="<?php echo $avrs['id_avaries'].'flasque_avaries_deb' ?>"><?php echo $avrs['sac_flasque']; ?></td>
          <td id="<?php echo $avrs['id_avaries'].'mouille_avaries_deb' ?>" ><?php echo $avrs['sac_mouille']; ?></td>
          <span  id="<?php echo $avrs['id_avaries'].'id_navire_avaries_deb' ?>" ><?php echo $avrs['id_navire']; ?></span>
           <span style="display: none;" id="<?php echo $avrs['id_avaries'].'id_dis_avaries_deb' ?>" ><?php echo $avrs['id_dis_av']; ?></span>
          <td> 
           <div style="display: flex; justify-content: center;">
           <a  class="fabtn" type=""   data-role='update_avaries_deb'  data-id="<?php echo $avrs['id_avaries']  ?>" > <i class="fa fa-edit " style="color: linear-gradient(-45deg, #004362, #0183d0) !important;" ></i></a>
           <a class="fabtn" type=""   onclick="delete_avaries_deb(<?php echo $avrs['id_avaries'] ?>)"   > <i class="fa fa-trash " style="color:linear-gradient(-45deg, #004362, #0183d0) !important;" ></i></a>
          </div>
         </td>
          

        </tr>
      <?php } 

      if(!empty($avrs['date_avaries']) and empty($avrs['id_avaries'])){
              $date=explode('-', $avrs['date_avaries']);
             $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
          <tr style="text-align: center; vertical-align: middle; background: rgb(91,72,0); color: white;">
<td style="color: white;" colspan="3"> TOTAL <?php echo $dt; ?></td>
         
          <td style="color: white;" ><?php echo $avrs['sum(av.sac_flasque)']; ?></td>
          <td style="color: white;"  ><?php echo $avrs['sum(av.sac_mouille)']; ?></td>
          <td style="color: white;"  ></td>
         
          

        </tr> 
      <?php } } 

  } //FERMETURE FUNCTION

   function affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination){

      ?>

       <?php 
        $afficheAvaries=afficher_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination);
       while($aff=$afficheAvaries->fetch()){ 
   $date=explode('-', $aff['date_tr_avaries']);
   $heure=explode(':', $aff['heure_tr']);
   $TotalSacAV=$aff['sum(trav.sac_flasque_tr_av)']+$aff['sum(trav.sac_mouille_tr_av)'];
   $TotalPoidsAV=$aff['sum(trav.poids_flasque_tr_av)']+$aff['sum(trav.poids_mouille_tr_av)'];
  
   //$diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
     
    ?>
    <tr style="text-align: center; font-weight: bold; " >
      <?php if(empty($aff['id_tr_avaries']) and !empty($aff['date_tr_avaries'])) {?>
      <td colspan="8" class="colaffnull" style="background:rgb(82,82,226); font-weight: bold; color:white;" >TOTAL <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   

    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.sac_flasque_tr_av)'], 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.sac_mouille_tr_av)'], 0,',',' ') ?></td>
     <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>
         <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($TotalSacAV, 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($TotalPoidsAV, 3,',',' ') ?></td>
             <td class="colaffnull" style="background:rgb(82,82,226); color: white;"></td>

    
    <?php if($aff['autre_destination_tr']!="AUCUNE"){ ?>
      <td class="colaffnull" style="background:rgb(82,82,226);"></td>
    <td class="colaffnull" style="background:rgb(82,82,226);"></td>
<?php } ?>


   
   <?php }



   else if(!empty($aff['id_tr_avaries']) and !empty($aff['date_tr_avaries'])) {?>

 <tr id="data_table_transfert_avaries">
    <td  id="<?php echo $aff['id_tr_avaries'].'date_av' ?>" ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'heure_av' ?>" ><?php echo $heure[0].':'.$heure[1] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'cale_av' ?>" ><?php echo 'A' ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'bl_av' ?>" ><?php echo $aff['bl_tr'] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'camion_av' ?>" ><?php echo $aff['num_camions'] ?></td>
     <span style="display: none;"   id="<?php echo $aff['id_tr_avaries'].'id_cale_av' ?>" ><?php echo $aff['id_dec'] ?></span>
    <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'id_camion_av' ?>" ><?php echo $aff['id_cam'] ?></span>
    <td class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'chauffeur_av' ?>" ><?php echo $aff['nom_chauffeur'] ?></td>
     <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'id_chauffeur_av' ?>" ><?php echo $aff['id_chauffeur_tr'] ?></span>
    
    <span id="<?php echo $aff['id_tr_avaries'].'disbl' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_dis_bl_tr'] ?></span>
     <span id="<?php echo $aff['id_tr_avaries'].'dis_bl_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_dis_bl_tr'] ?></span>
      <span id="<?php echo $aff['id_tr_avaries'].'poids_sac_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['poids_kg'] ?></span>
    <center>
    <td >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td  id="<?php echo $aff['id_tr_avaries'].'declaration_av' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span id="<?php echo $aff['id_tr_avaries'].'id_declaration_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_declaration_tr']; ?></span>
    <span id="<?php echo $aff['id_tr_avaries'].'id_destination_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_mangasin']; ?></span>
     <span id="<?php echo $aff['id_tr_avaries'].'id_navire_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_navire']; ?></span>
     <span id="<?php echo $aff['id_tr_avaries'].'id_produit_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_produit']; ?></span>


    <td id="<?php echo $aff['id_tr_avaries'].'sacf_av' ?>" class="colaffiche"><?php echo number_format($aff['sac_flasque_tr_av'], 0,',',' '); ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'poidsf_av' ?>" ><?php echo $aff['poids_flasque_tr_av'] ?></td>
  <td  id="<?php echo $aff['id_tr_avaries'].'sacm_av' ?>" ><?php echo number_format($aff['sac_mouille_tr_av'], 0,',',' '); ?></td>
    <td class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'poidsm_av' ?>" ><?php echo $aff['poids_mouille_tr_av'] ?></td>
    <td  style=""><?php echo number_format($TotalSacAV, 0,',',' ') ?></td>
    <td  style=""><?php echo number_format($TotalPoidsAV, 3,',',' ') ?></td>
    <td  style="vertical-align: middle; " >

<div style="display: flex; justify-content: center;">
  <a class="fabtn"  data-role='update_register_avaries'   data-id="<?php echo $aff['id_tr_avaries'];  ?>"    ><i class="fa fa-edit " ></i></a>
   <a target="blank" href="fichier_transfert_avaries.php?id=<?php echo $aff['id_tr_avaries'] ?>" id="<?php echo $aff['id_tr_avaries'] ?>"   class="fabtn1 "    > <i class="fa fa-folder  " ></i> </a>
     <a id="<?php echo $aff['id_tr_avaries'] ?>" type="submit"  class="fabtn1 "  onclick="deleteAvaries(<?php echo $aff['id_tr_avaries'] ?>)"  > <i class="fa fa-trash  " ></i> </a>
  </div>
  </td>
     
     <?php if($aff['autre_destination_tr']!="AUCUNE"){ ?>
      <td ><?php echo $aff['autre_destination_tr'] ?></td>
    <td ><?php echo $aff['destinataire_tr'] ?></td>
<?php } ?>
  
</tr>


  
  <?php } ?>

  <?php   if(empty($aff['id_tr_avaries']) and empty($aff['date_tr_avaries'])) { /*
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)'];*/ 
     $TotalSacAV2=$aff['sum(trav.sac_flasque_tr_av)']+$aff['sum(trav.sac_mouille_tr_av)'];
   $TotalPoidsAV2=$aff['sum(trav.poids_flasque_tr_av)']+$aff['sum(trav.poids_mouille_tr_av)'];?>
<tr style="font-weight: bold;">
  <td colspan="8" class="" style="background: black; color: white; font-weight: bold; text-align: center;" > TOTAL </td>
  <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($aff['sum(trav.sac_flasque_tr_av)'], 0,',',' '); ?> </td>
   <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($aff['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?> </td>
    <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($aff['sum(trav.sac_mouille_tr_av)'], 0,',',' '); ?> </td>
     <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($aff['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?> </td>
     <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($TotalSacAV2, 0,',',' '); ?> </td>
     <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" > <?php echo number_format($TotalPoidsAV2, 3,',',' '); ?> </td>
     <td  class="" style="background: black; color: white; font-weight: bold; text-align: center;" >  </td>
  </tr>
  
 

  <?php  }  ?>
<?php  }  ?>

<?php } // FERMETURE FUNCTION ?>

<?php  
 function affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre){
  $type_affichage=$bdd->prepare('SELECT type from navire_deb where id=?');
  $type_affichage->bindParam(1,$navire);
  $type_affichage->execute();

  $type_aff=$type_affichage->fetch();
 ?>

  <?php   if($type_aff['type']=='SACHERIE' and $date_filtre=='' and $cale_filtre=='' ){
   $affiche=afficher_transfert_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut);
 }
 if($type_aff['type']=='VRAQUIER' and $date_filtre=='' and $cale_filtre==''){
   $affiche=afficher_transfert_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
 }
  if($type_aff['type']=='VRAQUIER' and $date_filtre!=''){
   $affiche=afficher_transfert_deb_vrac_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre);
 }
   if($type_aff['type']=='VRAQUIER' and $cale_filtre!=''){
   $affiche=afficher_transfert_deb_vrac_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$cale_filtre);
 }



   while($aff=$affiche->fetch()){ 

    $id=$aff['id_register_manif'];

$affiche_tdeb= afficher_total_debarque_par_ligne($bdd,$produit,$poids_sac,$navire,$destination,$id);

$aff_tdeb=$affiche_tdeb->fetch();


   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

$rotation=$bdd->prepare("SELECT count(bl) from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and statut=? and dates=?  and id_register_manif<=?");

   $rotation->bindParam(1,$produit);
   $rotation->bindParam(2,$poids_sac);
   $rotation->bindParam(3,$destination);
   $rotation->bindParam(4,$navire);
   $rotation->bindParam(5,$statut);
   $rotation->bindParam(6,$aff['dates']);
   $rotation->bindParam(7,$aff['id_register_manif']);
   $rotation->execute();

   $rot=$rotation->fetch();


   $select_tare=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
     $select_tare->bindParam(1,$produit);
     $select_tare->bindParam(2,$poids_sac);
     $select_tare->bindParam(3,$navire);
     $select_tare->bindParam(4,$destination);
     $select_tare->bindParam(5,$client);
     $select_tare->execute();
     $sel_tare=$select_tare->fetch();




     $net_pont_bascule=$aff['poids_brut']-$aff['tare_vehicule'];
     
     if($aff['poids_brut']!=0){
     $net_marchand=$net_pont_bascule-$aff['sac']*$sel_tare['poids_tare_sac']/1000;
    
      
   }
     if($aff['poids_brut']==0){
    $net_marchand=0;
    
   }



   $som_net_pont_bascule=$aff['sum(manif.poids_brut)']-$aff['sum(manif.tare_vehicule)'];

   $som_net_marchand=$som_net_pont_bascule-$aff['sum(manif.sac)']*$sel_tare['poids_tare_sac']/1000;


  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
     <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($som_net_marchand, 3,',',' '); ?></td>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) { 
     

     ?>
     <tr class="ligne" <?php //echo $aff['id_register_manif'].'colonnebl' ?>  id='dernierEnregistrement' style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php echo  $rot['count(bl)'] ?></td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_cale_rm' ?>"><?php echo $aff['id_dec'] ?></span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'tel_rm' ?>" >
      <?php  echo $aff['num_telephone']; ?></td>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" ><?php echo $aff['num_telephone']; ?></span>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['la_declaration'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_client_rm' ?>"><?php echo $aff['id_client'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php if($type_aff['type']=='SACHERIE'){ echo $aff['poids_kg']; } ?><?php if($type_aff['type']=='VRAQUIER'){ echo $aff['poids_kgs']; } ?></span>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php if($type_aff['type']=='VRAQUIER'){ echo $aff['id_produits']; } ?><?php if($type_aff['type']=='SACHERIE'){ echo $aff['id_produit']; } ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'statut_rm' ?>"><?php echo $aff['statut'] ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'sac_cale_rm' ?>"><?php echo $aff['sac_cale'] ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'sac_reconditionne_rm' ?>"><?php echo $aff['sac_reconditionne'] ?></span>
           <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_detail_rm' ?>"><?php echo $aff['id_detail'] ?></span>
           <span style="display:none;" id="<?php echo $aff['id_register_manif'].'destinataire_rm' ?>" ><?php echo $aff['destinataire'] ?></span>

           <span style="display:none;" id="<?php echo $aff['id_register_manif'].'des_douane_rm' ?>" ><?php echo $aff['des_douane'] ?></span>
            <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_bon_rm' ?>" ><?php echo $aff['id_bon_deb'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
  <?php if($type_aff['type']=='SACHERIE'){ ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
  <?php } ?>
   <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </span>
    <td  ><?php echo $aff['ticket_pont']; ?></td>
     <td  ><?php echo number_format($net_marchand, 3,',',' '); ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_brut_rm' ?>" ><?php echo $aff['poids_brut'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'ticket_pont_rm' ?>" ><?php echo $aff['ticket_pont']; ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'tare_vehicule_rm' ?>" ><?php echo $aff['tare_vehicule']; ?></span>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td  ><?php echo $aff['destinataire'] ?></td>
<?php }
 ?>
  <td <?php if($aff['etat_reception']=='non'){  ?> style="color: red;" <?php } ?> <?php if($aff['etat_reception']=='oui'){  ?> style="color: green;" <?php } ?>  > <div style="" id='etat_recep'><?php if($aff['etat_reception']=='non'){ echo "NON RECEPTIONNE"; } if($aff['etat_reception']=='oui'){ echo "RECEPTIONNE";}  ?> <?php //echo $aff_tdeb['sum(manif.sac)']; ?> </div> </td>



<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div id="div_action<?php echo $aff['id_register_manif'] ?>" style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_register'  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn"  data-bs-toggle='modal'  data-bs-target="#recap<?php echo $aff['id_register_manif']  ?>"      >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>

<a class="fabtn"  name="modify"   data-role='update_poids_pont'  data-id_pont="<?php echo $aff['id_register_manif']  ?>"  title='ajouter poids pont'> <i class="fa fa-add " style="color: red;" ></i></a>

</div>

</td>
    
</td>
</form>





</tr>


<div class="modal fade" id="recap<?php echo $aff['id_register_manif']  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px !important;" >
    <div class="modal-content" style=" background: white; ">
      <div class="modal-header bg-white" style="border: none; background: white !important; ">
        <div class="container-fluid">
          <div class="row"> 
         <div class="col-lg-4">  
        <img class="logo" src="../assets/images/mylogo.ico" style="border-radius: 50px; width: 50%;">
        </div>
        <div class="col-lg-8">  
        <span style="color: red; font-weight: bold;">BORDEREAU DE <?php echo $aff['des_douane']; ?></span>
        </div>
        <div class="col-lg-4">  
        <h6>BL N <span style="color: red;">  <?php echo $aff['bl']; ?></span></h6>
        </div>
          <div class="col-lg-8">  
        <span style="color: black; font-weight: bold;" >DECLARATION: </span> 

        <span style="color: red; font-weight: bold;" > <?php echo $aff['num_declaration']; ?></span><br>
      </div> 
        <br>  
        <div class="col-lg-4">  
        <span class="detail_gauche" >DESTINATION : </span> 
        </div>
<div class="col-lg-8">
        <span class="detail_droite" > <?php echo $aff['mangasin']; ?></span><br>
      </div>  

      <div class="col-lg-4">  
        <span class="detail_gauche" >NAVIRE: </span> 
        </div>
<div class="col-lg-8">
        <span class="detail_droite" > <?php echo $aff['navire']; ?></span><br>
      </div>  

    

       <div class="col-lg-4">  
        <span class="detail_gauche" >CAMION: </span> 
        </div>
<div class="col-lg-8">
        <span class="detail_droite" > <?php echo $aff['num_camions']; ?></span><br>
      </div>

         <div class="col-lg-3">  
        <span class="detail_gauche" >CHAUFFEUR </span> 
        </div>
                 <div class="col-lg-3">  
        <span class="detail_droite" ><?php echo $aff['nom_chauffeur']; ?> </span> 
        </div>
<div class="col-lg-3">
        <span class="detail_gauche" > TEL</span>
      </div>   

      <div class="col-lg-3">  
        <span class="detail_" style="color: blue;" ><?php echo $aff['num_telephone']; ?> </span> 
        </div> 
        
        <div class="col-lg-4">  
        <span class="detail_gauche" >TRANSPORTEUR: </span> 
        </div> 
<div class="col-lg-8">
        <span class="detail_droite" ><?php echo $aff['nom']; ?></span><br>  
      </div></div> 
         <div class="row" style="border: solid; border-color: black;"> 
<div class="col-lg-3" style="border-right: solid; border-bottom: solid; border-color: black;">
        <span class="detail_gauche" > PRODUIT</span>
      </div>
       
<div class="col-lg-3" style="border-right: solid; border-bottom: solid; border-color: black;">
        <span class="detail_gauche" > CALE</span>
      </div>

      <div class="col-lg-3" style="border-right:  solid; border-bottom: solid; border-color: black;">
        <span class="detail_gauche"  > NBRE SAC</span>
      </div>
            <div class="col-lg-3" style=" border-bottom: solid; border-color: black;">
        <span class="detail_gauche"  > NET MARCHAND</span>
      </div>
      <div class="col-lg-3" style="border-right: solid; border-color: black; border-bottom: solid; border-color: black;">
        <span class="detail_droite" ><?php echo $aff['produit'] ?> <?php echo $aff['poids_kgs'].' KG' ?></span>
      </div>
      <div class="col-lg-3" style="border-right: solid; border-color: black; border-bottom: solid; border-color: black;">
        <span class="detail_droite" ><?php echo $aff['cale'] ?> <?php echo $aff['poids_kgs'].' KG' ?></span>
      </div>
      <div class="col-lg-3" style="border-right: solid; border-color: black; border-bottom: solid; border-color: black;">
        <span class="detail_droite" ><?php echo $aff['sac'] ?></span>
      </div>
            <div class="col-lg-3" style='border-bottom: solid; border-color: black;'>
        <span class="detail_droite" ><?php echo $net_marchand;  ?></span>
      </div>
      <div class="col-lg-12"><span style="color: black">DETAIL CHARGEMENT </span> </div>
      </div></div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            

        </center>
         
</div>
       
      <div class="modal-footer">
 
        
      </div>
    
  </div>
</div>
</div>







 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="15" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>
<?php 
 if($aff['type']=="VRAQUIER" ) { ?>
<td class="mytd" class="" colspan="3"  style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL NET MARCHAND = <span style="color:red;"><?php //echo number_format($aff['sum(manif.poids_brut)'], 3,',',' '); ?></span></td> <?php  } ?>

<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>





<?php  
 function affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
  $type_affichage=$bdd->prepare('SELECT type from navire_deb where id=?');
  $type_affichage->bindParam(1,$navire);
  $type_affichage->execute();

  $type_aff=$type_affichage->fetch();
 ?>

  <?php   if($type_aff['type']=='SACHERIE'){
   $affiche=afficher_transfert_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut);
 }

  if($type_aff['type']=='VRAQUIER'){
   $affiche=afficher_transfert_deb_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
 }

   while($aff=$affiche->fetch()){ 

    $id=$aff['id_register_manif'];

$affiche_tdeb= afficher_total_debarque_par_ligne($bdd,$produit,$poids_sac,$navire,$destination,$id);

$aff_tdeb=$affiche_tdeb->fetch();


   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

$rotation=$bdd->prepare("SELECT count(bl) from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and statut=? and dates=?  and id_register_manif<=?");

   $rotation->bindParam(1,$produit);
   $rotation->bindParam(2,$poids_sac);
   $rotation->bindParam(3,$destination);
   $rotation->bindParam(4,$navire);
   $rotation->bindParam(5,$statut);
   $rotation->bindParam(6,$aff['dates']);
   $rotation->bindParam(7,$aff['id_register_manif']);
   $rotation->execute();

   $rot=$rotation->fetch();

  /*  $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();*/

 /*       $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute(); */

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) {  

     ?>
     <tr class="ligne" <?php //echo $aff['id_register_manif'].'colonnebl' ?>  id='dernierEnregistrement' style="text-align: center;  vertical-align: middle; "  >
    <td class="rot"   border="none"><?php echo  $rot['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_cale_rm' ?>"><?php echo $aff['id_dec'] ?></span>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cales'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['num_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['la_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php if($type_aff['type']=='SACHERIE'){ echo $aff['poids_kg']; } ?><?php if($type_aff['type']=='VRAQUIER'){ echo $aff['poids_kgs']; } ?></span>
      <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit_rm' ?>"><?php echo $aff['id_produit'] ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination_rm' ?>"><?php echo $aff['id_mangasin'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire_rm' ?>"><?php echo $aff['id_navire'] ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'statut_rm' ?>"><?php echo $aff['statut'] ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'sac_cale_rm' ?>"><?php echo $aff['sac_cale'] ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'sac_reconditionne_rm' ?>"><?php echo $aff['sac_reconditionne'] ?></span>
           <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_detail_rm' ?>"><?php echo $aff['id_detail'] ?></span>
           <span style="display:none;" id="<?php echo $aff['id_register_manif'].'destinataire_rm' ?>" ><?php echo $aff['destinataire'] ?></span>

           <span style="display:none;" id="<?php echo $aff['id_register_manif'].'des_douane_rm' ?>" ><?php echo $aff['des_douane'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>

     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td  ><?php echo $aff['destinataire'] ?></td>
<?php }
 ?>
  <td <?php if($aff['etat_reception']=='non'){  ?> style="color: red;" <?php } ?> <?php if($aff['etat_reception']=='oui'){  ?> style="color: green;" <?php } ?>  > <div style="" id='etat_recep'><?php if($aff['etat_reception']=='non'){ echo "NON RECEPTIONNE"; } if($aff['etat_reception']=='oui'){ echo "RECEPTIONNE";}  ?> <?php //echo $aff_tdeb['sum(manif.sac)']; ?> </div> </td>



<form>  
 <td id="cacher_cellule" style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_register'  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a  class="fabtn" target="blank" href="fichier_debarquement_sain.php?id=<?php echo $aff['id_register_manif'] ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
    $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['sum(quantite_sac)']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['sum(quantite_poids)']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>


 <?php  } // FERMETURE FUNCTION ?>









<?php  function bon($bdd,$produit,$poids_sac,$navire,$destination,$client){
       $bon=$bdd->prepare("SELECT bd.*,dis.id_dis from bon_debarquement as bd 
       /* inner join relache_debarquement as rd on rd.id_relache=bd.relache_id */
       inner join dispats as dis on dis.id_dis=bd.id_dis_bon
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        
          WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? 
                   ");
       
          $bon->bindParam(1,$produit);
        $bon->bindParam(2,$poids_sac);
       $bon->bindParam(3,$navire);
        $bon->bindParam(4,$destination);
        $bon->bindParam(5,$client);
        $bon->execute();
        return $bon;
} ?>


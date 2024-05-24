<?php 
//VERIFIER S'il existe un 
function Etat_relache($bdd,$produit,$poids_sac,$navire,$destination){
         $affiche = $bdd->prepare("SELECT  bn.*,er.*,rel.*,br.*,bd.*,dis.id_dis,nc.id_navire  FROM etat_relache as er  
                
             
            
             inner join bon_dispat as bd on bd.id_bon_dispat=er.id_bon_dispat
             inner join bon as bn on bd.id_bon=bn.id_bon
             inner join dispat as dis on dis.id_dis=bd.id_dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             
             inner join bon_relache  as br on br.id_bon_relache=er.id_bon_relache
             inner join relaches  as rel on rel.id_relache=br.id_relache
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?
  ");
         $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
      
      
        $affiche->execute();
        return $affiche;
      }
 //VERIFIER S'IL EXISTE AU MOINS UNE RELACHE   
        function Etat_relache_exact($bdd,$produit,$poids_sac,$navire,$destination,$id_bon){
         $affiche = $bdd->prepare("SELECT  bn.*,br.*,dis.id_dis,nc.id_navire  FROM bon_relache as br  
                
             
        
          
             inner join bon as bn on br.bon_id=bn.id_bon
             inner join dispat as dis on dis.id_dis=bn.bon_id_dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             
            
             
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and bn.id_bon=?
  ");
         $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
         $affiche->bindParam(5,$id_bon);
      
      
        $affiche->execute();
        return $affiche;
      } 
             
     //VERIFIER S'IL E   
      function verifier_etat_relache($bdd,$id_bon){
         $verif_rel = $bdd->prepare("SELECT  bn.*,er.*,br.*,count(bn.id_bon)  FROM etat_relache as er  
                
             inner join bon_relache as br  on br.id_bon_relache=er.bon_relache_id
             inner join bon as bn on bn.id_bon=br.bon_id
             
              WHERE br.bon_id=?
  ");
          $verif_rel->bindParam(1,$id_bon);

      
      
         $verif_rel->execute();
        return  $verif_rel;
      }

       function dernier_enregistrement($bdd,$id_bon){
         $dernier = $bdd->prepare("SELECT id_liv,poids_liv from livraison_sain  where bl_fournisseur_liv=? order by id_liv desc ");
         $dernier->bindParam(1,$id_bon);
         $dernier->execute();
         return $dernier;
       }
     
   /*  function quantite_relacher($bdd,$id_bon_relache){
         $qr = $bdd->prepare("SELECT sum(quantite_relacher) from etat_relache  where id_bon_relache=?   ");
        $qr->bindParam(1,$id_bon_relache);
        $qr->execute();
         return $qr;

       } */

       //PARTIE OU IL Y'A PLUSIEURS RELACHES ;METHODES FIFO
  function verifier_etat_Plusieurs($bdd,$produit,$poids_sac,$navire,$destination,$id_bon){
         $verif_rel2 = $bdd->prepare("SELECT  bn.*,er.*,br.*,dis.id_dis,nc.id_navire FROM etat_relache as er  
                
            
            
             inner join bon_relache as br on br.id_bon_relache=er.bon_relache_id
             inner join bon as bn on br.bon_id=bn.id_bon
             inner join dispat as dis on dis.id_dis=bn.bon_id_dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             
            
             
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? AND
              br.bon_id=? and er.restant_relache>0 order by er.id_etat_relache desc
  ");
                  $verif_rel2->bindParam(1,$produit);
        $verif_rel2->bindParam(2,$poids_sac);
        $verif_rel2->bindParam(3,$navire);
         $verif_rel2->bindParam(4,$destination);
         $verif_rel2->bindParam(5,$id_bon);
      
         $verif_rel2->execute();
        return  $verif_rel2;
      }

    /*  function verifier_etat_Second($bdd,$produit,$poids_sac,$navire,$destination,$id_bon,$id_bon_relache){
         $verif_rel3 = $bdd->prepare("SELECT  bn.*,er.*,br.*,dis.id_dis,nc.id_navire FROM etat_relache as er  
                
            
             inner join bon_relache  as br on br.id_bon_relache=er.bon_relache_id
            
             inner join bon as bn on bn.id_bon=br.bon_id
             inner join dispat as dis on dis.id_dis=bn.bon_id_dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             
            
             
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? AND
              er.bon_relache_id=? and er.restant_relache>0 and br.id_bon_relache!=? order by er.id_etat_relache desc
  ");
                  $verif_rel3->bindParam(1,$produit);
        $verif_rel3->bindParam(2,$poids_sac);
        $verif_rel3->bindParam(3,$navire);
         $verif_rel3->bindParam(4,$destination);
         $verif_rel3->bindParam(5,$id_bon);
          $verif_rel3->bindParam(6,$id_bon_relache);
      
         $verif_rel3->execute();
        return  $verif_rel3;
      } */


      function verifier_etat_Second($bdd,$produit,$poids_sac,$navire,$destination,$id_bon,$id_bon_relache){
         $verif_rel3 = $bdd->prepare("SELECT    bn.*,br.*,dis.id_dis,nc.id_navire FROM bon_relache as br  
                
            
             
            
             inner join bon as bn on bn.id_bon=br.bon_id
             inner join dispat as dis on dis.id_dis=bn.bon_id_dis
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             
            
             
              WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? AND
              br.bon_id=?  and br.id_bon_relache!=? order by br.id_bon_relache desc
  ");
                  $verif_rel3->bindParam(1,$produit);
        $verif_rel3->bindParam(2,$poids_sac);
        $verif_rel3->bindParam(3,$navire);
         $verif_rel3->bindParam(4,$destination);
         $verif_rel3->bindParam(5,$id_bon);
          $verif_rel3->bindParam(6,$id_bon_relache);
      
         $verif_rel3->execute();
        return  $verif_rel3;
      }


 ?>
<?php
      function cales($bdd,$navire){

 $cale=$bdd->prepare("SELECT dc.id_dec, dc.cales,sum(td.poids),sum(dc.poids), td.cale, td.poids_sac,td.id_produit, p.id,p.produit,p.qualite FROM declaration_chargement as dc 
  
  inner join transfert_debarquement as td on td.cale=dc.id_dec and td.id_navire=dc.id_navire
  inner join produit_deb as p on p.id=td.id_produit

         where dc.id_navire=? /*and td.dates=? */  group by dc.cales,p.produit,td.poids_sac with rollup ");
          $cale->bindParam(1,$navire);  
         // $cale->bindParam(2,$date_deb); 
          
          $cale->execute();
          return $cale;
          } 

          function deb_cale_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb){
               $deb_cale_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont=? and td.cale=? ");
               $deb_cale_24H->bindParam(1,$navire);
               $deb_cale_24H->bindParam(2,$id_produit);
               $deb_cale_24H->bindParam(3,$poids_sac);
               $deb_cale_24H->bindParam(4,$date_deb);
               $deb_cale_24H->bindParam(5,$cale_deb);
               $deb_cale_24H->execute();
               return $deb_cale_24H;
          }

               function rowspan($bdd,$navire){
               $rowspan=$bdd->prepare(" SELECT COUNT(*) AS nombre_de_lignes
             FROM (
    SELECT count(id_produit) AS count_id_produit
    FROM transfert_debarquement
    WHERE id_navire = ?
    GROUP BY id_produit, poids_sac
) AS subquery  ");
               $rowspan->bindParam(1,$navire);

               $rowspan->execute();
               return $rowspan;
          }

                         function rowspan_deb($bdd,$navire,$cale_deb){
               $rowspan_deb=$bdd->prepare(" SELECT COUNT(*) AS nombre_de_lignes
             FROM (
    SELECT count(id_produit) AS count_id_produit
    FROM transfert_debarquement
    WHERE id_navire = ? and cale=?
    GROUP BY id_produit, poids_sac
) AS subquery  ");
               $rowspan_deb->bindParam(1,$navire);
               $rowspan_deb->bindParam(2,$cale_deb);

               $rowspan_deb->execute();
               return $rowspan_deb;
          }

          function deb_cale_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb){
               $deb_cale_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont<=? and td.cale=? ");
               $deb_cale_TOT->bindParam(1,$navire);
               $deb_cale_TOT->bindParam(2,$id_produit);
               $deb_cale_TOT->bindParam(3,$poids_sac);
               $deb_cale_TOT->bindParam(4,$date_deb);
               $deb_cale_TOT->bindParam(5,$cale_deb);
               $deb_cale_TOT->execute();
               return $deb_cale_TOT;
          }
           
          function calcul_rob($bdd,$navire,$date_deb,$cale_deb){
               $calcul_rob=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner  join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?  and pb.date_pont<=? and td.cale=?  ");
               $calcul_rob->bindParam(1,$navire);
               $calcul_rob->bindParam(2,$date_deb);
               $calcul_rob->bindParam(3,$cale_deb);
               $calcul_rob->execute();
               return $calcul_rob;
          } // CALCUL A LA FOIS SOUS TOTAL DU TOTAL DEBARQUER
                    function calcul_rob_24h($bdd,$navire,$date_deb,$cale_deb){
              $calcul_rob_24h=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner  join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?  and pb.date_pont=? and td.cale=?  ");
               $calcul_rob_24h->bindParam(1,$navire);
               $calcul_rob_24h->bindParam(2,$date_deb);
               $calcul_rob_24h->bindParam(3,$cale_deb);
               $calcul_rob_24h->execute();
               return $calcul_rob_24h;
          } // CALCUL A LA FOIS SOUS TOTAL DU TOTAL DEBARQUER




          function tare_sac($bdd,$id_produit,$poids_sac,$navire){
     $my_tare=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? ');
     $my_tare->bindParam(1,$id_produit);
     $my_tare->bindParam(2,$poids_sac);
     $my_tare->bindParam(3,$navire);

     $my_tare->execute();
     return $my_tare;
}

function manifeste($bdd,$navire,$cale_manif){
  $manifeste=$bdd->prepare('SELECT sum(poids) from declaration_chargement where id_navire=? and cales=?');
  $manifeste->bindParam(1,$navire);
  $manifeste->bindParam(2,$cale_manif);
  $manifeste->execute();
  return $manifeste;
}

function manifeste_TOTAL($bdd,$navire){
  $manifeste_TOTAL=$bdd->prepare('SELECT sum(poids) from declaration_chargement where id_navire=?' );
  $manifeste_TOTAL->bindParam(1,$navire);
  
  $manifeste_TOTAL->execute();
  return $manifeste_TOTAL;
}


   function deb_cale_GEN24H($bdd,$navire,$date_deb){
               $deb_cale_GEN24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and  pb.date_pont=?  ");
               $deb_cale_GEN24H->bindParam(1,$navire);
               $deb_cale_GEN24H->bindParam(2,$date_deb);
              
               $deb_cale_GEN24H->execute();
               return $deb_cale_GEN24H;
          }

          function deb_cale_GENT($bdd,$navire,$date_deb){
               $eb_cale_GENT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and  pb.date_pont<=?  ");
               $eb_cale_GENT->bindParam(1,$navire);
               $eb_cale_GENT->bindParam(2,$date_deb);
              
               $eb_cale_GENT->execute();
               return $eb_cale_GENT;
          }
            



      function produit($bdd,$navire){

 $produit=$bdd->prepare("SELECT dc.id_dec, dc.cales,sum(td.poids),sum(dc.poids), td.cale, td.poids_sac,td.id_produit, p.id,p.produit,p.qualite FROM declaration_chargement as dc 
  
  left join transfert_debarquement as td on td.cale=dc.id_dec and td.id_navire=dc.id_navire
  left join produit_deb as p on p.id=td.id_produit

         where dc.id_navire=? /*and td.dates=? */  group by dc.cales,p.produit,td.poids_sac with rollup ");
          $produit->bindParam(1,$navire);  
         // $cale->bindParam(2,$date_deb); 
          
          $produit->execute();
          return $produit;
          } 


          ?>



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
  
  inner join transfert_debarquement as td on td.cale=dc.id_dec and td.id_navire=dc.id_navire
  inner join produit_deb as p on p.id=td.id_produit

         where dc.id_navire=? /*and td.dates=? */  group by p.produit,td.poids_sac,dc.cales,dc.id_dec with rollup ");
          $produit->bindParam(1,$navire);  
         // $cale->bindParam(2,$date_deb); 
          
          $produit->execute();
          return $produit;
          } 



//cette fonction rowspan_deb_produit parcours la table transfert_debarquement et compte les nombres de lignes qui existe en regroupant produit poids_sac cale pour le rowspan du produit
           function rowspan_deb_produit($bdd,$navire,$id_produit,$poids_sac){
               $rowspan_deb_produit=$bdd->prepare(" SELECT COUNT(*) AS nombre_de_lignes
             FROM (
    SELECT count(cale) AS count_cale
    FROM transfert_debarquement
    WHERE id_navire = ? and id_produit=? and poids_sac=?
    GROUP BY id_produit, poids_sac,cale
) AS subquery  ");
               $rowspan_deb_produit->bindParam(1,$navire);
               $rowspan_deb_produit->bindParam(2,$id_produit);
                $rowspan_deb_produit->bindParam(3,$poids_sac);

               $rowspan_deb_produit->execute();
               return $rowspan_deb_produit;
          }
            

          function manifeste_produit($bdd,$navire,$id_produit,$poids_sac){

            $manifeste_produit=$bdd->prepare("SELECT sum(dis.quantite_poids),nc.num_connaissement from dispats as dis 
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
           
              WHERE nc.id_navire=? and dis.id_produits=? and dis.poids_kgs=?
              group by dis.id_produits, dis.poids_kgs  ");
               $manifeste_produit->bindParam(1,$navire);
               $manifeste_produit->bindParam(2,$id_produit);
                $manifeste_produit->bindParam(3,$poids_sac);

               $manifeste_produit->execute();
               return $manifeste_produit;
             }


              function manifeste_produit_TOT($bdd,$navire){

            $manifeste_produit_TOT=$bdd->prepare("SELECT sum(dis.quantite_poids),nc.num_connaissement from dispats as dis 
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
           
              WHERE nc.id_navire=? 
                ");
               $manifeste_produit_TOT->bindParam(1,$navire);

          

               $manifeste_produit_TOT->execute();
               return $manifeste_produit_TOT;
             }


                    function deb_produit_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb){
               $deb_produit_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont=? and td.cale=? ");
               $deb_produit_24H->bindParam(1,$navire);
               $deb_produit_24H->bindParam(2,$id_produit);
               $deb_produit_24H->bindParam(3,$poids_sac);
               $deb_produit_24H->bindParam(4,$date_deb);
                $deb_produit_24H->bindParam(5,$cale_deb);
              
               $deb_produit_24H->execute();
               return $deb_produit_24H;
          }

               function deb_produit_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb){
               $deb_produit_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               left join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont<=? and td.cale=? ");
               $deb_produit_TOT->bindParam(1,$navire);
               $deb_produit_TOT->bindParam(2,$id_produit);
               $deb_produit_TOT->bindParam(3,$poids_sac);
               $deb_produit_TOT->bindParam(4,$date_deb);
               $deb_produit_TOT->bindParam(5,$cale_deb);
              
               $deb_produit_TOT->execute();
               return $deb_produit_TOT;
          }


               function deb_produit_ST_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb){
               $deb_produit_ST_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont=? ");
               $deb_produit_ST_24H->bindParam(1,$navire);
               $deb_produit_ST_24H->bindParam(2,$id_produit);
               $deb_produit_ST_24H->bindParam(3,$poids_sac);
               $deb_produit_ST_24H->bindParam(4,$date_deb);
              
               $deb_produit_ST_24H->execute();
               return $deb_produit_ST_24H;
          }

               function deb_produit_ST_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb){
               $deb_produit_ST_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont<=? ");
               $deb_produit_ST_TOT->bindParam(1,$navire);
               $deb_produit_ST_TOT->bindParam(2,$id_produit);
               $deb_produit_ST_TOT->bindParam(3,$poids_sac);
               $deb_produit_ST_TOT->bindParam(4,$date_deb);
              
               $deb_produit_ST_TOT->execute();
               return $deb_produit_ST_TOT;
          }



               function deb_produit_GEN_24H($bdd,$navire,$date_deb){
               $deb_produit_GEN_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?   and pb.date_pont=? ");
               $deb_produit_GEN_24H->bindParam(1,$navire);
              
             
               $deb_produit_GEN_24H->bindParam(2,$date_deb);
              
               $deb_produit_GEN_24H->execute();
               return $deb_produit_GEN_24H;
          }

               function deb_produit_GEN_TOT($bdd,$navire,$date_deb){
               $deb_produit_GEN_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?   and pb.date_pont<=? ");
               $deb_produit_GEN_TOT->bindParam(1,$navire);
             
      
               $deb_produit_GEN_TOT->bindParam(2,$date_deb);
              
               $deb_produit_GEN_TOT->execute();
               return $deb_produit_GEN_TOT;
          }

               function destination($bdd,$navire){

 $destination=$bdd->prepare("SELECT mg.mangasin,dis.id_mangasin, sum(dis.quantite_poids), td.cale, td.poids_sac,td.id_produit,td.id_destination, p.id,p.produit,p.qualite FROM dispats as dis 
  
  inner join transfert_debarquement as td on td.id_destination=dis.id_mangasin
  inner join mangasin as mg on mg.id=dis.id_mangasin 
  inner join produit_deb as p on p.id=td.id_produit

         where td.id_navire=? /*and td.dates=? */  group by dis.id_mangasin, p.produit,td.poids_sac with rollup ");
          $destination->bindParam(1,$navire);  
         // $cale->bindParam(2,$date_deb); 
          
          $destination->execute();
          return $destination;
          } 

                function deb_destination_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$destination_deb){
               $deb_destination_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont=? and td.id_destination=? ");
               $deb_destination_24H->bindParam(1,$navire);
               $deb_destination_24H->bindParam(2,$id_produit);
               $deb_destination_24H->bindParam(3,$poids_sac);
               $deb_destination_24H->bindParam(4,$date_deb);
                $deb_destination_24H->bindParam(5,$destination_deb);
              
               $deb_destination_24H->execute();
               return $deb_destination_24H;
          }

               function deb_destination_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$destination_deb){
               $deb_destination_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=? and td.id_produit=? AND td.poids_sac=? and pb.date_pont<=? and td.id_destination=? ");
               $deb_destination_TOT->bindParam(1,$navire);
               $deb_destination_TOT->bindParam(2,$id_produit);
               $deb_destination_TOT->bindParam(3,$poids_sac);
               $deb_destination_TOT->bindParam(4,$date_deb);
                $deb_destination_TOT->bindParam(5,$destination_deb);
              
               $deb_destination_TOT->execute();
               return $deb_destination_TOT;
          }

                function deb_destination_ST_24H($bdd,$navire,$date_deb,$destination_deb){
               $deb_destination_ST_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?  and pb.date_pont=? and td.id_destination=? ");
               $deb_destination_ST_24H->bindParam(1,$navire);

               $deb_destination_ST_24H->bindParam(2,$date_deb);
                $deb_destination_ST_24H->bindParam(3,$destination_deb);
              
               $deb_destination_ST_24H->execute();
               return $deb_destination_ST_24H;
          }

               function deb_destination_ST_TOT($bdd,$navire,$date_deb,$destination_deb){
               $deb_destination_ST_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?  and pb.date_pont<=? and td.id_destination=?  ");
               $deb_destination_ST_TOT->bindParam(1,$navire);
               $deb_destination_ST_TOT->bindParam(2,$date_deb);
               $deb_destination_ST_TOT->bindParam(3,$destination_deb);
              
               $deb_destination_ST_TOT->execute();
               return $deb_destination_ST_TOT;
          }


               function deb_destination_GEN_24H($bdd,$navire,$date_deb){
               $deb_destination_GEN_24H=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?   and pb.date_pont=? ");
               $deb_destination_GEN_24H->bindParam(1,$navire);
              
             
               $deb_destination_GEN_24H->bindParam(2,$date_deb);
              
               $deb_destination_GEN_24H->execute();
               return $deb_destination_GEN_24H;
          }

               function deb_destination_GEN_TOT($bdd,$navire,$date_deb){
               $deb_destination_GEN_TOT=$bdd->prepare(" SELECT sum(pb.poids_net),sum(td.sac) from pont_bascule as pb
               inner join  transfert_debarquement as td on td.id_register_manif=pb.id_transfert
                WHERE td.id_navire=?   and pb.date_pont<=? ");
               $deb_destination_GEN_TOT->bindParam(1,$navire);
             
      
               $deb_destination_GEN_TOT->bindParam(2,$date_deb);
              
               $deb_destination_GEN_TOT->execute();
               return $deb_destination_GEN_TOT;
          }

          function manifeste_destination($bdd,$navire,$destination_deb){

            $manifeste_destination=$bdd->prepare("SELECT sum(dis.quantite_poids),nc.num_connaissement from dispats as dis 
              inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
           
              WHERE nc.id_navire=? and dis.id_mangasin=? 
              group by dis.id_mangasin  ");
               $manifeste_destination->bindParam(1,$navire);
               $manifeste_destination->bindParam(2,$destination_deb);
                

               $manifeste_destination->execute();
               return $manifeste_destination;
             }


             function navire($bdd,$navire){
              $my_navire=$bdd->prepare("SELECT navire from navire_deb where id=?");
              $my_navire->bindParam(1,$navire);
              $my_navire->execute();
              return $my_navire;
             }



          ?>



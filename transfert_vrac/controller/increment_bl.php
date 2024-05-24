<?php 	
 function increment_bl($bdd,$produit,$poids_sac,$destination,$navire){
        $bl=$bdd->prepare("SELECT bl from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? order by id_register_manif desc");

   $bl->bindParam(1,$produit);
   $bl->bindParam(2,$poids_sac);
   $bl->bindParam(3,$destination);
   $bl->bindParam(4,$navire);
   
   $bl->execute();
   return $bl;
      }

      function increment_bl_vrac($bdd,$produit,$poids_sac,$destination,$navire,$client){
        $bl=$bdd->prepare("SELECT bl from transfert_debarquement where id_produit=? and poids_sac=? and id_destination=? and id_navire=? and id_client=? order by id_register_manif desc");

   $bl->bindParam(1,$produit);
   $bl->bindParam(2,$poids_sac);
   $bl->bindParam(3,$destination);
   $bl->bindParam(4,$navire);
   $bl->bindParam(5,$client);
   
   $bl->execute();
   return $bl;
      }
 ?>
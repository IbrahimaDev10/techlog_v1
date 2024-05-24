<?php 

function control_excedent_sur_declaration1($bdd,$produit,$poids_sac,$navire,$destination,$declaration){

$rob_dec_verif_dec=$bdd->prepare("SELECT ex.poids_declarer_extends, re.numero_declaration, sum(rm.sac), sum(rm.poids),dis.id_dis from transit_extends as ex left join register_manifeste as rm on ex.id_trans_extends=rm.id_declaration
	inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
	inner join dispatching as dis on dis.id_dis=ex.id_bl_extends
            
        WHERE dis.id_produit=? and  dis.poids_kg=? and dis.id_navire=? and dis.id_mangasin=?  and ex.id_trans_extends=? ");
               $rob_dec_verif_dec->bindParam(1,$produit);
               $rob_dec_verif_dec->bindParam(2,$poids_sac);
               $rob_dec_verif_dec->bindParam(3,$navire);
               $rob_dec_verif_dec->bindParam(4,$destination);
               $rob_dec_verif_dec->bindParam(5,$declaration);
               $rob_dec_verif_dec->execute();
               return $rob_dec_verif_dec;
           }

function control_excedent_sur_declaration2($bdd,$produit,$poids_sac,$navire,$destination,$declaration){
          $rob_dec_verif_dec2=$bdd->prepare("SELECT ex.poids_declarer_extends, re.numero_declaration, sum(tr.poids_flasque_tr_av), sum(tr.poids_mouille_tr_av),dis.id_dis from transit_extends as ex left join transfert_avaries as tr on ex.id_trans_extends=tr.id_declaration_tr
	inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
	inner join dispatching as dis on dis.id_dis=ex.id_bl_extends
            
        WHERE dis.id_produit=? and  dis.poids_kg=? and dis.id_navire=? and dis.id_mangasin=?  and ex.id_trans_extends=?  ");
               $rob_dec_verif_dec2->bindParam(1,$produit);
               $rob_dec_verif_dec2->bindParam(2,$poids_sac);
               $rob_dec_verif_dec2->bindParam(3,$navire);
               $rob_dec_verif_dec2->bindParam(4,$destination);
               $rob_dec_verif_dec2->bindParam(5,$declaration);
               $rob_dec_verif_dec2->execute();
               return $rob_dec_verif_dec2;
           }
 ?>
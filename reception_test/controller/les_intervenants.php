<?php 

  function choix_intervenant($bdd){
       $choix_intervenant=$bdd->query("select * from intervenant where nom_intervenant!='SIMAR' ");
       return $choix_intervenant; }	 

       function afficher_les_intervenants($bdd,$produit, $poids_sac,$navire,$destination){
       	$les_intervenants=$bdd->prepare("SELECT inter.*, inter_rep.* from intervenant_reception as inter_rep
       		inner join intervenant as inter on inter.id_intervenant=inter_rep.id_intervenant
       		where inter_rep.id_produit=? and inter_rep.poids_sac=? and inter_rep.id_navire=? and inter_rep.id_destination=? and inter.nom_intervenant!='SIMAR'  ");

           $les_intervenants->bindParam(1,$produit);
           $les_intervenants->bindParam(2,$poids_sac);
           $les_intervenants->bindParam(3,$navire);
           $les_intervenants->bindParam(4,$destination);
           $les_intervenants->execute();
           return $les_intervenants;
       }

       function compte_intervenants($bdd,$produit, $poids_sac,$navire,$destination){
       	$compte_intervenants=$bdd->prepare("SELECT count(inter_rep.id) from intervenant_reception as inter_rep
       		inner join intervenant as inter on inter.id_intervenant=inter_rep.id_intervenant
       		where inter_rep.id_produit=? and inter_rep.poids_sac=? and inter_rep.id_navire=? and inter_rep.id_destination=? and inter.nom_intervenant!='SIMAR'  ");

           $compte_intervenants->bindParam(1,$produit);
           $compte_intervenants->bindParam(2,$poids_sac);
           $compte_intervenants->bindParam(3,$navire);
           $compte_intervenants->bindParam(4,$destination);
           $compte_intervenants->execute();
           return $compte_intervenants;
       }


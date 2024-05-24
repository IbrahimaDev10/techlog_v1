<?php 
function getclient($bdd,$cli){
	$client=$bdd->prepare("SELECT cli.id as idclient,cli.client,dis.id_dis,mg.id_mangasinier from dispatching as dis
		inner join mangasin as mg on mg.id=dis.id_mangasin
		inner join client as cli on cli.id=dis.id_client
		where mg.id_mangasinier=? group by cli.id");
	$client->bindParam(1,$cli);
	$client->execute();
	return $client;
}
function getmangasin($bdd,$cli,$mang){
	$mangasin=$bdd->prepare("SELECT cli.id as idclient,cli.client,dis.id_dis,mg.id_mangasinier,mg.mangasin,mg.id as idmang from dispatching as dis
		inner join mangasin as mg on mg.id=dis.id_mangasin
		inner join client as cli on cli.id=dis.id_client
		where cli.id=? AND mg.id_mangasinier=?  group by mg.id" );
	$mangasin->bindParam(1,$cli);
	$mangasin->bindParam(2,$mang);
	$mangasin->execute();
    return $mangasin;
}

function getconnaissement($bdd,$con,$cli){
	$connaissement=$bdd->prepare("SELECT n_bl, id_bl from connaissement_conteneur where id_destination=? and id_client=?");
	$connaissement->bindParam(1,$con);
	$connaissement->bindParam(2,$cli);
	$connaissement->execute();
	return $connaissement;
}
function getdeclaration($bdd,$c){
	$declaration=$bdd->prepare("SELECT id_declare from declaration_connaissement where id_connaissement=?");
	$declaration->bindParam(1,$c);
	$declaration->execute();
	return $declaration;
}

function gettransporteur($bdd){
	$transporteur=$bdd->query("SELECT id,nom from transporteur");
		return $transporteur;
}

//affichge de la reception
function afficher_reception($bdd,$c){
	$afficher=$bdd->prepare("SELECT rc.*,dc.num_declare,con.n_bl, nc.type,nc.num_conteneur,nc.poids_kg, nc.poids,nc.sacs, tr.nom,tr.id from reception_conteneur as rc INNER JOIN declaration_connaissement as dc on dc.id_declare=rc.id_declaration INNER JOIN connaissement_conteneur as con on con.id_bl=rc.id_connaissement inner join numero_conteneur as nc on nc.id_num_conteneur=rc.id_num_conteneur
	inner join transporteur as tr on tr.id=rc.id_transporteur
	   WHERE rc.id_connaissement=?");
	$afficher->bindParam(1,$c);
	$afficher->execute();
	return $afficher;
}

function somme_reception($bdd,$c){
	$afficherT=$bdd->prepare("SELECT rc.*,sum(rc.sain),sum(rc.flasque),sum(rc.mouille),sum(rc.poids_rc), dc.num_declare,con.n_bl, sum(nc.poids),sum(nc.sacs) from reception_conteneur as rc INNER JOIN declaration_connaissement as dc on dc.id_declare=rc.id_declaration INNER JOIN connaissement_conteneur as con on con.id_bl=rc.id_connaissement inner join numero_conteneur as nc on nc.id_num_conteneur=rc.id_num_conteneur
	inner join transporteur as tr on tr.id=rc.id_transporteur
	   WHERE rc.id_connaissement=?");
	$afficherT->bindParam(1,$c);
	$afficherT->execute();
	return $afficherT;
}
function compte_reception($bdd,$c){
	$compte=$bdd->prepare("SELECT count(id_recep) from reception_conteneur where id_connaissement=?");
	$compte->bindParam(1,$c);
	$compte->execute();
	return $compte;
}

function bl_et_declaration($bdd,$c){
	$bl=$bdd->prepare("SELECT cc.n_bl, d.num_declare from declaration_connaissement as d 
	inner join connaissement_conteneur as cc on cc.id_bl=d.id_connaissement where id_connaissement=?");
	$bl->bindParam(1,$c);
	$bl->execute();
	return $bl;
}

 ?>
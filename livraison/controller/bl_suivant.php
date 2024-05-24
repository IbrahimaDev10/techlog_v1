<?php 
function bl_suivant($bdd,$produit,$poids_sac,$navire,$destination){
   
   /* $bl=$bdd->prepare("SELECT max(s.bl_simar), s.id_dis_liv, nav.navire,p.*, dis.poids_kg,dis.id_dis, max(m.bl_simar_mo), max(b.bl_simar_bal) from livraison_sain as s
    left join livraison_mouille as m on m.id_dis_mo=s.id_dis_liv
    left join livraison_balayure as b on b.id_dis_bal=s.id_dis_liv
    inner join dispatching as dis on dis.id_dis=s.id_dis_liv
    inner join produit_deb as p on p.id=dis.id_produit
    inner join navire_deb as nav on nav.id=dis.id_navire
    where dis.id_dis=? ");
    $bl->bindParam(1,$c);
    $bl->execute();
    return $bl; */

    $bl=$bdd->prepare( "SELECT max(s.bl_simar), s.id_dis_liv, nc.id_navire, dis.poids_kg, dis.id_dis,dis.id_produit, dis.id_mangasin, max(m.bl_simar_mo), max(b.bl_simar_bal), s.sac_liv
        FROM livraison_sain AS s
        INNER JOIN livraison_mouille AS m ON m.poids_sac_mo = s.poids_sac_liv 
        INNER JOIN livraison_balayure AS b ON b.poids_sac_bal = s.poids_sac_liv
        INNER JOIN dispat AS dis ON dis.id_produit = ? AND dis.poids_kg = ? AND dis.id_mangasin = ?
        INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis
        WHERE dis.id_produit = ? AND dis.poids_kg = ? AND dis.id_mangasin = ? AND nc.id_navire = ?");



// Liaison des paramètres
$bl->bindParam(1, $produit);
$bl->bindParam(2, $poids_sac);
$bl->bindParam(3, $destination);
$bl->bindParam(4, $produit);
$bl->bindParam(5, $poids_sac);
$bl->bindParam(6, $destination);
$bl->bindParam(7, $navire);

$bl->execute(); // Exécution de la requête préparée

         return $bl; 

}

function bl_suivant_liv($bdd,$produit,$poids_sac,$navire,$destination){
   
  
    $bl_liv=$bdd->prepare( "SELECT max(s.bl_simar), s.id_liv, nc.id_navire, dis.poids_kg, dis.id_dis,dis.id_produit, dis.id_mangasin, s.sac_liv,ex.id_trans_extends,ds.id_decliv FROM livraison_sain AS s inner join declaration_sortie as ds on ds.id_decliv=s.dec_liv inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant INNER JOIN dispat AS dis ON dis.id_dis = ex.id_bl_extends INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis WHERE dis.id_produit =? AND dis.poids_kg = ? AND dis.id_mangasin = ? AND nc.id_navire =? ");



// Liaison des paramètres

$bl_liv->bindParam(1, $produit);
$bl_liv->bindParam(2, $poids_sac);
$bl_liv->bindParam(3, $destination);
$bl_liv->bindParam(4, $navire);

$bl_liv->execute(); // Exécution de la requête préparée

         return $bl_liv; 

}


function bl_suivant_bal($bdd,$produit,$poids_sac,$navire,$destination){

   $bl_bal=$bdd->prepare(" SELECT max(b.bl_simar_bal), max(b.id_bal), nc.id_navire, dis.poids_kg, dis.id_dis,dis.id_produit, dis.id_mangasin, b.sac_bal,ex.id_trans_extends,ds.id_decliv FROM livraison_balayure AS b inner join declaration_sortie as ds on ds.id_decliv=b.dec_bal inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant INNER JOIN dispat AS dis ON dis.id_dis = ex.id_bl_extends INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis WHERE dis.id_produit = ? AND dis.poids_kg = ? AND dis.id_mangasin = ? AND nc.id_navire = ?");

   $bl_bal->bindParam(1, $produit);
$bl_bal->bindParam(2, $poids_sac);
$bl_bal->bindParam(3, $destination);
$bl_bal->bindParam(4, $navire);

$bl_bal->execute(); // Exécution de la requête préparée

         return $bl_bal; 

}

function bl_suivant_mo($bdd,$produit,$poids_sac,$navire,$destination){

   $bl_mo=$bdd->prepare(" SELECT max(m.bl_simar_mo), max(m.id_mo), nc.id_navire, dis.poids_kg, dis.id_dis,dis.id_produit, dis.id_mangasin, m.sac_mo,ex.id_trans_extends,ds.id_decliv FROM livraison_mouille AS m inner join declaration_sortie as ds on ds.id_decliv=m.dec_mo inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant INNER JOIN dispat AS dis ON dis.id_dis = ex.id_bl_extends INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis WHERE dis.id_produit = ? AND dis.poids_kg = ? AND dis.id_mangasin = ? AND nc.id_navire = ?");

   $bl_mo->bindParam(1, $produit);
$bl_mo->bindParam(2, $poids_sac);
$bl_mo->bindParam(3, $destination);
$bl_mo->bindParam(4, $navire);

$bl_mo->execute(); // Exécution de la requête préparée

         return $bl_mo; 

}

function number_of_livraison($bdd,$navire,$destination){

$number=$bdd->prepare(" SELECT COUNT(*) AS nombre_de_lignes
FROM (
    SELECT COUNT(nc.id_navire), dis.poids_kg, dis.id_dis, dis.id_produit, dis.id_mangasin, nc.id_navire
    FROM dispat AS dis
    INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis
    WHERE dis.id_mangasin = ? AND nc.id_navire <= ?
    GROUP BY nc.id_navire, dis.id_produit, dis.poids_kg, dis.id_mangasin
) AS subquery;");

$number->bindParam(1, $destination);
$number->bindParam(2, $navire);
$number->execute();
  return $number;
}

 ?>

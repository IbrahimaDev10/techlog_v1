<?php

require('../database.php');

if(isset($_POST["idTransit"])){
    
    $idClient=$_POST["idTransit"];
    $clients=$bdd->prepare("select * from client where id=?");
    $clients->bindParam(1,$idClient);
    $clients->execute();

    //Requete de récupération des données en fonction d'un client
    $stock1 = $bdd->prepare("SELECT nav.navire,p.produit,p.qualite,mg.mangasin, 
    dis.poids_kg,dis.poids_t,trans.id_bl,dis.id_navire,dis.id_client,dis.id_produit,
    dis.id_mangasin,trans.numero_declaration,trans.poids_declarer,dis.id_dis,trans.id_trans
    from dispatching as dis
    INNER JOIN navire_deb as nav on dis.id_navire=nav.id
    INNER JOIN produit_deb as p on dis.id_produit = p.id
    INNER JOIN client as cli on dis.id_client = cli.id
    INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
    INNER JOIN transit as trans on dis.id_dis=trans.id_bl
    WHERE dis.id_client = ?
    GROUP by dis.id_navire,dis.id_produit,dis.id_mangasin,dis.id_dis,trans.numero_declaration
     with rollup");
    $stock1->bindParam(1,$idClient);
    $stock1->execute();
    $test = array();
    /*

    //Requête réception
    $stock2 = $bdd->prepare("SELECT sum(sac_recep) as sacs_sains_rec, sum(poids_recep) as poids_sains_rec 
    FROM reception
    WHERE id_client_recep=?
    GROUP BY id_navire_recep,id_destination_recep,id_produit_recep,poids_sac_recep,id_dis_recep_bl");
    $stock2->bindParam(1,$idClient);
    $stock2->execute();

    $stock3 = $bdd->prepare("SELECT SUM(sac_flasque_ra) as sacs_flasque_ra, SUM(sac_mouille_ra) as sacs_mouilles_ra,
    SUM(poids_flasque_ra) as poids_flasques_ra, SUM(poids_mouille_ra) as poids_mouilles_ra
    FROM reception_avaries
    WHERE id_client_ra=?
    GROUP BY id_navire_ra,id_destination_ra,id_produit_ra,poids_sac_ra,id_dis_bl_ra");
    $stock3->bindParam(1,$idClient);
    $stock3->execute();

    //Requête reconditionnement réception
    $stock4 = $bdd->prepare("SELECT SUM(sac_eventres) as sacs_eventres,
    SUM(poids_eventres) as poids_eventress,
    SUM(sac_av_recond) as sacs_recond,
    SUM(poids_av_recond) as poids_recond,
    SUM(sac_balayure_recond) as sacs_balayure_recond,
    SUM(poids_balayure_recond) as poids_balayure_reconds FROM reconditionnement_reception 
    WHERE id_client_recond=?
    GROUP BY id_navire_recond,id_destination_recond,id_produit_recond,poids_sac_recond,id_dis_recond");
    $stock4->bindParam(1,$idClient);
    $stock4->execute();

    //Requête livraison
    $stock5 = $bdd->prepare("SELECT SUM(sac_mo) as sacMo ,SUM(poids_mo) as poidsMo FROM livraison_mouille
    WHERE id_client_mo=?
    GROUP BY id_navire_mo,id_destination_mo,id_produit_mo,poids_sac_mo,id_dis_mo");
    $stock5->bindParam(1,$idClient);
    $stock5->execute();

    $stock6 = $bdd->prepare("SELECT SUM(sac_liv) as sacsLiv ,SUM(poids_liv) as poidsLiv 
    FROM livraison_sain WHERE id_client_liv = ?
    GROUP BY id_navire_liv,id_destination_liv,id_produit_liv,poids_sac_liv,id_dis_liv");
    $stock6->bindParam(1,$idClient);
    $stock6->execute();

    $stock6bis = $bdd->prepare("SELECT SUM(sac_bal) as sacsBal ,SUM(poids_bal) as poidsBal 
    FROM livraison_balayure
    WHERE id_destination_bal = ?
    GROUP BY id_navire_bal,id_produit_bal,poids_sac_bal,id_dis_bal");
    $stock6bis->bindParam(1,$idClient);
    $stock6bis->execute();

    //Requête recontionnement livraison
    $stock7 = $bdd->prepare("SELECT sum(sac_eventres_liv) as sacsEventresLiv,
    SUM(sac_av_recond_liv) as sacAvRecondLiv,
    SUM(sac_balayure_recond_liv) as sacBalayureLiv,
    SUM(poids_eventres_liv) as poidsEventresLiv,
    SUM(poids_av_recond_liv) as poidsAvRecond,
    SUM(poids_balayure_recond_liv) as poisBalayureLiv
    FROM reconditionnement_livraison
    WHERE id_client_recond_liv =?
    GROUP BY id_navire_recond_liv,id_destination_recond_liv,id_produit_recond_liv,poids_sac_recond_liv,id_dis_recond_liv");
    $stock7->bindParam(1,$idClient);
    $stock7->execute();

    $TotalSommeSacRecepTotalNav = 0;
    $TotalPoidsRecepTotalNav = 0;
    $TotalSommeSacsRecondTotalRec = 0;
    $TotalSommePoidsRecondTotalRec = 0;
    $TotalSommeTotalSacsDepart = 0;
    $TotalSommeTotalPoidsDepart = 0;
    $TotalSommeSacsTotalLiv = 0;
    $TotalSommePoidsTotalLiv = 0;
    $TotalSommeSacsRecondTotalLiv = 0;
    $TotalSommePoidsRecondTotalLiv = 0;
    $TotalSommeSacResteALivreTotal = 0;
    $TotalSommePoidsResteALivreTotal= 0;
    */

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    
        <title>Gestion de Stock</title>

        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="../transfert/css/style.css">
        <link rel="stylesheet" href="assets/css/stylecell.css">
        <link rel="stylesheet" href="../assets/css/repAccueil.css">
        <!-- FontAwesome CSS-->
        <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
        <!-- Boxicons CSS-->
        <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
        <!-- Apexcharts  CSS -->
        <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
        <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="btn.css">
        <link rel="stylesheet" href="stock.css">
    </head>
    <body >
        <table class='table table-hover table-bordered table-striped' id='tableStock' border='2' >
            <thead >
                <tr class="titreStock">
                    <td colspan="12">
                    <?php while ($row=$clients->fetch()) {
                            $clientSelect = $row['client'];
                        }
                        echo $clientSelect; ?> 
                    </td>
                </tr>
                <tr class="trGestionStock" >
                    <td  rowspan="3" class="rowGestionStock">NAVIRES</td> 
                    <td  rowspan="3" class="rowGestionStock">ENTREPOT</td>
                    <td  rowspan="3" class="rowGestionStock">VARIETES</td>    
                    <td rowspan="2" class="rowGestionStock">QUANTITE <br> MANIFESTE </td>
                    <td scope="col" colspan="4" >ENTREE EN MAGASIN</td> 
                    <td scope="col"  colspan="4"  >SORTIE EN MAGASIN</td>       
                </tr>
                <tr class="trGestionStock" >
                    <td scope="col" >N°DEC</td> 
                    <td scope="col" >QUANTITE</td>
                    <td scope="col" >CUMUL <br> DECLARE</td>    
                    <td scope="col" >RESTE A <br> DECLARER   </td>
                    <td scope="col" >N°DEC</td> 
                    <td scope="col" >QUANTITE</td>
                    <td scope="col" >CUMUL <br> DECLARE</td>    
                    <td scope="col" >RESTE A <br> DECLARER   </td>
                </tr>  
            </thead>

            <tbody> 
                <?php 
                 $sommeCumulDeclare = 0;
                 $totalSommeCumulDeclare =0;
                 $aAfficher = 0;
                 $sountCumul = array();
                 $count = 0;
                while ($row=$stock1->fetch()) {
                    $idNavire = $row['id_navire'];
                    $idProduit = $row['id_produit'];
                    $idDestination = $row['id_mangasin'];
                    $idDis = $row['id_dis'];
                    $numeroDec= $row['numero_declaration'];
                    $qteManifeste = $row['poids_t'];
                    $idTrans = $row['id_trans'];
                    if(!empty($idNavire) and !empty($idProduit) and 
                    !empty($idDestination) and !empty($idDis) and !empty($numeroDec)) {
                        
                    
                    $stock2 = $bdd->prepare("SELECT nav.navire,p.produit,p.qualite,mg.mangasin, 
                    dis.poids_kg,dis.poids_t,trans.id_bl,trans.id_trans,
                    trans.numero_declaration,trans.poids_declarer,
                    sum(poids_declarer) as cumulDeclare, GROUP_CONCAT(dis.id_produit) as countCumul
                    from dispatching as dis
                    INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                    INNER JOIN produit_deb as p on dis.id_produit = p.id
                    INNER JOIN client as cli on dis.id_client = cli.id
                    INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                    INNER JOIN transit as trans on dis.id_dis=trans.id_bl
                    WHERE dis.id_client =? and dis.id_mangasin=? and dis.id_produit=?
                    and dis.id_navire=?
                    GROUP by trans.id_bl,trans.id_trans,trans.numero_declaration,trans.poids_declarer
                    WITH ROLLUP");
                    $stock2->bindParam(1,$idClient);
                    $stock2->bindParam(2,$idDestination);
                    $stock2->bindParam(3,$idProduit);
                    $stock2->bindParam(4,$idNavire);
                    $stock2->execute();
                    
                    while ($row2=$stock2->fetch()) {
                        if (empty($row2['id_bl']) and empty($row2['id_trans']) 
                        and empty($row2['numero_declaration']) and empty($row2['poids_declarer'])) {
                            $aAfficher = $row2['cumulDeclare'];
                            $sountCumul = explode(",", $row2['countCumul']);
                            $count = count($sountCumul);
                        }
                    }
/*
                    $stock2 = $bdd->prepare("SELECT id_trans ,sum(poids_declarer) as cumulDeclare
                    from trans WHERE id_trans <=?");
                    $stock2->bindParam(1,$row['id_trans']);
                    $stock2->execute();
                    $row2 = $stock2->fetch();
                   
                    
                    
                    //requete somme réception
                    $stock9 = $bdd->prepare("SELECT sum(sac_recep) as sacs_sains_rec, sum(poids_recep) as poids_sains_rec FROM reception
                    WHERE id_navire_recep=? and id_destination_recep=?");
                    $stock9->bindParam(1,$row['id_navire_recep']);
                    $stock9->bindParam(2,$row['id_destination_recep']);
                    $stock9->execute();
                
                    $stock10 = $bdd->prepare("SELECT SUM(sac_flasque_ra) as sacs_flasque_ra, SUM(sac_mouille_ra) as sacs_mouilles_ra,
                    SUM(poids_flasque_ra) as poids_flasques_ra, SUM(poids_mouille_ra) as poids_mouilles_ra
                    FROM reception_avaries
                    WHERE id_navire_ra=? and id_destination_ra=?");
                    $stock10->bindParam(1,$row['id_navire_recep']);
                    $stock10->bindParam(2,$row['id_destination_recep']);
                    $stock10->execute();

                    //requete somme perte reconditionnement récpetion
                    $stock11 = $bdd->prepare("SELECT SUM(sac_eventres) as sacs_eventres,
                    SUM(poids_eventres) as poids_eventress,
                    SUM(sac_av_recond) as sacs_recond,
                    SUM(poids_av_recond) as poids_recond,
                    SUM(sac_balayure_recond) as sacs_balayure_recond,
                    SUM(poids_balayure_recond) as poids_balayure_reconds 
                    FROM reconditionnement_reception 
                    WHERE id_navire_recond=? and id_destination_recond=?");
                    $stock11->bindParam(1,$row['id_navire_recep']);
                    $stock11->bindParam(2,$row['id_destination_recep']);
                    $stock11->execute();

                    //requete somme perte reconditionnement livraison
                    $stock14 = $bdd->prepare("SELECT sum(sac_eventres_liv) as sacsEventresLiv,
                    SUM(sac_av_recond_liv) as sacAvRecondLiv,
                    SUM(sac_balayure_recond_liv) as sacBalayureLiv,
                    SUM(poids_eventres_liv) as poidsEventresLiv,
                    SUM(poids_av_recond_liv) as poidsAvRecond,
                    SUM(poids_balayure_recond_liv) as poisBalayureLiv
                    FROM reconditionnement_livraison
                    WHERE id_navire_recond_liv=? and id_destination_recond_liv=?");
                    $stock14->bindParam(1,$row['id_navire_recep']);
                    $stock14->bindParam(2,$row['id_destination_recep']);
                    $stock14->execute();

                    //Requêtes somme livraison
                    $stock12 = $bdd->prepare("SELECT SUM(sac_mo) as sacMo ,SUM(poids_mo) as poidsMo 
                    FROM livraison_mouille
                    WHERE id_navire_mo=? and id_destination_mo=?");
                    $stock12->bindParam(1,$row['id_navire_recep']);
                    $stock12->bindParam(2,$row['id_destination_recep']);
                    $stock12->execute();

                    $stock13 = $bdd->prepare("SELECT SUM(sac_liv) as sacsLiv ,SUM(poids_liv) as poidsLiv 
                    FROM livraison_sain 
                    WHERE id_navire_liv =? and id_destination_liv = ?");
                    $stock13->bindParam(1,$row['id_navire_recep']);
                    $stock13->bindParam(2,$row['id_destination_recep']);
                    $stock13->execute();

                    $stock13bis = $bdd->prepare("SELECT SUM(sac_bal) as sacsBal ,SUM(poids_bal) as poidsBal 
                    FROM livraison_balayure
                    WHERE id_navire_bal =? and id_destination_bal = ?");
                    $stock13bis->bindParam(1,$row['id_navire_recep']);
                    $stock13bis->bindParam(2,$row['id_destination_recep']);
                    $stock13bis->execute();

                    $row2 = $stock2->fetch();
                    $row3 = $stock3->fetch();
                    $row4 = $stock4->fetch();
                    $row5 = $stock5->fetch();
                    $row6 = $stock6->fetch();
                    $row7 = $stock7->fetch();
                    $row9 = $stock9->fetch();
                    $row10 = $stock10->fetch();
                    $row11 = $stock11->fetch();
                    $row12 = $stock12->fetch();
                    $row13 = $stock13->fetch();
                    $row14 = $stock14->fetch();
                    $row13bis = $stock13bis->fetch();
                    $row6bis = $stock6bis->fetch();


                    //réception (sacs,poids)
                    $sommeSacRecep = $row2['sacs_sains_rec'] + $row3['sacs_flasque_ra']+$row3['sacs_mouilles_ra'];
                    $PoidsRecep = $row2['poids_sains_rec'] + $row3['poids_flasques_ra']+$row3['poids_mouilles_ra'];
                    
                    //somme totale recepetion (sacs,poids)
                    $sommeSacRecepTotalNav = $row9['sacs_sains_rec'] + $row10['sacs_flasque_ra']+$row10['sacs_mouilles_ra'];
                    $PoidsRecepTotalNav = $row9['poids_sains_rec'] + $row10['poids_flasques_ra']+$row10['poids_mouilles_ra'];
                    
                    //perte reconditionnement récpetion (sacs,poids)
                    $sommeSacsRecondRec= $row4['sacs_eventres'] - ($row4['sacs_recond'] + $row4['sacs_balayure_recond']);
                    $sommePoidsRecondRec = $row4['poids_eventress'] - ($row4['poids_recond'] + $row4['poids_balayure_reconds']);
                    
                    //somme totale perte reconditionnement réception (sacs,poids)
                    $sommeSacsRecondTotalRec= $row11['sacs_eventres'] - ($row11['sacs_recond'] + $row11['sacs_balayure_recond']);
                    $sommePoidsRecondTotalRec = $row11['poids_eventress'] - ($row11['poids_recond'] + $row11['poids_balayure_reconds']);

                    //stock de départ
                    $sommeSacsDepart = $sommeSacRecep - $sommeSacsRecondRec;
                    $sommePoidsDepart = $PoidsRecep - $sommePoidsRecondRec;

                    //somme stock départ
                    $sommeTotalSacsDepart = $sommeSacRecepTotalNav - $sommeSacsRecondTotalRec;
                    $sommeTotalPoidsDepart = $PoidsRecepTotalNav - $sommePoidsRecondTotalRec;

                    //livraison
                    $sommeSacsLiv = $row5['sacMo'] + $row6['sacsLiv'] + $row6bis['sacsBal'];
                    $sommePoidsLiv = $row5['poidsMo'] + $row6['poidsLiv'] + $row6bis['poidsBal'];

                    //somme totale livraison
                    $sommeSacsTotalLiv = $row12['sacMo'] + $row13['sacsLiv'] + $row13bis['sacsBal'];
                    $sommePoidsTotalLiv = $row12['poidsMo'] + $row13['poidsLiv'] + $row13bis['poidsBal'];
                    
                    //perte reconditionnement livraison
                    $sommeSacsRecondLiv= $row7['sacsEventresLiv'] - ($row7['sacAvRecondLiv'] + $row7['sacBalayureLiv']);
                    $sommePoidsRecondLiv = $row7['poidsEventresLiv'] - ($row7['poidsAvRecond'] + $row7['poisBalayureLiv']);
                    
                    //somme reconditionnement total livraison
                    $sommeSacsRecondTotalLiv= $row14['sacsEventresLiv'] - ($row14['sacAvRecondLiv'] + $row14['sacBalayureLiv']);
                    $sommePoidsRecondTotalLiv = $row14['poidsEventresLiv'] - ($row14['poidsAvRecond'] + $row14['poisBalayureLiv']);

                    //reste à livrer
                    $sommeSacResteALivre = $sommeSacsDepart - ($sommeSacsLiv + $sommeSacsRecondLiv);
                    $sommePoidsResteALivre = $sommePoidsDepart - ($sommePoidsLiv + $sommePoidsRecondLiv);

                    //somme reste à livrer
                    $sommeSacResteALivreTotal = $sommeTotalSacsDepart - ($sommeSacsTotalLiv + $sommeSacsRecondTotalLiv);
                    $sommePoidsResteALivreTotal = $sommeTotalPoidsDepart - ($sommePoidsTotalLiv + $sommePoidsRecondTotalLiv);
                    
                    $TotalSommeSacRecepTotalNav = $TotalSommeSacRecepTotalNav + $sommeSacRecepTotalNav;
                    $TotalPoidsRecepTotalNav = $TotalPoidsRecepTotalNav + $PoidsRecepTotalNav;
                    $TotalSommeSacsRecondTotalRec = $TotalSommeSacsRecondTotalRec + $sommeSacsRecondTotalRec;
                    $TotalSommePoidsRecondTotalRec = $TotalSommePoidsRecondTotalRec + $sommePoidsRecondTotalRec;
                    $TotalSommeTotalSacsDepart = $TotalSommeTotalSacsDepart + $sommeTotalSacsDepart;
                    $TotalSommeTotalPoidsDepart = $TotalSommeTotalPoidsDepart + $sommeTotalPoidsDepart;
                    $TotalSommeSacsTotalLiv = $TotalSommeSacsTotalLiv + $sommeSacsTotalLiv;
                    $TotalSommePoidsTotalLiv = $TotalSommePoidsTotalLiv + $sommePoidsTotalLiv;
                    $TotalSommeSacsRecondTotalLiv = $TotalSommeSacsRecondTotalLiv + $sommeSacsRecondTotalLiv;
                    $TotalSommePoidsRecondTotalLiv = $TotalSommePoidsRecondTotalLiv + $sommePoidsRecondTotalLiv;
                    $TotalSommeSacResteALivreTotal = $TotalSommeSacResteALivreTotal + $sommeSacResteALivre;
                    $TotalSommePoidsResteALivreTotal = $TotalSommePoidsResteALivreTotal + $sommePoidsResteALivreTotal;
                    */
                    ?>
                <tr class="tr_data_gestion_stock" >
                    <td > <?php echo $row['navire'];?></td>
                    <td> <?php echo $row['mangasin'];?></td>
                    <td> <?php echo $row['produit']."<br>".$row['qualite']."<br>".$row['poids_kg']."kg" ?></td>  
                    <td> <?php echo number_format($row['poids_t'],3,',',' ');?></td>
                    <td> <?php echo $row['numero_declaration'];?></td>
                    <td> <?php echo number_format($row['poids_declarer'],3,',',' ');?></td>
                    <td rowspan=<?php echo $count?>><?php echo number_format($aAfficher,3,',',' ');?></td>
                    <?php 
                    /*
                    $row2 = $stock2->fetch(PDO::FETCH_BOTH);
                    var_dump($row2);
                    if($row2[0]) {
                        $quantite = $row2['poids_declarer'] ;
                        echo "<td>$quantite</td>";
                    }
                    else {
                        $cumulDeclare = 0; 
                        $cd = 0;
                        while($row2 = $stock2->fetch()) {
                            $cumulDeclare = $cumulDeclare + $row2['cumulDeclare'];
                            $cd =  number_format($cumulDeclare,3,',',' ');
                        }
                        echo "<td>$cd</td>";
                    }
                   
                    
                    $count  = $count = $stock2->rowCount();
                    echo "<td>$count</td>";
                    
                    
                    echo "<td>$quantite</td>";
                    $cumulDeclare = 0; 
                    while($row2 = $stock2->fetch()) {
                        $cumulDeclare = $cumulDeclare + $row2['cumulDeclare'];
                        $cd =  number_format($cumulDeclare,3,',',' ');
                    }
                    echo "<td>$cd</td>";
                    */
                    ?>
                </tr>
                <?php  } ?>
                <tr class="tr_data_gestion_stock">
                    
                </tr>
                <?php 
               
                }?>
                <tr class="trGestionStockTotal">
                    
                </tr>
            </tbody>
        </table>
    </body>
<?php  
 }  
?>
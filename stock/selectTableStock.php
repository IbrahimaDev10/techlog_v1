<?php

require('../database.php');

if(isset($_POST["idEntrepot"])){
    $idEntrepot=$_POST["idEntrepot"];
    $entrepots=$bdd->prepare("select * from mangasin where id=?");
    $entrepots->bindParam(1,$idEntrepot);
    $entrepots->execute();

    //Requete de récupération des données en fonction d'un entrepot
    $stock1 = $bdd->prepare("SELECT nav.navire,nav.etb,nav.id,cli.client,p.produit,p.qualite,
    mg.mangasin,bq.banque,dis.poids_kg,dis.id_navire,dis.id_mangasin,dis.id_client,
    dis.id_produit,dis.id_dis
    from dispatching as dis
    INNER JOIN navire_deb as nav on dis.id_navire=nav.id
    INNER JOIN produit_deb as p on dis.id_produit = p.id
    INNER JOIN client as cli on dis.id_client = cli.id
    INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
    LEFT JOIN banque as bq on dis.id_banque_dis = bq.id
    WHERE dis.id_mangasin =?
    GROUP BY dis.id_navire,dis.id_client,dis.id_produit,dis.id_dis
    with rollup");
    $stock1->bindParam(1,$idEntrepot);
    $stock1->execute();

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
                    <td colspan="15">
                    <?php while ($row=$entrepots->fetch()) {
                            $entrepotSelect = $row['mangasin'];
                        }
                        echo $entrepotSelect; ?> 
                    </td>
                </tr>
                <tr class="trGestionStock" >
                    <td scope="col"  rowspan="3" class="rowGestionStock">NAVIRES</td> 
                    <td  rowspan="3" class="rowGestionStock">RECEPT.</td>
                    <td  rowspan="3" class="rowGestionStock">VARIETES</th>    
                    <td scope="col"  colspan="2">RECEPTIONS</td>
                    <td scope="col" colspan="2" >PERTE RECOND.<br>RECEPTION</td> 
                    <td scope="col"  colspan="2"  >STOCK DEPART</td>       
                    <td scope="col" colspan="2"  >LIVRAISONS</td>
                    <td scope="col" colspan="2"  >PERTE RECOND.<br>LIVRAISON</td>
                    <td scope="col" colspan="2" >RESTE A LIVRER</td>
                </tr>
                <tr class="trGestionStock" >
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                    <td scope="col" >NBRE DE SACS</td>
                    <td scope="col"  >POIDS DES SACS</td>
                </tr>  
            </thead>

            <tbody> 
                <?php 
                $sommeSacRecepTotalNav =0;
                $PoidsRecepTotalNav=0;
                $sommeSacsRecondTotalRec=0;
                $sommePoidsRecondTotalRec=0;
                $sommeTotalSacsDepart=0;
                $sommeTotalPoidsDepart=0;
                $sommeSacsTotalLiv=0;
                $sommePoidsTotalLiv=0;
                $sommeSacsRecondTotalLiv=0;
                $sommePoidsRecondTotalLiv=0;
                $sommeSacResteALivreTotal=0;
                $sommePoidsResteALivreTotal=0;
                while ($row=$stock1->fetch()) {
                
                $idNavire = $row['id_navire'];
                $idProduit = $row['id_produit'];
                $idClient = $row['id_client'];
                $idDis = $row['id_dis'];
                $sacRecepPoids= $row['poids_kg'];
                $idDestination = $row['id_mangasin'];

                if(!empty($idNavire) and !empty($idClient) 
                    and !empty($idProduit) and !empty($idDis)) {

                //Réception
                $stock2 = $bdd->prepare("SELECT poids_sac_recep,
                id_destination_recep,id_produit_recep,id_dis_recep_bl,
                id_client_recep,sum(sac_recep) as sacs_sains_rec
                FROM reception
                WHERE id_destination_recep=?  and id_navire_recep=? 
                and id_produit_recep=? and id_client_recep=? and poids_sac_recep=?
                GROUP BY id_dis_recep_bl");
                $stock2->bindParam(1,$idDestination);
                $stock2->bindParam(2,$idNavire);
                $stock2->bindParam(3,$idProduit);
                $stock2->bindParam(4,$idClient);
                $stock2->bindParam(5,$sacRecepPoids);
                $stock2->execute();

                $stock3 = $bdd->prepare("SELECT SUM(sac_flasque_ra) as sacs_flasque_ra, 
                SUM(sac_mouille_ra) as sacs_mouilles_ra
                FROM reception_avaries
                WHERE id_destination_ra=? and id_navire_ra=? 
                and id_produit_ra=? and id_client_ra=? and poids_sac_ra=?
                GROUP BY id_dis_bl_ra");
                $stock3->bindParam(1,$idDestination);
                $stock3->bindParam(2,$idNavire);
                $stock3->bindParam(3,$idProduit);
                $stock3->bindParam(4,$idClient);
                $stock3->bindParam(5,$sacRecepPoids);
                $stock3->execute();

                $row2 = $stock2->fetch();
                $row3 = $stock3->fetch();
                $sommeSacRecep = $row2['sacs_sains_rec'] + $row3['sacs_flasque_ra']+$row3['sacs_mouilles_ra'];
                $PoidsRecep = ($sommeSacRecep*$row2['poids_sac_recep'])/1000;

                //Reconditionnement réception
                $stock4 = $bdd->prepare("SELECT SUM(sac_eventres) as sacs_eventres,
                SUM(sac_av_recond) as sacs_recond,
                SUM(sac_balayure_recond) as sacs_balayure_recond
                FROM reconditionnement_reception 
                WHERE id_destination_recond=? and id_navire_recond=?  
                and id_produit_recond=? and id_client_recond=? and poids_sac_recond=?
                GROUP BY id_dis_recond");
                $stock4->bindParam(1,$idDestination);
                $stock4->bindParam(2,$idNavire);
                $stock4->bindParam(3,$idProduit);
                $stock4->bindParam(4,$idClient);
                $stock4->bindParam(5,$sacRecepPoids);
                $stock4->execute();
                $row4 = $stock4->fetch();
                $sommeSacsRecondRec= $row4['sacs_eventres'] - ($row4['sacs_recond'] + $row4['sacs_balayure_recond']);
                $sommePoidsRecondRec = ($sommeSacsRecondRec*$row2['poids_sac_recep'])/1000;

                //stock de départ
                $sommeSacsDepart = $sommeSacRecep - $sommeSacsRecondRec;
                $sommePoidsDepart = ($sommeSacsDepart*$sacRecepPoids)/1000;

                //Livraison
                $stock5 = $bdd->prepare("SELECT nav.navire,nav.id,cli.client,p.produit,p.qualite, 
                sum(liMo.sac_mo) as sacMo,
                mg.mangasin from dispatching as dis
                INNER JOIN livraison_mouille as liMo on dis.id_dis = liMo.id_dis_mo
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                INNER JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                WHERE  dis.id_mangasin=? and dis.id_navire=? and dis.id_produit=?
                and dis.id_client=? and dis.poids_kg=?
                GROUP by dis.id_dis");
                $stock5->bindParam(1,$idDestination);
                $stock5->bindParam(2,$idNavire);
                $stock5->bindParam(3,$idProduit);
                $stock5->bindParam(4,$idClient);
                $stock5->bindParam(5,$sacRecepPoids);
                $stock5->execute();

                $stock6 = $bdd->prepare("SELECT nav.navire,nav.id,cli.client,p.produit,p.qualite, 
                sum(liSain.sac_liv) as sacLiv,
                mg.mangasin from dispatching as dis
                INNER JOIN livraison_sain as liSain on dis.id_dis = liSain.id_dis_liv
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                INNER JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                WHERE  dis.id_mangasin=? and dis.id_navire=? and dis.id_produit=?
                and dis.id_client=? and dis.poids_kg=?
                GROUP by dis.id_dis");
                $stock6->bindParam(1,$idDestination);
                $stock6->bindParam(2,$idNavire);
                $stock6->bindParam(3,$idProduit);
                $stock6->bindParam(4,$idClient);
                $stock6->bindParam(5,$sacRecepPoids);
                $stock6->execute();

                $stock6bis = $bdd->prepare("SELECT nav.navire,nav.id,cli.client,p.produit,p.qualite, 
                sum(liBal.sac_bal) as sacBal,
                mg.mangasin from dispatching as dis
                INNER JOIN livraison_sain as liBal on dis.id_dis = liBal.id_dis_bal
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                INNER JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                WHERE  dis.id_mangasin=? and dis.id_navire=? and dis.id_produit=?
                and dis.id_client=? and dis.poids_kg=?
                GROUP by dis.id_dis");
                $stock6bis->bindParam(1,$idDestination);
                $stock6bis->bindParam(2,$idNavire);
                $stock6bis->bindParam(3,$idProduit);
                $stock6bis->bindParam(4,$idClient);
                $stock6bis->bindParam(5,$sacRecepPoids);
                $stock6bis->execute();

                $row5 = $stock5->fetch();
                $row6 = $stock6->fetch();
                $row6bis = $stock6bis->fetch();
                $sommeSacsLiv = $row5['sacMo'] + $row6['sacLiv'] + $row6bis['sacBal'];
                $sommePoidsLiv = ($sommeSacsLiv*$sacRecepPoids)/1000;
                
                //Recontionnement livraison
                $stock7 = $bdd->prepare("SELECT sum(sac_eventres_liv) as sacsEventresLiv,
                SUM(sac_av_recond_liv) as sacAvRecondLiv,
                SUM(sac_balayure_recond_liv) as sacBalayureLiv,
                SUM(poids_eventres_liv) as poidsEventresLiv,
                SUM(poids_av_recond_liv) as poidsAvRecond,
                SUM(poids_balayure_recond_liv) as poisBalayureLiv
                FROM reconditionnement_livraison
                WHERE id_destination_recond_liv=? and id_navire_recond_liv =? and id_produit_recond_liv=?
                and id_client_recond_liv=? and poids_sac_recond_liv=?
                GROUP BY id_dis_recond_liv");
                $stock7->bindParam(1,$idDestination);
                $stock7->bindParam(2,$idNavire);
                $stock7->bindParam(3,$idProduit);
                $stock7->bindParam(4,$idClient);
                $stock7->bindParam(5,$sacRecepPoids);
                $stock7->execute();
                $row7 = $stock7->fetch();
                $sommeSacsRecondLiv= $row7['sacsEventresLiv'] - ($row7['sacAvRecondLiv'] + $row7['sacBalayureLiv']);
                $sommePoidsRecondLiv = ($sommeSacsRecondLiv*$sacRecepPoids)/1000;
                
                //reste à livrer
                $sommeSacResteALivre = $sommeSacsDepart - ($sommeSacsLiv + $sommeSacsRecondLiv);
                $sommePoidsResteALivre = ($sommeSacResteALivre*$sacRecepPoids)/1000;

                ?>
                <tr class="tr_data_gestion_stock" >
                    <td > <?php echo $row['navire'];?></td>
                    <td> <?php echo $row['client'];?></td>
                    <td> <?php echo $row['produit']."<br>".$row['qualite']."<br>".$row['poids_kg']."kg" ?></td>  
                    <td> <?php echo number_format($sommeSacRecep,0,',',' ') ;?> </td>
                    <td> <?php echo number_format($PoidsRecep,3,',',' ');?> </td>  
                    <td> <?php echo number_format($sommeSacsRecondRec,0,',',' ');?> </td>  
                    <td> <?php echo number_format($sommePoidsRecondRec,3,',',' ');?> </td>
                    <td> <?php echo number_format($sommeSacsDepart,0,',',' ');?> </td>  
                    <td> <?php echo number_format($sommePoidsDepart,3,',',' ');?> </td> 
                    <td> <?php echo number_format($sommeSacsLiv,0,',',' ');?> </td>  
                    <td> <?php echo number_format($sommePoidsLiv,3,',',' ');?> </td> 
                    <td> <?php echo number_format($sommeSacsRecondLiv,0,',',' ');?> </td>  
                    <td> <?php echo number_format($sommePoidsRecondLiv,3,',',' ');?> </td>  
                    <td> <?php echo number_format($sommeSacResteALivre,0,',',' ');?> </td>  
                    <td> <?php echo number_format($sommePoidsResteALivre,3,',',' ');?> </td>  
                </tr>
                <?php
                 }
                 if(!empty($idNavire) and !empty($idClient) and 
                 empty($idProduit) and empty($idDis)){
                    //sous totaux
                    $sommeSacRecepTotalNav = $sommeSacRecepTotalNav + $sommeSacRecep;
                    $PoidsRecepTotalNav = $PoidsRecepTotalNav + $PoidsRecep;
                    $sommeSacsRecondTotalRec = $sommeSacsRecondTotalRec + $sommeSacsRecondRec;
                    $sommePoidsRecondTotalRec = $sommePoidsRecondTotalRec + $sommePoidsRecondRec;
                    $sommeTotalSacsDepart = $sommeTotalSacsDepart + $sommeSacsDepart;
                    $sommeTotalPoidsDepart = $sommeTotalPoidsDepart + $sommePoidsDepart;
                    $sommeSacsTotalLiv = $sommeSacsTotalLiv + $sommeSacsLiv;
                    $sommePoidsTotalLiv = $sommePoidsTotalLiv + $sommePoidsLiv;
                    $sommeSacsRecondTotalLiv = $sommeSacsRecondTotalLiv + $sommeSacsRecondLiv;
                    $sommePoidsRecondTotalLiv = $sommePoidsRecondTotalLiv + $sommePoidsRecondLiv;
                    $sommeSacResteALivreTotal = $sommeSacResteALivreTotal + $sommeSacResteALivre;
                    $sommePoidsResteALivreTotal = $sommePoidsResteALivreTotal + $sommePoidsResteALivre;

                    //totaux
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
                    $TotalSommeSacResteALivreTotal = $TotalSommeSacResteALivreTotal + $sommeSacResteALivreTotal;
                    $TotalSommePoidsResteALivreTotal = $TotalSommePoidsResteALivreTotal + $sommePoidsResteALivreTotal;
                    ?>
                    <tr class="tr_data_gestion_stock" >
                        <td colspan="3">TOTAL <?php echo " ".$row['navire'] ;?></td>
                        <td> <?php echo number_format($sommeSacRecepTotalNav,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($PoidsRecepTotalNav,3,',',' ');?> </td> 
                        <td> <?php echo number_format($sommeSacsRecondTotalRec,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($sommePoidsRecondTotalRec,3,',',' ');?> </td>  
                        <td> <?php echo number_format($sommeTotalSacsDepart,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($sommeTotalPoidsDepart,3,',',' ');?> </td>  
                        <td> <?php echo number_format($sommeSacsTotalLiv,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($sommePoidsTotalLiv,3,',',' ');?> </td>  
                        <td> <?php echo number_format($sommeSacsRecondTotalLiv,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($sommePoidsRecondTotalLiv,3,',',' ');?> </td>  
                        <td> <?php echo number_format($sommeSacResteALivre,0,',',' ') ;?> </td>
                        <td> <?php echo number_format($sommePoidsResteALivreTotal,3,',',' ');?> </td>     
                    </tr>
                <?php
                 }
                 $sommeSacRecepTotalNav = 0;
                 $PoidsRecepTotalNav = 0;
                 $sommeSacsRecondTotalRec = 0;
                 $sommePoidsRecondTotalRec =0;
                 $sommeTotalSacsDepart = 0;
                 $sommeTotalPoidsDepart = 0;
                 $sommeSacsTotalLiv = 0;
                 $sommePoidsTotalLiv = 0;
                 $sommeSacsRecondTotalLiv = 0;
                 $sommePoidsRecondTotalLiv = 0;
                 $sommeSacResteALivreTotal = 0;
                 $sommePoidsResteALivreTotal = 0;
                 }
                 if(empty($idNavire) and empty($idClient) and 
                 empty($idProduit) and empty($idDis)){
                 ?>
                <tr class="trGestionStockTotal">
                    <td colspan="3">TOTAL <?php while ($row=$entrepots->fetch()) {$entrepotSelect = $row['mangasin'];}echo " ".$entrepotSelect; ?> </td>
                    <td> <?php echo number_format($TotalSommeSacRecepTotalNav,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalPoidsRecepTotalNav,3,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeSacsRecondTotalRec,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommePoidsRecondTotalRec,3,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeTotalSacsDepart,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeTotalPoidsDepart,3,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeSacsTotalLiv,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommePoidsTotalLiv,3,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeSacsRecondTotalLiv,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommePoidsRecondTotalLiv,3,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommeSacResteALivreTotal,0,',',' ');?> </td>
                    <td> <?php echo number_format($TotalSommePoidsResteALivreTotal,3,',',' ');?> </td>
                </tr>
                <?php  
                }  
                ?>
            </tbody>
        </table>
        <!--<div id="imprimeStock">
            <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimerNavireStock()">Imprimer</button></div>
        </div>-->
    </body>
<?php  
 }  
?>
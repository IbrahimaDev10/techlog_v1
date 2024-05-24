<?php

require('../database.php');

if(isset($_POST["idBanqueGlobal"])){

    $banques=$bdd->prepare("select * from banque order by banque asc");
    $banques->execute();

    $numDateRel = "";
    $quantiteRelachee = 0;
    $totalManifeste = 0;
    $totalStockDepart = 0;
    $totalQuantiteRelachee = 0;
    $totalBalance = 0;
    $totalLivraison = 0;
    $totalResteALivrerRelache = 0;
    $totalDisponibilite = 0 ; 

    $sommetotalManifeste = 0;
    $sommetotalStockDepart = 0;
    $sommetotalQuantiteRelachee = 0;
    $sommetotalBalance = 0;
    $sommetotalLivraison = 0;
    $sommetotalResteALivrerRelache = 0;
    $sommetotalDisponibilite = 0 ; 
    
    $countNav= 0;
    $nbNavire = 0;
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
    <?php while ($row=$banques->fetch()) {?> 
        <table class='table table-hover table-bordered table-striped' id='tableStock' border='2' >
            <thead >
                <tr class="titreStock">
                    <td colspan="12">
                    <?php 
                        $banqueSelect = $row['banque'];
                        echo $banqueSelect; ?> 
                    </td>
                </tr>
                <tr class="trGestionStock" >
                    <td scope="col">NAVIRES</td>
                    <td scope="col">BL N°</td> 
                    <td scope="col">PRODUITS</td> 
                    <td scope="col">MANIFESTE</td>
                    <td scope="col">ENTREPOTS</td>
                    <td scope="col">STOCK <br>DEPART</td> 
                    <td scope="col">N° ET DATES <br>DE RELACHE</td>
                    <td scope="col">QUANTITE <br>RELACHEE</td>
                    <td scope="col">BALANCE</td> 
                    <td scope="col">LIVRAISON</td>
                    <td scope="col">RESTE A <br>LIVRER SUR <br>RELACHE</td>
                    <td scope="col">DISPO<br>NIBILITE</td> 
                </tr>
            </thead>

            <tbody> 
                
                <?php 
                
                $sommeStockDepart = 0;
                $sommeBalance = 0 ;
                $sommeLivraison = 0;
                $sommeResteAlivrerRelache = 0;
                $sommeDisponibilite = 0;
                $sommeManifeste = 0;
                $sommeQunatiteRelache = 0;
                //Requete de récupération des données en fonction d'un client
                $stock1 = $bdd->prepare("SELECT nav.navire,dis.n_bl,nav.id,cli.client,p.produit,
                p.qualite,mg.mangasin,bq.banque, 
                dis.poids_t,dis.poids_kg,id_navire,id_mangasin,id_dis,id_client,
                n_bl,id_produit,id_banque_dis
                from dispatching as dis
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                INNER JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                LEFT JOIN banque as bq on dis.id_banque_dis = bq.id
                WHERE dis.id_banque_dis =?
                GROUP BY dis.id_banque_dis,dis.id_navire,dis.id_dis 
                with rollup");
                $stock1->bindParam(1,$row['id']);
                $stock1->execute();

                while ($rowa=$stock1->fetch()) {
                
                $idNavire = $rowa['id_navire'];
                $bl = $rowa['n_bl'];
                $idProduit =$rowa['id_produit'];
                $poidsT = $rowa['poids_t'];
                $idDestination =$rowa['id_mangasin'];
                $idBanque = $rowa['id_banque_dis'];
                $idDis = $rowa['id_dis'];
                $idClient = $rowa['id_client'];
                $sacRecepPoids= $rowa['poids_kg'];

                if(!empty($idBanque) and !empty($idNavire) and !empty($idDis)) {     
                
               
                //Requête relache pour récupérer n° et dates de relache
                $stock2 = $bdd->prepare("SELECT num_rel,poids_rel,id_navire_rel 
                FROM relache WHERE id_dis_rel in (
                SELECT id_dis
                from dispatching as dis
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                RIGHT JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                LEFT JOIN banque as bq on dis.id_banque_dis = bq.id
                WHERE dis.id_produit=? and id_mangasin=? and id_banque_dis=? and id_client=?
                group by id_produit)");
                $stock2->bindParam(1,$idProduit);
                $stock2->bindParam(2,$idDestination);
                $stock2->bindParam(3,$idBanque);
                $stock2->bindParam(4,$idClient);
                $stock2->execute();
                $numDateRel="";
                while($row2=$stock2->fetch()) {
                    if(is_null($row2['num_rel']) and is_null($row2['poids_rel'])) {
                        $numDateRel="";
                    }
                    else {
                        //n° et dates de relache
                        $numDateRel = $numDateRel."<br>".
                        $row2['num_rel']."<br>"."(".$row2['poids_rel']." t)";
                    }
                }

                $stock2bis = $bdd->prepare("SELECT sum(poids_rel) as quantiteRelachee
                FROM relache WHERE id_dis_rel in (
                SELECT id_dis
                from dispatching as dis
                INNER JOIN navire_deb as nav on dis.id_navire=nav.id
                RIGHT JOIN produit_deb as p on dis.id_produit = p.id
                INNER JOIN client as cli on dis.id_client = cli.id
                INNER JOIN mangasin as mg on dis.id_mangasin = mg.id
                INNER JOIN banque as bq on dis.id_banque_dis = bq.id
                WHERE dis.id_produit=? and id_mangasin=? and id_banque_dis=? and id_client=?
                group by id_produit)");
                $stock2bis->bindParam(1,$idProduit);
                $stock2bis->bindParam(2,$idDestination);
                $stock2bis->bindParam(3,$idBanque);
                $stock2bis->bindParam(4,$idClient);
                $stock2bis->execute();
                $row2bis = $stock2bis->fetch();
                $quantiteRelachee = $row2bis['quantiteRelachee'];
                $sommeQunatiteRelache = $sommeQunatiteRelache + $quantiteRelachee;
                
                //Réception
                $stock2 = $bdd->prepare("SELECT sum(sac_recep) as sacs_sains_rec
                FROM reception
                WHERE id_client_recep=? and id_destination_recep=? and id_navire_recep=? 
                and id_produit_recep=? and poids_sac_recep=?
                GROUP BY id_dis_recep_bl");
                $stock2->bindParam(1,$idClient);
                $stock2->bindParam(2,$idDestination);
                $stock2->bindParam(3,$idNavire);
                $stock2->bindParam(4,$idProduit);
                $stock2->bindParam(5,$sacRecepPoids);
                $stock2->execute();

                $stock3 = $bdd->prepare("SELECT SUM(sac_flasque_ra) as sacs_flasque_ra, 
                SUM(sac_mouille_ra) as sacs_mouilles_ra
                FROM reception_avaries
                WHERE id_client_ra=? and id_destination_ra=? and id_navire_ra=? 
                and id_produit_ra=? and poids_sac_ra=?
                GROUP BY id_dis_bl_ra");
                $stock3->bindParam(1,$idClient);
                $stock3->bindParam(2,$idDestination);
                $stock3->bindParam(3,$idNavire);
                $stock3->bindParam(4,$idProduit);
                $stock3->bindParam(5,$sacRecepPoids);
                $stock3->execute();

                $row2 = $stock2->fetch();
                $row3 = $stock3->fetch();
                $sommeSacRecep = $row2['sacs_sains_rec'] + $row3['sacs_flasque_ra']+$row3['sacs_mouilles_ra'];

                //Reconditionnement réception
                $stock4 = $bdd->prepare("SELECT SUM(sac_eventres) as sacs_eventres,
                SUM(sac_av_recond) as sacs_recond,
                SUM(sac_balayure_recond) as sacs_balayure_recond
                FROM reconditionnement_reception 
                WHERE id_client_recond=? and id_destination_recond=? and id_navire_recond=?  
                and id_produit_recond=? and poids_sac_recond=?
                GROUP BY id_dis_recond");
                $stock4->bindParam(1,$idClient);
                $stock4->bindParam(2,$idDestination);
                $stock4->bindParam(3,$idNavire);
                $stock4->bindParam(4,$idProduit);
                $stock4->bindParam(5,$sacRecepPoids);
                $stock4->execute();
                $row4 = $stock4->fetch();
                $sommeSacsRecondRec= $row4['sacs_eventres'] - ($row4['sacs_recond'] + $row4['sacs_balayure_recond']);

                //stock de départ
                $recep = $sommeSacRecep - $sommeSacsRecondRec;
                $stockDepart = ($recep *$sacRecepPoids)/1000;
                $sommeStockDepart = $sommeStockDepart + $stockDepart;
                
               
                //balance
                $balance = $rowa['poids_t'] - $quantiteRelachee ;
                $sommeBalance = $sommeBalance + $balance;

                //manifeste
                $sommeManifeste = $sommeManifeste + $rowa['poids_t'];


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
                $nbSacLiv = $row5['sacMo'] + $row6['sacLiv'] + $row6bis['sacBal'];
                $livraison = ($nbSacLiv*$sacRecepPoids)/1000;
                $sommeLivraison = $sommeLivraison + $livraison;

                //Reste à livrer sur Relache
                $resteALivrerRelache = $quantiteRelachee - $livraison;
                $sommeResteAlivrerRelache = $sommeResteAlivrerRelache + $resteALivrerRelache;

                //disponibilite
                $disponibilite = $stockDepart - $livraison;
                $sommeDisponibilite = $sommeDisponibilite + $disponibilite;

                ?>
                    <tr class="tr_data_gestion_stock" >
                    <td> <?php echo $rowa['navire'];?></td>
                    <td> <?php echo $rowa['n_bl'];?></td>
                    <td> <?php echo $rowa['produit']."<br>".$rowa['qualite']."<br>".$rowa['poids_kg']."kg" ?></td>  
                    <td> <?php echo number_format($rowa['poids_t'],3,',',' ') ;?></td>
                    <td> <?php echo $rowa['mangasin'] ;?></td>
                    <td> <?php echo number_format($stockDepart,3,',',' ');?></td>  
                    <?php 
                    echo "<td>$numDateRel</td>";
                    ?>
                    <td> <?php echo number_format($quantiteRelachee,3,',',' ');?></td>  
                    <td> <?php echo number_format($balance,3,',',' ');?></td> 
                    <td> <?php echo number_format($livraison,3,',',' ');?> </td>  
                    <td> <?php echo number_format($resteALivrerRelache,3,',',' ');?> </td> 
                    <td> <?php echo number_format($disponibilite,3,',',' ');?> </td>   
                </tr>
                <?php 
                }
                if(!empty($idBanque) and !empty($idNavire) and empty($idDis)){
                    //totaux
                    $totalManifeste = $totalManifeste + $sommeManifeste;
                    $totalQuantiteRelachee = $totalQuantiteRelachee + $sommeQunatiteRelache;
                    $totalStockDepart= $totalStockDepart + $sommeStockDepart;
                    $totalBalance = $totalBalance + $sommeBalance;
                    $totalLivraison = $totalLivraison + $sommeLivraison;
                    $totalResteALivrerRelache = $totalResteALivrerRelache + $sommeResteAlivrerRelache;
                    $totalDisponibilite =  $totalDisponibilite +  $sommeDisponibilite;
                        
                   ?>
                   <tr class="tr_data_gestion_stock" >
                       <td colspan="3">TOTAL <?php echo " ".$rowa['navire'] ;?></td>
                       <td> <?php echo number_format($sommeManifeste,3,',',' ') ;?> </td>
                       <td>-</td>  
                       <td> <?php echo number_format($sommeStockDepart,3,',',' ') ;?> </td>
                       <td>-</td>
                       <td> <?php echo number_format($sommeQunatiteRelache,3,',',' ');?> </td>  
                       <td> <?php echo number_format($sommeBalance,3,',',' ') ;?> </td>
                       <td> <?php echo number_format($sommeLivraison,3,',',' ');?> </td>  
                       <td> <?php echo number_format($sommeResteAlivrerRelache,3,',',' ') ;?> </td>
                       <td> <?php echo number_format($sommeDisponibilite,3,',',' ');?> </td>     
                   </tr>
               <?php
                $sommeStockDepart = 0;
                $sommeBalance = 0;
                $sommeLivraison = 0;
                $sommeResteAlivrerRelache = 0;
                $sommeDisponibilite = 0;
                $sommeManifeste = 0;
                $sommeQunatiteRelache = 0;
                }
                
                }
                if(empty($idBanque) and empty($idNavire) and empty($idDis)){
                ?>
                <tr class="trGestionStockTotal">
                    <td colspan="3">TOTAL 
                        <?php 
                            $banqueSelect = $row['banque'];
                            echo $banqueSelect; ?>
                    </td>
                    <td> <?php echo number_format($totalManifeste,3,',',' ');?> </td>
                    <td> - </td>
                    <td> <?php echo number_format($totalStockDepart,3,',',' ');?> </td>
                    <td>-</td>
                    <td> <?php echo number_format($totalQuantiteRelachee,3,',',' ');?> </td>
                    <td> <?php echo number_format($totalBalance,3,',',' ');?> </td>
                    <td> <?php echo number_format($totalLivraison,3,',',' ');?> </td>
                    <td> <?php echo number_format($totalResteALivrerRelache,3,',',' ');?> </td>
                    <td> <?php echo number_format($totalDisponibilite,3,',',' ');?> </td>
                </tr>
                <?php }
                $sommetotalManifeste = $sommetotalManifeste + $totalManifeste;
                $sommetotalStockDepart = $sommetotalStockDepart + $totalStockDepart;
                $sommetotalQuantiteRelachee = $sommetotalQuantiteRelachee + $totalQuantiteRelachee;
                $sommetotalBalance = $sommetotalBalance + $totalBalance;
                $sommetotalLivraison = $sommetotalLivraison + $totalLivraison;
                $sommetotalResteALivrerRelache = $sommetotalResteALivrerRelache + $totalResteALivrerRelache;  
                $sommetotalDisponibilite = $sommetotalDisponibilite + $totalDisponibilite; 
                $totalManifeste = 0;
                $totalStockDepart = 0;
                $totalQuantiteRelachee = 0;
                $totalBalance = 0;
                $totalLivraison = 0;
                $totalResteALivrerRelache = 0;
                $totalDisponibilite = 0;
                ?>
            </tbody>
        </table>
        <br>    
        <?php  
        }?> 
        <br><br>
        <table class='table table-hover table-bordered table-striped' id='tableStock' border='2' >
            <thead >
                <tr class="trGestionStockTotalx">
                    <td colspan="15">TOTAUX</td>
                </tr>
                <tr class="trGestionStockTotalx" >
                    <td scope="col">NAVIRES</td>
                    <td scope="col">BL N°</td> 
                    <td scope="col">PRODUITS</td> 
                    <td scope="col">MANIFESTE</td>
                    <td scope="col">ENTREPOTS</td>
                    <td scope="col">STOCK <br>DEPART</td> 
                    <td scope="col">N° ET DATES <br>DE RELACHE</td>
                    <td scope="col">QUANTITE <br>RELACHEE</td>
                    <td scope="col">BALANCE</td> 
                    <td scope="col">LIVRAISON</td>
                    <td scope="col">RESTE A <br>LIVRER SUR <br>RELACHE</td>
                    <td scope="col">DISPONIBILITE</td> 
                </tr>
            </thead>
            <tbody>
            <?php
             ?> 
            <tr class="trGestionStockTotalx">
            <td colspan="3">TOTAUX</td>
            <td> <?php echo number_format($sommetotalManifeste,3,',',' ');?> </td>
            <td> - </td>
            <td> <?php echo number_format($sommetotalStockDepart,3,',',' ');?> </td>
            <td> - </td>
            <td> <?php echo number_format($sommetotalQuantiteRelachee,3,',',' ');?> </td>
            <td> <?php echo number_format($sommetotalBalance,3,',',' ');?> </td>
            <td> <?php echo number_format($sommetotalLivraison,3,',',' ');?> </td>
            <td> <?php echo number_format($sommetotalResteALivrerRelache,3,',',' ');?> </td>
            <td> <?php echo number_format($sommetotalDisponibilite,3,',',' ');?> </td>
            </tr>
        </tbody> 
        <?php 
        /*
        $sommetotalManifeste = 0;
        $sommetotalStockDepart = 0;
        $sommetotalQuantiteRelachee = 0;
        $sommetotalBalance = 0;
        $sommetotalLivraison = 0;
        $sommetotalResteALivrerRelache = 0;
        $sommetotalDisponibilite = 0 ; 
        */
        ?>
        </table>
    </body>
<?php  
 }  
?>
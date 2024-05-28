<?php 

function  afficher_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
  
     $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,ch.*, manif.*,sum(manif.sac),sum(manif.poids), sum(pb.poids_bruts),sum(pb.tare_vehicules), sum(pb.poids_net),ts.*, cam.*,pb.*   FROM pont_bascule as pb 
             
                inner join transfert_debarquement as manif on manif.id_register_manif=pb.id_transfert
                left join tare_sac as ts on ts.id_tare=pb.id_tare_sac
                inner join  produit_deb as p on manif.id_produit=p.id 

                inner join navire_deb as nav on manif.id_navire=nav.id 
                
                inner join client as cli on manif.id_client=cli.id
                inner join mangasin as mang on manif.id_destination=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id

  
                

                   WHERE manif.id_produit=? and  manif.poids_sac=? and manif.id_navire=? and manif.id_destination=?  and manif.bl!='ref' and manif.statut=? and manif.id_client=?  group by pb.date_pont, pb.id_pont with rollup ");
        
        
        
       $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
        $affiche->bindParam(4,$destination);
        $affiche->bindParam(5,$statut);
        $affiche->bindParam(6,$client);
        $affiche->execute();
        return $affiche;
      }

function  affichage_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client){
    $affichage= afficher_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);

    while($aff=$affichage->fetch()){ 

        $net_pont_bascule=$aff['poids_bruts']-$aff['tare_vehicules'];
         $som_net_pont_bascule=$aff['sum(pb.poids_bruts)']-$aff['sum(pb.tare_vehicules)'];
    
     $net_marchand=$net_pont_bascule-$aff['sac']*$aff['poids_tare_sac']/1000;
     $som_net_marchand=$som_net_pont_bascule-$aff['sum(manif.sac)']*$aff['poids_tare_sac']/1000;
        if(!empty($aff['date_pont']) and !empty($aff['id_pont'])){


        ?>
        <tr style=" text-align: center; vertical-align: middle;">
             <td style="display: none;" id="<?php echo $aff['id_pont'].'poids_bruts_pb' ?>"  ><?php echo $aff['poids_bruts']; ?></td>
            <td style="display: none;" id="<?php echo $aff['id_pont'].'tare_vehicule_pb' ?>"  ><?php echo $aff['tare_vehicules']; ?></td> 
            
            <td style="display: none;" id="<?php echo $aff['id_pont'].'id_tare_sac_pb' ?>"  ><?php echo $aff['id_tare_sac']; ?></td>
            <td style="display: none;" id="<?php echo $aff['id_pont'].'tare_sac_pb' ?>"  ><?php echo $aff['poids_tare_sac']; ?></td>
             <td style="display: none;" id="<?php echo $aff['id_pont'].'id_navire_pb' ?>"  ><?php echo $aff['id_navire']; ?></td>
              <td style="display: none;" id="<?php echo $aff['id_pont'].'id_produit_pb' ?>"  ><?php echo $aff['id_produit']; ?></td>
               <td style="display: none;" id="<?php echo $aff['id_pont'].'poids_sac_pb' ?>"  ><?php echo $aff['poids_sac']; ?></td>
                <td style="display: none;" id="<?php echo $aff['id_pont'].'id_destination_pb' ?>"  ><?php echo $aff['id_destination']; ?></td>
                 <td style="display: none;" id="<?php echo $aff['id_pont'].'id_client_pb' ?>"  ><?php echo $aff['id_client']; ?></td>

                 <td style="display: none;" id="<?php echo $aff['id_pont'].'poids_brut_pb' ?>"  ><?php echo $aff['poids_bruts']; ?></td>
                 <td style="display: none;" id="<?php echo $aff['id_pont'].'id_transfert_pb' ?>"  ><?php echo $aff['id_transfert']; ?></td>
            
        <td id="<?php echo $aff['id_pont'].'date_pb' ?>"  ><?php echo $aff['date_pont']; ?></td>
        <td id="<?php echo $aff['id_pont'].'bl_pb' ?>"><?php echo $aff['bl'] ?></td>
        <td><?php echo $aff['num_camions'] ?></td>
        <td><?php echo $aff['nom_chauffeur'] ?></td>
        <td><?php echo $aff['num_telephone'] ?></td>
        <td id="<?php echo $aff['id_pont'].'ticket_pb' ?>"><?php echo $aff['ticket_ponts'] ?></td>
        <td id="<?php echo $aff['id_pont'].'sac_pb' ?>"  ><?php echo $aff['sum(manif.sac)'] ?></td>
        <td ><?php echo number_format($aff['poids_bruts'], 3,',',' '); ?></td>
        
        <td id="<?php echo $aff['id_pont'].'net_marchand_pb' ?>"><?php echo number_format($aff['poids_net'], 3,',',' '); ?></td>
        <td>
        <div style="display: flex; justify-content: center;">
        <a class="" data-role='update_bl_pont' data-id='<?php echo $aff['id_pont']; ?>'><i class="fa fa-edit"> </i></a> 
        <a class="" onclick="delete_bl_pont(<?php echo $aff['id_pont'];  ?>)" data-id='<?php echo $aff['id_pont']; ?>'><i class="fa fa-trash"> </i></a>  </div>    
        </td>
        </tr>
    <?php } 

    if(!empty($aff['date_pont']) and empty($aff['id_pont'])){


        ?>
        <tr style="background: blue; color:white !important;  text-align: center; vertical-align: middle;">
        <td colspan="6">TOTAL<?php echo $aff['date_pont']; ?></td>
        <td><?php echo $aff['sum(manif.sac)'] ?></td>
        <td><?php echo number_format($aff['sum(pb.poids_net)'], 3,',',' '); ?></td>
        <td></td>
        
        </tr> <?php  }

         if(empty($aff['date_pont']) and empty($aff['id_pont'])){


        ?>
        <tr style="background: black;  color:white !important; text-align: center; vertical-align: middle;">
       <td colspan="6">TOTAL<?php echo $aff['date_pont'] ?></td>
        <td><?php echo $aff['sum(manif.sac)'] ?></td>
        <td><?php echo number_format($aff['sum(pb.poids_net)'], 3,',',' '); ?></td>
        <td></td>
        </tr> <?php  }

     } } ?>




<div class="col col-lg-6">

    <div class="card">
    <div class="table-responsive" id='tab_recap' >
      <center>      
        <table  class='table table-hover table-bordered table-striped table-responsive' >
        <thead>
          <tr style="text-align:center; vertical-align: middle; background: black; color: white;">
            <th colspan="6" >Recap Debarquement</th>
          </tr>
          <tr style="text-align:center; vertical-align: middle; background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
            <th colspan="2">Manifeste</th>
          <th colspan="2">Total Debarques</th>
          <th colspan="2">Rob</th>
        </tr>
        <tr style="text-align:center; vertical-align: middle;  background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
          <th>sac</th>
           <th>poids</th>
           <th>sac</th>
           <th>poids</th>
                     <th>sac</th>
           <th>poids</th>
        </tr>
          
        </thead>
        <tbody>
          <?php 
           $type_de_navire=type_de_navire($bdd,$navire);
           $type_nav=$type_de_navire->fetch();

           if($type_nav['type']=='SACHERIE'){

          $afficheT=afficher_sainT($bdd,$produit,$poids_sac,$navire,$destination);
          $affiche_tdeb= afficher_total_debarque($bdd,$produit,$poids_sac,$navire,$destination);
        }
          if($type_nav['type']=='VRAQUIER'){

          $afficheT=afficher_sainT_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
          $affiche_tdeb= afficher_total_debarque_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
        }
          $affT=$afficheT->fetch();
          if($affTDEB=$affiche_tdeb->fetch()){
          
          $rob_sac=$affT['sum(quantite_sac)']-$affTDEB['sum(manif.sac)'];
          $rob_poids=$affT['sum(quantite_poids)']-$affTDEB['sum(manif.poids)'];  ?>
            <tr style="text-align:center; vertical-align: middle; background:white;">
              <td><?php echo number_format($affT['sum(quantite_sac)'], 0,',',' ') ?></td>
              <td><?php echo number_format($affT['sum(quantite_poids)'], 3,',',' ') ?></td>
              <td><?php echo number_format($affTDEB['sum(manif.sac)'], 0,',',' ') ?></td>
              <td><?php echo number_format($affTDEB['sum(manif.poids)'], 3,',',' ') ?></td>
              <td style="color:red;"><?php echo number_format($rob_sac, 0,',',' ') ?></td>
              <td style="color:red;"><?php echo number_format($rob_poids, 3,',',' ') ?></td>              
            </tr>
         <?php } ?>
        </tbody>
      </table>
      </center>

    </div>
  </div>
  </div>

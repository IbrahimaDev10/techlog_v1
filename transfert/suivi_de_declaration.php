  <div class="col col-lg-6">

    <div class="card">
    <div class="table-responsive" id='tab_recap' >
      <center>      
        <table  class='table table-hover table-bordered table-striped table-responsive' >
        <thead>
          <tr style="text-align:center; vertical-align: middle; background: black; color: white;">
            <th colspan="6" >Suivi de declaration</th>
          </tr>
          <tr style="text-align:center; vertical-align: middle; background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
            <th rowspan="2">Numero Declaration</th>
            <th >Manifest (poids)</th>
          <th >Total Debarques (poids)</th>
          <th >Rob (poids)</th>
        </tr>
 
          
        </thead>
        <tbody>
     <?php   affichage_suivi_declaration($bdd,$produit,$poids_sac,$navire,$destination,$client); ?>
        </tbody>
      </table>
      </center>

    </div>
  </div>
  </div>
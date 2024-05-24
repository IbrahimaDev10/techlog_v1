                                        <div class="card-body"> 
                   <div class="table-responsive" border=1> 
                  <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
                <thead> 

               <tr style="color:white; font-weight: bold; background: #1B2B65; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                
              <th style="border-color:white;" scope="col" >CALES</th>
              <th style="border-color:white;" scope="col" >NOM CHARGEUR</th>
             <th style="border-color:white;" scope="col" >PRODUIT</th>
                   
          
          <th style="border-color:white;" scope="col" >POIDS (T)</th>
         </tr>
        </thead>
      <tbody style="font-weight: bold;">

                        <?php
               $res2 = $bdd->prepare("SELECT   p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by dc.cales, p.produit, dc.id  with rollup ");
            $res2->bindParam(1,$b);
            $res2->execute();
             while($row2 = $res2->fetch()){
            ?>
      <tr style="text-align:center;" border='5'>
              <?php 
              if(!empty($row2['produit']) and !empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
    <td ><?php echo $row2['cales']; ?></td>
    <td  ><?php echo $row2['nom_chargeur']; ?></td>
   <td ><?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite'];?> <?php echo $row2['conditionnement']; ?>KGS</pre></td>
   <td  ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
         <?php } ?>

                <?php 
              if(empty($row2['produit']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
    <td style="background-color:rgb(16,105,131); color: white; ">TOTAL <?php echo $row2['cales']; ?></td>
   
    <td  style="background-color:rgb(16,105,131); color: white;"></td>
    <td  style="background-color:rgb(16,105,131); color: white;"></td>
    <td  style="background-color:rgb(16,105,131); color: white;"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['produit']) and empty($row2['id_dec'])){

               ?>
               
              <td style="background-color:blue;  color:white ; border: none; font-size: 30px; font-weight: bold;"></td>

<td style="background-color:blue;  color:white ; border: none; font-size: 30px; font-weight: bold;">TOTAL </td>
<td style="background-color:blue;  color:white ; border: none; font-size: 30px; font-weight: bold;"></td>


<td  style="background-color:blue;  color:white ; font-size: 30px; font-weight: bold;"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>

    </tr>
               <?php } ?>
    </tbody>
   </table>  
  </div>
 </div>
</div>



          <div class="card">
            <div class="card-header">
              <center>
              <h1 >STATISTIQUE DU NAVIRE PAR PRODUIT</h1>
              </center>
               <div class="card-body"> 
            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
            
          <thead>   
 <tr style="color:white; font-weight: bold; background: #1B2B65; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                                <th style="border-color:white;" scope="col" >PRODUIT</th>
                                <th style="border-color:white;" scope="col" >CALES</th>
                                

                                <th style="border-color:white;" scope="col" >POIDS(T)</th>
                                
 
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">

       <?php


                             
     
 
 $res2 = $bdd->prepare("SELECT   p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by  p.produit,dc.conditionnement, dc.cales, dc.id_dec with rollup ");
        $res2->bindParam(1,$b);
       
        
        $res2->execute();

        
      
       
       while($row2 = $res2->fetch()){
            ?>
            <tr style="text-align:center;" border='5'>
              <?php 
              if(!empty($row2['cales']) and !empty($row2['produit']) and !empty($row2['conditionnement']) and !empty($row2['id_dec'])){

               ?>
<td ><?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?> <?php echo $row2['conditionnement']; ?>kgs</pre></td>
              <td ><?php echo $row2['cales']; ?></td>




<td  ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>


              <?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and !empty($row2['produit']) and !empty($row2['conditionnement'])){

               ?>
              <td style="background-color:rgb(16,105,131); color: white;">TOTAL <pre><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['conditionnement']; ?> KGS</pre></td>

<td style="background-color:rgb(16,105,131); color: white;"> </td>



<td  style="background-color:rgb(16,105,131); color: white;"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and empty($row2['produit']) and empty($row2['conditionnement'])){

               ?>
               <center>
              <td style="background-color:blue;  color:white ; border: none; font-size: 30px; font-weight: bold;">TOTAL</td></center>

<td style="background-color:blue;  color:white ; border: none; font-size: 30px; font-weight: bold;"> </td>



<td  style="background-color:blue;  color:white ; font-size: 30px; font-weight: bold;"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>



</tr>
               <?php } ?>
   


               
                                   </tbody>
                     </table> 
                 </div>
            </div>
        </div>  
         <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('fetch_cargo_plan')">imprimer</button> 



<!-- Tableau initial avec les 4 colonnes -->

<!-- exemple pour imprimer -->

<table id="mon-tableau">
  <tr>
    <th>Colonne 1</th>
    <th>Colonne 2</th>
    <th>Colonne 3</th>
    <th>Colonne 4</th>
  </tr>
  <tr>
    <td>Donnée 1</td>
    <td>Donnée 2</td>
    <td>Donnée 3</td>
    <td>Donnée 4</td>
  </tr>
  <!-- Ajoutez plus de lignes si nécessaire -->
</table>

<!-- Bouton d'impression -->
<button onclick="imprimerTableau()">Imprimer</button>

<script>
function imprimerTableau() {
  // Sélectionner le tableau
  var tableau = document.getElementById('mon-tableau');
  
  // Cacher la dernière colonne
  var dernierColonneIndex = tableau.rows[0].cells.length - 1;
  for (var i = 0; i < tableau.rows.length; i++) {
    tableau.rows[i].deleteCell(dernierColonneIndex);
  }
  
  // Lancer l'impression
  window.print();
  
  // Rétablir le tableau original
  for (var i = 0; i < tableau.rows.length; i++) {
    tableau.rows[i].insertCell(dernierColonneIndex);
  }
}
</script>

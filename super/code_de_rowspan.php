<div class="container-fluid" id="pardestination" style="display:none;">
              <center>
              <h1 class="hdeclaration text-white" >DISPATCHING PAR DESTINATION</h1>
              </center>

            <div class="table-responsive" border=1> 
           

                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t) from dispatching as dis
                        inner join mangasin as mang on dis.id_mangasin=mang.id 
                        inner join client as cli on dis.id_client=cli.id 
                        inner join produit_deb as p  on dis.id_produit=p.id
                        
                        
                        where dis.id_navire=?  group by mang.mangasin, cli.client, dis.id_dis with rollup ");
        $client->bindParam(1,$b);
       

        $client->execute();

        $resultats = $client->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table border="1">
    <tr>
        <th>DESTINATION</th>
        <th>NUMERO BL</th>
        <th>PRODUIT</th>
        <th>QUANTITE</th>
        <th>POIDS (T)</th>
        <th>RECEPTIONNAIRE</th>
    </tr>

    <?php
    $lastDestination = null;
    $rowspanDestination = 0;

    foreach ($resultats as $row) {
        

        // Colonne Destination
           if (!empty($row['mangasin']) and !empty($row['client']) and !empty($row['id_dis'])) {
            echo '<tr>';
        if ($lastDestination != $row['client'] and !empty($row['mangasin']) and !empty($row['id_dis'])) {
            $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
            $lastDestination = $row['mangasin'];
            foreach ($resultats as $r) {
                if ($r['client'] === $lastDestination ) {
                    $rowspanDestination++;
                }
            }
            echo "<td rowspan='$rowspanDestination'>{$row['mangasin']}</td>";
                    echo "<td>{$row['n_bl']}</td>";
        echo "<td>{$row['produit']}</td>";
        echo "<td>{$row['nombre_sac']}</td>";
        echo "<td>{$row['poids_t']}</td>";
        echo "<td>{$row['client']}</td>";
        }

        // Les autres colonnes



        echo '</tr>';
    }
    }
    ?>

</table> 
 
  </div>




  <?php     // LE VRAI CODE ?>

 <div class="container-fluid" id="pardestination" style="display:none;">
              <center>
              <h1 class="hdeclaration text-white" >DISPATCHING PAR DESTINATION</h1>
              </center>

            <div class="table-responsive" border=1> 
           

                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t) from dispatching as dis
                        inner join mangasin as mang on dis.id_mangasin=mang.id 
                        inner join client as cli on dis.id_client=cli.id 
                        inner join produit_deb as p  on dis.id_produit=p.id
                        
                        
                        where dis.id_navire=?  group by mang.mangasin, cli.client, dis.id_dis with rollup ");
        $client->bindParam(1,$b);
       

        $client->execute();

        $resultats = $client->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
        <th style="color:white;">DESTINATION</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
        <th style="color:white;">QUANTITE</th>
        <th style="color:white;">POIDS (T)</th>
        <th style="color:white;">RECEPTIONNAIRE</th>
    </tr>

    <?php
    $lastDestination = null;
    $rowspanDestination = 0;

   foreach ($resultats as $row) {
    ?>
        <tr style="text-align: center; vertical-align: middle; background: white;" >
<?php    
        // Colonne Destination
        if ($lastDestination != $row['mangasin'] and !empty($row['mangasin']))  {
            $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
            $lastDestination = $row['mangasin'];
            foreach ($resultats as $r) {
                if ($r['mangasin'] === $lastDestination) {
                    $rowspanDestination++;
                }
            }
            ?>

            <td rowspan='<?php echo $rowspanDestination-1; ?>'><?php echo $row['mangasin'];  ?></td>
                   
       <?php   
        }
        if(!empty($row['mangasin']) and !empty($row['client']) and !empty($row['id_dis'])){
          ?>
         
         <td><?php echo $row['n_bl'] ?> </td>
         <td><?php echo $row['produit'] ?></td> 
        <td><?php echo $row['nombre_sac'] ?></td>
        <td><?php echo $row['poids_t'] ?></td>
        <td ><?php echo $row['client'] ?></td>
        <?php    
        }
                if(!empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
         
         <td colspan="3" style="background: blue; color: white;">TOTAL</td>
        <td style="background: blue; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
       <td style="background: blue; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
        <td style="background: blue; color: white;"></td>
        <?php    
        } 
                        if(empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
          
         <td style="background: red; color: white;"  colspan="3">GENERAL</td>
          
       <td style="background: red; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
        <td style="background: red; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
        <td style="background: red; color: white;"></td>
      <?php    }

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>

  </div>
<?php /// mise a jour du code ?>
                         <?php  
                     $destination=par_destination($bdd,$b);

        $resultats = $destination->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
        <th style="color:white;">DESTINATION</th>
        <th style="color:white;">RECEPTIONNAIRE</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
        <th style="color:white;">QUANTITE</th>
        <th style="color:white;">POIDS (T)</th>
        
    </tr>

    <?php
    $lastDestination = null;
    $lastDestinationMang = null;
    $rowspanDestination = 0;
      $lastClient = null;
    $rowspanClient = 0;
     $id_dis = null;

   foreach ($resultats as $row) {
?>
<tr style="text-align: center; vertical-align: middle; background: white;" >
<?php    
    // Colonne Destination
    if ($lastDestination != $row['mangasin'] and !empty($row['mangasin']))  {
        $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $lastDestination = $row['mangasin'];
        foreach ($resultats as $r) {
            if ($r['mangasin'] === $lastDestination) {
                $rowspanDestination++;
            }
        }
?>
        <td rowspan='<?php echo $rowspanDestination-2; ?>'><?php echo $row['mangasin']; ?> <?php echo $rowspanDestination-2; ?></td>
<?php   
    }

    // Colonne Réceptionnaire
    if(!empty($row['mangasin']) and !empty($row['client']) and !empty($row['id_dis'])){
        if ($lastClient != $row['mangasin']   ) {
            $rowspanClient = 0; // Réinitialisation du rowspan pour le nouveau réceptionnaire
            $lastClient = $row['client'];
            $lastDestinationMang = $row['mangasin'];
            $id_dis=$row['n_bl'];
            foreach ($resultats as $cli) {
                 if ($cli['client'] === $row['client'] and $cli['mangasin'] === $row['mangasin'] and $cli['n_bl']===$row['n_bl']    ) {
                 
                  
  
                    $rowspanClient++; ?>

                     <div style="background: blue;"> <?php  echo $cli['n_bl']; ?> <?php  echo $cli['id_dis']; ?>  <?php  echo $cli['client']; ?><?php  echo $row['client']; ?> <?php  echo $row['n_bl']; ?> <?php  echo $row['id_dis']; ?>  <?php  echo $cli['mangasin']; ?> <?php  echo $row['mangasin']; ?> <?php  echo $rowspanClient; ?> </div>
                     <?php  
                }

            }
           
?>

        <td rowspan='<?php echo $rowspanClient; ?>' style="background: white;"><?php echo $row['client']; ?> <?php echo $rowspanClient; ?></td>
<?php
        
      }
?>
        <!-- Le reste de votre code pour les autres colonnes -->
        <td><?php echo $row['n_bl'] ?></td>
        <td><?php echo $row['produit'] ?></td> 
        <td><?php echo $row['nombre_sac'] ?></td>
        <td><?php echo $row['poids_t'] ?></td>
<?php
    }
            if(!empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
         
         <td colspan="4" style="background: blue; color: white;">TOTAL</td>
        <td style="background: blue; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
       <td style="background: blue; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
      
       
        <?php    
        } 
                        if(empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
          
         <td style="background: red; color: white;"  colspan="4">GENERAL</td>
          
       <td style="background: red; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
        <td style="background: red; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
       
        
      <?php    }

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>

  <?php // DU 30/10/2023 ?>


  <div class="container-fluid" id="pardestination" style="display:none;">
              <center>
              <h1 class="hdeclaration text-white" >DISPATCHING PAR DESTINATION</h1>
              </center>

            <div class="table-responsive" border=1> 
           

                                <?php  
                     $destination=par_destination($bdd,$b);

        $resultats = $destination->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
        <th style="color:white;">DESTINATION</th>
        <th style="color:white;">RECEPTIONNAIRE</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
        <th style="color:white;">QUANTITE</th>
        <th style="color:white;">POIDS (T)</th>
        
    </tr>

    <?php
    $lastDestination = null;
    $lastDestinationMang = null;
    $rowspanDestination = 0;
      $lastClient = null;
    $rowspanClient = 0;
     $id_dis = null;

   foreach ($resultats as $row) {
?>
<tr style="text-align: center;  background: white; " >
<?php    
    // Colonne Destination
    if ($lastDestination != $row['mangasin'] and !empty($row['mangasin']))  {
        $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $lastDestination = $row['mangasin'];
        foreach ($resultats as $r) {
            if ($r['mangasin'] === $lastDestination) {
                $rowspanDestination++;
            }
        }
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination-2; ?>'><?php echo $row['mangasin']; ?> <?php echo $rowspanDestination-2; ?></td>

        <?php  echo $row['client']; ?></td>
        <?php $lesclient=$bdd->prepare("SELECT cli.client,count(cli.client), dis.id_mangasin from dispatching as dis inner join client as cli on cli.id=dis.id_client
         where dis.id_navire=? and dis.id_mangasin=? group by cli.client");
         $lesclient->bindParam(1,$b);
         $lesclient->bindParam(2,$row['idmg']);
         $lesclient->execute();

           

        $somme_mg=$bdd->prepare("SELECT count(id_client),id_client from dispatching
         WHERE id_mangasin=? and id_navire=?  ");
        
         $somme_mg->bindParam(1,$row['idmg']);
         $somme_mg->bindParam(2,$b);
          
         $somme_mg->execute();
         $som=$somme_mg->fetch();
         ?>
      
        <td  style=""  rowspan="<?php echo $rowspanDestination-2; ?>">
          <table class='table table-responsive table-hover table-bordered table-striped' style="  width: 100%; margin-left: 0px; background: red;" >
           
         <?php  $nombre_row=0; 
                $couleur="";
                $largeur=0;
          while ($cli=$lesclient->fetch()){

                  $somme_mg2=$bdd->prepare("SELECT count(id_client) from dispatching
         WHERE id_mangasin=? and id_navire=? and id_client=? ");
        
         $somme_mg2->bindParam(1,$row['idmg']);
         $somme_mg2->bindParam(2,$b);
         $somme_mg2->bindParam(3,$som['id_client']);
         $somme_mg2->execute();
         $som2=$somme_mg2->fetch();


              $nombre_row++;
              if($nombre_row==1){
                $couleur="yellow";

                $largeur=$cli['count(cli.client)']*100/$som['count(id_client)'];
              }
                if($nombre_row==2){
                $couleur="blue";
                $largeur=$cli['count(cli.client)']*100/$som['count(id_client)'];
              }
                if($nombre_row==3){
                $couleur="orange";
                $largeur=$cli['count(cli.client)']*100/$som['count(id_client)'];
              }
         // $som=$somme_mg->fetch();
          //$pourcentage=$cli['count(cli.client)']*100/$som['count(id_client)'];
        ?> <tr style="height: <?php  echo $largeur.'%'; ?>;" ><td style=" background: <?php echo $couleur; ?>; "   rowspan="<?php echo $som2['count(id_client)']; ?>" >      <?php echo $cli['client']; ?>  <?php echo $som2['count(id_client)'] ?><?php echo $largeur; ?></td></tr>  <?php   } ?>
       
         </table></td>
        
<?php   
    }

    // Colonne Réceptionnaire
   
     
       if(!empty($row['mangasin']) and !empty($row['client']) and !empty($row['id_dis'])){
?>
        <!-- Le reste de votre code pour les autres colonnes -->
        <td style="vertical-align: middle;"><?php echo $row['n_bl'] ?></td>
        <td style="vertical-align: middle;"><?php echo $row['produit'] ?></td> 
        <td style="vertical-align: middle;"><?php echo $row['nombre_sac'] ?></td>
        <td style="vertical-align: middle;"><?php echo $row['poids_t'] ?></td>
       
<?php
    }
            if(!empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
         
         <td colspan="4" style="background: blue; color: white;">TOTAL</td>
        <td style="background: blue; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
       <td style="background: blue; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
      
       
        <?php    
        } 
                        if(empty($row['mangasin']) and empty($row['client']) and empty($row['id_dis'])){ ?>
          
         <td style="background: red; color: white;"  colspan="4">GENERAL</td>
          
       <td style="background: red; color: white;"><?php echo $row['sum(dis.nombre_sac)'] ?></td>
        <td style="background: red; color: white;"><?php echo $row['sum(dis.poids_t)'] ?></td>
       
        
      <?php    }

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>

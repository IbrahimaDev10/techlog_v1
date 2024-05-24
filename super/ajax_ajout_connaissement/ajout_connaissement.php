<?php require('../../database.php'); 
    $idm=$_POST['id_navire'];

$type=$_POST['type'];
        
        if($_POST['type']=='SACHERIE'){
        $num_connaissement=$_POST['num_connaissement'];
        
        // $conditionnement=$_POST['produit'];
        // $cond=explode('-', $conditionnement);
        //  $client=$_POST['client'];
          $banques=$_POST['banque'];
           $fournisseur=$_POST['fournisseur'];
           $poids=$_POST['poids'];
           $produit=explode('-', $_POST['produit']);
           $id_produit=$produit[0];
           $poids_sac=$produit[1];
           $client=$_POST['client'];
     
    
             $insertDispat= $bdd->prepare("INSERT INTO numero_connaissements(num_connaissement,id_navire,id_banque,id_fournisseur,poids_connaissement,id_produit,id_client,poids_kg) VALUES(?,?,?,?,?,?,?,?)");
             

         $insertDispat->bindParam(1,$num_connaissement);
         $insertDispat->bindParam(2,$idm);

             $insertDispat->bindParam(3,$banques);
              $insertDispat->bindParam(4,$fournisseur);
               $insertDispat->bindParam(5,$poids);
               $insertDispat->bindParam(6,$id_produit);
               $insertDispat->bindParam(7,$client);
               $insertDispat->bindParam(8,$poids_sac);

         $insertDispat->execute();

    
    $mes_connaissement=$bdd->prepare("SELECT nc.*,b.*,af.*,p.produit,p.qualite FROM numero_connaissements as nc LEFT join banque as b on b.id=nc.id_banque
    LEFT join produit_deb as p on p.id=nc.id_produit
    left join affreteur as af on af.id=nc.id_fournisseur where id_navire=?");
$mes_connaissement->bindParam(1,$idm);
$mes_connaissement->execute();
     
            }


            if($_POST['type']=='VRAQUIER'){
        $num_connaissement=$_POST['num_connaissement'];
        
        // $conditionnement=$_POST['produit'];
        // $cond=explode('-', $conditionnement);
        //  $client=$_POST['client'];
          $banques=$_POST['banque'];
           $fournisseur=$_POST['fournisseur'];
           $poids=$_POST['poids'];
           $id_produit= $_POST['produit'];
         //  $id_produit=$produit[0];

           $client=$_POST['client'];

     
    
             $insertDispat= $bdd->prepare("INSERT INTO numero_connaissements(num_connaissement,id_navire,id_banque,id_fournisseur,poids_connaissement,id_client,categories_id_vrac) VALUES(?,?,?,?,?,?,?)");
             

         $insertDispat->bindParam(1,$num_connaissement);
         $insertDispat->bindParam(2,$idm);

             $insertDispat->bindParam(3,$banques);
              $insertDispat->bindParam(4,$fournisseur);
               $insertDispat->bindParam(5,$poids);
               
               $insertDispat->bindParam(6,$client);
               $insertDispat->bindParam(7,$id_produit);


         $insertDispat->execute();

    
    $mes_connaissement=$bdd->prepare("SELECT nc.*,b.*,af.*,c.* FROM numero_connaissements as nc LEFT join banque as b on b.id=nc.id_banque
    LEFT join categories as c on c.id_categories=nc.categories_id_vrac
    left join affreteur as af on af.id=nc.id_fournisseur where id_navire=?");
     $mes_connaissement->bindParam(1,$idm);
$mes_connaissement->execute();
            }        

     ?>
     
         <div  class="table-responsive" border=1 id="tableau_num_connaissement">
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
    <thead>
    <tr style="color: white; background: blue; font-size:12px; vertical-align: center; text-align: center; vertical-align:middle;">
    <th colspan="6" ><h6 style="color: white;">NUMERO DE CONNAISSEMENT</h6> </th></tr>
    <tr style="background: blue; color: white; font-size:12px; text-align: center; vertical-align:middle;">
        <th>N° CONNAISSEMENT</th>
            <th>PRODUIT & <br>QUALITE</th>
        <th>BANQUE</th>
        <th>FOURNISSEUR</th>
        <th>POIDS</th>
        <th>ACTION</th>
    </tr>

    </thead>

 <?php while($aff=$mes_connaissement->fetch()){ ?>
    <tr style="font-size:12px; background: white; vertical-align: middle; text-align: center; vertical-align:middle;">
<td id=<?php echo $aff['id_connaissement'].'nc' ?>><?php echo $aff['num_connaissement'] ?></td>
  <td > <?php if($type=='SACHERIE'){ ?><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <span style="color:red;"> <?php echo $aff['poids_kg'].' KG'; ?> <?php } ?>  <?php if($type=='VRAQUIER'){ ?>  <span style="color:red;"> <?php echo $aff['nom_categories']; ?> <?php } ?></span></td>
<td ><?php echo $aff['banque'] ?></td>
<td  ><?php echo $aff['affreteur'] ?></td>
<td style=" white-space: nowrap;" id="<?php echo $aff['id_connaissement'].'poids'; ?>"><?php echo number_format($aff['poids_connaissement'], 3,',',' '); ?></td>
<span id=<?php echo $aff['id_connaissement'].'banque' ?>><?php echo $aff['id_banque'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'affreteur' ?>><?php echo $aff['id_fournisseur'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'navire_con' ?>><?php echo $aff['id_navire'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'produit_con' ?>><?php echo $aff['id_produit'].'-'.$aff['poids_kg'] ?></span>

<td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_connaissement" data-id="<?php echo $aff['id_connaissement']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteConnaissement(<?php echo $aff['id_connaissement'] ?>)"><i class="fas fa-trash"></i></a></td>

 </tr>
 <?php } ?> 

    

    </tr>
</table>
</div>
<?php if($insertDispat){ ?>

    <script type="text/javascript">
              Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Donnees enregistrees avec succes.',
        confirmButtonText: 'OK'
    });
    </script>

<?php } ?>
       

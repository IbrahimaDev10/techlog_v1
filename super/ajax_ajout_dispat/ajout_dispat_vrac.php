<?php require('../../database.php'); 
    $idm=$_POST['id_navire'];

  


if($_POST['type']=="VRAQUIER"){


        //$nav=$_POST['navire'];

        
        //$bl=explode('-', $_POST['bl']);
        
    
        $destination=$_POST['destination'];
    //  $poids_sac=$_POST['poids_sac'];


        //$produit=explode('-', $_POST['produit']);

        //NOMBRE_SAC=POIDS
        $poids=$_POST['poids'];
        $connaissement=$_POST['connaissement'];
      //  $produit=explode('-', $_POST['produit']);

        $poids_sac=$_POST['poids_sac_en_vrac'];
        
        //$client=$_POST['client'];
        //$poids1=$explode_bl[1];
        
    
        
        $des_doua=$_POST['destination_douaniere'];

        $decharge=$_POST['type_chargement'];
        if($decharge==1){
           $poids_sac=$_POST['poids_sac_en_vrac']; 
            $nombre_sac=$poids*1000/$poids_sac;
        }
        if($decharge==2){
           $poids_sac=0; 
           $nombre_sac=0;
        }
         
         

      $produit=$_POST['produit'];

     
    
             $insertDispat= $bdd->prepare("INSERT INTO dispats(quantite_sac,quantite_poids,poids_kgs,des_douane,type_decharge,id_con_dis,id_mangasin,id_produits) VALUES(?,?,?,?,?,?,?,?)");
             

        
         
         $insertDispat->bindParam(1,$nombre_sac);
         
         $insertDispat->bindParam(2,$poids);
         $insertDispat->bindParam(3,$poids_sac);
        
         $insertDispat->bindParam(4,$des_doua);
          $insertDispat->bindParam(5,$decharge);
           $insertDispat->bindParam(6,$connaissement);

         
          $insertDispat->bindParam(7,$destination);
          $insertDispat->bindParam(8,$produit);

        
         $insertDispat->execute();

        if(!empty($_FILES['image'])){
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    //$id=$_POST['ids'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000) { // taille maximale de 1 Mo
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads_fichier/'.$fileNameNew;
                $arriereDestination='../';
                move_uploaded_file($fileTmpName, $arriereDestination.$fileDestination);

                // Enregistrement de l'information de l'image dans la base de données
                $select=$bdd->query("select id_dis from dispats order by id_dis desc");
                if($sel=$select->fetch()){
               
                $req =$bdd->prepare("INSERT INTO fichier_mangasin (nom_fichier_mg, path_fichier_mg, taille_fichier_mg, type_fichier_mg, id_fichier_dis) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$sel['id_dis']);
                $req->execute();
               

                echo "Votre fichier a été téléchargé avec succès.";
            }
            else {
                echo "Une Erreur de Reseau est survenue ";
            }
                
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
}
else {
        echo "veuillez choisir un fichier.";
    } 
   
}

    
     
   


    $afficher=$bdd->prepare("SELECT dis.*, cli.client,nc.num_connaissement,nc.poids_kg, nc.poids_connaissement,nc.id_navire, mg.mangasin, p.produit,p.qualite from dispats as dis
   # inner join declaration as d on d.id_declaration=dis.declaration_id 
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis 
    inner join client as cli on nc.id_client=cli.id
    inner join mangasin as mg on dis.id_mangasin=mg.id
    inner join produit_deb as p on dis.id_produits=p.id
    
  where nc.id_navire=?");
$afficher->bindParam(1,$idm);
$afficher->execute(); 

?>
     <div  class="table-responsive" border=1 id='tableau_dispatching' >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
    <thead>
        <td colspan="9" style="background: blue; color:white; text-align:center;">DONNEES DEJA INSERES</td>
    <tr style="color: white; background: blue; font-size:12px;">
    <th>BL</th>
    <th>CLIENT</th>
    <th>PRODUIT</th>
    <th>SACS</th>
    <th>POIDS</th>
   
    <th>DESTINATION</th>
    <th>ACTION</th>
    
 </tr>
    </thead>
<tbody>

 <?php while($aff=$afficher->fetch()){ ?>
<tr  style="background: white; color:black; text-align:center; vertical-align: middle;">
    <td><?php echo $aff['num_connaissement'] ?></td>
    <td><?php echo $aff['client'] ?></td>

    <td><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <?php echo $aff['poids_kgs'].' KG' ?></td>

    <td><?php echo $aff['quantite_sac'] ?></td>

    <td><?php echo $aff['quantite_poids'] ?></td>

    <td><?php echo $aff['mangasin'] ?></td>
    <td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_dispatching" data-id="<?php echo $aff['id_dis']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteDispatching(<?php echo $aff['id_dis'] ?>)"><i class="fas fa-trash"></i></a></td> 
<span id=<?php echo $aff['id_dis'].'navire_diss' ?>><?php echo $aff['id_navire'] ?></td>
 <?php } ?>

    </tbody>

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
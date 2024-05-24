<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select dis.*, cli.id as idcli,cli.client,p.id as idprod, p.*, mg.id as idmg, mg.mangasin from dispatching as dis inner join client as cli on dis.id_client=cli.id inner join mangasin as mg on dis.id_mangasin=mg.id
inner join produit_deb as p on dis.id_produit=p.id
 where dis.id_dis=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();







if (isset($_POST['modifier_dispatching'])) {
    
    if(!empty($_POST['poids'])  and !empty($_POST['sac']) ){

      
      $poids= $_POST['poids'];
      $nombre_sac=$_POST['sac'];
      $poids_t=$poids*$nombre_sac/1000;
      $client= $_POST['client'];
      $mangasin= $_POST['mangasin'];
      $produit= $_POST['produit'];
      $statut= $_POST['statut'];
      $affreteur= $_POST['affreteur'];
      $banque= $_POST['banque'];
      $bl= $_POST['bl'];
      

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE  dispatching set id_client=?, n_bl=?,  nombre_sac=? , poids_kg=?, poids_t=? ,id_mangasin=? , id_produit=?, des_douane=? ,affreteur=?, banque=?    where id_dis=? "); 

$insertRecep1->bindParam(1,$client);
$insertRecep1->bindParam(2,$bl);
$insertRecep1->bindParam(3,$nombre_sac); 
$insertRecep1->bindParam(4,$poids);
$insertRecep1->bindParam(5,$poids_t);
$insertRecep1->bindParam(6,$mangasin);
$insertRecep1->bindParam(7,$produit);
$insertRecep1->bindParam(8,$statut);
$insertRecep1->bindParam(9,$affreteur);
$insertRecep1->bindParam(10,$banque);
$insertRecep1->bindParam(11,$_GET['id']);





$insertRecep1->execute();

echo "INSERTION REUSSI ";
header('location:debarquement.php');
/*else{
    echo "erreurrrrrrrrrrrrrrr";
}*/
}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}

}
else{
  echo "ERREUR "; 
 
}



    
}

 

 ?>
 <!doctype html>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>
</head>
<body >


<style type="text/css">
	*{
		font-family: Times New Roman;
	}
  .logoo{
      border-radius: 50px;
       height: 150px;
        width: 200px;
       
        z-index: 2;
        text-align: center;

    }
    .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }

 .btn{
  background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
       color:white;
       font-weight: bold;
       width: 50%;
 }
#exampleFormControlInput1{
  width: 50%;

}

</style>


<div class="" id="cli">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">
          

     <?php while($row=$res4n->fetch()){ 

  
      ?>

<center>

   <div class="mb-3">

<label>PRODUIT</label><br>
 <select name="produit">
    <?php   
    $produitfind=$bdd->query("select * from produit_deb");  ?>

       <option value="<?php  echo $row['idprod']; ?>" > <?php  echo $row['produit']; ?> </option>

<?php   while ($mgRow = $produitfind->fetch()) { ?>
   <option value="<?php  echo $mgRow['id']; ?>" > <?php  echo $mgRow['produit']; ?> </option>
    <?php } ?>
  </select><br><br>

  <label>BL</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="bl" value=<?php echo $row['n_bl'] ?> ><br>
    
    <label>CONDITIONNEMENT</label>  
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="poids" value=<?php echo $row['poids_kg'] ?> > <br>
  <label>QUANTITE</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="sac" value=<?php echo $row['nombre_sac'] ?> ><br>

   <label> RECEPTIONNAIRE</label><br>
 <?php   $client=$bdd->query("select * from client") ?>
    <select style="width: 50%;" name="client">
      
      <option value=<?php  echo $row['idcli']; ?> > <?php   echo $row['client']; ?> </option>
      <?php while ($cli=$client->fetch()) { ?>
     <option value=<?php echo $cli['id']; ?> > <?php   echo $cli['client']; ?> </option>
   <?php } ?>
     

    </select><br><br>

  <label> MANGASIN</label><br>
 <?php   $mangasine=$bdd->query("select * from mangasin") ?>
    <select style="width: 50%;" name="mangasin">
      
      <option value=<?php  echo $row['idmg']; ?> > <?php   echo $row['mangasin']; ?> </option>
      <?php while ($rmang=$mangasine->fetch()) { ?>
     <option value=<?php echo $rmang['id']; ?> > <?php   echo $rmang['mangasin']; ?> </option>
   <?php } ?>
     

    </select><br><br>
  
  <label>STATUT</label><br>
 <select name="statut">
       <option value="<?php  echo $row['des_douane']; ?>" > <?php  echo $row['des_douane']; ?> </option>
       <option value="TRANSFERT" > TRANSFERT </option>
       <option value="LIVRAISON" > LIVRAISON </option>

   
  </select><br><br>

   <label>BANQUE</label><br>
 <select name="banque">
 <?php   $banque=$bdd->query("select banque from banque"); ?>
       <option value="<?php  echo htmlspecialchars($row['banque']); ?>" > <?php  echo $row['banque']; ?> </option>
       <?php while($bank=$banque->fetch()){ ?>
        <option value="<?php  echo htmlspecialchars($bank['banque']); ?>" > <?php  echo $bank['banque']; ?> </option>

<?php } ?>
   
  </select><br><br>

   <label>FOURNISSEUR</label><br>
 <select name="affreteur">
 <?php   $affreteur=$bdd->query("select affreteur from affreteur"); ?>
       <option value="<?php  echo htmlspecialchars($row['affreteur']); ?>" > <?php  echo $row['affreteur']; ?> </option>
       <?php while($aff=$affreteur->fetch()){ ?>
        <option value="<?php  echo htmlspecialchars($aff['affreteur']); ?> " > <?php  echo $aff['affreteur']; ?> </option>
<?php } ?>

   
  </select><br><br>
    
</div>


</center>

   <?php } ?>


         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_dispatching">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



 

</body>
</html>

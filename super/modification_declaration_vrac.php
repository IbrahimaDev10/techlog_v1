<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select dc.*,p.* from declaration_chargement dc
 inner join produit_deb as p on p.id=dc.id_produit
   where dc.id_dec=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();







if (isset($_POST['modifier_declaration'])) {
    
    if(!empty($_POST['poids']) and !empty($_POST['nom_chargeur'])  and !empty($_POST['cales'])  ){

      $cales= $_POST['cales'];
      $nom_chargeur=$_POST['nom_chargeur'];
      $poids= $_POST['poids'];
      $produit=$_POST['produit'];

     
      



try{
 
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set cales=?, nom_chargeur=?,  poids=?,  id_produit=?  where id_dec=? "); 



$insertRecep1->bindParam(1,$cales); 
$insertRecep1->bindParam(2,$nom_chargeur);

$insertRecep1->bindParam(3,$poids);
$insertRecep1->bindParam(4,$produit);


$insertRecep1->bindParam(5,$_GET['id']);

$insertRecep1->execute();

echo "INSERTION REUSSI ";
echo '<script>window.close();</script>';
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



 
 
 


    
    // arrêt du script pour éviter l'affichage de la page actuelle après la soumission du formulaire
    
}

    $produitss=$bdd->query("select * from produit_deb");?>

     


 ?>
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
    <select  name="produit"   style="width: 50%;" >
      <option value=<?php echo $row['id_produit']; ?> > <?php echo $row['produit']; ?><?php echo $row['qualite']; ?></option>
      <?php while($prod=$produitss->fetch()){ ?>
      <option value=<?php echo $prod['id']; ?> > <?php echo $prod['produit']; ?><?php echo $prod['qualite']; ?></option>
      <?php } ?>

    </select><br><br>  

  <label>POIDS</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="poids" value=<?php echo $row['poids'] ?> ><br>
  <label>NOM CHARGEUR</label>
   <input type="text" class="form-control"  id="exampleFormControlInput1"  name="nom_chargeur" value="<?php echo htmlspecialchars($row['nom_chargeur']); ?>" ><br>
   <label>CALE</label>
    <input type="text" class="form-control"  id="exampleFormControlInput1"  name="cales" value=<?php echo $row['cales'] ?> ><br>
    
</div>


</center>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>

<?php } ?>

 

</body>
</html>

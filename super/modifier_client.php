<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select * from client where id=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();





if (isset($_POST['modifier_client'])) {
    
    if(!empty($_POST['client'])  ){

        $client=$_POST['client'];
        $code=$_POST['code_ppm'];
        $adresse=$_POST['adresse'];
        $tel=$_POST['tel'];

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE client set client=?, code_ppm_client=?, adresse_client=? , tel_client=?  where id=? "); 



$insertRecep1->bindParam(1,$client); 
$insertRecep1->bindParam(2,$code);
$insertRecep1->bindParam(3,$adresse);
$insertRecep1->bindParam(4,$tel);

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



     <?php while($row=$res4n->fetch()){ 

      
        
        

      ?>

<center>

   <div class="mb-3">
    <label>CLIENT</label>  
  <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="client" value="<?php echo htmlspecialchars($row['client'])  ?>" ><br>
   <label>CODE PPM</label>
   <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="code ppm" name="code_ppm" value="<?php echo htmlspecialchars($row['code_ppm_client'])  ?>" ><br>
    <label>ADRESSE</label>
    <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="adresse" value="<?php echo htmlspecialchars($row['adresse_client'])  ?>" ><br>
     <label>TELEPHONE</label>
     <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="tel" value="<?php echo htmlspecialchars($row['tel_client'])  ?>" ><br>
     <label>EMAIL</label>
      <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="email" value="<?php echo htmlspecialchars($row['email_client'])  ?>" >
</div>


</center>



         <center>
        <button  type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_client">valider</button>
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

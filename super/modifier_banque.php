<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select * from banque where id=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();





if (isset($_POST['modifier_client'])) {
    
    if(!empty($_POST['client'])  ){

        $client=$_POST['client'];
       $adresse=$_POST['adresse'];
        $tel=$_POST['tel'];

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE banque set banque=?,  adresse_banque=? , tel_banque=?  where id=? "); 



$insertRecep1->bindParam(1,$client); 
$insertRecep1->bindParam(2,$adresse);
$insertRecep1->bindParam(3,$tel);
$insertRecep1->bindParam(4,$_GET['id']);

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
    <label>BANQUE</label>  
  <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="client" value="<?php echo htmlspecialchars($row['affreteur'])  ?>" ><br>
  
    <label>ADRESSE</label>
    <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="adresse" value="<?php echo htmlspecialchars($row['adresse_banque'])  ?>" ><br>
     <label>TELEPHONE</label>
     <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="tel" value="<?php echo htmlspecialchars($row['te_banque'])  ?>" ><br>
     <label>EMAIL</label>
      <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="email" value="<?php echo htmlspecialchars($row['email_banque'])  ?>" >
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

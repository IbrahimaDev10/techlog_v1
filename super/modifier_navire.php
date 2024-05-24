<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select * from navire_deb where id=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();


$affreteur= $bdd->prepare("select * from affreteur where id=?  ");
        $affreteur->bindParam(1,$_GET['id']);
        $affreteur->execute();        





if (isset($_POST['modifier_navire'])) {
    
    if(!empty($_POST['navire']) and !empty($_POST['load_port']) and !empty($_POST['destination'])  and !empty($_POST['eta']) and !empty($_POST['etb']) and !empty($_POST['etd']) ){

      $navire= $_POST['navire'];
      $load_port= $_POST['load_port'];
      $destination= $_POST['destination'];
      $description= $_POST['description'];
      $eta=explode("-", $_POST['eta']);
      $etb=explode("-", $_POST['etb']);
      $etd=explode("-", $_POST['etd']);

      $etaUpdate=$eta[2].'-'.$eta[1].'-'.$eta[0];
      $etbUpdate=$etb[2].'-'.$etb[1].'-'.$etb[0];
      $etdUpdate=$etd[2].'-'.$etd[1].'-'.$etd[0];

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE navire_deb set navire=?, load_port=?, destination=?,  eta=?, etb=?, etd=?  where id=? "); 



$insertRecep1->bindParam(1,$navire); 
$insertRecep1->bindParam(2,$load_port);
$insertRecep1->bindParam(3,$destination);

$insertRecep1->bindParam(4,$etaUpdate);
$insertRecep1->bindParam(5,$etbUpdate);
$insertRecep1->bindParam(6,$etdUpdate);

$insertRecep1->bindParam(7,$_GET['id']);

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


      //$eta1=str_replace(" ", "_", $row['eta']);
      //$etb1=str_replace(" ", "_", $row['etb']);
      //$etd1=str_replace(" ", "_", $row['etd']);
      $eta1=explode("-", $row['eta']);
      $etb1=explode("-", $row['etb']);
      $etd1=explode("-", $row['etd']);

 
     

        
        

      ?>

<center>

   <div class="mb-3">
    <label>NAVIRE</label>  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="navire" value="<?php echo htmlspecialchars($row['navire']) ?>" > <br>
  <label>LOAD PORT</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="load_port" value="<?php echo htmlspecialchars($row['load_port']) ?>" ><br>
  <label>DESTINATION</label>
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="destination" value="<?php echo htmlspecialchars($row['destination']) ?>" ><br>
  
    <label>ETA</label>
     <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="eta" value=<?php echo $eta1[2].'-'.$eta1[1].'-'.$eta1[0] ?> ><br>
     <label>ETB</label>
      <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="etb" value=<?php echo $etb1[2].'-'.$etb1[1].'-'.$etb1[0] ?> ><br>
      <label>ETD</label>
       <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="etd" value=<?php echo $etd1[2].'-'.$etd1[1].'-'.$etd1[0] ?> >
</div>


</center>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_navire">valider</button>
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

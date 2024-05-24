<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select trans.*, dis.*, cli.id as idcli,cli.client,p.id as idprod, p.*, mg.id as idmg, mg.mangasin from transit as trans
inner join dispatching as dis on dis.id_dis=trans.id_bl
 inner join client as cli on dis.id_client=cli.id inner join mangasin as mg on dis.id_mangasin=mg.id
inner join produit_deb as p on dis.id_produit=p.id
 where trans.id_trans=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();







if (isset($_POST['modifier_dispatching'])) {
    
    if(!empty($_POST['numero_declaration']) ){

      
      $poids_declarer= $_POST['poids_declarer'];
      
      $destination_douaniere=$_POST['destination_douaniere'];
      $numero_declaration= $_POST['numero_declaration'];
      $bl= $_POST['bl'];
     
      $statut_douaniere= $_POST['statut_douaniere'];
      $n_manifeste= $_POST['n_manifeste'];

      

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE  transit set n_manifeste=?, destination_douaniere=?, numero_declaration=?,  poids_declarer=? , statut_douaniere=?, id_bl=?     where id_trans=? "); 

$insertRecep1->bindParam(1,$n_manifeste);
$insertRecep1->bindParam(2,$destination_douaniere);
$insertRecep1->bindParam(3,$numero_declaration); 
$insertRecep1->bindParam(4,$poids_declarer);
$insertRecep1->bindParam(5,$statut_douaniere);
$insertRecep1->bindParam(6,$bl);
$insertRecep1->bindParam(7,$_GET['id']);

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



   <label>BL</label><br>
 <select name="bl">
 <?php   $bl=$bdd->prepare("select dis.*,mg.* from dispatching as dis
   inner join mangasin as mg on dis.id_mangasin=mg.id
   where dis.id_navire=?");
 $bl->bindParam(1,$row['id_navire']);
 $bl->execute();

    ?>
       <option value="<?php  echo $row['id_dis']; ?>" > <?php   echo 'bl: ' .$row["n_bl"]. '   (destination: ' .$row["mangasin"].')'; ?> </option>
       <?php while($bls=$bl->fetch()){ ?>
        <option value="<?php  echo $bls['id_dis']; ?>" >  <?php   echo 'bl: ' .$bls["n_bl"]. '   (destination: ' .$bls["mangasin"].')'; ?> </option>

<?php } ?>
   
  </select><br><br>

  <label>NUMERO MANIFESTE</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="n_manifeste" value="<?php echo htmlspecialchars($row['n_manifeste']); ?>" ><br>

   <label>NUMERO DECLARATION</label>
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="numero_declaration" value="<?php echo htmlspecialchars($row['numero_declaration']) ?>" ><br>
    
    <label>POIDS DECLARER</label>  
  <input type="text" class="form-control"  id="exampleFormControlInput1" name="poids_declarer" value=<?php echo $row['poids_declarer'] ?> > <br>
  

   
  
  <label>STATUT</label><br>
 <select name="statut_douaniere">
       <option value="<?php  echo $row['statut_douaniere']; ?>" > <?php  echo $row['statut_douaniere']; ?> </option>
       <option value="AES" > AES </option>
       <option value="AMEF" > AMEF </option>
       <option value="AUTRES" > AUTRES </option>

   
  </select><br><br>

   
   <label>DESTINATION DOUANIERE</label><br>
 <select name="destination_douaniere">
 
       <option value="<?php  echo $row['destination_douaniere']; ?>" > <?php echo $row['destination_douaniere']; ?> </option>
       
        <option value="DECLARATION" > DECLARATION </option>
        <option value="TRANSFERT" > TRANSFERT </option>
        <option value="APE">APE</option>
         <option value="AUTRES" >AUTRES</option>

   
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

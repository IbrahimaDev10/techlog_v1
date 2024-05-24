<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select * from mangasin   where id=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();





if (isset($_POST['modifier_client'])) {
    
    if(!empty($_POST['entrepot'])  ){

        

        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE mangasin set code=?, mangasin=?, adresse=?,  code=?, num_agrement=?,  superficie=?, sac_stock=?, poids_stock=?,  prenom_mang=?,  tel_mang=?, email_mang=?  where id=? "); 

$adresse=$_POST['adresse'];
$entrepot=$_POST['entrepot'];
$agrement=$_POST['agrement'];
$code=$_POST['code'];
$tel=$_POST['tel'];
$superficie=str_replace(" ", "", $_POST['superficie']);
$mang=$_POST['mangasinier'];
$email=$_POST['email'];
$poids=$_POST['poids'];
$sac=$poids*1000/50;


$insertRecep1->bindParam(1,$code); 
$insertRecep1->bindParam(2,$entrepot); 
$insertRecep1->bindParam(3,$adresse); 
$insertRecep1->bindParam(4,$code); 
$insertRecep1->bindParam(5,$agrement);
$insertRecep1->bindParam(6,$superficie);
$insertRecep1->bindParam(7,$sac);
$insertRecep1->bindParam(8,$poids);
$insertRecep1->bindParam(9,$mang);
$insertRecep1->bindParam(10,$tel);
$insertRecep1->bindParam(11,$email);

$insertRecep1->bindParam(12,$_GET['id']);

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
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION ENTREPOT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     <?php while($row=$res4n->fetch(PDO::FETCH_ASSOC)){ 

 

      ?>

<center>

   <div class="mb-3">
    <label>ENTREPOT</label>  
  <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="entrepot" name="entrepot" value="<?php echo htmlspecialchars($row['mangasin'])  ?>" ><br>
  <label>NUMERO D'AGREMENT</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="entrepot" name="agrement" value="<?php echo htmlspecialchars($row['num_agrement'])  ?>" ><br>

  <label>CODE D'ENTREPOT</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="entrepot" name="code" value="<?php echo htmlspecialchars($row['code'])  ?>" ><br>

   <label>ADRESSE</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="adresse" value="<?php echo htmlspecialchars($row['adresse'])  ?>" ><br>

   <label>SUPERFICIE</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="superficie" name="superficie" value="<?php echo  htmlspecialchars(number_format($row['superficie'],0,',',' '))  ?>" ><br>

    <label>CAPACITE DE STOCKAGE EN POIDS</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="poids" value="<?php echo  htmlspecialchars(number_format($row['poids_stock'],0,',',' '))  ?>" ><br>

   <label>PRENOM ET NOM MANGASINIER</label>
   <input style="height: 30px;" type="text" class="form-control"  id="exampleFormControlInput1" placeholder="" name="mangasinier" value="<?php echo htmlspecialchars($row['prenom_mang']);  ?>" ><br>
   <label>TELEPHONE</label>
   <center>
   <input style="height: 30px; width: 50%;" type="text" class="form-control"  id="telephoneInput"    name="tel" data-inputmask="'mask': '99 999 99 99'" value="<?php echo htmlspecialchars($row['tel_mang']);  ?>" ><br>
 </center>

   <label>EMAIL</label>
   <input style="height: 30px;" type="text" class="form-control" id="exampleFormControlInput1"   placeholder="" name="email" value="<?php echo htmlspecialchars($row['email_mang']);  ?>" ><br>


</div>


</center>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_client">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>

<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>



 <script>
$(document).ready(function() {
  $('#telephoneInput').inputmask();
});
</script>

 

</body>
</html>

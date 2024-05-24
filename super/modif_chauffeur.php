<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("select * from chauffeur as ch
  
  where id_chauffeur=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();
$transp=$bdd->query("select * from transporteur order by id desc");




if (isset($_POST['valider_chauffeur'])) {
    
    if(!empty($_POST['chauffeur'])   and !empty($_POST['permis'])    and !empty($_POST['tel'])  ){

        $chauffeur= $_POST['chauffeur'];
        
        $permis= $_POST['permis']; 
        $tel= $_POST['tel'];
       
        
        
     
    
 

try{
 
     $insertRecep1= $bdd->prepare("UPDATE  chauffeur set nom_chauffeur=?, n_permis=?, num_telephone=? where id_chauffeur=? "); 



 
$insertRecep1->bindParam(1,$chauffeur);

$insertRecep1->bindParam(2,$permis);
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

<div class="" id="chauffeur">
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

      $chauffeur1=htmlspecialchars($row['nom_chauffeur']) ;
       
        $permis1= htmlspecialchars($row['n_permis']); 
        $tel1=htmlspecialchars($row['num_telephone']);
        
        

      ?>

<center>

   <div class="mb-3">
    <label>nom chauffeur</label>  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="chauffeur" name="chauffeur" value="<?php echo $chauffeur1 ?>" >
</div>
   
   <div class="mb-3">
   <label>permis</label>    
  <input type="text" class="form-control" style="" id="exampleFormControlInput1" placeholder="numero permis" name="permis" value="<?php echo $permis1 ?>" >
</div>
   <div class="mb-3">
   <label>telephone</label>
   <center>   
  <input type="text" class="form-control" style="width: 50%;"  id="telephoneInput"  placeholder="telephone" name="tel"  data-inputmask="'mask': '99 999 99 99'" value="<?php echo $tel1 ?>" >
  </center>
</div>


</center>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_chauffeur">valider</button>
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

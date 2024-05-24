<?php 	
require('../database.php');
echo $_GET['id'];

$resid= $bdd->prepare("SELECT id_register_manif      FROM register_manifeste

                   WHERE id_register_manif=?  ");
        $resid->bindParam(1,$_GET['id']);
        $resid->execute();


if(isset($_POST['archiver'])){
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    //$id=$_POST['ids'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) { // taille maximale de 1 Mo
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                // Enregistrement de l'information de l'image dans la base de données
               
                $req =$bdd->prepare("INSERT INTO archivrage (nom_archive, path_archive, taille_archive, type_archive, id_register_archive) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$_GET['id']);
                $req->execute();
               

                echo "Votre fichier a été téléchargé avec succès.";
                header('location:tr_manifest.php');
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



 ?>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
   <?php include('tr_link.php'); ?>
	
</head>
<body >


<style type="text/css">
	*{
		font-family: Times New Roman;
	}
	
</style>
<div class="" id="fichier" tabindex="-1" >
  <div class="modal-dialog" style="z-index: 1;">
    <center>
    <div class="modal-content" style=" border: solid; border-color: blue;">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">ARCHIVRAGE</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" enctype="multipart/form-data">

   <div class="mb-3">
    <label for="image">Choisir une image :</label>
  <input type="file" name="image" id="image">
  <input type="text" name="ids" id="id_image">

   <?php while ($rown=$resid->fetch()){ ?>

    
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_manif"    value=<?php  
        echo $rown['id_register_manif'];
    ?> >

</div>
<?php } ?>
      
 
 <div class="mb-3">
  <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="archiver" id="deb" >enregistrer</button></center>
</form> 
      </div>  
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>



</body>
</html>

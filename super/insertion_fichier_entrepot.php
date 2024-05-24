<?php 	
require('../database.php');

$titremangasin= $bdd->prepare("SELECT id FROM mangasin

                   WHERE id=?  ");
        $titremangasin->bindParam(1,$_GET['id']);
       $titremangasin->execute();

$resid= $bdd->prepare("SELECT id FROM mangasin

                   WHERE id=?  ");
        $resid->bindParam(1,$_GET['id']);
        $resid->execute();


if(isset($_POST['fichier_entrepot'])){
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
                move_uploaded_file($fileTmpName, $fileDestination);

                // Enregistrement de l'information de l'image dans la base de données
               
                $req =$bdd->prepare("INSERT INTO fichier_entrepot (nom_fichier_ent, path_fichier_ent, taille_fichier_ent, type_fichier_ent, id_fichier_entrepot) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$_GET['id']);
                $req->execute();
               

                echo "Votre fichier a été téléchargé avec succès.";
                
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

$fichier=$bdd->prepare('select * from fichier_entrepot where id_fichier_entrepot=?');
$fichier->bindParam(1,$_GET['id']);
$fichier->execute();

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
	
</style>

  <div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); top: 0px;" >
        <div class="sidebar-content"> 
          <div id="sidebar">
      
      <!-- Logo -->
      <div class="logo">
          <h2 class="mb-4"><img style="width: 150px; height: 150px;  border-radius: 50px; color: white;" src="../assets/images/mylogo.ico"> </h2>
      </div>

            <ul class="side-menu">
                <li>
          <a  href="" class="active">
            <i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
          </a>
    <?php include('page.php'); ?>
        </li>
    
 <?php include('ajout_nouvelle_donnees.php'); ?>
 

        
     <li>
                    <a href="#">
            <i class='bx bx-data icon bx-4x' style="color: yellow;" ></i> 
            MES DONNEES
            <i class='bx bx-chevron-right icon-right' ></i>
          </a>
                    <ul class="side-dropdown">


                       <li><button  class="btn text-white "   id="btnNavire" onclick="visible_navire()"> NAVIRES</button></li>
            <li><button  class="btn text-white "  onclick="visible_produit()"> PRODUITS</button></li>
            <li><button  class="btn text-white "  onclick="visible_client()"> CLIENTS</button></li>
            <li><button  class="btn text-white "  onclick="visible_entrepots()"> ENTREPOTS</button></li>
            <li><button  class="btn text-white "  onclick="visible_transporteur()"> TRANSPORTEURS</button></li>
            <li><button  class="btn text-white "  onclick="visible_chauffeur()"> CHAUFFEURS</button></li>
                                    
                    </ul>
                </li>                              
                                      




        
                           



               

        <!-- Divider-->
                
  

 




               
            </div>
        </div>

       </div> 
   </div>
  </div><!-- End Sidebar-->


<center>
<div class="" id="fichier" tabindex="-1" style="width: 80%;" >
  <div class="modal-dialog" style="z-index: 1; ">
    <center>
    <div class="modal-content" style=" border: solid; border-color: blue; ">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">FICHIER JOINT</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" enctype="multipart/form-data">

   <div class="mb-3">
    
  <input type="file" name="image" id="image">
  

   <?php while ($rown=$resid->fetch()){ ?>

    
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_manif" hidden="true"   value=<?php  
        echo $rown['id'];
    ?> >

</div>
<?php } ?>
      
 
 <div class="mb-3">
  
        <button style="float: left;" type="submit" class="btn btn-primary " style="text-align: center;" name="fichier_entrepot" id="deb"  >Joindre</button>
        <br><br>
</form> 
      </div> 
      <div style="float: right;"></div> 

       <div class="mb-3">
        <?php while($fiche=$fichier->fetch()){

          ?>
          <div id="<?php echo $fiche['id_fich_ent'].'entrepot' ?>">
          <a target="blank_page" href="<?php echo $fiche['path_fichier_ent']; ?>" style="float: left;"><i class="fas fa-file-pdf " style="color: red; "></i><?php echo $fiche['nom_fichier_ent'] ?></a><a style="float:right;"  id="<?php echo $fiche['id_fichier_entrepot'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteFichier(<?php echo $fiche['id_fichier_entrepot'] ?>)" > <i class="fa fa-trash   " ></i> </a> <br><br>
          </div>
        <?php } ?>
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>
</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- General JS Scripts -->
  <script src="../assets/js/atrana.js"></script>

  <!-- JS Libraies -->
  <script src="../assets/modules/jquery/jquery.min.js"></script>
  <script src="../assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/modules/popper/popper.min.js"></script>

  <!-- Chart Js -->
  <script src="../assets/modules/apexcharts/apexcharts.js"></script>
  <script src="../assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/custom.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteFichier(id){
   
       if(confirm('Voulez vous vraiment supprimer ce fichier?')){
         
         $.ajax({

              type:'post',
              url:'delete_fichier_entrepot.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'entrepot').hide('slow');

              }

         });

       }


     }

 


 </script>


</body>
</html>

<?php   
require('../database.php');

require("controller/recap_bl.php");


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
               
                $req =$bdd->prepare("INSERT INTO fichier_liv_balayure (nom_fichier_liv_balayure , path_fichier_liv_balayure , taille_fichier_liv_balayure , type_fichier_liv_balayure , id_fichier_liv_balayure ) VALUES (?,?,?,?,?)");
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
    } 
   
}

$fichier=$bdd->prepare('select * from fichier_liv_balayure  where id_fichier_liv_balayure =?');
$fichier->bindParam(1,$_GET['id']);
$fichier->execute();

 ?>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Debarquement</title>
<link rel="stylesheet" type="text/css" href="css/imprimer_bl_transfert_avaries.css">
  <!-- Bootstrap CSS-->
   <?php include('../super/link_deb.php'); ?>
  
</head>
<body >


<style type="text/css">
  *{
    font-family: Times New Roman;
  }
  
</style>

  

<center>

<div class="container-fluid"  id="recap_bl"  style="width: 50%; background: white;" >
  <div class="row">
    
   <?php $id=$_GET['id'];
   $donnees=ticket_livraison_balayure($bdd,$id);
  if($dnn=$donnees->fetch()){ ?>

    <div  class="col col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 30px; width: 150px;">
  </div>
    
  <div style="float: right; margin-top: 15px;" class="col col-md-12  col-lg-12"> <h6 class="segment"> BL N°:  <?php echo $dnn['id_bal']; ?> </h6></div><br>

      
      <div style="float: left;" class="col col-md-4 col-lg-4"> <h6 class="segment"> NAVIRE: <span  class="titre_info"> <?php echo $dnn['navire']; ?> </span></h6></div>
       <div class="col col-md-4 col-lg-4"><h6 class="segment"> PRODUIT: <span class="titre_info"> <?php echo $dnn['produit']; ?> <?php echo $dnn['poids_kg'].' KGS'; ?>  </span></h6></div>
       <div   class="col col-md-4 col-lg-4"> <h6 class="segment"> ENTREPOT: <span class="titre_info"> <?php echo $dnn['mangasin']; ?> </span></h6></div>
       <div   class="col col-md-4 col-lg-4"> <h6 class="segment"> CONNAISSEMENT: <span class="titre_info"> <?php echo $dnn['n_bl']; ?> </span></h6></div>
        <div   class="col col-md-6 col-lg-6"> <h6 class="segment"> DECLARTION/TRANSFERT: <span class="titre_info"> <?php echo $dnn['num_decliv']; ?> </span></h6></div>
         <div   class="col col-md-6 col-lg-3"> <h6 class="segment"> BANQUE :<span class="titre_info"> <?php echo $dnn['banque']; ?> </span></h6></div>
<br><br>
        <div class="col col-md-12 col-lg-12" style="border: solid; border-top:2px; border-left:none; border-right: none; border-color:rgba(50, 159, 218, 0.9);"   > </div>
        
        <div style="float: left; margin-top:15px;" class="col col-md-6 col-lg-6"> <h6 class="segment"> NOMBRE SAC : <span class="titre_info"> <?php echo $dnn['sac_bal']; ?> </span></h6></div>
         <div style="margin-top:15px;" class="col col-md-6 col-lg-6"> <h6 class="segment"> POIDS  <span class="titre_info"> <?php echo $dnn['poids_bal']; ?> </span></h6></div>
 
      

       
       <div style="float:left;" class="col col-md-6 col-lg-4"> <h6 class="segment"> CAMIONS: <span class="titre_info"> <?php echo $dnn['camion_bal']; ?> </span></h6></div>
       <div  class="col col-md-4 col-lg-4"> <h6 class="segment"> CHAUFFEUR: <span class="titre_info"> <?php echo $dnn['chauffeur_bal']; ?> </span></h6></div>
       <div  class="col col-md-4 col-lg-4"> <h6 class="segment"> PERMIS: <span class="titre_info"> <?php echo $dnn['num_permis_bal']; ?> </span></h6></div>
        <div  class="col col-md-4 col-lg-4"> <h6 class="segment"> TELEPHONE: <span class="titre_info"> <?php echo $dnn['tel_bal']; ?> </span></h6></div>
      <div class="col col-md-12 col-lg-12" style="border: solid; border-top:2px; border-left:none; border-right: none; border-color:rgba(50, 159, 218, 0.9);"   > </div>
      <br><br>

<?php } ?>



       <div id="no-print">


<form method="POST" enctype="multipart/form-data">
  <div style="display: flex; justify-content: center;">
    <div style="float: left;" class="col col-md-4 col-lg-4">
        <button  type="submit" class="btn btn-primary " style="text-align: center;" name="fichier_entrepot" id="deb"  > Joindre</button>
        </div>
         <div class="col col-md-4 col-lg-4">
         <input style="margin-top: 10px; height: 50px;" type="file" name="image" id="image">
       </div>
       <div style="float: right; " class="col-md-4 col-lg-4">
         <a style="margin-top: 10px;"  class="btn btn-primary " style="text-align: center;"  data-role="imprimer_bl_deb"  >imprimer</a>
         </div>
         </div>
        <br><br>
</form> 
   
      

       
        <?php while($fiche=$fichier->fetch()){

          ?>
          <div id="<?php echo $fiche['id_fich_liv_balayure'].'entrepot' ?>">
          <a target="blank_page" href="<?php echo $fiche['path_fichier_liv_balayure']; ?>" style="float: left;"><i class="fas fa-file-pdf " style="color: red; "></i><?php echo $fiche['nom_fichier_liv_balayure'] ?></a><a style="float:right;"  id="<?php echo $fiche['id_fichier_liv_balayure'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteFichier(<?php echo $fiche['id_fichier_liv_balayure'] ?>)" > <i class="fa fa-trash   " ></i> </a> <br><br>
          </div>
        <?php } ?>
       
     
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

 <script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_bl_deb]', function () {
           //$("#no-print").css('display','none');
            var contentToPrint = $('#recap_bl').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer_bl_transfert_avaries.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
       
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
   
</script>


</body>
</html>

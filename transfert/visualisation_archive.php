<?php 	
require('../database.php');


$image= $bdd->prepare("SELECT * FROM archivrage

                   WHERE id_register_archive=?  ");
        $image->bindParam(1,$_GET['id']);
        $image->execute();






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
  body{
    background: rgb(27,27,27);
  }
	
</style>
<div class="" id="fichier" tabindex="-1" >
  <div class="modal-dialog" style="z-index: 1;">
    <center>
    <div class="modal-content" style=" border: solid; border-color: blue;">
      <div class="modal-header bg-primary">
        <center>
          <?php while($rown=$image->fetch()) { ?>
   <img src="<?php echo $rown['path_archive'] ?>">
      </center>
       
</div>
<?php } ?>

      
 
  
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>



</body>
</html>

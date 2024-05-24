<?php 	
require('../database.php');

$a=explode('and', $_GET['id']);

$connaisment= $bdd->prepare("SELECT  id_register_manif from register_manifeste 
                
                   WHERE id_dis_bl=? and id_destination=?  ");
        $connaisment->bindParam(1,$a[0]);
        $connaisment->bindParam(2,$a[1]);
        $connaisment->execute();


       



 ?>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="assets/css/stylecell.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="../assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="assets/images/mylogo.ico"/>
</head>
<body >


<style type="text/css">
	*{
		font-family: Times New Roman;
	}
  body{
    background: rgb(27,27,27);
  }
.lien{
  color:rgb(231,200,24);
}
.nom{
  color:white;
}
.image{
  width: 300px;
  height: 150px;
  border: solid;
  border-color: white;
  margin-bottom: 25px;
}
	
</style>
<body>
  <div class="container-fluid">
<div class="row">
<div class="col col-lg-12 col-md-12">
  <center>
  <h3> <span class="nom">BL EN IMAGE </span> </h3>
  </center>
  <br>
</div> 
  <?php   while($con=$connaisment->fetch()){
    $img=$bdd->prepare("select ar.path_archive, rm.bl from register_manifeste as rm 
      inner join  archivrage as ar on rm.id_register_manif=ar.id_register_archive
      where rm.id_register_manif=?");
    $img->bindParam(1,$con['id_register_manif']);
    $img->execute();
  
  while($bl=$img->fetch()){


 ?>
<center>
 <div class="col col-lg-6 col-md-6" style="border: solid; border-color: white;">
 <h4> <span class="nom">BL NUMERO: <?php echo $bl['bl'] ?></span> </h4>
 <img class="image" src=<?php echo $bl['path_archive'] ?>>
<br>
 <button class="btn btn-primary">SCANNER</button>
 <br><br> 
 </div>
 </center>

<?php } } ?>

</div>
   </div>



</body>
</html>

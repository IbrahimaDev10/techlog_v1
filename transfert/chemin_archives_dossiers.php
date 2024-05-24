<?php 	
require('../database.php');


$connaisment= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*    FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                 

                   WHERE dis.id_navire=?  ");
        $connaisment->bindParam(1,$_GET['id']);
        $connaisment->execute();


       



 ?>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/stylecell.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">
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
	
</style>
<body>
  <div class="container-fluid">
<div class="row"> 
  <?php   while($con=$connaisment->fetch()){
 ?>

 <div class="col col-lg-2 col-md-6">
 <ul>
    <a class="lien"  href="visualisation_all_archive.php?id=<?php echo $con['id_dis']   ?>and<?php echo $con['id_mangasin']   ?>" ><i class="fa fa-folder fa-3x"></i> <br>  <span class="nom">  <?php  echo $con['produit'] ?> <?php  echo $con['poids_kg'] ?> kg </span> <br> destination: <span class="nom">  <?php echo $con['mangasin'] ?> </span></a>

  </ul>  
 </div>

<?php  } ?>

</div>
   </div>



</body>
</html>

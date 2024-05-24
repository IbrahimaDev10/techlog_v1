<?php 	
require('../database.php');


$navire= $bdd->query("select * from navire_deb");
       



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
  <?php   while($nav=$navire->fetch()){
 ?>
 <div class="col col-lg-2 col-md-6">
 <ul>
    <a class="lien"   href="chemin_archives_dossiers.php?id=<?php echo $nav['id']   ?>" ><i class="fa fa-folder fa-3x"></i> <br>  <span class="nom">  <?php  echo $nav['navire'] ?> du <?php echo $nav['eta'] ?></a></span>

  </ul>  
 </div>
<?php  } ?>

</div>
   </div>



</body>
</html>

<?php
require('../database.php');
require('controller/afficher_les_receptions.php');
require('controller/stock_depart.php');
require('controller/acces_reception.php');
require('controller/les_intervenants.php');

      $produit=$_POST['produit'];
      $poids_sac=$_POST['poids_sac'];
      $navire=$_POST['navire'];
      $destination=$_POST['destination'];
      $statut=$_POST['statut'];

?>

<div class="container-fluid" id="pv_reception" style=""> 

<?php include('body_pv.php'); ?>  


</div>

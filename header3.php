
<nav style="background: linear-gradient(to bottom, white,   rgb(0,162,232)); background: linear-gradient(to left, white, rgb(0,162,232)); background: linear-gradient(to top, white, rgb(0,162,232)); border: solid; border-color: white; border-width: 4px; z-index: 1; height: 120px; ">
  <img class="logo" src="images/mylogo.ico" style="width: 200px; height: 100px; ">
  
  <span class="titreNav text-white"  > <img class="logo" src="images/mylogo.ico"><span  class="lettreNav" style="font-weight:bold; color: white;">SIMAR</span></span>
  <h5 class="title" style="color: white; float: right; margin-top:40px;">SOCIETES DES INDUSTRIES MARITIMES </h5>
  <div style="display: none;">
  <ul>

    <li><a class="active" href="index.php" style="font-weight:bold">ACCUEIL</a></li>
    <li><a href="reception.php" style="font-weight:bold">RECEPTIONS</a></li>
    <li><a href="services.php" style="font-weight:bold">LIVRAISONS </a></li> 
    <li><a href="services.php" style="font-weight:bold">PAIEMENT </a></li>
    <li><a href="log.php" style="font-weight:bold">EMPLOYES </a></li>
    <?php 
//if (isset($_SESSION['id'])) {

     ?>
    <li><a class="btn"  href="logout.php">Deconnexion <i class="fas fa-sign-out-alt"></i> </a></li>
    <?php 
//}
     ?>

   
  </ul>
  </div>
  
</nav>



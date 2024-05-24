
  

  
 <link rel="stylesheet" type="text/css" href="nav.css"> 
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<nav>
  <img class="logo" src="images/mylogo.jpeg">
  <span class="titreNav text-white"   ><span  class="lettreNav">MAN</span></span>
  <ul>
    <li><a class="active" href="index.php">ACCUEIL</a></li>
    <li><a href="reception.php">RECEPTIONS</a></li>
    <li><a href="services.php">LIVRAISONS </a></li> 
    <li><a href="services.php">PAIEMENT </a></li>
    <li><a href="log.php">EMPLOYES </a></li>
    <?php 
//if (isset($_SESSION['aut'])) {


     ?>
    <li><a href="logout.php">Deconnexion </a></li>
    <?php 
//}
     ?>

   
  </ul>
  <label id="icon">
  <img class="iconbtn" src="images/menu.png">
  </label>
</nav>



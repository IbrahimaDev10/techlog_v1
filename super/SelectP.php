<?php
require('../database.php');
  
    if(isset($_POST["idProd"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idProd"];
$navire=$bdd->prepare("select * from produit_deb where id=?");
        $navire->bindParam(1,$b);
       
        
        $navire->execute();

  

?><?php while ($a=$navire->fetch()){ ?>

 value="<?php echo $a['id_produit']; ?>
<?php } ?>


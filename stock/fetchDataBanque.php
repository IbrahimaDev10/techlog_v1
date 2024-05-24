<?php 

require('../database.php');

if(isset($_POST['banqueChoisi'])){
	$search=$_POST['banqueChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from banque where banque like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="banqueTrouve">
        <a id="<?php echo $row['id']; ?>" value="<?php echo $row['banque']; ?>" onclick="goBanque()"><?php echo $row['banque']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

<?php 

require('../database.php');

if(isset($_POST['transitChoisi'])){
	$search=$_POST['transitChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from client where client like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="transitTrouve">
        <a id="<?php echo $row['id']; ?>" value="<?php echo $row['client']; ?>" onclick="goTransit()"><?php echo $row['client']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

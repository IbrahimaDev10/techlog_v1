<?php 

require('../database.php');

if(isset($_POST['clientChoisi'])){
	$search=$_POST['clientChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from client where client like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="clientTrouve">
        <a id="<?php echo $row['id']; ?>" value="<?php echo $row['client']; ?>" onclick="goClient()"><?php echo $row['client']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

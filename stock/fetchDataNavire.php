<?php 

require('../database.php');

if(isset($_POST['navireChoisi'])){
	$search=$_POST['navireChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from navire_deb where navire like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="navireTrouve">
        <a id="<?php echo $row['id']; ?>" value="<?php echo $row['navire']; ?>" onclick="goNavire()"><?php echo $row['navire']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

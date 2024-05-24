<?php 

require('../database.php');

if(isset($_POST['relacheChoisi'])){
	$search=$_POST['relacheChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from client where client like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="relacheTrouve">
        <a data-role="select_Relache" id="<?php echo $row['id']; ?>" value="<?php echo $row['client']; ?>" onclick="goRelache()"><?php echo $row['client']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

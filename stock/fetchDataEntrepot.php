<?php 

require('../database.php');

if(isset($_POST['entrepotChoisi'])){
	$search=$_POST['entrepotChoisi'];
    if($search!==""){
        $requete=$bdd->prepare('SELECT * from mangasin where mangasin like ?');
        $requete->bindValue(1,"%$search%",PDO::PARAM_STR);
        $requete->execute();
    
        while($row=$requete->fetch()){
        ?>
        <span id="entrepotTrouve">
        <a id="<?php echo $row['id']; ?>" value="<?php echo $row['mangasin']; ?>" onclick="goEntrepot()"><?php echo $row['mangasin']; ?>
        </a></span><br><br>
        <?php
        }
    }
}
?>

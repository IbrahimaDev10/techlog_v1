<?php
require('../database.php');
?>

<style type="text/css">
 #permis{
 color:white;
} 


</style>

<?php     

 echo  "<div id='info_chauffeur2' >"; 

    if(isset($_POST["idChauffeur"])){

     $b=$_POST["idChauffeur"];
     $a=explode(",", $b);
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');
$res2=$bdd->prepare("select tr.*, ch.* from chauffeur as ch 
    left join transporteur as tr on ch.id_transporteur=tr.id
    where ch.id_chauffeur=?");
    $res2->bindParam(1,$a[0]);
  $res2->execute();

?>

   <?php while($row=$res2->fetch()) {?>
   
   <label id="perm">permis</label>
    <input  id="permis" name="permis" style="width: 60%; margin-bottom: 20px; margin-right: 5px; color: white;"  disabled="true" value=<?php echo $row['id_chauffeur'] ?> > <br> 
   
 <label style="color: white;">telephone</label>
 <input id="tel" name="tel" style="width: 60%; margin-bottom: 20px; margin-right: 5px;" placeholder="tel" disabled="true" value=<?php echo $row['id_chauffeur'] ?>> <br> 
   
 <label style="color: white;">transporteur</label>
 <input id="trans" name="transport" style="width: 60%; margin-bottom: 20px; margin-right: 5px;" disabled="true" value=<?php echo $row['id'] ?>> <br>  

<?php } ?>
             


        
<?php  }  
    ?>

</div>
             





<?php 
require("../database.php");
require("controller/requete_reception.php");
?>

	<option value="">selectionner un entrepot</option>

<?php  
$a=explode('-', $_POST['client']);
$cli=$a[0];

$mang=$a[1];
 $mangasin=getmangasin($bdd,$cli,$mang);

 while($mangasins=$mangasin->fetch()){


 ?>
 <option value="<?php echo $mangasins['idmang'].'-'.$mangasins['idclient']; ?>"><?php echo $mangasins['mangasin']; ?></option>
 <?php } ?>

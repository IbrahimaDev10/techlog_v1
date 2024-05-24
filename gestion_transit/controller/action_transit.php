<?php 
if (isset($_POST['begin_transit'])) {
  if(!empty($_POST['navire'])){
    $nav=$_POST['navire'];
      header('location:../../super/ajout_declaration.php?m='.$nav);
    }
}
 ?>
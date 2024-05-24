<?php 
require("../database.php");
require("controller/afficher_les_debarquements.php");
if(isset($_POST['delete_id'])){


	 $navire=$_POST['id_navire'];
   $produit=$_POST['produit'];
   $poids_sac=$_POST['poids_sac'];
   $c=$_POST['id_dis'];

	$id=$_POST['delete_id'];
	$delete=$bdd->prepare("DELETE from  avaries  where id_avaries=?");

	$delete->bindParam(1,$id);

	$delete->execute();



	?>

<div class="container-fluid" id="avaries_debarquement"  >


  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue; ">
        <center> 
              
    
  </div>
<br>


  <div class="col-md-12 col-lg-12">      
<button style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#Les_avaries2" >Insertion </button>

</div>
<br>  

          <div class="table-responsive" border=1>
  
 <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
   <td  colspan="6" class="titreSAIN" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;"  ><i class="fas fa-bell" style="float: left;"> </i> AVARIES DE DEBARQUEMENT</td>
    
  
       
    
    <tr  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >CALE</td>
      <td class="mytd" scope="col" rowspan="2" >SAC FLASQUE</td>
      <td class="mytd" scope="col" rowspan="2" > SAC MOUILLE</td>
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody>
     <?php  
    affichage_avaries_deb($bdd,$produit,$poids_sac,$navire);
    ?>

    
    </tbody>
  </table>
</div>
</div>




<?php } ?>





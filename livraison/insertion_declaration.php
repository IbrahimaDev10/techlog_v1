<?php 	
require("../database.php");

if(isset($_POST['date'])){

	$date=$_POST['date'];
	$num=$_POST['num'];
	
	$id_dis=$_POST['id_dis'];
	$navire=$_POST['navire'];
	$poids=$_POST['poids'];
	$insert=$bdd->prepare("INSERT INTO declaration_liv(date_decliv,num_decliv,poids_decliv,id_dis_decliv,id_navire_decliv) VALUES(?,?,?,?,?)");
	$insert->bindParam(1,$date);
	$insert->bindParam(2,$num);
	$insert->bindParam(3,$poids);
	$insert->bindParam(4,$id_dis);
	$insert->bindParam(5,$navire);
	$insert->execute();


 ?>

 <div class="container-fluid" class="" id="TableDeclaration"  >
      <div class="row">

<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_relache" >AJOUTER DECLARATION  </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php   $declare=$bdd->prepare("SELECT * from declaration_liv where id_dis_decliv=?");
        $declare->bindParam(1,$id_dis);
        $declare->execute();

 
  ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="4"  >DECLARATION</td> 

       
  
    
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
          <td id="mytd" scope="col"   >DATE</td>
     
     
      <td id="mytd" scope="col" > N° DECLARATION</td>
      <td id="mytd" scope="col"  >POIDS DECLARES</td>
      
      <td id="mytd">ACTIONS</td>
  
     </tr>
     
    
     </thead>

<tbody> 
<?php   while($dec=$declare->fetch()){
        $dt=explode('-', $dec['date_decliv']);


 ?>
 <tr> 
 <td class="colaffiche"> <?php  echo $dt[2].'-'.$dt[1].'-'.$dt[0]; ?> </td>
 <td class="colaffiche"> <?php  echo $dec['num_decliv'] ?> </td>
 <td class="colaffiche"> <?php  echo number_format($dec['poids_decliv'],3,',',' ') ?> </td>
 
 <form>  
 <td  style="vertical-align: middle; text-align: center; " >

 <div style="display: flex; justify-content: center;">   <a class="fabtn"  id="<?php echo $dec['id_decliv'] ?>"    onclick="deleteRelache(<?php echo $rel['id_decliv'] ?>)" > <i class="fa fa-trash  " ></i> </a>

 <a  class="fabtn" name="modify"  data-role="update_relache"  data-id="<?php echo $dec['id_decliv']; ?>"   > <i class="fa fa-edit " ></i></a>
 <a  class="fabtn" target="blank" name="modify"  href="fichier_reception.php?id=<?php echo $dec['id_decliv']; ?>" > <i class="fa fa-folder "  ></i></a>
 </div>

  
</td>
</form>


  </tr>
   
<?php   } ?>
  




 </tbody>
</table>
</div>
</div>
</div>
</div>

<?php 	} ?>


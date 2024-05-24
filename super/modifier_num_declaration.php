<?php require('../database.php');

$num_dec=$_POST['num_dec'];

$id=$_POST['id'];
$navire=$_POST['navire'];
$update=$bdd->prepare("UPDATE declaration set num_declaration=? WHERE id_declaration=?");
$update->bindParam(1,$num_dec);

$update->bindParam(2,$id);
$update->execute(); 

$mes_declarations=$bdd->prepare("SELECT * FROM declaration where id_navire=?");
$mes_declarations->bindParam(1,$navire);
$mes_declarations->execute(); ?>

  <div  class="table-responsive" border=1 id="tableau_num_dec" >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<tr style="background: white; text-align: center; vertical-align: middle;">
				<th colspan="2">
		<h3 style="background: white;">DECLARATION </h3>
	</th>
</tr>
 	<tr style="color: white; background: green; font-size:12px; vertical-align: center; text-align: center;">
 	<th>N° de declaration</th>
 	<th>Actions</th>

 	</thead>

 <?php while($aff=$mes_declarations->fetch()){?>
 	<tr style="font-size:12px; background: white; vertical-align: center; text-align: center;">
<td style="" id="<?php echo $aff['id_declaration'].'num_dec' ?>"><?php echo $aff['num_declaration'] ?></td>
<td style="display: flex; justify-content: center;"><a data-role='modifier_dec' data-id="<?php echo $aff['id_declaration'] ?>"><i class="fa fa-edit"></i></a>
<a ><i class="fa fa-trash"></i></a></td>
<span id="<?php echo $aff['id_declaration'].'navire_dec' ?>" ><?php echo $aff['id_navire'] ?></span>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>

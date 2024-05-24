<?php require('../database.php');
$b= $_POST['navire'];
$poids= $_POST['poids'];

$voir_filtre=$bdd->prepare('SELECT dc.*,p.*,sum(dc.nombre_sac),sum(dc.poids) from declaration_chargement as dc
	 inner join produit_deb as p on p.id=dc.id_produit 
	 where dc.id_navire=? and dc.conditionnement=? GROUP BY dc.id_produit, dc.conditionnement');
$voir_filtre->bindParam(1,$b);
$voir_filtre->bindParam(2,$poids);
$voir_filtre->execute();


$somme_filtre=$bdd->prepare('SELECT sum(nombre_sac),sum(poids) from declaration_chargement 
	 where id_navire=? and conditionnement=? ');
$somme_filtre->bindParam(1,$b);
$somme_filtre->bindParam(2,$poids);
$somme_filtre->execute();

 ?>
             <div id=  "tab_par_produit" class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
            
          <thead class="entete_by_prod">   
            <tr  style="text-align: center; font-size: 18px; color: black; font-weight: bold;">   <td colspan="4" >CHARGEMENT PAR PRODUIT <br>
              NAVIRE <span style="color:blue;"> </span></td></tr>
 <tr  style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >PRODUIT</th>
                                <th scope="col" >POIDS(T)</th>
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
<?php while($aff_filtre=$voir_filtre->fetch()){ ?>
	<tr style="text-align:center; vertical-align:middle;">
		<td><?php echo $aff_filtre['produit'] ?> <?php echo $aff_filtre['produit'] ?> <?php echo $aff_filtre['conditionnement'].' KG'; ?></td>
		<td><?php echo $aff_filtre['sum(dc.poids)'] ?> </td>
	<?php } ?>
	</tr>
	<?php while($som=$somme_filtre->fetch()){ ?>
	<tr style="text-align:center; vertical-align:middle; color: red;">
		<td>TOTAL</td>
		<td><?php echo $som['sum(poids)'] ?> </td>
	<?php } ?>
	</tr>
</tbody>
</table>
</div>
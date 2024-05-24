<?php 
require("../database.php");
require("controller/afficher_les_receptions.php");
if(isset($_POST['delete_id'])){
	
	$id_dis=$_POST['id_dis'];
	$id=$_POST['delete_id'];
	try {
		$delete=$bdd->prepare("DELETE FROM avaries_de_reception WHERE id_avr=? ");
		
		$delete->bindParam(1,$id);
		$delete->execute();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

$produit=$_POST['id_produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['id_navire'];
$destination=$_POST['id_destination'];


 ?>

  <div class="container-fluid" class="" id="avaries_receptions" >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id_dis_recep_bl'] ?>" data-navire="<?php echo $afdis['id_navire_recep'] ?>" >AJOUTER AVARIES  </a>
<br><br>

<span style="" id="poids_sac_avr" ><?php echo $afdis['poids_kg'] ?></span>
<span style="display: none;" id="id_produit_avr" ><?php echo $afdis['id_produit'] ?></span>
<span style="display: none;" id="id_destination_avr" ><?php echo $afdis['id_mangasin'] ?></span>
<span style="display: none;" id="id_navire_avr" ><?php echo $afdis['id_navire'] ?></span>

</div>
<?php } ?>

<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td> 
      <?php    
$afficher_entete_sain = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $afficher_entete_sain ->bindParam(1,$id_dis);
        $afficher_entete_sain ->execute(); ?>
  <?php while($row3=$afficher_entete_sain->fetch()) {?>
  
   <br>

    <tr style="text-align: center; vertical-align: middle; " >
      <div style="display: flex; justify-content: center;"> 
       <td id="eliminer_border"  colspan="1"> 
 <span class="titre_entete" > NAVIRE:</span>        
    <span class="contenu_entete"><?php echo $row3['navire'];?></span>
    </td>
     <td id="eliminer_border" colspan="1"> 
 <span class="titre_entete" > CONNAISSEMENT:</span>        
    <span class="contenu_entete"><?php echo $row3['n_bl'];?></span>
    </td>
     <td id="eliminer_border" colspan="2"><span class="titre_entete" > PRODUIT:</span><span class="contenu_entete"> <?php echo $row3['produit'];?> <span class="contenu_entete" > <?php  echo $row3['qualite'];?></span> <?php if($row3['poids_kg']!=0){ echo $row3['poids_kg'];?>KGS <?php } ?></span> </td>
   
   
      <td id="eliminer_border" colspan="1">
      <span class="titre_entete" > POIDS:</span>        
        <span class="contenu_entete" ><?php  
        echo number_format($row3['poids_t'], 3,',',' ');
    ?></span></td>
    </tr>
  

<tr style="text-align: center; vertical-align: middle; " >
      <td id="eliminer_border" colspan="2">
  <span class="titre_entete" > DESTINATION DOUANIERE:</span>
 <span class="contenu_entete" ><?php  
        echo $row3['des_douane'];
    ?></span></td>  

 
<td id="eliminer_border" colspan="1">
    <span class="titre_entete" > RECEPTIONNAIRE:</span>        
        <span class="contenu_entete" ><?php  
        echo $row3['client'];
    ?></span></td> 
    
   <td id="eliminer_border" colspan="2">
   <span class="titre_entete" > DESTINATION:</span>        
        <span class="contenu_entete" ><?php  
        echo $row3['mangasin'];
    ?></span> </td> 
  </div>
  </tr>
<?php   } ?> 
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"  >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
       <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
         


      
    
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     </tr>
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>
 </tbody>
</table>
</div>
</div>
</div>
</div>
<?php } ?>
 
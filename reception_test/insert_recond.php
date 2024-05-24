<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
require('controller/mes_reconditionnement.php');

if(isset($_POST['navire'])){

 $navire=$_POST['navire'];
 $id_produit=$_POST['id_produit'];
 $poids_sac=$_POST['poids_sac'];
 $id_destination=$_POST['id_destination'];
 $c=$_POST['id_dis'];
 $date=$_POST['date'];
 $navire=$_POST['navire'];
 $sacf=$_POST['sacf'];
 $sac_eventres=$_POST['sac_eventres'];
 $poids_eventres=$sac_eventres*$poids_sac/1000;
 $sac_bal=$_POST['sac_bal'];
 $poids_bal=$_POST['poids_bal'];
 $id_declaration=$_POST['id_declaration'];
 $poidsf=$sacf*$poids_sac/1000;

/* $naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $naviress->bindParam(1,$_SESSION['id']);
      $naviress->execute(); */





 try{
	$insert=$bdd->prepare("INSERT INTO reconditionnement_reception(dates,sac_eventres,poids_eventres,sac_recond,poids_recond,sac_balayure,poids_balayure,poids_sac,id_produit,id_destination,id_navire,declaration_id) values(?,?,?,?,?,?,?,?,?,?,?,?)");

$insert->bindParam(1,$date);
$insert->bindParam(2,$sac_eventres);
$insert->bindParam(3,$poids_eventres);
$insert->bindParam(4,$sacf);
$insert->bindParam(5,$poidsf);
$insert->bindParam(6,$sac_bal);
$insert->bindParam(7,$poids_bal);
$insert->bindParam(8,$poids_sac);
$insert->bindParam(9,$id_produit);
$insert->bindParam(10,$id_destination);
$insert->bindParam(11,$navire);
$insert->bindParam(12,$id_declaration);
$insert->execute();
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}


 ?>

<div class="container-fluid" id="tableSain" >  
  <br>

  <?php 
  $produit=$id_produit;
  $destination=$id_destination;
  $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">  
     
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="insert_reconditionnement" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER RECONDITIONNEMENT  </a>
<br><br>
</div>
<?php } ?>
 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
      <td  rowspan="2"   >N°</td>
       <td   rowspan="2"   >DATE</td>
        <td   colspan="2"   >FLASQUES RECEPTIONNES</td>
        <td  rowspan="2"  >SACS EVENTRES</td>
     
      <td   colspan="2" > RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
       <td   rowspan="2"  >FLASQUES RESTANTS</td>
  </tr>
      
 <tr id="th_table_rec" >
      <td   >SACS</td>
    
      <td    >POIDS</td>

   

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>

     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


    <?php afficher_reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>         

            

</table>
</div>
</div>
</div>
<br><br>
  


   
<?php } ?>
 
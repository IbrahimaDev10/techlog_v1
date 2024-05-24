<?php require('../database.php');
 require('controller/afficher_avaries_debarquement.php');
 $produits=explode('-', $_POST['produit']);
 $produit=$produits[0];
 $poids_sac=$produits[1];
$navire=$produits[2];



function type_navire($bdd,$navire){
	$type=$bdd->prepare('SELECT type from navire_deb where id=?');
	$type->bindParam(1,$navire);
	$type->execute();
	return $type;
}

function choix_produit($bdd,$produit,$poids_sac,$navire){
	$choix_prod=$bdd->prepare('SELECT dc.*,p.* from declaration_chargement as dc
		inner join produit_deb as p on p.id=dc.id_produit where dc.id_produit=? and dc.conditionnement=? and  dc.id_navire=? GROUP by dc.id_produit, dc.conditionnement');
	$choix_prod->bindParam(1,$produit);
    $choix_prod->bindParam(2,$poids_sac);
    $choix_prod->bindParam(3,$navire);
	$choix_prod->execute();
	return $choix_prod;
} 
 ?>

<input type="" name="" id='produit_avaries_insert' value="<?php echo $produit; ?>" style='display: none;' >
<input type="" name="" id='poids_sac_avaries_insert' value="<?php echo $poids_sac; ?>" style='display: none;'>
<input type="" name="" id='navire_avaries_insert' value="<?php echo $navire; ?>" style='display: none;'>

<div class="container-fluid" id="avaries_debarquement"  >



   <div class="entete_image" >
        
              
    
  
  </div>



  <div class="col-md-12 col-lg-12">      
<button id="insertion_avaries" style="background: orange;" type="submit" class="btn1"  data-role='afficher_formulaire_avaries' >Insertion </button>

</div>
 

          <div id="tableau_avaries" class="table-responsive" border=1>
  
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
    <tbody id='tbody_avaries_debarquement'>

    <?php affichage_avaries($bdd,$produit,$poids_sac,$navire);    ?>
  
    </tbody>

  </table>
</div>
<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
    #btnSain, #btnAvariesRep, #btnAvariesDeb, #tabledec1, #tabledec2, .menu, #sidebar, .operation, .container-fluid1, .sidebar, .topbar, .entete_image, #insertion_avaries, .bars   {
    display: none !important;

  }


   .footer{
    display: none;
   }
  }
</style>
<a  style="margin:auto-right; width: 10% !important; " class="btn btn-primary hide-on-print" data-role="imprimer_tableau_avaries">imprimer</a>


</div>



<div class="modal fade" id="formulaire_avaries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
          <?php //if($rown['type']=='SACHERIE'){ ?>


   <div class="mb-3">
     <?php $choix_prod=choix_produit($bdd,$produit,$poids_sac,$navire); ?>
     <?php while($prod=$choix_prod->fetch()){ ?>
  <h3><?php echo $prod['produit']; ?>  <?php echo $prod['conditionnement'].' KG'; ?></h3>
<?php } ?> <br>
       <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control"   name="dateavdeb" id="dateavdeb">
  <br>  

     
    
    <!-- <select id='produit_cale' name="produit"  data-role='choix_produit_pour_cale' style="width: 50%;"> 
<option > CHOISIR PRODUIT</option> 
<?php //while($prod=$choix_prod->fetch()){ ?>
	<option  value="<?php //echo $prod['id_produit'].'-'.$prod['conditionnement'].'-'.$navire; ?>"> <?php //echo $prod['produit'] ?> <?php //echo $prod['qualite'] ?> <?php //Secho $prod['conditionnement'].' KG'; ?></option>
	<?php //} ?> 
</select> !-->
    
<?php  
$choix_cale=$bdd->prepare('select id_dec,cales from declaration_chargement where id_produit=? and conditionnement=? and id_navire=? group by cales');
$choix_cale->bindParam(1,$produit);
$choix_cale->bindParam(2,$poids_sac);
$choix_cale->bindParam(3,$navire);
$choix_cale->execute();

?>
<select id='cale_pour_avaries' > 
<option > CHOISIR CALES</option> 
<?php while($choix=$choix_cale->fetch()){ ?>
    <option  value="<?php echo $choix['id_dec']; ?>"><?php echo $choix['cales']; ?> </option>
    <?php } ?> 
</select> <br>

    <label>SAC FLASQUE</label>
    <input type="number" class="form-control"   name="sacf"  id="sacfavdeb"  value="0"
     >
     <br>

 <label>SAC MOUILLE</label>
    <input type="number" class="form-control"    name="sacm"  id="sacmavdeb"  value="0"
     >
     <br>

      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="navireavdeb" hidden="true" value=<?php  
        echo $navire;
    ?> > 
    <input type="text" class="form-control"  placeholder="navire"  id="id_disavdeb" hidden="true" value=<?php  
        //echo $rown['id_dis'];
    ?> > 
     <input type="text" class="form-control"  placeholder="navire"  name="poids_sac"  id="poids_sacavdeb" hidden="true" value=<?php  
        //echo $rown['poids_kg'];
    ?> >
     <input type="text" class="form-control"  placeholder="navire"  name="id_produit"  id="produitavdeb" hidden="true" value=<?php  
        //echo $rown['id_produit'];
    ?> >

     <input type="number" class="form-control"  placeholder="navire"  name="id_avdeb"   id="idavdeb"  >
   
</div>
  
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " id='save_av' style="text-align: center; display:none;" name="valider_Avaries3" data-role="btn_avaries_debarquement" >enregistrer</a></center>

        <a class="btn btn-primary" style="text-align: center; display:none;" name="valider_Avaries3" data-role="update_les_avdeb" id="update_av2" >enregistrer</a></center>
        </div>
      <?php //}  ?>

    
</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>

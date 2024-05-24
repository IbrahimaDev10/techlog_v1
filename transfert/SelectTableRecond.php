<?php require('../database.php');
 require('controller/afficher_recond_debarquement.php');
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

<input type="" name="" id='produit_avaries_insert_rec' value="<?php echo $produit; ?>" style='display: none;' >
<input type="" name="" id='poids_sac_avaries_insert_rec' value="<?php echo $poids_sac; ?>" style='display: none;'>
<input type="" name="" id='navire_avaries_insert_rec' value="<?php echo $navire; ?>" style='display: none;'>

<div class="container-fluid" id="recond_debarquement"  >
<br>
<div class="table-responsive">
  <center>
  <table class="table table-hover table-bordered table-striped table-responsive" style="width:60%;">
    <thead>
      <tr>
        <td colspan="5" style="background: black; color:white; text-align:center; vertical-align:middle;">ETAT DES FLASQUES</td>
      </tr>
            <tr style="background: black; color:white; text-align:center; vertical-align:middle; font-size: 14px;">
        <td >PRODUIT</td>
         <td >SACS FLASQUES DEB</td>
          <td > SACS FLASQUES RECONDITIONNES</td>
           <td >SACS OBTENUS</td>
           <td >SACS FLASQUES RESTANTS</td>
      </tr>
    </thead>
    <tbody>
     <?php $restant_flasque=restant_flasque($bdd,$produit,$poids_sac,$navire);
           $total_recond=total_recond($bdd,$produit,$poids_sac,$navire);
     while($res=$restant_flasque->fetch()){
         $tot=$total_recond->fetch(); 
        $rest_flasque_deb=$res['sum(av.sac_flasque)']-$tot['sum(sac_dechires)']; ?> 
        <tr style=" text-align:center; vertical-align:middle;">
      <td><?php echo $res['produit'] ?> <?php echo $res['qualite'] ?> <?php echo $res['poids_sac_avaries'].' KG' ?></td>
      <td> <?php echo $res['sum(av.sac_flasque)']; ?></td>
      <td> <?php echo $tot['sum(sac_dechires)']; ?></td>
      <td> <?php echo $tot['sum(sac_obtenus)']; ?></td>
      <td> <?php echo $rest_flasque_deb; ?></td>
      </tr>
    <?php } ?>

    </tbody>
    
  </table>
  </center>
</div>

   <div class="entete_image" >
        
              
    
  
  </div>



  <div class="col-md-12 col-lg-12">      
<button id="insertion_avaries" style="background: orange;" type="submit" class="btn1"  data-role='afficher_formulaire_recond' >Insertion </button>

</div>
 

          <div id="tableau_recond" class="table-responsive" border=1>
  
 <table class='table table-hover table-bordered table-striped table-responsive' id='table_recond' border='2' >

 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
   <td  colspan="6" class="titreSAIN" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;"  ><i class="fas fa-bell" style="float: left;"> </i> RECONDITIONNEMENT</td>

  
  
       
    
    <tr  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >SACS DECHIRES</td>
      <td class="mytd" scope="col" rowspan="2" >SAC OBTENUS</td>
      
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody id='tbody_RECOND_debarquement'>

    <?php affichage_recond($bdd,$produit,$poids_sac,$navire);    ?>
  
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



<div class="modal fade" id="Les_recond2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Reconditionnement</h2></center>
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
  <input type="date" class="form-control"   name="dateavdeb" id="date_recond">
  <br>  

     
    
    <!-- <select id='produit_cale' name="produit"  data-role='choix_produit_pour_cale' style="width: 50%;"> 
<option > CHOISIR PRODUIT</option> 
<?php //while($prod=$choix_prod->fetch()){ ?>
	<option  value="<?php //echo $prod['id_produit'].'-'.$prod['conditionnement'].'-'.$navire; ?>"> <?php //echo $prod['produit'] ?> <?php //echo $prod['qualite'] ?> <?php //Secho $prod['conditionnement'].' KG'; ?></option>
	<?php //} ?> 
</select> !-->
    

    <label>SACS DECHIRES</label>
    <input type="number" class="form-control"  name="sacf"  id="sac_dechires"  value="0"
     >
     <br>

 <label>SACS OBTENUS</label>
    <input type="number" class="form-control"  name="sacm"  id="sac_obtenus"  value="0"
     >
     <br>

      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="navire_recond" hidden="true" value=<?php  
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

     <input type="text" class="form-control"  placeholder="navire"  name="id_avdeb"hidden='true'  id="idavdeb"  >
   
</div>
  
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " id='save_recs' style="text-align: center; display: none; " name="valider" data-role="btn_recond_debarquement" >enregistrer</a></center>

        <a class="btn btn-primary " style="text-align: center; display:none;" name="valider_Avaries3" data-role="update_les_recond" id="update_rec2" >enregistrer</a></center>
        </div>
      <?php //}  ?>

    
</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>

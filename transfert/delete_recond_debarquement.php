<?php 	
require("../database.php");

require('controller/afficher_recond_debarquement.php');

if(isset($_POST['navire']) ){


       
      $produit=$_POST['id_produit'];
      $poids_sac=$_POST['poids_sac'];
       $navire=$_POST['navire'];
       $id=$_POST['delete_id'];


      
           
   

   
          $delete= $bdd->prepare("DELETE from recond_debarquement where id_recond_tr=?");
          $delete->bindParam(1,$id);      

          $delete->execute();
    
 
    }
    



    



?>

<div class="container-fluid" id="recond_debarquement"  >
<br>
<div class="table-responsive">
  <center>
  <table class="table table-hover table-bordered table-striped table-responsive" style="width:60%;">
    <thead>
      <tr>
        <th colspan="5" style="background: black; color:white; text-align:center; vertical-align:middle;">ETAT DES FLASQUES</th>
      </tr>
            <tr style="background: black; color:white; text-align:center; vertical-align:middle; font-size: 14px;">
        <th >PRODUIT</th>
         <th >SACS FLASQUES DEB</th>
          <th >SACS FLASQUES RECONDITIONNES</th>
           <th >SACS OBTENUS</th>
           <th >SACS FLASQUES RESTANTS</th>
      </tr>
    </thead>
    <tbody>
     <?php $restant_flasque=restant_flasque($bdd,$produit,$poids_sac,$navire);
           $total_recond=total_recond($bdd,$produit,$poids_sac,$navire);
     while($res=$restant_flasque->fetch()){
         $tot=$total_recond->fetch(); 
        $rest_flasque_deb=$res['sum(av.sac_flasque)']-$tot['sum(sac_dechires)']; ?> 
        <tr style=" text-align:center; vertical-align:middle;">
      <td><?php echo $res['produit'] ?> <?php echo $res['qualite'] ?></td>
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
 

          <div id="tableau_avaries" class="table-responsive" border=1>
  
 <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
   <td  colspan="6" class="titreSAIN" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;"  ><i class="fas fa-bell" style="float: left;"> </i>RECONDITIONNEMENT</td>

  
  
       
    
    <tr  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >SACS DECHIRES</td>
      <td class="mytd" scope="col" rowspan="2" >SAC OBTENUS</td>
      
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody id='tbody_recond_debarquement'>

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




    
  
   





<?php 	
require("../database.php");

require('controller/afficher_avaries_debarquement.php');

if(isset($_POST['navire']) ){
  echo $_POST['dates'];
echo $_POST['id_produit'];
echo $_POST['cale'];
       
      $produit=$_POST['id_produit'];;
      $poids_sac=$_POST['poids_sac'];;
       $navire=$_POST['navire'];
        $cale=$_POST['cale'];

    if(!empty($_POST['dates'])   and !empty($_POST['cale']) ){
        //$nav=$_POST['navire'];
       
       
        //$nombre_sac=$_POST['nombre_sac'];



        
       
        $sacf=$_POST['sacf'];
        $sacm=$_POST['sacm'];
       
        $date=$_POST['dates'];
        
        $poidsf=$sacf*$poids_sac/1000;
        $poidsm=$sacm*$poids_sac/1000;
        $ref=1;

        
 try{       
          $insertRecep1= $bdd->prepare("INSERT INTO avaries(date_avaries,cale_avaries,sac_flasque,poids_flasque,sac_mouille,poids_mouille,id_navire,id_produit,poids_sac_avaries) VALUES(?,?,?,?,?,?,?,?,?)");      



      
          $insertRecep1->bindParam(1,$date); 
          $insertRecep1->bindParam(2,$cale);
$insertRecep1->bindParam(3,$sacf);
$insertRecep1->bindParam(4,$poidsf);
$insertRecep1->bindParam(5,$sacm);
$insertRecep1->bindParam(6,$poidsm);

$insertRecep1->bindParam(7,$navire);
$insertRecep1->bindParam(8,$produit);
$insertRecep1->bindParam(9,$poids_sac);


$insertRecep1->execute();
    
 
    }
    



    catch(Exception $e){

    }
 

      $message2="reussie";
   
    }

    else{
         $message2="ERREUR";
    }
  

} 

?>

<div class="container-fluid" id="avaries_debarquement"  >

   <div class="entete_image" >
        
              
    
  
  </div>



  <div class="col-md-12 col-lg-12">      
<button id="insertion_avaries" style="background: orange;" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#Les_avaries2" >Insertion </button>

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




    
  
   





<?php
require('../database.php');
?>

<style type="text/css">
  body{
    font-family:Times New Roman;
    font-weight: bold;
    background: white;
    
  }

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
    }
    #mybutton{
      background: blue;
       color:white;
       font-size: 18px;
    }
     #global{
      background: black;
       color:white;
       font-size: 14px;
       border-radius: 50px;
    }
    td{
      height: 10px;
    border: 1px solid black;
    padding: 5px;
    }
    table td {
      height: 1px !important;
    }
    #colcol{
     height: 10px !important;
    }
  
</style>
 
          <?php if (isset($_POST['idDate'])) {

             $b=$_POST["idDate"];
             $c=explode('-', $b);

             $date1=$bdd->prepare("select dates_recep from reception where id_dis_recep_bl=?");
             $date1->bindParam(1,$b);
             $date1->execute();


              $date2=$bdd->prepare("select dates_recep from reception where id_dis_recep_bl=? order by id_recep desc");
             $date2->bindParam(1,$b);
             $date2->execute();

             $intervenant=$bdd->prepare("SELECT inter.*,intprod.* from intervenant_deb as inter inner join intervenant_produit_deb as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_client_inter_prod=? and intprod.id_navire_inter_prod=?  ");
             $intervenant->bindParam(1,$c[4]);
             $intervenant->bindParam(2,$c[3]);
             $intervenant->execute();

             $intervenant_compte=$bdd->prepare("SELECT  inter.*,intprod.*, count(inter.nom_intervenant) from intervenant_deb as inter inner join intervenant_produit_deb as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_client_inter_prod=? and intprod.id_navire_inter_prod=?  ");
             $intervenant_compte->bindParam(1,$c[4]);
            $intervenant_compte->bindParam(2,$c[3]);
             $intervenant_compte->execute();
               


$final=$bdd->prepare("SELECT dis.*,rm.*,av.*, p.*, nav.*,ex.id_trans_extends,nc.num_connaissement,nc.id_navire, sum(rm.sac),sum(rm.poids) from register_manifeste as rm
  inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration 
  inner join dispat as dis on dis.id_dis=ex.id_bl_extends 
inner join produit_deb as p on p.id=dis.id_produit
inner join client as cli on cli.id=dis.id_client
inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
inner join navire_deb as nav on nav.id=nc.id_navire


left join avaries as av on  av.poids_sac_avaries= rm.poids_sac and av.id_produit=rm.id_produit
where dis.id_produit=? AND dis.poids_kg=? and nc.id_navire=? and dis.id_client=?
 GROUP BY dis.id_client");

$final->bindParam(1,$c[1]);
$final->bindParam(2,$c[2]);
$final->bindParam(3,$c[3]);
$final->bindParam(4,$c[4]);
$final->execute();

$bl=$bdd->prepare("SELECT dis.*,nc.num_connaissement from dispat as dis
  inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
where dis.id_produit=? AND dis.poids_kg=? and nc.id_navire=? AND dis.id_client=? group by nc.id_connaissement
 ");
$bl->bindParam(1,$c[1]);
$bl->bindParam(2,$c[2]);
$bl->bindParam(3,$c[3]);
$bl->bindParam(4,$c[4]);
$bl->execute();


/*$sain=$bdd->prepare("SELECT sum(rm.sac),sum(rm.poids),dis.*,nc.* from register_manifeste as rm
  inner join dispat as dis on dis.id_dis=rm.id_dis_bl
  inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
where dis.id_produit=? AND dis.poids_kg=? and nc.id_navire=? and dis.id_client=?
 ");
$sain->bindParam(1,$c[1]);
$sain->bindParam(2,$c[2]);
$sain->bindParam(3,$c[3]);
$sain->bindParam(4,$c[4]);
$sain->execute(); */

$sain=$bdd->prepare("SELECT sum(rm.sac),sum(rm.poids),dis.*,nc.*,ex.id_trans_extends from register_manifeste as rm
  inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration
  inner join dispat as dis on dis.id_dis=ex.id_bl_extends
  inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
where dis.id_produit=? AND dis.poids_kg=? and nc.id_navire=? and dis.id_client=?
 ");
$sain->bindParam(1,$c[1]);
$sain->bindParam(2,$c[2]);
$sain->bindParam(3,$c[3]);
$sain->bindParam(4,$c[4]);
$sain->execute();

$avaries=$bdd->prepare("SELECT sum(sac_flasque),sum(sac_mouille) from avaries
where id_produit=? AND poids_sac_avaries=? and id_navire=?
 ");
$avaries->bindParam(1,$c[1]);
$avaries->bindParam(2,$c[2]);
$avaries->bindParam(3,$c[3]);
$avaries->execute();

$type_navire=$bdd->prepare("SELECT type, navire from navire_deb where id=?");
$type_navire->bindParam(1,$c[3]);
$type_navire->execute();

$navire=$bdd->prepare("SELECT  navire from navire_deb where id=?");
$navire->bindParam(1,$c[3]);
$navire->execute();

$receptionnaire=$bdd->prepare("SELECT dis.id_client,cli.client,nc.num_connaissement,nc.id_navire from dispat as dis
  inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 inner join client as cli on cli.id=dis.id_client where nc.id_navire=? and dis.id_client=? group by dis.id_client");
$receptionnaire->bindParam(1,$c[3]);
$receptionnaire->bindParam(2,$c[4]);
$receptionnaire->execute();


// ------ICI ON STOCK LES VALEURS DE L'input POUR INSERER INTERVENANT
/*
$valeurbtn=$bdd->prepare("SELECT * from dispat where id_navire=? and id_client=? group by id_client");
$valeurbtn->bindParam(1,$c[3]);
$valeurbtn->bindParam(2,$c[4]);
$valeurbtn->execute(); */



 ?>
 <div id="pdf">
<div style="background: white;">
 <div class="container-fluid">
  <div class="row">
   <div class=" col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 40px; width: 200px;">
  </div>

  </div>
</div>
 <div class="container-fluid">
  <div class="row">
  <div class=" col-md-12 col-lg-12" > <h6 style="font-weight: bolder; color: rgb(50, 159, 170); margin-bottom: 2px;">Societé des Industries Maritimes</h6>
  <h6 style=" color: rgba(50, 159, 218, 0.9); margin-bottom: 2px;">Shipping - Manutention - Transit</h6>
  <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Logistique - Transport -Entreposage</h6>
</div>
 <div class=" col-md-3 col-lg-3">
    </div>
    <div class="col-md-9 col-lg-9" >
   
  <h6 style="float: right;">Dakar le ................................</h6>  
  </div>


 </div>
  </div>

<center>
  <?php //if($val=$valeurbtn->fetch()){ ?>
  <button style="float: left;" id="mybutton" class="hide-on-print" data-role="ajout_intervenant" data-id_navire="<?php //echo $val['id_navire'] ?>" data-id_client="<?php echo $val['id_client'] ?>" >ajouter un intervenant</button>

 <?php //} ?>
  </center>
 
  <br>
  <div id="entete">
  <center>
 
  </center>
</div>
<br><br>


  

  <div class="table-responsive" id="final_report"  > 
    
<center> 
  <table class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="2"> FINAL REPORT</th> 
      
      
      
      
      
  </tr>
   
        <tbody>
          <?php while($fin=$final->fetch()){  
            $nav=$navire->fetch();
            
             ?>

          <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: white;"  > NAVIRE </td>
            <td id="colcol"  > <?php  echo $nav['navire']; ?> </td>
            
           </tr>
           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
             <td > DATE AND TIME ARRIVAL </td>

             <td><?php echo $fin['eta'] ?> </td>
             
           </tr>
           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
             <td > DESCRIPTION OF GOODS </td>

             <td><?php echo $fin['produit'] ?> <?php echo $fin['poids_kg'].' KG' ?> </td>
             
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > BILL OF LOADING N° </td>
            <td > <?php while ($bls=$bl->fetch()) {
              # code...
             echo $bls['num_connaissement'].'  '; } ?> </td>
           
             
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > QUALITY OF RICE/ QUALITE DU RIZ</td>
            <td > <?php echo $fin['qualite'] ?> </td>
             
           </tr>
          
           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > RECEIVER / RECEPTIONNAIRE</td>
            <td > <?php while ($recep=$receptionnaire->fetch()) {
              # code...
            echo $recep['client'];  } ?> </td>
             
           </tr>

           <?php while($sains=$sain->fetch()){ ?>
           <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td >SOUND BAGS / SAINS </td>
            <td ><?php echo $sains['sum(rm.sac)'];  ?>  </td>
             
           </tr>
           <?php $type=$type_navire->fetch();
          if($type['type']=="SACHERIE"){ ?>

           <?php while($av=$avaries->fetch()){ ?>
            <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > TORN BAGS / FLASQUES </td>
            <td > <?php echo $av['sum(sac_flasque)'] ?> </td>
             
           </tr>

            
            <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > WET BAGS / MOUILLES  </td>
            <td > <?php echo $av['sum(sac_mouille)'];
             $total_sac=$av['sum(sac_flasque)']+$av['sum(sac_mouille)'] + $sains['sum(rm.sac)']  ?> </td>
            </tr>

            <tr style="text-align: center; vertical-align: middle; font-size: 12px;" > 
            <td > EMPTY BAGS / VIDES </td>
            <td >  </td>
             
           </tr>
            
            <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > FALLEN OF THE SEA / TOMBES EN MER</td>
            <td > </td>
             
           </tr>

             <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > TOTAL DISCHARGED / TOTAL DECHARGE </td>
            <td > <?php echo $total_sac;
              ?> </td>
            </tr>
             <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > MANIFEST IN BAGS / MANIFEST EN SACS </td>
            <td > <?php echo $total_sac;
              ?> </td>
            </tr>
             <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > MANIFEST IN METRIC TONS </td>
            <td > <?php echo $sains['sum(rm.poids)']; ?> </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > SHORTAGE / MANQUANT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > EXCESS / EXCEDENT </td>
            <td >  </td>
            </tr>


          <?php } 
          if($type['type']=="VRAQUIER") {  ?>
            <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td >  TOTAL DISCHARGED / TOTAL DECHARGE </td>
            <td > <?php echo $sains['sum(sac)'] ?>
               </td>
             </tr>  

             <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > MANIFEST IN BAGS / MANIFEST EN SACS </td>
            <td > <?php echo $sains['sum(sac)'] ?> </td>
            </tr>
                  <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > MANIFEST IN METRIC TONS </td>
            <td > <?php echo $sains['sum(poids)']; ?> </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > SHORTAGE / MANQUANT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle; font-size: 12px;"> 
            <td > EXCESS / EXCEDENT </td>
            <td >  </td>
            </tr>
           

           
             
         <?php } } } } ?>

         
         
         
         </tbody>
       </table>
     </center>
       </div>

       <div class="container-fluid">  
       <div class="row">
        <div class=" col-md-12 col-lg-12"> 
       <center> 
<h6 style="float: left;">REMARKS:</h6><br>
  <p style="font-weight: bold;" > We hereby confirm the discharging of all the. ............. MTS FROM ............ to ............ </p><br>
  <p style="font-weight: bold;" > We cannot accept to be held responsible of damage cargo shortage of any costs and expenses which may arised there from</p><br>

     <p colspan="2" style="border: none;"> Nous ne pouvons pas accepter d'être tenus pour responsables des dommages causé à la cargaison, du manque des frais et des depenses qui pourraient en découler. </p>  
       </center> 
     </div> 
   </div>
   </div>

     <br><br>  
     
       
 
     <div class="container" id="afficher_intervenant" style="width: 100%;">
      <div class="row">
        <div style="display: flex; justify-content: center;">  
        <div class="col-md-2 col-lg-2">
            <span style="color: black !important; float: left;">STEVEDORE</span>
            </div>
           <?php while ($inter=$intervenant->fetch()) { ?>
            <div class="col col-md-2 col-lg-2">
            <span style="color:blue !important; margin-left: 20px;"  ><?php echo $inter['nom_intervenant']; ?></span>
            </div>
          <?php } $compter_intervenant=$intervenant_compte->fetch(); 
           ?>
           <div
           <?php if($compter_intervenant['count(inter.nom_intervenant)']==0){  ?>   class="col col-md-10 col-lg-10" <?php } ?> <?php if($compter_intervenant['count(inter.nom_intervenant)']==1){  ?>   class="col col-md-8 col-lg-8" <?php } ?> <?php if($compter_intervenant['count(inter.nom_intervenant)']==2){ ?>   class="col col-md-6 col-lg-6" <?php } ?>  <?php if($compter_intervenant['count(inter.nom_intervenant)']==3){ ?>   class="col col-md-4 col-lg-4" <?php } ?> 
            <?php if($compter_intervenant['count(inter.nom_intervenant)']==4){ ?>   class="col col col-md-2 col-lg-2" <?php } ?>  >
            <span style="color: black !important; float: right;  margin-left: 20px;">CHEF OFFICIER OF MASTER</span>

            </div>
            <br><br><br><br><br><br><br>
          </div>
         </div>
       </div>
         


<a  style="margin:auto-right; width: 20%;" class="btn btn-primary hide-on-print" data-role="imprimer_final_report">imprimer</a>


<div class="container-fluid reg">
  <div class="row">
   <div class=" col-md-12 col-lg-12" style="border: solid; border-top:2px; border-color:rgba(50, 159, 218, 0.9);">  
</div>
 <div class=" col-md-12 col-lg-12" > 
  <center>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important;">
    RC 2000 B 69 -NINEA 0394586 2G3 -NITI 202204477/B
  </h6>
  </center>
  </div>
  <div class=" col-md-12 col-lg-12" > 
    <center>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important;">
    Adresse: 2, Place de l'independance - BP 27190 Dakar - Tel: 33 823 69 96- Fax: 33 823 69 95 - www.simarsn.com

  </h6>
  </center>
  </div>
  <div class=" col-md-12 col-lg-12" > 
    <center>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important;">
   E-mail: www.simarsn.com
     
  </h6>
  </center>
  
  </div>



  <style type="text/css">
  @media print {
  .hide-on-print {
    display: none !important;
  }
  
   #boutonmenu {
    display: none !important;
  }
   #situationss {
    display: none !important;
  }
    #foot {
    display: none !important;
  }
     .footer {
    display: none !important;
  }
  .reg{
    
    bottom: 0;

  }

}
 
     }
</style>


   


    </div>
</div>


     </div>
</div> 

<?php     
 } ?>







  


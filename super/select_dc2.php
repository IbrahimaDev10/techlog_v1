<?php
require('../database.php');
require('controller/requete_predebarquement.php');

$navires=$bdd->query("select * from navire_deb order by id desc");




   if(isset($_POST["idNavire"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idNavire"];

$navirefichier=$bdd->prepare("select id from navire_deb where id=?");
       $navirefichier->bindParam(1,$b);
       $navirefichier->execute();

$navire=$bdd->prepare("select * from navire_deb where id=?");
        $navire->bindParam(1,$b);
        $navire->execute();

        $navs=$bdd->prepare("select * from navire_deb where id=?");
$navs->bindParam(1,$b);
$navs->execute();

 if($ro=$navs->fetch()){ 
 // if($ro['type']=='SACHERIE'){




?>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'> 

<style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle !important; 
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }

  @media print{ 
   .soustotal2{
    background:red;
  } 
  }
</style>


<div  id="fetch_cargo_plan" class="col-md-12">
  <div id="card1" class="card">
    <div class="card-header">
      <center>
        <h1 class="hdeclaration text-white" style="font-size: 22px !important;" >DECLARATION DE CHARGEMENT</h1>
          </center>
           </div>

          <div class="card-body"> 
    <?php  while($rownav = $navire->fetch()){ ?>
              <div class="row">
               
                <div class="col-md-4 col-lg-4">
                    <h6>NAVIRE: <span style="color:red;"><?php echo $rownav['navire'];?>     </span></h6></div>
                     <div class="col-md-4 col-lg-4">
                                  <h6>ETA: <span style="color:red;"><?php echo $rownav['eta'];?></span></h6></div>
                                   <div class="col-md-4 col-lg-4">
                                     <h6>CLIENT: <span style="color:red;"><?php echo $rownav['client_navire'];?></span></h6>
                                         </div>
                            <div class="col-md-4 col-lg-4">  
                              <h6>TYPE DE CHARGEMENT: <span style="color:red;"><?php echo $rownav['type'];?>   </span></h6></div>
                                   <div class="col-md-4 col-lg-4">
                                     <h6>ETB: <span style="color:red;"><?php echo $rownav['etb'];?></span></h6>
                                         </div>
                                          <div class="col-md-4 col-lg-4">
                                          <h6> </h6></div>
                                           <div class="col-md-4 col-lg-4">
                                             <h6>DESTINATION: <span style="color:red;"><?php echo $rownav['destination'];?></span></h6></div>
                                          
                                        <div class="col-md-4 col-lg-4">
                                       <h6>ETD <span style="color:red;"><?php echo $rownav['etd'];?></span></h6></h6></div>
                                       <div class="col-md-4 col-lg-4">
                                          <h6> </h6></div>
                                      
                                                  
                                </div>                
                              <?php } ?>
                            <select id="navire" name="navire" class="form-control form-control-mb-4 " onchange='go()'>
                          <option value="">choix du navire</option>
                                      <?php 
                                  while ($chNav=$navires->fetch()) {
                                  ?>
                        <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option> 
                               <?php } ?> 
                       </select>
                      </div>



<div class="container-fluid LesOperations" style="background: white; margin-top: 5px;">
  <div class="row">
   
      <center>
      <div class="col col-sm-12 col-md-12 col-lg-12"  >
         <span class="lien_debut" style="display:flex; justify-content: center;"> 
        <button class="dropdown-toggle" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; width: 20%; font-size:16px;  background: white; align-items: center;  "  class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >PLAN DE CHARGEMENT </button>
         <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
          <center>
          <li>
          <button  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn "id="btncale" data-role='voir_cale'>PAR CALE</button>
        </li>
               
          <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  class="btn "  onclick="visibleProduit();"   >PAR PRODUIT</button></li>
         
         
            </center>
          </ul>
               <button class="dropdown-toggle" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; width: 20%; font-size:16px;  background: white; align-items: center;  "  class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >DISPATCHING</button>
         <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
          <center>
            <li>
          <button  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " data-role='voir_connaissement' >PAR CONNAISSEMENTs</button>
        </li>
          <li>
          <button  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " data-role='voir_receptionnaire'>PAR RECEPTIONNAIRE</button>
        </li>
               
          <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  class="btn" data-role='voir_destination' >PAR DESTINATION</button></li>


           
         
            </center>
          </ul>

           <button style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " id="btnAvariesRep" onclick="visibleBl_unique();">CONNAISSEMENT</button>
             <button style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white; "  class="btn " data-role='voir_declaration' >TRANSIT</button>
      
          


       
    
      </span>
      </div>
        </center>
    <?php //} ?>

   
    

    <?php //} ?>
  </div>
</div>
<input id='valeur_navire' type="text" name="" value="<?php echo $b; ?>" hidden='true'>
<!--

    <div style="background: linear-gradient(-45deg, #004362, #0183d0); !important  position: fixed;">                   
                      <div class="row">
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" > CALE</button>
                      </div>
                                              <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;"> PRODUIT</button>
                       </div>
                         <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" >CONNAISSEMENT</button>
                       </div>

                      
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;" >
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" > RECEPTIONNAIRE</button>
                       </div>
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" > DESTINATION</button>
                       </div>
                       <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" onclick="visibleBanque();"> BANQUE</button>
                       </div>

                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" onclick="visibleTransit();"> TRANSIT</button>
                      </div>
                   </div>

                    
                       </div>
        </div> !-->

<br>  


<div class="container-fluid" id='content'>
  <div class="row">
    
  </div>
</div>
  <div class="container-fluid" id="parcale" style="display: none;" >
                      <center>
                     
                      

<div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_cale'><i class="fa fa-print text-white"></i></a>

  <?php while($fichier=$navirefichier->fetch()){ ?>

  <span id="joindre_fichier">
   <a  style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; margin-left: 30px;" href="insertion_fichier_declaration_chargement.php?id=<?php echo $fichier['id'] ?>" target="blank"  name="modify"         id="btnbtn" > <i class="fa fa-folder text-white "  ></i></a>
 <?php } ?>
</span>
</div>
  <br>  

<?php if($ro['type']=='SACHERIE'){ affichage_par_cale($bdd,$b); }
      if($ro['type']=='VRAQUIER'){ affichage_par_cale_vrac($bdd,$b); } ?>
  
  
  </div>



<?php  
$form=form_modif($bdd,$b);
if($forms=$form->fetch()){ ?>

  

<?php //FORM MODIFIER DC ?>



<?php } ?>



<div class="container-fluid" id="parproduit" style="display:none;" >
       
<div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_produit'><span class="fa fa-print text-white"></span></a>
</div>
<br>  <?php $filtre_poids=$bdd->prepare('SELECT conditionnement from declaration_chargement where id_navire=? GROUP by conditionnement');
$filtre_poids->bindParam(1,$b);
$filtre_poids->execute(); ?>
      <select id='par_poids' data-role='filtre_par_poids' >
    <option value=''>filtre par poids</option>
    <?php while($filter=$filtre_poids->fetch()){ ?>
      
      <option value=<?php echo $filter['conditionnement']; ?>><?php echo $filter['conditionnement']; ?>KG</option>
    <?php } ?>
  </select>           
<input type="text" name="" id=filtre_id_navire value="<?php echo $b; ?>">

            <div id="tab_par_produit" class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
            
          <thead class="entete_by_prod">   
            <tr  style="text-align: center; font-size: 18px; color: black; font-weight: bold;">   <td colspan="4" >CHARGEMENT PAR PRODUIT <br>
              NAVIRE <span style="color:blue;"> <?php echo strtoupper($ro['navire']) ?></span></td></tr>
 <tr  style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >PRODUIT</th>
                                <th  scope="col" >CALES</th>
                                <?php if($ro['type']=="SACHERIE"){?>
                                <th scope="col" >QUANTITE</th>
                              <?php } ?>

                                <th scope="col" >POIDS(T)</th>

                                
   
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">

       <?php


 
 $res2 = $bdd->prepare("SELECT   p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by  p.produit,dc.conditionnement, dc.cales, dc.id_dec with rollup ");
        $res2->bindParam(1,$b);
       
        
        $res2->execute();

        
      
       
       while($row2 = $res2->fetch()){
            ?>
            
              <?php 
              if(!empty($row2['cales']) and !empty($row2['produit']) and !empty($row2['conditionnement']) and !empty($row2['id_dec']) and $ro['type']=="SACHERIE"){

               ?>
               <tr style="text-align:center; background: white; font-size: 14px;" border='5'>
<td class="colcel"><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['conditionnement']; ?> kGS</td>
              <td class="colcel" ><?php echo $row2['cales']; ?></td>



<td class="colcel" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>


<td class="colcel" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr>
<?php } ?>

 <?php 
              if(!empty($row2['cales']) and !empty($row2['produit']) and !empty($row2['id_dec']) and isset($row2['conditionnement']) and $ro['type']=="VRAQUIER"){

               ?>
               <tr style="text-align:center; background: white; font-size: 14px;" border='5'>
<td  class="colcel"><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </td>
              <td class="colcel" ><?php echo $row2['cales']; ?></td>






<td class="colcel" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr>
<?php } ?>


              <?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and !empty($row2['produit']) and !empty($row2['conditionnement'])   AND $ro['type']=="SACHERIE"){

               ?>
            <tr style="font-size: 14px;">  
              <td id="soustotal" >TOTAL <?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['conditionnement']; ?> KGS</td>
<!--id=soustotal !-->
<td id="soustotal"> </td>


<td id="soustotal"><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
<td  id="soustotal"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr> 
<?php } ?>

 <?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and !empty($row2['produit'])  AND !isset($row2['conditionnement']) AND $ro['type']=="VRAQUIER"){

               ?>
            <tr style="font-size: 14px;">  
              <td id="soustotal" >TOTAL <?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </td>

<td id="soustotal"> </td>

<td  id="soustotal"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr> 
<?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and empty($row2['produit']) and empty($row2['conditionnement']) AND $ro['type']=='SACHERIE'){

               ?>
               <center>
                <tr style="font-size: 16px;">
              <td id="total">TOTAL</td></center>

<td id="total"> </td>


<td id="total"><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
<td  id="total"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and empty($row2['produit']) and !isset($row2['conditionnement']) AND $ro['type']=='VRAQUIER'){

               ?>
               <center>
                <tr style="font-size: 16px;">
              <td id="total">TOTAL</td></center>

<td id="total"> </td>

<td  id="total"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>





</tr>
               <?php } ?>
   


                </center>
                                   </tbody>
                     </table> 
                 </div>
                  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: blue;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>

  
</div>
        
        
         
        
<br>

<div class="container-fluid" id="parconnaissement" style="display: none;" >

     <div class="col col-md-6 col-lg-6"> 
 <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_connaissement" data-id_tableau='tab_par_connaissement' data-id='valeur_filtre_connaissement' oninput='cherche_par_connaissement()' > </span>
</div> 

  <?php  affichage_par_connaissement($bdd,$b); ?>
   
 </div> 


                <center>
 <div  class="table-responsive" border=1 id="connaissement_simple" style="display:none;">


          <center>
 <table  class='table table-responsive table-hover table-bordered table-striped'  border='2'  >
  <thead>
  <tr style="color: white; background: blue; font-size:12px; vertical-align: center; text-align: center; vertical-align:middle;">
  <th colspan="7" ><h6 style="color: white;">NUMERO DE CONNAISSEMENT</h6> </th></tr>
  <tr style="background: blue; color: white; font-size:12px; text-align: center; vertical-align:middle;">
    <th>N° CONNAISSEMENT</th>
      <th>PRODUIT & <br>QUALITE</th>
      <th>RECEPTIONNAIRE</th>
    <th>BANQUE</th>
    <th>FOURNISSEUR</th>
    <th>POIDS</th>
    <th>ACTION</th>
  </tr>

  </thead>

  <tbody>

  <?php  affichage_connaissement_unique($bdd,$b); ?>
  </tbody>
   </table>
 </div> 
 </center>          



 <div class="container-fluid" id="parclient" style="display: none;" >
    <div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_client'><i class="fa fa-print text-white"></i></a>
</div>
<br>  
         <div id="tab_par_client" class="card">
            <div class="card-header">
            
           </div>
               <div class="card-body"> 
                                <?php  
                     $client=afficher_client($bdd,$b);

        $resultats = $client->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
  <tr id="entete_head2" style="text-align: center;">  <td colspan="6"> DISPATCHING PAR RECEPTIONNAIRE </td></tr>
    <tr class="head_tr" style="background: black; color: white; text-align: center; vertical-align: middle;">
       
        <th class="head_tr" style="color:white;">RECEPTIONNAIRE</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
         <th style="color:white;">DESTINATION</th>
        <?php if($ro['type']=="SACHERIE"){ ?>
        <th style="color:white;">QUANTITE</th>
      <?php } ?>
        <th style="color:white;">POIDS (T)</th>
         
         <th style="color:white;">DECLARATION</th>
        
        
    </tr>

    <?php
    $lastReceptionnaire = null;

    $lastDestinationMang = null;
    $rowspanReceptionnaire = 0;
      $lastClient = null;
    $rowspanClient = 0;
     $id_dis = null;

     $lastConnaissement=NULL;
     $lastReceptionnaire2=NULL;
     $rowspanConnaissement=0;
     $id_dis=NULL;
     $row2=0;
     $lastMangasin=NULL;
     $rowspanMangasin=0;
     $lastrecep='NULL';
     $BlCol2='NULL';
     $ClientCol2='NULL';
     $rowspanCol2=0;

      $cli_con='NULL';
      $num_cli_con='NULL';
     $rowspanCliCon=0;

     $meme_produit='NULL';
     $meme_poids_kg='NULL';
     $meme_connaissement='NULL';
     $meme_client='NULL';
     $rowspanProduit=0;

    
     $meme_connaissement_mg='NULL';
     $meme_client_mg='NULL';
     $meme_mangasins='NULL';
     $rowspanMangasins=0;

     $meme_connaissement_mg_id_dis='NULL';
     $meme_client_mg_id_dis='NULL';
     $meme_mangasins_id_dis='NULL';
     $rowspanMangasins_id_dis=0;


   foreach ($resultats as $row) {
?>
<tr style="text-align: center;  background: white; " >
<?php    
    // Colonne Destination
    if ($lastReceptionnaire != $row['client'] )  {
        $rowspanReceptionnaire = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $lastReceptionnaire = $row['client'];
        foreach ($resultats as $r) {
            if ($r['client'] === $lastReceptionnaire) {
              //ici on compte le nombre de destination
                $rowspanReceptionnaire++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanReceptionnaire; ?>'><?php echo $row['client']; ?> <?php echo $rowspanReceptionnaire; ?> </td>

       
       
        
<?php   
    }

    if ($cli_con != $row['client'] or $num_cli_con != $row['num_connaissement'] )  {
        $rowspanCliCon = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $cli_con = $row['client'];
        $num_cli_con = $row['num_connaissement'];
        foreach ($resultats as $r) {
            if ($r['client'] ==$cli_con and $r['num_connaissement']==$num_cli_con  ) {
              //ici on compte le nombre de destination
                $rowspanCliCon++;
            }

        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan=<?php echo $rowspanCliCon; ?>><?php echo $row['num_connaissement']; ?> <?php echo $rowspanCliCon; ?> </td>

       
       
        
<?php  
    }

 
  if ($meme_client != $row['client'] or $meme_connaissement != $row['num_connaissement'] or $meme_produit != $row['id_produit'] or $meme_poids_kg != $row['poids_kg'] )  {
        $rowspanProduit = 0; // Réinitialisation du rowspan pour la nouvelle destination
       $meme_client = $row['client'];
        $meme_connaissement = $row['num_connaissement'];
        $meme_produit = $row['id_produit'];
        $meme_poids_kg = $row['poids_kg'];
        foreach ($resultats as $r) {
            if ($r['client'] === $meme_client and $r['num_connaissement']===$meme_connaissement and $r['id_produit']===$meme_produit and $r['poids_kg']===$meme_poids_kg) {
              //ici on compte le nombre de destination
                $rowspanProduit++;
            }
        }
        // Colonne Destination
?>
          <td style="vertical-align: middle;" rowspan='<?php echo $rowspanProduit; ?>'><?php echo $row['produit'] ?> <?php  echo $row['qualite']; ?> <br><?php echo $row['poids_kg'].' KG';  ?>  
           </td>

      
       
        
<?php  
    }


    if ($meme_client_mg != $row['client'] or $meme_connaissement_mg != $row['num_connaissement']  or $meme_mangasins != $row['mangasin'] )  {
        $rowspanMangasins = 0; // Réinitialisation du rowspan pour la nouvelle destination
       $meme_client_mg = $row['client'];
        $meme_connaissement_mg = $row['num_connaissement'];
       // $meme_produit_mg = $row['id_produit'];
       // $meme_poids_kg_mg = $row['poids_kg'];
        $meme_mangasins = $row['mangasin'];

        foreach ($resultats as $r) {
          if ($r['client'] === $meme_client_mg and $r['num_connaissement']===$meme_connaissement_mg  and $r['mangasin']===$meme_mangasins) {
              //ici on compte le nombre de destination
                $rowspanMangasins++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan=<?php echo $rowspanMangasins; ?>><?php echo $row['mangasin']; ?> <?php echo $rowspanMangasins; ?> </td>

       
       
        
<?php  
    }
 

  ?>



       
       
        
<?php   
   // }



    // Colonne Destination
      
    // Colonne Destination
   
    

    // AFFICHER LES AUTRES COLONNES SANS ROWSPAN
   
     
   
?>
      

      

    
                <?php if($ro['type']=="SACHERIE"){ ?> 
       

      <?php   

       if ($meme_client_mg_id_dis != $row['client'] or $meme_connaissement_mg_id_dis != $row['num_connaissement']  or $meme_mangasins_id_dis != $row['id_dis'] )  {
        $rowspanMangasins_id_dis = 0; // Réinitialisation du rowspan pour la nouvelle destination
       $meme_client_mg_id_dis = $row['client'];
        $meme_connaissement_mg_id_dis = $row['num_connaissement'];
       // $meme_produit_mg = $row['id_produit'];
       // $meme_poids_kg_mg = $row['poids_kg'];
        $meme_mangasins_id_dis = $row['id_dis'];

        foreach ($resultats as $r) {
          if ($r['client'] === $meme_client_mg_id_dis and $r['num_connaissement']===$meme_connaissement_mg_id_dis  and $r['id_dis']===$meme_mangasins_id_dis) {
              //ici on compte le nombre de destination
                $rowspanMangasins_id_dis++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan=<?php echo $rowspanMangasins_id_dis; ?>><?php echo $row['quantite_sac']; ?> <?php echo $rowspanMangasins_id_dis; ?> </td>
           <td style="vertical-align: middle;" rowspan=<?php echo $rowspanMangasins_id_dis; ?>><?php echo $row['quantite_poids']; ?> <?php echo $rowspanMangasins_id_dis; ?> </td>
       
       
        
<?php  
    }
 
} 
  ?>
        
         <td style="vertical-align: middle;"><?php echo $row['num_declaration'] ?></td>
       

<?php
   
   
          

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>
 </div>
</div>  
<style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
    
<

<div class="container-fluid" id="pardestination" style="display: none;" >
<div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_destination'><i class="fa fa-print text-white"></i></a>
</div>

            <div id="tab_par_destination" class="table-responsive" border=1> 
           

                                <?php  
                     $destination=afficher_destination($bdd,$b);

        $resultats = $destination->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table  class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
  <tr style="text-align: center;"> <td colspan="6">  DISPATCHING PAR DESTINATION</td></tr>
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
        <th style="color:white;">DESTINATION</th>
        <th style="color:white;">RECEPTIONNAIRE</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
        <?php if($ro['type']=="SACHERIE"){ ?>
        <th style="color:white;">QUANTITE</th>
      <?php } ?>
        <th style="color:white;">POIDS (T)</th>
        <th style="color:white;">DECLARATION</th>
        
    </tr>

    <?php
    $lastDestination = null;

    $lastDestinationMang = null;
    $rowspanDestination = 0;
      $lastClient = null;
    $rowspanClient = 0;
     $id_dis = null;

     $lastDest='NULL';
     $lastCli='NULL';
     $rowspanCli=0;

   foreach ($resultats as $row) {
?>
<tr style="text-align: center;  background: white; " >
<?php    
    // Colonne Destination
    if ($lastDestination != $row['mangasin'] and !empty($row['mangasin']))  {
        $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $lastDestination = $row['mangasin'];
        foreach ($resultats as $r) {
            if ($r['mangasin'] === $lastDestination) {
              //ici on compte le nombre de destination
                $rowspanDestination++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination-1; ?>'><?php echo $row['mangasin']; ?> </td>

      
       
        
<?php   
    }
     

    // AFFICHER LES AUTRES COLONNES SANS ROWSPAN
   
     
       if(!empty($row['mangasin']) /*and !empty($row['client'])*/ and !empty($row['id_dis'])){

  if( ($lastDest!=$row['mangasin'] /*and !empty($row['mangasin']) and !empty($row['id_dis'])*/ or $lastCli!=$row['client'] ) 
    
         /*or ($lastDest!=$row['mangasin'] and !empty($row['mangasin']) and !empty($row['id_dis'])  and $lastCli===$row['client']  )*/ ) {
      $lastDest=$row['mangasin'];
      $lastCli=$row['client'];
      $rowspanCli=0;
      foreach ($resultats as $r) {
       if($r['mangasin']===$lastDest and !empty($r['mangasin']) and $r['client']===$lastCli and !empty($r['id_dis'])/*and !empty($row['client'])*/  and !empty($row['id_dis']) ){
        $rowspanCli++;
       }
      }
      ?>
      <td rowspan="<?php echo $rowspanCli ?>" style="vertical-align: middle;"><?php echo $row['client'] ?> </td>

      <?php  

    }    ?>
        <!-- Le reste de votre code pour les autres colonnes -->
        <td style="vertical-align: middle;  padding: 10px;  "><?php echo $row['num_connaissement'] ?></td>
        <td style="vertical-align: middle;"><?php echo  $row['produit'] ?> <?php if( $ro['type']=='SACHERIE'){ echo $row['qualite']; ?> <br><?php echo $row['poids_kg'].' KG'; } ?> <?php if( $ro['type']=='VRAQUIER'){ echo $row['qualite_vrac']; ?> <br><?php if($row['poids_kgs']!=0){ echo $row['poids_kgs'].' KG'; } } ?></td> 
        <?php if($ro['type']=="SACHERIE"){ ?>
        <td style="vertical-align: middle;"><?php echo number_format($row['quantite_sac'], 0,',',' ');  ?></td>
      <?php } ?>
        <td style="vertical-align: middle;"><?php echo number_format($row['quantite_poids'], 3,',',' '); ?></td>
         <td style="vertical-align: middle;"><?php //echo $row['num_declaration'] ?></td>

<?php
    }
            if(!empty($row['mangasin']) /*and empty($row['client'])*/ and empty($row['id_dis'])){ ?>
         
         <td colspan="4" style="background: blue; color: white;">TOTAL</td>
         <?php if($ro['type']=="SACHERIE"){ ?>
        <td style="background: blue; color: white;"><?php echo number_format($row['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>

      <?php } ?>
       <td style="background: blue; color: white;"><?php echo number_format($row['sum(dis.quantite_poids)'], 3,',',' ');  ?></td>
         <td style="background: blue; color: white;"></td>
      
       
        <?php    
        } 
                    if(empty($row['mangasin']) /*and empty($row['client'])*/ and empty($row['id_dis'])){ ?>
          
         <td style="background: black; color: white;"  colspan="4">GENERAL</td>
        <?php if($ro['type']=="SACHERIE"){ ?>  
       <td style="background: black; color: white;"><?php echo number_format($row['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
     <?php } ?>
        <td style="background: black; color: white;"><?php echo number_format($row['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td style="background: black; color: white;"></td>
       
        
      <?php    }

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>

<style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}

</style>

   

</div>


<div class="container-fluid" id="parbanque" style="display: none;" >


         
              <center>
              <h1 class="hdeclaration text-white" >DISPATCHING PAR BANQUE</h1>
              </center>

            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>   
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >BANQUE</th>
                                <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>

                                <th  scope="col" >QUANTITE</th>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DESTINATION</th>
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t),cli.id as idcli, p.id as idp, mang.id as idmang,b.banque,b.id from dispatching as dis
                         
                        inner join client as cli on dis.id_client=cli.id 
                         
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                        inner join produit_deb as p  on dis.id_produit=p.id
                        inner join banque as b on b.id=dis.id_banque_dis
                         
                      
                        where dis.id_navire=?  group by b.banque, cli.client,  dis.id_dis with rollup ");
        $client->bindParam(1,$b);
       
        
        $client->execute();

        while($row2 = $client->fetch()){

            ?>
          
             <?php if(!empty($row2['banque']) and !empty($row2['client']) and !empty($row2['id_dis'])){ ?>
                <tr id="<?php echo $row2['id_dis'] ?>"  style="text-align:center; background: white; font-size: 14px;" border='5'>
                   <td class="colcel" id="<?php echo $row2['id_dis'].'clientdis' ?>"  ><?php echo $row2['banque']; ?></td>
             <td class="colcel" id="<?php echo $row2['id_dis'].'clientdis' ?>"  ><?php echo $row2['client']; ?></td> 
             <td class="colcel" id="<?php echo $row2['id_dis'].'n_bl_dis' ?>"><?php echo $row2['n_bl']; ?></td>

<td class="colcel" ><?php echo $row2['produit']; ?> <br><?php echo $row2['qualite']; ?> <br><?php echo $row2['poids_kg']; ?> kgs</td>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'produitdis' ?>" ><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'condidis' ?>" ><?php echo $row2['poids_kg']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idproduitdis' ?>" ><?php echo $row2['idp']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'navdis' ?>" ><?php echo $row2['id_navire']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idclientdiscol' ?>" ><?php echo $row2['idcli']; ?>  </span>

        <td class="colcel" id="<?php echo $row2['id_dis'].'sacsdis' ?>" ><?php echo number_format($row2['nombre_sac'], 0,',',' '); ?></td>
         <td class="colcel"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" id="<?php echo $row2['id_dis'].'destidis' ?>" ><?php echo $row2['mangasin']; ?></td>
             

            
            <td class="colcel" ><a  id="<?php echo $row2['id_dis'] ?>" name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row2['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn" type="button" name="modify"    style="border: none; margin-right: 1px; color:rgb(0,141,202);" data-role="update_disclient" data-id="<?php echo $row2['id_dis']; ?>"> <i class="fa fa-edit  "  ></i></a>
     
    </td>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idclientdis' ?>" ><?php echo $row2['idcli']; ?></span>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'iddestidis' ?>" ><?php echo $row2['idmang']; ?></span>
     <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_navire_dis_del' ?>" ><?php echo $row2['id_navire']; ?></span>
  </tr>
    <?php } ?>
                       <?php 
              if(empty($row2['client']) and empty($row2['id_dis']) and !empty($row2['banque'])){
                  
               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td id="soustotal" colspan="4">TOTAL <?php echo $row2['client']; ?> </td>

<td id="soustotal" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="soustotal"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td colspan="2" id="soustotal" > </td>
</tr>
<?php } ?>
                      



    <?php 
              if(empty($row2['banque']) and empty($row2['client']) and empty($row2['id_dis'])){

               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td style="background-color:#1B2B65; color: red; border: none;">  </td>

<td id="total" colspan="3" >TOTAL </td>


<td id="total" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="total" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total" colspan="2"> </td>
</tr>
<?php } ?>
            
       


<?php } ?>
     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>

   <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parclient')">imprimer</button>
 </div>      
<br>




<br>

<div class="container-fluid" id="parbl" style="display:none;">
              <center>
              <h1 class="hdeclaration text-white" >CONNAISSEMENTS</h1>
              </center>

            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>   
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >BL</th>
                                <th  scope="col" >BANQUE</th>
                                <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >PRODUIT</th>

                                <th  scope="col" >QUANTITE</th>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DESTINATION</th>
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t), b.banque, b.id from dispatching as dis
                         
                        inner join client as cli on dis.id_client=cli.id 
                         
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                        inner join produit_deb as p  on dis.id_produit=p.id
                        left join banque as b on b.id=dis.id_banque_dis
                         
                      
                        where dis.id_navire=?  group by dis.n_bl, mang.mangasin, dis.id_dis with rollup ");
        $client->bindParam(1,$b);
       
        
        $client->execute();

        while($row2 = $client->fetch()){

            ?>
          
             <?php if(!empty($row2['mangasin']) and !empty($row2['n_bl']) and !empty($row2['id_dis'])){ ?>
                <tr  id="<?php echo $row2['id_dis']; ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>
             <td class="colcel" id="<?php echo $row2['id_dis'].'bl_dis' ?>" ><?php echo $row2['n_bl']; ?></td> 
             <td class="colcel" id="<?php echo $row2['banque'].'banque_dis' ?>" ><?php echo $row2['banque']; ?></td>
             <td class="colcel" id="<?php echo $row2['id_dis'].'cli_dis' ?>" ><?php echo $row2['client']; ?></td>
             <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_client_dis' ?>" ><?php  echo $row2['id_client']; ?></span>


<td class="colcel" id="<?php echo $row2['id_dis'].'prod_dis' ?>" ><?php echo $row2['produit']; ?> <br><?php echo $row2['qualite']; ?> <br><?php echo $row2['poids_kg']; ?> kgs</td>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_prod_dis' ?>" ><?php echo $row2['id_produit']; ?> </span>
        <td class="colcel" id="<?php echo $row2['id_dis'].'sac_dis' ?>"><?php echo number_format($row2['nombre_sac'], 0,',',' '); ?></td >
         <td class="colcel"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" id="<?php echo $row2['id_dis'].'mg_dis' ?>" ><?php echo $row2['mangasin']; ?></td>
               <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_mg_dis' ?>" ><?php echo $row2['id_mangasin']; ?></span>
              <td class="colcel"  style="display: none;"><?php echo $row2['id_navire'] ?></td>
               <td class="colcel" data-target="affreteur_dis" style="display: none;"><?php echo $row2['affreteur'] ?></td>
                <td class="colcel" data-target="banque_dis" style="display: none;"><?php echo $row2['banque'] ?></td>
            
            <td class="colcel" >
               <div style="display: flex; justify-content: center;"> 
              <a name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row2['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"  name="modifys"  data-role="update_dis" data-id="<?php echo $row2['id_dis']; ?>"    style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit  " ></i></a>
     <a class="fabtn1" href="insertion_fichier_mangasin.php?id=<?php echo $row2['id_dis'] ?>" style="float:right;" target="blank" name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
   </div>
    </td>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'conditionnement' ?>"><?php echo $row2['poids_kg']; ?></span>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'id_client' ?>"><?php echo $row2['poids_kg']; ?></span>
     <span style="display: none;" id="<?php echo $row2['id_dis'].'id_navire' ?>"><?php echo $row2['id_navire']; ?></span>
    
  </tr>
    <?php } ?>
                       <?php 
              if(empty($row2['mangasin']) and empty($row2['id_dis']) and !empty($row2['n_bl'])){
                  
               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td id="soustotal" colspan="4">TOTAL <?php echo $row2['n_bl']; ?> </td>

<td id="soustotal" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="soustotal"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td colspan="2" id="soustotal" > </td>
</tr>
<?php } ?>
                      



    <?php 
              if(empty($row2['mangasin']) and empty($row2['n_bl']) and empty($row2['id_dis'])){

               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td style="background-color:#1B2B65; color: red; border: none;">  </td>

<td id="total" colspan="4" >TOTAL </td>


<td id="total" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="total" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total" colspan="2"> </td>
</tr>
<?php } ?>
            
       


<?php } ?>
     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background:blue;
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>

   <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parbl')">imprimer</button>
 </div>      
<br>

<div class="container-fluid" id="partransit" style="display:none;">

              <center>
              <h1 class="hdeclaration text-white" style="font-size: 20px;" >GESTION DU TRANSIT (ENTREE EN ENTREPOT)</h1>
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
  <?php 

  $manifest = $bdd->prepare("select tr.n_manifeste, dis.* from dispatching as dis
    inner join transit as tr on dis.id_dis=tr.id_bl
    where dis.id_navire=?  ");
        $manifest->bindParam(1,$b);
       
        
        $manifest->execute();
        $manif=$manifest->fetch();
        if($manif){?>
          <h3>NUMERO MANIFESTE: <span style="color: red;"><?php echo $manif['n_manifeste'] ?></span></h3>


       <?php } ?> 
            
 <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 12px; " border='5' >
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>
                                <th  scope="col" >POIDS MANIFESTE</th>
                                 <th    scope="col" >STATUT DOUANIER</th>
                                <th   scope="col" >DESTINATION DOUANIERE</th>
                               
                                <th  scope="col" >N° DEC / TRANSFERT</th>
                               <th  scope="col" >POIDS DECLARES</th>
                                 
                                 <th  scope="col" >DESTINATION</th>
                               <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >ACTIONS</th>
                               
                           
                               
                               
 
                                
                                


                                
                             </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php 
    


                                 
                        $client = $bdd->prepare("SELECT tr.*, p.*, cli.*, mang.*,   dis.*  from dispatching as dis
                        inner join transit as tr on dis.id_dis=tr.id_bl 
                        inner join produit_deb as p on dis.id_produit=p.id
                        inner join client as cli on dis.id_client=cli.id
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                       
                        
                        
                        where dis.id_navire=?   order by dis.n_bl ");
        $client->bindParam(1,$b);
        $client->execute();

        

         $somme = $bdd->prepare("SELECT tr.*,dis.*, sum(dis.poids_t), sum(tr.poids_declarer)  from dispatching as dis
                        inner join transit as tr on dis.id_navire=tr.id_trans_navire and dis.id_dis=tr.id_bl 

                        where dis.id_navire=?  ");
        $somme->bindParam(1,$b);
       
        
        $somme->execute();

        $client2 = $bdd->prepare("SELECT tr.id_trans, p.id, cli.id, mang.id, dis.id_navire, dis.id_dis, dis.n_bl, sum(tr.poids_declarer), dis.poids_t from dispatching as dis inner join transit as tr on dis.id_dis=tr.id_bl inner join produit_deb as p on dis.id_produit=p.id inner join client as cli on dis.id_client=cli.id inner join mangasin as mang on dis.id_mangasin=mang.id where dis.id_navire=? group by dis.id_dis  ");
        $client2->bindParam(1,$b);
        $client2->execute();

        while($row2 = $client->fetch()){
           
          
      //$reste=$row2['poids_t']-$cal['sum(tr.poids_declarer)'];
            ?>
            <tr style="text-align:center; font-size:12px; background: white; " border='5' id=<?php echo $row2['id_trans'] ?>>
            
             <td id="<?php echo $row2['id_trans'].'bl_transit' ?>" class="colcel"><?php echo $row2['n_bl']; ?></td> 
              <span style="display:none;" id="<?php echo $row2['id_trans'].'id_bl_transit' ?>" class="colcel"><?php echo $row2['id_dis']; ?></span>
        <td id="<?php echo $row2['id_trans'].'produit_transit' ?>" class="colcel"><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['poids_kg'] ?> KGS</td>
        <span style="display:none;" id="<?php echo $row2['id_trans'].'id_produit_transit' ?>" class="colcel"><?php echo $row2['id_produit']; ?></span>
         <span style="display:none;" id="<?php echo $row2['id_trans'].'navire_trans' ?>" class="colcel"><?php echo $row2['id_navire']; ?></span>
        <td class="colcel" style="color: red;"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
             <td class="colcel" id="<?php echo $row2['id_trans'].'statut_douaniere' ?>"  ><?php echo $row2['statut_douaniere']; ?> </td>

<td class="colcel" id="<?php echo $row2['id_trans'].'destination_douaniere' ?>"><?php echo $row2['destination_douaniere']; ?> </td>
               
            
                   
              <td class="colcel"  id="<?php echo $row2['id_trans'].'numero_declaration' ?>" ><?php echo $row2['numero_declaration']; ?></td>
              <td id="<?php echo $row2['id_trans'].'poids_declarer' ?>" class="colcel"><?php echo number_format($row2['poids_declarer'], 3,',',' '); ?></td>
             
              <td  class="colcel"><?php echo $row2['mangasin']; ?></td>
              <td  class="colcel"><?php echo $row2['client']; ?></td>
              <span style="display: none;" class="colcel" id="<?php echo $row2['id_trans'].'id_navire_del_trans' ?>" ><?php echo $row2['id_navire']; ?></span>
              
        <td class="colcel" >
          <div style="display: flex; justify-content: center;">
          <a  id="<?php echo $row2['id_dis'] ?>" name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteTransit(<?php echo $row2['id_trans'] ?>)" style="display: flex; justify-content: center; color:rgb(0,141,202);  display: flex; justify-content: center;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn" type="button" name="modify" data-role="update_transit"  data-id="<?php echo  $row2['id_trans']; ?>"       id="btnbtn" style="border: none;  color:rgb(0,141,202); display: flex; justify-content: center;"> <i class="fa fa-edit  " ></i></a>
     <a class="fabtn1" href="insertion_fichier_transit.php?id=<?php echo $row2['id_trans'] ?>" style="display: flex; justify-content: center; " target="blank"  name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
    </td>    
                             

</tr>

<?php } ?>
<?php while($total=$somme->fetch()){ 
  $restant=$total['sum(dis.poids_t)']-$total['sum(tr.poids_declarer)']  ?>

 <tr style="text-align:center; font-size: 12px;" border='5'>
  <td style=" font-size: 12px;" id="total" colspan="2"> TOTAL </td>
  <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(dis.poids_t)'], 3,',',' '); ?> </td> 
  <td style=" font-size: 12px;" id="total" colspan="3">  </td> 
 <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(tr.poids_declarer)'], 3,',',' '); ?> </td>
  
  <td style=" font-size: 12px;" id="total" colspan="2">  </td>
  <td style=" font-size: 12px;" id="total" >  </td>

</tr>
<?php } ?>
<tr>
  <td colspan="10" style="text-align: center;">RESTE A DECLARER</td>
  </tr>
  <tr>
  <td colspan="5" style="text-align: center;">NUMERO BL</td>
  <td colspan="5" style="text-align: center;">RESTE A DECLARER</td>
</tr>
<?php while ($rest=$client2->fetch()) { 
$restant=$rest['poids_t']-$rest['sum(tr.poids_declarer)']; ?>
<tr>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo $rest['n_bl']; ?></td>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo $restant; ?></td>
</tr>
<?php } ?>





     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>

   <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('partransit')">imprimer</button>
</div>


<div class="container-fluid" id="partransit2" >
<?php 
    $nombre_dec=$bdd->prepare("SELECT ex.*,re.*, dis.n_bl,dis.poids_t,dis.poids_kg, p.produit,p.qualite, mg.mangasin, cli.client  from transit_extends as ex
      inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
      inner join dispatching as dis on dis.id_dis=ex.id_bl_extends
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on dis.id_mangasin=mg.id
      inner join client as cli on cli.id=dis.id_client
      WHERE ex.id_trans_navire_extends=? ");
     $nombre_dec->bindParam(1,$b);
     $nombre_dec->execute();
     $nomb=$nombre_dec->fetchAll(PDO::FETCH_ASSOC);
     //$nombre=$nombre_dec->fetch();

     
     ?>
              <center>
              <h1 class="hdeclaration text-white" style="font-size: 23px;" >GESTION DU TRANSIT (ENTREE EN ENTREPOT)</h1>
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
 
            
 <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 12px; vertical-align: middle; " border='5' >                             
                                 <th  scope="col" >N° BL </th>
                                <th  scope="col" >PRODUIT </th>
                                <th  scope="col" >MANIFESTE </th>
                                 <th  scope="col" >N° DECLARATION </th>
                                
                                 <th    scope="col" >DATE D'ECHEANCE </th>
                                <th  scope="col" >ENTREPOTS </th>
                                
                                <th  scope="col" >QUANTITE DECLAREE </th>
                               <th  scope="col" >CUMUL DECLARES </th>
                                 
                                 <th  scope="col" >RESTE A DECLARER </th>

                                <th  scope="col" >ACTIONS</th>
                                 


                             </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                 
    <?php
            $num_dec='NULL';
            $rowspanDestination = 0;
            $num_dec2='NULL';
            $rowspanDestination2 = 0;
            $client='NULL';
            $rowspanClient=0;
            $bl='NULL';
            $rowspanBl=0;
            $num_dec3='NULL';
            $reste_declarer=0;
            $rowspanDestination3 = 0;
     foreach ($nomb as $row) { 
      
       $somme_manifest=$bdd->prepare("SELECT ex.id_trans_reelle,re.id_trans_reelle, sum(dis.poids_t),sum(ex.poids_declarer_extends)  from transit_extends as ex
      inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
      inner join dispatching as dis on dis.id_dis=ex.id_bl_extends

      WHERE ex.id_trans_navire_extends=? and ex.id_trans_reelle=? ");
     $somme_manifest->bindParam(1,$b);
      $somme_manifest->bindParam(2,$row['id_trans_reelle']);
     $somme_manifest->execute();
     $som=$somme_manifest->fetch();
     $reste_declarer=$som['sum(dis.poids_t)']-$som['sum(ex.poids_declarer_extends)'];

      ?>
     <tr style="background: white; vertical-align: middle; text-align: center;"> 
   
      <?php    
    // Colonne Destination
    if ($num_dec!= $row['numero_declaration'] )  {
        $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec = $row['numero_declaration'];
        foreach ($nomb as $r) {
            if ($r['numero_declaration'] === $num_dec) {
              //ici on compte le nombre de destination
                $rowspanDestination++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination; ?>'><?php echo $row['n_bl']; ?> 
         </td>
         <td rowspan='<?php echo $rowspanDestination; ?>' > <?php  echo $row['produit'].' '.$row['qualite'].' '.$row['poids_kg'].' kg'; ?>  </td>
         <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination; ?>'><?php echo $som['sum(dis.poids_t)']; ?> </td>

      <?php   } ?>

     
      


     <?php    
    // Colonne Destination
    if ($num_dec3!= $row['numero_declaration'] )  {
        $rowspanDestination3 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec3 = $row['numero_declaration'];
        foreach ($nomb as $r) {
            if ($r['numero_declaration'] === $num_dec3) {
              //ici on compte le nombre de destination
                $rowspanDestination3++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination3; ?>"  > <?php echo $row['numero_declaration']; ?>  </td>
      <?php   } ?>
         
          
           
            <td >  </td>
          <td style="vertical-align: middle;"><?php echo $row['mangasin']; ?> </td> 
           <td  <?php if($row['reelle']=='true'){ ?> style="vertical-align: middle; background: green; color:white;" <?php  } ?> > <?php echo $row['poids_declarer_extends']; ?>  </td> 
         
    <?php    
    // Colonne Destination
    if ($num_dec2!= $row['numero_declaration'] )  {
        $rowspanDestination2 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec2 = $row['numero_declaration'];
        foreach ($nomb as $r) {
            if ($r['numero_declaration'] === $num_dec) {
              //ici on compte le nombre de destination
                $rowspanDestination2++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination2; ?>'><?php echo $som['sum(ex.poids_declarer_extends)']; ?></td>
         <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination2; ?>'><?php echo $reste_declarer; ?></td>
        
      <?php   } ?>
     
              

 
        <td >
        <div style="display: flex; align-items: center;">  <a style="color: blue;" target="blank" href="ajout_transit_heritier.php?m=<?php echo $row['id_trans_navire'].'-'.$row['id_trans_reelle'] ?>"><i class="fas fa-add"></i></a> 
        <a style="color: blue;" data-role='update_table_transit' data-id=<?php echo $row['id_trans_reelle']; ?> ><i class="fas fa-edit"></i></a> 
        <a style="color: blue;" ><i class="fas fa-trash"></i></a> </div></td>

               </tr>
             <?php  } ?>
           

</tbody>
</table>
</div>
</div>

 

 


       
<?php  }
//else {
  ?>

 <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
</style>
 

  <div  id="fetch_cargo_plan" class="col-md-12">
    <div class="card">
    <div class="card-header">
      <center>
        <h1 class="hdeclaration text-white" >DECLARATION DE CHARGEMENT</h1>
          </center>
           </div>

          <div class="card-body"> 
    <?php  while($rownav = $navire->fetch()){ ?>
              <div class="row">
               
                <div class="col-md-4 col-lg-4">
                    <h6>NAVIRE: <span style="color:red;"><?php echo $rownav['navire'];?>     </span></h6></div>
                     <div class="col-md-4 col-lg-4">
                                  <h6>ETA: <span style="color:red;"><?php echo $rownav['eta'];?></span></h6></div>
                                   <div class="col-md-4 col-lg-4">
                                     <h6>CLIENT: <span style="color:red;"><?php echo $rownav['client_navire'];?></span></h6>
                                         </div>
                            <div class="col-md-4 col-lg-4">  
                              <h6>TYPE DE CHARGEMENT: <span style="color:red;"><?php echo $rownav['type'];?>   </span></h6></div>
                                   <div class="col-md-4 col-lg-4">
                                     <h6>ETB: <span style="color:red;"><?php echo $rownav['etb'];?></span></h6>
                                         </div>
                                          <div class="col-md-4 col-lg-4">
                                          <h6> </h6></div>
                                           <div class="col-md-4 col-lg-4">
                                             <h6>DESTINATION: <span style="color:red;"><?php echo $rownav['destination'];?></span></h6></div>
                                          
                                        <div class="col-md-4 col-lg-4">
                                       <h6>ETD <span style="color:red;"><?php echo $rownav['etd'];?></span></h6></h6></div>
                                       <div class="col-md-4 col-lg-4">
                                          <h6> </h6></div>
                                      
                                                  
                                </div>                
                              <?php } ?>
                            <select id="navire" name="navire" class="form-control form-control-mb-4 " onchange='go()'>
                          <option value="">choix du navire</option>
                                      <?php 
                                  while ($chNav=$navires->fetch()) {
                                  ?>
                        <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option> 
                               <?php } ?> 
                       </select>
                      </div>
                      <div class="row">
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" id="bntcale" onclick="visibleCale();"> CALE</button>
                      </div>
                       <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" onclick="visibleProduit();"> PRODUIT</button>
                       </div>
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;" >
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" onclick="visibleClient();">RECEPTIONNAIRE</button>
                       </div>
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" onclick="visibleDestination();"> DESTINATION</button>
                       </div>
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" style="display: flex; justify-content: center;" onclick="visibleBl();">CONNAISSEMENT</button>
                       </div>
                        <div class="col col-md-4 col-lg-2" style="display: flex; justify-content: center;">
                      <button class="btn btn-primary" onclick="visibleTransit();">TRANSIT</button>
                      </div>
                       </div>
        </div>


         <div class="container-fluid" id="parcale" style="display: none;" >

                       <center>
                      <h1 class="hdeclaration text-white" >CHARGEMENT PAR CALE</h1></center>
                      
  


                          <div class="card-body"> 
                   <div class="table-responsive" border=1> 
                  <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
                <thead> 

               <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                
              <th  >CALES</th>
              <th  scope="col" >NOM CHARGEUR</th>
             <th  scope="col" >PRODUIT</th>
                   
          
          <th  scope="col" >POIDS (T)</th>
          <th  scope="col" class="hide-on-print">ACTIONS</th>
         
         </tr>
         
        </thead>
      <tbody style="font-weight: bold;">

                        <?php
               $res2 = $bdd->prepare("SELECT p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by dc.cales, p.produit, dc.id_dec  with rollup ");
            $res2->bindParam(1,$b);
            $res2->execute();
             while($row2 = $res2->fetch()){
            ?>
      
              <?php 
              if(!empty($row2['produit']) and !empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
          <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center; background: white; font-size: 14px; vertical-align: middle;" border='5'>

    <td class="colcel" data-target="cales_vrac" ><?php echo $row2['cales']; ?></td>
    <td class="colcel" data-target="nom_chargeur_vrac"><?php echo $row2['nom_chargeur']; ?></td>
   <td class="colcel"   data-target="produit_vrac"  >   <?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?></pre></td><span id="<?php echo $row2['id_dec'].'produit-id-vrac'; ?>" style="display: none;"> <?php echo $row2['id_produit'] ?> </span>
   <td class="colcel" data-target="poids_vrac" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
   <td style="display: none;" class="colcel" data-target="navire_vrac" ><?php echo $row2['id_navire'] ?></td>


   <td class="colcel" class="hide-on-print"><a  id="<?php echo $row2['id_dec'] ?>" name="delete"    onclick="deleteDecvrac(<?php echo $row2['id_dec'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn" type="button" name="modify" href="#" data-role="update_vrac" data-id="<?php echo $row2['id_dec']; ?>"    id="btnbtn" style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit fa-2x " ></i></a>
    </td>
  </tr>
         <?php } ?>

                <?php 
              if(empty($row2['produit']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
                <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center;  font-size: 16px; vertical-align: middle;" border='5'>
    <td id="soustotal" colspan="3" >TOTAL <?php echo $row2['cales']; ?></td>
   
          
          
    <td id="soustotal" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
    <td id="soustotal" class="hide-on-print"></td>
  </tr>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['produit']) and empty($row2['id_dec'])){

               ?>
            <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center;  font-size: 16px; vertical-align: middle;" border='5'>
               
             

<td id="total" colspan="3" >TOTAL </td>

<td id="total"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<td id="total" class="hide-on-print"> </td>
</tr>
<?php } ?>

    
               <?php } ?>
    </tbody>
   </table>  
  </div>
 </div>

 <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parcale')">imprimer</button></div>
  </div>

</div>


<div class="container-fluid" id="parproduit" style="display:none;" >
          <div class="card">
            <div class="card-header">
              <center>
             <h1 class="hdeclaration text-white" >CHARGEMENT PAR PRODUIT</h1></center>
           </div>
               <div class="card-body"> 
            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
            
          <thead>   
  <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th scope="col" >PRODUIT</th>
                                <th  scope="col" >CALES</th>
                                

                                <th  scope="col" >POIDS(T)</th>
                                
 
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">

       <?php


                             
     
 
 $res2 = $bdd->prepare("SELECT p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by  p.produit, dc.cales, dc.id_dec with rollup ");
        $res2->bindParam(1,$b);
       
        
        $res2->execute();

        
      
       
       while($row2 = $res2->fetch()){
            ?>
            <tr style="text-align:center; background: white; font-size: 14px; " border='5'>
              <?php 
              if(!empty($row2['cales']) and !empty($row2['produit'])  and !empty($row2['id_dec'])){

               ?>
<td class="colcel" ><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </td>
              <td class="colcel" ><?php echo $row2['cales']; ?></td>




<td class="colcel" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr>
<?php } ?>


              <?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and !empty($row2['produit'])  ){

               ?>
               <tr style="text-align:center; background: white; font-size: 16px; " border='5'> 

              <td id="soustotal" colspan="2" >TOTAL <?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </td>





<td id="soustotal" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_dec']) and empty($row2['produit']) ){

               ?>
               <center>
           <tr style="text-align:center; background: white; font-size: 16px; " border='5'>      
              <td id="total" colspan="2">TOTAL</td></center>





<td id="total"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
</tr>
<?php } ?>




               <?php } ?>
   


               
                                   </tbody>
                     </table> 
                 </div>
            </div>

        </div>  
        <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parproduit')">imprimer</button></div> 
    </div> 
         





   <div class="container-fluid" id="parclient" >
         <div class="card">
            <div class="card-header">
               <center>
             <h1 class="hdeclaration text-white" >DISPATCHING PAR RECEPTIONNAIRE</h1></center>
           </div>
               <div class="card-body"> 
                                <?php  
                     $client=afficher_client($bdd,$b);

        $resultats = $client->fetchAll(PDO::FETCH_ASSOC); 

// Initialisation des variables pour gérer les rowspan ?>

<table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
    <tr style="background: black; color: white; text-align: center; vertical-align: middle;">
       
        <th style="color:white;">RECEPTIONNAIRE</th>
        <th style="color:white;">NUMERO BL</th>
        <th style="color:white;">PRODUIT</th>
        <th style="color:white;">QUANTITE</th>
        <th style="color:white;">POIDS (T)</th>
         <th style="color:white;">DESTINATION</th>
        
    </tr>

    <?php
    $lastReceptionnaire = null;

    $lastDestinationMang = null;
    $rowspanReceptionnaire = 0;
      $lastClient = null;
    $rowspanClient = 0;
     $id_dis = null;

   foreach ($resultats as $row) {
?>
<tr style="text-align: center;  background: white; " >
<?php    
    // Colonne Destination
    if ($lastReceptionnaire != $row['client'] and !empty($row['client']))  {
        $rowspanReceptionnaire = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $lastReceptionnaire = $row['client'];
        foreach ($resultats as $r) {
            if ($r['client'] === $lastReceptionnaire) {
              //ici on compte le nombre de destination
                $rowspanReceptionnaire++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanReceptionnaire-2; ?>'><?php echo $row['client']; ?> </td>

       
       
        
<?php   
    }

    // AFFICHER LES AUTRES COLONNES SANS ROWSPAN
   
     
       if(!empty($row['client']) and !empty($row['mangasin']) and !empty($row['id_dis'])){
?>
        <!-- Le reste de votre code pour les autres colonnes -->
        <td style="vertical-align: middle;  padding: 10px;  "><?php echo $row['num_connaissement'] ?></td>
        <td style="vertical-align: middle;"><?php echo $row['produit'] ?></td> 
        <td style="vertical-align: middle;"><?php echo $row['quantite_sac'] ?></td>
        <td style="vertical-align: middle;"><?php echo $row['quantite_poids'] ?></td>
        <td style="vertical-align: middle;"><?php echo $row['mangasin'] ?></td>

<?php
    }
            if(!empty($row['client']) and empty($row['mangasin']) and empty($row['id_dis'])){ ?>
         
         <td colspan="5" style="background: blue; color: white;">TOTAL</td>
        <td style="background: blue; color: white;"><?php echo $row['sum(dis.quantite_sac)'] ?></td>
       <td style="background: blue; color: white;"><?php echo $row['sum(dis.quantite_poids)'] ?></td>
      
       
        <?php    
        } 
                    if(empty($row['client']) and empty($row['mangasin']) and empty($row['id_dis'])){ ?>
          
         <td style="background: black; color: white;"  colspan="4">GENERAL</td>
          
       <td style="background: black; color: white;"><?php echo $row['sum(dis.quantite_sac)'] ?></td>
        <td style="background: black; color: white;"><?php echo $row['sum(dis.quantite_poids)'] ?></td>
       
        
      <?php    }

        // Les autres colonnes


        echo '</tr>';
    }
    ?>
</table> 
 
  </div>
 </div>
</div>  
<style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parclient')">imprimer</button></div>
</div>     

<div class="container-fluid" id="pardestination" style="display:none;">
         <div class="card">
            <div class="card-header">
              <center>
              <h1 class="hdeclaration text-white" >GESTION DE STOCKAGE PAR DESTINATION</h1>
              </center>
            </div>
               <div class="card-body"> 
            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
            
          <thead>   
 <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >DESTINATION</th>
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>
                                  
                               
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >RECEPTIONNAIRE</th>
 
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t) from dispatching as dis
                        inner join mangasin as mang on dis.id_mangasin=mang.id 
                        inner join client as cli on dis.id_client=cli.id 
                        inner join produit_deb as p  on dis.id_produit=p.id
                        
                        
                        where dis.id_navire=?  group by mang.mangasin, cli.client, dis.id_dis   with rollup ");
        $client->bindParam(1,$b);
       
        
        $client->execute();

       





        while($row2 = $client->fetch()){

            ?>
           
             <?php if(!empty($row2['mangasin']) and !empty($row2['id_dis']) and !empty($row2['client'])){ ?>
           <tr style="text-align:center; background: white; font-size: 14px;" border='5'>    
             <td class="colcel" ><?php echo $row2['mangasin']; ?></td> 
             <td class="colcel" ><?php echo $row2['n_bl']; ?></td>
             

<td class="colcel" ><?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?> <?php if($row2['poids_kg']!=0){ echo $row2['poids_kg']; ?> kgs <?php } ?> </pre></td>
 
         <td class="colcel" ><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" ><?php echo $row2['client']; ?></td>
            </tr>
            <?php } ?>
                              <?php 
              if(!empty($row2['mangasin']) and empty($row2['id_dis']) and empty($row2['client'])){

               ?>
               <tr style="text-align:center; background: white; font-size: 16px;" border='5'>

              <td  id="soustotal" colspan="3">TOTAL <?php echo $row2['mangasin']; ?> </td>




<td id="soustotal" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="soustotal" > </td>

<?php } ?>

    <?php 
              if(empty($row2['mangasin']) and empty($row2['id_dis']) and empty($row2['client'])){

               ?>
          <tr style="text-align:center; background: white; font-size: 16px;" border='5'>  
      

<td id="total" colspan="3">TOTAL </td>



<td id="total"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total"> </td>
</tr>

<?php } ?>
            
       

</tr>
<?php } ?>
     </tbody>
   </table>  
  </div>
 </div>
</div>

<style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('pardestination')">imprimer</button></div>
</div>


<div class="container-fluid" id="parbl" style="display:none;">
              <center>
              <h1 class="hdeclaration text-white" >CONNAISSEMENT</h1>
              </center>

            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>   
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >BL</th>
                                <th  scope="col" >BANQUE</th>
                                <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >PRODUIT</th>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DESTINATION</th>
                               <th scope="col" class="hide-on-print">ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t), b.banque, b.id from dispatching as dis
                         
                        inner join client as cli on dis.id_client=cli.id 
                         
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                        inner join produit_deb as p  on dis.id_produit=p.id
                        left join banque as b on b.id=dis.id_banque_dis
                         
                      
                        where dis.id_navire=?  group by dis.n_bl, mang.mangasin, dis.id_dis with rollup ");
        $client->bindParam(1,$b);
        $client->execute();

        while($row2 = $client->fetch()){

            ?>
          
             <?php if(!empty($row2['mangasin']) and !empty($row2['n_bl']) and !empty($row2['id_dis'])){ ?>
                <tr id="<?php echo $row2['id_dis'] ?>"  style="text-align:center; background: white; font-size: 14px;" border='5'>
             <td class="colcel" id="<?php echo $row2['id_dis'].'bl_disvrac' ?>" ><?php echo $row2['n_bl']; ?></td>
             <td class="colcel" id="<?php echo $row2['id_dis'].'banque_disvrac' ?>" ><?php echo $row2['banque']; ?></td> 
             <td class="colcel" id="<?php echo $row2['id_dis'].'cli_disvrac' ?>" ><?php echo $row2['client']; ?></td>
             <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_client_disvrac' ?>" ><?php  echo $row2['id_client']; ?></span>


<td class="colcel" id="<?php echo $row2['id_dis'].'prod_disvrac' ?>" ><?php echo $row2['produit']; ?> <br><?php echo $row2['qualite']; ?> <br><?php echo $row2['poids_kg']; ?> kgs</td>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_prod_disvrac' ?>" ><?php echo $row2['id_produit']; ?> </span>
        
         <td class="colcel" id="<?php echo $row2['id_dis'].'poids_disvrac' ?>" ><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" id="<?php echo $row2['id_dis'].'mg_disvrac' ?>" ><?php echo $row2['mangasin']; ?></td>
               <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_mg_disvrac' ?>" ><?php echo $row2['id_mangasin']; ?></span>
              <td class="colcel"  style="display: none;"><?php echo $row2['id_navire'] ?></td>
               <td class="colcel" data-target="affreteur_dis" style="display: none;"><?php echo $row2['affreteur'] ?></td>
                <td class="colcel" data-target="banque_dis" style="display: none;"><?php echo $row2['banque'] ?></td>
            
            <td class="colcel" >
               <div style="display: flex; justify-content: center;"> 
              <a name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row2['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"  name="modifys"  data-role="update_disvrac" data-id="<?php echo $row2['id_dis']; ?>"    style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit  " ></i></a>
     <a class="fabtn1" href="insertion_fichier_mangasin.php?id=<?php echo $row2['id_dis'] ?>" style="float:right;" target="blank" name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
   </div>
    </td>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'conditionnementvrac' ?>"><?php echo $row2['poids_kg']; ?></span>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'id_clientvrac' ?>"><?php echo $row2['poids_kg']; ?></span>
     <span style="display: none;" id="<?php echo $row2['id_dis'].'id_navirevrac' ?>"><?php echo $row2['id_navire']; ?></span>
    
  </tr>
    <?php } ?>
                       <?php 
              if(empty($row2['mangasin']) and empty($row2['id_dis']) and !empty($row2['n_bl'])){
                  
               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td id="soustotal" colspan="4">TOTAL <?php echo $row2['n_bl']; ?> </td>


<td  id="soustotal"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td colspan="2" id="soustotal" > </td>
</tr>
<?php } ?>
                      



    <?php 
              if(empty($row2['mangasin']) and empty($row2['n_bl']) and empty($row2['id_dis'])){

               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td style="background-color:#1B2B65; color: red; border: none;">  </td>

<td id="total" colspan="3" >TOTAL </td>



<td id="total" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total" > </td>
<td  id="total" class="hide-on-print"> </td>


</tr>
<?php } ?>
            
       


<?php } ?>
     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('parbl')">imprimer</button></div>
 </div>


<div class="container-fluid" id="partransit" style="display:none;">

              <center>
              <h1 class="hdeclaration text-white" >GESTION DU TRANSIT</h1>
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
  <?php 

  $manifest = $bdd->prepare("select tr.n_manifeste, dis.* from dispatching as dis
    inner join transit as tr on dis.id_dis=tr.id_bl
    where dis.id_navire=?  ");
        $manifest->bindParam(1,$b);
       
        
        $manifest->execute();
        $manif=$manifest->fetch();
        if($manif){?>
          <h3>NUMERO MANIFESTE: <span style="color: red;"><?php echo $manif['n_manifeste'] ?></span></h3>


       <?php } ?> 
            
 <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 12px; " border='5' >
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>
                                <th  scope="col" >POIDS MANIFESTE</th>
                                 <th    scope="col" >STATUT DOUANIER</th>
                                <th   scope="col" >DESTINATION DOUANIERE</th>
                               
                                <th  scope="col" >N° DEC / TRANSFERT</th>
                               <th  scope="col" >POIDS DECLARES</th>
                                 
                                 <th  scope="col" >DESTINATION</th>
                               <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >ACTIONS</th>
                               
                           
                               
                               
 
                                
                                


                                
                             </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php 
    


                                 
                        $client = $bdd->prepare("SELECT tr.*, p.*, cli.*, mang.*,   dis.*  from transit as tr
                        inner join dispatching as dis on dis.id_dis=tr.id_bl 
                        inner join produit_deb as p on dis.id_produit=p.id
                        inner join client as cli on dis.id_client=cli.id
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                       
                        
                        
                        where tr.id_trans_navire=?   order by dis.n_bl ");
        $client->bindParam(1,$b);
        $client->execute();

        

         $somme = $bdd->prepare("SELECT tr.*,dis.*, sum(dis.poids_t), sum(tr.poids_declarer)  from dispatching as dis
                        inner join transit as tr on dis.id_navire=tr.id_trans_navire and dis.id_dis=tr.id_bl 

                        where dis.id_navire=?  ");
        $somme->bindParam(1,$b);
       
        
        $somme->execute();

        $client2 = $bdd->prepare("SELECT tr.id_trans, p.id, cli.id, mang.id, dis.id_navire, dis.id_dis, dis.n_bl, sum(tr.poids_declarer), dis.poids_t from dispatching as dis inner join transit as tr on dis.id_dis=tr.id_bl inner join produit_deb as p on dis.id_produit=p.id inner join client as cli on dis.id_client=cli.id inner join mangasin as mang on dis.id_mangasin=mang.id where dis.id_navire=? group by dis.id_dis  ");
        $client2->bindParam(1,$b);
        $client2->execute();

        while($row2 = $client->fetch()){
           
          
      //$reste=$row2['poids_t']-$cal['sum(tr.poids_declarer)'];
            ?>
            <tr style="text-align:center; font-size:12px; background: white; " border='5' id=<?php echo $row2['id_trans'] ?>>
            
             <td id="<?php echo $row2['id_trans'].'bl_transitvrac' ?>" class="colcel"><?php echo $row2['n_bl']; ?></td> 
              <span style="display:none;" id="<?php echo $row2['id_trans'].'id_bl_transitvrac' ?>" class="colcel"><?php echo $row2['id_dis']; ?></span>
        <td id="<?php echo $row2['id_trans'].'produit_transitvrac' ?>" class="colcel"><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['poids_kg'] ?> KGS</td>
        <span style="display:none;" id="<?php echo $row2['id_trans'].'id_produit_transitvrac' ?>" class="colcel"><?php echo $row2['id_produit']; ?></span>
         <span style="display:none;" id="<?php echo $row2['id_trans'].'navire_transvrac' ?>" class="colcel"><?php echo $row2['id_navire']; ?></span>
        <td class="colcel" style="color: red;"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
             <td class="colcel" id="<?php echo $row2['id_trans'].'statut_douanierevrac' ?>"  ><?php echo $row2['statut_douaniere']; ?> </td>

<td class="colcel" id="<?php echo $row2['id_trans'].'destination_douanierevrac' ?>"><?php echo $row2['destination_douaniere']; ?> </td>
               
            
                   
              <td class="colcel"  id="<?php echo $row2['id_trans'].'numero_declarationvrac' ?>" ><?php echo $row2['numero_declaration']; ?></td>
              <td id="<?php echo $row2['id_trans'].'poids_declarervrac' ?>" class="colcel"><?php echo number_format($row2['poids_declarer'], 3,',',' '); ?></td>
             
              <td  class="colcel"><?php echo $row2['mangasin']; ?></td>
              <td  class="colcel"><?php echo $row2['client']; ?></td>
              
        <td class="colcel" >
          <div style="display: flex; justify-content: center;">
          <a  id="<?php echo $row2['id_dis'] ?>" name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteTransit(<?php echo $row2['id_trans'] ?>)" style="display: flex; justify-content: center; color:rgb(0,141,202);  display: flex; justify-content: center;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"   href="#" data-role="update_transitvrac" data-id="<?php echo  $row2['id_trans']; ?>"   id="btnbtn" style="border: none;  color:rgb(0,141,202); display: flex; justify-content: center;"> <i class="fa fa-edit" ></i></a>
     <a class="fabtn1" href="insertion_fichier_transit.php?id=<?php echo $row2['id_trans'] ?>" style="display: flex; justify-content: center; " target="blank"  name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
    </td>    
                             

</tr>

<?php } ?>
<tr>
  <td colspan="10" style="text-align: center;">RESTE A DECLARER</td>
  </tr>
  <tr>
  <td colspan="5" style="text-align: center;">NUMERO BL</td>
  <td colspan="5" style="text-align: center;">RESTE A DECLARER</td>
</tr>
<?php while ($rest=$client2->fetch()) { 
$restant=$rest['poids_t']-$rest['sum(tr.poids_declarer)']; ?>
<tr>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo $rest['n_bl']; ?></td>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo  number_format($restant, 3,',',' '); ?></td>
</tr>
<?php } ?>



<?php while($total=$somme->fetch()){ 
  $restant=$total['sum(dis.poids_t)']-$total['sum(tr.poids_declarer)']  ?>

 <tr style="text-align:center; font-size: 12px;" border='5'>
  <td style=" font-size: 12px;" id="total" colspan="2"> TOTAL </td>
  <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(dis.poids_t)'], 3,',',' '); ?> </td> 
  <td style=" font-size: 12px;" id="total" colspan="2">  </td> 
 <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(tr.poids_declarer)'], 3,',',' '); ?> </td>
  <td style=" font-size: 12px;" id="total"><?php echo  number_format($restant, 3,',',' '); ?> </td>
  <td style=" font-size: 12px;" id="total" colspan="2">  </td>
  <td style=" font-size: 12px;" id="total" >  </td>

</tr>
<?php } ?>

     </tbody>
   </table>  
  </div>
 
 <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('partransit')">imprimer</button></div>
</div>


      
<?php  

}




 

 $formulaire = $bdd->prepare("SELECT n_bl from dispatching where id_navire=? ");
         $formulaire->bindParam(1,$b);
        $formulaire->execute();
  if($form=$formulaire->fetch()){ ?>

    <div class="modal fade" id="modif_transit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">


      
    
  
      ?>

<center>

   <div class="mb-3">

       <center>

        <label>NUMERO BL</label><br>

    <select id="n_bl_transit" style="width: 50%;">
      <?php $bl = $bdd->prepare("SELECT id_dis, n_bl from dispatching where id_navire=? order by n_bl ASC ");
         $bl->bindParam(1,$b);
        $bl->execute(); 
        while($bl2=$bl->fetch()){ ?>
      
        <option value="<?php echo $bl2['id_dis']; ?>" ><?php echo $bl2['n_bl']; ?></option> 
         <?php } ?>
   
</select>

    </center><br>
    
     <label>NUMERO DECLARATION</label>  
  <input type="text" class="form-control"  id="num_dec"  name="conditionnement"  > <br>
  <label>POIDS DECLARER</label>
  <input type="text" class="form-control"  id="poids_dec" name="nombre_sac" ><br>

    <label>STATUT DOUANIERE</label><br> 
    <select id="statut" style="width: 50%;">
      
        <option value="AES" >AES</option> 
        <option value="AMEF">AMEF</option>
        <option value="AUTRES">AUTRES</option>
   
</select>

    </center><br>
    <center>

        <label>DESTINATION DOUANIERE</label><br> 
    <select id="des_douane" style="width: 50%;">
      
        <option value="DECLARATION" >DECLARATION</option> 
        <option value="TRANSFERT">TRANSFERT</option>
        <option value="APE">APE</option>
        <option value="AUTRES">AUTRES</option>
   
</select>

    </center><br>



   
  
   
    <input style="display: none;" type="text" class="form-control"  id="navire_transit" name="nav" >

     <input style="display: none" type="text" class="form-control"  id="id_trans" name="dec"  ><br>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" data-role="save_transit"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
</form> 
        
      <div class="modal-footer">
        </div>
 
         </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modif_transitv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">


      
    
  
      ?>

<center>

   <div class="mb-3">

      <center>
        <label>NUMERO BL</label><br>

    <select id="n_bl_transitvrac" style="width: 50%;">
      <?php $bl = $bdd->prepare("SELECT id_dis, n_bl from dispatching where id_navire=? order by n_bl ASC ");
         $bl->bindParam(1,$b);
        $bl->execute(); 
        while($bl2=$bl->fetch()){ ?>
      
        <option value="<?php echo $bl2['id_dis']; ?>" ><?php echo $bl2['n_bl']; ?></option> 
         <?php } ?>
   
</select>

    </center><br>
    
     <label>NUMERO DECLARATION</label>  
  <input type="text" class="form-control"  id="num_decv"  name="conditionnement"  > <br>
  <label>POIDS DECLARER</label>
  <input type="text" class="form-control"  id="poids_decv" name="nombre_sac" ><br>

    <label>STATUT DOUANIERE</label><br> 
    <select id="statutv" style="width: 50%;">
      
        <option value="AES" >AES</option> 
        <option value="AMEF">AMEF</option>
        <option value="AUTRES">AUTRES</option>
   
</select>

    </center><br>
    <center>

        <label>DESTINATION DOUANIERE</label><br> 
    <select id="des_douanev" style="width: 50%;">
      
        <option value="DECLARATION" >DECLARATION</option> 
        <option value="TRANSFERT">TRANSFERT</option>
        <option value="APE">APE</option>
        <option value="AUTRES">AUTRES</option>
   
</select>

    </center><br>



   
  
   
    <input style="display: none;" type="text" class="form-control"  id="navire_transitv" name="nav" >

     <input style="display: none" type="text" class="form-control"  id="id_transv" name="decv"  ><br>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" data-role="save_transitvrac"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
</form> 
        
      <div class="modal-footer">
        </div>
 
         </div>
      </div>
    </div>
  </div>
</div>




<?php  
  }

//}

 ?>

<script type="text/javascript">
  function cache_cel(){
  var type=$('#type_nav').val();
  if(type=='VRAQUIER'){
    $('#poids_dis').css('display','none');
  }
}
cache_cel();
</script>


          





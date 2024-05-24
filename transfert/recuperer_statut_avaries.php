<?php 
require('../database.php');
require('controller/afficher_les_debarquements.php');
require('controller/afficher_les_filtres.php');


$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$transfert_sain=$_POST['transfert_sain'];
$statut=$_POST['statut'];
$client=$_POST['client'];
$date_filtre='';
$cale_filtre='';

echo $produit;
echo $poids_sac;
echo $navire;
echo $destination;
echo $client;


$transfert_des_avaries=$_POST['transfert_des_avaries'];
$avaries_de_deb=$_POST['avaries_de_deb'];
if($transfert_sain==1){
	//$statut= $_POST['statut'];
}

    $type_de_navire=type_de_navire($bdd,$navire);

    $type_navire_deb=$type_de_navire->fetch();

 /*   if($type_navire_deb['type']=='VRAQUIER'){
     
    } */


$resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);



        $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client);



 ?>

 <?php /*$bouton=$bdd->prepare("SELECT nav.type, dis.id_navire from dispatching as dis inner join navire_deb as nav on nav.id=dis.id_navire where dis.id_navire=? ");
      $bouton->bindParam(1,$navire);
      $bouton->execute();
      $btn=$bouton->fetch(); */
      $bouton=$bdd->prepare("SELECT nav.type, dis.id_con_dis, nc.id_navire,d.* from dispats as dis
         left join declaration as d on d.id_declaration=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
       
   inner join navire_deb as nav on nav.id=nc.id_navire
    where nc.id_navire=? ");
      $bouton->bindParam(1,$navire);
      $bouton->execute();
      $btn=$bouton->fetch();

       ?>

 <br><br>
<div class="container-fluid LesOperations" style="background: white; ">
  <div class="row">
   
      <center>
      <div class="col col-sm-12 col-md-12 col-lg-12">
         <span class="lien_debut"> 
        <button class="dropdown-toggle" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; width: 20%; font-size:16px;  background: white; align-items: center;  "  class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >TRANSFERT</button>
         <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
          <center>
          <li>
          <button  style="display: flex; justify-content: center; color: white; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " id="btnSain"  data-role="VisibleSain">SAINS</button>
        </li>
                <?php if($btn['type']=="SACHERIE"){ ?>
          <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  class="btn " id="btnMouille" data-role="VisibleMouille"    >MOUILLES</button></li>
           <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnFlasque" data-role="VisibleFlasque">FLASQUES</button></li>
            <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnBalayure" onclick="visibleRecepBalayure()">BALAYURES</button></li>
         
            </center>
          </ul>
       <!--    <button style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white; width:  "  class="btn " id="btnAvariesRep" onclick="visibleAvariesRep()">AVARIES DE DEBARQUEMENT</button> !-->
            <?php } ?>
      <div style="display: none;">
        <input type="" name="" id="input_navire" value="<?php echo $navire; ?>">
        <input type="" name="" id="input_produit" value="<?php echo $produit; ?>">
        <input type="" name="" id="input_destination" value="<?php echo $destination; ?>">
        <input type="" name="" id="input_poids_sac" value="<?php echo $poids_sac; ?>">
        <input type="" name="" id="input_client" value="<?php echo $client; ?>">
        <input type="" name="" id="input_dates" value=""> 
      </div>
         


       
    
      </span>
      </div>
        </center>
    <?php //} ?>

   
    

    <?php //} ?>
  </div>
</div>

<br><br>
 <div class="container-fluid bg-white" id="TableSain" <?php if($transfert_sain==0){ ?> style="display: none; <?php } ?> width: 100%;">

<input type="text" name="" id="input_statut" value="<?php echo $statut ?>" style='display: none;'>

  <br>    



<div class="row">

 <?php include('recap_debarquement.php'); ?> 
<?php include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('entete_tableau.php'); ?>

    <tbody id='tbody_transfert_deb'>
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
      affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);
    //}   ?> 
    </tbody>       

            

</table>
<?php include('pied_tableau.php'); ?>
</div>


</div>
</div>


<?php   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type,nc.*, dis.id_dis   FROM dispat as dis 
                
                 
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                 

                   WHERE nc.id_navire=?  ");
        $filtreavaries->bindParam(1,$navire);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
     //  if($cherche['type']=="SACHERIE"){  ?>

           

  
<div id="tr_avariess">
<div class="container-fluid" id="TableAvariesTrans" <?php if($transfert_des_avaries==0){ ?> style="display: none"; <?php } ?>>

  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
        
        </div>


<br>


        <div class="col-md-12 col-lg-12">      
<button id="insertion_transfert" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>



</span>
    </div>

 <div id="tableau_transfert" class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead >
    <td  colspan="15" class="titreTRANSAV" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >TRANSFERT DES AVARIES DE DEBARQUEMENT</td>   

   
  
    
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >
      
      
      
       <td scope="col"  rowspan="3"  style="vertical-align: middle;">DATES</td>
              <td scope="col"  rowspan="3" style="vertical-align: middle;" >HEURE</td>
                     <td scope="col"  rowspan="3" style="vertical-align: middle;" >CALE</td>
                      <td scope="col"  rowspan="3" style="vertical-align: middle;" >BL</td>
               <td scope="col" rowspan="3" style="vertical-align: middle;" >CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="vertical-align: middle;">CHAUFFEUR</td>
               <td scope="col"  rowspan="3" style="vertical-align: middle;" >TRANSPORTEUR</td>
               <td scope="col"  rowspan="3"style="vertical-align: middle;" >N°DEC / TRANSFERT</td>            
      <td scope="col" colspan="2" >FLASQUES</td>
      <td scope="col" colspan="2" >MOUILLES</td>
      <td scope="col" colspan="2" >TOTAL AVARIES</td>
      <td scope="col" rowspan="2"  >ACTIONS</td>
      
     
  </tr>
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
      
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>

<?php affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>


</tbody>
             

  
</table> 
</div> 
<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
    #btnSain, #btnAvariesRep, #btnAvariesDeb, #tabledec1, #tabledec2, .menu, #sidebar, .operation, .container-fluid1, .sidebar, .topbar, .entete_image, #insertion_transfert, .bars, .cacher_cellule, .great , .LesOperations, #sit, .loader,.loader-overla,br {
    display: none !important;
  }


   .footer{
    display: none;
   }
  }
</style>

<a  style="margin:auto-right; width: 20%;" class="btn btn-primary hide-on-print" data-role="imprimer_tableau_transfert">imprimer</a>

<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('tableau_transfert')">imprimer</button>

</div>


</div>




<div class="container-fluid" id="avaries_debarquement" <?php if($avaries_de_deb==0){ ?> style="display: none;" <?php } ?> >

   <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
    
  
  </div>



  <div class="col-md-12 col-lg-12">      
<button id="insertion_avaries" style="background: orange;" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#Les_avaries2" >Insertion </button>

</div>
<br>  

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
    <tbody>

    <?php affichage_avaries_deb($bdd,$produit,$poids_sac,$navire); ?>
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
<a  style="margin:auto-right; width: 20%;" class="btn btn-primary hide-on-print" data-role="imprimer_tableau_avaries">imprimer</a>
<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('tableau_avaries')">imprimer</button>

</div>




<?php  // } ?>




<?php 
     if($type_navire_deb['type']=='SACHERIE'){
      function element_du_formulaires($bdd,$produit,$poids_sac,$navire,$destination){
   $element_forms= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*,nc.*,d.*   FROM dispats as dis 
                 left join declaration as d on d.id_declaration=dis.id_dis
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                inner join  produit_deb as p on nc.id_produit=p.id 

                inner join navire_deb as nav on nc.id_navire=nav.id 
                
                inner join client as cli on nc.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE nc.id_produit=? and  nc.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  ");
        $element_forms->bindParam(1,$produit);
        $element_forms->bindParam(2,$poids_sac);
        $element_forms->bindParam(3,$navire);
        $element_forms->bindParam(4,$destination);
        $element_forms->execute();
        return $element_forms;
}
 $element_forms=element_du_formulaires($bdd,$produit,$poids_sac,$navire,$destination);
     }

   if($type_navire_deb['type']=='VRAQUIER'){
      function element_du_formulaires($bdd,$produit,$poids_sac,$navire,$destination,$client){
   $element_forms= $bdd->prepare("SELECT  dis.*,mang.mangasin, p.produit,p.qualite,nc.*,nav.type,cli.client, nav.id as nav_id, d.* FROM dispats as dis
               LEFT join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join navire_deb as nav on nav.id=nc.id_navire
                inner join produit_deb as p on dis.id_produits=p.id
                inner join client as cli on cli.id=nc.id_client
                inner join mangasin as mang on mang.id=dis.id_mangasin
                 

                   WHERE dis.id_produits=? and  dis.poids_kgs=? and nc.id_navire=? and dis.id_mangasin=? and nc.id_client=? ");
        $element_forms->bindParam(1,$produit);
        $element_forms->bindParam(2,$poids_sac);
        $element_forms->bindParam(3,$navire);
        $element_forms->bindParam(4,$destination);
        $element_forms->bindParam(5,$client);
        $element_forms->execute();
        return $element_forms;
}
 $element_forms=element_du_formulaires($bdd,$produit,$poids_sac,$navire,$destination,$client);
     }



while($rown=$element_forms->fetch()){

  ?>
  <div class="modal fade" id="form_camion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU CAMION</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_camion"> </div>
        <form> 
          <?php $transporteur=$bdd->query('SELECT * from transporteur'); ?>
        <div>
        <input id="new_camion" style="float: left;" type="text" name="" placeholder="NUMERO DE CAMIONS" required/>
        <select style="float: right;" id="transporteur_add" required> 
          <option value="">Choisir un transporteur</option>
          <?php while($tp=$transporteur->fetch()){ ?>
            <option value="<?php echo $tp['id']; ?>" > <?php echo $tp['nom'] ?> </option>
          <?php } ?>
         </select> <br> 
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_camion" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>



   <div class="modal fade" id="form_remorque" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEL REMORQUE</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_remorque"> </div>
        <form> 
          <?php $transporteur=$bdd->query('SELECT * from transporteur'); ?>
        <div>
        <input id="new_remorque" style="float: left;" type="text" name="" placeholder="NUMERO DE CAMIONS" required/>
        <select style="float: right;" id="transporteur_add_remorque" required> 
          <option value="">Choisir un transporteur</option>
          <?php while($tp=$transporteur->fetch()){ ?>
            <option value="<?php echo $tp['id']; ?>" > <?php echo $tp['nom'] ?> </option>
          <?php } ?>
         </select> <br> 
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_remorque" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>
 

 <div class="modal fade" id="form_transporteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU TRANSPORTEUR</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_transporteur"> </div>
        <form> 
          
        <div>
          <center>
        <input id="new_transporteur" type="text" name="" placeholder="transporteur" required/>
        </center>
        
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_transporteur" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>


<div class="modal fade" id="form_chauffeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU CHAUFFEUR</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_chauffeur"> </div>
        <form> 
          
        <div>
          <center>
        <input id="new_nom_chauffeur" type="text" name="" placeholder="nom du chauffeur" required/><br><br>
         <input id="new_permis" type="text" name="" placeholder="permis" required/><br><br>
          <input id="new_telephone" type="text" name="" placeholder="new_telephone" required/>
        </center>
        
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_chauffeur" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>  
        

<div class="modal fade" id="enregistrement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-fullscreen" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">Enregistrement</h6></center>
        <center>
              <img class="logo_register" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      
      <div class="modal-body"  >
              
        <form method="POST" >

   <div class="mb-3">
     <div id="info_bl">
      <span id='num_du_bl'></span>
     </div>
     <label>BL</label>
      <input class="inputform" type="text"  style=" margin-bottom: 20px; margin-top: 5px;" name="numero_bl"  id="blsain" placeholder="numero bl" >


      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="naviresain" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control"  placeholder="type"  name="type" hidden="true"  id="typesain"  value=<?php  
        echo $rown['type'];
    ?> > 

</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="produit" name="produit"  id="produitsain" hidden="true"  <?php if($type_navire_deb['type']=='VRAQUIER'){ ?>  value=<?php 
        echo $rown['id_produits']; } ?> <?php if($type_navire_deb['type']=='SACHERIE'){ ?>  value=<?php 
        echo $rown['id_produit']; } ?>
     >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="id_dis" name="id_di"  id="id_dissain" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="produit" name="poids"  id="poids_sacssain" hidden="true" <?php  if($type_navire_deb['type']=='SACHERIE'){ ?>  value="<?php 
        echo $rown['poids_kg']; } ?>" 
        <?php   if($type_navire_deb['type']=='VRAQUIER'){ ?>  value=<?php 
        echo $rown['poids_kgs']; } ?> 
     >
</div>

   <div class="mb-3">
    
      <label  for="exampleFormControlInput1" class="form-label">date</label>
      <label style="float: right;" for="exampleFormControlInput1" class="form-label">heure</label>
      <br>
  <input type="date" class="inputselect"    name="date" id="datesain">

  
      
  <input type="time" class="inputselect"   name="heure" id="heuresain" style="float: right;">
</div>

   <div class="mb-3">
    <select class="inputselect" name="declaration"  style="height: 30px;" id="declarationsain">
    <option value="" > choisir une declaration <?php  echo $poids_sac; ?></option>
    <?php
        if($type_navire_deb['type']=='SACHERIE'){  $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
             } 
              if($type_navire_deb['type']=='VRAQUIER'){  $resdes=declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
             }  
     while($dec=$resdes->fetch()){ 
    /* $id_declaration=$dec['id_declaration'];
     $suivi_dec_select=suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration);
     $suivi=$suivi_dec_select->fetch();
     $restant=$suivi['poids']-$suivi['sum(td.poids)'];  */     ?> 
    <option value=<?php  echo $dec['id_declaration']; ?> ><?php  echo $dec['num_declaration']; ?> (restant=<span class="restant"><?php //echo $restant; ?></span>) </option>  
   <?php } ?>
    </select>

  <select class="inputselect"  name="cale" id="calesain" style="float: right;" required>
    <option value="">Cale</option>

    <?php

 //$rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
        if($type_navire_deb['type']=='SACHERIE'){
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     }

       if($type_navire_deb['type']=='VRAQUIER'){
    
           $rescale=cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
         }
     while($res=$rescale->fetch()){ ?>
           
      <option value=<?php echo $res['id_dec']; ?>><?php echo $res['cales']; ?></option>
    <?php  } ?>
  </select>

</div>

<div class="mb-3">
  <?php   $bon=bon($bdd,$produit,$poids_sac,$navire,$destination,$client); ?>
  <select class="inputselect" id='bon'  style="display:none;" required>
    <option>Choisir un bon</option>
    <?php while($bons=$bon->fetch()){ ?>
      <option value="<?php  echo $bons['id_bon'] ?>"><?php  echo $bons['num_bon'] ?></option>
    <?php   } ?>
    
  </select>
</div>

<div style="background: rgb(248,248,248);">
   <div class="mb-3">
      <center>  
    <h6 style="background: white; color: blue;">TRANSPORT</h6>
   
 
  </center> 
 
  <input style=""  class="inputtransporteurs1" type="text" id="myInput"  placeholder="SAISIR LE N° DU TRACTEUR"  onkeyup="filtreca();" autocomplete="off"> <a style="height: 10px; font-size:10px; border: none; text-align: center !important; width:10px;"  data-role='nouveau_camion' ><span style="justify-content:center; margin-left:1px; font-weight: bold; font-size:10px; text-align: center !important; border-radius: 50%; " class="btn btn-danger text-white  "> + </span></a>

  <input style=""  class="inputtransporteurs2" type="text" id="InputRemorque"  placeholder="SAISIR LE N° DE REMORQUE"  onkeyup="filtreRemorque();" autocomplete="off"> <a style="height: 10px; font-size:10px; border: none; text-align: center !important;"   data-role='nouveau_remorque' ><span  style="justify-content:center; font-weight: bold; font-size:10px; text-align: center !important; border-radius: 50%;  margin-left: 2px; " class="btn btn-danger text-white  "> + </span></a><br>
  <div  id="camionList" style="background: white; display: none; " >
  </div>
  <div   id="camionListRemorque" style="background: white; display: none; text-align: center;" >
  </div>

  






<input class="inputtransportform" type="text" id="myInputTransp" placeholder="transporteur" style=" border: none;" disabled="true"  ><!-- <a class="btn btn-danger" data-role='nouveau_transporteur' >  <span class="text-white bg-danger"> + </span></a> !-->


 

<br>  





<input type="" name="input2" id="val_input2" hidden='true'  >
<input type="" name="input2" id="val_input_remorque" hidden="true"  >
 <center> <br>  
  
<h6 style="color: blue;">CHAUFFEUR  </h6> 
</center> 
<input class="inputtransportform" type="text" id="myInputc"  placeholder="chauffeur" style="width: 80%;" onkeyup="filtreChau();" autocomplete="off"> <a data-role='nouveau_chauffeur' class="btn btn-danger"  ><span class="text-white bg-danger"> + </span></a>

<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" hidden='true'  >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>





<div class="mb-3">
    
   



</div>
   <div class="mb-3">
  <input type="text" class="form-control"  placeholder="" name="client"  id="clientsain" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="mangasinsain" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>


 <div class="mb-3">
 
  <input class="inputform" type="text"  id="destinatairesain" placeholder="destinataire" name="destinataire"  >
</div>
<?php 
}
 if($rown['des_douane']=="TRANSFERT"){  ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairesain" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true" >
</div>


<?php  

} ?>

  
<?php //if($rown['type']=="SACHERIE" and $rown['poids_kg']!=0){ ?>
  <div class="mb-3" id='sac_cacher' <?php if($type_navire_deb['type']=='SACHERIE'){ if($rown['poids_kg']==0 ){echo "style='display:none;'";} }  if($type_navire_deb['type']=='VRAQUIER'){ if($rown['poids_kgs']==0 ){echo "style='display:none;'";} } ?>>
      <label for="exampleFormControlInput1" class="form-label">nombre sac</label>
  <input style="width:50%;" class="inputform" type="number"   placeholder="0" name="sac" id="sacsain" required>
 
  
   <center>
   <a  data-role='detail_chargement' style="background:blue; color:white; display: block; width: 50%;  "  >detail du chargement </a>
 </center>
  </div>
           <center>
            
        <div class="mb-3" id='les_inputs_detail_chargement' style="display:none; background: blue; width: 50%; ">
          <span style="float:left; color:white !important; display:none;" id='reste_detail'>reste</span><br>
                    <label style="color: white !important;">Sac provenant du reconditionnement</label><br>
          <input type="number" name="" id='sac_reconditionne' oninput="verifier_sac_detail1()"><br><br>
          <label style="color: white !important;" >Sac provenant de la cale</label><br>
          <input type="number" name="" id='sac_cale' oninput="verifier_sac_detail1()"> <br><br>
          
          <h3>detail par cale</h3>
            <?php $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ ?> 
     <label><?php echo $res['cales']; ?></label>
     <input type="" name=""><br><br>
   <?php } ?>
         
        </div>

        
        
        
      </center> 

  <div class="mb-3"  id='poids_cacher'   >
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text"  id="poidssain" placeholder="poids" name="poids_s"  value="0" >
</div> 


<?php //} ?>

<input type="text" id='input_type_navire' value="<?php echo $rown['type'] ?>" style="display:none;">
<input type="number" id='input_poids_kg' <?php if($type_navire_deb['type']=='SACHERIE'){ ?> value="<?php echo $rown['poids_kg'] ?>" <?php } ?> <?php if($type_navire_deb['type']=='VRAQUIER'){ ?> value="<?php echo $rown['poids_kgs'] ?>" <?php } ?>  style="display:none;">

<input type="texte" id='input_des_douane' value="<?php echo $rown['des_douane'] ?>" style='display:none ;' >


<?php  //if($rown['type']=="VRAQUIER" and $rown['poids_kg']==0){ ?>
<!-- <div class="mb-3"  >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input class="inputform" type="text"  placeholder="0" value="0" name="sac" id="sacsain" >
</div>
<div class="mb-3" id='poids_cacher'>
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text" class="form-control" id="poidssain" placeholder="poids" name="poids_s" >

</div> !-->

<?php //} ?>
<?php  //if($rown['type']=="VRAQUIER" and $rown['poids_kg']!=0){ ?>

<!-- <div class="mb-3" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input class="inputform" type="text"  id="sacsain" placeholder="0"  name="sac"  >
</div>
<div class="mb-3" id='poids_cacher'>
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text"  id="poidssain" placeholder="poids" name="poids_s" >

</div> !-->

<?php //} ?>






   <div class="mb-3">


        

         <center>
        <a  class="btn btn-primary" style="text-align: center;" name="register" id="register" data-role="btn_register" >enregistrer</a></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>











<div class="modal fade" id="modif_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION SAIN</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input type="text" class="form-control"  id="date_m_rm"  name="conditionnement"  > <br>
  <label>HEURE</label>  
  <input type="time" class="form-control"  id="heure_m_rm"  name="conditionnement"  > <br>
    <label>BL</label>  
  <input type="text" class="form-control"  id="bl_m_rm"  name="conditionnement"  > <br>
  
      </center>

  <label id='poids_title'>POIDS</label> 
  <input type="text" class="form-control"  id="poids_m_rm"  name="conditionnement"  > <br>
  <input type="text" class="form-control"  id="id_m_rm" hidden="true"  name="conditionnement"  >
   <input type="text" class="form-control"  id="type_m_rm" hidden="true"  name="conditionnement" value="<?php echo $rown['type']; ?>"  >
   <input type="text"  id="statut_m_rm"  hidden="true">
<label>DECLARATION</label>

<?php
       $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
 
 ?>
   <select id="declaration_m_rm">
    <?php  if($type_navire_deb['type']=='SACHERIE'){  $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
             } 
              if($type_navire_deb['type']=='VRAQUIER'){  $resdes=declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
             }  
     while($dec=$resdes->fetch()){ 
    /* $id_declaration=$dec['id_declaration'];
     $suivi_dec_select=suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration);
     $suivi=$suivi_dec_select->fetch();
     $restant=$suivi['poids']-$suivi['sum(td.poids)'];  */     ?> 
    <option value=<?php  echo $dec['id_declaration']; ?> ><?php  echo $dec['num_declaration']; ?> (restant=<span class="restant"><?php //echo $restant; ?></span>) </option>  
   <?php } ?>
  
  </select><br> <br>
  <label>CALE</label>
   <select id="cale_m_rm">
    <?php
    if($type_navire_deb['type']=='SACHERIE'){
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     }

       if($type_navire_deb['type']=='VRAQUIER'){
    
           $rescale=cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
         }
     while($res=$rescale->fetch()){ ?>
           
      <option value=<?php echo $res['id_dec']; ?>><?php echo $res['cales']; ?></option>
    <?php  } ?>
     
   
  </select> <br><br>


  <div class="mb-3" id="div_destinataire" style="display: none;">
<label>DESTINATAIRE</label><br>
<input type="text"  id="destinataire_m_rm"  ><br>
</div>

<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <label style="color: white;">CAMIONS  </label><br> 
  </center> 
  

   
<input type="text" id="myInput_m_rm"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca_m_rm();" ><br><br>

<label style="color: white;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp_m_rm" placeholder="transporteur" style="width: 50%; " disabled="true" >


<div id="camionList_m_rm" style="background: white; display: none; " >
  </div>
 



<input type="" name="input2" id="val_input2_m_rm"   hidden="true"  >

 <center> <br>  
<label style="color: white;">CHAUFFEUR  </label> 
</center> 
 
<input type="text" id="myInputc_m_rm"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau_m_rm();"  >

<div id="camionListc_m_rm" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c_m_rm" hidden="true">
<input type=""  id="dis_bl_m_rm" hidden="true" >
<input type=""  id="poids_sac_m_rm" hidden="true" >

<input type="" name="input2c" id="id_produit_m_rm" hidden="true">
<input type=""  id="id_destination_m_rm" hidden="true" >
<input type=""  id="id_client_m_rm" hidden="true" >
<input type=""  id="id_navire_m_rm" hidden="true" ><br>


  
  </div>

  
</div>
<input type="number" name="" id='id_detail_m_rm' style="display:none;" > 

<label id='sac_title'>SAC</label>  
  <input type="text" class="form-control"  id="sac_m_rm"  name="conditionnement"  > <br>  


  
 
  
          <center>
            <a  data-role='detail_chargement2' style="background:blue; color:white; ">detail du chargement </a><br><br>
        <div class="mb-3" id='les_inputs_detail_chargement_m_rm' style="display: none; background: blue; width: 50%;">
          <span style="float:left; color:white !important; display:none;" id='reste_detail_m_rm'>reste</span><br>
          <label style="color: white !important;" >Sac provenant de la cale</label><br>
          <input type="number" name="" id='sac_cale_m_rm' oninput="verifier_sac_detail2()"> <br><br>
          <label style="color: white !important;">Sac provenant du reconditionnement</label><br>
          <input type="number" name="" id='sac_reconditionne_m_rm' oninput="verifier_sac_detail2()">

         
        </div>
 </div><br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a data-role="mod" id='btn_modif_register'  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>






<div class="modal fade" id="form_poids_pont" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Pont Bascule</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
         


   <div class="mb-3">
           <label>BL</label>
        <input type="number" class="form-control"   name="sacm"  id="bl_pont"  value="0" 
    disabled="true" > <br>
       <label>NBRE DE SAC</label>
        <input type="number" class="form-control"   name="sacm"  id="nbre_sac_pont"   value="0" 
     disabled="true"> <br> 

    <label>TICKET PONT</label>
    <input type="number" class="form-control"   name="sacf"  id="ticket_pont"  value="0"
     >
     <br> 
     <label>POIDS BRUT VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="poids_pont"  value="0"
     oninput='calcul_poids_pont()'> <br> </div>
<div style="">
          <label>TARE VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="tare_vehicule"  value="0"
     oninput='calcul_poids_pont()' > <br> 

     

        <label>NET PONT BASCULE</label>
    <input type="text" class="form-control"   name="sacm"  id="net_pont"  value="0"
     disabled="true" style="background: black; color: white;"> <br>


     <?php  $select_tare=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
     $select_tare->bindParam(1,$produit);
     $select_tare->bindParam(2,$poids_sac);
     $select_tare->bindParam(3,$navire);
     $select_tare->bindParam(4,$destination);
     $select_tare->bindParam(5,$client);
     $select_tare->execute();
     $sel_tare=$select_tare->fetch();
      ?>

          <label>TARE SAC</label>
    <input type="number" class="form-control"   name="sacm"  id="val_tare_sac" disabled="true"  value="<?php  echo $sel_tare['poids_tare_sac']; ?>"
    style="background: black; color: white;" > <br> 

         <label>NET MARCHAND</label>
    <input type="number" class="form-control"   name="sacm"  id="net_marchand"  value="0"
     disabled="true" style="background: black; color: white;"> <br>
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_pont'>
<input type="text" name="" id='poids_sac_pont'>
<input type="text" name="" id='navire_pont'>
<input type="text" name="" id='destination_pont'>
<input type="text" name="" id='client_pont'>
   <input type="text" name="" id='id_pont'> </div>
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="ajouter_poids_pont" >enregistrer</a></center>
        </div>
    

    
</form> 
</div>
       
      <div class="modal-footer">
 
        
      </div>
    
  </div>
</div>
</div>


<div class="modal fade" id="form_tare_sac" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries Tare Sac</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
         


   <div class="mb-3">
       

    <label>TARE SAC</label>
    <input type="number" class="form-control"   name="sacf"  id="tare_sac"  value="0"
     >


   
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_tare' value="<?php echo $produit; ?>"  >
<input type="text" name="" id='poids_sac_tare' value="<?php echo $poids_sac; ?>" >
<input type="text" name="" id='navire_tare' value="<?php echo $navire; ?>" >
<input type="text" name="" id='destination_tare' value="<?php echo $destination; ?>" >
<input type="text" name="" id='client_tare' value="<?php echo $client; ?>" >
    </div>
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="ajouter_tare" >enregistrer</a></center>
        </div>
    

    
</form> 
</div>
       
      <div class="modal-footer">
 
        
      </div>
    
  </div>
</div>
</div>


 

 <div class="modal fade" id="enregistrement_transfert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202);">
      <div class="modal-header bg-primary">
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
        <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">Connectez vous</h3></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
              
        <form method="POST">

   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="naviretrav"  value="<?php  
        echo $rown['id_navire']; 
    ?>" hidden="true" > 
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="produit" name="produit"  id="produittrav" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="id_dis" name="id_di"  id="id_distrav" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="produit" name="poids"  id="poids_sactrav" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control"   name="date" id="datetrav">
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">heure</label>
  <input type="time" class="form-control"  name="heure" id="heuretrav">
</div>

   <div class="mb-3">
    <select name="declaration"  style="height: 30px;" id="declarationtrav">
    <option selected > choisir une declaration</option>
     <?php    $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
     while($dec=$resdes->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans_extends']; ?> ><?php  echo $dec['num_declaration']; ?> </option>  
   <?php } ?>
    </select>
</div>



   <div class="mb-3">
   <select class="inputselect"  name="cale" id="caletrav" style="float: right;" >
    <option value="">Cale</option>

    <?php

 $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> <?php echo $rownn['id_dec']; ?></option>
    <?php } ?>
    
  </select>

</div>
<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <h6 style="color: white;">CAMIONS  </h6>
  </center> 
<input type="search" id="myInput3"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca3();">
<i class="fas fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
<input type="text" id="myInputTransp3" placeholder="transporteur" style="width: 50%; float: right; color: white !important;" disabled="true"  >

<div id="camionList3" style="background: white; display: none; " >
  </div>
 

<br><br>   





<input type="" name="input3" id="val_input3" hidden="true"  >
 <center> <br>  
<h6 style="color: white;">CHAUFFEUR  </h6> 
</center> 
<input type="text" id="myInputc3"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau3();" >

<div id="camionListc3" style="background: white; display: none;" >
  

</div>
<input type="" name="input3c" id="val_input3c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>

 



   <div class="mb-3">

    <input  style=" margin-bottom: 20px;margin-top: 20px;" name="numero_bl" id="bltrav" placeholder="numero bl" >
   

</div>
   <div class="mb-3">
  <input type="text" class="form-control"  placeholder="" name="client"  id="clienttrav" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="mangasintrav" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="autre_destinatairetrav" placeholder="destination" name="autre_destination" >
</div>

 <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairetrav" placeholder="destinataire" name="destinataire" >
</div>
<?php 
}
else { ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairetrav" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true">
</div>

  <div class="mb-3">
 
  <input type="text" class="form-control" id="autre_destinatairetrav" placeholder="destinataire" name="autre_destination" value="AUCUNE" hidden="true" >
</div>
<?php  

} ?>

   <div class="mb-3">
      
  <input type="number" class="form-control" id="sacftrav" placeholder="nbre sacs flasques" name="sac_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="poidsftrav" placeholder="poids flasques" name="poids_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="sacmtrav" placeholder="nbre sacs mouille" name="sac_mouille" >
</div>

  <div class="mb-3">
      
  <input type="number" class="form-control" id="poidsmtrav" placeholder="poids mouille" name="poids_mouille" hidden='true' >
</div>
   
     


  
   <div class="mb-3">

 
        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_tr_avaries"  data-role="btn_transfert_avaries">enregistrer</a></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="modif_register_avaries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION avariiiiiiiiii</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input type="text" class="form-control"  id="date_m_av"  name="conditionnement"  > <br>
  <label>HEURE</label>  
  <input type="time" class="form-control"  id="heure_m_av"  name="conditionnement"  > <br>
   
<label>DECLARATION</label><br>
   <select id="declaration_m_av">
  
  </select><br> 
  <label>CALE</label><br>
   <select id="cale_m_av">
     <?php

 $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec  FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> <?php echo $rownn['id_dec']; ?></option>
    <?php } ?>
   
  </select><br>
</div>

<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue ;">TRANSPORT</h3>
   
 <label style="color: white !important;">CAMIONS  </label><br> 
  </center> 
  

   
<input type="text" id="myInput_m_av"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca_m_av();" ><br><br>

<label style="color: white !important;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp_m_av" placeholder="transporteur" style="width: 50%; " disabled="true" >


<div id="camionList_m_av" style="background: white; display: none; " >
  </div>
 



<input type="" name="input2" id="val_input2_m_av" hidden="true" >

 <center> <br>  
<label style="color: white !important;">CHAUFFEUR  </label> 
</center> 
 
<input type="text" id="myInputc_m_av"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau_m_av();" >

<div id="camionListc_m_av" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c_m_av" hidden="true" >
<input type=""  id="dis_bl_m_av" hidden="true" >
<input type=""  id="poids_sac_m_av" hidden="true" ><br><br>

  </div>

  
</div>
<div class="mb-3">

 <label style="">BL</label><br>  
  <input type="text" class="form-control"  id="bl_m_av"  name="conditionnement"  > <br>
  <label style="">SACS FLASQUE</label> <br> 
  <input type="text" class="form-control"  id="sacf_m_av"  name="conditionnement"  > <br>
  <label style="">POIDS FLASQUE</label><br>  
  <input type="text" class="form-control"  id="poidsf_m_av"  name="conditionnement"  > <br>
  <label style="">SACS MOUILLE</label><br>  
  <input type="text" class="foav-control"  id="sacm_m_av"  name="conditionnement"  > <br>
  <label hidden="true" style="">POIDS MOUILLE</label><br>  
  <input type="text" class="form-control"  id="poidsm_m_av"  name="conditionnement" hidden='true' > <br>
  <input type="text" class="form-control"  id="id_m_av"  name="conditionnement" hidden="true"  >
  <input type="text" class="form-control"  id="id_destination_m_av"   >
  <input type="text" class="form-control"  id="id_navire_m_av"   >
   <input type="text" class="form-control"  id="id_produit_m_av"   >
  
  </div>

  
<br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a id="mod_avaries"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_avaries_deb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION ddads</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input  type="text"  id="date_avdeb"   class="form-control" > <br>
 
 <label style="">SACS FLASQUE</label> <br> 
  <input type="text" class="form-control"  id="sacf_avdeb"  name="conditionnement"  > <br>
   <label style="">SACS MOUILLE</label> <br> 
  <input type="text" class="form-control"  id="sacm_avdeb"  name="conditionnement"  > <br>
  <label>CALE</label><br>
   <select style="width: 50%; margin-bottom: 20px; height: 30px;" name="cale" id="cale_avdeb" >
   
  <?php  
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } ?>
  </select>

  <label style="">id_navire</label> <br> 
  <input type="text" class="form-control"  id="id_navire_avdeb"  name="conditionnement"  > <br>
  <label style="">id</label> <br> 
  <input type="text" class="form-control"  id="id_avdeb"  name="conditionnement"  > <br>
  <label style="">id_dis</label> <br> 
  <input type="text" class="form-control"  id="id_dis_avdeb"  name="conditionnement"  >
   <br>
    <input type="text" class="form-control"  id="poids_sac_avdeb"  name="conditionnement"  >
     <input type="text" class="form-control"  id="produit_avdeb"  name="conditionnement"  >
  
  </div>

  
<br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a data-role="mod_avaries_deb"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>





<div class="modal fade" id="fichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">ARCHIVRAGE</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" enctype="multipart/form-data">

   <div class="mb-3">
    <label for="image">Choisir une image :</label>
  <input type="file" name="image" id="image">
  <input type="text" name="ids" id="id_image">

   

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire"  value=<?php  
        echo $rown['id_navire'];
    ?> >  
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>
      
 
 <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="archiver" id="deb" >enregistrer</button></center>
</form> 
      </div>  
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



</div>








<div class="modal fade" id="Les_avaries2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <?php if($rown['type']=='SACHERIE'){ ?>


   <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control"   name="date" id="dateavdeb">
  <br>  

    <label>SAC FLASQUE</label>
    <input type="number" class="form-control"   name="sacf"  id="sacfavdeb"  value="0"
     >
     <br> 
     <label>SAC MOUILLE</label>
    <input type="number" class="form-control"    name="sacm"  id="sacmavdeb"  value="0"
     >
     <br> 
<select name="cale" id="caleavdeb"> 
<option selected value=""> CHOISIR CALE</option> 
<?php 
     $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination); 
while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> </option>
    <?php }  ?>
    </select>



      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="navireavdeb" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control"  placeholder="navire"  id="id_disavdeb" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> > 
     <input type="text" class="form-control"  placeholder="navire"  name="poids_sac"  id="poids_sacavdeb" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
     <input type="text" class="form-control"  placeholder="navire"  name="id_produit"  id="produitavdeb" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
   
</div>
  
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="btn_avaries_debarquement" >enregistrer</a></center>
        </div>
      <?php }  ?>

    
</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>







<?php } ?>








<script type="text/javascript">
	function cache_cel(){
	var poids_sac=$('#input_poids_sac').val();
  var statut=$('#input_statut').val();
  var type=$('#typesain').val();
    if(type=='VRAQUIER'){
      $('#poids_cacher').css('display','none');
      $('#poids_m_rm').css('display','none');
      $('#sac_m_rm').css('display','block');
      $('#sac_title').css('display','block');
      $('#poids_title').css('display','none');
      
    }

	if((poids_sac!=0 && statut!='flasque') || (type=='VRAQUIER')){
      $('#poids_cacher').css('display','none');
      $('#poids_m_rm').css('display','none');
      $('#sac_m_rm').css('display','block');
      $('#sac_title').css('display','block');
       $('#poids_title').css('display','none');
      
    }
      if(poids_sac!=0 && statut=='flasque'){
      $('#poids_cacher').css('display','none');
      $('#poids_m_rm').css('display','block');
      $('#sac_m_rm').css('display','block');
      $('#sac_title').css('display','block');
      $('#poids_title').css('display','block');
      
    }

      if(poids_sac==0 ){
      $('#poids_cacher').css('display','block');
      $('#poids_m_rm').css('display','block');
      $('#sac_m_rm').css('display','none');
      $('#sac_title').css('display','none');
      $('#poids_title').css('display','block');
      
    }



}
cache_cel();
</script>
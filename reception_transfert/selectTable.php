<?php
require('../database.php');
require('controller/afficher_les_receptions.php');


?>


<style type="text/css">
 *{
  font-family: Times New Roman;
 } 
 .fabtn{
  border: none;
  vertical-align: middle;
 


 }
  .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
 }
  
    #mytd{
      font-size:14px;
    }
    .colcel{
      text-align: center;
      vertical-align: middle;
    }
    .colaffiche{
      vertical-align: middle;
    }
   

</style>




 
 
<br>

  


<?php 



  if(!empty($_POST["idProduit"])){ 

        $c=$_POST["idProduit"];

$_SESSION['c']=$c;
$explode=explode('-', $c);
/*
$naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $naviress->bindParam(1,$_SESSION['id']);
      $naviress->execute(); */

      $produit=$explode[0];
      $poids_sac=$explode[1];
      $navire=$explode[2];
      $destination=$explode[3];
      echo $destination; echo $poids_sac; echo $produit; echo $navire;?>
<div style="display: none;" >
      <input type="text" id="valeur_produit" value="<?php echo $produit; ?>" name="">
      <input type="text" id="valeur_poids_sac" value="<?php echo $poids_sac; ?>" name="">
      <input type="text" id="valeur_navire" value="<?php echo $navire; ?>" name="">
      <input type="text" id="valeur_destination" value="<?php echo $destination; ?>" name="">
    </div>

      <?php  



      $bouton=$bdd->prepare("SELECT nav.type, nc.id_navire from dispat as dis
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
       inner join navire_deb as nav on nav.id=nc.id_navire where nc.id_navire=? ");
      $bouton->bindParam(1,$explode[2]);
      $bouton->execute();
      $btn=$bouton->fetch();
    ?>

<div class="main " id="main" > 


<div class="container-fluid-great"  >
        <div class="row">
 

 
</div>

</div>



<div class="container-fluid" style="background: white; ">
  <div class="row">
    <?php if($btn['type']=="SACHERIE"){ ?>
      <center>
      <div class="col col-sm-12 col-md-12 col-lg-12">
         <span class="lien_debut"> 
        <button class="dropdown-toggle" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; width: 20%; font-size:16px;  background: white; align-items: center;  "  class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >RECEPTIONNES</button>
         <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
          <center>
          <li>
          <button  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " id="btnSain"  onclick="visibleSain()">SAINS</button>
        </li>

          <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  class="btn " id="btnMouille" data-navire=<?php echo $navire; ?> onclick="visibleAvariesDeb()"  data-produit=<?php echo $produit; ?> data-poids_sac=<?php echo $poids_sac; ?> data-destination=<?php echo $destination; ?> >MOUILLES</button></li>
           <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnFlasque" onclick="visibleRecepFlasque()">FLASQUES</button></li>
            <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnBalayure" onclick="visibleRecepBalayure()">BALAYURES</button></li>
            </center>
          </ul>
      <div style="display:none;">
        <input type="" name="" id="input_navire" value="<?php echo $navire; ?>">
        <input type="" name="" id="input_produit" value="<?php echo $produit; ?>">
        <input type="" name="" id="input_destination" value="<?php echo $destination; ?>">
        <input type="" name="" id="input_poids_sac" value="<?php echo $poids_sac; ?>">
      </div>
          


        <button style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white; width:  "  class="btn " id="btnAvariesRep" onclick="visibleAvariesRep()">AVARIES</button>
    
      </span>
      </div>
        </center>
    <?php } ?>

    <?php if($btn['type']=="VRAQUIER"){ ?>
      <div class="col col-md-6 col-lg-6">
        <button class="btn btn-primary" id="btnSain"  onclick="visibleSain()">SAINS</button>
      </div>
    

    <?php } ?>
  </div>
</div>


 <?php  




        $afficheAvaries = $bdd->prepare("select pre.*,trav.*,cam.*,ch.* from pre_reception_avaries as pre inner join transfert_avaries as trav on pre.id_pre_tr_av=trav.id_tr_avaries inner join camions as cam on cam.id_camions=trav.id_cam inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr where trav.id_dis_bl_tr=? ");
        
        
        $afficheAvaries->bindParam(1,$c);
        $afficheAvaries->execute();


        

   

               ?>


<?php $table_sain_visible=$_POST['table_sain_visible']; ?>
<div class="container-fluid" id="tableSain"  <?php if($table_sain_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_sain_visible==1){

 ?> style="display: block;" <?php } ?>>  
  
 <div class="col-md-12 col-lg-12">
       
<div class="table-responsive"  id="tabsain" border='1'>




 <table class='table table-hover table-bordered table-striped table-responsive'  border='2' style="margin-top: 0px;" >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="11" class="titreSAIN"  >RECEPTION DES SACS SAINS</td>
 
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202)); text-align: center; color: white; font-weight: bold;"  >
      <td id="mytd" scope="col" rowspan="2"  >ROTATIONS</td>
      <td id="mytd" scope="col" rowspan="2"  >DATE</td>
      <td id="mytd" scope="col" rowspan="2"  >HEURE</td>
     
     
      <td id="mytd" scope="col" rowspan="2" > N° BL</td>
      <td id="mytd" scope="col" rowspan="2" >CAMIONS</td>
      <td id="mytd" scope="col" rowspan="2" >CHAUFFEUR</td>
      <td id="mytd" scope="col" rowspan="2" >DECLARATION</td>
      

      <td id="mytd" scope="col" rowspan="2" >SACS</td>
    
      <td id="mytd"  scope="col" rowspan="2" >POIDS</td>
       <td id="mytd"  scope="col" rowspan="2" >SACS MANQUANTS</td>
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>

  <?php affichage_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
 
</tbody>
             

            

</table>
</div>
</div>
</div>
<br><br>

<?php 
    // FILTRER LE NAVIRE SI C SACHERIE ON AFFICHE LE TRANSFERT DES AVARIES
   $filtreavaries= $bdd->prepare('SELECT  nav.navire,nav.type, dis.id_dis,nc.*   FROM dispat as dis ' 
                
                 
                . connaissement_dispat() . navire_connaissement() .
              
              

                   ' WHERE dis.id_produit=? and dis.poids_kg=? AND nc.id_navire=?  ');
        $filtreavaries->bindParam(1,$explode[0]);
        $filtreavaries->bindParam(2,$explode[1]);
        $filtreavaries->bindParam(3,$explode[2]);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
      if($cherche['type']=="SACHERIE"){  

          ?>

       <?php  $table_avaries_deb_visible=$_POST['table_avaries_deb_visible']; ?>
<div class="container-fluid" id="TableReceptionAvaries" <?php if($table_avaries_deb_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_deb_visible==1){

 ?> style="display: block;" <?php } ?>> 

        <div class="row">
            
            
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >

 <thead style=" background: #1B2B65;" >
  <td   id="titreAVDEB" colspan="12"  >AVARIES DE DEBARQUEMENT</td> 
 
       
    
    <tr id="tr_attente_avdeb"  >
      
      
      <td scope="col"    >ROTATIONS</td>
       <td scope="col"   >DATE</td>
              <td scope="col"    >HEURE</td>
       
                      <td scope="col"    >BL</td>
               <td scope="col"   >CAMIONS</td> 
               <td scope="col"   >CHAUFFEUR</td>
               <td scope="col"   >N° DECLARATION</td>

                        
      <td scope="col"   >SAC</td>
      <td scope="col"   >POIDS</td>
      <td scope="col"  rowspan="3"  >ACTIONS</td>
      
     
  </tr>
    
      
      
     </thead>


<tbody>

<?php
$statut='mouille';

 affichage_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>




   



<?php  }
    ?>
      <?php $table_avaries_reception_visible=$_POST['table_avaries_reception_visible']; ?>
    <div class="container-fluid" class="" id="avaries_receptions" <?php if($table_avaries_reception_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_reception_visible==1){

 ?> style="display: block;" <?php } ?> >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER AVARIES  </a>
<br><br>

<span style="" id="poids_sac_avr" ><?php echo $afdis['poids_sac'] ?></span>
<span style="display: none;" id="id_produit_avr" ><?php echo $afdis['id_produit'] ?></span>
<span style="display: none;" id="id_destination_avr" ><?php echo $afdis['id_destination'] ?></span>
<span style="display: none;" id="id_navire_avr" ><?php echo $afdis['id_navire'] ?></span>
<span style="display: none;" id="id_declaration_avr" ><?php echo $afdis['id_declaration'] ?></span>

</div>
<?php } ?>

<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php 
 ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td>  
    
   
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
       <td id="mytd"  scope="col"  >ACTIONS</td>
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
<?php if(empty($_POST['idProduit'])){ ?>
  <div class="alert alert-danger"><center><span style="font-weight: bold; font-size: 20px;">Veuillez choisir un produit</span></center></div>
<?php } ?>
 
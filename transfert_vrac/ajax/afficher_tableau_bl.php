<?php require('../../database.php');
    require '../../vendor/autoload.php';
    use Pro\TechlogNewVersion\Entete_tableaux_vrac;
    require('../controller/afficher_les_debarquements.php');


$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$client= $_POST['client']; 
$transfert_sain=$_POST['transfert_sain'];

$statut=$_POST['statut'];

$date_filtre='';
$cale_filtre='';

$resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);

        $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client); ?>

        <div style="display: none;">
        <input type="" name="" id="input_navire" value="<?php echo $navire; ?>">
        <input type="" name="" id="input_produit" value="<?php echo $produit; ?>">
        <input type="" name="" id="input_destination" value="<?php echo $destination; ?>">
        <input type="" name="" id="input_poids_sac" value="<?php echo $poids_sac; ?>">
        <input type="" name="" id="input_client" value="<?php echo $client; ?>">
        <input type="" name="" id="input_dates" value=""> 
      </div>

<div class="container-fluid bg-white" id="TableSain" >

<input type="text" name="" id="input_statut" value="<?php echo $statut ?>" style='display: none;'>

  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('../entete_tableau.php'); ?>
 <div class="table-body" id="tbody_transfert_deb" onscroll="fixerEnTeteTableau()">
    <tbody  >
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
      affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);
    //}   ?> 
    </tbody>   
    </div>    

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>

<?php 
   


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
      <div style="display: flex; justify-content: center;" class="modal-footer"><center><a class="btn btn-primary" data-role="ajout_new_remorque" >
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
  <div class="modal-dialog modal-register" style="z-index: 1;">
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
<div class="row">  
   
     <div id="info_bl" >
      <span id='num_du_bl'></span>
     </div>
     <div id="info_bl" class="col-lg-2">
     <label>BL</label> <br> 
      <input class="" type="text"   name="numero_bl"  id="blsain" placeholder=" bl" style="width: 60px;" >
</div>

      
  

   
    <div  class="col-lg-2">
      <label   >date</label> <br>
     
      
  <input type="date"     name="date" id="datesain">
</div>
<div  class="col-lg-2">
   <label  >heure</label><br> 
   <input type="time"    name="heure" id="heuresain" >
</div>



  
 <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="naviresain" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control"  placeholder="type"  name="type" hidden="true"  id="typesain"  value=<?php  
        echo $rown['type'];
    ?> > 



 
     
  <input type="text" class="form-control"  placeholder="produit" name="produit"  id="produitsain" hidden="true"    value=<?php echo $rown['id_produits'];  ?> >

     
  <input type="text" class="form-control"  placeholder="id_dis" name="id_di"  id="id_dissain" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >



  
      
  <input type="text" class="form-control"  placeholder="produit" name="poids"  id="poids_sacssain" hidden="true" 
         value=<?php 
        echo $rown['poids_kgs'];  ?> 
     >
     
  
<div class="col-lg-2"> 
   <label>Cale </label><br>  
  <select class="inputform"  name="cale" id="calesain" style="height: 30px;" >
    <option value="">Cale</option>

    <?php

 //$rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
      

      
    
           $rescale=cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
         
     while($res=$rescale->fetch()){ ?>
           
      <option value=<?php echo $res['id_dec']; ?>><?php echo $res['cales']; ?></option>
    <?php  } ?>
  </select>

</div>

   <div class="col-lg-4">
    <label>Declaration </label><br>  
    <select  name="declaration"  style="height: 30px; " id="declarationsain">
    <option value="" > choisir une declaration <?php  echo $poids_sac; ?></option>
    <?php
         $resdes=declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
              
     while($dec=$resdes->fetch()){ 
    /* $id_declaration=$dec['id_declaration'];
     $suivi_dec_select=suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration);
     $suivi=$suivi_dec_select->fetch();
     $restant=$suivi['poids']-$suivi['sum(td.poids)'];  */     ?> 
    <option value=<?php  echo $dec['id_declaration']; ?> ><?php  echo $dec['num_declaration']; ?> (restant=<span class="restant"><?php //echo $restant; ?></span>) </option>  
   <?php } ?>
    </select> 
  </div>





<div class="mb-3">
 
  <select class="inputselect" id='bon'  style="display:none;" >
    <option>Choisir un bon</option>
     <?php   //$bon=bon($bdd,$produit,$poids_sac,$navire,$destination,$client); ?>
    
    <?php //while($bons=$bon->fetch()){ 
        ?>
    
    
  </select>
</div>
</div>
</div>


<div style="background: rgb(248,248,248);">
   
      <center>  
    <h6 style="background: white; color: blue;">TRANSPORT</h6>
   
 
  </center> 
  <div class="mb-3">
    <div class="row"> 
 <div class="col-lg-3">  
  <input style="max-width: 100px;"   type="text" id="myInput"  placeholder=" TRACTEUR"  onkeyup="filtreca();" autocomplete="off"> <a style="height: 10px; font-size:5px; border: none; text-align: center !important; "  data-role='nouveau_camion' ><span style="justify-content:center; margin-left:1px; font-weight: bold; font-size:10px; text-align: center !important; border-radius: 50%; " class="btn btn-danger text-white  "> + </span></a>
</div>



 <div class="col-lg-3"> 
  <input    type="text" id="InputRemorque"  placeholder=" REMORQUE"  onkeyup="filtreRemorque();" autocomplete="off" style="max-width: 100px;"> <a style="height: 10px; font-size:5px; border: none; text-align: center !important;"   data-role='nouveau_remorque' ><span  style="justify-content:center; font-weight: bold; font-size:10px; text-align: center !important; border-radius: 50%;   " class="btn btn-danger text-white  "> + </span></a>
</div>

  <div class="col-lg-6">
<input style="width: 300px;" class="" type="text" id="myInputc"  placeholder="chauffeur"  onkeyup="filtreChau();" autocomplete="off"> <a style="height: 10px; font-size:10px; border: none; text-align: center !important;" data-role='nouveau_chauffeur'   ><span style="justify-content:center; font-weight: bold; font-size:10px; text-align: center !important; border-radius: 50%;" class=" btn btn-danger text-white bg-danger"> + </span></a>
</div> 
</div>
  <div class="col-lg-12"  id="camionList" style="background: white; display: none; " >
  </div>
  <div class="col-lg-12"  id="camionListRemorque" style="background: white; display: none; text-align: center; float: right;" >
  </div>
</div>



  






<input class="inputtransportform" type="text" id="myInputTransp" placeholder="transporteur" style=" border: none;" disabled="true"  ><!-- <a class="btn btn-danger" data-role='nouveau_transporteur' >  <span class="text-white bg-danger"> + </span></a> !-->


 

<br>  





<input type="" name="input2" id="val_input2" hidden='true'  >
<input type="" name="input2" id="val_input_remorque" hidden="true"  >
 


<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" hidden='true'  >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>







  <input type="text" class="form-control"  placeholder="" name="client"  id="clientsain" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="mangasinsain" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >



<?php if($rown['des_douane']=="LIVRAISON"){ ?>


 
 
  <input class="inputform" type="text"  id="destinatairesain" placeholder="destinataire" name="destinataire"  >

<?php 
}
 if($rown['des_douane']=="TRANSFERT"){  ?>
  
 
  <input type="text" class="form-control" id="destinatairesain" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true" >



<?php  

} ?>

  
<?php //if($rown['type']=="SACHERIE" and $rown['poids_kg']!=0){ ?>
  <div class="mb-3" id='sac_cacher' <?php  if($rown['poids_kgs']==0 ){echo "style='display:none;'";} ?>> </div>
  <div class="mb-3"> 
    <div class="row">
      <div class="col-lg-6" <?php  if($rown['poids_kgs']==0 ){echo "style='display:none;'";} ?>>
      <label for="exampleFormControlInput1" class="form-label">nombre sac</label><br> 
  <input style="width:50%;" class="inputform" type="number"   placeholder="0" name="sac" id="sacsain" required>
</div>
</div>
</div>

 
   
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
            <?php //$rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
    // while($res=$rescale->fetch()){ ?> 
     <label><?php //echo $res['cales']; ?></label>
     <input type="" name=""><br>
   <?php //} ?>
         
        </div>


        
        
        
      </center> 

  <div class="mb-3"  id='poids_cacher'   >
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text"  id="poidssain" placeholder="poids" name="poids_s"  value="0" >
</div> 


<?php //} ?>

<input type="text" id='input_type_navire' value="<?php echo $rown['type'] ?>" style="display:none;">
<input type="number" id='input_poids_kg'    value="<?php echo $rown['poids_kgs'] ?>"  style="display:none;">

<input type="texte" id='input_des_douane' value="<?php echo $rown['des_douane'] ?>" style='display:none ;' >

   <div class="mb-3">


        

         <center>
        <a  class="btn btn-primary" style="text-align: center;" name="register" id="register" data-role="btn_register" >enregistrer</a> </center>
</form> 
</div>
      </div>   
 
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



<div class="modal fade" id="modif_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-register ">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION </h6></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">

    <div class="row"> 
    <div class="col-lg-2 mr-2"> 
   <label>DATE</label> <br>  
  <input style="width: 80px;" type="text"   id="date_m_rm"  name="conditionnement"  > 
</div> 
<div class="col-lg-2 " > 
  <label>HEURE</label><br>    
  <input type="time"   id="heure_m_rm"  name="conditionnement"  > 
</div>
<div class="col-lg-2 ml-2" > 
    <label>BL</label> <br>   
  <input style="width: 80px;" type="text"   id="bl_m_rm"  name="conditionnement"  > 
</div>
<div class="col-lg-2"> 
  <label>CALE</label><br> 
   <select id="cale_m_rm">
    <?php
   

      
    
           $rescale=cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
         
     while($res=$rescale->fetch()){ ?>
           
      <option value=<?php echo $res['id_dec']; ?>><?php echo $res['cales']; ?></option>
    <?php  } ?>
     
   
  </select>

  </div>

  <div class="col-lg-4">
    <label>DECLARATION</label><br>

<?php
       
 
 ?>
   <select id="declaration_m_rm">
    <?php  
                $resdes=declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
              
     while($dec=$resdes->fetch()){ 
    /* $id_declaration=$dec['id_declaration'];
     $suivi_dec_select=suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration);
     $suivi=$suivi_dec_select->fetch();
     $restant=$suivi['poids']-$suivi['sum(td.poids)'];  */     ?> 
    <option value=<?php  echo $dec['id_declaration']; ?> ><?php  echo $dec['num_declaration']; ?> (restant=<span class="restant"><?php //echo $restant; ?></span>) </option>  
   <?php } ?> 
  
  </select><br> <br> 

  </div>
</div>
</div>


<div style="display: none;"> 
  <label id='poids_title'>POIDS</label> 
  <input type="text" class="form-control"  id="poids_m_rm"  name="conditionnement"  > <br>
  <input type="text" class="form-control"  id="id_m_rm" hidden="true"  name="conditionnement"  >
   <input type="text" class="form-control"  id="type_m_rm" hidden="true"  name="conditionnement" value="<?php echo $rown['type']; ?>"  >
   <input type="text"  id="statut_m_rm"  hidden="true">
   </div>






  
      </center>



  <div class="mb-3" id="div_destinataire" style="display: none;">
<label>DESTINATAIRE</label><br>
<input type="text"  id="destinataire_m_rm"  ><br>
</div>

<div style="background: rgb(248,248,248);">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   </center> 
   <div class="row">  

  <div class="col-lg-4">  
 <label style="color: white;">CAMIONS  </label><br> 
 <input type="text" id="myInput_m_rm"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca_m_rm();" >
 </div>

  <div class="col-lg-8">  

<label style="color: white;">CHAUFFEUR  </label> 
<input type="text" id="myInputc_m_rm"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau_m_rm();"  >
  </div>


<div class="col-lg-12" id="camionList_m_rm" style="background: white; display: none; " >
  </div>
  <div class="col-lg-8" id="camionListc_m_rm" style="background: white; display: none;" >
  </div>



<div class="col-lg-12"> 
<label style="color: white; width: 30%;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp_m_rm" placeholder="transporteur" style="width: 30%; " disabled="true" >



 



<input type="" name="input2" id="val_input2_m_rm"   hidden="true"  >

   



<input type="" name="input2c" id="val_input2c_m_rm" hidden="true">
<input type=""  id="dis_bl_m_rm" hidden="true" >
<input type=""  id="poids_sac_m_rm" hidden="true" >

<input type="" name="input2c" id="id_produit_m_rm" hidden="true">
<input type=""  id="id_destination_m_rm" hidden="true" >
<input type=""  id="id_client_m_rm" hidden="true" >
<input type=""  id="id_navire_m_rm" hidden="true" ><br><br> 

</div>

  </div>


</div>
  
</div>

<div class="mb-3">

<input type="number" name="" id='id_detail_m_rm' style="display:none;" > 

<div id='sac_modif_visible'> 
<label id='sac_title'>SAC</label> <br>   
  <input type="text"   id="sac_m_rm"  name="conditionnement"  > <br> 
  </div> 


  
 
  
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

        
        
 
        <center>
      <div class="modal-footer">
         <center> 
    <a data-role="mod" id='btn_modif_register'  class="btn btn-primary  " name="modifier_les_register" >valider</a>
    </center>
        </div>
        </center>
   </div>     
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>


<?php } //fermeture $element_forms->fetch()  ?>

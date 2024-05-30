
<?php $resfil=$resfiltre->fetch(); ?>
  <div class=" col col-md-6 col-lg-6">      
<button id="insertion_sain" type="submit" class="btn1" onclick="heure_automatique()"  >Insertion </button>

    <span  class="btn" style="color: white; background: blue;" id="scrollDownBtn" onclick="scrollDown()" title="Défiler vers le bas"> Cliquer ici pour défiler vers le bas
   <i class="fa-solid fa-arrow-down"></i><!-- Utilisez la classe de votre icône -->
</span>



 ?>
 <a style="margin-left: 20px; " class="btn1" data-bs-target="#form_tare_sac" data-bs-toggle="modal"  >Ajouter tare sac</a>
<span id='info_tare'> </span>
 </div>
 
 <div class="col col-md-6 col-lg-6"> 
 <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl" oninput='cherche_par_bl()' > </span>
</div> 

</div>



<div class="col col-md-12 col-lg-12" >
  <div class="table-responsive" id="tableau_sain" onscroll="fixerEnTeteTableau()">

 

<table  class='table table-hover table-bordered table-striped table-responsive'  border='1'   >
    
 <!--<div class="table-headers"> !-->
 <thead  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; ">
  <td  colspan="14" class="titreSAIN"  >RECAPITULATI DES BONS DE TRANSFERT <?php //$element_entete=entete_des_tableaux($bdd,$produit,$poids_sac,$navire,$destination);
//       echo $rown['des_douane'].' ';
      
       // if($transfert_sain==1){ echo strtoupper($statut); }
       //echo strtoupper($statut); ?></td>
  <?php   
           ?>
            <tr >  
            <td  colspan="14" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; " >  </td>
            </tr>
          <?php   //} ?>

  

       
    
    <tr class="headers" id="entete_table_sain" style="vertical-align: middle; "   >
      <td  scope="col" style="width: 1%;"  >ROTA <br> TION</td>
      <td  scope="col"   >DATES </td>
      <td class="cache_colonne"  scope="col"   >HEURE</td>
      <td  scope="col"  >CALE  </td>
      <td  scope="col"  > N° BL </td>
       <?php if($resfil['des_douane']=='LIVRAISON'){ ?>
       <td  scope="col"  >BON FOURNISSEUR</td>
     <?php } ?>
      <td  scope="col"  >CAMIONS</td>
      <td class="cache_colonne"  scope="col"  >CHAUFFEUR</td>
      
          <td class="cache_colonne" scope="col"  >TELEPHONE</td>
      <td  scope="col"  >N°DEC / TRANSFERT </td>
      <?php 
        if(($resfil['poids_kgs']!=0 and !empty($resfil['poids_kgs']))   ){


      ?>
      <td  scope="col"  >NBRE SACS</td>
    <?php }  ?>
    <?php if(!$resfil){ ?>
       <td  scope="col"  >NBRE SACS</td>
     <?php } ?>
    <td   scope="col"  >NET MARCHAND </td>
      <td   scope="col"  >TICKET PONT</td>
      
      <?php 
      while($filtre=$filtreColonne->fetch()){
        if( $filtre["des_douane"]=="LIVRAISON"){
          ?>
          
          <td  scope="col"  >DESTINATAIRE </td>
      
          <?php  
        }

      } ?>
     
     <td class="cache_colonne" >OBSERVATION</td>
     <td  id="cacher_cellule" >ACTION</td>


   
     </tr>
      

      
     </thead>
<!--</div>!-->
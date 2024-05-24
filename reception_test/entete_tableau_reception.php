 <div class="row"> <?php //  row a thead?>
            
         <div class="col col-md-6 col-lg-6">
  <?php $titre_entrepot=$bdd->prepare('SELECT mangasin from mangasin where id=?');
        $titre_entrepot->bindParam(1,$destination);
        $titre_entrepot->execute();
        if($titre_entrepots=$titre_entrepot->fetch()){ ?> 

<h6> <span style="color:blue !important;"> Entrepot:</span> <span > <?php echo $titre_entrepots['mangasin'] ?> </span></h6> <?php } ?>
</div>
   <div class="col col-md-6 col-lg-6"> 
 <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl" oninput='cherche_par_bl()' > </span>
</div>     
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
 
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
   <input type="text" name="" id="input_statut" value="<?php echo $statut; ?>" style='display: none;' >

 <thead style=" background: #1B2B65;" >
  <td   id="titreAVDEB" colspan="12"  >RECEPTIONS  <?php //echo strtoupper($statut).'S'; ?></td> 
 
       
    
    <tr id="tr_attente_avdeb"  >
      
      
      <td scope="col"    >RT</td>
       <td scope="col"   >DATE <?php $filtre_date=filtre_date($bdd,$produit,$poids_sac,$navire,$destination); 
       ?>

        <select id='valeur_filtre_date' style="width: 15px;" data-role='filtrer_par_date'>
        <option></option>
         <?php while($f_date=$filtre_date->fetch()){ 
            $dateObj = date_create_from_format('Y-m-d', $f_date['dates']);
                $date_converti = $dateObj->format('d-m-Y');
          ?>

          <option value="<?php echo $f_date['dates']; ?>"><?php echo $date_converti; ?></option>
        <?php } ?>
       </select></td>
              <td scope="col"  >HEURE</td>
       
                      <td scope="col"    >BL</td>
               <td scope="col"   >CAMIONS</td> 
               <td scope="col"   >CHAUFFEUR</td>
               <td scope="col"   >TEL</td>
               <td scope="col"   >TRANSPOR <br> TEUR</td>
            <!--   <td scope="col"   >CUMUL JOUR</td> !-->
               <td scope="col" style="display: none;"  >N° DECLARATION</td>
              <td scope="col"   >STATUT</td>
           
      <td scope="col"   >SACS</td>
      <td scope="col"   >POIDS</td>
      <td scope="col"  rowspan="3" >ACTIONS</td>
      
  </tr>
    
      
      
     </thead>
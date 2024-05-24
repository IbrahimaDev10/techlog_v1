<?php require('../database.php'); 
      require('controller/afficher_navire.php');

$navire=$_POST['id_navire'];


?>
  


</div>
<div class="container-fluid" id="partransit2" >
<?php afficher_declaration($bdd,$navire); ?>


</div>

<div class="modal fade" id="form_update_transit"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen " >
    <div class="modal-content" >
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Modifier les declarations</h1></center>
        <button style="background: red; color: white; font-size: 16px; font-weight: bold;" type="button" class="" data-bs-dismiss="modal" aria-label="Close"> FERMER </i></button>
      </div>
      <div class="modal-body" >
       
         <br>                    
                     <form> 
                      <div class="mb-12" id="les_composants">
                      <?php  $bl_entrant=$bdd->prepare("SELECT p.*, mg.mangasin ,nc.*, dis.* from dispat as dis
    
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on p.id=dis.id_produit
  
  inner join mangasin as mg on mg.id=dis.id_mangasin 
   
    where nc.id_navire=?");
  $bl_entrant->bindParam(1,$navire);
  $bl_entrant->execute(); ?>
                     <select class="" id='val_id_dis' style="max-width: 200px;"> 
                    <?php while($bls=$bl_entrant->fetch()){ ?>          
                     <option value="<?php echo $bls['id_dis'] ?>"><?php echo $bls['num_connaissement']; ?> DESTINATION <?php echo $bls['mangasin']; ?> PRODUIT <?php echo $bls['produit']; ?> <?php echo $bls['qualite']; ?> <?php echo $bls['poids_kg'].' KG'; ?>
                   <?php  } ?>
                       </select>
               
               <?php $num_dec=$bdd->prepare("SELECT * from declaration where id_navire=?");
               $num_dec->bindParam(1,$navire);
               $num_dec->execute(); ?>

                    <select class="ml-3" style="margin-left:10px;" id='val_id_declaration'>
                    <?php while($num_decs=$num_dec->fetch()){ ?> 
                     <option value="<?php echo $num_decs['id_declaration']; ?>"><?php echo $num_decs['num_declaration']; ?>
                   <?php } ?>
                       </select>
                       <input type="text" style="margin-left:10px;" id='val_poids'>
                        <input type="text" style="margin-left:10px;" id='val_id'>
                        <input type="text" style="margin-left:10px;" id='val_id_navire'>

                       </div>
                       <center>
                       <br> 
                        <a  data-role="valider_modif" class="btn-primary" ></a>
                         </center>
                          </form>
                           </div> 
                                             
     
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>



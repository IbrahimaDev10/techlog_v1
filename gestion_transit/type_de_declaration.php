 <?php require('../database.php');
   

  ?>

 <div class="col col-md-12 col col-lg-12"  id="type">
          
        
         <center>
        <select id="type_dec" data-role="afficher_declaration">
          <option value="">Choisir le type de declaration</option>
           <option value="<?php echo $_POST['id_navire'].'-1'; ?>">ENTREE <?php echo $_POST['id_navire']; ?></option>
           <option value="<?php echo $_POST['id_navire'].'-2'; ?>">SORTIE <?php echo $_POST['id_navire']; ?></option>
         
       
        </select>
      </center>
       </div>
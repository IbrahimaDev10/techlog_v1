 <div class="container-fluid1  " style="width: 100%; background: rgb(0,141,202);" >
    <div class="row">
      

        <div class="col-lg-12 col-md-12">
          <h1 class="hem text-white" style=" background: rgb(0,44,62); font-size: 30px;" > RECEPTION DES PRODUITS</h1><br>

          
          <form method="POST" >
                        <div>
                           <center> 
                           <select  id="produit" class="mysel" name="produit" style=" height: 30px;  width: 60%; " onchange='goProduit()'>
                            <option value="">selectionner un produit</option>
                            <?php 
                            while ($row=$destination->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_dis']; ?> >  <?php echo $row['produit'].' '.$row['qualite']; ?> <span style="background: red;"> <?php echo $row['poids_kg']. 'KG'; ?></span>  <?php echo 'Tonnage:'.$row['poids_t'].'T Navire:' .$row['navire']; ?></option>
                            <?php } ?>

                        </select></center>
                           
                      <!-- 
                        <select id="produit" class="mysel" name="produit" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goProduit()'>
                            <option  selected>selectionner produit</option>
  
                        </select> !-->
                        
                        </div> 
            
                 
              
          </form>
        
      </div>
    </div>
  </div>

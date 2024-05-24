<div class="modal fade" id="connaissement_navire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">AJOUTER LES CONNAISSEMENT</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="auth-right">
          <div class="auth-logo">
            <a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
          </div>
          </div>
        <form  method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                          <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            $les_nav=navire($bdd);
                            
                            while($Nav=$les_nav->fetch()) {
                              ?>
                            <option value="<?= $Nav['id']; ?>"><?php echo $Nav['navire']; ?></option>  
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="ajout_connaissement">commencer</button>
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
          </form>
                    
        </div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
  </div>
</div>

<div class="modal fade" id="relache" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">AJOUTER LES RELACHES</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="auth-right">
          <div class="auth-logo">
            <a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
          </div>
          </div>
        <form  method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                          <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            $les_nav=navire($bdd);
                            
                            while($Nav=$les_nav->fetch()) {
                              ?>
                            <option value="<?= $Nav['id']; ?>"><?php echo $Nav['navire']; ?> </option>  
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="ajout_relache">commencer</button>
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
          </form>
                    
        </div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
  </div>
</div>



<div class="modal fade" id="bon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">AJOUTER LES BONS</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="auth-right">
          <div class="auth-logo">
            <a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
          </div>
          </div>
        <form  method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                          <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            $les_nav=navire($bdd);
                            
                            while($Nav=$les_nav->fetch()) {
                              ?>
                            <option value="<?= $Nav['id_bon'] ?>"><?php echo $Nav['navire']; ?></option>  
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="ajout_bon">commencer</button>
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
          </form>
                    
        </div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
  </div>
</div>



<div class="modal fade" id="DC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout declaration de chargement</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form action="debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$chercheNav2->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_declare" >commencer</button>
                           </div> 
                                             
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="transit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout transit</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> TRANSIT</a>  
					</div>
					</div>
      	<form action="debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$transNav->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_transit">Ajouter </button>
                        
                           </div> 
                                             
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>




<div class="modal fade" id="daap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Dispatcher le stockage</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form action="" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            
                            
                            while ($Nav=$NavireDispat2->fetch()) {
                            	?>
                            <option value="<?= $Nav['id']; ?>"><?php echo $Nav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_dispat">commencer</button>
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
  </div>
</div>



<div class="modal fade" id="navire_debarquement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">NAVIRE A DEBARQUER</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="auth-right">
          <div class="auth-logo">
            <a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
          </div>
          </div>
        <form  method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                          <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires2" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            $les_nav=navire($bdd);
                            
                            while($Nav=$les_nav->fetch()) {
                              ?>
                            <option value="<?php echo $Nav['id'].'-'.$Nav['type']; ?>"><?php echo $Nav['navire']; ?></option>  
                           <?php } ?> 
                       </select>
                       
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
         
                    
        </div>
      

  
      <div class="modal-footer">
 
         <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="navire_debarquer">commencer</button>
      </div>
      
    </div>
     </form>
  </div>
</div>
  </div>
</div>

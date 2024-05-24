<?php
require('../database.php');
    $navires=$bdd->query("select * from navire_deb order by id desc");
    if(isset($_POST["idNaviresta2"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idNaviresta2"];

$navire=$bdd->prepare("select * from navire_deb where id=?");
        $navire->bindParam(1,$b);
       
        
        $navire->execute();

         ?>
         


                                <div id="fetch_dispatcli" class="col-md-12">
                    <div class="card" >
                        <div class="card-header" >
                          <center>
                            <h1 >DISPATCHING DU STOCKAGE PAR CLIENT</h1>
                            </center>

                            <button onClick="imprimer('fetch_dispatcli')">imprimer</button>
             <?php  while($rownav = $navire->fetch()){
            ?>
            <div class="row">
                      <div class="col-md-4 col-lg-4"><h4>NAVIRE: <span style="color:red;"><?php echo $rownav['navire'];?></span></h4></div>
                      <div class="col-md-4 col-lg-4"><h4>ETA: <span style="color:red;"><?php echo $rownav['dates'];?></span></h4></div>
                  <div class="col-md-4 col-lg-4"><h4>ETB: <span style="color:red;"><?php echo $rownav['dates'];?></span></h4></div>
                  </div>
                <?php } ?>
                             <select id="naviredispatcli" name="navire" class="form-control form-control-mb-4 " onchange='godispatcli()'> 
                        <option value="">choix du navire</option>              
                            <?php 
                            while ($chNav=$navires->fetch()) {
                                ?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> <pre><?php echo $chNav['dates']; ?></pre></option> 
                           <?php } ?> 
                       </select>

                        </div>

                        <div class="card-body"> 
                        <div class="table-responsive" border=1> 
                         <table class='table  table-bordered table-striped'  border='2' style="border-color: black;" >
                            <thead>
                              <tr style="color:white; font-weight: bold; background: #1B2B65; font-family: montserrat;">
                                <th scope="col">CLIENT</th>
                                <th scope="col">NUMERO sac</th>
                                <th scope="col">POIDS</th>
    

                              </tr>
                            </thead>
                            <tbody id="fetch_dispatcli">
        



     <?php
    $produit = $bdd->prepare("SELECT clients,sum(nombre_sac), sum(poids_kg) from dispatching  WHERE id_navire=? group by clients");
        $produit->bindParam(1,$b);
        $produit->execute();


       /* $total= $bdd->prepare("SELECT sum(nombre_sac),sum(poids) from declaration_chargement where id_navire=?");
        $total->bindParam(1,$b);
        $total->execute();*/

 
        
       ?>


    <?php     while($prod = $produit->fetch()){
            ?>
            <tr >
              <td border="1"><?php echo $prod['clients']; ?></td>
<td border="1"><?php echo $prod['sum(nombre_sac)']; ?></td>
<td border="1"><?php echo $prod['sum(poids_kg)']; ?></td>



</tr>

 
<?php } ?>





    <?php  /*   while($tot = $total->fetch()){
            ?>
            <tr style="color:white;">

               <td border="1">TOTAL</td> 
              <td border="1"><?php echo $tot['sum(nombre_sac)']; ?></td>
<td ><?php echo $tot['sum(poids)']; ?> </td>



</tr>
               <?php }*/ ?>


             
   </tbody>
</table>  

              </div>
            </div>
          </div>
        </div>
               <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('fetch_dispatcli')">imprimer</button>  
<?php } ?>


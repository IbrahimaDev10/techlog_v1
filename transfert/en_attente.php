<div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
        <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
         
            <tr id="entete_table_declaration"  >
              <td  scope="col" style="color: white;">N° DECLARATION</td>
              <td  scope="col" style="color: white;">RESTANT SUR DECLARATION</td>
            </tr>
          
     
       <?php 
while($row=$rob_dec->fetch()){
  $row2=$rob_dec2->fetch();

$rob_poids=$row['poids_declarer']-$row['sum(rm.poids)'] -$row2['sum(tr.poids_flasque_tr_av)']-$row2['sum(tr.poids_mouille_tr_av)'];
   ?>
   <tr id="data_table_declaration">
     
 
  <td>       
 <span class="th4" ><?php  
        echo  $row['numero_declaration']
    ?></span></td>
  <td>
            
 <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span>
  </td>
    </tr>
    
  <?php  } $rob_dec->closeCursor(); ?>
   </table>
      </div>
       </center>
       
  
        <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec2' >

   
         
            <tr id="entete_table_declaration2" >
              <td colspan="2" scope="col" style="color: white;  ">TOTAL DEB</td>
              <td  colspan="2" style="color: white;">ROB</td>
            </tr>
            <tr id="entete_table_declaration2"> 
            <?php while  ($rcolone=$rob_colone->fetch()){ 
             if($rcolone['type']=="SACHERIE"){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php }   
                     if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']!=0 ){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php } 
                               if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']==0 ){ ?> 
            
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } 
            

            if($rcolone['type']=="SACHERIE"){ ?>
             <td style="color: white;" id="entete_table_declaration2"> SACS </td> 
            <td style="color: white;" id="entete_table_declaration2">  POIDS</td>
          <?php } ?>
          <?php if($rcolone['type']=="VRAQUIER"){ ?>
             
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } ?>
        <?php } $rob_colone->closeCursor(); ?>
            </tr>
 <?php 
while($row=$rob->fetch()){
$rob_sac=$row['nombre_sac']-$row['sum(rm.sac)'];
$rob_poids=$row['poids_t']-$row['sum(rm.poids)'];
   ?>
   
   <tr id="data_table_declaration2"> <?php  if($row['type']=='SACHERIE'){ ?>
    <td>  
 <span class="th4" >
          <?php   echo number_format($row['sum(rm.sac)'], 0,',',' '); ?></span></td>
        <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
    <td> <span class="th4" ><?php   
        echo  number_format($rob_sac, 0,',',' ');  ?>
  </span></td>
          
 <td> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
  <?php } ?>
       <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']!=0){ ?>
         <td>  <span class="th4" >
        <?php  
        echo number_format($row['sum(rm.sac)'], 0,',',' '); ?>
         </span></td>
         
         <td>  <span class="th4" >
        <?php  
        echo number_format($row['sum(rm.poids)'], 3,',',' '); ?>
         </span></td>         

     <td> <span class="th4" ><?php   
        echo  number_format($rob_sac, 0,',',' ');  ?>
  </span></td>
          
 <td> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
      
   <?php } 
     ?>

      <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']==0){ ?>
         <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>

        <td colspan="2"> 
                 
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
      
   <?php } 
     ?>
 
         
 

  
   </tr>

  <?php } $rob->closeCursor(); ?>

          </table>
          </center>
        </div>

  

  </div>


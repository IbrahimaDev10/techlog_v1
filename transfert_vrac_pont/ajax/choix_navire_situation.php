<?php 
require('../../database.php');
    $navire=$_POST['navire'];

    function date_situation($bdd,$navire){
    $date_sit = $bdd->prepare("SELECT  pb.date_pont, td.id_navire from pont_bascule as pb
    inner join transfert_debarquement as td on td.id_register_manif=pb.id_transfert where td.id_navire=? group by pb.date_pont " );
        $date_sit->bindParam(1,$navire);
       
        
        $date_sit->execute();
        return $date_sit;
} 

 $date_sit=date_situation($bdd,$navire); ?>
                        <select id="date_situation" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: right;" data-role='goDate_situation' >
                            
                             <option value="" disabled="true" selected>selectionner la date</option>
                            <?php while($date_sits=$date_sit->fetch()){ 
                                 $date=explode('-', $date_sits['date_pont']);
                              ?>
                              <option  value=<?php echo $date_sits['date_pont'].'_'.$date_sits['id_navire']; ?> > <?php echo $date['2'].'-' .$date[1]. '-'.$date[0];  ?> </option>
                            <?php } ?>

  
                        </select>
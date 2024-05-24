<?php 
function date_situation($bdd,$navire_initiale){
	$date_sit = $bdd->prepare("SELECT  pb.date_pont, td.id_navire from pont_bascule as pb
	inner join transfert_debarquement as td on td.id_register_manif=pb.id_transfert where td.id_navire=? group by pb.date_pont " );
        $date_sit->bindParam(1,$navire_initiale);
       
        
        $date_sit->execute();
        return $date_sit;
} ?>


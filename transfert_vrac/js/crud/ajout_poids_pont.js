$(document).ready(function(){
    $(document).on('click','a[data-role=ajouter_poids_pont]',function(){
  //$('#type').css('display', 'block');
 //$('#pont_deb').css('display','none');
       var id= $('#id_pont').val();
       var ticket= $('#ticket_pont').val();
       var poids_brut= $('#poids_pont').val();
       var tare_vehicule= $('#tare_vehicule').val();
        var id_tare= $('#val_id_tare_sac').val();
        var navire= $('#navire_pont').val();
        var dates= $('#date_pont').val();  
        var sac= $('#nbre_sac_pont').val();  val_tare_sac
        var tare_sac= $('#val_tare_sac').val();
if((ticket!='' && poids_brut!='' && tare_vehicule!='' && id_tare!='' && dates!='' && sac!=0) || (ticket!='' && sac==0)   ){
     $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/crud/ajout_poids_pont.php',
        method:'post',
        data:{id:id,ticket:ticket,poids_brut:poids_brut,tare_vehicule:tare_vehicule,id_tare:id_tare,navire:navire,dates:dates,sac:sac,tare_sac:tare_sac},
        success: function(response){
            $('#body_liste_camion').html(response);
            $('#form_poids_pont').modal('toggle');
     
       
        }
    });
       Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Insertion reussi',
        confirmButtonText: 'OK'
    });

     }
     else{
       Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez saisir tous les champs',
        confirmButtonText: 'OK'
    });
     }


  });
});
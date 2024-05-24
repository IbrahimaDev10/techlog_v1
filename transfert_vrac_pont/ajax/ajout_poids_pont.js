$(document).ready(function(){
    $(document).on('click','a[data-role=ajouter_poids_pont]',function(){
  //$('#type').css('display', 'block');
 //$('#pont_deb').css('display','none');
       var id= $('#id_pont').val();
       var ticket= $('#ticket_pont').val();
       var poids_brut= $('#poids_pont').val();
       var tare_vehicule= $('#vehicule').val();
        var id_tare= $('#val_id_tare_sac').val();
        var navire= $('#navire_pont').val();
       

     $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/ajouter_pont.php',
        method:'post',
        data:{id:id,ticket:ticket,poids_brut:poids_brut,tare_vehicule:tare_vehicule,id_tare:id_tare},
        success: function(response){
            $('#body_liste_camion').html(response);
            $('#form_poids_pont').modal('toggle');
     
       
        }
    });


  });
});
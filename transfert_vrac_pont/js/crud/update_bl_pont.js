$(document).ready(function(){
    $(document).on('click','a[data-role=update_bl_pont]',function(){
  //$('#type').css('display', 'block');
 //$('#pont_deb').css('display','none');
         var id = $(this).data('id');
        var dates = $('#'+id+'date_pb').text();
         var net_marchand = $('#'+id+'net_marchand_pb').text();
         var poids_brut = $('#'+id+'poids_brut_pb').text();
         var ticket = $('#'+id+'ticket_pb').text();
         var tare_vehicule = $('#'+id+'tare_vehicule_pb').text();
         var sac = $('#'+id+'sac_pb').text();
          var id_tare_sac = $('#'+id+'id_tare_sac_pb').text();
           var tare_sac = $('#'+id+'tare_sac_pb').text();

        var produits = $('#'+id+'id_produit_pb').text();
        var poids_sac = $('#'+id+'poids_sac_pb').text();
        var navire = $('#'+id+'id_navire_pb').text();
        var destination = $('#'+id+'id_destination_pb').text();
        var client = $('#'+id+'id_client_pb').text();
      /*  var produits = $('#'+id+'produits').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var navire = $('#'+id+'navire').text();
        var destination = $('#'+id+'destination').text();
        var client = $('#'+id+'client').text(); */
      //  var sac = $('#'+id+'sac').text();
        var bl = $('#'+id+'bl_pb').text();
      //  var date1 = $('#'+id+'dates').text();
        $('#id_pont').val(id);
        $('#bl_pont').val(bl);
        $('#ticket_pont').val(ticket);
        $('#poids_pont').val(poids_brut);
        //$('#date_pont').val(date1);
       $('#form_poids_pont').modal('toggle');
        

          $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/element_form_pont_update.php',
        method:'post',
        data:{navire:navire,produits:produits,poids_sac:poids_sac,destination:destination,client:client,
          sac:sac,id:id,bl:bl,dates:dates,ticket:ticket,poids_brut:poids_brut,net_marchand:net_marchand,tare_vehicule:tare_vehicule,
          id_tare_sac:id_tare_sac,tare_sac:tare_sac
         },
        success: function(response){
            $('#element_pont').html(response);
            $('#form_poids_pont').modal('toggle');
     
       
        }
    });  



  });
});
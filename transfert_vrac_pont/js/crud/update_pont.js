$(document).ready(function(){
    $(document).on('click','a[data-role=update_poids_pont]',function(){
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
      
      //  var date1 = $('#'+id+'dates').text();
      var id=  $('#id_pont').val();
      var bl=  $('#bl_pont').val();
      var ticket= $('#ticket_pont').val();
      var poids_brut=  $('#poids_pont').val();
      var tare_vehicule=  $('#tare_vehicule').val();
      var dates=  $('#date_pont').val();
      var net_marchand=$('#net_marchand').val();
      var id_pont=$('#id_pont').val();
      var sac=$('#nbre_sac_pont').val();
      var tare_sac=$('#val_tare_sac').val();



      var produits=$('#produit_pont').val();
      var poids_sac=$('#poids_sac_pont').val();
      var destination=$('#destination_pont').val();
      var navire=$('#navire_pont').val();
      var client=$('#client_pont').val();




        //$('#date_pont').val(date1);
       $('#form_poids_pont').modal('toggle');
        

          $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/crud/update_pont.php',
        method:'post',
        data:{navire:navire,produits:produits,poids_sac:poids_sac,destination:destination,client:client,
          id:id,bl:bl,dates:dates,ticket:ticket,poids_brut:poids_brut,net_marchand:net_marchand,tare_vehicule:tare_vehicule,
          sac:sac,tare_sac:tare_sac
         
         },
        success: function(response){
            $('#Table_pont').html(response);
            $('#form_poids_pont').modal('toggle');
     
       
        }
    });  



  });
});
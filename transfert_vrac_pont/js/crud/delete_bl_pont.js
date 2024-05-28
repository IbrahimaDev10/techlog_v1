 function delete_bl_pont(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var navire = $('#'+id+'id_navire_pb').text();
         var poids_sac = $('#'+id+'poids_sac_pb').text();
         var produit = $('#'+id+'id_produit_pb').text();
         var destination = $('#'+id+'id_destination_pb').text();
         var client = $('#'+id+'id_client_pb').text();
         var id_transfert = $('#'+id+'id_transfert_pb').text();

         
         $.ajax({

              type:'post',
              url:'ajax/crud/delete_bl_pont.php',
              data:{delete_id:id,navire:navire,poids_sac:poids_sac,produit:produit,destination:destination,client:client,
                id_transfert:id_transfert},
              success:function(response){
              
                   $('#Table_pont').html(response);

              }

         });

       }


     }
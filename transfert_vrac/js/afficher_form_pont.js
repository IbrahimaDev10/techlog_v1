$(document).ready(function(){
    $(document).on('click','a[data-role=afficher_form_pont]',function(){
  //$('#type').css('display', 'block');
 //$('#pont_deb').css('display','none');
         var id = $(this).data('id');
        var produits = $('#'+id+'produits').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var navire = $('#'+id+'navire').text();
        var destination = $('#'+id+'destination').text();
        var client = $('#'+id+'client').text();
        var sac = $('#'+id+'sac').text();
        $('#id_pont').val(id);
       

     $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/element_form_pont.php',
        method:'post',
        data:{navire:navire,produits:produits,poids_sac:poids_sac,destination:destination,client:client,sac:sac,id:id},
        success: function(response){
            $('#element_pont').html(response);
            $('#form_poids_pont').modal('toggle');
     
       
        }
    });


  });
});

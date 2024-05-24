$(document).ready(function(){
    $(document).on('click','a[data-role=liste_camion]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#input_navire_initiale').val();


    $("#btn_pont").css({
  'background': 'yellow',
  'color': 'blue'
});
    $('#main2').css('display','none');

    $('#table_liste_camion').css('display','block');
    $('#liste_camion').css('display','block');
    $('#espace_produit_pont').css('display','none');



        $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/afficher_liste_camion.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#body_liste_camion').html(response);
           
     
       
        }
    });


 

  });
});

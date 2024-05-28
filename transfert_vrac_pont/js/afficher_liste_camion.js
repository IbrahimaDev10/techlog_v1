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
      $('#espace_situation').css('display','none');
  $('#tableau_situation').css('display','none');
  $('#main2').css('display','none');
  
    $('#btn_situation').css('background','black');
  $('#btn_situation').css('color','white');

  $('#btn_camion_peses').css('background','black');
  $('#btn_camion_peses').css('color','white');
  $('#liste').css('background','yellow');
  $('#liste').css('color','blue');



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
